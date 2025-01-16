# **Project Management REST API**

A RESTful API built using **Laravel**, **MySQL**, and **PHP** to manage projects and tasks. This application supports full CRUD operations, efficient database relationships, and modern development practices.

---

## **Features**

-   Full **CRUD operations** for **Projects** and **Tasks**.
-   Nested resource relationships: Projects can have multiple tasks.
-   **Input validation** and descriptive error handling.
-   Adheres to **RESTful API standards**.
-   Database migrations and seeding for initial sample data.
-   JSON responses with appropriate **HTTP status codes**.
-   Comprehensive test coverage for Projects and Tasks endpoints.

---

## **Requirements**

To run this application, you’ll need:

-   PHP **8.2** or higher.
-   Composer (for dependency management).
-   MySQL **5.7** or higher.
-   Laravel **11.x** (used in this project).

---

## **Installation**

```bash
1. **Clone the Repository**:
   git clone https://github.com/your-username/project-management-rest-api.git
   cd project-management-rest-api

2. **Install Dependencies**:
   composer install

3. **Set Up Environment Configuration**:
   # Create a `.env` file by copying the example:
   cp .env.example .env

   # Generate the application key:
   php artisan key:generate

   # Update `.env` with your database credentials:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_management
   DB_USERNAME=root
   DB_PASSWORD=your-password

4. **Run Migrations and Seeders**:
   php artisan migrate --seed
```

## **Running the Application**

```bash
# Start the development server:
php artisan serve

# The application will be accessible at:
http://127.0.0.1:8000
```

---

## **API Endpoints**

### **Projects**

| Method | Endpoint           | Description            |
| ------ | ------------------ | ---------------------- |
| GET    | /api/projects      | List all projects      |
| POST   | /api/projects      | Create a new project   |
| GET    | /api/projects/{id} | Get a specific project |
| PUT    | /api/projects/{id} | Update a project       |
| DELETE | /api/projects/{id} | Delete a project       |

### **Tasks**

| Method | Endpoint                         | Description                       |
| ------ | -------------------------------- | --------------------------------- |
| GET    | /api/tasks                       | List all tasks                    |
| GET    | /api/projects/{project_id}/tasks | List tasks for a specific project |
| POST   | /api/projects/{project_id}/tasks | Create a task in a project        |
| GET    | /api/tasks/{id}                  | Get a specific task               |
| PUT    | /api/tasks/{id}                  | Update a task                     |
| DELETE | /api/tasks/{id}                  | Delete a task                     |

---

## **Sample Data**

```json
{
    "id": 1,
    "title": "Build API",
    "description": "Create RESTful API for managing projects",
    "status": "in_progress",
    "tasks": [
        {
            "id": 1,
            "title": "Setup Laravel Project",
            "description": "Initialize Laravel application",
            "assigned_to": "Developer A",
            "due_date": "2025-01-15",
            "status": "completed"
        },
        {
            "id": 2,
            "title": "Define Models",
            "description": "Create models for Project and Task",
            "assigned_to": "Developer B",
            "due_date": "2025-01-16",
            "status": "in_progress"
        }
        {
            "id": 3,
            "title": "Define Models",
            "description": "Create models for Project and Task",
            "assigned_to": "Developer C",
            "due_date": "2025-01-16",
            "status": "in_progress"
        }
    ]
}
```

---

## **Error Handling**

```json
# Example 404 Error Response:
{
  "error": "Resource not found"
}

# Example 422 Validation Error Response:
{
  "message": "The given data was invalid.",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}
```

---

## **Testing**

```bash
# Run the test suite:
php artisan test


# Example output:
PASS  Tests\Feature\ProjectTest
✓ it lists all projects
✓ it creates a new project
✓ it updates a project
✓ it deletes a project
```
