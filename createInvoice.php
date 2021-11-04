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

  <!-- Our Own JS -->
  <script type="text/javascript" src="./js/invoice.js"></script>
  <link href="./css/sidebar.css" rel="stylesheet">
  <script src="./js/sidebar.js"></script>
  <script type="text/javascript" src="./js/main.js"></script>
  <!-- FA CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="./plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="./plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body style="background-color:#dbf6e9;" class="hold-transition sidebar-mini layout-fixed ">

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
                Invoice

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
                        Create Invoice
                      </h3>
                    </div>
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-10 mx-auto">
                          <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                            <div class="card-header">
                              <h4>Invoice</h4>
                            </div>
                            <div class="card-body">
                              <form id="invoiceForm" onsubmit="return false">
                                <div class="form-group row">
                                  <label class="col-sm-3" align="right">Invoice Date</label>
                                  <div class="col-sm-6">
                                    <input type="text" id="invoiceDate" name="invoiceDate" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label class="col-sm-3" align="right">Customer Name</label>
                                  <div class="col-sm-6">
                                    <input type="text" id="customerName" name="customerName" class="form-control form-control-sm" palceholder="Customer Name" required />
                                  </div>
                                </div>

                                <div class="card" style="box-shadow:0 0 40px 0 lightgrey;">
                                  <div class="card-body">
                                    <h3>Product List</h3>
                                    <table align="center" style="width:800px;">
                                      <thread>
                                        <tr>
                                          <th>#</th>
                                          <th style="text-align:center;">Product Name</th>
                                          <th style="text-align:center;">Total Quantity</th>
                                          <th style="text-align:center;">Quantity</th>
                                          <th style="text-align:center;">Price</th>
                                          <th>Total</th>

                                        </tr>

                                      </thread>

                                      <tbody id="invoice_item">
                                        <!-- <tr>
                        <td><b id="number">1</b></td>
                        <td>
                          <select name="" class="form-control form-control-sm">
                            <option></option>

                          </select>
                        </td>

                        <td><input name="tqty[]" type="text" class="form-control form-control-sm"></td>
                        <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
                        <td><input name="price[]" type="text" class="form-control form-control-sm" required></td>
                        <td>1234</td>
                      </tr> -->

                                      </tbody>


                                    </table>
                                    <center style="padding:15px;">
                                      <button class="btn btn-success" style="width:150px;" id="add">Add</button>
                                      <button class="btn btn-danger" style="width:150px;" id="remove">remove</button>
                                    </center>
                                  </div>
                                </div>

                                <p></p>
                                <div class="form-group row">
                                  <label for="subTotal" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                                  <div class="col-sm-6">
                                    <input type="text" readonly class="form-control form-control-sm" name="subTotal" id="subTotal" required />
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                                  <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="discount" id="discount" required />
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="netTotal" class="col-sm-3 col-form-label" align="right">Net Total</label>
                                  <div class="col-sm-6">
                                    <input type="text" readonly class="form-control form-control-sm" name="netTotal" id="netTotal" required />
                                  </div>

                                </div>

                                <div class="form-group row">
                                  <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                                  <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-sm" name="paid" id="paid" required />
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                                  <div class="col-sm-6">
                                    <input type="text" readonly class="form-control form-control-sm" name="due" id="due" required />
                                  </div>
                                </div>

                                <div class="form-group row">
                                  <label for="paymentType" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                                  <div class="col-sm-6">
                                    <select name="paymentType" id="paymentType" class="form-control form-control-sm" required />
                                    <option>Cash</option>
                                    <option>Card</option>
                                    </select>
                                  </div>
                                </div>
                                <center style="padding:15px;">
                                  <button type="submit" id="invoiceFormSubmit" class="btn btn-info" style="width:150px;">Add</button>
                                  <button type="submit" id="printInvoice" class="btn btn-success d-none" style="width:150px;">remove</button>
                                </center>

                              </form>

                            </div>
                          </div>

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


  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>

  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="./plugins/toastr/toastr.min.js"></script>

   <!-- AdminLTE App -->
   <script src="./dist/js/adminlte.min.js"></script>
</body>

</html>