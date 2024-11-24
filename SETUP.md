## Project Setup Guide

### Prerequisites
1. Install PHP 8.3, Composer, Node.js, and MySQL.
2. Ensure the `php`, `composer`, and `npm` commands are globally accessible.

### Steps to Setup
1. Clone the repository: `git clone https://github.com/Prashant-kumar070/Book-Management-System.git`
2. Navigate to the project directory: `cd book-search`
3. Install backend dependencies: `composer install`
4. Install frontend dependencies: `npm install`
5. Copy `.env.example` to `.env` and configure:
   - `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
   - run key `php artisan key:generate`
6. Run database migrations: `php artisan migrate`
7. Run seeder `php artisan db:seed`
8. Start the servers:
   - Backend: `php artisan serve`
   - Frontend assets: `npm run dev`

9. Optional commands:
   
   - `php artisan config:cache` - Cache configurations.


