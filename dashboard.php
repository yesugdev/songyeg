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
$stmt_all_users = $conn->prepare("SELECT username FROM users");
$stmt_all_users->execute();
$stmt_all_users->bind_result($user_name);
$all_users = [];
while ($stmt_all_users->fetch()) {
    $all_users[] = $user_name;
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Include any additional CSS or JS libraries for graphics -->
</head>

<body>
    <header>
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>Email: <?php echo $email; ?></p>
    </header>

    <main>
        <section class="overview">
            <h2>Overview</h2>
            <div class="stats">
                <div class="stat">
                    <h3>Lesson Plans</h3>
                    <p><?php echo $lesson_plans_count; ?></p>
                </div>
                <div class="stat">
                    <h3>Total Cost Usage</h3>
                    <p><?php echo $total_cost_usage; ?></p>
                </div>
                <!-- Add more stats as needed -->
            </div>
        </section>

        <section class="users">
            <h2>All Users</h2>
            <ul>
                <?php foreach ($all_users as $user) : ?>
                    <li><?php echo $user; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="grades">
            <h2>Grades for Lesson Plans</h2>
            <ul>
                <?php foreach ($grades as $grade) : ?>
                    <li><?php echo $grade; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section class="subjects">
            <h2>Subjects for Lesson Plans</h2>
            <ul>
                <?php foreach ($subjects as $subject) : ?>
                    <li><?php echo $subject; ?></li>
                <?php endforeach; ?>
            </ul>
        </section>
    </main>

    <footer>
        <p><a href="logout.php">Logout</a></p>
    </footer>

    <!-- Include any additional scripts for graphics -->
</body>

</html>
