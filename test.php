<?php
// session_start();

// require_once __DIR__ . '/vendor/autoload.php'; // Include Composer autoloader
// use Orhanerday\OpenAi\OpenAi;

// // Check if user is not logged in, redirect to login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: login.php");
//     exit;
// }

// // Include database connection
// include('db.php');

// // Function to generate response
// function generateResponse($lesson_plan, $grade, $duration_time) {
//     // Initialize OpenAI client
//     $open_ai = new OpenAi('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');
    
//     // Create prompt for OpenAI
//     $prompt = "Create a program according to the standard structure of the lesson plan. Lesson Plan name is $lesson_plan. And Grade is $grade. Duration time is $duration_time. and Translate this Lesson Plan to Mongolian Language";

//     // Request completion from OpenAI
//     $complete = $open_ai->completion([
//         'model' => 'gpt-3.5-turbo-instruct',
//         'prompt' => $prompt,
//         'temperature' => 0.9,
//         'max_tokens' => 1500,
//         'frequency_penalty' => 0,
//         'presence_penalty' => 0.6,
//     ]);

//     // Process OpenAI response
//     if ($complete) {
//         $php_obj = json_decode($complete);
//         $response = $php_obj->choices[0]->text;
//         return $response;
//     } else {
//         return "Error: Unable to fetch response.";
//     }
// }

// // Define lesson plans and grades
// $lesson_plans = ["Algorithm", "Plan B", "Plan C"];
// $grades = ["Grade 9", "Grade 10", "Grade 11"];

// // Process form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Get user input from the form
//     $lesson_plan = $_POST['lesson_plan'];
//     $grade = $_POST['grade'];
//     $duration_time = $_POST['duration_time'];

//     // Generate response
//     $response = generateResponse($lesson_plan, $grade, $duration_time);
// } else {
//     $response = ""; // Initialize response variable
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yegsong тест</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Your Brand</a>
        <!-- Add your navigation links or buttons here -->
    </nav>

    <main role="main" class="main-content">
        <div class="container-fluid">
            <!-- Form for lesson plan input -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Lesson Plan Input</h5>
                            <form method="post">
                                <div class="form-group">
                                    <label for="lesson_plan">Lesson Plan:</label>
                                    <select id="lesson_plan" name="lesson_plan" class="form-control">
                                        <?php foreach ($lesson_plans as $plan): ?>
                                            <option value="<?php echo $plan; ?>"><?php echo $plan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="grade">Grade:</label>
                                    <select id="grade" name="grade" class="form-control">
                                        <?php foreach ($grades as $grade): ?>
                                            <option value="<?php echo $grade; ?>"><?php echo $grade; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="duration_time">Duration Time:</label>
                                    <input type="text" id="duration_time" name="duration_time" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Generate Response</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Editor section -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Editor</h5>
                            <p>Pages type scale includes a range of contrasting styles that support the needs of your product and its content.</p>
                            <!-- Create the editor container -->
                            <div id="editor" style="min-height:100px;">
                                <?php echo $response; // Display response here ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
