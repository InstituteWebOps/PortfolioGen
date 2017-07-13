<?php
$servername = "localhost:3307";
$username = "root";
$password = "12017";

try {
    //make a connection
    $conn = new PDO("mysql:host=$servername;dbname=civilras", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // $statement = "SELECT * FROM donors WHERE rollno = 'AE15B001';"; 
        // $query = $conn->query($statement);
        // $query->setFetchMode(PDO::FETCH_ASSOC);
        // $row = $query->fetch();
        // print_r($row);
        // if(empty($row)) echo "Empty";
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>