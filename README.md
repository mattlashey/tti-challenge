# At-Home Coding Challenge: Laravel, PHP, and MySQL

**Objective:**  
Create a simple **Project Management** REST API using **Laravel**, **MySQL**, and **PHP**. The application will manage **Projects** and **Tasks** and demonstrate your understanding of core Laravel features (migrations, seeding, REST API, etc.).

---

## 1. Overview

You will build a back-end application that supports the following features:

- **Projects**:
  - Create, read, update, and delete.
  - Fields:
    - `id` (primary key, auto-increment)
    - `title` (string, required)
    - `description` (text, optional)
    - `status` (e.g., `open`, `in_progress`, `completed`)

- **Tasks**:
  - Create, read, update, and delete.
  - Fields:
    - `id` (primary key, auto-increment)
    - `project_id` (foreign key referencing `projects`)
    - `title` (string, required)
    - `description` (text, optional)
    - `assigned_to` (string, optional)
    - `due_date` (date, optional)
    - `status` (e.g., `to_do`, `in_progress`, `done`)

Each **Project** can have multiple **Tasks**, and each **Task** belongs to exactly one **Project**.

---

## 2. Requirements

### 2.1 Application Structure
- Use the **latest** or a **recent LTS version** of Laravel.
- Define migrations for `projects` and `tasks`.
- Use Eloquent models (`Project` and `Task`) to set up relationships.
- Provide a **seeder** to populate the database with sample data.

### 2.2 REST API Endpoints
Implement endpoints for CRUD operations on both **Projects** and **Tasks**. For example:

- **Projects**
  - `GET /api/projects` – List all projects.
  - `POST /api/projects` – Create a new project.
  - `GET /api/projects/{id}` – Show details of a single project.
  - `PUT /api/projects/{id}` – Update an existing project.
  - `DELETE /api/projects/{id}` – Delete a project.

- **Tasks**
  - `GET /api/tasks` – List all tasks (optional).
  - `GET /api/projects/{project_id}/tasks` – List all tasks for a specific project.
  - `POST /api/projects/{project_id}/tasks` – Create a new task under a project.
  - `GET /api/tasks/{id}` – Show details of a single task.
  - `PUT /api/tasks/{id}` – Update an existing task.
  - `DELETE /api/tasks/{id}` – Delete a task.

### 2.3 Database Seeding
- Write seeders to populate the database with:
  - At least **3 sample projects**.
  - Each project should have **2–3 sample tasks**.

### 2.4 Validation
- Use **Laravel validation** to ensure required fields (e.g., `title`) are present.
- Return appropriate error messages if validation fails.

### 2.5 Error Handling
- Return meaningful HTTP status codes (e.g., `201` for created, `404` if not found).
- Send JSON responses for both successful and failed operations.

### 2.6 Code Organization
- Implement **Controllers** for handling the logic.
- Use **Eloquent** relationships for managing data between models.
- Write **clean and readable** code, following Laravel conventions.

### 2.7 Testing (Optional)
- If time allows, include some **Feature** or **Unit Tests** to show how you would test the API endpoints.

### 2.8 Submission
1. Push the code to a **public GitHub repository**.
2. Include a **README** with:
   - Setup instructions (how to install dependencies, configure `.env`, run migrations, and seeders).
   - Instructions to run the application (e.g., `php artisan serve`).
   - API documentation outlining endpoints and request/response formats.

---

## 3. What We’re Looking For

1. **Laravel & PHP Mastery**  
   Demonstrate knowledge of the Laravel ecosystem (controllers, models, migrations, seeding, validation, etc.).

2. **MySQL Knowledge**  
   Show the ability to write migrations, seed the database, and define relationships.

3. **API Design & Best Practices**  
   Properly structure endpoints, use correct HTTP methods, return appropriate status codes, and handle errors gracefully.

4. **Clean & Organized Code**  
   Ensure your code is easy to read and maintain. Use clear commit messages and explain decisions in the README.

---

## 4. Suggested Steps

1. **Initial Setup**
   - Create a new Laravel project (`laravel new project-management` or via Composer).
   - Configure your `.env` file for MySQL connection.

2. **Database & Models**
   - Create migrations for `projects` and `tasks`.
   - Create `Project` and `Task` Eloquent models with `hasMany` and `belongsTo` relationships.

3. **Controllers & Routes**
   - Define routes in `routes/api.php`.
   - Create `ProjectController` and `TaskController` to handle RESTful operations.

4. **Validation**
   - Use request validation (e.g., `FormRequest` classes or controller-based validation) to ensure required fields are present.

5. **Seeding**
   - Write seeders under `database/seeders` to create sample projects and tasks.
   - Run migrations and seeds.

6. **Testing (Optional)**
   - Use Laravel’s testing suite (`php artisan test`) to confirm your endpoints work as expected.

7. **Documentation & Submission**
   - Provide a `README.md` explaining how to set up and run your project.
   - Push all code to a **public GitHub** repository and open a pull request.
