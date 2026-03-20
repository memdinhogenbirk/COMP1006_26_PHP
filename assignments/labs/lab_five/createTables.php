<?php require 'connect.php';
/*
This page was created with the theory that I will use it to create the tables on our serverside database
As of this moment, I have not attempted this yet
 */

    $sql ="CREATE TABLE filepaths
    (
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    filePath VARCHAR(255),
    user_id INT NOT NULL
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo'success';
    exit;
?>