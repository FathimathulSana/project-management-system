# Project Management System API Documentation

**Authentication**

1. Register a User
   Endpoint: POST /api/register

    Body : {
            "name":"Fathimathul Sana",
            "email":"sana@gmail.com",
            "password":"123456"
            }

    Response : {
            "success": true,
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL3JlZ2lzdGVyIiwiaWF0IjoxNzQwMzk3NDI0LCJleHAiOjE3NDA0MDEwMjQsIm5iZiI6MTc0MDM5NzQyNCwianRpIjoibndDUjlidzBxd0d1R3EySyIsInN1YiI6IjIiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.ApW4HTlfI7oIMvofXGP-CNLJCKktq0N2hOW_DKaIgdw",
            "user": {
            "name": "Fathimathul Sana",
            "email": "sana@gmail.com",
            "updated_at": "2025-02-24T11:43:44.000000Z",
            "created_at": "2025-02-24T11:43:44.000000Z",
            "id": 2
            }
            }

2. Login a user
   Endpoint: POST /api/login

    Body : {
            "email":"fathimathulsana@gmail.com",
            "password":"123456"
            }

    Response : {
            "success": true,
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzQwMzk3NDUwLCJleHAiOjE3NDA0MDEwNTAsIm5iZiI6MTc0MDM5NzQ1MCwianRpIjoiREdrSjVaeHlPM0dOdDV6VSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.QHag4TXBWoQh8Me0YzVthGqzZ_PfSz42ptHLGXMWIPM",
            "user": {
            "id": 1,
            "name": "Fathimathul Sana",
            "email": "fathimathulsana@gmail.com",
            "email_verified_at": null,
            "created_at": "2025-02-24T08:20:14.000000Z",
            "updated_at": "2025-02-24T08:20:14.000000Z"
            }
            }

**Projects**  __Require Bearer Token__ 

1.  Get All Projects
    Endpoint: GET /api/projects

    Response : {
            "success": true,
            "projects": {
            "current_page": 1,
            "data": [
            {
            "id": 1,
            "user_id": 1,
            "project_name": "Project_One_updated",
            "description": "Description of Project One!",
            "status": "completed",
            "created_at": "2025-02-24T08:38:13.000000Z",
            "updated_at": "2025-02-24T08:47:12.000000Z"
            },
            {
            "id": 2,
            "user_id": 1,
            "project_name": "Project_two",
            "description": "Description of Project two!",
            "status": "active",
            "created_at": "2025-02-24T08:47:35.000000Z",
            "updated_at": "2025-02-24T08:47:35.000000Z"
            }
            ],
            "first_page_url": "http://127.0.0.1:8000/api/projects?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://127.0.0.1:8000/api/projects?page=1",
            "links": [
            {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
            },
            {
            "url": "http://127.0.0.1:8000/api/projects?page=1",
            "label": "1",
            "active": true
            },
            {
            "url": null,
            "label": "Next &raquo;",
            "active": false
            }
            ],
            "next_page_url": null,
            "path": "http://127.0.0.1:8000/api/projects",
            "per_page": 10,
            "prev_page_url": null,
            "to": 2,
            "total": 2
            }
            }

2.  Create a New Project
    Endpoint: POST /api/projects

    Body : {
            "project_name":"Project_three",
            "description":"Description of Project three!"
            }

    Response : {
            "success": true,
            "project": {
            "project_name": "Project_three",
            "description": "Description of Project three!",
            "user_id": 1,
            "updated_at": "2025-02-24T08:47:52.000000Z",
            "created_at": "2025-02-24T08:47:52.000000Z",
            "id": 3
            }
            }

3.  Update a Project
    Endpoint: PUT /api/projects/{project_id}

    Body : {
            "project_name":"Project_One_updated",
            "description":"Description of Project One!",
            "status":"completed"
            }

    Response : {
            "success": true,
            "project": {
            "id": 1,
            "user_id": 1,
            "project_name": "Project_One_updated",
            "description": "Description of Project One!",
            "status": "completed",
            "created_at": "2025-02-24T08:38:13.000000Z",
            "updated_at": "2025-02-24T08:47:12.000000Z"
            }
            }

4.  Delete a Project
    Endpoint: DELETE /api/projects/{project_id}

    Response : {
            "success": true,
            "message": "Deleted the project successfully."
            }

**Project Tasks**   __Require Bearer Token__

