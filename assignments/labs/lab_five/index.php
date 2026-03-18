<?php 
require 'includes/connect.php';
session_start();
if(!isset($_SESSION['user_id'])){
    require 'includes/header.php';
    echo'<main>
        <h1>Welcome to PHOTO SLOP</h1>
        <p>Login or Create an Account to View or Upload Your Photos!</p>
    </main>';
}
else{
    $currentUser = $_SESSION["user_id"];
    $sql = 'SELECT filePath FROM filePaths WHERE user_id = :user_id';
}

?>

<?php require "includes/footer.php"; ?>