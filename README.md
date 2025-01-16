# Coding Challenge: Laravel, PHP, and MySQL

Completed project management REST API using Laravel, PHP, and MySQL.

## Set Up Instructions

1. After cloning the project from Github, run `composer install` to install the required dependencies.
2. Create a `.env` file by running `cp .env.example .env`. Change the `DB_USERNAME` and `DB_PASSWORD` if needed.
3. Create an empty database named `project_management` or change the `DB_DATABASE` in the `.env` file.
4. Migrate the database by running `php artisan migrate:refresh --seed`.

## Running the application

To run the application, ensure your MySQL server is running and do `php artisan serve`.

## Comments on coding decisions

 - When I started working on this coding challenge, I first spent a lot of time reading through the laravel documentation to learn how Laravel worked since this was my first time working with Laravel. Although I have experience with Opencart using PHP, MySQL, and the MVC framework, many of the other features such as migrations, resources, and factories were new concepts to me.
 - For api calls to this application, I decided to add a header to the request to accept json responses using Middleware.
 - One part I was debating on was creating enums for the status codes. I was considering creating two new tables for project status codes and task status codes to have all the codes in each respective table. However, I decided to stick with enums and instead of having the database status columns being of type enum, I had them set to string so that more status codes could be easily added to the enums file under `app/Enums`.

## API Endpoints

This application has the following REST API endpoints:

