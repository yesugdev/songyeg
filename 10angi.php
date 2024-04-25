<?php
// session_start();
// require_once __DIR__ . '/vendor/autoload.php'; // Include Composer autoloader
// use Orhanerday\OpenAi\OpenAi;

// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: login.php");
//     exit;
// }
// include('db.php');
// $stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
// $stmt->bind_param("i", $param_id);
// $param_id = $_SESSION["user_id"];
// $stmt->execute();
// $stmt->bind_result($username, $email);
// $stmt->fetch();
// $stmt->close();
// // function generateResponse($lesson_plan, $grade, $duration_time) {

//     $open_ai = new OpenAi('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');
//     $prompt = "Create a program according to the standard structure of the lesson plan. Lesson Plan name is $lesson_plan. And Grade is $grade.Always with time. Duration time is $duration_time. and Translate this Lesson Plan to Mongolian Language. Student is translated as сурагч";
//     $complete = $open_ai->completion([
//         'model' => 'gpt-3.5-turbo-instruct',
//         'prompt' => $prompt,
//         'temperature' => 0.9,
//         'max_tokens' => 1500,
//         'frequency_penalty' => 0,
//         'presence_penalty' => 0.6,
//     ]);
//     if ($complete) {
//         $php_obj = json_decode($complete);
//         $response = $php_obj->choices[0]->text;
//         return $response;
//     } else {
//         return "Error: Unable to fetch response.";
//     }
// }

// $lesson_plans = ["Algorithm", "Plan B", "Plan C"];
// $grades = ["10th Grade"];

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $lesson_plan = $_POST['lesson_plan'];
//     $grade = $_POST['grade'];
//     $duration_time = $_POST['duration_time'];
//     $response = generateResponse($lesson_plan, $grade, $duration_time);
// } else {
//     $response = ""; 
// }

?>


<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Yegsong Beta</title>
    <link rel="stylesheet" href="css/simplebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>
<body class="vertical  light">
<div class="wrapper">
    <?php include_once "navbar.php"; ?>
    <?php include_once "sidebar.php"; ?>
    <main role="main" class="main-content">
        <div class="container-fluid">
            <!-- main content -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Хичээлийн төлөвлөгөө боловсруулах туршилт</h5>
                            <form method="post">
                                <div class="form-group">
                                    <label for="lesson_plan">Ээлжит хичээлийн хөтөлбөр сонгох:</label>
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
                                    <label for="duration_time">Хугацаа:</label>
                                    <input type="text" id="duration_time" name="duration_time" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Гаргах</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">Үр дүн</h5>
                            <!-- editor container -->
                            <div id="editor" style="min-height:100px;">
                            // <?php //echo nl2br($response); ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include_once "scripts.php"; ?>
</body>
</html>
