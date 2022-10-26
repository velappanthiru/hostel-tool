<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hostel_tool';


$conn = mysqli_connect($servername,$username,$password,$dbname);


if($conn -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

?>