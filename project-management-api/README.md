# Project Management API

This project is a **RESTful API** for managing projects and their associated tasks, designed to handle high-load scenarios with optimized database operations and caching for fast delivery. The API is built with **Laravel**, leveraging **Redis** for caching and queue management.

---

## Features

1. **Project Management:**
   - Create, update, delete, and fetch projects.
   - Associate tasks with projects during creation.

2. **Task Management:**
   - Tasks can be added to projects, each with a status (`pending`, `in_progress`, `completed`).

3. **Optimized Database Operations:**
   - Indexing on database columns for faster read queries.
   - Transactions to ensure data consistency during project and task creation.

4. **Redis Caching:**
   - Redis is used to cache project data for faster response times.
   - Cache automatically rebuilds in the background when projects are created, updated, or deleted.

5. **Background Job Processing:**
   - Laravel queues are used to rebuild cache asynchronously, ensuring smooth user experience.

---

## API Endpoints

### **Projects**

| Method  | Endpoint             | Description                          |
|---------|----------------------|--------------------------------------|
| `GET`   | `/api/projects`      | Fetch all projects with tasks.       |
| `POST`  | `/api/projects`      | Create a new project with tasks.     |
| `GET`   | `/api/projects/{id}` | Fetch a specific project by ID.      |
| `PUT`   | `/api/projects/{id}` | Update a specific project.           |
| `DELETE`| `/api/projects/{id}` | Delete a specific project.           |

---

## Technologies Used

- **Framework:** Laravel
- **Database:** MySQL (with indexing for performance)
- **Caching:** Redis
- **Queue Management:** Laravel Queues with Redis
- **Web Server:** PHP’s built-in server (or any other server like Nginx/Apache)

---

## Installation

### Prerequisites
- PHP 8.4+
- MySQL
- Redis
- Composer

### Steps
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd project-management-api
2. Install dependencies:
   ```bash
   composer install
3. Set up .env file:
   ```bash
   cp .env.example .env
   Update database and Redis configurations in the .env file:
4. Run database migrations:
   ```bash
   php artisan migrate
5. Start the application:
   ```bash
   php -S 127.0.0.1:8000 -t publi
6. Start queue worker:
   ```bash
   php artisan queue:work

## How It Works

### **Creating a Project**
- When a new project is created, tasks can be associated with it.
- Database transactions ensure consistency, rolling back if any error occurs.

### **Fetching Projects**
- Projects and their tasks are cached in Redis for fast delivery.
- Cache TTL is set to 1 hour (3600 seconds).

### **Updating Projects**
- When a project is updated, the cache is cleared, and updated data is rebuilt in the background using a queue job.

### **Deleting Projects**
- Projects and their tasks are removed from the database, and the cache is invalidated.

### **High-Load Optimizations**
- **Indexing:** Database indexes speed up read operations for frequent queries.
- **Redis Caching:** Reduces load on the database by serving cached data.
- **Asynchronous Jobs:** Cache rebuilding is handled in the background, ensuring a smooth user experience.

## Example Requests

### **Create a New Project**
```bash
curl -X POST http://127.0.0.1:8000/api/projects \
-H "Content-Type: application/json" \
-d '{
    "name": "Test Project",
    "description": "Testing Background Cache",
    "tasks": [
        {"name": "Task 1", "status": "pending"}
    ]
}'

curl -X GET http://127.0.0.1:8000/api/projects

curl -X PUT http://127.0.0.1:8000/api/projects/1 \
-H "Content-Type: application/json" \
-d '{
    "name": "Updated Project Name",
    "description": "Updated Project Description"
}'

curl -X DELETE http://127.0.0.1:8000/api/projects/1



