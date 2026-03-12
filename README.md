# 📚 Library Management System (Laravel)

A simple **Library Management System** built using the **Laravel framework**.  
This system allows administrators to manage **books, users, and borrowing records** through a web interface.

The project demonstrates **CRUD operations, relational database management, and Laravel MVC architecture**.

---

# Screenshots
<img width="1902" height="890" alt="Screenshot (2816)" src="https://github.com/user-attachments/assets/3bbf3875-04e5-4c49-bcb0-52bc11f0977e" />
<img width="1908" height="874" alt="Screenshot (2815)" src="https://github.com/user-attachments/assets/515a58cd-d119-48d9-adbf-f84ac236926d" />
<img width="1897" height="884" alt="Screenshot (2814)" src="https://github.com/user-attachments/assets/31ea0468-9d98-4bbc-a8c7-c48d0500bb85" />
<img width="1898" height="880" alt="Screenshot (2813)" src="https://github.com/user-attachments/assets/81e5636b-ecf6-4806-b0f3-03ab5524f260" />
<img width="1906" height="883" alt="Screenshot (2812)" src="https://github.com/user-attachments/assets/193fc387-6477-4826-b36d-892c9de7c4dd" />
<img width="1897" height="868" alt="dashboard" src="https://github.com/user-attachments/assets/e869d00a-c31f-4329-bf80-114508a61d15" />

# Features

## Book Management
- Add new books
- Edit book details
- Disable books (soft disable using status column)
- Filter books by category
- Track stock availability

## User Management
- Register new users
- View registered users
- Validation for:
  - Unique email
  - Unique NIC
  - Unique mobile number

## Borrowing System
- Borrow books
- Track borrowed books
- View borrowing history
- Mark borrowed books as **Received**
- Update borrowing status

## Dashboard
- Display statistics
- Chart showing **borrowed books per category**
- Data visualization using **Chart.js**

---

# System Architecture

The system follows the **Laravel MVC Architecture**:
Request → Route → Controller → Model → Database
↓
View

---

# Technologies Used

| Technology | Purpose |
|------------|--------|
| Laravel 10 | Backend Framework |
| PHP 8+ | Server-side language |
| MySQL | Database |
| Blade | Laravel templating engine |
| Bootstrap | Frontend UI |
| Chart.js | Dashboard data visualization |
| XAMPP | Local development environment |

---

# Project Structure

librarysystem
│
├── app
│ ├── Http
│ │ ├── Controllers
│ │
│ ├── Models
│
├── database
│ ├── migrations
│ ├── seeders
│
├── resources
│ ├── views
│ │ ├── books
│ │ ├── users
│ │ ├── borrow
│
├── routes
│ └── web.php
---

## Database Structure

## Users

| Column | Description |
|------|-------------|
| id | Primary Key |
| first_name | User first name |
| last_name | User last name |
| email | Unique email |
| mobile | Unique phone number |
| nic | Unique NIC |
| password | Hashed password |
| registered_at | Registration timestamp |

---

## Books

| Column | Description |
|------|-------------|
| id | Primary Key |
| title | Book title |
| author | Author name |
| book_category_id | Category reference |
| price | Book price |
| stock | Available stock |
| status | 0 = Active, 1 = Disabled |

---

## Book Categories

| Column | Description |
|------|-------------|
| id | Primary Key |
| name | Category name |

---

## Borrow Records

| Column | Description |
|------|-------------|
| id | Primary Key |
| users_id | Borrowing user |
| books_id | Borrowed book |
| borrowed_at | Borrow date |
| returned_at | Return date |
| status | 0 = Pending, 1 = Received |

---

# Installation Guide

## Clone the repository

│
├── database_backup
│ └── library.sql

git clone https://github.com/yourusername/librarysystem.git

---

## Navigate to project folder


cd librarysystem


---

## Install dependencies


composer install


---

## Copy environment file


cp .env.example .env


---

## Generate application key


php artisan key:generate


---

## Configure database

Edit the `.env` file and update the database settings:


DB_DATABASE=librarysystem
DB_USERNAME=root
DB_PASSWORD=


---

## Import Database

**Important**

The **migration and seed files do not contain real data**.
The actual database records are stored in the SQL dump located in:


database_backup/library.sql


Import it using **phpMyAdmin**:


phpMyAdmin → Import → Select library.sql


---

## Run the project


php artisan serve


Open in browser:


http://localhost:8000


---

# Example System Workflow

## Borrow Book


User → Select Book → Borrow → Record created


## Return Book


Admin → Click "Mark Received"
→ Borrow status updated
→ Book returned


---

# Validation Rules

The system ensures:

- Email must be unique
- NIC must be unique
- Mobile number must be unique
- Required field validation

Example:


'email' => 'required|email|unique:users,email'


---

# Dashboard Analytics

The dashboard includes:

- Borrowed books statistics
- Books per category
- Data visualization using **Chart.js bar charts**

---

# Future Improvements

Possible future enhancements:

- Authentication system
- Role based access (Admin / Librarian)
- Book reservation system
- Fine calculation for late returns
- REST API integration
- Search functionality
- Notifications for due books

---

# Author

**Piyumi Premachandra**

---

# License

This project is developed for **educational purposes**.
