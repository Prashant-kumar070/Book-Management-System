## Project Setup Guide

### Prerequisites
1. Install PHP 8.x, Composer, Node.js, and MySQL.
2. Ensure the `php`, `composer`, and `npm` commands are globally accessible.

### Steps to Setup
1. Clone the repository: `git clone https://github.com/your-username/book-search.git`
2. Navigate to the project directory: `cd book-search`
3. Install backend dependencies: `composer install`
4. Install frontend dependencies: `npm install`
5. Copy `.env.example` to `.env` and configure:
   - `DB_CONNECTION`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
6. Run database migrations: `php artisan migrate`
7. Start the servers:
   - Backend: `php artisan serve`
   - Frontend assets: `npm run dev`

8. Optional commands:
   - `php artisan test` - Run tests.
   - `php artisan config:cache` - Cache configurations.

For any issues, check the troubleshooting section below.
