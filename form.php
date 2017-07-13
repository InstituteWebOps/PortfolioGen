<html>

<head>
    <title>Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    require('./config/db.php');
    session_start();
    if(!isset($_SESSION['rollno'])) header("Location: index.php"); 
    // $_SESSION['rollno'] = "AE15B002";


$sql = "SELECT COUNT(*) from collection WHERE rollno='".$_SESSION['rollno']."'";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

if($stmt->fetchColumn())
{
	$sql ="SELECT * FROM collection WHERE rollno='".$_SESSION['rollno']."'";
	foreach ($conn->query($sql) as $row) {
        print_r($row);
	}
} else {
		$row['name'] = "";
		$row["specialization"] = "";
		$row["research"] = "";
		$row["abstract"] = "";
		$row["publications"] = "";
		$row["awards"] = "";
		$row["subtext1"] = "";
		$row["subtext2"] = "";
		$row["subtext3"] = "";
}

    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<script type="text/javascript">
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader1 = new FileReader();

            reader1.onload = function(e) {
                $('#blah1').attr('src', e.target.result);
            }

            reader1.readAsDataURL(input.files[0]);
            $('#blah1').css("visibility", "visible");
        }
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader2 = new FileReader();

            reader2.onload = function(e) {
                $('#blah2').attr('src', e.target.result);
            }

            reader2.readAsDataURL(input.files[0]);
            $('#blah2').css("visibility", "visible");
        }
    }

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader3 = new FileReader();

            reader3.onload = function(e) {
                $('#blah3').attr('src', e.target.result);
            }

            reader3.readAsDataURL(input.files[0]);
            $('#blah3').css("visibility", "visible");
        }
    }
</script>

<style>
    th {
        padding: 10px;
    }
    
    input[type=submit] {
        width: 100%;
        background-color: #275193;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=submit]:hover {
        background-color: #1e437f;
    }
    
    .imgupl {
        background-color: pink;
        text-align: center;
        max-width: 290px;
        box-shadow: 10px 10px 5px #888888;
    }
</style>

<script type="text/javascript">
    // function check_rno() {
    //     var rno_format = new RegExp(/(^([A-Z]{2})([0-9]{2})([A-Z]{1})([0-9]{3})$)/i);
    //     return rno_format.test($("#rollno").val());
    // }
    // function check() {
    //     if(!check_rno())
    //     {
    //         alert("Incorrect roll number");
    //         return false;
    //     }
    //     return true;
    // }
    //     var a = document.forms["Form"]["name"].value;
    //     var b = document.forms["Form"]["rollno"].value;
    //     var c = document.forms["Form"]["specialization"].value;
    //     var d = document.forms["Form"]["research"].value;
    //     var d = document.forms["Form"]["abstract"].value;
    //     var d = document.forms["Form"]["publications"].value;
    //     var d = document.forms["Form"]["subtext1"].value;
    //     var d = document.forms["Form"]["subtext2"].value;
    //     var d = document.forms["Form"]["subtext3"].value;
    //     if (a == null || a == "" || b == null || b == "" || c == null || c == "" || d == null || d == "" || e == null || e == "" || f == null || f == "" || g == null || g == "" || h == null || h == "" || i == null || i == "") {
    //         alert("Please Fill All Required Field");
    //         return false;
    //     }
    // }
</script>

<body style="background-color:#ddd">
    <div style="max-width: 900px; width: 100%; margin: 0 auto; position: relative; background-color:lightblue; border: 1px solid grey;">
        <form action="submit.php" method="post" enctype="multipart/form-data" name="form">
            <center>
                <table>
                    <tr>
                        <th><b>Name :</b></th>
                        <th><input name="name" id="name" type="text" class="form-control" placeholder="Name" required value="<?php echo $row['name']; ?>"></th>
                    </tr>
                    <tr>
                        <th><b>Roll number :</b></th>
                        <th><input name="rollno" id="rollno" type="text" class="form-control" placeholder="eg: AE15B001" readonly value="<?php echo $_SESSION['rollno'];?>"></th>
                    </tr>
                    <tr>
                        <th><b>Specialization :</b></th>
                        <th><input name="specialization" id="specialization" type="text" class="form-control" placeholder="Specialization" required value="<?php echo $row['specialization'];?>"></th>
                    </tr>
                    <tr>
                        <th><b>Title of Research :</b></th>
                        <th><input name="research" id="research" type="text" class="form-control" placeholder="Title" required value="<?php echo $row['research'];?>"></th>
                    </tr>
                    <tr>
                        <th><b>Abstract :</b></th>
                        <th><textarea rows="5" cols="50" class="form-control" placeholder="Abstract" name="abstract" id="abstract" required><?php echo $row['abstract'];?></textarea></th>
                    </tr>
                    <tr>
                        <th><b>Important publications :</b></th>
                        <th><textarea rows="5" cols="50" class="form-control" placeholder="Publications" name="publications" id="publications"><?php echo $row['publications'];?></textarea></th>
                    </tr>
                    <tr>
                        <th><b>Awards obtained, if any :</b></th>
                        <th><textarea rows="5" cols="50" class="form-control" placeholder="Awards" name="awards" id="awards"><?php echo $row['awards'];?></textarea></th>
                    </tr>
                </table>
            </center>
            <br><br>

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="imgupl">
                            Select image to upload:<br>
                            <img id="blah1" src="#" alt="your image" height="200px" style="visibility:hidden" />
                            <input type="file" name="image1" id="image1" onchange="readURL1(this);">
                            <input name="subtext1" id="subtext1" type="text" class="form-control" value="<?php echo $row['subtext1'];?>"/>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="imgupl">
                            Select image to upload:<br>
                            <img id="blah2" src="#" alt="your image" height="200px" style="visibility:hidden" />
                            <input type="file" name="image2" id="image2" onchange="readURL2(this);">
                            <input name="subtext2" id="subtext2" type="text" class="form-control" value="<?php echo $row['subtext2'];?>"/>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="imgupl">
                            Select image to upload:<br>
                            <img id="blah3" src="#" alt="your image" height="200px" style="visibility:hidden" />
                            <input type="file" name="image3" id="image3" onchange="readURL3(this);">
                            <input name="subtext3" id="subtext3" type="text" class="form-control" value="<?php echo $row['subtext3'];?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

            <center><input name="login" type="submit" value="Submit"><br><br></center>

        </form>
    </div>
</body>

</html>