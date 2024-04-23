<?php
require_once '/vendor/autoload.php'; // Replace with the actual path

use OpenAI\Api\EnginesApi;
use OpenAI\Configuration;
use OpenAI\OpenAIApi;

// Set up your OpenAI API key
Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_OPENAI_API_KEY');

// Get the prompt from the form submission
if(isset($_POST['prompt'])) {
    $prompt = $_POST['prompt'];

    // Initialize the OpenAI API client
    $openai = new OpenAIApi();

    // Set the engine ID (e.g., "text-davinci-003")
    $engine = 'text-davinci-003';

    // Set the parameters for completion generation
    $params = [
        'prompt' => $prompt,
        'max_tokens' => 100,
        'temperature' => 0.7,
        'top_p' => 1,
        'n' => 1,
        'stop' => '\n'
    ];

    try {
        // Generate the completion
        $response = $openai->createCompletion($engine, $params);

        // Output the generated completion
        echo "<h2>Generated Completion:</h2>";
        echo "<p>" . $response->getChoices()[0]->getText() . "</p>";
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Error: No prompt provided.';
}
?>
