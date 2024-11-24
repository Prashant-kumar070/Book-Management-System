# Book-Management-System

A simple Laravel-based application for searching books by title or author.

## Features
- Search books by title or author.
- Display book details with images and descriptions.
- Pagination support for book lists.

## Requirements
- PHP 8.3
- Laravel 11.3
- Node.js 16.18 
- MySQL 8.3

## Quick Setup
1. Clone the repository: `git clone https://github.com/your-username/book-search.git`
2. Install dependencies: `composer install` and `npm install`
3. Configure `.env` and run migrations: `php artisan migrate`
4. Run seeder `php artisan db:seed` 
5. Start the development server: `php artisan serve`
6. Start frontend vite development server. `npm run dev`

For detailed setup instructions, see the [SETUP.md](SETUP.md).

## Usage
- Open the application in your browser.
- Register on the website
- you will be redirected to book dasboard.
- Use the search bar on the dashboard to find books.
- Click on `View Details` below book ticket to add and see ratings and comments.
