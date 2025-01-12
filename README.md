<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




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
