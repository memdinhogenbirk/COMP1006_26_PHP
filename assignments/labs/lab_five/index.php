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
    header("Location: upload.php");
}

?>

<?php require "includes/footer.php"; ?>