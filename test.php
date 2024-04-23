<?php
require __DIR__ . '/vendor/autoload.php'; // Include the autoload file if not using a PHP framework.
use Orhanerday\OpenAi\OpenAi;

function generateResponse($prompt) {
    // Initialize OpenAI
    $open_ai = new OpenAi('KEY');
    
    // Call OpenAI completion API
    $complete = $open_ai->completion([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => $prompt,
        'temperature' => 0.9,
        'max_tokens' => 1500,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ]);

    // Parse and return the response
    if ($complete) {
        $php_obj = json_decode($complete);
        $response = $php_obj->choices[0]->text;
        return $response;
    } else {
        return "Error: Unable to fetch response.";
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $user_query = $_POST['user_query'];

    // Generate response using the input
    $response = generateResponse($user_query);
} else {
    // If form is not submitted, initialize response as empty
    $response = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yegsong тест</title>
</head>
<body>
    <h1>Хичээлийн төлөвлөгөө</h1>
    <form method="post">
        <label for="user_query">Хичээл оруулах:</label><br>
        <textarea id="user_query" name="user_query" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Гаргах">
    </form>
    <hr>
    <?php if ($response): ?>
        <h2>Үр дүн:</h2>
        <p><?php echo $response; ?></p>
    <?php endif; ?>
</body>
</html>
