# TTI/WaveHealth Challenge
This repo contains a implementation of the coding 
challenge that implements the Project/Task project.

## Usage
Bundled in this repository is everything necessary 
to run this project, and utilizes 
[a container I built in the past, `jasoryeh/php-laravel`](https://github.com/jasoryeh/docker-collection/tree/master/php-laravel)
to quickly start up this project, if you do not 
have Docker installed or do not wish to use it, see the 
[non-Docker instructions below](#non-docker).

### Docker
Ensure your Docker engine is currently running 
first.

0. Clone this repository.
   * ```git clone https://github.com/jasoryeh/tti-challenge.git && cd tti-challenge```
1. Review the provided `docker-compose.yml`, 
   and configure any options you would like to 
   change or modify, see `.env.example` for 
   configurable variables.
2. Start the container with the provided `docker-compose.yml`
   * ```docker compose up```
   * This container provides:
     * The latest `mysql` container
       * No ports are exposed to the host here, however
         you may enable out-of-container access by uncommenting 
         the `ports` and `- '3306:3306'` lines by removing the 
         `#` prefixing those lines.
     * A `PhpMyAdmin` container for viewing the MySQL database
       * Avaialble at http://127.0.0.1:8081
     * The project
       * Available at http://127.0.0.1:80
3. Done.
   * The container should boot up, install all dependencies 
     for you and seed the database with the `ChallengeSeeder`
   * Should you wish to execute `artisan` or other commands,
     you can enter the container via 
     * `docker compose exec -it project bash`
     * then `cd /home/container/app` to see the project directory

### Non-Docker
0. Clone the repository with the same clone command as the 
   one in the [Docker](#docker) instructions.
1. Standard Laravel project setup applies:
   * Install a PHP version preferably `>8.0`, I used `8.2`
   * Ensure `composer` is installed
   * then,
     * Install dependencies:
       * ```composer install```
     * Create a `.env` file from defaults.
       * ```cp .env.example .env```
     * Create an application key:
       * ```php artisan key:generate```
2. Modify your `.env` to adjust properties prefixed with 
   `DB_` to contain your database credentials.
3. Seed the database
   * See [seeders](#seeders)
4. Start the project!
   * If for development/testing purposes, you can use:
     * the built in composer run:
       * `composer run dev`
     * the Laravel-provided development server
       * `php artisan serve`
   * If you have [Laravel Herd](https://herd.laravel.com/)
     * `herd link`
     * Then go to the Herd-configured `.test` site, usually 
       http://tti-challenge.test
   * If you are using a web server, such as `NGINX` or `Apache`
     * Ensure you have `php-fpm` of the relevant version
     * Follow your web server/proxy instructions for serving Laravel projects.

## Testing
This project uses `PEST` as it's test suite. Challenge 
requirements and seeders are prefixed with `Challenge` 
in their name.

### Seeders
The seeder that seeds for the basic requirements is located 
in `database/seeders/ChallengeSeeder.php`, to execute it:

* To seed with challenge defaults:
    * ```php artisan db:seed --class=ChallengeSeeder```
* To seed with custom amounts of project, use environment variables:
    * ```PROJECTS=5 TASK_MIN=1 TASK_MAX=10 php artisan db:seed --class=ChallengeSeeder```

### Data Generators
Fake data is generated for testing at `database/factories`

### Tests
Tests for the challenge requirements are located in the 
`tests` directory, files prefixed with `Challenge` indicate
challenge requirement tests.

### Running
In the relevant environment's shell (Docker/Host):
```php artisan test```

## Endpoints
The project implements the following endpoints:

### Projects

#### GET `/api/projects` - List all Projects
Request:
- `page`: The page number to view, see `first_page_url`, `last_page_url`, `next_page_url`, `links` for available pages.

Response: A response with paginated results. See `data` for Project list.
```json
{
	"current_page": 1,
	"data": [
		{
			"id": 1,
			"title": "Non ut id facilis recusandae enim nulla.",
			"description": "Vitae enim iure est doloribus voluptates repellendus. Enim provident modi voluptas rerum ipsum fugiat maiores. Iure doloremque iusto autem eveniet ipsa.",
			"status": "completed",
			"created_at": "2025-01-13T19:12:59.000000Z",
			"updated_at": "2025-01-13T19:12:59.000000Z"
		}, ...
	],
	"first_page_url": "http:\/\/tti-challenge.test\/api\/projects?page=1",
	"from": 1,
	"last_page": 23,
	"last_page_url": "http:\/\/tti-challenge.test\/api\/projects?page=23",
	"links": [
		{
			"url": null,
			"label": "&laquo; Previous",
			"active": false
		},
		{
			"url": "http:\/\/tti-challenge.test\/api\/projects?page=1",
			"label": "1",
			"active": true
		}, ...
	],
	"next_page_url": "http:\/\/tti-challenge.test\/api\/projects?page=2",
	"path": "http:\/\/tti-challenge.test\/api\/projects",
	"per_page": 15,
	"prev_page_url": null,
	"to": 15,
	"total": 336
}
```

#### GET `/api/projects/{id}` - Get Project Details
Request: No request options are available for this request.

Response:
```json
{
	"id": 1,
	"title": "Non ut id facilis recusandae enim nulla.",
	"description": "Vitae enim iure est doloribus voluptates repellendus. Enim provident modi voluptas rerum ipsum fugiat maiores. Iure doloremque iusto autem eveniet ipsa.",
	"status": "completed",
	"created_at": "2025-01-13T19:12:59.000000Z",
	"updated_at": "2025-01-13T19:12:59.000000Z"
}
```


#### GET `/api/projects/{id}/tasks` - List Tasks for this Project
Request: 
- `page`: The page number to view, see `first_page_url`, `last_page_url`, `next_page_url`, `links` for available pages.

Response:
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "project_id": 1,
            "title": "Dolorum sed dolorem qui sint ex velit.",
            "description": "Et expedita eveniet voluptas pariatur laborum expedita deleniti. Quam inventore id exercitationem praesentium et laboriosam beatae deserunt. Hic sunt consequuntur pariatur dolorum consequatur.",
            "assigned_to": "Kaylie Jast",
            "due_date": "2001-12-03 21:20:57",
            "status": "in_progress",
            "created_at": "2025-01-13T19:12:59.000000Z",
            "updated_at": "2025-01-13T19:12:59.000000Z"
        }, ...
    ],
    "first_page_url": "http:\/\/tti-challenge.test\/api\/projects\/1\/tasks?page=1",
    "from": 1,
    "last_page": 15,
    "last_page_url": "http:\/\/tti-challenge.test\/api\/projects\/1\/tasks?page=15",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http:\/\/tti-challenge.test\/api\/projects\/1\/tasks?page=1",
            "label": "1",
            "active": true
        }, ...
    ],
    "next_page_url": "http:\/\/tti-challenge.test\/api\/projects\/1\/tasks?page=2",
    "path": "http:\/\/tti-challenge.test\/api\/projects\/1\/tasks",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 222
}
```

#### POST `/api/projects/` - Create Project
Request:
```json
{
	"title": "required: a string",
	"description": "optional: a string",
	"status": "required: a string, one of: open, in_progress, completed"
}
```

Response:
```json
{
	"id": 1,
	"title": "Non ut id facilis recusandae enim nulla.",
	"description": "Vitae enim iure est doloribus voluptates repellendus. Enim provident modi voluptas rerum ipsum fugiat maiores. Iure doloremque iusto autem eveniet ipsa.",
	"status": "completed",
	"created_at": "2025-01-13T19:12:59.000000Z",
	"updated_at": "2025-01-13T19:12:59.000000Z"
}
```

#### PUT `/api/projects/{id}` - Update Project
Request:
```json
{
	"title": "optional: a string",
	"description": "optional: a string",
	"status": "optional: a string, one of: open, in_progress, completed"
}
```

Response:
```json
{
	"id": 1,
	"title": "Non ut id facilis recusandae enim nulla.",
	"description": "Vitae enim iure est doloribus voluptates repellendus. Enim provident modi voluptas rerum ipsum fugiat maiores. Iure doloremque iusto autem eveniet ipsa.",
	"status": "completed",
	"created_at": "2025-01-13T19:12:59.000000Z",
	"updated_at": "2025-01-13T19:12:59.000000Z"
}
```

#### DELETE `/api/projects/{id}` - Delete Project
Request: No request options are available for this route.

Response:
```json
{
	"id": 1,
	"title": "Non ut id facilis recusandae enim nulla.",
	"description": "Vitae enim iure est doloribus voluptates repellendus. Enim provident modi voluptas rerum ipsum fugiat maiores. Iure doloremque iusto autem eveniet ipsa.",
	"status": "completed",
	"created_at": "2025-01-13T19:12:59.000000Z",
	"updated_at": "2025-01-13T19:12:59.000000Z"
}
```

### Tasks

#### GET `/api/tasks` - List all Tasks
Request:
- `page`: The page number to view, see `first_page_url`, `last_page_url`, `next_page_url`, `links` for available pages.

Response: A response with paginated results. See `data` for Project list.
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "project_id": 1,
            "title": "Dolorum sed dolorem qui sint ex velit.",
            "description": "Et expedita eveniet voluptas pariatur laborum expedita deleniti. Quam inventore id exercitationem praesentium et laboriosam beatae deserunt. Hic sunt consequuntur pariatur dolorum consequatur.",
            "assigned_to": "Kaylie Jast",
            "due_date": "2026-12-03 21:20:57",
            "status": "in_progress",
            "created_at": "2025-01-13T19:12:59.000000Z",
            "updated_at": "2025-01-13T19:12:59.000000Z"
        }, ...
    ],
    "first_page_url": "http:\/\/tti-challenge.test\/api\/tasks?page=1",
    "from": 1,
    "last_page": 68,
    "last_page_url": "http:\/\/tti-challenge.test\/api\/tasks?page=68",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http:\/\/tti-challenge.test\/api\/tasks?page=1",
            "label": "1",
            "active": true
        }, ...
    ],
    "next_page_url": "http:\/\/tti-challenge.test\/api\/tasks?page=2",
    "path": "http:\/\/tti-challenge.test\/api\/tasks",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 1010
}
```

