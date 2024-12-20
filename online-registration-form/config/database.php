<<?php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');     // Default XAMPP username
    define('DB_PASS', '');         // Default XAMPP password (blank)
    define('DB_NAME', 'registration_db');
// SQL for creating the database and table
/*
CREATE DATABASE registration_db;

USE registration_db;

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    address TEXT NOT NULL,
    education VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);