# Military Battalion Management System

A comprehensive Laravel 12 enterprise application for managing military battalion personnel, operations, and administrative tasks.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.4
- **Database**: MySQL/PostgreSQL
- **Frontend**: Blade + Livewire + AlpineJS
- **UI Framework**: Bootstrap 5
- **Authentication**: Laravel Sanctum
- **Permissions**: Spatie Permission

## Features

- Personnel Management
- Company Management
- Leave Management
- Attendance Tracking
- Parade Scheduling
- Training & Courses
- IPFT Records
- Team Management
- Role & Permission System
- Advanced Reporting
- WhatsApp Directory

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Project Structure

```
app/
├── Http/Controllers/
├── Http/Requests/
├── Models/
├── Services/
├── Repositories/
├── Policies/
└── Events/

resources/views/
├── layouts/
├── dashboard/
├── personnel/
├── leave/
├── attendance/
└── ...
```

## License

MIT
