<?php
session_start();
// echo "successful payment";
// $val=$_GET['lo'];
// $v=json_decode($val);
// $_SESSION["detailsId"] =$v;
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname ="food_delivery";

// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);

// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }
// header('Location: orderDetails.php'); 
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav class=" la navbar navbar-expand-lg navbar-light bg-white col-8 ">
  <a class="navbar-brand" href="#">Food Delivery</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="userdets.php">My Profile <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Home  <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="orderDetails.php">Myorders <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
  
    </ul>
  </div>
</nav>
<div class="row">
      <div class="col-md-7 p-2">
      <img src="./images/pay.jpg" class="img-fluid" alt="Responsive image">
      </div>
      <div class="col-md-4 text-center" style="margin-top: 20%;">
          <h1> Payment Successful :) </h1>
          <div class="text-center">
          <a class="btn btn-outline-warning mt-5" href="login.php">Back to home</a>
          </div>
      </div>
    </div>
    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>