<!DOCTYPE html>

<html>

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap 4.0 CSS  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Bootstrap 4.0 JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- Our Own JS -->
  <script type="text/javascript" src="./js/main.js"></script>

  <!-- FA CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="./includes/styles.css">
  <link rel="stylesheet" href="./css/registerStyle.css">

  <!-- Google Font CSS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="./fonts/icomoon/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
  <link href="./css/footerStyle.css" rel="stylesheet">
</head>

<body>

  <div class="overlay">
    <div class="loader"></div>
  </div>
  <!-- Navbar -->
  <?php
  include_once("./templates/header.php");
  ?>

  <div class="container" style="margin-top:40px; margin-bottom: 50px;">
    <br><br>

    <div class="card mx-auto" style="background-color:#9ddfd3;
  box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
  width: 45%;">
      <div class="card-header" style="font-family: 'Montserrat', sans-serif;">Register</div>
      <div class="card-body">
        <form id="register_form" onsubmit="return false" autocomplete="off">
          <div class="form-group" style="margin-top:10px">

            <input id="userName" type="text" name="userName" class="form-control" required />
            <label for="userName">Name</label>
            <small id="user_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">

            <input type="email" name="email" class="form-control" id="email" required />
            <label for="email">Email</label>
            <small id="email_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">

            <input type="password" name="password1" class="form-control" id="password1" required />
            <label for="password1">Password</label>
            <small id="password1_error" class="form-text text-muted"></small>
          </div>

          <div class="form-group">

            <input type="password" name="password2" class="form-control" id="password2" required />
            <label for="password2">Re-enter Password</label>
            <small id="password2_error" class="form-text text-muted"></small>
          </div>

          <!-- <div class="form-group">
            <label for="userType">Usertype</label>
            <select name="userType" class="form-control" id="userType">
            <option value="">Choose User Type</option>
            <option value="1">Admin</option>
            <option value="0">Other</option>
            </select>
            <small id="type_error" class="form-text text-muted"></small>
          </div> -->
          <button type="submit" class="btn btn-primary"><i class="fa fa-user">&nbsp;</i>Register</button>
          <span><a href="index.php">Login</a> </span>

        </form>

      </div>
      <div class="card-footer">

      </div>
    </div>

  </div>
  <?php
  include_once("./templates/footer.php");
  ?>

</body>

</html>