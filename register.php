<?php
// Start session
session_start();

// Include database connection
include('db.php');

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM users WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "Энэ хэрэглэгчийн нэр нь аль хэдийн байна.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Алдаа! Дахин бүртгүүлж үзнэ үү..";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Имэйлээ оруулна уу.";
    } else {
        $email = trim($_POST["email"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Хүчингүй имэйл формат.";
        }
    }

    // Validate password
  // Validate password strength
if (empty(trim($_POST["password"]))) {
    $password_err = "Нууц үг оруулна уу.";
} elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Нууц үг дор хаяж 6 тэмдэгттэй байх ёстой.";
} elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/", trim($_POST["password"]))) {
    $password_err = "Нууц үг нь дор хаяж нэг том үсэг, нэг жижиг үсэг, нэг цифр агуулсан байх ёстой.";
} else {
    $password = trim($_POST["password"]);
}


    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Нууц үгээ баталгаажуулна уу.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Нууц үг таарахгүй байна.";
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_username, $param_email, $param_password);

            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: dashboard.php");
            } else {
                echo "Алдаа! Дахин бүртгүүлж эсвэл нэвтэрч үзнэ үү.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/style.css">

</head>
<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">YEGSONG</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                <form action="register.php" method="post" class="signin-form">
        <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Нэвтрэх нэр" required>
        </div>
         <div class="form-group">
        <input type="text" class="form-control" name="email" placeholder="Email" required>
        </div>
         <div class="form-group">
        <input id="password-field" type="password" class="form-control" name="password" placeholder="Нууц үг" required>
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
        </div>
         <div class="form-group">
        <input id="confirm-password-field" type="password" class="form-control" name="confirm_password" placeholder="Нууц үг давтах" required>
         </div>
         <div class="form-group">
        <?php echo (!empty($password_err)) ? '<p class="text-danger">' . $password_err . '</p>' : ''; ?>
         </div>
        <div class="form-group">
        <?php echo (!empty($username_err)) ? '<p class="text-danger">' . $username_err . '</p>' : ''; ?>
         </div>
            <div class="form-group">
        <?php
        // Display error message if registration fails
        if (isset($error)) {
            echo '<p class="text-danger">' . $error . '</p>';
        }
        ?>
         </div>
         <button type="submit" class="form-control btn btn-primary submit px-3">БҮРТГҮҮЛЭХ</button>
        </form>


                    <p class="w-100 text-center">&mdash; <a href="login.php">Нэвтрэх</a> &mdash;</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
