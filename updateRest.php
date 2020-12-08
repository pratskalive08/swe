<?php 
session_start();

$val = $_POST['ad2'];
$n=$_POST["rname2"];
$id=$_GET["id"];
// $n= json_decode($_GET["rname"]);
// $d= intval(json_decode($_GET["d"]));
echo $val;
echo $n."\n";
echo $id;
$id=intval(json_decode($_GET['id']));
$servername = "localhost";
$username = "root";
$password = "";
$dbname ="food_delivery";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
 
    $sql1 = "UPDATE restaurant SET Rest_Name='$n', Rest_Details='$val'  WHERE Rest_Id=$id";
    
    if (mysqli_query($conn,$sql1)) {
        echo "Record UPDATED successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
       header('Location: adminRest.php'); 
?>