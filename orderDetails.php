<?php
session_start();

if(isset($_SESSION['logval'])){
  $u=$_SESSION['logval'];
  }
  if($u==false){
      die("Access denied");
  }
  if(isset($_SESSION['email'])){
    $id=$_SESSION['email'];
  }
  if(isset($_SESSION['detailsId'])){
    $d=$_SESSION['detailsId'];
  }
if (isset($_SESSION['logval'] )== true){
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

}
?>
<html>
    <head>
    <meta charset="utf-8">
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
      <div class="container" style="margin-top : 100px">
      <div class="row">
<?php
$sql = "SELECT * FROM orders";

$result = mysqli_query($conn, $sql);

$amount = array();
$date= array();
$orderId =array();
$i=0;
  while($row = mysqli_fetch_assoc($result)) {
    if($row['Email']==$id){
      $orderId[$i]=$row['OrderID'];
      
      $amount[$i]=$row['Amount'];
      $date[$i]=$row['Dates'];
      $i=$i+1;
    }
  }
  $jorder=json_encode($orderId);
  $i=0;
  while($i<count($orderId)){
    if($i%3==0){
      echo '<div class="w-100"></div>';
    }
    echo '<div class="card ml-4 mr-4 mb-5" style="width: 18rem;">
    <div class="card-body d-flex flex-column">
    <ul class="list-group list-group-flush">';
      
   
    $sql1 ="SELECT *FROM order_details";
    $result1=mysqli_query($conn, $sql1);
    $flag=$i;
    while($row=mysqli_fetch_assoc($result1)){
        if($orderId[$i]==$row['OrderID']){
          
          $quant =$row['Quantity'];
          $restId=$row['RestID'];
          $dishId=$row['DishID'];
          $dish="";
          $rest="";
          $c=0;
          $sql3 = "SELECT Rest_Name FROM restaurant WHERE Rest_Id='$restId'";
          $result3= mysqli_query($conn, $sql3);
          while($row3 = mysqli_fetch_assoc($result3)) {
            $rest= $row3['Rest_Name'];
            //echo $rest;
          }
          if($flag==$i){
            echo '<h5 class="card-title text-center">'.$rest.'</h5>';
            $flag=$flag+1;
          }
          $sql2 = "SELECT Dish_Name, Cost FROM dishes WHERE Dish_Id=$dishId";
          $result2= mysqli_query($conn, $sql2);
          while($row2 = mysqli_fetch_assoc($result2)) {
            $dish= $row2['Dish_Name'];
            $c=$row2['Cost'];
          }
          echo '<li class="list-group-item">'. $dish .'<span class="float-right">Rs. '.$quant*$c.'</span></li>';

        }
        
    }
    echo '<li class="list-group-item"></li>';
    echo '</ul>
    <div class="ml-auto"><b>Total</b> : Rs. '.$amount[$i].' &nbsp</div>
    <br><br>
    <div class="mt-auto d-flex flex-column pb-2 ">
            <Button class="cancel btn btn-outline-warning" data-value='.$orderId[$i].'>Cancel</button></div>
    </div>
    </div>';
    // href="delete.php?id='.$orderId[$i].'
    $i=$i+1;
  }

?>
      </div>
</div>
      <script>
        
        $(document).ready(function(){
          var val=<?php echo $jorder; ?>;
          $(".cancel").click(function(){
            var index=$(this).data("value");
            $(location).attr('href',"delete.php?id="+JSON.stringify(index));
          })
        });
      </script>
        <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    </body>
</html> 
