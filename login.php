<?php 

session_start();
// unset($_SESSION['email']);
// unset($_SESSION['logval']);
// unset($_SESSION['rest']);
// unset($_SESSION['Admin']);
// $_SESSION['logval']=false;
// $_SESSION['Admin']=false;
if(isset($_SESSION['sup'])){
    if($_SESSION['sup']){
        echo "<script>window.alert('Successful Sign up. Please Sign in to view')</script>";
        unset($_SESSION['sup']);
    }
}
if(isset($_POST['email'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="food_delivery";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM users ";
    $result = mysqli_query($conn, $sql);
    $flag=0;
    while($row = mysqli_fetch_assoc($result)){
        $e=$row['Email'];
        $p=$row['Password'];
        $a=$row['Admin'];
        $city=$row['City'];
        
        if($a==1){
            $_SESSION["Admin"] = true;
            header('Location: adminRest.php');
            
        }
        if($e==$email && $p=$pass){
            $_SESSION["email"] = $e;
            $_SESSION["logval"] = true;
            $_SESSION["city"]=$city;
            $u=$e ;
            //$_SESSION["rest"]=1;
            //$_SESSION['logval']=true;
            $flag=1;
            break;
        }
 
    }
    if($flag==0){
        echo"<script> window.alert('Invalid credentials. Login failed :(')</script>";
    }
}
    if(isset($_SESSION['logval'])){
        $u=$_SESSION['logval'];
        }
        if(isset($_SESSION['email'])){
          $id=$_SESSION['email'];
        }
  
if(isset($u)){
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
        $city = $_SESSION["city"];
        $sql = "SELECT * FROM restaurant WHERE Active=0 AND City='$city'";

        $result = mysqli_query($conn, $sql);

        $name = array();
        $ids=array();
        $dets=array();
        $i=0;
        // output data of each row
        while($row = mysqli_fetch_assoc($result)){
            
            $name[$i]=$row['Rest_Name'];
            $ids[$i]=$row['Rest_Id'];
            $dets[$i]=$row['Rest_Details'];
            $i=$i+1;
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

        <script>
        $(document).ready(function(){
            $(".signup").click(function(){
                $("#loginModal").modal();
            })
        })
        

        </script>

    </head>
    <body>
    
    
    <div class="container-fluid">
        
        
    <div class="row ">
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
    <div class="col-8 "> 
        
    <div class="row col-8 text-center mt-4 ml-4"><h1>Restaurants</h1></div>
        <div class="row ml-4">
<?php
if(isset($u)){
        $i=0;
        $img =array('./images/Rest_images/Capture0.jpg','./images/Rest_images/Capture1.jpg','./images/Rest_images/Capture2.jpg','./images/Rest_images/Capture3.jpg','./images/Rest_images/Capture4.jpg','./images/Rest_images/Capture5.jpg','./images/Rest_images/Capture6.jpg',
        './images/Rest_images/Capture7.jpg','./images/Rest_images/Capture8.jpg','./images/Rest_images/Capture9.jpg','./images/Rest_images/Capture10.jpg','./images/Rest_images/Capture11.jpg','./images/Rest_images/Capture12.jpg');

        while($i<count($name)){
            if($i%3==0 ){
                echo '<div class="w-100"></div>';
            }
            $index =rand(0,11);
            $p =$img[$index];
            //echo $ids[6];
            echo '<div class="col-4 mb-5" >
            <div class="card d-flex flex-column" style="width: 18rem;">
                <img class="card-img-top img-thumnail" src='.$p.' alt="Card image cap'.$index.'">
                <div class="card-body">
                <h5 id="div'.$ids[$i].'" class="card-title">'. $name[$i].'</h5><a role="button" class="btn btn-outline-warning float-left" href="cart.php?rid='. $ids[$i].'">View Dishes </a> <a class="ml-3 btn btn-outline-warning float-right" data-toggle="collapse" href="#m'.$ids[$i].'" role="button" aria-expanded="false">More</a> </span>
                
                <br><br>
                <div class="collapse multi-collapse" id="m'.$ids[$i].'">
                <p  id="c'.$ids[$i].'">'.$dets[$i].'<p>
                </div>
                </div>
            </div>    
        </div>';
            $i=$i+1;
        }
    }
    // } <div class="text-center"> <a role="button" class="btn btn-outline-warning float-left" href="cart.php?rid='. $ids[$i].'"> View Dishes </a> </div>
                
?>
        </div> 
    </div>
    
        <div style="margin-right: -50px; background : #111428; overflow-y: hidden; position: fixed; left:67%; height: 100vh;" class="col-4 ml-2 pt-5 " >
        <div class="row col-12 text-center mt-5 mb-5"></div>
        <?php  
            if(isset($_SESSION["logval"])==true) {
                echo '<h1 class="text-center text-white">Your Cart is Empty :( </h1>';
                echo '<div class="col-md-5 " style="margin-top: 30%; margin-left : 25%;">
                <img src="./images/EmptyCart.png" class="img-fluid" alt="Responsive image">
                </div>';
            }


        if(isset($_SESSION["logval"])==false) {
            echo'<div class="d-none d-lg-block">';
    ?>
        <div class="col-md-12 text-center text-white">
        <h1>Sign In</h1>
        </div>
        <form action="login.php" method="POST" >
            <div class="form-row" >
                <div class="form-group text-white col-md-10 pl-5">
                <label for="email">Email</label>
                <input type="text" name="email"  class="form-control" id="email" data-error="You must have a name." pattern="[^@\s]+@[^@\s]+\.[^@\s]+" placeholder="Email" minlength="3" required>
                <div class="help-block with-errors"></div>
            </div>
            </div>
            <div class="form-row" >
                <div class="form-group text-white col-md-10 pl-5">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" data-error="incorrect"  maxlength="20" minlength="3"
                    id="password" placeholder="Passsword" required>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <br>
            <input type="submit" class="btn btn-warning " value="Sign In">
           
            </div>
            </form> 

            <div class="col-md-12 text-center">
                <br>
                <button class="signup btn btn-warning">Sign Up</button>
           
            </div>
    <?php
    '</div>';
}
    ?>
        </div>
        
    </div>
    
    
</div> 
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="content">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">
                   Sign Up
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                
            </div>
            <div class="modal-body ">
            <form action="signup.php" method="POST" >
            <div class="form-row" >
                <div class="form-group col-sm-12">
                <label for="email1">Email</label>
                <input type="text" name="email1"  class="form-control" id="email1" data-error="You must have a name." pattern="[^@\s]+@[^@\s]+\.[^@\s]+" placeholder="Email" required>
                <div class="help-block with-errors"></div>
            </div>
            </div>
            <div class="form-row" >
                <div class="form-group col-sm-12">
                <label for="password1">Password</label>
                <input type="password" name="password1" class="form-control" data-error="incorrect"  maxlength="20" minlength="3"
                    id="password1" placeholder="Passsword" required>
                <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="form-group ">
                <label for="month">Contact </label>
                <input type="text" class="form-control" name="cont" placeholder="Contact" maxlength="10" minlength="10"
                pattern="^[0-9]*$" id="month" required>
                <div class="help-block with-errors"></div>
             </div>
             <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="contact">City </label>
                            <select class=" mt-2 p-2" id="city1" name="addcity">
                                <option>Port-Blair</option>
                                <option>Delhi</option>
                                <option>Jaipur</option>
                                <option>Patna</option>
                                <option>Lucknow</option>
                            </select>
                        </div>
                    </div>
            <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="address">Address</label>
                            <textarea type="text-area" class="form-control form-control-sm mr-1" name="adr1" id="address1" data-error="You must have a name."  placeholder="Address" required rows=3></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
            <div class="col-md-12 text-center">
                <br>
            <input type="submit" class="btn btn-warning " value="Sign Up">
           
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