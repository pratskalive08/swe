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
  
if($_SERVER["REQUEST_METHOD"] == "POST"){
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
        
        $city = $_POST["city"];
        $loc =$city;
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
        <style>
            .container{
                margin-top: 400px;
            }
        </style>
        
        <script>
         
        $(document).ready(function(){
            $(".addbtn").click(function(){
                var val=$(this).data("value")
                $("#loginModal").modal();
                //  $(".addRest").click(function(){
                //      var act= $(".f1").attr( 'action' );
                //     var act1=act.toString()+"?id="+val;
                //     $(".f1").attr( 'action',act1.toString());
                //      //$(location).attr('href',"addRest.php?n="+JSON.stringify(name)+"&p="+JSON.stringify(p));
                //  })
            });
            $(".updbtn").click(function(){
                var val=$(this).data("value") 
                var n= "#div"+val.toString();
                var rname=$(n).text()
                var m= "#c"+val.toString();
                var details =$(m).text();
                var dets=details.toString();
                
                // restname2
                $("#restname2").val(rname);
                $("#address2").val(details);
                $("#loginModal2").modal();
                $(".updRest").click(function(){
                    var act= $(".f2").attr( 'action' );
                    var act1=act.toString()+"?id="+val;
                    $(".f2").attr( 'action',act1.toString());
                    //  var name=$("#dishname").val();
                    //  var p=$("#price").val();
                    // $(location).attr('href',"updateRest.php?rname="+JSON.stringify(rname)+"&d="+JSON.stringify(dets)+"&id="+JSON.stringify(val));
                 })
               
               
            })           
            
        });

        </script>

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
        <a class="nav-link" href="adminRest.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
    
    <div class="container mt-5">
        <div class="row mt-5 "><h1>Restaurants<button class="addbtn btn btn-outline-warning ml-3" >Add Restaurants</button> </h1> 
        <form class="ml-4 float-right" action="adminRest.php" method="POST">
        <select id="city"class="btn-outline-warning mt-2 p-2" name="city">
            <option>Port-Blair</option>
            <option>Delhi</option>
            <option>Jaipur</option>
            <option>Patna</option>
            <option>Lucknow</option>
        </select>
        <button type="submit" class="addbtn btn btn-outline-warning ml-3" >Select</button>
        <?php 
   if(isset( $_POST["city"])){
        echo '<div class="form-group row">
        <div class="col-12">
         <h1 class="mt-2"> '.$loc.'</h1>
        </div>
      </div>';
    }
        ?>
        </form>
        
    </div>
    <div class="row ">
    <div class="col-12 "> 
        <div class="row">
            
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $i=0;
        $img =array('./images/Capture0.jpg','./images/Capture1.jpg','./images/Capture2.jpg','./images/Capture3.jpg','./images/Capture4.jpg','./images/Capture5.jpg','./images/Capture6.jpg',
        './images/Capture7.jpg','./images/Capture8.jpg','./images/Capture9.jpg','./images/Capture10.jpg','./images/Capture11.jpg','./images/Capture12.jpg');

        while($i<count($name)){
           
            if( $i%3==0){
                echo '<div class="w-100"></div>';
            }
            $index =rand(0,11);
            $p =$img[$index];
            //echo $ids[6];
           echo '<div class="col-4 mb-5" >
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src='.$p.' alt="Card image cap">
                        <div class="card-body">
                        <h5 id="div'.$ids[$i].'" class="card-title">'. $name[$i].'</h5><a class="btn btn-outline-warning float-left" href=deleteRest.php?id="'.$ids[$i].'">Delete</a><a class="ml-3 btn btn-outline-warning" data-toggle="collapse" href="#m'.$ids[$i].'" role="button" aria-expanded="false">More</a> <button class="updbtn btn btn-outline-warning float-right" data-value="'.$ids[$i].'">Update</button> </span>
                        <div class="text-center"> <a role="button" class="btn btn-outline-warning mt-2" href="admindishes.php"> View Dishes </a> </div>
                        
                        <br>
                        <div class="collapse multi-collapse" id="m'.$ids[$i].'">
                        <p  id="c'.$ids[$i].'">'.$dets[$i].'<p>
                        </div>
                        </div>
                    </div>    
                </div>';
            $i=$i+1;
        }

    }
?>
        </div> 
    </div>
    <!-- <div class="col-4" style="margin-right: -10px;">
        <h1> Cart</h1>
        
        <ul id="cart" >

        </ul>
        <div class="float-right">
            <h3>Total : <span id="total"></span></h3>
            
            <button id="final"  class="btn btn-outline-warning">Checkout</button>
        </div>
        </div>
        
    </div> -->
<div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="content">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">
                    Enter Restaurant Details 
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                
            </div>
            <div class="modal-body ">
            <form class="f1"action="addRest.php" method="POST">
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="restname">Restaurant Name</label>
                            <input type="text" class="form-control form-control-sm mr-1" name="rname1" id="restname" data-error="You must have a name."  placeholder="Name" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="contact">City </label>
                            <select class="btn-outline-warning mt-2 p-2" id="city1" name="addcity">
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
                            <label  for="address">Restaurant Details</label>
                            <textarea type="text-area" class="form-control form-control-sm mr-1" name="adr1" id="address1" data-error="You must have a name."  placeholder="Address" required rows=3></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Cancel</button>
                        <button type="submit"  class="addRest btn btn-warning btn-sm ml-1">Add</button>        
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

<div id="loginModal2" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" role="content">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title ">
                    Update Restaurant Details 
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                
            </div>
            <div class="modal-body ">
                <form role="form" class="f2" action="updateRest.php" method="POST" data-toggle="validator">
                <div class="form-row ">
                        <div class=" form-group col-sm-12">
                            <label  for="restname">Restaurant Name</label>
                            <input type="text" class="form-control form-control-sm mr-1" name="rname2" id="restname2" data-error="You must have a name."  placeholder="Name" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <!-- <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="city">City</label>
                            <select id="city2" class="btn-outline-warning mt-2 p-2" name="updcity">
                                <option>Port-Blair</option>
                                <option>Mumbai</option>
                                <option>Visakhapatnam</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="address">Restaurant Details</label>
                            <textarea type="text-area" class="form-control form-control-sm mr-1" name="ad2" id="address2" data-error="You must have a name." placeholder="Address" required rows=5></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Cancel</button>
                        <input type="submit" class="updRest btn btn-warning btn-sm ml-1">       
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>

    
</div> 


    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>