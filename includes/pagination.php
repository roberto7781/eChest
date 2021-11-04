<?php

$con = mysqli_connect("localhost", "root", "test");

function pagination($con, $table, $pno, $n){
  $query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
  $row = mysqli_fetch_assoc($query);
  // $totalRecords = 1000;
  $pageno = $pno;
  $numberOfRecordPerPage = $n;

  $totalPage = ceil($row["rows"]/$numberOfRecordPerPage);

  

  $pagination = "";
  if($totalPage != 1){
    if($pageno > 1){
      $previous = "";
      $previous = $pageno - 1;
      $pagination .= "<a href='pagination.php?pageno=".$previous."' style='color:#333;'> Previous </a>";
    }

    for($i=$pageno - 5;$i< $pageno;$i++){
      if($i > 0){
        $pagination .= "<a href='pagination.php?pageno=".$i."'> ".$i." </a>";
      }
     
    }
    $pagination .= "<a href='pagination.php?pageno=".$pageno."' style='color:#333;'> $pageno </a>";
    
    for($i=$pageno+1;$i<=$totalPage;$i++){
      $pagination .= "<a href='pagination.php?pageno=".$i."'> ".$i." </a>";

      if($i > $pageno + 4){
        break;
      }
    }

    if($totalPage > $pageno){
      $next = $pageno + 1;
      $pagination .= "<a href='pagination.php?pageno=".$next."' style='color:#333;'> Next </a>";

    }
  }
//Num of Record
  //Limit 0.10
    //Limit 10.10
  $limit = "LIMIT ".($pageno-1) * $numberOfRecordPerPage.",".$numberOfRecordPerPage;

  return ["pagination"=>$pagination,"limit"=>$limit];

}

if(isset($_GET["pageno"])){
  $pageno = $_GET["pageno"];
  $table = "product";
  
  $array = pagination($con, $table, $pageno, 10);

  $sql = "SELECT * FROM ".$table." ".$array["limit"];

  $query = $con->query($sql);

  while($row = mysqli_fetch_assoc($query)){
    echo "<div style='margin:0 auto;font-size:20px;'".$row["productID"]." </b> ".$row["productName"]."</div>";
  }

  echo $array["pagination"];
}



?>