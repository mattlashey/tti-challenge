Project

This is a simple Project Management REST API built using Laravel, PHP, and MySQL. The application allows you to manage projects and tasks, supporting CRUD operations for both.

Features:
Projects: Create, read, update, and delete projects.
Tasks: Create, read, update, and delete tasks within projects.

Requirements:
PHP 8.0 or higher
Composer
MySQL or compatible database

Installation
Follow these steps to set up the project on your local machine:

1. Clone the Repository
   Clone the repository using Git

2. Install Dependencies
   Install the necessary PHP dependencies using Composer:

composer install 3. Set Up Your Environment
Copy the .env.example file to .env:
cp .env.example .env 4. Configure the Database
In the .env file, configure your database settings:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_management
DB_USERNAME=root
DB_PASSWORD= 5. Run Database Migrations and Seeders
Run the following commands to set up your database and add sample data:
php artisan migrate
php artisan db:seed 6. Start the Laravel Development Server
Start the development server with:

php artisan serve
The application will be accessible at http://127.0.0.1:8000.

API Endpoints
Projects
GET /api/projects - List all projects
POST /api/projects - Create a new project
GET /api/projects/{id} - Show details of a single project
PUT /api/projects/{id} - Update an existing project
DELETE /api/projects/{id} - Delete a project
Tasks
GET /api/tasks - List all tasks (optional)
GET /api/projects/{project_id}/tasks - List all tasks for a specific project
POST /api/projects/{project_id}/tasks - Create a new task under a project
GET /api/tasks/{id} - Show details of a single task
PUT /api/tasks/{id} - Update an existing task
DELETE /api/tasks/{id} - Delete a task
Testing
You can run the tests using Laravel's built-in testing suite:

php artisan test
