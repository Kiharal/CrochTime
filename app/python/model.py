from pydantic import BaseModel
import heapq

class DatabaseTask(BaseModel):
    id: int
    process_time: int
    complexity: float


class Task:
    #This defines how tasks will look like once received from the Laravel application
    #The task will have only 2 items(id, Time_to_Process)
    id: int
    unprocessed: int
    remainder: int = 0
    complexity: float

    def __init__(self, id, process_time, comp, r=0):
        self.id = id
        self.unprocessed = process_time
        self.complexity = comp
        self.remainder = r

    def remainderable(self, processed):
        return processed >= self.unprocessed * self.complexity

    def reduceUnprocessed(self, time):
        self.unprocessed = self.unprocessed - time
        return self.unprocessed

    def __repr__(self):
        return f"({self.id}, {self.unprocessed})"

    def __gt__(self, other):
        return self.unprocessed * self.complexity * -1 > other

    def __lt__(self, other):
        return self.unprocessed * self.complexity * -1 < other

    def __eq__(self, other):
        return self.unprocessed * self.complexity * -1 == other

    def __le__(self, other):
        return self.unprocessed * self.complexity * -1 <= other

    def __ge__(self, other):
        return self.unprocessed * self.complexity * -1 >= other
    


class Tasks:
    def __init__(self):
        self.tasks = []

    def heap(self):
        heapq.heapify(self.tasks)

    def addTask(self, task: Task):
        self.tasks.append(task)

    def pushTask(self, task: Task):
        heapq(self.tasks, task)

    def isEmpty(self):
        return len(self.tasks) == 0

    def priority(self):
        self.heap()
        return self.tasks[0]

    def __repr__(self):
        return f"{self.tasks}"


class createTimetable(BaseModel):
    tasks: list
    max_time: int

