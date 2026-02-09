# Jobs-Board

A full-featured job board platform built with Laravel where employers can post job listings and candidates can browse opportunities. This project evolved from a basic tutorial into a robust, production-ready application with advanced features and a clean component-based architecture.

## Features

### Implemented

- **Custom Authentication System**: Register, login, logout with session management
- **Dual Role System**: Separate flows for Employers and Candidates
- **Job Management**: Full CRUD operations for job listings
- **Dynamic Forms**: Conditional employer fields during registration
- **File Upload**: Company logo upload
- **Search Functionality**: Job search across titles and tags
- **Responsive UI**: Mobile-first design with Tailwind CSS
- **Flash Notifications**: User-friendly success/error messages
- **Blade Components**: Modular, reusable UI components

### Planned Features

- Job application system
- User profile management
- Advanced filtering (salary, location, job type)
- Email notifications
- Job favoriting/bookmarking
- Admin dashboard

## Tech Stack

**Backend:**

- Laravel 12.47.0
- PHP
- MySQL

**Frontend:**

- Blade Templates
- Tailwind CSS
- Vite

**Architecture:**

- Service Layer Pattern
- Component-Based Design
- Custom Authentication

## Quick Start

### Prerequisites

- PHP
- Composer
- Node.js & npm
- MySQL

### Installation

1. **Clone the repository:**
    
    ```bash
    git clone <https://github.com/djawedch/Jobs-Board.git>
    cd Jobs-Board
    ```
    
2. **Install PHP dependencies:**
    
    ```bash
    composer install
    ```
    
3. **Setup environment:**
    
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    
4. **Configure database in `.env`:**
    
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=jobs_board
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    
5. **Run migrations & seeders:**
    
    ```bash
    php artisan migrate
    php artisan db:seed
    ```
    
6. **Install frontend dependencies:**
    
    ```bash
    npm install
    ```
    
7. **Start development servers:**
    
    ```bash
    npm run dev | php artisan serve
    ```
    
8. **Visit `http://localhost:8000`** in your browser

## **Relationship Details**

### **1. User → Employer: One-to-One (Conditional)**

```php
// User Model
public function employer() {
    return $this->hasOne(Employer::class);
}

// Employer Model
public function user() {
    return $this->belongsTo(User::class);
}
```

- A user with `role = 'employer'` has exactly one employer profile
- Employer profile is created only when user selects employer role during registration
- Access via: `$user->employer` or `$employer->user`

### **2. Employer → Job: One-to-Many**

```php
// Employer Model
public function jobs() {
    return $this->hasMany(Job::class);
}

// Job Model
public function employer() {
    return $this->belongsTo(Employer::class);
}
```

- An employer can create multiple job listings
- Each job belongs to exactly one employer
- Foreign key: `jobs.employer_id` references `employers.id`

### **3. Job ↔ Tag: Many-to-Many**

```php
// Job Model
public function tags() {
    return $this->belongsToMany(Tag::class);
}

// Tag Model
public function jobs() {
    return $this->belongsToMany(Job::class);
}
```

- A job can have multiple tags (e.g., "PHP", "Remote", "Full-time")
- A tag can be applied to multiple jobs
- Pivot table: `job_tag` with `job_id` and `tag_id`

## **Key Implementation Details**

### **Authentication System**

- Custom authentication without Breeze/Jetstream
- Session-based authentication
- Role-based middleware protection
- Separate registration flows for employers/candidates

### **Job Management**

- RESTful resource controllers
- Policy protection for edit/delete operations
- Search functionality

### **File Handling**

- Company logo upload with validation
- Public disk storage
- Intelligent placeholder system for seeders
- Image optimization and validation

### **UI/UX Features**

- Responsive design with Tailwind CSS
- Flash message system with auto-dismiss
- Conditional form sections
- Accessible form elements
- Consistent spacing and typography

## **Development Notes**

### **Database Seeding**

The seeder includes:

- Sample employers and candidates
- Job listings with realistic data
- Company logos

## **Learning Journey**

This project started as a tutorial from **Jeffrey Way's Laravel course** but was significantly expanded with:

- Custom authentication system
- Advanced role management
- Service layer implementation
- Component-based architecture
- Production-ready features

## **Acknowledgments**

- **Jeffrey Way** for the initial tutorial foundation
- **Laravel Community** for excellent documentation
- **Tailwind CSS** for the utility-first approach
- **All open-source contributors** whose packages made this possible

## **License**

This project is open-source and available for educational purposes. Originally based on Jeffrey Way's tutorial but extensively modified and expanded.

---

## **Final Notes**

This project represents a significant learning milestone in Laravel development. From basic CRUD operations to implementing a service layer and component architecture, it showcases progression from tutorial-based learning to building production-ready features.