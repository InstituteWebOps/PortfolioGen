<?php 
    
session_start();
require('config/db.php');
if(isset($_POST['login'])) {

    $name=$_POST["name"];
    $rollno=$_POST["rollno"];
    $specialization=$_POST["specialization"];
    $research=$_POST["research"];
    $abstract=$_POST["abstract"];
    $publications=$_POST["publications"];
    $awards=$_POST["awards"];

    $subtext1=$_POST["subtext1"];
    $subtext2=$_POST["subtext2"];
    $subtext3=$_POST["subtext3"];

    $errors= array();
    $file_name = $_FILES["image1"]['name'];
    $file_size = $_FILES["image1"]['size'];
    $file_tmp = $_FILES["image1"]['tmp_name'];
    $file_type = $_FILES["image1"]['type'];

    $rollno = strtoupper($rollno);
    (file_exists("images/".$rollno."_1.jpg")?unlink("images/".$rollno."_1.jpg"):1);
    (file_exists("images/".$rollno."_2.jpg")?unlink("images/".$rollno."_2.jpg"):1);
    (file_exists("images/".$rollno."_3.jpg")?unlink("images/".$rollno."_3.jpg"):1);


  $_SESSION["file_ext1"]=strtolower(end(explode('.',$_FILES['image1']['name'])));
//  echo "Image Variavles alloted";

 //   $expensions= array("jpg","jpeg","png");

//	if(in_array($file_ext,$expensions)=== false)
//	{
//		$errors[]="Given extension not allowed, please choose a JPG only";
//	}
//	if(empty($errors)==true)
//	{
//		echo "Hello world";
		move_uploaded_file($file_tmp,"images/".$rollno."_1.jpg");
		echo "image1 success!";
//	}else{
//		print_r($errors);
//	}
    $errors= array();
    $file_name = $_FILES['image2']['name'];
    $file_size = $_FILES['image2']['size'];
    $file_tmp = $_FILES['image2']['tmp_name'];
    $file_type = $_FILES['image2']['type'];
   
    $_SESSION["file_ext2"]=strtolower(end(explode('.',$_FILES['image2']['name'])));

  //  $expensions= array("jpg","jpeg","png");

//	if(in_array($file_ext,$expensions)=== false)
 //   	{
	//	$errors[]="Given extension not allowed, please choose a JPG only";
//	}
//	if(empty($errors)==true)
//	{   
        move_uploaded_file($file_tmp,"images/".$rollno."_2.jpg");
		echo "image2 success!";
//	}else{
//		print_r($errors);
//	}
    $errors= array();
    $file_name = $_FILES['image3']['name'];
    $file_size = $_FILES['image3']['size'];
    $file_tmp = $_FILES['image3']['tmp_name'];
    $file_type = $_FILES['image3']['type'];
    
   $_SESSION["file_ext3"]=strtolower(end(explode('.',$_FILES['image3']['name'])));

//   $expensions= array("jpg","jpeg","png");

//	if(in_array($file_ext,$expensions)=== false)
//	{
//		$errors[]="Given extension not allowed, please choose a JPG only";
//	}
//	if(empty($errors)==true)
//	{
		move_uploaded_file($file_tmp,"images/".$rollno."_3.jpg");
		echo "image3 success!";
//	}else{
//		print_r($errors);
//	}

    $sql = "DELETE FROM collection WHERE rollno='".$rollno."';";
    // use exec() because no results are returned
    $conn->exec($sql);

    $sql = "INSERT INTO collection (name, rollno, specialization, research, abstract, publications, awards, subtext1, subtext2, subtext3)
    VALUES ('$name', '$rollno', '$specialization', '$research', '$abstract', '$publications', '$awards', '$subtext1', '$subtext2', '$subtext3')";
    // use exec() because no results are returned
    $conn->exec($sql);

header("Location: page.php?rollno=".$rollno);

$conn = null;
}

?>
