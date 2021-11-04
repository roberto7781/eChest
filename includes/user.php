<?php


// User Class for Account Creation and Login Purpose
date_default_timezone_set('Asia/Jakarta');

class User
{

  private $con;

  function __construct()
  {
    include_once("../database/db.php");
    $db = new Database();
    $this->con = $db->connect();
  }


  //To check whether the user have registered or not
  private function checkEmail($email)
  {
    $pre_statement = $this->con->prepare("SELECT userID FROM user WHERE email = ? ");
    $pre_statement->bind_param("s", $email);
    $pre_statement->execute() or die($this->con->error);
    $result = $pre_statement->get_result();

    // User Registered
    if ($result->num_rows > 0) {
      return 1;
    } else {
      return 0;
    }
  }

  public function createUserAccount($userName, $email, $password, $userType)
  {
    // To Protect From SQL Attack We use Prepares Statement

    if ($this->checkEmail($email)) {
      return "EMAIL_ALREADY_EXISTS";
    } else {
      $pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost"=>8]);
      $date = date("Y-m-d");
      $date1 = date("Y-m-d H:i:s");
      $notes = "";
      $pre_statement = $this->con->prepare("INSERT INTO `user`(`userName`, `email`, `password`, `userType`, `registerDate`, `lastLogin`, `notes`)
       VALUES (?, ?, ?, ?, ?, ?, ?)");
      $pre_statement->bind_param("sssssss", $userName, $email, $pass_hash, $userType, $date, $date1, $notes);
      $result = $pre_statement->execute() or die($this->con->error);
      if($result){
        return $this->con->insert_id;
      }
      else{
        return "SOMETHING_WENT_WRONG";

      }
    }
  }

  


  public function userLogin($email, $password)
  {
  $pre_statement = $this->con->prepare("SELECT userID, userName, password, lastLogin FROM user WHERE email = ?");
  $pre_statement->bind_param("s", $email);
  $pre_statement->execute() or die($this->con->error);
  $result = $pre_statement->get_result();

  if($result->num_rows <1){

    return "NOT_REGISTERED";
  }
  else{
    $row = $result->fetch_assoc();
    if(password_verify($password, $row["password"])){
      $_SESSION["userid"] = $row["userID"];
      $_SESSION["userName"] = $row["userName"];
      $_SESSION["last_login"] = $row["lastLogin"];
      $_SESSION["userType"] = $row["userType"];


      // Updating User last login time
      // When user is logging in
      $last_login = date("Y-m-d H:i:s");

      $pre_statement = $this->con->prepare("UPDATE user SET lastLogin = ? WHERE email = ?");
      $pre_statement->bind_param("ss", $last_login, $email);
      $result = $pre_statement->execute() or die($this->con->error);
      if($result){
        return 1;
      }
      else{
        return 0;

      }
    }
    else{

      return "WRONG_PASSWORD";
    }
  }
}

    //GET USER INFORMATION

    public function getUserInformation($table, $userID){

      if($table == "user"){
        $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE userID = ".$userID." ");
        $pre_stmt->execute() or die($this->con->error);
        
        $result = $pre_stmt->get_result();
  
    
  
        if($result->num_rows > 0){
      
  
          return $result;
  
  
        }
        return "NO_DATA";

      }

      else if($table == "user_log"){
        $pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE userID = ".$userID." ORDER BY addedDate DESC LIMIT 5 " );
        $pre_stmt->execute() or die($this->con->error);
        
        $result = $pre_stmt->get_result();
  
    
        if($result->num_rows > 0){
      
  
          return $result;
  
  
        }
        return "NO_DATA";

      }



    }


}

 


// $user = new User();

// echo $user->createUserAccount("Roberto", "roberto2@gmail.com", "1234567891", "Admin"); 

// echo $user->userLogin("roberto@gmail.com", "12345");