1.  Get Tasks for a Project
    Endpoint: GET /api/project/{project_id}/tasks

    Response : {
            "success": true,
            "project_name": "Project_One_updated",
            "tasks": {
            "current_page": 1,
            "data": [
            {
            "id": 1,
            "project_id": 1,
            "task_name": "Task_three_of_project_one_updated",
            "description": "description of task three",
            "status": "in-progress",
            "created_at": "2025-02-24T09:42:32.000000Z",
            "updated_at": "2025-02-24T11:08:28.000000Z"
            },
            {
            "id": 2,
            "project_id": 1,
            "task_name": "Task_two_of_project_one",
            "description": "description of task two",
            "status": "pending",
            "created_at": "2025-02-24T09:42:55.000000Z",
            "updated_at": "2025-02-24T09:42:55.000000Z"
            },
            {
            "id": 4,
            "project_id": 1,
            "task_name": "Task_four_of_project_one",
            "description": "description of task four",
            "status": "pending",
            "created_at": "2025-02-24T10:44:55.000000Z",
            "updated_at": "2025-02-24T10:44:55.000000Z"
            }
            ],
            "first_page_url": "http://127.0.0.1:8000/api/project/1/tasks?page=1",
            "from": 1,
            "last_page": 1,
            "last_page_url": "http://127.0.0.1:8000/api/project/1/tasks?page=1",
            "links": [
            {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
            },
            {
            "url": "http://127.0.0.1:8000/api/project/1/tasks?page=1",
            "label": "1",
            "active": true
            },
            {
            "url": null,
            "label": "Next &raquo;",
            "active": false
            }
            ],
            "next_page_url": null,
            "path": "http://127.0.0.1:8000/api/project/1/tasks",
            "per_page": 10,
            "prev_page_url": null,
            "to": 3,
            "total": 3
            }
            }

2.  Create a Task
    Endpoint: POST /api/project/{project_id}/tasks

    Body : {
            "task_name":"Task_four_of_project_one",
            "description":"description of task four"
            }

    Response : {
            "success": true,
            "task": {
            "task_name": "Task_four_of_project_one",
            "description": "description of task four",
            "project_id": 1,
            "updated_at": "2025-02-24T10:44:55.000000Z",
            "created_at": "2025-02-24T10:44:55.000000Z",
            "id": 4
            }
            }

3.  Update Task
    Endpoint: /project/{project_id}/tasks/{task_id}

    Body : {
            "task_name":"Task_three_of_project_one_updated",
            "description":"description of task three"
            }

    Response : {
            "success": true,
            "task": {
            "id": 1,
            "project_id": 1,
            "task_name": "Task_three_of_project_one_updated",
            "description": "description of task three",
            "status": "pending",
            "created_at": "2025-02-24T09:42:32.000000Z",
            "updated_at": "2025-02-24T09:53:48.000000Z"
            }
            }

4.  Delete a Task
    Endpoint: DELETE /api/project/{project_id}/tasks/{task_id}

    Response : {
            "success": true,
            "message": "Deleted the task successfully."
            }

5.  Update Task Status
    Endpoint: PUT /api/project/tasks/{task_id}/status

    Body : {
            "status":"in-progress"
            }

    Response : {
            "success": true,
            "message": "Status changed successfully"
            }

6.  Add remarks
    Endpoint: PUT /api/project/tasks/{task_id}/remark

    Body : {
            "remark":"Authontication with jwt completed!"
            }

    Response : {
            "success": true,
            "message": "Remark added successfully"
            }

**Project Report**   __Require Bearer Token__

1.  Fetch Project Report
    Endpoint: GET /api/project/{project_id}/report

    Response : {
            "success": true,
            "project": {
            "id": 1,
            "user_id": 1,
            "project_name": "Project_One_updated",
            "description": "Description of Project One!",
            "status": "completed",
            "created_at": "2025-02-24T08:38:13.000000Z",
            "updated_at": "2025-02-24T08:47:12.000000Z",
            "tasks": [
            {
            "id": 1,
            "project_id": 1,
            "task_name": "Task_three_of_project_one_updated",
            "description": "description of task three",
            "status": "in-progress",
            "created_at": "2025-02-24T09:42:32.000000Z",
            "updated_at": "2025-02-24T11:08:28.000000Z",
            "statuses": [
            {
            "id": 1,
            "task_id": 1,
            "status": "pending",
            "created_at": "2025-02-24T11:06:38.000000Z",
            "updated_at": "2025-02-24T11:06:38.000000Z"
            },
            {
            "id": 2,
            "task_id": 1,
            "status": "pending",
            "created_at": "2025-02-24T11:07:22.000000Z",
            "updated_at": "2025-02-24T11:07:22.000000Z"
            },
            {
            "id": 3,
            "task_id": 1,
            "status": "in-progress",
            "created_at": "2025-02-24T11:08:28.000000Z",
            "updated_at": "2025-02-24T11:08:28.000000Z"
            }
            ],
            "remarks": [
            {
            "id": 1,
            "task_id": 1,
            "remark": "Authontication completed!",
            "created_at": "2025-02-24T11:17:59.000000Z",
            "updated_at": "2025-02-24T11:17:59.000000Z"
            }
            ]
            },
            {
            "id": 2,
            "project_id": 1,
            "task_name": "Task_two_of_project_one",
            "description": "description of task two",
            "status": "pending",
            "created_at": "2025-02-24T09:42:55.000000Z",
            "updated_at": "2025-02-24T09:42:55.000000Z",
            "statuses": [],
            "remarks": [
            {
            "id": 2,
            "task_id": 2,
            "remark": "Authontication with jwt completed!",
            "created_at": "2025-02-24T11:18:27.000000Z",
            "updated_at": "2025-02-24T11:18:27.000000Z"
            }
            ]
            },
            {
            "id": 4,
            "project_id": 1,
            "task_name": "Task_four_of_project_one",
            "description": "description of task four",
            "status": "pending",
            "created_at": "2025-02-24T10:44:55.000000Z",
            "updated_at": "2025-02-24T10:44:55.000000Z",
            "statuses": [],
            "remarks": []
            }
            ]
            }
            }