#### GET `/api/tasks/{id}` - Get Task Details
Request: No request options are available for this request.

Response:
```json
{
    "id": 1,
    "project_id": 1,
    "title": "Dolorum sed dolorem qui sint ex velit.",
    "description": "Et expedita eveniet voluptas pariatur laborum expedita deleniti. Quam inventore id exercitationem praesentium et laboriosam beatae deserunt. Hic sunt consequuntur pariatur dolorum consequatur.",
    "assigned_to": "Kaylie Jast",
    "due_date": "2026-12-03 21:20:57",
    "status": "in_progress",
    "created_at": "2025-01-13T19:12:59.000000Z",
    "updated_at": "2025-01-13T19:12:59.000000Z"
}
```

#### POST `/api/tasks` - Create Task
Request:
```json
{
    "project_id":  /* required, integer, a Project ID */,
    "title": "required, string",
    "description": "optional, string",
    "assigned_to": "optional, string",
    "due_date": "optional, date/datetime",
    "status": "required, string, one of: to_do, in_progress, done"
}
```

#### PUT `/api/tasks/{id}` - Update Task
Request:
```json
{
    "project_id":  /* optional, integer, a Project ID */,
    "title": "optional, string",
    "description": "optional, string",
    "assigned_to": "optional, string",
    "due_date": "optional, date/datetime",
    "status": "optional, string, one of: to_do, in_progress, done"
}
```

