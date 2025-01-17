## About TTI Project Management

This is my solution to the coding challenge presented by [TTI](https://tti.care).

- Made use of Laravel's ecosystem by implementing:
    - DB migrations with relationship and timestamps (also includes seeders)
    - Laravel ORM for projects and tasks table
    - Group related request handling via Controllers
    - Form Requests for validation the encapsuates their own logic
- Added the REST api endpoints, namely:
    - `/api/projects` for project GET, POST, PUT, and DELETE methods
    - `/api/tasks` for task GET, PUT, UPDATE, and DELETE methods
    - `/projects/{project_id}/tasks` for projects tasks GET & POST methods

## Run the Local Environment via Laravel Sail

1. Clone the repo:

    `git clone git@github.com:Coolai/TTI-Project-Management.git`

2. Make sure [Docker](https://www.docker.com) is installed in your machine.

3. Create the ENV file and update the database info to:

````
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
````

4. Run the Sail container to install the composer dependencies:

````
cd ./TTI-Project-Management

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
````

5. Run Sail by issuing:

    `./vendor/bin/sail up -d`

6. Generate the key, start the migration, and store test data:

````
./vendor bin/sail artisan key:generate

./vendor bin/sail artisan migrate

./vendor bin/sail artisan migrate db:seed --class=ProjectSeeder

./vendor bin/sail artisan migrate db:seed --class=TaskSeeder

````

7. You can now explore and test the API app at http://localhost/api/projects.