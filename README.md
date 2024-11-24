# Book Management API

This Laravel RESTful API, named "book_management_system", allows you to manage books, authors, categories, and related operations. The system includes user authentication for admins and authors, book management (CRUD), category management, and token expiration for admins after inactivity.
## Desgin Pattern 
  - Service Repository Design Pattern.

## Features

- **User Authentication:**
  - Authenticate users (Admins and Authors) using email and password.
  - Admins and Authors can log in to the system to receive a JWT token.

- **Admin Features:**
  - **Admin Role:**
    - Admins can create, update, and delete authors.
    - Admins can create, update, and delete categories.
    - Admins can retrieve all books in the system and filter them by author.
    - Admin tokens expire after 15 minutes of inactivity and need to log in again.

- **Author Features:**
  - **Create, Update, and Delete Books:**
    - Authors can add books, but only their own books can be edited or deleted.
    - Authors can update book details such as title, description, published date, bio, and cover.
  - **Export and Import Books:**
    - Authors can export their books as an Excel file.
    - Authors can import books from Excel or CSV files, attaching them to their account.
  - **Search and Filter Books:**
    - Authors can search for books by title or description.
    - Admins can filter books by author ID and view details of each book including the author’s information.

- **Role-Based Access Control:**
  - **Admins:**
    - Admins can manage users, authors, categories, and all books in the system.
    - Admins have full access to all system resources, including book filtering and admin token management.
  - **Authors:**
    - Authors can only manage their own books.
    - Authors can only view and edit books they’ve created.
    - Authors can import and export their own books.
    - Authors can search for their own books by title or description.
    - Authors can update only the status of their books.

- **Category Management:**
  - Admins can create and manage categories that authors can assign books to.
  - Categories help organize books by type, genre, etc.

- **Token Expiration:**
  - Admin’s token expires after 15 minutes of inactivity, requiring re-login.


## Prerequisites

Before you begin, make sure you have the following installed:

- **PHP** >= 8.2
- **Composer** (for managing PHP dependencies)
- **Laravel** >= 10 (for the backend framework)
- **MySQL** (for database management)
- **Postman** (for API testing)
- **Excel or CSV file reader** (for importing/exporting books)

## Setup Instructions

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/AhmedHassan199/task_management_system.git
    cd task_management_system
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

    This will install the required PHP dependencies listed in `composer.json`, including:
    - `laravel/sanctum` (for API authentication and token management)
    - `meetawebsite/laravel` (for SEO optimization and meta tags management)
    - Other necessary packages for Laravel to run smoothly.

3. **Configure Environment:**

    - Duplicate the `.env.example` file and rename it to `.env`.
    - Configure your database settings in the `.env` file.
    - Make sure you set the appropriate `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` values for your MySQL setup.

4. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

    This will generate the application key for Laravel to encrypt data and sessions.

5. **Run Migrations and Seeders:**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

    This will create the necessary database tables and seed initial data for the application (including the admin user and necessary roles).

6. **Start the Development Server:**

    ```bash
    php artisan serve
    ```

    This will start the Laravel development server at `http://127.0.0.1:8000`, and you can begin testing the API endpoints.

---

**Note:** If you're using **Sanctum** for authentication, you must set up your front-end or Postman to send the authentication token in the request headers. You can find more details on Sanctum setup in the [official Laravel Sanctum documentation](https://laravel.com/docs/9.x/sanctum).

If you're using **meetawebsite** for meta tag optimization, ensure your configuration is set properly in the `config/meetawebsite.php` file to generate SEO-friendly meta tags for your app.


# Entity-Relationship Diagram (ERD) Description

## Users
**Attributes:**
- `id` (Primary Key)
- `name`
- `email`
- `password`
- `role` (Enum: 'admin', 'author')
- `created_at`
- `updated_at`

## Authors
**Attributes:**
- `id` (Primary Key)
- `user_id` (Foreign Key referencing `users.id`)
- `name`
- `email`
- `password`
- `created_at`
- `updated_at`

## Categories
**Attributes:**
- `id` (Primary Key)
- `name` (Required, string, min 2, max 100 characters)
- `created_at`
- `updated_at`

## Books
**Attributes:**
- `id` (Primary Key)
- `author_id` (Foreign Key referencing `authors.id`)
- `category_id` (Foreign Key referencing `categories.id`)
- `title` (Required, string, min 2, max 100 characters)
- `description` (Required, text, min 5, max 500 characters)
- `published_at` (Date)
- `bio` (Required, text, min 5, max 500 characters)
- `cover` (Image, allowed extensions: PNG, JPG, JPEG, WebP)
- `created_at`
- `updated_at`



## Summary of Relationships

**Users and Authors:**
- One-to-One: A user can be associated with only one author, and each author corresponds to one user.
- This is facilitated through the `user_id` column in the `authors` table, referencing the `users` table.

**Authors and Books:**
- One-to-Many: An author can have many books, but a book can only be written by one author.
- This is achieved through the `author_id` column in the `books` table, referencing the `authors` table.

**Categories and Books:**
- One-to-Many: A category can contain many books, but each book belongs to only one category.
- This is facilitated through the `category_id` column in the `books` table, referencing the `categories` table.

**Books and Authors (via Book_Authors table):**
- Many-to-Many: Books can have multiple authors, and authors can write multiple books.
- This is facilitated by the `book_authors` pivot table, which connects `books` and `authors`.

## Default Laravel Tables
- `users` (Default Laravel users table)
- `migrations` (Default Laravel migrations table)
- `failed_jobs` (Default Laravel failed jobs table)

## Default Sanctum Tables
- `personal_access_tokens` (Default Sanctum personal access tokens table)

## Import Postman Collection

- Download the [Postman Collection](<Documets/Version 1.0.postman_collection.json>) file.
- Click here for Postman documentation: [Postman Public](https://documenter.getpostman.com/view/33037615/2sA3XPENr3).

1. Open Postman.

2. Click on "Import" in the top-left corner.

3. Upload the downloaded Postman Collection file.

## API Requests
Follow the steps below to test API requests using the Postman collection:
Download the [API DOC](<Documets/Book Management API Documentation.pdf>) file.
