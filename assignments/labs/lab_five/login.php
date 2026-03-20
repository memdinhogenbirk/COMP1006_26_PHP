<?php 

/*airlifting and tweaking code here again
It was unclear if we were meant to do this as part of the lab
The introduction says the site we are working on has the ability to login, but the instructions make no mention of it
I erred on the side of caution and implemented it, good practice for second half of assignment regardless*/


session_start();//begin session 
require "includes/connect.php";
require "includes/header.php";//default header
//I reckon this page ought to redirect if the user is already logged in, I have not implemented this however

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = trim($_POST['username_or_email'] ?? '');//user can log in with either email or username
    $password = $_POST['password'] ?? '';

    if ($usernameOrEmail === '' || $password === '') {//no empty fields
        $error = "Username/email and password are required.";
    } else {//block to gather user login info from DB
        $sql = "SELECT id, username, email, password
                FROM users
                WHERE username = :login OR email = :login
                LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':login', $usernameOrEmail);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {//if password verified
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");//move them to main page to view their photos
            exit;
        } else {//password or username/email doesnt match DB info
            $error = "Invalid credentials. Please try again.";
        }
    }
}
?>

<main class="container mt-4">
    <h2>Login</h2>

    <?php if ($error !== ""): ?><!--error displaying block-->
        <div class="alert alert-danger">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="post" class="mt-3"><!--username or email input field-->
        <label for="username_or_email" class="form-label">Username or Email</label>
        <input
            type="text"
            id="username_or_email"
            name="username_or_email"
            class="form-control mb-3"
            required
        >

        <label for="password" class="form-label">Password</label><!--password input field-->
        <input
            type="password"
            id="password"
            name="password"
            class="form-control mb-4"
            required
        >

        <button type="submit" class="btn btn-primary">Login</button><!--submit/execute php-->
        <a href="signup.php" class="btn btn-secondary">Create Account</a><!--goes to account making page-->
    </form>
</main>

<?php require "includes/footer.php"; ?>