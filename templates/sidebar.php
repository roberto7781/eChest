<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark" style="background-color:#343a40;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <div class="navbar-search-block" id="main-header-search">
        <form class="form-inline">
          <div class="input-group input-group-sm">
    
            <div class="input-group-append">
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
          <a href="./logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li>
  </ul>
</nav>
<!-- /.navbar -->


<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="./dashboard.php" class="brand-link">
    <img src="./images/e-logo.jpg" class="brand-image img-circle elevation-3">

    <span class="brand-text font-weight-light">e-Chest</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="./images/user.jpg" class="img-circle elevation-2">
      </div>
      <div class="info" id="profileInformation">

      </div>
    </div>



    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-item">
          <a href="./dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard

            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-shopping-cart"></i>
            <p>
              Product
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" data-toggle="modal" data-target="#form_product" class="nav-link">Add

              </a>
            </li>
            <li class="nav-item">
              <a href="manage_product.php" class="nav-link">Manage</a>
            </li>
            <!-- <li>
                  <a href="#">Credit cart</a>
                </li> -->
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-chart-line"></i>
            <p>
              Category
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" data-toggle="modal" data-target="#form_category" class="nav-link">Add

              </a>
            </li>
            <li class="nav-item">
              <a href="manage_category.php" class="nav-link">Manage</a>
            </li>
            <!-- <li>
                  <a href="#">Credit cart</a>
                </li> -->
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-gem"></i>
            <p>
              Location
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" data-toggle="modal" data-target="#form_location" class="nav-link">Add

              </a>
            </li>
            <li class="nav-item">
              <a href="manage_location.php" class="nav-link">Manage</a>
            </li>
            <!-- <li>
                  <a href="#">Credit cart</a>
                </li> -->
          </ul>
        </li>
        <li class="nav-item">
          <a href="createInvoice.php" class="nav-link">
            <i class="nav-icon fa fa-book"></i>
            <p>
              Create Invoice

            </p>
            <!-- <span class="badge badge-pill badge-primary">Beta</span> -->
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-calendar"></i>
           <p>
             Upgrade Membership
           </p>
          </a>
        </li> -->

     

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>