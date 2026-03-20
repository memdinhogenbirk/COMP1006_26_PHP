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
        <h1><?= htmlspecialchars($userName['username']);?>'s Photos</h1><!--display user's username-->
        <div>
        <?php if($photos !== [])foreach($photos as $photo):?><!--display all of their photos-->
            <img src='<?= htmlspecialchars($photo['filePath']) ?>' class="w-25"/>
        <?php endforeach;
        else echo"<p>You don't have any photos yet. Want to <a href='upload.php'>UPLOAD</a>?</p>";?><!--if no photos, let em know-->
        </div>
    </main>
<?php } ?>

<?php require "includes/footer.php"; ?>
<!--
What is the purpose of the $_FILES superglobal in PHP?

An array variable which contains:
- the original name of the file, 
- the type of file (MIME type), 
- the size of the file, 
- the temporary file name (stored serverside before ending up at its final destination)
- an error code to indicate if upload was successful
- the full path (a relative path submitted by the browser, vardumping this shows the path is identical to the file name, unsure if this
  is always the case)
  
As indicated by the name, $_FILES can contain multiple files at once.
It requires the form method post.

Ultimately it's purpose is to store file information serverside before the file/files are uploaded, 
making it possible to validate said info prior to finalizing the upload

Why does a form need special settings to upload files? 

Default form encoding is designed to work with text, it encodes special characters, and produces one long string
enctype="multipart/form-data" will encode the data so that text and binary code is separated and preserved
From what I understand, if you were to send the data without enctype="multipart/form-data"
the browser will either fail to send the submission entirely, send only text fields (ignoring input type ="file"), or send only the file name

The form method must be POST. GET is namely for retrieving data, but also is used to place data in the URL, and a file has too much data
to be transferred in such a way. Not to mention the ability for human interference with URLs means that even if one could send it that way,
it would be easy to screw with.

What function is used to move uploaded files to a folder?

move_uploaded_file()

Why is it important to control where uploaded files are stored?

A few reasons come to mind.
- maintains control over where to pull said file from
- allows for files to be placed outside of URL accessible folders (though in this case I have not done that)
  which prevents someone from creating their own executable page within your root
- organization (images with images, text with text, videos with videos, etc.)

Best summarized as, security and accessibility reasons.
-->