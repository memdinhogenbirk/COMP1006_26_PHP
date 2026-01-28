<?php require "includes/header.php" ?>
        <main>
            <h1>Contact Us</h1>
            <form action="process.php" method="post">
                <fieldset>
                    <legend><h2>Contact Information</h2></legend>
                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="Required" required>
                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Required" required>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Required" required>
                </fieldset>
                <fieldset>
                    <legend><h2>Message</h2></legend>
                    <label for="message">Please enter your message here</label>
                    <textarea id="message" name="message" rows="5" placeholder="Required" required></textarea>
                </fieldset>
                <button type="submit">SUBMIT</button>
            </form>
        </main>
        <?php require "includes/footer.php" ?>
    </body>
</html>
