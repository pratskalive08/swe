<?php 
    session_start();
    if(isset($_SESSION["Admin"]) && isset($_SESSION['logval'])){
        $u=$_SESSION['logval'];
        }
        if($u==false && $_SESSION["Admin"]== false){
            die("Access denied");
        }
        if(isset($_SESSION['email'])){
          $id=$_SESSION['email'];
        }
  

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
        
        

        $sql = "SELECT * FROM dishes WHERE Availability=0";

        $result = mysqli_query($conn, $sql);

        $dishes = array();
        $cost= array();
        $ids=array();
        //$result = mysqli_query($con, $sql2);
        $i=0;
        // output data of each row
        while($row = mysqli_fetch_assoc($result)){
            
            $dishes[$i]=$row['Dish_Name'];
            $cost[$i]=$row['Cost'];
            $ids[$i]=$row['Dish_Id'];
            //echo $ids[$i]." ";
            $i=$i+1;
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
            // $("#logbtn").click(function(){
            //     $("#loginModal").modal();
            // });
            var total=0;
            var ids=[];
            $(".addbtn").click(function(){
                $("#loginModal").modal();
                 $(".addDish").click(function(){
                     var name=$("#dishname").val();
                     var p=$("#price").val();
                     $(location).attr('href',"addDish.php?n="+JSON.stringify(name)+"&p="+JSON.stringify(p));
                 })
            });
            $(".updbtn").click(function(){
                var val=$(this).data("value") 
                var n= "#div"+val.toString();
                    var dname=$(n).text().split("R")[0]
                    var val1 = $(n).children().text()
                    var cost=val1.toString().substr(4)
                $("#dishname2").val(dname);
                $("#price2").val(cost);
                $("#loginModal2").modal();
                $(".updDish").click(function(){
                    var name1=$("#dishname2").val();
                    var p1=$("#price2").val();
                $(location).attr('href',"updateDish.php?n="+JSON.stringify(name1)+"&p="+JSON.stringify(p1)+"&id="+JSON.stringify(val));
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
        <div class="row mt-5 "><h1>Dishes<button class="addbtn btn btn-outline-warning ml-3" >Add Dishes</button> </h1> </div>
    <div class="row ">
    <div class="col-12 "> 
        <div class="row">
            
<?php
        $i=0;
        $img =array('./images/Capture0.jpg','./images/Capture1.jpg','./images/Capture2.jpg','./images/Capture3.jpg','./images/Capture4.jpg','./images/Capture5.jpg','./images/Capture6.jpg',
        './images/Capture7.jpg','./images/Capture8.jpg','./images/Capture9.jpg','./images/Capture10.jpg','./images/Capture11.jpg','./images/Capture12.jpg');

        while($i<count($dishes)){
           
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
                            <h5 id="div'.$ids[$i].'" class="card-title">'. $dishes[$i].'<span class="cost float-right"> Rs. '.$cost[$i].' </span></h5><a class="btn btn-outline-warning float-left" href=Deletedishes.php?id="'.$ids[$i].'">Delete</a> <button class="updbtn btn btn-outline-warning float-right" data-value="'.$ids[$i].'">Update</button> </span>
                              
                        </div>
                    </div>    
                </div>';
            $i=$i+1;
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
                    Enter Dish Details 
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                
            </div>
            <div class="modal-body ">
                <form role="form" data-toggle="validator">
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="dishname">Dish Name</label>
                            <input type="text" class="form-control form-control-sm mr-1" id="dishname" data-error="You must have a name." pattern="^[a-zA-Z]*$" placeholder="Name" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label  for="price">Cost per Serving</label>
                            <input type="text" class="form-control form-control-sm mr-1" pattern="^[0-9]*$" data-error="Must be a number" id="price" placeholder="Cost" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Cancel</button>
                        <button type="button" class="addDish btn btn-warning btn-sm ml-1">Add</button>        
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
                    Update Dish Details 
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                
            </div>
            <div class="modal-body ">
                <form role="form" data-toggle="validator">
                    <div class="form-row ">
                        <div class="form-group col-sm-12">
                            <label  for="dishname">Dish Name</label>
                            <input type="text" class="form-control form-control-sm mr-1" id="dishname2" data-error="You must have a name." pattern="^[a-zA-Z]*$" placeholder="Name" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label  for="price">Cost per Serving</label>
                            <input type="text" class="form-control form-control-sm mr-1" pattern="^[0-9]*$" data-error="Must be a number" id="price2" placeholder="Cost" required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Cancel</button>
                        <button type="button" class="updDish btn btn-warning btn-sm ml-1">Update</button>        
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