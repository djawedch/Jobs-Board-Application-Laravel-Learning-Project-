# Jobs-Board

A job board platform built with Laravel where employers can publish job listings and candidates can browse opportunities.

## Technical Highlights

- Role-based authorization using Laravel Policies
- Centralized validation via FormRequest classes
- Referential integrity cleanup for many-to-many tags using model events
- Service layer abstraction for tag management
- Component-based Blade UI architecture
- Secure file upload handling with validation and storage
- Dynamic role-dependent registration flow

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

### Planned

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
    git clone https://github.com/djawedch/Jobs-Board.git
    cd Jobs-Board
    ```
    
2. **Install PHP dependencies:**
    
    ```bash
    composer install
    npm install
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
    
6. **Start development servers:**
    
    ```bash
    Run in two terminals:

    Terminal 1
    npm run dev

    Terminal 2
    php artisan serve
    ```
    
7. **Visit `http://localhost:8000`** in your browser

## Database Relationships

### User → Employer (One-to-One)

A user with role `employer` owns one employer profile.

### Employer → Job (One-to-Many)

An employer can create multiple job listings.

### Job ↔ Tag (Many-to-Many)

Jobs can have multiple tags and tags can belong to multiple jobs.

Unused tags are automatically removed when the last related job is deleted.

## **Key Implementation Details**

### **Authentication**

- Custom authentication without Breeze/Jetstream
- Session-based authentication
- Role-based middleware protection
- Separate registration flows for employers/candidates

### **Job Management**

- RESTful resource controllers
- Policy protection for create/edit/delete operations
- Search functionality

### **File Handling**

- Company logo upload with validation
- Public disk storage
- Seeder placeholders for images

### **UI/UX Features**

- Responsive Tailwind design
- Auto-dismiss flash messages
- Conditional form sections
- Accessible form components

## **Acknowledgments**

- **Jeffrey Way** for the initial tutorial foundation
- **Laravel Community** for excellent documentation
- **Tailwind CSS** for the utility-first approach
- **All open-source contributors** whose packages made this possible

## **License**

This project is open-source and available for educational purposes.