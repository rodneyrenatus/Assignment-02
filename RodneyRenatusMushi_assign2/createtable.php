<?php
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "cacti_succulent";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Enquiry submissions
    $sql = "CREATE TABLE IF NOT EXISTS enquiry (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(25) NOT NULL,
        lname VARCHAR(25) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(10) NOT NULL,
        enquiry_type VARCHAR(50) NOT NULL,
        comments TEXT
    )";
    mysqli_query($conn, $sql);

    // Registered public users (role: 'user' or 'admin')
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(25) NOT NULL,
        lname VARCHAR(25) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(10) NOT NULL,
        street VARCHAR(40) NOT NULL,
        city VARCHAR(20) NOT NULL,
        state VARCHAR(30) NOT NULL,
        postcode VARCHAR(5) NOT NULL,
        username VARCHAR(25) NOT NULL,
        password VARCHAR(25) NOT NULL,
        role VARCHAR(10) NOT NULL DEFAULT 'user'
    )";
    mysqli_query($conn, $sql);

    // Add role column if upgrading from an older schema without it
    mysqli_query($conn, "ALTER TABLE `user` ADD COLUMN IF NOT EXISTS `role` VARCHAR(10) NOT NULL DEFAULT 'user'");

    // Orders
    $sql = "CREATE TABLE IF NOT EXISTS orders (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fname VARCHAR(25) NOT NULL,
        lname VARCHAR(25) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(10) NOT NULL,
        delivery_mode VARCHAR(30) NOT NULL,
        preferred_date DATE NOT NULL,
        delivery_address VARCHAR(100),
        payment_mode VARCHAR(20) NOT NULL,
        special_notes TEXT,
        items TEXT,
        subtotal DECIMAL(10,2),
        delivery_fee DECIMAL(10,2),
        grand_total DECIMAL(10,2)
    )";
    mysqli_query($conn, $sql);

    // Drop the old admin table if it still exists
    mysqli_query($conn, "DROP TABLE IF EXISTS admin");

    // Seed default admin account into the user table if none exists
    $result = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `user` WHERE role = 'admin'");
    $row    = mysqli_fetch_assoc($result);
    if ((int)$row['cnt'] === 0) {
        mysqli_query($conn, "INSERT INTO `user`(fname, lname, email, phone, street, city, state, postcode, username, password, role)
                             VALUES ('Admin', 'Admin', 'admin@cacti.com', '0000000000', 'N/A', 'Kuching', 'Sarawak', '00000', 'admin', 'admin123', 'admin')");
    }

    mysqli_close($conn);
?>
