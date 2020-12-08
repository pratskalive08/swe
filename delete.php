<?php
session_start();

$id= $_GET["id"];
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
$i=0;

$orderId=array();
while($i<count($id)){
    // $sql="SELECT OrderID FROM order_details WHERE OrderDetailsID=$index";
    // $result=mysqli_query($conn,$sql);
    // while($row = mysqli_fetch_assoc($result)) {
    //     $orderId[$i]= $row['OrderID'];
    // }
    $sql1="DELETE FROM order_details WHERE OrderID=$id";
    
    if (mysqli_query($conn,$sql1)) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
    $i=$i+1;
}
    $sql2="DELETE FROM orders WHERE OrderID=$id";
    if (mysqli_query($conn,$sql2)) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }


header('Location: orderDetails.php'); 
?>
