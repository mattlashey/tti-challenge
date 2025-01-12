<p align="center">Setup Instructions </p>

- git clone <repository_url>
- cd <project_directory>

- composer install

- cp .env.example .env
- Create a DB name project_management
- Update DB connection details in .env file as follows
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_management
DB_USERNAME=root
DB_PASSWORD=

- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

## Run Feature Tests with the following commands 
- php artisan test --filter=ProjectApiTest
- php artisan test --filter=TaskApiTest

##  REST API's

## Projects Routes 
1. GET /projects   (List all projects)
    Response: 200 OK
    Response Format: JSON array of project objects  [
                                                        {
                                                            "id": 1,
                                                            "title": "Project A",
                                                            "description": "Description of project A",
                                                            "status": "open",
                                                            "created_at": "2025-01-11T12:00:00",
                                                            "updated_at": "2025-01-11T12:00:00"
                                                        },
                                                        ...
                                                    ]

2. POST /projects  (Create a new project)
    Request Body: {
                    "title": "Project B",
                    "description": "Description of project B",
                    "status": "in_progress"
                }
    Response: 201 Created
    Response Format: JSON object of the created project  {
                                                            "id": 2,
                                                            "title": "Project B",
                                                            "description": "Description of project B",
                                                            "status": "in_progress",
                                                            "created_at": "2025-01-11T12:05:00",
                                                            "updated_at": "2025-01-11T12:05:00"
                                                        }

3. GET /projects/{id}  (Show details of a single project)
    Response: 200 OK
    Response Format: JSON object of a project: {
                                                    "id": 1,
                                                    "title": "Project A",
                                                    "description": "Description of project A",
                                                    "status": "open",
                                                    "created_at": "2025-01-11T12:00:00",
                                                    "updated_at": "2025-01-11T12:00:00"
                                                }

4. PUT /projects/{id}   (Update an existing project)
    Request Body:  {
                    "title": "Updated Project",
                    "description": "Updated description",
                    "status": "completed"
                    }
    Response: 200 OK
    Response Format: JSON object of the updated project   {
                                                            "id": 3,
                                                            "title": "Updated Project",
                                                            "description": "Updated description",
                                                            "status": "completed",
                                                            "created_at": "2025-01-11T12:05:00",
                                                            "updated_at": "2025-01-11T13:05:00"
                                                        }

5. DELETE /projects/{id}  (Delete a project)
    Response: 200 OK
    Response Format: Success message
    {
        "message": "Project deleted successfully"
    }





## Tasks routes

1. GET /tasks  (List all tasks)
    Response: 200 OK
    Response Format: JSON array of task objects


2. GET /projects/{project_id}/tasks  (List tasks for a specific project)
    Response: 200 OK
    Response Format: JSON array of task objects


3. POST /projects/{project_id}/tasks  (Create a new task under a specific project)
    Request Body: {
                    "title": "Task 1",
                    "description": "Task description",
                    "assigned_to": "User Name",
                    "status": "to_do",
                    "due_date": "2025-01-15"
                    }
    Response: 201 Created
    Response Format: JSON object of the created task

  
4. GET /tasks/{id}  (Show details of a single task)
    Response: 200 OK
    Response Format: JSON object of the task


5. PUT /tasks/{id}    (Update an existing task)
    Request Body: {
                    "title": "Updated Task",
                    "assigned_to": "Updated User",
                    "status": "in_progress"
                   }
    Response: 200 OK
    Response Format: JSON object of the updated task

6. DELETE /tasks/{id}   (Delete a task)
    Response: 200 OK
    Response Format: Success message
    {
        "message": "Task deleted successfully"
    }

 