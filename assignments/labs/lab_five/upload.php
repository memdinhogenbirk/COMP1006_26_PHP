<?php
/*
Majority of this is airlifted from the lesson
It has of course been tweaked to be appropriate for this lab
*/

// Make sure the user is logged in before they can access this page
require "includes/auth.php";

// Connect to the database
require "includes/connect.php";

// Show the admin-style header/navigation
require "includes/header_admin.php";

// Array for validation errors
$errors = [];

// Success message
$success = "";
$currentUser = $_SESSION["user_id"];//store the current session user id in variable
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // super global files image variable
    $userImage = $_FILES['user_image'];//saved to variable for efficiency
    
    // This will store the image path for the database
    $filePath = null;

    //check if a file is uploaded
    if(isset($userImage)&& $userImage['error'] !== UPLOAD_ERR_NO_FILE){
        var_dump($emptyInputCheck);
        if($userImage['error'] !== UPLOAD_ERR_OK){
            $errors[] = "There was a problem uploading the image";
        }
        else{
            //check file size (limited to 5mb)
            $maxFileSize = 5 * 1024 * 1024;//size returns as bytes, 5mb is 5120kb, and a kb is 5120 b, hence the double multiplication
            if ($userImage['size'] > $maxFileSize) {
                //undo mutiplication else display very big number
                $errors[] = "File is too large. Maximum allowed size is " . ($maxFileSize / 1024 / 1024) . " MB.";
            }
            //only allow .jpg,.jpeg,.png,.webp
            $allowedType = ['image/jpeg','image/jpg','image/png','image/webp'];
            //detect the real MIME TYPE of the uploaded file
            //in otherwords, make sure that the file is what it purports to be
            //and one of the allowed extensions, using the allowedType array for reference as to what is ok
            $detectedType = mime_content_type($userImage['tmp_name']);
            if(!in_array($detectedType, $allowedType, true)){
                $errors[] = "Accepted File Types: .jpg, .jpeg, .png, .webp";
            }
            else{
                //get the file extension
                $extension = pathinfo($userImage['name'], PATHINFO_EXTENSION);
                //create a unique name so files don't overwrite
                $safeFilename = uniqid('image_', true). '.'.strtolower($extension);
                //create path to file storage location
                //cwd/uploads/new uniqe filename
                $destination = __DIR__.'/uploads/'.$safeFilename;
                //move from temp storage to uploads folder
                if(move_uploaded_file($userImage['tmp_name'], $destination)){
                    //save path to database
                    $filePath = 'uploads/'.$safeFilename;
                }
                else{
                    $errors[] = "Image Upload Failed";
                }
            }
        }
    }
    else{
        $errors[]="No File was selected";
    }

    // If there are no errors, insert the product into the database
    if (empty($errors)) {
        $sql = "INSERT INTO filePaths (filePath, user_id)
                VALUES (:filePath, :user_id)";

        $stmt = $pdo->prepare($sql);
        //attach current session user id to uploaded file in the database so it can be associated with the same user when they view
        //their photos
        $stmt->execute([':filePath' => $filePath,':user_id'=> $currentUser]);

        //below block retrieves the file path for the last photo the user uploaded (just uploaded)
        $currentUser = $_SESSION["user_id"];
        $sql = 'SELECT filePath FROM filePaths WHERE user_id = :user_id ORDER BY file_id DESC LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id'=>$currentUser]);
        $photo = $stmt->fetch();

        $success = "Image added successfully!";
    }
}
?>

<main class="container mt-4">
    <h1>Add Your Image</h1>
    <!--error displaying block for problems with upload-->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <h3>Please fix the following:</h3>
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <!--successful upload block-->
    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success);?>
            
        </div>
        <div>
            <img src='<?= htmlspecialchars($photo["filePath"]) ?>'class="w-50"/><!--display the photo that was just uploaded-->
        </div>
    <?php endif; ?>
    <!--enctype="multipart/form-data" required for uploads, will not send properly if not included -->
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <label for="user_image" class="form-label">Select File to Upload</label>
        <!--set input type to file, give it a name and id to be referenced, do clientside file type filtering-->
        <input
            type="file"
            id="user_image"
            name="user_image"
            class="form-control mb-4"
            accept=".jpg,.jpeg,.png,.webp"
            
        >

        <button type="submit" class="btn btn-primary">Upload Image</button>
    </form>
</main>

<?php require "includes/footer.php"; ?>