## Documentation Contents

- [About code](#about-code)
- [Installation and configuration](#installation)
- [Running the app](#running-the-app)
- [Swagger REST API Documentation](#rest-api---swagger)
- [Postman REST API Collection](#rest-api---postman-collection)

## About Code
- Used single action controllers for keeping the code clean and more maintainable
- Added Swagger API docs for easily accessing the API endpoints and testing them
- Covered the REST API endpoints with tests (can be found in Feature test)
- Used Eloquent’s API resources for json response management
- Handles errors for API endpoints, returning error messages and status codes
- Implemented Request validation through Form Requests

## Installation
1. You need to install all prerequisites to run Laravel applications on your machine
2. Clone the project from GitHub
3. Run the following commands in the project's root folder to install dependencies

```shell
composer install
```

4. Create .env file, copy the contents of `.env.example` to your `.env` file and change the following lines in your `.env` file for your database connection

```dotenv
DB_CONNECTION=YOUR_DB_PROVIDER
DB_HOST=127.0.0.1
DB_PORT=YOUR_DB_PORT
DB_DATABASE=YOUR_DB_NAME
DB_USERNAME=YOUR_DB_USERNAME
DB_PASSWORD=YOUR_DB_PASSWORD
```
DB Providers sample configs: mysql (port: 3306), pgsql (port: 5432)

5. Run the migrations and seeders
```shell
php artisan migrate:refresh --seed
```

## Running the app
Run the app using following command
```shell
php artisan serve
```

## REST API - Swagger
In order to access OPEN API documentation using Swagger, follow the instructions:
1. After running `php artisan serve` in the command line, do not exit the command line, just switch to your browser.
2. Open your browser and visit http://localhost:8000/api/documentation 

## REST API - Postman collection
In order to access API using Postman, follow the instructions:
1. After running `php artisan serve` in the command line, do not exit the command line, just switch to Postman.
2. Download the API collection [here](/storage/api-docs/api-docs.json) or import it directly from [storage/api-docs/api-docs.json](storage/api-docs/api-docs.json)
3. Import to Postman
4. Configure the environment variables
5. Now you can test the API endpoints located in Projects and Tasks folders
