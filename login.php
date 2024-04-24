<?php
session_start();

include('db.php');

$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, username, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['loggedin'] = true;
            header("Location: index.php");
            exit();
        } else {
            $password_err = "Хэрэглэгчийн нэр эсвэл нууц үг буруу.";
        }
    } else {
        $username_err = "Хэрэглэгчийн нэр эсвэл нууц үг буруу.";
    }
    $stmt->close();
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Login 10</title>
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
          <form action="login.php" method="post" class="signin-form">
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Нэвтрэх нэр" required>
        <?php echo (!empty($username_err)) ? '<p class="text-danger">' . $username_err . '</p>' : ''; ?>
    </div>
    <div class="form-group">
        <input id="password-field" type="password" class="form-control" name="password" placeholder="Нууц үг" required>
        <?php echo (!empty($password_err)) ? '<p class="text-danger">' . $password_err . '</p>' : ''; ?>
        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary submit px-3">НЭВТРЭХ</button>
    </div>
</form>

            <p class="w-100 text-center">&mdash; <a href="register.php">Бүртгүүлэх</a> &mdash;</p>
            
            <div class="social d-flex text-center">
              <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
              <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Google</a>
            </div>
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
