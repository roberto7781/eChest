<?php 




class DBOperation{

  private $con;

  function __construct()
  {
    include_once("../database/db.php");
    $db = new Database();
    $this->con = $db->connect();
  }

  public function addCategory( $parent, $cat){
    $pre_stmt = $this->con->prepare("INSERT INTO `category`(`userID`, `parentCategory`, `categoryName`, `status`) VALUES (?, ?, ?, ?)");
    $status = 1;
    $pre_stmt->bind_param("iisi", $_SESSION["userid"], $parent, $cat, $status);
    


    if($result = $pre_stmt->execute() or die($this->con->error)){
      return "CATEGORY_ADDED";
    }
    else{
      return 0;
    }
  }

  public function getAllCategory($table){
    $userID = $_SESSION["userid"];
      $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE userID = ".$userID." ");
      $pre_stmt->execute() or die($this->con->error);
      
      $result = $pre_stmt->get_result();

      $rows = array();

      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $rows[] = $row;
        }
          return $rows;


      }
      return "NO_DATA";

  }

  public function getAllRecord($table){
    $userID = $_SESSION["userid"];
    $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE userID = ".$userID." ");
    $pre_stmt->execute() or die($this->con->error);
    
    $result = $pre_stmt->get_result();
  
    $rows = array();
  
    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
        return $rows;
  
  
    }
    return "NO_DATA";
  
  }
  

  public function addLocation($locationName){
    $pre_stmt = $this->con->prepare("INSERT INTO `location`(`userID`, `locationName`) VALUES (?, ?)");

    $pre_stmt->bind_param("is", $_SESSION["userid"], $locationName);
    $result = $pre_stmt->execute() or die($this->con->error);
  
    
    if($result){
      return "LOCATION_ADDED";
    }
    else{
      return 0;
    }
  }

  
  public function addLog($logInfo, $action, $actionType){
    //ADD = 1, UPDATE = 2, DELETE = 3
    $pre_stmt = $this->con->prepare("INSERT INTO `user_log`(`userID`, `logHistory`,`addedDate`, `action`, `actionType`) VALUES (?, ?, ?, ?, ?)");
    $currentTime = date("Y-m-d H:i:s");
    $pre_stmt->bind_param("issss", $_SESSION["userid"], $logInfo, $currentTime, $action, $actionType);
    $result = $pre_stmt->execute() or die($this->con->error);
  
    return 0;
  }

  public function getAllLocation($table){
    $userID = $_SESSION["userid"];
    $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE userID = ".$userID." ");
    $pre_stmt->execute() or die($this->con->error);
    
    $result = $pre_stmt->get_result();

    $rows = array();

    if($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        $rows[] = $row;
      }
        return $rows;


    }
    return "NO_DATA";

}

public function getTotal($table){
  $userID = $_SESSION["userid"];
  $pre_stmt = $this->con->prepare("SELECT count(*) FROM ".$table." WHERE userID = ".$userID." ");
  $pre_stmt->execute() or die($this->con->error);
  
  $result = $pre_stmt->get_result();

  if($result->num_rows == 1){
    $row = $result->fetch_assoc();
  }

  return $row;



 

}




public function addProduct($categoryID, $locationID, $productName, $productPrice, $productStock, $date, $productStockLimit){
  $pre_stmt = $this->con->prepare("INSERT INTO `product`(`userID`, `categoryID`, `locationID`, `productName`, `productPrice`, `productStock`, `addedDate`, `productLimit`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $pre_stmt->bind_param("iiisdisi",$_SESSION["userid"], $categoryID, $locationID, $productName, $productPrice, $productStock, $date, $productStockLimit);
  $result = $pre_stmt->execute() or die($this->con->error);


  if($result){
  
    return "PRODUCT_ADDED";
  }
  else{
    return 0;
  }
}


}




// $opr = new DBOperation();

//  echo $opr->addCategory(1, "Car");
// echo "<pre>";
// print_r($opr->getAllRecord("category"));
