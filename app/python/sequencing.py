import hashlib
import hmac
import logging
import config
 
import httpx
from fastapi import BackgroundTasks, FastAPI, Header, HTTPException, status, Depends
from pydantic import BaseModel
from processing import Table
from model import DatabaseTask
import uvicorn

logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

#From laravel application

class IncomingTasks(BaseModel):
    request_id: int
    callback_url: str
    max_time: int
    laravel_tasks: list[DatabaseTask]


#from processing in python application(table creation, processing.py)
class ProcessedTask(BaseModel):
    id: int
    time: int

class CreatedTable(BaseModel):
    frontier: list[ProcessedTask]
    extra: list[ProcessedTask]

class WebhookResult(BaseModel):
    request_id: int
    status: str
    items: CreatedTable | None = None
    error: str | None = None


app = FastAPI()
def sign_tables(body):
    return hmac.new(
        config.WEBHOOK_SECRET.encode('utf-8'),
        body,
        hashlib.sha256
    ).hexdigest()


def verify_api_key(Authorization: str = Header("")):
    expected = f"Bearer {config.WEBHOOK_SECRET}"

    if not hmac.compare_digest(Authorization, expected):
        raise HTTPException(
            status_code=401,
            detail="failed API KEY"
        )

@app.post('/createTable',
          dependencies=[Depends(verify_api_key)])
async def receive_data(requestTasks: IncomingTasks, background_tasks: BackgroundTasks):
    print(requestTasks)
    if not requestTasks.laravel_tasks:
        raise HTTPException(
            status_code=422,
            detail="Must provide at least one task",
            header={'x_Error': "true"}
        )

    else:
        #Run task
        background_tasks.add_task(run_job, requestTasks)

async def run_job(requestTasks: IncomingTasks)->None:
    result = WebhookResult(request_id=requestTasks.request_id, status="completed")

    try:
    #Set table
        EmptyTable = Table(max_time=requestTasks.max_time)
        main_table, extra_table = EmptyTable.createTable(requestTasks.laravel_tasks)
        print(main_table, extra_table)
        result.items = CreatedTable(frontier=main_table, extra=extra_table)
        result.error = None
    except Exception as exc:
        logger.exception(f'Failed to perform main processing {result.request_id}')
        result.status = 'failed'
        result.error = str(exc)

    
    body = result.model_dump_json().encode('utf-8')
    headers = {"X-Signature": sign_tables(body),"Content-Type": "application/json"}
    result.error = None

    async with httpx.AsyncClient(timeout=10) as client:
        try:
            response = await client.post(requestTasks.callback_url, content=body, headers=headers)
            response.raise_for_status()
            print(response.json())
            
        except httpx.HTTPError:
            logger.exception(f'failed To deliver request {requestTasks.request_id}')



@app.get('/health')
async def health():
    return {"status": "ok"}


if __name__ == "__main__":
    uvicorn.run("sequencing:app", host="127.0.0.1", port=5005, reload=True)

