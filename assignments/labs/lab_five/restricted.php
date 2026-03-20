<?php require_once 'includes/header.php' ?>
<!--airlifted from lesson, nothing tweaked here
page is triggered by auth.php finding no user_id in the session-->

<body>
    <main class="container restricted text-center">
        <h1> Sorry, you must be logged into view this content! </h1>
        <a href="index.php" class="btn btn-primary"> Back to Home Page </a>
    </main>
</body>

</html>
<?php require_once 'includes/footer.php' ?>