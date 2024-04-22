<?php
// Start session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include database connection
include('db.php');

// Retrieve user information from the database
$stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
$stmt->bind_param("i", $param_id);
$param_id = $_SESSION["user_id"];
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();

// Count number of lesson plans
$stmt_lesson_plans = $conn->prepare("SELECT COUNT(*) FROM lesson_plans");
$stmt_lesson_plans->execute();
$stmt_lesson_plans->bind_result($lesson_plans_count);
$stmt_lesson_plans->fetch();
$stmt_lesson_plans->close();

// Get total cost usage
$stmt_cost_usage = $conn->prepare("SELECT SUM(cost) FROM lesson_plans");
$stmt_cost_usage->execute();
$stmt_cost_usage->bind_result($total_cost_usage);
$stmt_cost_usage->fetch();
$stmt_cost_usage->close();

// Get all users' names
$stmt_all_users = $conn->prepare("SELECT username, email FROM users");
$stmt_all_users->execute();
$stmt_all_users->bind_result($user_name, $user_email);
$all_users = [];
while ($stmt_all_users->fetch()) {
    $all_users[] = ['username' => $user_name, 'email' => $user_email];
}
$stmt_all_users->close();

// Get grades for lesson plans
$stmt_grades = $conn->prepare("SELECT grade FROM lesson_plans GROUP BY grade");
$stmt_grades->execute();
$stmt_grades->bind_result($grade);
$grades = [];
while ($stmt_grades->fetch()) {
    $grades[] = $grade;
}
$stmt_grades->close();

// Get subjects for lesson plans
$stmt_subjects = $conn->prepare("SELECT subject FROM lesson_plans GROUP BY subject");
$stmt_subjects->execute();
$stmt_subjects->bind_result($subject);
$subjects = [];
while ($stmt_subjects->fetch()) {
    $subjects[] = $subject;
}
$stmt_subjects->close();
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
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <link rel="stylesheet" href="css/select2.css">
    <link rel="stylesheet" href="css/dropzone.css">
    <link rel="stylesheet" href="css/uppy.min.css">
    <link rel="stylesheet" href="css/jquery.steps.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/quill.snow.css">
    
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
</head>
<body class="vertical  light">
<div class="wrapper">
    <!-- Include PHP for navigation bar -->
    <?php include_once "navbar.php"; ?>
    <!-- Include PHP for left sidebar -->
    <?php include_once "sidebar.php"; ?>
    <main role="main" class="main-content">
        <div class="container-fluid">
            <!-- Include PHP for main content -->
            <?php include_once "content.php"; ?>
        </div>
    </main>
</div>
<!-- Include PHP for JavaScript files -->
<?php include_once "scripts.php"; ?>
</body>
</html>