Response:
```json
{
    "id": 1,
    "project_id": 1,
    "title": "Dolorum sed dolorem qui sint ex velit.",
    "description": "Et expedita eveniet voluptas pariatur laborum expedita deleniti. Quam inventore id exercitationem praesentium et laboriosam beatae deserunt. Hic sunt consequuntur pariatur dolorum consequatur.",
    "assigned_to": "Kaylie Jast",
    "due_date": "2026-12-03 21:20:57",
    "status": "in_progress",
    "created_at": "2025-01-13T19:12:59.000000Z",
    "updated_at": "2025-01-13T19:12:59.000000Z"
}
```

#### DELETE `/api/tasks/{id}` - DELETE Task
Request: No request options are avaialble for this route.

Response:
```json
{
    "id": 1,
    "project_id": 1,
    "title": "Dolorum sed dolorem qui sint ex velit.",
    "description": "Et expedita eveniet voluptas pariatur laborum expedita deleniti. Quam inventore id exercitationem praesentium et laboriosam beatae deserunt. Hic sunt consequuntur pariatur dolorum consequatur.",
    "assigned_to": "Kaylie Jast",
    "due_date": "2026-12-03 21:20:57",
    "status": "in_progress",
    "created_at": "2025-01-13T19:12:59.000000Z",
    "updated_at": "2025-01-13T19:12:59.000000Z"
}
```


## Design
This project is implemented to keep the implementation as simple as possible.

Among features/tools used include:
- [Resource Controllers](#resource-controllers)
- [Validation](#validation)
- [Docker](#docker)

### Resource Controllers
Resource controllers are routes that the Laravel
project pre-defines for CRUD operations on resources,
in this case the `Project` and `Task` models.

### Validation
Validation is provided via Laravel-included validators. 
See the controllers (ProjectController and TaskController) 
for more information.

### Docker
To simplify testing and make reproducibility easier,
Docker Compose and Docker Container files are provided
to create a testing environment.

