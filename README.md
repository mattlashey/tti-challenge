===========================================================================================
01. INITIAL PROJECT SETUP
===========================================================================================
 1. Create a New Laravel Project:
	Run the following command to create a new Laravel project:
	---------------------------------------------------------------
	| composer create-project laravel/laravel project-management  |
	---------------------------------------------------------------
	
 2. Go to "project-management" folder. Update following fields in .env File
	APP_NAME=project-management
	APP_URL=http://localhost
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=project_management
	DB_USERNAME=root
	DB_PASSWORD=
	
 3. Generate Application Key:
	Run this command to generate a unique application key:
	------------------------------
	| php artisan key:generate   |
	------------------------------
	This sets the APP_KEY in your .env file, which is critical for security.
	This command generates artisan file.
===========================================================================================
02. DATABASE SETUP, DATABASE SEEDING AND MIGRATIONS
===========================================================================================
 Execute (4) and (5) for first time -
 4. For our schema, you need two migration files:
	a) projects table
		----------------------------------------------------
		| php artisan make:migration create_projects_table |
		----------------------------------------------------
		This will generate files in the database/migrations directory, with name "2025_01_14_000000_create_projects_table.php"
	b) tasks table
		-------------------------------------------------
		| php artisan make:migration create_tasks_table |
		-------------------------------------------------
		This will generate files in the database/migrations directory, with name "2025_01_14_000001_create_tasks_table.php"
		
 5. Define Schemas in php in these files - "2025_01_14_000000_create_projects_table.php" and 
	"2025_01_14_000001_create_tasks_table.php"
	
 6. Create Seeders for the tables of projects, tasks.
	a)  ------------------------------------------
		| php artisan make:seeder ProjectSeeder  |
		------------------------------------------
	b)  ---------------------------------------
		| php artisan make:seeder TaskSeeder  |
		---------------------------------------
		
 7. Update Sample Data in run() function of ProjectSeeder and TaskSeeder
 
 8. Run Migrations using:
	-----------------------
	| php artisan migrate |
	-----------------------
	This will create three tables in the database of "project-management" - migration table(for maintaining table version history),
	sessions (table) and other two are projects table and tasks table.
 
 9. Execute Database Seeding:
	-----------------------
	| php artisan db:seed |
	-----------------------
 10. For re-execute,
	--------------------------------------
	| php artisan migrate:refresh --seed |
	--------------------------------------
	
==========================================================================================
03. CREATE MODELS
==========================================================================================
 11. Create a Model for Project Table in app/Models/Project.php
	----------------------------------
	| php artisan make:model Project |
	----------------------------------
	
 12. Create a Model for Task Table in app/Models/Task.php
	-------------------------------
	| php artisan make:model Task |
	-------------------------------
 
==========================================================================================
04. CREATE CONTROLLER
==========================================================================================
 13. Create a Controller for CSRF Token Genrin app/Http/Controllers/TokenController.php using Command:
	 -----------------------------------------------
	 | php artisan make:controller TokenController |
	 -----------------------------------------------
 
 14. Create a Controller for Project Table in app/Http/Controllers/ProjectController.php using Command:
	 -------------------------------------------------
	 | php artisan make:controller ProjectController |
	 -------------------------------------------------
	
 15. Create a Controller for Task Table in app/Http/Controllers/TaskController.php using Command:
	----------------------------------------------
	| php artisan make:controller TaskController |
	----------------------------------------------
	
 16. Add routing in routes/web.php

=========================================================================================
05. START THE DEVELOPMENT SERVER
=========================================================================================
 17. Clear the route when something is updated
	---------------------------
	| php artisan route:clear |
	---------------------------
	| php artisan route:cache |
	---------------------------
 
 18. Run the development server:
	----------------------
	| php artisan serve  |
	----------------------
==========================================================================================
06. TESTING
==========================================================================================
 19. Create Factory Files for Project
	 -----------------------------------------------------------
	 | php artisan make:factory ProjectFactory --model=Project |
	 -----------------------------------------------------------
	 ------------------------------------------------------
	 | php artisan make:factory TaskFactory --model=Task  |
	 ------------------------------------------------------
 20. Creating Test Files -
	 -----------------------------------------
	 | php artisan make:test ProjectApiTest  |
	 -----------------------------------------
	 -------------------------------------
	 | php artisan make:test TaskApiTest |
	 -------------------------------------
 21. Executing Tests for the project -
	 ---------------------
	 |  php artisan test |
	 ---------------------
===========================================================================================
ADDITIONAL INFORMATION
===========================================================================================
a) app/Http/Controllers - This is the entry point of the API
b) app/Http/Models - These Files are the Models of the tables
c) database/factories - These are Fake Files used for Testing.
d) database/migrations - These contains table schemas of the DATABASE
e) database/seeders - These contains the inital data required to load into table Schemas
f) routes/web.php - These contains API routes
g) tests/Feature - It is for Testing APIs

