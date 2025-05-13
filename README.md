# Eshop Electronics - Laravel Project

This is the source code of an e-commerce website selling electronics, built with Laravel.

---

## Environmental requirements
- PHP >= 8.2
- Composer
- MySQL >= 5.7 / MariaDB >= 10.3

## Installation instructions

### 1. Clone source and checkout correct branch

> **Note:** The project is in the `laravel-project` branch, you need to checkout this branch after cloning.

**Steps to follow:**

1. Open Git Bash.
2. Clone repository to computer:
    ```bash
    git clone https://github.com/dvanhoang100904/eshop_electronics.git
    ```
3. Move to the project folder:
    ```bash
    cd eshop_electronics
    ```
4. Checkout into the `laravel-project` branch:
    ```bash
    git checkout laravel-project
    ```

### 2. Configure the `.env` environment

1. Install all Laravel dependencies:
    ```bash
    composer install
    ```
2. Copy the `.env.example` file to `.env`:
    ```bash
    cp .env.example .env
    ```
3. Generate key for Laravel application:
    ```bash
    php artisan key:generate
    ```

### 3. Create storage link (if there is a picture)

1. Create storage link:
    ```bash
    php artisan storage:link
    ```

### 4. Statements to create and delete tables and create sample data

1. Run the migrate command to create the table and seed sample data:
   
   Create table:
    ```bash
    php artisan migrate
    ```
    
   Delete table:
   ```bash
    php artisan migrate:rollback
    ```
   Or
   ```bash
    php artisan migrate:reset
    ```
    
   Create sample data:
    ```bash
    php artisan db:seed
    ```
    
   Create table + sample data:
    ```bash
    php artisan migrate --seed
    ```

   Delete table + create table:
    ```bash
    php artisan migrate:refresh
    ```
    
   Delete table + create table + create sample data
    ```bash
    php artisan migrate:refresh --seed
    ```

### 5. Run the application

1. Run the Laravel application:
    ```bash
    php artisan serve
    ```
    
After completing all the above steps, you can access the application at: [http://localhost:8000](http://localhost:8000).

### Admin test login account

http://127.0.0.1:8000/admin/login

**Admin**
- Email: admin@gmail.com
- Password: 123456

---

## Main directory structure

- `app/` - Main backend code of Laravel application
  - `app/Models/` - Models represent tables in a database
  - `app/Http/Controllers/` - Controllers process requests and return responses
  - `app/Http/Middleware/` - Middleware handles logic before/after the request is processed
  - `app/Http/Requests/` - Form requests are used to validate input data in a clear and separate manner
- `database/migrations/` - Migration files define the database table structure
- `database/seeders/` - Seed files to add sample data to the database
- `resources/views/` - Frontend interface written in Blade template
- `routes/web.php` - Define routes for web applications

---

## Contact

- Author: [Dao Van Hoang](https://github.com/dvanhoang100904)
