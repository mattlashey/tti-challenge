# Laravel CRUD Application

This is a simple Laravel CRUD (Create, Read, Update, Delete) application.

## Table of Contents

1. [Prerequisites](#prerequisites)
2. [Installation](#installation)
3. [Configuration](#configuration)
4. [Running the Application](#running-the-application)
5. [Testing the Application](#testing-the-application)
6. [Additional Information](#additional-information)

## Prerequisites

Make sure you have the following installed:

- PHP 8.0 or higher
- Composer
- Laravel (via `composer create-project`)
- A database (e.g., MySQL)
- Postman to test/run a list of API

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/repository-name.git
   cd repository-name

2. Install PHP dependencies:
    ```bash
    composer install
   
3. Copy .env.example to .env:
    ```bash
    cp .env.example .env
   
4. Generate application key:
    ```bash
   php artisan key:generate
   
5. Configure your database in the .env file. Update the following section with your database credentials:
     ```bash
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_username
     DB_PASSWORD=your_database_password
  
6. Run migrations to create database tables:
    ```bash
    php artisan migrate
    
7. Run seeders to create table rows:
    ```bash
    php artisan db:seed
    php artisan db:seed --class=ProjectSeeder
    
8. Start the Laravel development server:
   ```bash
    php artisan serve
   
9. Run test cases for project:
    ```bash
    php artisan test --filter=ProjectControllerTest
    php artisan test --filter=TaskControllerTest

10. To easily test the API endpoints provided by this application, we have included a Postman Collection.
    ```bash
    The Postman collection file is available at the root of this project structure as **Project Management Rest API.postman_collection.json**. Download this file and import to postman.
