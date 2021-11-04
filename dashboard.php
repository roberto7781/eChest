<?php
include_once("./database/constants.php");

if (!isset($_SESSION["userid"])) {
  header("location:" . DOMAIN . "/");
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

  <!-- Bootstrap 4.0 JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <!-- FA CSS -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./fonts/icomoon/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href="./css/footerStyle.css" rel="stylesheet">

  <!-- 
  <link href="./css/siderbarAddition.css" rel="stylesheet">
  <script src="./js/sidebarAddition.js"></script> -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="./plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">

</head>

<body style="background-color:#dbf6e9;" class="hold-transition sidebar-mini">

  <div class="wrapper">
    <!-- Sidebar -->
    <?php
    include_once("./templates/sidebar.php");
    ?>
    <div class="content-wrapper" style="background-color: #dbf6e9;">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>
                Dashboard

              </h1>
            </div>

          </div>
        </div>
      </section>
      <section class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Inventory Summary
                      </h3>
                    </div>
                    <div class="card-body">
                      <div class="row">

                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-info">
                            <div class="inner" >
                              <h3 id="productCount"></h3>

                              <p>Product</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-bag"></i>
                            </div>
                            <a href="./manage_product.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-success">
                            <div class="inner">
                              <h3 id="categoryCount">

                              </h3>

                              <p>Category</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="./manage_category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-danger">
                            <div class="inner">
                              <h3 id="locationCount"></h3>

                              <p>Location</p>
                            </div>
                            <div class="icon">
                              <i class="ion ion-person-add"></i>
                            </div>
                            <a href="./manage_location.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                        <!-- ./col -->

                      </div>
                    </div>
                  </div>
                </div>



              </div>
              <!-- <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Inventory Summary
                      </h3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-3" style="margin: auto;">
                          <div class="card" style="width: 18rem;background-color:white">
                            <img class="card-img-top mx-auto" src="./images/icons/Product Icon.png" alt="Card image cap" style="width:50%; padding: 30px">
                            <div class="card-body" style="padding:8px">
                              <h4 class="card-text" style="text-align: center;" id="productCount"></h4>
                              <p class="card-text" style="text-align: center;">Product</p>

                            </div>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-md-3" style="margin: auto;">
                          <div class="card" style="width: 18rem;background-color:white">
                            <img class="card-img-top mx-auto" src="./images/icons/Location Icon.jpg" alt="Card image cap" style="width:50%; padding: 30px">
                            <div class="card-body" style="padding:8px">
                              <h4 class="card-text" style="text-align: center;" id="locationCount"></h4>

                              <p class="card-text" style="text-align: center;">Location</p>

                            </div>
                          </div>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-md-3" style="margin: auto;">
                          <div class="card" style="width: 18rem;background-color:white">
                            <img class="card-img-top mx-auto" src="./images/icons/Category Icon.png" alt="Card image cap" style="width:50%; padding: 30px">
                            <div class="card-body" style="padding:8px">
                              <h4 class="card-text" style="text-align: center;" id="categoryCount"></h4>
                              <p class="card-text" style="text-align: center;">Category</p>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </div>

          </div>

          <div class="row">

            <div class="col-12">

              <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Recent Activities
                      </h3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                          <ul class="list-group" id="recentActivities">
                            <!-- <li class="list-group-item">Cras justo odio</li>
              <li class="list-group-item">Dapibus ac facilisis in</li>
              <li class="list-group-item">Morbi leo risus</li>
              <li class="list-group-item">Porta ac consectetur ac</li>
              <li class="list-group-item">Vestibulum at eros</li> -->
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>


      </section>
    </div>
  </div>



  <!-- Category Form -->
  <?php
  include_once("./templates/category.php");
  ?>
  <!-- Location Form -->
  <?php
  include_once("./templates/location.php");
  ?>
  <!-- Product Form -->
  <?php
  include_once("./templates/product.php");
  ?>
  <!-- AdminLTE App -->

  <!-- Our Own JS -->
  <script type="text/javascript" src="./js/main.js"></script>
  <link href="./css/sidebar.css" rel="stylesheet">
  <script src="./js/sidebar.js"></script>

  <script src="./dist/js/adminlte.min.js"></script>

  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>


</body>

</html>