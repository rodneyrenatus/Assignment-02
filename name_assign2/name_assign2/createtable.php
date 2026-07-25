<?php

$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "cacti_succulent";

// First, connect without specifying a database
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!mysqli_query($conn, $sql)) {
    die("Error creating database: " . mysqli_error($conn));
}

// Select the database
mysqli_select_db($conn, $dbname);

// ── Enquiry submissions ────────────────────────────────
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS enquiry (
    id           INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname        VARCHAR(25)  NOT NULL,
    lname        VARCHAR(25)  NOT NULL,
    email        VARCHAR(100) NOT NULL,
    phone        VARCHAR(10)  NOT NULL,
    enquiry_type VARCHAR(50)  NOT NULL,
    comments     TEXT
)");

// ── Registered public users ────────────────────────────
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

// Add role column if upgrading from older schema
mysqli_query($conn, "ALTER TABLE `user` ADD COLUMN IF NOT EXISTS `role` VARCHAR(10) NOT NULL DEFAULT 'user'");

// ── Admin table (spec requirement: separate admin credentials table) ──
// Admin credentials are stored here AND read from here at login — not hardcoded.
// Regular users are stored in the `user` table. Admin NEVER goes into `user` table.
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS admin (
    id       INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(25) NOT NULL
)");

// Seed default admin credentials per spec: Username=admin, Password=admin
$arow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM admin"));
if ((int)$arow['cnt'] === 0) {
    mysqli_query($conn, "INSERT INTO admin(username, password) VALUES ('admin', 'admin')");
}

// Remove any admin accounts accidentally seeded into the user table
mysqli_query($conn, "DELETE FROM `user` WHERE role='admin'");

// ── Orders ─────────────────────────────────────────────
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

// Add status column if upgrading from older schema
mysqli_query($conn, "ALTER TABLE orders ADD COLUMN IF NOT EXISTS `status` VARCHAR(20) NOT NULL DEFAULT 'pending'");

// ── Products ────────────────────────────────────────────
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS products (
    id          INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category    VARCHAR(30)   NOT NULL,
    slug        VARCHAR(50)   NOT NULL UNIQUE,
    name        VARCHAR(100)  NOT NULL,
    price       DECIMAL(10,2) NOT NULL,
    description TEXT,
    image       VARCHAR(100)
)");

mysqli_close($conn);
?>
