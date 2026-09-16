from model import Task, Tasks, DatabaseTask, createTimetable
import heapq

def setTasks(items: list[DatabaseTask]):
    all_tasks = Tasks()
    closest = {}
    for item in items:
        all_tasks.addTask(Task(
            item.id,item.process_time,item.complexity
            ))
        if item.complexity >= 0.5:
            closest[item.id] = item.complexity

    all_tasks.heap()
    return all_tasks, closest

class Table:
    def __init__(self, max_time=8):
        self.frontier = {}
        #If hours are null, then assume one is working 8 hours that day
        #Define the max time for work from given data
        self.max_time = max_time
        self.extra_time = {}

    def isEmpty(self):
        return len(self.frontier) == 0

    def isExpandable(self):
        return len(self.extra_time) > 0

    def addRemainder(self, task: Task, time):
        if(task.remainderable(time)):
            self.extra_time[task.id] = {
                'id': task.id,
                'time': task.reduceUnprocessed(time)
            }

    def createTable(self, laravel_tasks):
        #define all tasks from given data
        all_tasks, closest_due = setTasks(laravel_tasks)

        #Set table with appropriate time as per the number of tasks
        while not all_tasks.isEmpty():
            #base case

            if self.max_time <= 0:
                break


            if self.isEmpty():
                #get high priority task(complexity * unprocessed * -1)
                high_priority = all_tasks.priority()
                if high_priority.unprocessed > self.max_time / 2:
                    task = heapq.heappop(all_tasks.tasks)
                    #compute remainder if any
                    self.addRemainder(task, self.max_time / 2)
                    task.unprocessed = task.unprocessed - self.max_time / 2

                    node = {
                        'id': task.id,
                        'time': self.max_time / 2
                    }


                    self.frontier[node['id']] = node
                    self.max_time -=node['time']

                else:
                   task = heapq.heappop(all_tasks.tasks)
                   node = {
                       'id': task.id,
                       'time': task.unprocessed
                   }
                   self.frontier[node['id']] = node
                   self.max_time -=node['time']

                   #pop from cloest due
                   if node['id'] in closest_due:
                       closest_due.pop(node['id'])

                continue

            #For the rest of the tasks in the heap:
            #Remove next high priority task from the heap
            priority = heapq.heappop(all_tasks.tasks)
            #Check if it exists in the frontier
            if (priority.id in self.frontier and
                priority.id in self.extra_time and
                self.extra_time[priority.id]['time'] <= self.max_time):
                #Add to current table
                self.frontier[priority.id]['time'] += self.extra_time[priority.id]['time']
                self.max_time -= self.extra_time[priority.id]['time']
                self.extra_time.pop(priority)
                continue


            #Compute for larger time task
            elif (priority.id in self.frontier and
                priority.id in self.extra_time):
                #compute added time
                self.frontier[priority.id]['time'] += self.max_time
                self.extra_time[priority.id]['time'] -= self.max_time
                self.max_time = 0
                continue

            elif (priority.id in closest_due and
                  priority.unprocessed < self.max_time):
                closest_due.pop(priority.id)
                node = {
                    'id': priority.id,
                    'time': priority.unprocessed
                }
                self.frontier[priority.id] = node 
                self.max_time -= priority.unprocessed
                continue

            #Check if current task time can fit fully in the available time
            elif (priority.unprocessed <= self.max_time):
                node = {
                    'id': priority.id,
                    'time': priority.unprocessed
                }
                self.frontier[priority.id] = node 
                self.max_time -= priority.unprocessed
                continue
            #Set time taken to process task
            process_time = priority.unprocessed * priority.complexity
            #process the task
            if(process_time <= self.max_time):
                priority.unprocessed = priority.unprocessed - process_time
                #Compute for tasks already in the frontier but with no extra time
                if priority.id in self.frontier:
                    self.frontier[priority.id]['time'] += process_time
                    self.max_time -= process_time
                
                else:
                #New task
                    node = {
                        'id': priority.id,
                        'time': process_time
                    }

                    self.frontier[node['id']] = node
                    self.max_time -= node['time']
                self.addRemainder(priority, process_time)
                continue
            #if the task costs more time that what is available
            elif priority.id in closest_due:
                node = {
                    'id': priority.id,
                    'time': self.max_time
                }
                self.addRemainder(priority, self.max_time)
                self.max_time = 0
                continue

        #Merge any remaining values to extra time
        while not all_tasks.isEmpty():
            task =heapq.heappop(all_tasks.tasks)
            self.addRemainder(task, task.unprocessed)

        return [[item for item in self.frontier.values()],
                [extra_item for extra_item in self.extra_time.values()]]



