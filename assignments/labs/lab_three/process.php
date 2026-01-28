<?php 
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $userMessage = htmlspecialchars($_POST['message']);

    $first_name = filter_var($first_name, FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = filter_var($last_name, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $userMessage = filter_var($userMessage, FILTER_SANITIZE_SPECIAL_CHARS);

?>
<?php require "includes/header"?>
        <main>
            <?php 
                echo "<h1>Thank You For Your Submission</h1>"
                

            ?>
        </main>
        <?php require "includes/footer"?>
    </body>
</html>