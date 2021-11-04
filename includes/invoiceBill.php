<?php
session_start();

include_once("../fpdf/fpdf.php");

if($_GET["invoiceDate"] && $_GET["transactionID"]){

  $pdf = new FPDF();
  $pdf->AddPage();

  $pdf->SetFont("Arial", "B", 16);
  $pdf->Cell(190, 10, "Invoice", 0, 1, "c");

  $pdf->SetFont("Arial", null, 12);
  $pdf->cell(50, 10, "Order Date", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["invoiceDate"], 0, 1);
  $pdf->cell(50, 10, "Customer Name", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["customerName"], 0, 1);

  $pdf->cell(50, 10, "", 0, 1);

  $pdf->cell(10, 10, "#", 1, 0, "c");
  $pdf->cell(70, 10, "Product Name", 1, 0, "c");
  $pdf->cell(30, 10, "Quantity", 1, 0, "c");
  $pdf->cell(40, 10, "Price", 1, 0, "c");
  $pdf->cell(40, 10, "Total (Rp)", 1, 1, "c");

  for($i=0;$i < count($_GET["price"]);$i++){
    $pdf->cell(10, 10, ($i+1), 1, 0, "c");
    $pdf->cell(70, 10, $_GET["productName"][$i], 1, 0, "c");
    $pdf->cell(30, 10, $_GET["qty"][$i], 1, 0, "c");
    $pdf->cell(40, 10, $_GET["price"][$i], 1, 0, "c");
    $pdf->cell(40, 10, $_GET["qty"][$i] * $_GET["price"][$i], 1, 1, "c");
  }

  $pdf->cell(50, 10, "", 0, 1);
  
  $pdf->cell(50, 10, "Sub Total", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["subTotal"], 0, 1);

  $pdf->cell(50, 10, "Discount", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["discount"], 0, 1);

  $pdf->cell(50, 10, "Net Total", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["netTotal"], 0, 1);

  $pdf->cell(50, 10, "Paid", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["paid"], 0, 1);

  $pdf->cell(50, 10, "due", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["due"], 0, 1);

  $pdf->cell(50, 10, "Payment Type", 0, 0);
  $pdf->cell(50, 10, ": ".$_GET["paymentType"], 0, 1);

  $pdf->cell(180, 10, "Signature", 0, 0, "R");

  $pdf->output("../PDF/PDF_INVOICE_".$_GET["transactionID"].".pdf", "F");

  $pdf->Output();
}


?>