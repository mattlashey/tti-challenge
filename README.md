# TTI Interview challenge (Patient Management System)

Welcome to our interview challenge! This repository contains the necessary files and instructions for completing the challenge.

## Setup Instructions

Follow these steps to set up the project on your local machine:

### 1. Install the dependencies

```
composer install
```

### 2. Create the database file and configure your enviromental variables

```
touch database/database.sqlite
```

Add the following to your `.env` file

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 3. Run the migrations

```
php artisan migrate
```

### 3. Seed the database

```
php artisan db:seed --class=PatientSeeder
```

---

## Objective:
Create a dynamic patient list using Laravel and Livewire, demonstrating your ability to learn new technologies and solve real-world problems.

## Task:
Develop a patient list page with the following features:
1. Display all patients in a table format
2. Implement pagination
3. Enable sorting by different columns (e.g., first name, last name, updated at)
4. Add filtering options (e.g., by gender, country)
5. Implement a search functionality

## Technical Requirements:
- Use Laravel's built-in features for database interactions
- Implement the table using Livewire for dynamic updates without page reloads
- Follow Laravel and PHP best practices for code organization and structure

## Expectations:
1. Functionality: All required features should work correctly
2. Code Quality: Write clean, well-commented, and organized code
3. User Experience: Create an intuitive and responsive interface
4. Problem-Solving: Demonstrate ability to overcome challenges and find solutions
5. Learning Ability: Show proficiency in using unfamiliar technologies (Laravel and Livewire)

## Evaluation Criteria:
- Completeness of implemented features
- Code structure and adherence to best practices
- Efficiency of database queries and overall performance
- User interface design and responsiveness
- Creativity in problem-solving approaches

## Submission:
- Fork the provided repository and submit your completed challenge through a pull request.

## Resources:
- [Laravel Documentation](https://laravel.com/docs/11.x/installation)
- [Livewire Documentation](https://livewire.laravel.com/docs/quickstart)
- You may use online resources, but the work must be your own

**Note**: This challenge is designed to assess your problem-solving skills and ability to learn new technologies quickly. We value your unique approach and are interested in your thought process as much as the final result.
