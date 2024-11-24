<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Book-Management-System

A simple Laravel-based application for searching books by title or author.

## Features
- User authentication (register and login).
- Search books by title or author.
- Display book details with images and descriptions.
- Pagination support for book lists.
- Users can view all the ratings and comments
- Users can add ratings and comments.

## Requirements
- PHP 8.3
- Laravel 11.3
- Node.js 16.18 
- MySQL 8.3

## Quick Setup
1. Clone the repository: `git clone https://github.com/Prashant-kumar070/Book-Management-System.git`
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
