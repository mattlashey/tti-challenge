# Laravel Project Management REST API

A REST API for managing **Projects** and **Tasks**, built with **Laravel**, **MySQL**, and **Docker** (via **Laravel Sail**).

## Table of Contents

1. [Overview](#overview)  
2. [Features](#features)  
3. [Getting Started](#getting-started)  
4. [Project Configuration](#project-configuration)  
5. [Usage](#usage)  
7. [Seeding & Factories](#seeding--factories)  
8. [Testing](#testing)  

---

## Overview

This application demonstrates:

- **Laravel & PHP** best practices (Controllers, Models, Migrations, Validation with FormRequests).  
- **MySQL** database operations (via Eloquent ORM).  
- **Docker** integration with **Laravel Sail**, allowing you to run PHP, MySQL, and other services in containers.  
- **REST API** design, returning JSON responses and appropriate HTTP status codes.  
- **Feature Tests** that verify CRUD operations for Projects and Tasks.

---

## Features

1. **Projects**  
   - Create, Read, Update, Delete (CRUD).  
   - Fields: `id`, `title`, `description`, `status`.

2. **Tasks**  
   - Create, Read, Update, Delete.  
   - Fields: `id`, `project_id`, `title`, `description`, `assigned_to`, `due_date`, `status`.  
   - Each Task belongs to exactly one Project.

3. **Database Seeding**  
   - Uses Factories to generate realistic dummy data.  
   - Automatically seeds 3–5 projects, each with 2–3 tasks, or as configured.

4. **FormRequest Validation**  
   - Ensures required fields (`title`, etc.) are present and valid.

5. **Feature Tests**  
   - Confirms all API endpoints work as expected: Projects CRUD and Tasks CRUD.

---

## Getting Started

### Prerequisites

- **Docker** and **Docker Compose** installed on your machine.  
- **Git** (if you want to clone this repository).

### Installation

1. Clone the repository
    ```bash
    git clone https://github.com/yourusername/laravel-project-mgmt.git
    cd laravel-project-mgmt
    ```

 2. Copy .env.example to .env
     ```bash
    cp .env.example .env
    ```

3. (Optional) Update .env with any custom values  
Make sure `DB_HOST=mysql` since that's the default hostname for the MySQL container.

4. Install Composer dependencies & set up Sail
    ```bash
    composer require laravel/sail --dev
    php artisan sail:install
    ./vendor/bin/sail composer install
    ```

5. Start Docker containers
    ```bash
    ./vendor/bin/sail up -d
    ```

---

## Project Configuration

### Migrations & Seeding

Run migrations:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

Seed the database with sample data:
    ```bash
    ./vendor/bin/sail artisan db:seed
    ```

If you want a fresh start (drop all tables, re-migrate, then seed):
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```

---

## Usage

When Docker (Sail) is running, the application is typically available at **http://localhost**.

- **API Endpoints** are under `http://localhost/api`.
- You can test endpoints with a tool like Postman or cURL.

---

## Seeding & Factories

- **Database Factories** generate sample data using Faker.
- **Seeders** orchestrate how many objects to create.
- All seeding is called from `DatabaseSeeder` (run via `db:seed`).

---

## Testing

This application includes **Feature Tests** located in `tests/Feature`.

Run all tests:
    ```bash
    ./vendor/bin/sail test
    ```

Filter by a single test (optional):
    ```bash
    ./vendor/bin/sail test --filter ProjectTest
    ./vendor/bin/sail test --filter TaskTest
    ```