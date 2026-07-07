from fastapi import FastAPI, HTTPException, Http
from pydantic import BaseModel

app = FastAPI()
class  taskItem:
    id: int
    order_id: int
    Status: str
    Workload: int
    Work_done: int
    def __init__(self, id, order_id, Status, Workload, Work_Done):
        self.id = id
        self.order_id = order_id
        self.Status = Status
        self.Workload = Workload
        self.Work_Done = Work_Done
            
        

class taskSequence(taskItem):
    arr: list[taskItem]
    def __init__(self):
        self.arr = []
    def add(self, item: taskItem):
        self.arr.append(item)


import heapq
def create(req: taskSequence):
    heap = []
    for item in req.arr:
        heap.append(item.Workload * -1)
    
    heapq.heapify(heap)
    #store
    print(heap)

def retrieve(req: Http):
    pass

p1 = taskItem(1, 1, "pending", 10, 2)
p2 = taskItem(2, 3, "pending", 16, 2)
p3 = taskItem(3, 5, "pending", 14, 2)

arr = taskSequence()
arr.add(p1)
arr.add(p2)
arr.add(p3)

create(arr)



