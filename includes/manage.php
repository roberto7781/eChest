<?php

class Manage{

  private $con;

  function __construct()
  {
    include_once("../database/db.php");
    $db = new Database();
    $this->con = $db->connect();
  }

  public function manageRecord($table, $pno){

    $a = $this->pagination($this->con,$table, $pno, 5);
    $userID = $_SESSION["userid"];
    if($table == "category"){
      $sql = "SELECT p.categoryName as Category, c.categoryName as Parent, p.status, p.categoryID FROM
      category p LEFT JOIN category c ON p.parentCategory = c.categoryID  WHERE $userID = p.userID OR $userID = c.userID ";

    }
    else if($table == "product"){
      $sql = "SELECT p.productID, p.productName, c.categoryName, l.locationName, p.productPrice, p.productStock, p.addedDate, p.productLimit, p.productImage FROM product p, category c, location l WHERE p.locationID = l.locationID AND p.categoryID = c.categoryID AND $userID = p.userID ";
    }
    else{
      $sql = "SELECT * FROM ".$table." WHERE $userID = $table.userID ";
    }

    $result = $this->con->query($sql) or die ($this->con->error);

    if($result->num_rows >= 0){
      // while($row = $result->fetch_assoc()){
      //   $rows[] = $row;
      // }
      return $result;
    }
    // else if($result->num_rows == 0){
    //   return ["rows"=>Array(), "pagination"=>$a["pagination"]];
    // }
 
    

    // return ["rows"=>$rows, "pagination"=>$a["pagination"]];

  }

  private function pagination($con, $table, $pno, $n){
    $query = $con->query("SELECT COUNT(*) as rowss FROM ".$table);
    $row = mysqli_fetch_assoc($query);
    // $totalRecords = 1000;
    $pageno = $pno;
    $numberOfRecordPerPage = $n;
  
    $totalPage = ceil($row["rowss"]/$numberOfRecordPerPage);

    $pagination = "<ul class='pagination'>";

    if($totalPage != 1){
      if($pageno > 1){
        $previous = "";
        $previous = $pageno - 1;
        $pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#333;'> <span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Previous</span> </a></li>";
      }
  
      for($i=$pageno - 5;$i< $pageno;$i++){
        if($i > 0){
          $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
        }
       
      }
      $pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#333;'> $pageno </a></li>";
      
      for($i=$pageno+1;$i<=$totalPage;$i++){
        $pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
  
        if($i > $pageno + 4){
          break;
        }
      }
  
      if($totalPage > $pageno){
        $next = $pageno + 1;
        $pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#333;'><span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Next</span></a></li></ul>";
  
      }
    }
  //Num of Record
    //Limit 0.10
      //Limit 10.10
    $limit = "LIMIT " .($pageno-1) * $numberOfRecordPerPage.",".$numberOfRecordPerPage;
  
    return ["pagination"=>$pagination,"limit"=>$limit];
  
  }
  public function deleteRecord($table,$pk, $id){
    if($table == "category"){
      $pre_stmt = $this->con->prepare("SELECT ".$id." FROM category WHERE parentCategory = ?");
      $pre_stmt->bind_param("i", $id);
      $pre_stmt->execute();
      $result = $pre_stmt->get_result() or die($this->con->error);

      if($result->num_rows > 0 ){
        return "DEPENDENT_CATEGORY";
      }
    else{

        $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
        $pre_stmt->bind_param("i", $id);
        $result = $pre_stmt->execute() or die($this->con->error);

        if($result){
          return "CATEGORY_DELETED";
        }
      }

    }
    else{
      $pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
      $pre_stmt->bind_param("i", $id);
      $result = $pre_stmt->execute() or die($this->con->error);

      if($result){
        return "DELETED";
      }
      else{
        return $pk;
      }

     


  }

 
}



public function getSingleRecord($table, $pk, $id){
  $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ? LIMIT 1");   
  $pre_stmt->bind_param("i", $id);
  $pre_stmt->execute() or die($this->con->error);
  $result = $pre_stmt->get_result();

  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
  }

  return $row;
}



public function getRecord($table){
  $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." ");   
  $pre_stmt->execute() or die($this->con->error);
  $result = $pre_stmt->get_result();

  if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $rows[] = $row;
    }
  }
  else{
    return "NO_DATA";
  }

  return $rows;
}

  public function updateRecord($table, $where, $fields){
    $sql = "";
    $condition = "";

    foreach($where as $key => $value){

      $condition .= $key . "='" . $value . "' AND ";

    }

    $condition = substr($condition, 0 , -5);

    foreach($fields as $key => $value){
      $sql .= $key . "='". $value."', "; 
    }
    $sql = substr($sql, 0, -2);
    $sql = "UPDATE ".$table. " SET ".$sql." WHERE " .$condition;
    if(mysqli_query($this->con,$sql)){
      return "UPDATED";
    }
    else{
      return 0;
    }
  }

  public function storeCustomerInvoice($orderDate, $customerName, $tqty, $qty, $price, $productID, $productName,  $subTotal, $discount, $netTotal, $paid, $due,  $paymentType){
  
    $pre_stmt = $this->con->prepare("INSERT INTO `transaction`( `customerName`, `orderDate`, `subTotal`, `discount`, `netAmount`, `paidAmount`, `due`, `paymentMethod`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");   
    $pre_stmt->bind_param("ssddddds",  $customerName, $orderDate,  $subTotal, $discount, $netTotal, $paid, $due,  $paymentType);
    $pre_stmt->execute() or die($this->con->error);


    $transactionID = $pre_stmt->insert_id;


    if($transactionID != null){
      for($i=0;$i< count($price);$i++){
          

        //FINDING REMAINING QUANTITY AFTER GIVING CUSTOMER
        $rem_qty = $tqty[$i] - $qty[$i];
      
        if($rem_qty < 0){
          return "ORDER_FAIL_TO_COMPLETE";
        }
        else{
          $sql = "UPDATE product SET productStock = $rem_qty WHERE productID = ".$productID[$i];
          mysqli_query($this->con, $sql);

        }


        $insertProduct = $this->con->prepare("INSERT INTO `transactiondetail`( `transactionID`, `productID`, `productName`, `price`, `qty`) VALUES (?, ?, ?, ?, ?)");
        $insertProduct->bind_param("iisdd",$transactionID, $productID[$i], $productName[$i], $price[$i], $qty[$i]);
        $insertProduct->execute() or die($this->con->error);
      }

      return $transactionID;
      
    }

  }

}

// $obj = new Manage();

// echo "<pre>";

// print_r($obj->manageRecord("category", 1));

// print_r($obj->manageRecord("location", 1))

// echo $obj->updateRecord("category",["categoryID"=>1], ["parentCategory"=>0, "categoryName"=>"SOFTWARERERE", "status"=>1]);
 
?>
