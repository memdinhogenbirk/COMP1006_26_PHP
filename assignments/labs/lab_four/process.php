<?php
//  TODO: connect to the database 
require "includes/connect.php";
//   TODO: Grab form data (no validation or sanitization for this lab)
$firstName = htmlspecialchars($_POST['first_name']);
$lastName  = htmlspecialchars($_POST['last_name']);
$email     = htmlspecialchars($_POST['email']);

  //1. Write an INSERT statement with named placeholders
$sql = "INSERT INTO subscribers(first_name, last_name, email) VALUES (:first_name, :last_name, :email)";
  //2. Prepare the statement
$stmt = $pdo->prepare($sql);
  //3. Execute the statement with an array of values
$stmt ->bindParam(':first_name', $firstName);
$stmt ->bindParam(':last_name', $lastName);
$stmt ->bindParam(':email', $email);
$stmt->execute([
    ':first_name' => $firstName,
    ':last_name' => $lastName,
    ':email' => $email
]);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->
        <p>Thank you, <?php echo ($firstName . ' ' . $lastName); ?>! We have added you to our mailing list.</p>

        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>