# TTI Interview Submission

## Statement

While I've used Laravel in the past, Livewire and Filament were both new for me. Livewire feels very similar to Vue, but the primary learning curve came from
doing things the 'Laravel way'. While my result is functional, there's certainly room for improvement.

## Approach

Most implementations were followed adhering to the documentation. Laravel's CLI is a joy to use and streamlines a lot of boilerplate.

In general, since folder structure, configurations, and overall strategy are mostly handled by all of Laravel's tooling, it was primarily an
exercise in aligning all of the tooling to work together.

## Outcome

Each functionality was completed through Filament + Livewire. Initially, I was concerned that search performance could potentially be a bottleneck, but I installed
[DebugBar](https://github.com/barryvdh/laravel-debugbar) and saw each query was easily under 1ms. I tested up to 10,000 patients and still, query times were ~5ms at worst, and ~10ms when sorting by birth date. Within the realm of acceptable speed, and that's without trying to optimize e.g. adding indexes.

Overall, Filament handled the heavy lifting. I made some minor UI/UX modifications (changing row color on hover, adjusting table widths, etc.) from there.

## Challenges

Unlike something like React, where you have a lot of "low level" (if you can call it that) control over the DOM and UI components, Filament + Livewire abstract a lot of
it away. That + Laravel's "magic" mean it can be tricky to find where and how to modify certain specific behavior. It took a few minutes for my mental model to catch up;
sometimes you need to jump into a blade template to change something, sometimes you need to find the underlying class.

Working with Filament is smooth, until you have a specific use case...then it can be a bit tricky. Their documentation appears to be written with the idea that it should be plug and play, and there's some gaps in customizing certain behaviors. For example, I was interested in modifying the icon next to 'Birth date' to be a loading spinner that reverted back to the angled bracket once the UI was updated. However, I couldn't quite pinpoint how to inject my own SVG into it, and my initial solution (publishing the asset and modifying it from there) was pointed out as a poor practice in their docs, which does make sense.

## FAQ

-   Why aren't your tests working?

While I'm a big fan of writing tests, I ran into a few issues with the testing suite. Documentation was a challenge here, as Filament and Livewire default to 2 different test
frameworks, and there's a specific way that your DB should be used via dependency injection. I couldn't quite figure out how to link everything together.

I do believe frontend tests are advisable, even though some may disagree since things can be visually QA'd. If nothing else, it's a good sanity check to ensure no major regressions happen during deployments.

-   Is using a UI library instead of creating the tables from scratch a good measure of skill?

In my opinion, yes. Even if I didn't write it from scratch, I think that parsing documentation, understanding UI fundamentals, and navigating new tools is a skill that it validates pretty effectively. You definitely don't wanna use it as a crutch, but realistically in a production environment I think using a library/package/etc as a launching
pad and customizing it from there gives a great return on time spent.

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

-   Use Laravel's built-in features for database interactions
-   Implement the table using Livewire for dynamic updates without page reloads
-   Follow Laravel and PHP best practices for code organization and structure

## Expectations:

1. Functionality: All required features should work correctly
2. Code Quality: Write clean, well-commented, and organized code
3. User Experience: Create an intuitive and responsive interface
4. Problem-Solving: Demonstrate ability to overcome challenges and find solutions
5. Learning Ability: Show proficiency in using unfamiliar technologies (Laravel and Livewire)

## Evaluation Criteria:

-   Completeness of implemented features
-   Code structure and adherence to best practices
-   Efficiency of database queries and overall performance
-   User interface design and responsiveness
-   Creativity in problem-solving approaches

## Submission:

-   Fork the provided repository and submit your completed challenge through a pull request.

## Resources:

-   [Laravel Documentation](https://laravel.com/docs/11.x/installation)
-   [Livewire Documentation](https://livewire.laravel.com/docs/quickstart)
-   You may use online resources, but the work must be your own

**Note**: This challenge is designed to assess your problem-solving skills and ability to learn new technologies quickly. We value your unique approach and are interested in your thought process as much as the final result.
