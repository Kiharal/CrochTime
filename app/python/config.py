from pydantic_settings import BaseSettings
import os
from dotenv import load_dotenv

class Settings(BaseSettings):
    host: str= "0.0.0.0"
    port: int = 8000

load_dotenv()

settings = Settings()
WEBHOOK_SECRET = os.getenv('WEBHOOK_SECRET')