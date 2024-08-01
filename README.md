# TTI Interview challenge

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
