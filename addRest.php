<?php 
// session_start();
$val = $_POST['adr1'];
$n=$_POST["rname1"];
$c=$_POST["addcity"];
// $n= json_decode($_GET["rname"]);
// $d= intval(json_decode($_GET["d"]));
echo $val."\n";;
echo $n."\n";
echo $c;
// $n= json_decode($_GET["n"]);
// $p= intval(json_decode($_GET["p"]));
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
 
    $sql1 = "INSERT INTO restaurant (Rest_Name, City, Rest_Details) VALUES('$n','$c','$val')";
    
    if (mysqli_query($conn,$sql1)) {
        echo "Record UPDATED successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      header('Location: adminRest.php'); 
?>