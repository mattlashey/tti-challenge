# Trinh Nhu Khang Le Submission: Project Management API

A RESTful API built with Laravel for managing projects and tasks. The API allows for complete CRUD operations on both projects and tasks, with proper validation and error handling.

## Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Git

## Installation

1. Clone the repository:
```bash
git clone git@github.com:mattlashey/tti-challenge.git
git checkout trinh_nhu_khang_le-submittion
cd tti-challenge
```

2. Install dependencies:
```bash
composer install
```

3. Create and configure environment file:
```bash
cp .env.example .env
```

4. Configure your database credentials in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run migrations and seed the database:
```bash
php artisan migrate --seed
```

7. Start the development server:
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## Postman Collection
1. Open Postman
2. Click on "Import" button
3. Select the ProjectManagementApi.postman_collection.json file from the project's root directory
4. Select the ProjectManagementApi.postman_environment.json file from the project's root directory
5. The collection and environment will be imported with all available endpoints

## API Endpoints

### Projects

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/projects` | List all projects |
| POST | `/api/projects` | Create a new project |
| GET | `/api/projects/{id}` | Show a specific project |
| PUT | `/api/projects/{id}` | Update a project |
| DELETE | `/api/projects/{id}` | Delete a project |

#### Project Creation/Update Parameters

```json
{
    "title": "Required string",
    "description": "Optional string",
    "status": "Required string (open/in_progress/completed)"
}
```

### Tasks

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/tasks` | List all tasks |
| GET | `/api/projects/{project_id}/tasks` | List tasks for a specific project |
| POST | `/api/projects/{project_id}/tasks` | Create a task for a project |
| GET | `/api/tasks/{id}` | Show a specific task |
| PUT | `/api/tasks/{id}` | Update a task |
| DELETE | `/api/tasks/{id}` | Delete a task |

#### Task Creation/Update Parameters

```json
{
    "title": "Required string",
    "description": "Optional string",
    "assigned_to": "Optional string",
    "due_date": "Optional date (YYYY-MM-DD)",
    "status": "Required string (to_do/in_progress/done)"
}
```

