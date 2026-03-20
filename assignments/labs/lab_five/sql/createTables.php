<?php require '../connect.php';
/*
This page was created with the theory that I will use it to create the tables on our serverside database
As of this moment, I have not attempted this yet
 */

    $sql ="
        DROP TABLE IF EXISTS filepaths;
        CREATE TABLE filepaths(
        file_id INT AUTO_INCREMENT PRIMARY KEY,
        filePath VARCHAR(255),
        user_id INT NOT NULL
    );
    
    DROP TABLE IF EXISTS users;

    CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo'success';
    exit;
?>