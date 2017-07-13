<?php

require('config/db.php');
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $rollno = $_GET["rollno"];
}

$sql = "SELECT COUNT(*) from collection WHERE rollno='$rollno'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

if($stmt->fetchColumn())
{
	$sql ="SELECT * FROM collection WHERE rollno='$rollno'";
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
	echo "<h2>User not registered. Please <a href=\"form.html\">Click here</a> to create a portfolio</h2>";
	die();
}
$conn = null;

require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);
$pdf->SetFillColor(228,228,228);
$pdf->Cell(60,10,'Name: ',0,0);
$pdf->Cell(120,10,$name,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Roll number: ',0,0);
$pdf->Cell(120,10,$rollno,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Specialization: ',0,0);
$pdf->Cell(120,10,$specialization,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Research: ',0,0);
$pdf->Cell(120,10,$research,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Abstract: ',0,0);
$pdf->Cell(120,10,$abstract,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Publications: ',0,0);
$pdf->Cell(120,10,$publications,0,1,'L',1);
$pdf->Ln();
$pdf->Cell(60,10,'Awards: ',0,0);
$pdf->Cell(120,10,$awards,0,1,'L',1);
$pdf->Ln();

$imgcheck = array(file_exists('./images/'.$rollno.'_1.jpg'),file_exists('./images/'.$rollno.'_2.jpg'),file_exists('./images/'.$rollno.'_3.jpg'));
// $pdf->Cell(60,10, ($imgcheck[0]),0,0);
// $pdf->Cell(60,10, ($imgcheck[1]),0,0);
// $pdf->Cell(60,10, ($imgcheck[2]),0,0);
// $pdf->Ln();
// $pdf->AddPage();
switch (array_sum($imgcheck)){
	case 0:
		break;

	case 1:
		$pdf->AddPage();
		$v = 'subtext'.(array_search(1, $imgcheck)+1);
		$pdf->Cell( 4, 10);
		$pdf->Cell( 180, 10, $$v, 1, 0, false);
		$pdf->Ln();

		$pdf->Cell( 180, 100, $pdf->Image('./images/'.$rollno.'_'.(array_search(1, $imgcheck)+1).'.jpg', $pdf->GetX()+4, $pdf->GetY(), 180), 0, 0, 'C', false );
		break;
		
	case 2:
		$pdf->AddPage();
		for($i=1; $i<=3; $i++)
		{
			if($i==array_search(0, $imgcheck)+1) continue;
			$v = 'subtext'.$i;
			$pdf->Cell( 4, 10);
			$pdf->Cell( 90, 10, $$v, 1, 0, false);
		}
		$pdf->Ln();
		$pdf->Ln();

		// $pdf->AddPage();

		for($i=1; $i<=3; $i++)
		{
			if($i==array_search(0, $imgcheck)+1) continue;
			$pdf->Cell( 90, 100, $pdf->Image('./images/'.$rollno.'_'.$i.'.jpg', $pdf->GetX()+4, $pdf->GetY(), 90), 0, 0, 'C', false );
			$pdf->Cell( 4, 10);
			// $pdf->Cell( 90, 100, $pdf->Image('./images/'.$rollno.'_2.jpg', $pdf->GetX()+4, $pdf->GetY(), 90), 0, 0, 'C', false );
			// $pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_3.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 1, 'C', false );
		}
		break;

	case 3:
		$pdf->AddPage();
		$pdf->Cell( 4, 10);
		$pdf->Cell( 55, 10, $subtext1, 1, 0, false);
		$pdf->Cell( 8, 10);
		$pdf->Cell( 55, 10, $subtext2, 1, 0, false);
		$pdf->Cell( 8, 10);
		$pdf->Cell( 55, 10, $subtext3, 1, 1, false);
		$pdf->Ln();

		$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_1.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 0, 'C', false );
		$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_2.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 0, 'C', false );
		$pdf->Cell( 63, 100, $pdf->Image('./images/'.$rollno.'_3.jpg', $pdf->GetX()+4, $pdf->GetY(), 55), 0, 1, 'C', false );
}
$pdf->Output();

?>

