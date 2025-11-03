<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Shunno Laravel Project

A Laravel-based **School Management System** with multi-guard authentication and role/permission management using Spatie.

---

## Features

- Student management (CRUD, CSV/XLSX import & export)
- Teacher management (CRUD)
- Multi-guard authentication for Students and Teachers
- Role & permission management using [Spatie](https://spatie.be/docs/laravel-permission)
- Custom artisan commands
- Demo data seeding (super admins, students, teachers)
- Email reminders for exams (Markdown emails)
- Docker-ready local email testing with Mailpit

---

## Super Admin Credentials

> Default super admin user seeded in the database:

- **Email:** `supper-admin@shunno.com`
- **Password:** `admin`

---

## Installation

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd <project-folder>

2. **Install dependencies**
    composer install

3. **Configure environment**
    cp .env.example .env

4. **Generate application key**
    php artisan key:generate

5. **Run migrations and seed demo data**
    php artisan migrate --seed

6. **Serve the application**
    php artisan serve 


Excel Import & Export

Download the CSV/XLSX template from the Students page (Download Template button) before importing students.

The default password for imported students is 123456.

You can export all students using the Export Students button on the Students page.


**Custom artisan command to send exam reminders:**
php artisan exam:reminder

**Mailpit Local Setup (Optional)**
1. **Run Docker Mailpit:**
    docker run -d -p 8025:8025 -p 1025:1025 axllent/mailpit

2. **Set .env mail configuration:**
    MAIL_MAILER=smtp
    MAIL_HOST=127.0.0.1
    MAIL_PORT=1025
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="shunno@example.com"
    MAIL_FROM_NAME="Shunno App"

**Default Data Seeded**

    Super Admins: 2 users (supper-admin@shunno.com, admin and developer account)
    Students: 200 dummy students
    Teachers: 20 dummy teachers
    Classes: 10 default classes
    Sections: 5 default sections (A–E)
    Subjects: 5 default subjects

**Roles & Permissions**

    Roles: Super Admin, Teacher, Student
    Permissions managed with Spatie Laravel Permission
    Multi-guard authentication implemented for Teachers and Students