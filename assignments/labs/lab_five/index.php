<?php 
require 'includes/connect.php';
session_start();//start/resume session

if(!isset($_SESSION['user_id'])){//check that session has a user_id, if not, no one is logged in, echo the following
    require 'includes/header.php';//display non admin header
    echo'<main>
        <h1>Welcome to PHOTO SLOP</h1>
        <p><a href="login.php">Login</a> or <a href="signup.php">Create an Account</a> to View or Upload Your Photos!</p>
    </main>';
}
else{//there is a user logged in
    require 'includes/header_admin.php';//display admin header(should probably be renamed to user header, and admin should be its own entity)
    $currentUser = $_SESSION["user_id"];//save current session user_id to a variable
    
    $sql = 'SELECT filePath FROM filePaths WHERE user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id'=>$currentUser]);//bind user id variable to named placeholder
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetch all photos(or rather filePaths associated with photos) that are assigned to this user

    $sql = 'SELECT username FROM users WHERE id = :user_id LIMIT 1';//get the user's username so we can display it on the page
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute([':user_id'=>$currentUser]);//use the id again to find said user
    $userName = $stmt2->fetch();
    ?>
    <main>
        <h2 class="text-center border-bottom border-2"><?= htmlspecialchars($userName['username']);?>'s Photos</h2><!--display user's username-->
        <div>
        <?php if($photos !== [])foreach($photos as $photo):?><!--display all of their photos-->
            <img src='<?= htmlspecialchars($photo['filePath']) ?>' class="w-25"/>
        <?php endforeach;
        else echo"<p>You don't have any photos yet. Want to <a href='upload.php'>UPLOAD</a>?</p>";?><!--if no photos, let em know-->
        </div>
    </main>
<?php } ?>

<?php require "includes/footer.php"; ?>
