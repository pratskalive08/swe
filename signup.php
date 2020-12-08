<?php 
session_start();
    $email=$_POST['email1'];
    $pass=$_POST['password1'];
    $ad=$_POST['adr1'];
    $c=$_POST['cont']; 
    $city=$_POST['addcity']; 

    $_SESSION["sup"]=true;
    // echo $email ."\n";
    // echo $pass ."\n";
    // echo $ad ."\n";
    // echo $c ."\n";
    // echo $city ."\n";

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="food_delivery";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO users (Email, Password, Address, Contact, City) VALUES('$email','$pass','$ad','$c','$city')";

    if (mysqli_query($conn,$sql)) {
        echo "Record UPDATED successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      header('Location: login.php'); 
    ?>