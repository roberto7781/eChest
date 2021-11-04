<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");
//FOR REGISTRATION
if (isset($_POST["userName"]) and isset($_POST["email"])) {
  $user = new User();
  $result = $user->createUserAccount($_POST["userName"], $_POST["email"], $_POST["password1"], "Admin");
  // $result = $user->createUserAccount($_POST["userName"], $_POST["email"], $_POST["password1"], $_POST["userType"]);
  echo $result;

  exit();
}

//FOR LOGIN
if (isset($_POST["log_email"]) and isset($_POST["log_password"])) {
  $user = new User();
  $result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);

  echo $result;

  exit();
}
function timeAgo($timestamp)
{
  $datetime1 = new DateTime("now");
  $datetime2 = date_create($timestamp);
  $diff = date_diff($datetime1, $datetime2);
  $timemsg = '';
  if ($diff->y > 0) {
    $timemsg = $diff->y . ' year';
  } else if ($diff->m > 0) {
    $timemsg = $diff->m . ' month';
  } else if ($diff->d > 0) {
    $timemsg = $diff->d . ' day';
  } else if ($diff->h > 0) {
    $timemsg = $diff->h . ' hour';
  } else if ($diff->i > 0) {
    $timemsg = $diff->i . ' minute';
  } else if ($diff->s > 0) {
    $timemsg = $diff->s . ' second';
  } else {
    $timemsg = '0 second';
  }

  $timemsg = $timemsg . ' ago';
  return $timemsg;
}

if (isset($_POST["getUser"]) and isset($_SESSION["userid"])) {

  $getUser = new User();
  $rows = $getUser->getUserInformation("user", $_SESSION["userid"]);


  foreach ($rows as $row) {

?>

    <a href="#" class="d-block"><?php echo $row["userName"]; ?>
    </a>


    <?php
  }

  // echo $result;

  exit();
}


if (isset($_POST["getLog"]) and isset($_SESSION["userid"])) {
  $getUser = new User();
  $rows = $getUser->getUserInformation("user_log", $_SESSION["userid"]);

  if ($rows != 'NO_DATA') {

    foreach ($rows as $row) {
      $dateAgo = timeAgo($row["addedDate"]);
    ?>
      <?php
      if ($row["action"] == "added") {
        $msg = "to";
      } else {
        $msg = "from";
      }

      if ($row["actionType"] == "invoice") {
      ?>
        <li class="list-group-item"><?php echo $row["actionType"]; ?> <?php echo "for" ?> <?php echo $row["logHistory"]; ?> has been <?php echo $row["action"]; ?> <?php echo $dateAgo ?></li>
      <?php

      } else {
      ?>
        <li class="list-group-item"><?php echo $row["logHistory"]; ?> has been <?php echo $row["action"]; ?> <?php echo $msg ?> <?php echo $row["actionType"]; ?> <?php echo $dateAgo ?></li>
    <?php
      }
    }
  } else {
    ?>

    <li class="list-group-item">NO RECENT ACTIVITIES</li>


  <?php

  }

  exit();
}

//TO GET TOTAL PRODUCT

