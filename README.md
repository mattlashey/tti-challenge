# Project Management REST API

A simple REST API built with Laravel, PHP, and MySQL for managing projects and tasks. 

## Features

- **Projects**
  - Create, read, update, and delete (CRUD).
  - Each project includes:
    - `title` (required)
    - `description` (optional)
    - `status` (`open`, `in_progress`, `completed`).

- **Tasks**
  - Create, read, update, and delete (CRUD).
  - Each task belongs to a specific project and includes:
    - `title` (required)
    - `description` (optional)
    - `assigned_to` (optional)
    - `due_date` (optional)
    - `status` (`to_do`, `in_progress`, `done`).

## Installation

### Prerequisites

- PHP 8.x or later
- Composer
- MySQL
- Laravel CLI

### Steps

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/project-management-api.git
   cd project-management-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Create and configure the `.env` file:
   ```bash
   cp .env.example .env
   ```
   Update the database settings in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_management
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. Generate an application key:
   ```bash
   php artisan key:generate
   ```

5. Run migrations to set up the database:
   ```bash
   php artisan migrate
   ```

6. Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```

7. Start the development server:
   ```bash
   php artisan serve
   ```
   The API will be accessible at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## API Documentation

### Projects

- **GET /api/projects**
  - Fetch all projects.
- **POST /api/projects**
  - Create a new project.
  - Request body:
    ```json
    {
      "title": "Project Title",
      "description": "Optional description",
      "status": "open"
    }
    ```
- **GET /api/projects/{id}**
  - Fetch a single project by ID.
- **PUT /api/projects/{id}**
  - Update an existing project.
  - Request body:
    ```json
    {
      "title": "Updated Title",
      "description": "Updated Description",
      "status": "in_progress"
    }
    ```
- **DELETE /api/projects/{id}**
  - Delete a project by ID.

---

### Tasks

- **GET /api/projects/{project_id}/tasks**
  - Fetch all tasks for a specific project.
- **POST /api/projects/{project_id}/tasks**
  - Create a new task under a project.
  - Request body:
    ```json
    {
      "title": "Task Title",
      "description": "Optional description",
      "assigned_to": "John Doe",
      "due_date": "2025-01-15",
      "status": "to_do"
    }
    ```
- **GET /api/tasks/{id}**
  - Fetch a single task by ID.
- **PUT /api/tasks/{id}**
  - Update an existing task.
  - Request body:
    ```json
    {
      "title": "Updated Task Title",
      "description": "Updated Description",
      "assigned_to": "Jane Doe",
      "due_date": "2025-01-20",
      "status": "in_progress"
    }
    ```
- **DELETE /api/tasks/{id}**
  - Delete a task by ID.

---

## Testing

To run the automated tests:

1. Ensure the database is migrated:
   ```bash
   php artisan migrate:fresh --seed
   ```

2. Run the test suite:
   ```bash
   php artisan test
   ```

The tests cover:
- CRUD operations for projects and tasks.
- Validation rules.
- Relationships between projects and tasks.
- Error handling for missing resources.

---

## Sample Seed Data

The database is pre-populated with:
- **3 Sample Projects**: Each project contains:
  - Title
  - Description
  - Status
- **2-3 Tasks per Project**: Each task contains:
  - Title
  - Description
  - Assigned To
  - Due Date
  - Status

Run the seeder using:
```bash
php artisan db:seed
```

---

## Code Structure

- **Models**
  - `Project`: Defines the `hasMany` relationship with `Task`.
  - `Task`: Defines the `belongsTo` relationship with `Project`.
- **Controllers**
  - `ProjectController`: Handles project CRUD operations.
  - `TaskController`: Handles task CRUD operations.
- **Routes**
  - Defined in `routes/api.php` using resource routes.

---

## Notes

- Make sure to configure the `.env` file correctly.
- Run `php artisan migrate:fresh --seed` to reset the database if necessary.

---

