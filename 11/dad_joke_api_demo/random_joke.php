<?php
// ============================================
// Dad Joke API Demo - Random Joke Version
// Instructor File for COMP1006
// ============================================
// This page shows how to:
// 1. send a request to an external API
// 2. ask for JSON data using request headers
// 3. convert JSON into a PHP array
// 4. display the returned joke on the page

//var will hold joke when api called
$joke = "";

if(isset($_POST['get_joke'])){
    //use headers to tell api we want JSON return
    $options = [
        "http" => [
            "method" => "GET",
            "header" => "Accept:application/JSON\r\n" .
            "User-Agent: COMP1006 Dad Jokes Demo(http://127.0.0.1)\r\n"
        ]
    ];
    //convert the options array into stream context
    //file_get_contents can use this context when making request
    $context = stream_context_create($options);

    //send the request to random joke endpoint
    $response = file_get_contents('https://icanhazdadjoke.com/', false, $context);

    if ($response !== false){
        //var_dump($response);

        //convert to json
        $data = json_decode($response,true);

        //store in joke
        $joke = $data['joke'];
        
    }
    else {
        $joke = "Sorry no dad jokes today";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dad Joke Generator</title>
</head>
<body>

    <h1>Dad Joke Generator</h1>
    <p>Click the button to load a random dad joke from an API.</p>

    <!--
        This form submits back to the same page.
        When the button is clicked, PHP sends a request to the API.
    -->
    <form method="post">
        <button type="submit" name="get_joke">Get a Joke</button>
    </form>

    <?php if ($joke != ""): ?>
        <!-- htmlspecialchars() protects the page by escaping special characters. -->
        <p><strong>Joke:</strong> <?php echo htmlspecialchars($joke); ?></p>
    <?php endif; ?>

</body>
</html>