if (isset($_POST["totalProduct"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getTotal("product");


  foreach ($rows as $row) {
    echo $row;
  }


  exit();
}

//TO GET TOTAL CATEGORY

if (isset($_POST["totalCategory"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getTotal("category");


  foreach ($rows as $row) {
    echo $row;
  }


  exit();
}

//TO GET TOTAL LOCATION

if (isset($_POST["totalLocation"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getTotal("location");


  foreach ($rows as $row) {
    echo $row;
  }


  exit();
}

//TO GET CATEGORY

if (isset($_POST["getCategory"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getAllCategory("category");

  foreach ($rows as $row) {
    echo "<option value=" . $row["categoryID"] . ">" . $row["categoryName"] . "</option>";
  }

  exit();
}

//TO GET LOCATION

if (isset($_POST["getLocation"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getAllLocation("location");

  foreach ($rows as $row) {
    echo "<option value=" . $row["locationID"] . ">" . $row["locationName"] . "</option>";
  }

  exit();
}
//ADD CATEGORY

if (isset($_POST["categoryName"]) and isset($_POST["parentCategory"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $result = $obj->addCategory($_POST["parentCategory"], $_POST["categoryName"]);

  echo $result;

  $result = $obj->addLog("" . $_POST["categoryName"] . "", "added", "category");
  exit();
}

//ADD LOCATION

if (isset($_POST["locationName"]) and isset($_SESSION["userid"])) {

  $obj = new DBOperation();
  $result = $obj->addLocation($_POST["locationName"] );

  echo $result;
  $result = $obj->addLog("" . $_POST["locationName"] . "", "added", "location");
  exit();
}

//ADD PRODUCT

if (isset($_POST["addedDate"]) and isset($_POST["productName"]) and isset($_SESSION["userid"])) {

  $obj = new DBOperation();

  

    $result = $obj->addProduct(
      $_POST["selectCategory"],
      $_POST["selectLocation"],
      $_POST["productName"],
      $_POST["productPrice"],
      $_POST["productStock"],
      $_POST["addedDate"],
      $_POST["productStockLimit"] 
    );

  echo $result;
  $result = $obj->addLog("" . $_POST["productName"] . "", "added", "product");
  exit();
}


//Manage Category

if (isset($_POST["manageCategory"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("category", $_POST["pageno"]);
  $row = $result;
  $n = 1;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Category"]; ?></td>
      <td><?php echo $row["Parent"]; ?></td>

      <td>
        <a href="#" eid="<?php echo $row["categoryID"]; ?>" cim="<?php echo $row["Category"]; ?>" class="btn btn-info btn-sm editCat" data-toggle="modal" data-target="#update_category">Edit</a>
        <a href="#" did="<?php echo $row["categoryID"]; ?>" cim="<?php echo $row["Category"]; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>

      </td>
    </tr>

  <?php
    $n++;
  }

  echo "
      
     <script>
     $(document).ready(function () {

      $('#table').DataTable({
        'bDestroy': true,
        columnDefs: [
        { 'width': '30px', 'targets': [0] },
        { 'width': '150px', 'targets': [3] },
        {'className': 'dt-center', 'targets': [0,2,3]}
    ]});

      });
     </script> ";


  exit();
}


if (isset($_POST["relaunchCategory"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("category", $_POST["pageno"]);
  $row = $result;
  $n = 1;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Category"]; ?></td>
      <td><?php echo $row["Parent"]; ?></td>


      <td>
        <a href="#" eid="<?php echo $row["categoryID"]; ?>" cim="<?php echo $row["Category"]; ?>" class="btn btn-info btn-sm editCat" data-toggle="modal" data-target="#update_category">Edit</a>
        <a href="#" did="<?php echo $row["categoryID"]; ?>" cim="<?php echo $row["Category"]; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>

      </td>
    </tr>

  <?php
    $n++;
  }
  echo "
      
     <script>
     $(document).ready(function () {

      $('#table').DataTable({columnDefs: [
        { 'width': '30px', 'targets': [0] },
        { 'width': '150px', 'targets': [3] },
        {'className': 'dt-center', 'targets': [0,2,3]}
    ]});

      });
     </script> ";
  exit();
}

//DELETE CATEGORY
if (isset($_POST["deleteCategory"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->deleteRecord("category", "categoryID", $_POST["id"]);

  echo $result;

  if ($result == "DELETED" || $result == "CATEGORY_DELETED") {

    $obj = new DBOperation();
    $obj->addLog("" . $_POST["cname"] . "", "deleted", "category");
  }


  exit();
}

//UPDATE CATEGORY

if (isset($_POST["updateCategory"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->getSingleRecord("category", "categoryID", $_POST["id"]);
  echo json_encode($result);

  exit();
}

//UPDATE CATEGORY AFTER GETTING DATA
if (isset($_POST["updateCategoryName"]) and isset($_SESSION["userid"])) {

  $obj = new Manage();
  $id = $_POST["categoryID"];
  $updateCategoryName = $_POST["updateCategoryName"];
  $updateParentCategory  = $_POST["updateParentCategory"];
  $result = $obj->updateRecord("category", ["categoryID" => $id], ["parentCategory" => $updateParentCategory, "categoryName" => $updateCategoryName, "status" => 1]);

  echo $result;


  if ($result == "UPDATED") {

    $obj = new DBOperation();
    $obj->addLog("" . $_POST["updateCategoryName"] . "", "updated", "category");
  }
}


//Get All Product

if (isset($_POST["checkStock"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $array = $obj->getRecord("product");
  $n  = 0;
  // foreach ($array as $row) {

  //   echo $row["productName"];
  //   echo $row["productStock"];
  //   echo $row["productLimit"];

  // }

  echo json_encode($array);

  exit();
}

//Manage Location

if (isset($_POST["manageLocation"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("location", $_POST["pageno"]);
  $row = $result;
  $n = 1;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["locationName"]; ?></td>


      <td>
        <a href="#" eid="<?php echo $row["locationID"]; ?>" lim="<?php echo $row["locationName"]; ?>" class="btn btn-info btn-sm editLocation" data-toggle="modal" data-target="#update_location">Edit</a>
        <a href="#" did="<?php echo $row["locationID"]; ?>" lim="<?php echo $row["locationName"]; ?>" class="btn btn-danger btn-sm delLocation">Delete</a>

      </td>
    </tr>

  <?php
    $n++;
  }

  echo "
      
  <script>
  $('#table').DataTable({
    'bDestroy': true,
    columnDefs: [
    { 'width': '30px', 'targets': [0] },

  
    {'className': 'dt-center', 'targets': [0,2]}
]});
  </script> ";
  exit();
}

//Relaunch Location

if (isset($_POST["relaunchLocation"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("location", $_POST["pageno"]);
  $row = $result;
  $n = 1;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["locationName"]; ?></td>


      <td>
        <a href="#" eid="<?php echo $row["locationID"]; ?>" lim="<?php echo $row["locationName"]; ?>" class="btn btn-info btn-sm editLocation" data-toggle="modal" data-target="#update_location">Edit</a>
        <a href="#" did="<?php echo $row["locationID"]; ?>" lim="<?php echo $row["locationName"]; ?>" class="btn btn-danger btn-sm delLocation">Delete</a>


      </td>
    </tr>

  <?php
    $n++;
  }

  echo "
      
  <script>
  $('#table').DataTable(
    
    {columnDefs: [
    { 'width': '30px', 'targets': [0] },

  
    {'className': 'dt-center', 'targets': [0,2]}
]});
  </script> ";

  exit();
}


//DELETE Location
if (isset($_POST["deleteLocation"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->deleteRecord("location", "locationID", $_POST["id"]);

  echo $result;

  if ($result == "DELETED") {

    $obj = new DBOperation();
    $obj->addLog("" . $_POST["lname"] . "", "deleted", "location");
  }

  exit();
}


//UPDATE LOCATION

if (isset($_POST["updateLocation"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->getSingleRecord("location", "locationID", $_POST["id"]);
  echo json_encode($result);

  exit();
}

//UPDATE LOCATION AFTER GETTING DATA
if (isset($_POST["updateLocationName"]) and isset($_SESSION["userid"])) {

  $obj = new Manage();
  $id = $_POST["locationID"];
  $updateLocationName = $_POST["updateLocationName"];
  $result = $obj->updateRecord("location", ["locationID" => $id], ["locationName" => $updateLocationName]);

  echo $result;

  if ($result == "UPDATED") {

    $obj = new DBOperation();
    $obj->addLog("" . $_POST["updateLocationName"] . "", "updated", "location");
  }
}



//Manage Product

if (isset($_POST["manageProduct"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("product", $_POST["pageno"]);
  $row = $result;
  $n = 1;

  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>


      <td><?php echo $n; ?></td>
      <td><?php echo $row["productName"]; ?></td>
      <td><?php echo $row["categoryName"]; ?></td>
      <td><?php echo $row["locationName"]; ?></td>
      <td><?php echo $row["productPrice"]; ?></td>
      <td><?php echo $row["productStock"]; ?></td>
      <td><?php echo $row["addedDate"]; ?></td>



      <td style=" text-align:center">
        <a href="#" eid="<?php echo $row["productID"]; ?>" pim="<?php echo $row["productName"]; ?>" class="btn btn-info btn-sm editProduct" data-toggle="modal" data-target="#update_product">Edit</a>
        <a href="#" did="<?php echo $row["productID"]; ?>" pim="<?php echo $row["productName"]; ?>" imgID="<?php echo $row["productImage"]; ?>" class="btn btn-danger btn-sm delProduct">Delete</a>

      </td>
    </tr>

  <?php
    $n++;
  }

  echo "
      
    <script>
    $('#table').DataTable({
      'bDestroy': true,
      select: true,
      columnDefs: [
      { 'width': '30px', 'targets': [0] },
      { 'width': '150px', 'targets': [7] },
     
      {'className': 'dt-center', 'targets': [0,6,7]}
  ]});
    </script> ";
  exit();
}

//Relaunch Product

if (isset($_POST["relaunchProduct"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->manageRecord("product", $_POST["pageno"]);
  $row = $result;
  $n = 1;
  while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
  ?>

    <tr>


      <td><?php echo $n; ?></td>
      <td><?php echo $row["productName"]; ?></td>
      <td><?php echo $row["categoryName"]; ?></td>
      <td><?php echo $row["locationName"]; ?></td>
      <td><?php echo $row["productPrice"]; ?></td>
      <td><?php echo $row["productStock"]; ?></td>
      <td><?php echo $row["addedDate"]; ?></td>

 

      <td style=" text-align:center">
        <a href="#" eid="<?php echo $row["productID"]; ?>" pim="<?php echo $row["productName"]; ?>" class="btn btn-info btn-sm editProduct" data-toggle="modal" data-target="#update_product">Edit</a>
        <a href="#" did="<?php echo $row["productID"]; ?>" pim="<?php echo $row["productName"]; ?>" imgID="<?php echo $row["productImage"]; ?>" class="btn btn-danger btn-sm delProduct">Delete</a>

      </td>
    </tr>

  <?php
    $n++;
  }
  echo "
      
  <script>
  $('#table').DataTable({
    select: true,
    columnDefs: [
    { 'width': '30px', 'targets': [0] },
    { 'width': '150px', 'targets': [7] },
   
    {'className': 'dt-center', 'targets': [0,6,7]}
]});
  </script> ";
  exit();
}

//DELETE Product
if (isset($_POST["deleteProduct"]) and isset($_SESSION["userid"]))  {
  $obj = new Manage();
  $result = $obj->deleteRecord("product", "productID", $_POST["id"]);

  echo $result;

  if (($result == "DELETED" || $result == "CATEGORY_DELETED") ) {
    $target = "../product_image/" . $_POST["imgName"];
    if(file_exists($target)){
      unlink($target);
    }
    
    $obj = new DBOperation();
    $obj->addLog("" . $_POST["pname"] . "", "deleted", "product");
  }
}

//UPDATE PRODUCT

if (isset($_POST["updateProduct"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->getSingleRecord("product", "productID", $_POST["id"]);
  echo json_encode($result);

  exit();
}

//UPDATE PRODUCT AFTER GETTING DATA
if (isset($_POST["updateProductName"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $id = $_POST["productID"];
  $updateProductName = $_POST["updateProductName"];
  $selectCategory =  $_POST["selectUpdateCategory"];
  $selectLocation = $_POST["selectUpdateLocation"];
  $productPrice = $_POST["updateProductPrice"];
  $productStock =  $_POST["updateProductStock"];
  $addedDate =  $_POST["addedDate"];
  $productLimit = $_POST["updateProductStockLimit"];
  
  
  $result = $obj->updateRecord("product", ["productID" => $id], ["categoryID" => $selectCategory, "locationID" => $selectLocation, "productName" => $updateProductName, "productPrice" => $productPrice, "productStock" => $productStock, "addedDate" => $addedDate, "productLimit" => $productLimit]);


  echo $result;

  if ($result == "UPDATED") {
    $target = "../product_image/";
    $targetFile = $target . basename($_FILES['updateProductImage']['name']);
    move_uploaded_file($_FILES['updateProductImage']["tmp_name"], $targetFile);
    $obj = new DBOperation();
    $obj->addLog("" . $_POST["updateProductName"] . "", "updated", "product");
  }
}

// if (isset($_POST["addedDate"]) and isset($_POST["productName"])) {
//   $obj = new DBOperation();
//   $result = $obj->addProduct(
//     $_POST["selectUpdateCategory"],
//     $_POST["selectUpdateLocation"],
//     $_POST["productName"],
//     $_POST["productPrice"],
//     $_POST["productStock"],
//     $_POST["addedDate"],
//     $_POST["updateProductStockLimit"]
//   );

//   echo $result;

//   exit();
// }

//----------------------INVOICE-----------------------//

if (isset($_POST["getNewOrderItem"]) and isset($_SESSION["userid"])) {
  $obj = new DBOperation();
  $rows = $obj->getAllRecord("product");

  ?>
  <tr>
    <td><b class="number">1</b></td>
    <td>
      <select name="" class="form-control form-control-sm productID">

        <option value="">Choose Product</option>
        <?php
        foreach ($rows as $row) {
        ?>
          <option value="<?php echo $row["productID"] ?>"><?php echo $row["productName"] ?></option>
        <?php
        }
        ?>


      </select>
    </td>

    <td><input name="tqty[]" type="text" class="form-control form-control-smt tqty" readonly></td>
    <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
    <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly required></td>
    <input name="productName[]" type="hidden" class="form-control form-control-sm productName" required>
    <input name="productID[]" type="hidden" class="form-control form-control-sm productID" required>
    <td>Rp. <span class="amt">0</span></td>
  </tr>

<?php


  exit();
}


//INVOICE PART



//GETTING PRODUCT DATA FOR INVOICE

if (isset($_POST["getData"]) and isset($_SESSION["userid"])) {
  $obj = new Manage();
  $result = $obj->getSingleRecord("product", "productID", $_POST["id"]);

  echo json_encode($result);

  exit();
}


if (isset($_POST["invoiceDate"]) and isset($_POST["customerName"]) and isset($_SESSION["userid"])) {

  $invoiceDate = $_POST["invoiceDate"];
  $customerName = $_POST["customerName"];

  //GETTING ARRAY FROM INVOICE FORM

  $tqty = $_POST["tqty"];
  $qty = $_POST["qty"];
  $price = $_POST["price"];


  $productID = $_POST["productID"];
  $productName = $_POST["productName"];

  $subTotal = $_POST["subTotal"];
  $discount = $_POST["discount"];
  $netTotal = $_POST["netTotal"];
  $subTotal = $_POST["subTotal"];
  $paid = $_POST["paid"];
  $due = $_POST["due"];
  $paymentType = $_POST["paymentType"];

  $obj = new Manage();
  echo $result = $obj->storeCustomerInvoice($invoiceDate, $customerName, $tqty, $qty, $price, $productID,  $productName, $subTotal, $discount, $netTotal, $paid, $due,  $paymentType);

  if ($result !== "ORDER_FAIL_TO_COMPLETE") {

    $obj = new DBOperation();
    $obj->addLog($customerName, "created", "invoice");
  }
}


?>