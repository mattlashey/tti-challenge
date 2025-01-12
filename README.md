# Project Management REST API

The Project Management Application is a RESTful API designed to manage Projects and Tasks. The application leverages Laravel's features, including controllers, models, API resources, form requests, and database seeders, to deliver a robust backend solution.

Key Features:

-   **Projects and Tasks Management** : Use Controller and Models to perform CRUD operations.
-   **Validation Rules** : Ensure data integrity using form request validation.
-   **Error Handling** : Return meaningful HTTP status codes (e.g., 201 for created, 404 if not found).
-   **API Resources** : Simplifies JSON transformation for consistent API responses.
-   **Mock Data Generation**: Uses factories and seeders to populate the database with sample data.

## Setup Instructions

### Step 1 : Clone the Repository

-   Clone the repository to your local machine:

    ```
    git clone <repository_url>

    ```

-   Navigate to the project directory:
    ```
    cd <project_directory>
    ```

### Step 2: Install Dependencies

-   Install PHP dependencies:
    ```
    composer install
    ```

### Step 3: Configure the Environment

-   Update the `.env` file with your database configuration:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

### Step 4: Run the Application

-   Start the local development server:
    ```
    php artisan serve
    ```
-   Access the application at [http://127.0.0.1:8000](http://127.0.0.1:8000)

## About the database

-   There are two tables : projects and tasks.
-   The status field in the projects and tasks tables is stored as a string to allow easy addition of new statuses without requiring schema changes.
-   For more dynamic applications, a separate table for statuses could be introduced. This would allow relationships between statuses and other entities.
-   Use DB diagram to draw a database design. You can see the database diagram [here](https://dbdiagram.io/d/Project-Management-67818b256b7fa355c38a9f56).

## API Reference

## Postman API Documentation

I published Postman API documentation to make API testing more efficient. You can access the documentation through this [link](https://documenter.getpostman.com/view/7694603/2sAYQWKtWs) or copy this
https://documenter.getpostman.com/view/7694603/2sAYQWKtWs

After you open the link, click the "Run in Postman" button located in the top-right
corner of the page. This will prompt you to choose between running it in Postman for Web or the Postman app. Select your preferred option, and the collection will be imported into your workspace.

## API Documentation

### Projects

#### 1. Create a Project

-   **Endpoint**: `POST /api/projects`
-   **Description**: Creates a new project.
-   **Request Body**:

    ```
    {
        "title": "Project Management REST API",
        "description": "This is a project management API project.",
        "status": "open"
    }
    ```

    **Note** : The `status` and `title` fields are required and `status` must be one of the following values: `"open"`, `"in_progress"`, `"completed"`.

-   **Response**:
    ```
    {
        "id": 1,
        "title": "Project Management REST API",
        "description": "This is a project management API project.",
        "status": "open"
    }
    ```

#### 2. Get all projects

-   **Endpoint**: `GET /api/projects`
-   **Description**: Get all projects.

-   **Response**:

    ```
        [
            {
                "id": 1,
                "title": "Project Management REST API",
                "description": "This is a project management API project.",
                "status": "open"
            }
        ]

    ```

#### 3. Get a single project

-   **Endpoint**: `GET /api/projects/{id}`
-   **Description**: Get a single project.

-   **Response**:

    ```
        {
           "project" :  {
                "id": 1,
                "title": "Project Management REST API",
                "description": "This is a project management API project.",
                "status": "open"
            }
        }

    ```

#### 4. Update a Project

-   **Endpoint**: `PUT /api/projects/{id}`
-   **Description**: Updates an existing project.
-   **Request Body**:
    ```
    {
        "title": "Project Management REST API Version 2",
        "description": "This is a project management API project.",
        "status": "completed"
    }
    ```
-   **Response**:

    ```
    {
        "message": "Project updated successfully.",
        "project": {
            "id" : 1,
            "title": "Project Management REST API Version 2",
            "description": "This is a project management API project.",
            "status": "completed"
        }
    }

    ```

#### 5. Delete a Project

-   **Endpoint**: `DELETE /api/projects/{id}`
-   **Description**: Deletes an existing project.
-   **Response**:
    ```
    {
        "message": "Project deleted successfully.",
    }
    ```

### Tasks

#### 1. Create a task under a project

-   **Endpoint**: `POST /api/projects/{project_id}/tasks`
-   **Description**: Creates a new task for a specific project.
-   **Request Body**:

    ```
    {
        "title" : "task two",
        "description" : "update about page",
        "assigned_to" : "sai soe san",
        "due_date" : "2025-01-30",
        "status" : "to_do"
    }
    ```

    **Note** : The `status` and `title` fields are required and `status` must be one of the following values: `"to_do"`, `"in_progress"`, `"qa_review"`, `"done"`.

-   **Response**:
    ```
    {
        "id": 11,
        "title": "task two",
        "description": "update about page",
        "assigned_to": "sai soe san",
        "due_date": "2025-01-30",
        "status": "to_do",
        "project": {
            "id": 9,
            "title": "Et minima voluptas.",
            "description": "Repellat numquam facilis voluptatibus optio amet odio sit.",
            "status": "open"
        }
    }
    ```

#### 2. Get all tasks

-   **Endpoint**: `GET /api/tasks`
-   **Description**: Get all tasks.

-   **Response**:

    ```
    [
        {
            "id": 1,
            "title": "Doloribus soluta quod ut.",
            "description": "Nihil quae dolore ut architecto dolorem ea incidunt qui.",
            "assigned_to": "Eulah Hauck",
            "due_date": "2024-04-28",
            "status": "done",
            "project": {
                "id": 14,
                "title": "Asperiores incidunt numquam.",
                "description": "Laudantium quod dicta nobis laborum laborum accusantium.",
                "status": "open"
            }
        }
    ]

    ```

#### 3. Get all tasks for a specific project

-   **Endpoint**: `GET /api/projects/{project_id}/tasks`
-   **Description**: Get all tasks associate with a project.

-   **Response**:

    ```
    [
        {
            "id": 1,
            "title": "Doloribus soluta quod ut.",
            "description": "Nihil quae dolore ut architecto dolorem ea incidunt qui.",
            "assigned_to": "Eulah Hauck",
            "due_date": "2024-04-28",
            "status": "done",
            "project": {
                "id": 14,
                "title": "Asperiores incidunt numquam.",
                "description": "Laudantium quod dicta nobis laborum laborum accusantium.",
                "status": "open"
            }
        }
    ]

    ```

#### 4. Get a single task

-   **Endpoint**: `GET /api/tasks/{id}`
-   **Description**: Get a single task.

-   **Response**:

    ```
        {
            "task": {
                "id": 2,
                "title": "Illo unde aut laudantium.",
                "description": "Facere in et voluptas aliquam quidem est ut non.",
                "assigned_to": "Mr. Hilton Gulgowski",
                "due_date": "1970-08-13",
                "status": "in_progress",
                "project": {
                    "id": 15,
                    "title": "Consequatur temporibus earum.",
                    "description": "Repellat nam maiores enim natus asperiores aut. Voluptatibus eos ea quos porro.",
                    "status": "open"
                }
            }
        }
    ```

#### 5. Update a task

-   **Endpoint**: `PUT /api/tasks/{id}`
-   **Description**: Updates an existing task.
-   **Request Body**:
    ```
    {
        "title" : "task one updated",
        "description" : "update home page version3",
        "assigned_to" : "sai",
        "due_date" : "2025-01-30",
        "status" : "to_do",
        "project_id" : 14 // optional
    }
    ```
-   **Response**:

    ```
    {
        "message": "Task updated successfully.",
        "task": {
            "id": 1,
            "title": "task one updated",
            "description": "update home page version3",
            "assigned_to": "sai",
            "due_date": "2025-01-30",
            "status": "to_do",
            "project": {
                "id": 14,
                "title": "Asperiores incidunt numquam.",
                "description": "Laudantium quod dicta nobis laborum laborum accusantium.",
                "status": "open"
            }
        }
    }

    ```

#### 6. Delete a task

-   **Endpoint**: `DELETE /api/tasks/{id}`
-   **Description**: Deletes an existing task.
-   **Response**:
    ```
    {
        "message": "Task deleted successfully.",
    }
    ```
