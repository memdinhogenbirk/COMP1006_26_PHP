<?php
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
$currentUser = $_SESSION["user_id"];
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // super global files image variable
    $userImage = $_FILES['user_image'];
    // This will store the image path for the database
    $filePath = null;

    //check if a file is uploaded
    if(isset($userImage)&& $userImage['error'] !== UPLOAD_ERR_NO_FILE){
        if($userImage['error'] !== UPLOAD_ERR_OK){
            $errors[] = "There was a problem uploading the image";
        }
        else{
        //only allow .jpg,.jpeg,.png,.webp
            $allowedType = ['image/jpeg','image/jpg','image/png','image/webp'];
            //detect the real MIME TYPE of the uploaded file
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

    // If there are no errors, insert the product into the database
    if (empty($errors)) {
        $sql = "INSERT INTO filepaths (filePath, user_id)
                VALUES (:filePath, :user_id)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':filePath' => $filePath,':user_id'=> $currentUser]);

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

    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success); ?>
        </div>
        <div>
            <img src='<?= htmlspecialchars($photo["filePath"]) ?>'class="w-50"/>
        </div>
    <?php endif; ?>
    <!--enctype="multipart/form-data" required for uploads, will not send properly if not included -->
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <label for="user_image" class="form-label">Select File to Upload</label>
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