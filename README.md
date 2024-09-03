
# Library Management System

# Overview
This project is a Library Management System built using Laravel framework. The system allows users to manage books, borrow records, ratings, and user accounts. Administrators have additional control over the system's functionalities. The application also supports JWT-based authentication for user management.

## Features

- **User Authentication**: Secure login and registration using JWT authentication.
- **Role Management**: Users can have roles like `admin` or `user`.
- **Book Management**: CRUD operations for books, including filtering by author, category, and availability.
- **Borrowing System**: Track borrowed books, due dates, and return dates.
- **Rating System**: Users can rate and review books.
- **Database Seeding**: Predefined users and books for quick setup.

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/zzeeii/Task4.git
    cd Task4
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    ```

3. **Create `.env` file:**

    Copy the `.env.example` to `.env` and update the necessary environment variables.

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Update the `.env` file:**

    Make sure to set up your database configuration in the `.env` file:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=library
    DB_USERNAME=root
    DB_PASSWORD=

    
    JWT_SECRET=bPOeNOHCOuJ0DdH8NA3oq5CnbhQ2yiCRYNhntj4JZtLYFk5oVStt5zbiDXY6bSYS
    ```

5. **Run migrations and seed the database:**

    ```bash
    php artisan migrate --seed
    ```

6. **Run the development server:**

    ```bash
    php artisan serve
    ```

    The application will be accessible at [http://localhost:8000](http://localhost:8000).

## API Endpoints

### Authentication

- **Login:** `POST /api/login`
- **Register:** `POST /api/register`
- **Logout:** `POST /api/logout`
- **Refresh Token:** `POST /api/refresh`

### Users

- **List Users:** `GET /api/users`
- **Show User:** `GET /api/users/{id}`
- **Update User:** `PUT /api/users/{id}`
- **Delete User:** `DELETE /api/users/{id}`

### Books

- **List Books:** `GET /api/books`
- **Show Book:** `GET /api/books/{id}`
- **Create Book:** `POST /api/books`
- **Update Book:** `PUT /api/books/{id}`
- **Delete Book:** `DELETE /api/books/{id}`

### Borrow Records

- **List Borrow Records:** `GET /api/borrow-records`
- **Show Borrow Record:** `GET /api/borrow-records/{id}`
- **Create Borrow Record:** `POST /api/borrow-records`
- **Update Borrow Record:** `PUT /api/borrow-records/{id}`
- **Delete Borrow Record:** `DELETE /api/borrow-records/{id}`

### Ratings

- **Create Rating:** `POST /api/ratings`
- **Update Rating:** `PUT /api/ratings/{id}`
- **Delete Rating:** `DELETE /api/ratings/{id}`

## Code Structure

- **Models:** Located in the `app/Models` directory.
- **Controllers:** Located in the `app/Http/Controllers` directory.
- **Services:** Business logic is encapsulated in services located in the `app/Services` directory.
- **Migrations:** Located in the `database/migrations` directory.
- **Seeders:** Located in the `database/seeders` directory.

## Database Schema

### Users

- `id` - Primary Key
- `name` - User's name
- `email` - User's email (unique)
- `password` - User's password (hashed)
- `role` - Role of the user (`user`, `admin`)
- `remember_token` - Token for "remember me" functionality
- `created_at` & `updated_at` - Timestamps

### Books

- `id` - Primary Key
- `title` - Title of the book
- `author` - Author of the book
- `category` - Category of the book
- `is_available` - Availability status
- `description` - Description of the book
- `published_at` - Publication date
- `created_at` & `updated_at` - Timestamps

### Ratings

- `id` - Primary Key
- `user_id` - Foreign Key referencing Users
- `book_id` - Foreign Key referencing Books
- `rating` - Rating value (1-5)
- `review` - Optional review text
- `created_at` & `updated_at` - Timestamps

### Borrow Records

- `id` - Primary Key
- `user_id` - Foreign Key referencing Users
- `book_id` - Foreign Key referencing Books
- `borrowed_at` - Date when the book was borrowed
- `due_date` - Date when the book is due
- `returned_at` - Date when the book was returned
- `created_at` & `updated_at` - Timestamps

## Seeders
UsersTableSeeder: Seeds the users table with an initial admin user (name: zein, email: z@gmail.com, password: 123456).