**Projects**
 - `GET /api/projects` – List all projects.
    Request:
      No request body

    Response:
      Code 200: Success
      ```json
      {
          "data": [
              {
                  "id": 1,
                  "title": "tempora",
                  "description": "Sunt iste sit nihil. Consequatur non adipisci exercitationem officia minima natus rerum et. Inventore voluptatum assumenda culpa est.",
                  "status": "in_progress",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              },
              {
                  "id": 2,
                  "title": "ewfh",
                  "description": "Sunt iste sit nihil. Consequatur non adipisci exercitationem officia minima natus rerum et. Inventore voluptatum assumenda culpa est.",
                  "status": "in_progress",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              }
          ]
      }
      ```

 - `POST /api/projects` – Create a new project.
    Request:
      title (Required): Title of project
      description: Description of project
      status (Required): Status of project from the following status codes: 
        `["open", "in_progress", "completed"]`

      ```json
      {
          "title": "tempora",
          "description": "Sunt iste sit nihil. Consequatur non adipisci exercitationem officia minima natus rerum et. Inventore voluptatum assumenda culpa est.",
          "status": "in_progress",
      }
      ```

    Response:
      Code 201: Success
      ```json
      {
          "data": {
              "title": "aust",
              "description": "Suscipit dolore maiores quia impedit. Tempora facilis occaecati amet illum. Voluptatum aut delectus non asperiores veniam consequuntur eos.",
              "status": "completed",
              "updated_at": "2025-01-15T22:00:25.000000Z",
              "created_at": "2025-01-15T22:00:25.000000Z",
              "id": 12
          }
      }
      ```

      Code 422: Validation exception
      ```json
      {
          "success": false,
          "errors": {
              "title": [
                  "The title field is required."
              ],
              "status": [
                  "The status field is required."
              ]
          }
      }
      ```

 - `GET /api/projects/{id}` – Show details of a single project.
    Parameters:
      id: Id of project to show
  
    Request:
      No request body

    Response:
      Code 200: Success
      ```json
      {
          "data": {
              "id": 9,
              "title": "eum",
              "description": "Est qui excepturi quod quae veritatis. Consequatur id soluta esse laborum. Magni fuga provident debitis eius quia quia.",
              "status": "open",
              "created_at": "2025-01-15T21:13:38.000000Z",
              "updated_at": "2025-01-15T21:13:38.000000Z"
          }
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Project not found"
      }
      ```
 
 - `PUT /api/projects/{id}` – Update an existing project.
    Parameters:
      id: Id of project to update

    Request:
      title: Title of project
      description: Description of project
      status: Status of project from the following status codes: 
        `["open", "in_progress", "completed"]`

      ```json
      {
          "title": "tempora",
          "description": "Sunt iste sit nihil. Consequatur non adipisci exercitationem officia minima natus rerum et. Inventore voluptatum assumenda culpa est.",
          "status": "in_progress",
      }
      ```

    Response:
      Code 200: Success
      ```json
      {
          "data": {
              "id": 9,
              "title": "tempora",
              "description": "Sunt iste sit nihil. Consequatur non adipisci exercitationem officia minima natus rerum et. Inventore voluptatum assumenda culpa est.",
              "status": "in_progress",
              "created_at": "2025-01-15T21:13:38.000000Z",
              "updated_at": "2025-01-15T21:13:38.000000Z"
          }
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Project not found"
      }
      ```

      Code 422: Validation exception
      ```json
      {
          "success": false,
          "errors": {
              "status": [
                  "The selected status is invalid."
              ]
          }
      }
      ```
      
 - `DELETE /api/projects/{id}` – Delete a project.
    Parameters:
      id: Id of project to delete
  
    Request:
      No request body

    Response:
      Code 204: Success
      
      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Project not found"
      }
      ```

**Tasks**

 - `GET /api/tasks` – List all tasks (optional).
    Request:
      No request body

    Response:
      Code 200: Success
      ```json
      {
          "data": [
              {
                  "id": 1,
                  "project_id": 1,
                  "title": "illo",
                  "description": "Illo ea autem neque sint magnam. Dolores aut quasi illo. Inventore consequatur illum omnis eos distinctio illum.",
                  "assigned_to": "dolore",
                  "due_date": "2022-03-25",
                  "status": "in_progress",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              },
              {
                  "id": 2,
                  "project_id": 2,
                  "title": "cumque",
                  "description": "Aut sit consequatur quia hic. Labore recusandae molestias deleniti asperiores aliquam distinctio. Consequatur illum quo aut autem. Veritatis doloribus consequatur cupiditate nisi. Quia ipsam harum laborum odio odit.",
                  "assigned_to": "sit",
                  "due_date": "2002-08-05",
                  "status": "to_do",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              }
          ]
      }
      ```

 - `GET /api/projects/{project_id}/tasks` – List all tasks for a specific project.
    Parameters:
      project_id: Id of project to list all tasks for
      
    Request:
      No request body

    Response:
      Code 200: Success
      ```json
      {
          "data": [
              {
                  "id": 20,
                  "project_id": 11,
                  "title": "illo",
                  "description": "Illo ea autem neque sint magnam. Dolores aut quasi illo. Inventore consequatur illum omnis eos distinctio illum.",
                  "assigned_to": "dolore",
                  "due_date": "2022-03-25",
                  "status": "in_progress",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              },
              {
                  "id": 21,
                  "project_id": 11,
                  "title": "cumque",
                  "description": "Aut sit consequatur quia hic. Labore recusandae molestias deleniti asperiores aliquam distinctio. Consequatur illum quo aut autem. Veritatis doloribus consequatur cupiditate nisi. Quia ipsam harum laborum odio odit.",
                  "assigned_to": "sit",
                  "due_date": "2002-08-05",
                  "status": "to_do",
                  "created_at": "2025-01-15T21:13:38.000000Z",
                  "updated_at": "2025-01-15T21:13:38.000000Z"
              }
          ]
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Project not found"
      }
      ```

 - `POST /api/projects/{project_id}/tasks` – Create a new task under a project.
    Parameters:
      project_id: Id of project to create a new task for

    Request:
      title (Required): Title of task
      description: Description of task
      assigned_to: Person task is assigned to
      due_date: Due date of task
      status (Required): Status of task from the following status codes: 
        `["to_do", "in_progress", "done"]`

      ```json
      {
          "title": "new",
          "description": "Magnam sunt cum rerum quis rem. Enim ullam nulla qui ea tenetur. Enim fugit consequatur tenetur rem tempora maiores dolores. Tenetur quae cumque exercitationem aut.",
          "assigned_to": "consequuntur",
          "due_date": "2000-06-26",
          "status": "in_progress"
      }
      ```

    Response:
      Code 201: Success
      ```json
      {
          "data": {
              "title": "new",
              "description": "Magnam sunt cum rerum quis rem. Enim ullam nulla qui ea tenetur. Enim fugit consequatur tenetur rem tempora maiores dolores. Tenetur quae cumque exercitationem aut.",
              "assigned_to": "consequuntur",
              "due_date": "2000-06-26",
              "status": "in_progress",
              "project_id": 11,
              "updated_at": "2025-01-15T22:27:14.000000Z",
              "created_at": "2025-01-15T22:27:14.000000Z",
              "id": 24
          }
      }
      ```

      Code 422: Validation exception
      ```json
      {
          "success": false,
          "errors": {
              "title": [
                  "The title field is required."
              ],
              "status": [
                  "The selected status is invalid."
              ]
          }
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Project not found"
      }
      ```

 - `GET /api/tasks/{id}` – Show details of a single task.
    Parameters:
      id: Id of task to show

    Request:
      No request body

    Response:
      Code 200: Success
      ```json
      {
          "data": {
              "id": 11,
              "project_id": 8,
              "title": "voluptas",
              "description": "Sed ratione sunt nobis aut molestiae sint. Expedita ab molestias nobis deserunt iure vel reiciendis. Minus vitae quod voluptatem consequuntur provident non nihil doloremque. Ut corrupti est impedit optio totam officiis.",
              "assigned_to": "molestiae",
              "due_date": "2017-10-24",
              "status": "in_progress",
              "created_at": "2025-01-15T21:13:38.000000Z",
              "updated_at": "2025-01-15T21:13:38.000000Z"
          }
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Task not found"
      }
      ```

 - `PUT /api/tasks/{id}` – Update an existing task.
    Parameters:
      id: Id of task to update

    Request:
      project_id: Id of project to update to
      title: Title of task
      description: Description of task
      assigned_to: Person task is assigned to
      due_date: Due date of task
      status: Status of task from the following status codes: 
        `["to_do", "in_progress", "done"]`

      ```json
      {
          "project_id": 10,
          "title": "new",
          "description": "Magnam sunt cum rerum quis rem. Enim ullam nulla qui ea tenetur. Enim fugit consequatur tenetur rem tempora maiores dolores. Tenetur quae cumque exercitationem aut.",
          "assigned_to": "consequuntur",
          "due_date": "2000-06-26",
          "status": "in_progress"
      }
      ```

    Response:
      Code 200: Success
      ```json
      {
          "data": {
              "title": "new",
              "description": "Magnam sunt cum rerum quis rem. Enim ullam nulla qui ea tenetur. Enim fugit consequatur tenetur rem tempora maiores dolores. Tenetur quae cumque exercitationem aut.",
              "assigned_to": "consequuntur",
              "due_date": "2000-06-26",
              "status": "in_progress",
              "project_id": 10,
              "updated_at": "2025-01-15T22:27:14.000000Z",
              "created_at": "2025-01-15T22:27:14.000000Z",
              "id": 24
          }
      }
      ```

      Code 422: Validation exception
      ```json
      {
          "success": false,
          "errors": {
              "status": [
                  "The selected status is invalid."
              ]
          }
      }
      ```

      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Task not found"
      }
      ```

 - `DELETE /api/tasks/{id}` – Delete a task.
    Parameters:
      id: Id of task to delete
  
    Request:
      No request body

    Response:
      Code 204: Success
      
      Code 404: Not found
      ```json
      {
          "success": false,
          "message": "Task not found"
      }
      ```