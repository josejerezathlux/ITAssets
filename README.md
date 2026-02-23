<<<<<<< HEAD
# IT Assets Manager

Web app to track company devices and equipment: laptops, monitors, phones, and the like. You get asset records, categories, rooms, check-in/check-out to employees, maintenance logs, attachments, and role-based access. Reports are available as printable HTML.

**Stack:** Laravel 11, MySQL, Bootstrap 5, Chart.js. Auth via Laravel Breeze.

## Requirements

- PHP 8.1+
- Composer
- MySQL 5.7+ or MariaDB
- Extensions: `fileinfo`, `openssl`, `mbstring`, `pdo_mysql`

## Setup

1. Clone the repo and install dependencies:

   ```bash
   composer install
   ```

2. Environment:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   In `.env` set your DB name, user, and password. Default for local (e.g. XAMPP): `DB_DATABASE=devices`, `DB_USERNAME=root`, `DB_PASSWORD=`.

3. Database. Either run migrations:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

   Or create the schema from the skeleton SQL (no seed data):

   ```bash
   mysql -u root -p < database/skeleton.sql
   ```

   Then run seeders only if you used the SQL file:

   ```bash
   php artisan db:seed
   ```

4. Storage link (for uploads and QR):

   ```bash
   php artisan storage:link
   ```

5. Run the app: point your web server at the `public` directory, or use `php artisan serve` and open `http://127.0.0.1:8000`.

## Test logins (after seeding)

| Email                  | Password | Role       |
|------------------------|----------|------------|
| admin@example.com      | password | Admin      |
| technician@example.com | password | Technician |
| viewer@example.com     | password | Viewer     |

If you don’t seed users, the first account you register gets the Admin role.

## Packages (added to base Laravel)

- **laravel/breeze** – login, registration, session auth
- **laravel/sanctum** – API token auth (optional)
- **simplesoftwareio/simple-qrcode** – QR codes for asset links

## Database skeleton

`database/skeleton.sql` creates the `devices` database and all tables (structure only). Use it for a clean install. It does not drop or change existing data.
=======
# IT Assets

Tracks devices, rooms, employees, and digital licenses. Laravel 11, MySQL, Bootstrap 5. Auth via Breeze.

**Requirements:** PHP 8.1+, Composer, MySQL. Extensions: `fileinfo`, `openssl`, `mbstring`, `pdo_mysql`.

**Deploy:**

1. `composer install`
2. `cp .env.example .env` then `php artisan key:generate`
3. Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`
4. `php artisan migrate`
5. `php artisan storage:link`
6. Point the web server at the `public` folder (or run `php artisan serve`)

First user to register gets the Admin role.
>>>>>>> ac68b0e0 (Find Assets module implemented along with some customizations and logic improvements.)
