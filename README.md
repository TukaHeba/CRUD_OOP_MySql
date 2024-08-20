# Blog Management System

This project is a simple Blog Management System built using pure PHP, Object-Oriented Programming (OOP), and MySQLi with prepared statements. It supports full CRUD operations (Create, Read, Update, Delete) for blog posts, including validation and protection against SQL injection through prepared statements.

## Features

- **Object-Oriented PHP**: Clean and organized code using OOP principles.
- **CRUD Functionality**: Full management of blog posts (Create, Read, Update, Delete).
- **SQL Injection Prevention**: Secure database interactions using MySQLi prepared statements.
- **Validation**: Input validation to ensure data integrity.

## Prerequisites

Before running the project, ensure you have the following installed:
- XAMPP (or any LAMP/WAMP stack)
- PHP
- MySQL

## Installation

Follow these steps to set up the project on your local machine:

- Open your terminal
- **Clone the Repository**: git clone https://github.com/TukaHeba/CRUD_OOP_MySql.git
- Add the project file into xampp/httdocs directory
- Open XAMPP and start both Apache and MySQL services
- Open http://localhost/CRUD_OOP_MySql/ in your browser
- Now you can explore the project because database and posts table will be created automatically

## File Structure

```bash
├── classes/
│   ├── Database.php      # Handles the database connection using MySQLi.
│   ├── Posts.php         # Manages blog posts operations (CRUD).
├── Trait/
│   └── Validator.php     # Trait used for input validation.
├── views/
│   ├── list_posts.php    # Displays all blog posts.
│   ├── view_post.php     # Shows details of a single post.
│   ├── edit_post.php     # Allows editing of an existing post.
│   ├── create_post.php   # Form for creating a new blog post.
│   └── delete_post.php   # Handles deletion of a post.
├── index.php             # Main entry point for the application to redirect to list_posts view
├── script.sql            # SQL script to create the `posts` table and insert initial data.
└── README.md             # Project documentation.
