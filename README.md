
```markdown
# Laravel Simple Blog

A simple blog application built with **Laravel 11**.  
This project focuses on basic **CRUD functionality** for blog posts and is intended as a learning project to understand the core features of Laravel such as routing, controllers, models, views (Blade), and migrations.

## ✨ Features

- Create, Read, Update, Delete (CRUD) blog posts
- Blade templating for UI
- Clean routing using Laravel resource controller

## ⚙️ Requirements

- PHP >= 8.2
- Composer
- MySQL or compatible database
- Laravel 11

## 🚀 Installation

```bash
# Clone the repo
git clone https://github.com/vynnptra/laravel-simple-blog.git

# Enter the project directory
cd laravel-simple-blog

# Install dependencies
composer install

# Copy .env file
cp .env.example .env

# Configure database in .env
# Then generate app key
php artisan key:generate

# Run migrations
php artisan migrate

# Serve the app
php artisan serve
```

Visit `http://localhost:8000` in your browser to see the blog in action.

## 📁 Folder Overview

- `routes/web.php` → Defines the blog routes
- `app/Http/Controllers/PostController.php` → Handles all blog logic
- `resources/views/posts/` → Blade templates for views (index, create, edit, show)
- `database/migrations/` → Contains the migration for posts table

## 🧠 Learning Purpose

This project is a practical way to:
- How to use quill.js


## 📄 License

Open-source under the [MIT License](LICENSE).

---

Made with ❤️ by [@vynnptra](https://github.com/vynnptra)
```

---
