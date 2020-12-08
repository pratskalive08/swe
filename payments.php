<?php 
session_start();
  $email=$_SESSION['email'];
  $rest=intval($_SESSION['rest']);
  if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)){
    $cost= 0 ;
    $quant= $_GET["q"];
    $ids= $_GET["id"];
    $total=$_GET["total"];
    //echo $ids;
    $_SESSION['quant']=$quant;
    $_SESSION['ids']=$ids;
    $_SESSION['total']=$total;
  }
  
if(empty($_GET)){
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
  $total=$_SESSION['total'];
  $date =strval(date("Y-m-d"));
  $sql = "INSERT INTO orders (Email, Amount, Dates) VALUES ('$email','$total','$date')";
  $last_id=0;
  if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  $i=0;
  $val=json_decode($_SESSION['ids']);
  $quant=json_decode($_SESSION['quant']);
  $lastorders=array();
  //echo $quant[0];
  while($i<count($val)){
    $q=$quant[$i];
    $ids=$val[$i];
    //echo $ids;
    $sql = "INSERT INTO order_details (OrderID, DishID, RestID, Quantity) VALUES ('$last_id','$ids','$rest','$q')";
    mysqli_query($conn, $sql);
    $lastorders[$i]=mysqli_insert_id($conn);
    $i=$i+1;
  }
  $lo=json_encode($lastorders);
  header("Location: success.php?lo=$lo");
}
  
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
        <style>
            .container{
                margin-top: 250px;
            }
            .a{
                padding: 60px;
                margin-right: 100px;
            }
            #mydiv{
                display: block;
            }
            .has-error label,
        .has-error input,
        .has-error textarea {
            color: red;
            border-color: red;
        }
            
        </style>
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
        
        <div class="container">
            <div class="row">
                <div class="col-7">
                    <h3>Choose a payment option </h3>
                    <br>
                    <button type="button" class="btn btn-outline-warning a" data-toggle="collapse" href="#collapseExample">Card</button>
                    <a role="button" href="payments.php" class="btn btn-outline-warning a">COD</a>
                </div>
                <div class="col-5">
                    <div class="collapse" id="collapseExample">
                        <form role="form" data-toggle="validator" action="payments.php">
                            <div class="form-row" >
                              <div class="form-group col-md-12">
                                <label for="cardname">Card Name</label>
                                <input type="text"  class="form-control" id="cardname" data-error="You must have a name." pattern="^[a-zA-Z]*$" placeholder="Card Name" minlength="3" required>
                                <div class="help-block with-errors"></div>
                            </div>
                              <div class="form-group col-md-12">
                                <label for="cardnumber">Card Number</label>
                                <input type="text" class="form-control" data-error="Must be a number"  maxlength="16" minlength="16"
                                pattern="^[0-9]*$" id="cardnumber" placeholder="Card Number" required>
                                <div class="help-block with-errors"></div>
                              </div>
                            <div class="form-row">
                              <div class="form-group col-md-2">
                                <label for="month">Month </label>
                                <input type="text" class="form-control" maxlength="2" minlength="2"
                                pattern="^[0-9]*$" id="month" required>
                                <div class="help-block with-errors"></div>
                              </div>
                              <div class="form-group col-md-4 ">
                                <label for="inputState">Year</label>
                                <input id="inputState" class="form-control" maxlength="4" minlength="4"
                                pattern="^[0-9]*$" required>
                                <div class="help-block with-errors"></div>
                              </div>
                              <div class="col-md-4"></div>
                              <div class="form-group col-md-2">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" maxlength="3" minlength="3"
                                pattern="^[0-9]*$" id="cvv" required>
                                <div class="help-block with-errors"></div>
                              </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <br>
                            <button type="submit" class="btn btn-warning ">Submit</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>
            
        </div>
        

   

        <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>