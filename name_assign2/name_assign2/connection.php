<?php

// Database credentials ── edit here if your setup differs
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cacti_succulent');

// Connect without DB first so we can create it if missing
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Auto-create database if it doesn't exist
if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS " . DB_NAME)) {
    die("Error creating database: " . mysqli_error($conn));
}

// Select the database
mysqli_select_db($conn, DB_NAME);

// Auto-create tables and seed admin on every include (safe: uses IF NOT EXISTS)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS admin (
    id       INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(25) NOT NULL
)");

// Seed default admin if table is empty
$res = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM admin");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    if ((int)$row['cnt'] === 0) {
        mysqli_query($conn, "INSERT INTO admin(username, password) VALUES ('admin', 'admin')");
    }
}

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS `user` (
    id       INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname    VARCHAR(25)  NOT NULL,
    lname    VARCHAR(25)  NOT NULL,
    email    VARCHAR(100) NOT NULL,
    phone    VARCHAR(10)  NOT NULL,
    street   VARCHAR(40)  NOT NULL,
    city     VARCHAR(20)  NOT NULL,
    state    VARCHAR(30)  NOT NULL,
    postcode VARCHAR(5)   NOT NULL,
    username VARCHAR(25)  NOT NULL,
    password VARCHAR(25)  NOT NULL,
    role     VARCHAR(10)  NOT NULL DEFAULT 'user'
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS enquiry (
    id           INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname        VARCHAR(25)  NOT NULL,
    lname        VARCHAR(25)  NOT NULL,
    email        VARCHAR(100) NOT NULL,
    phone        VARCHAR(10)  NOT NULL,
    enquiry_type VARCHAR(50)  NOT NULL,
    comments     TEXT
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS orders (
    id               INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname            VARCHAR(25)   NOT NULL,
    lname            VARCHAR(25)   NOT NULL,
    email            VARCHAR(100)  NOT NULL,
    phone            VARCHAR(10)   NOT NULL,
    delivery_mode    VARCHAR(30)   NOT NULL,
    preferred_date   DATE          NOT NULL,
    delivery_address VARCHAR(100),
    payment_mode     VARCHAR(20)   NOT NULL,
    special_notes    TEXT,
    items            TEXT,
    subtotal         DECIMAL(10,2),
    delivery_fee     DECIMAL(10,2),
    grand_total      DECIMAL(10,2),
    status           VARCHAR(20)   NOT NULL DEFAULT 'pending'
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
    id          INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category    VARCHAR(30)   NOT NULL,
    slug        VARCHAR(50)   NOT NULL UNIQUE,
    name        VARCHAR(100)  NOT NULL,
    price       DECIMAL(10,2) NOT NULL,
    description TEXT,
    image       VARCHAR(100)
)");
?>
