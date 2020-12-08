<?php 
session_start();

$n= json_decode($_GET["n"]);
$p= intval(json_decode($_GET["p"]));
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
 
    $sql1 = "UPDATE dishes SET Dish_Name='$n', Cost=$p WHERE Dish_Id=$id";
    
    if (mysqli_query($conn,$sql1)) {
        echo "Record UPDATED successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      header('Location: admindishes.php'); 
?>