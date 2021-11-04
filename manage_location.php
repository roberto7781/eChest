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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

  <!-- Our Own JS -->
  <script src="./js/manage.js"></script>
  <link href="./css/sidebar.css" rel="stylesheet">
  <script src="./js/sidebar.js"></script>
  
  <!-- FA CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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


<body style="background-color:#dbf6e9;"  class="hold-transition sidebar-mini">

  <!-- Navbar -->


  <!-- <br><br> -->


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
              Location

              </h1>
            </div>

          </div>
        </div>
      </section>
      <section class="content">

        <div class="container-fluid">

          <div class="row">

            <div class="col-12">

              <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                  <div class="card card-primary card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Location List
                      </h3>
                    </div>
                    <div class="card-body">
                    <table id="table" class="table table-bordered table-striped" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Location</th>
                    <th data-orderable="false">Action</th>
                  </tr>
                </thead>
                <tbody id="getBrand">

                </tbody>
              </table>
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
    


  <?php

  include_once("./templates/update_location.php");
  ?>
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
  <!--===============================================================================================-->

  <!--===============================================================================================-->
  <script src="./vendor/bootstrap/js/popper.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="./vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <!-- <script src="./js/table.js"></script> -->
  <link href="./css/dataTable.css" rel="stylesheet">

   <!-- AdminLTE App -->
   <script src="./dist/js/adminlte.min.js"></script>

   
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>