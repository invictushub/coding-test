# Changelog
## Features Added:
- Make a functionality for update task name.
- Make a functionality for update assignee of task.
- Make a functionality for change phase of the card. (Not with drag and drop)
- Mark the Done Phase as the completed phase and when the task move to Done phase
the task marked as completed and in UI I show the completed task in Gray Color.
- Make a functionality for deleting a Phase, and when a phase is deleted then all
the tasks in the phase will also be deleted.
- Make a functionality for due date, I add a column due_date in tasks table, user
has to provide the due date of the task while adding the task. On UI side if the 
task is due dated then if will shown as Flaged task.
- Make a user stats page where I show total task assigneed to each users, tasks 
completed by users current week, tasks completed by users current month.

## Improvements:
There are number of improvement which can be made and due to lake of time from
my daily routine I did not manage it to do, few of them is listed below.
- When tasks is created, updated or deleted we refresh the board, this will get all
the phase and tasks again. I think we can play with Store State directly, if API call
is successful only then. But for now its a testing project and we don't have a bunch
of tasks so its ok to refresh the board.
- We can also use some best practices of laravel like API Resources etc.
- We can make mixins for methods use in different components like getAvatar().
- We can also write unit test to make sure everything is working fine.
