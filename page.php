<?php

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }
}

// define variables and set to empty values
$servername= "localhost";
$username="root";
$password="";

try {
    $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $rollno = $_GET["rollno"];
}

$sql = "SELECT COUNT(*) from collection WHERE rollno='$rollno'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

if($stmt->fetchColumn())
{	$sql ="SELECT * FROM collection WHERE rollno='$rollno'";
	foreach ($conn->query($sql) as $row) {
		$name = $row['name'];
		$specialization=$row["specialization"];
		$research=$row["research"];
		$abstract=$row["abstract"];
		$publications=$row["publications"];
		$awards=$row["awards"];
		$subtext1=$row["subtext1"];
		$subtext2=$row["subtext2"];
		$subtext3=$row["subtext3"];
	}
} else {
	echo "Details not available!";
	die();
}
}

catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

$conn = null;

require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(60,10,'Name: ',0,1);
$pdf->Cell(190,10,$name,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Roll number: ',0,1);
$pdf->Cell(190,10,$rollno,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Specialization: ',0,1);
$pdf->Cell(190,10,$specialization,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Research: ',0,1);
$pdf->Cell(190,10,$research,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Abstract: ',0,1);
$pdf->Cell(190,10,$abstract,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Publications: ',0,1);
$pdf->Cell(190,10,$publications,1,1,'L');
$pdf->Ln();
$pdf->Cell(60,10,'Awards: ',0,1);
$pdf->Cell(190,10,$awards,1,1,'L');
$pdf->Ln();
$pdf->AddPage();
$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_1.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 0, 'C', false );
$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_2.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 0, 'C', false );
$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_3.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 1, 'C', false );
$pdf->Cell( 4, 10);
$pdf->Cell( 55, 10, $subtext1, 1, 0, false);
$pdf->Cell( 8, 10);
$pdf->Cell( 55, 10, $subtext2, 1, 0, false);
$pdf->Cell( 8, 10);
$pdf->Cell( 55, 10, $subtext3, 1, 1, false);
$pdf->Output();

?>

