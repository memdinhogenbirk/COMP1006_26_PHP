<?php
/* What's the Problem? 
    - PHP logic + HTML in one file
    - Works, but not scalable
    - Repetition will become a problem

    How can we refactor this code so it’s easier to maintain?
    <ul>
    <?php foreach ($items as $item): ?>
    <li><?= $item ?></li>
    <?php endforeach; ?>
    </ul>
    $items = ["Home", "About", "Contact"];
*/



?>

<!DOCTYPE html>
<html>
<?php include "includes/head.php"; ?>

<body>

    <h1>Welcome</h1>

    <?php
    include "includes/Items.php";
    Items::displayItems();
    ?>
    <?php include "includes/footer.php"; ?>

</body>

</html>