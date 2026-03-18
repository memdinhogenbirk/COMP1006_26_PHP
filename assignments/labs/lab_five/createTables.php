<?php require 'connect.php';
    $sql ="CREATE TABLE filepaths
    (
    file_id INT AUTO_INCREMENT PRIMARY KEY,
    filePath VARCHAR(255)
    )";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo'success';
    exit;
?>