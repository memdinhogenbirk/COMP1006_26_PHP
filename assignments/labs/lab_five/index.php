<?php 
require 'includes/connect.php';
session_start();
if(!isset($_SESSION['user_id'])){
    require 'includes/header.php';
    echo'<main>
        <h1>Welcome to PHOTO SLOP</h1>
        <p><a href="login.php">Login</a> or <a href="signup.php">Create an Account</a> to View or Upload Your Photos!</p>
    </main>';
}
else{
    require 'includes/header_admin.php';
    $currentUser = $_SESSION["user_id"];
    $sql = 'SELECT filePath FROM filePaths WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id'=>$currentUser]);
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SELECT username FROM users WHERE id = :user_id LIMIT 1';
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute([':user_id'=>$currentUser]);
    $userName = $stmt2->fetch();
    ?>
    <main>
        <h1><?= htmlspecialchars($userName['username']);?>'s Photos</h1>
        <?php if($photos !== [])foreach($photos as $photo):?>
            <img src='<?= htmlspecialchars($photo['filePath']) ?>'/>
        <?php endforeach;
        else echo"<p>You don't have any photos yet. Want to <a href='upload.php'>UPLOAD</a>?</p>";?>
    </main>
<?php } ?>

<?php require "includes/footer.php"; ?>
<!--
What is the purpose of the $_FILES superglobal in PHP? 
Why does a form need special settings to upload files? 
What function is used to move uploaded files to a folder? 
Why is it important to control where uploaded files are stored?
-->