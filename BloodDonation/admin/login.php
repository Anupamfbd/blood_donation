<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>

    .login-container {
      margin-top: 150px;
      background-color: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      opacity: 90%;
    }
    .login-container h2 {
      color: #333;
    }
    .form-control {
      border-color: #ced4da;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>


</head>

<body style="background-image: url('admin_image/bdscreen.png');background-repeat: no-repeat;background-size:cover">

  
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 login-container">
      <h2 class="text-center mb-4">Admin Login</h2>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
      </form>
    </div>
  </div>
</div>
 
    <?php
    include 'conn.php';

    if (isset($_POST["login"])) {

      $username = mysqli_real_escape_string($conn, $_POST["username"]);
      $password = mysqli_real_escape_string($conn, $_POST["password"]);

      $sql = "SELECT * from admin_info where admin_username='$username' and admin_password='$password'";
      $result = mysqli_query($conn, $sql) or die("query failed.");

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION["username"] = $username;
          header("Location: dashboard.php");
        }
      } else {
        echo '<div class="alert alert-danger" style="font-weight:bold"> Username and Password are not matched!</div>';
      }
    }
    ?>
</body>

</html>