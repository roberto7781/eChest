<?php
include_once("./database/constants.php");

if (isset($_SESSION["userid"])) {
  header("location:" . DOMAIN . "/dashboard.php");
}

?>

<!DOCTYPE html>

<html>

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap 4.0 CSS  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./includes/styles.css">
  <link rel="stylesheet" href="./css/loginStyle.css">
  <!-- Bootstrap 4.0 JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Our Own JS -->
  <script type="text/javascript" rel="stylesheet" src="./js/main.js"></script>

  <!-- FA CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- Google Font CSS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="./css/footerStyle.css" rel="stylesheet">
</head>
<!-- style="background-color:#dbf6e9;" -->

<body>
  <div class="overlay">
    <div class="loader"></div>
  </div>
  <!-- Navbar -->


  <?php
  include_once("./templates/header.php");
  ?>
  <br><br>
  <div class="container" style="margin-top:40px; margin-bottom: 70px;">

    <?php
    if (isset($_GET["msg"]) and !empty($_GET["msg"])) {
    ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $_GET["msg"] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    <?php
    }
    ?>


    <div class="card mx-auto" style="background-color:#9ddfd3;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
  width: 50%; padding-top:30px">
      <!-- <img class="card-img-top mx-auto" style="width:60%;margin-top:7px" src="./images/Login.png" alt="Login Icon"> -->
      <div class="card-body">

        <span letter-spacing="normal" style="font-size:32px;margin-bottom:12px;font-family: 'Montserrat', sans-serif;font-weight:700;">
          Welcome back!</span>

        <div style="padding: 6px 0px 48px; display: block;">
          <span letter-spacing="normal" style="font-size:18px;margin-bottom:12px;font-family: 'Montserrat', sans-serif;">
            Log in to your account.</span>
        </div>


        <!-- <h5 class="card-title">Login</h5> -->
        <form id="login_form" onsubmit="return false" style="font-family: 'Montserrat', sans-serif;">
          <div class="form-group" style="display: flex; flex-flow: column nowrap; justify-content: flex-start; align-items: normal;">

            <input type="text" class="form-control" name="log_email" id="log_email" required />
            <label>Email</label>
            <small id="email_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group" style="display: flex; flex-flow: column nowrap; justify-content: flex-start; align-items: normal;margin-top:48px; margin-bottom: 30px">

            <input type="password" class="form-control" name="log_password" id="log_password" required />
            <label>Password</label>
            <small id="password_error" class="form-text text-muted"></small>
          </div>

          <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
          <span><a href="register.php">Register</a> </span>
        </form>

      </div>
      <div class="card-footer">
        <span><a href="#">Forgot Password?</a> </span>
      </div>
    </div>

  </div>


  <?php
  include_once("./templates/footer.php");
  ?>

</body>

</html>