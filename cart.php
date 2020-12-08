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
        $rest = $_GET['rid'];
        $_SESSION['rest'] = $rest;
        $sql = "SELECT * FROM restaurant WHERE Rest_Id=$rest";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $restname = $row['Rest_Name'];
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
            var total=0;
            var ids=[];
            $(".addbtn").click(function(){
                var val=$(this).data("value") 
                ids.push(val)
                var n= "#div"+val.toString();
                var m=$(n).text().split("R")[0]
                var val1 = $(n).children().text()
                var t=val1.toString().substr(4)     
                total=parseInt(t)+total;
                $("#total").text(total);
                $('#cart').append('<div id="elem'+val+'" class="row mt-3"><div class="f col-12 pt-4 pb-4 border rounded border-warning" >'+m+'&nbsp<button type="button" id="close'+val+'" class=" close btn btn-sm btn-outline-warning float-right ml-1">&times;</button><span id="cost'+val+'" class="val float-right">'+val1+'</span><button class="subval'+val+' btn btn-sm btn-dark float-right" type="button">-</button><input type="number" id="quant'+val+'" class=" meow float-right" min=1  name="quant'+val+'" style="width :34px" value="1" /><button class="addval'+val+' btn btn-sm btn-dark float-right" type="button">+</button> </div><br></div>')
                //$("#total").text(quant);
                $(".addval"+val).click(function(){
                    var p="#quant"+val.toString();
                    var quant=parseInt($(p).val());
                    flag=1;
                    var l =parseInt(t);
                    $(p).val(quant+1);
                    total=total+l;
                    $("#total").text(total);           
                });
                $(".subval"+val).click(function(){
                    var p="#quant"+val.toString();
                    var quant=parseInt($(p).val());
                    var l =parseInt(t);
                    if(total>0 && quant>0){
                        $(p).val(quant-1);
                        total=total-l;
                        $("#total").text(total);
                    }                     
                });
                $("#close"+val).click(function(){
                    var k=0;
                    while(k<ids.length){
                        if(ids[k]==val){
                            ids[k]=-1;
                        }
                        k=k+1;
                    }
                    var p="#quant"+val.toString();
                    var quant=parseInt($(p).val());
                    var l =parseInt(t);
                    if(total>0 && quant>0){
                        $(p).val(quant-1);
                        total=total-(l*quant);
                        if(total==0) $("#total").text("");
                        else $("#total").text(total);
                    }  
                    console.log(ids);
                    $("#elem"+val).remove();
                })  
            });
            $('#final').click(function(){
            var n = <?php echo count($ids);?>;
            var q=[];
            var c=[];
            var i=1;
            var j=0;
            while(i<n+1){
                if($("#quant"+i).val()!=null && ($("#cost"+i).text()!=null ||$("#cost"+i).text()!="") ){
                    q[j]=$("#quant"+i).val();
                    c[j]=$("#cost"+i).text().substr(4);
                    j=j+1;
                }
                i=i+1
            }
            ids2=[];
            var j=0;
            var e=0
            while(j<ids.length){
                if(ids[j]!=-1){
                    ids2[e]=ids[j];
                    e=e+1;
                }
                j=j+1;
            }

            console.log(q)
            console.log(c)
           $(location).attr('href',"payments.php?q="+JSON.stringify(q)+"&id="+JSON.stringify(ids2)+"&total="+JSON.stringify(total));
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
    
    <div class="container mt-5">
        
        
        <div class="row mt-5 text-center"><h1>Dishes</h1></div>
    <div class="row ">
    <div class="col-8 "> 
        <div class="row">
<?php
echo '<div class ="text-center col-12"><h1>'.$restname.'</h1></div>';
        $i=0;
        $img =array('./images/Capture0.jpg','./images/Capture1.jpg','./images/Capture2.jpg','./images/Capture3.jpg','./images/Capture4.jpg','./images/Capture5.jpg','./images/Capture6.jpg',
        './images/Capture7.jpg','./images/Capture8.jpg','./images/Capture9.jpg','./images/Capture10.jpg','./images/Capture11.jpg','./images/Capture12.jpg');

        while($i<count($dishes)){
            if($i%2==0 ){
                echo '<div class="w-100"></div>';
            }
            $index =rand(0,11);
            $p =$img[$index];
            //echo $ids[6];
           echo '<div class="col mt-4" >
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src='.$p.' alt="Card image cap">
                        <div class="card-body">
                            <h5 id="div'.$ids[$i].'" class="card-title">'. $dishes[$i].'<span class="cost float-right"> Rs. '.$cost[$i].' </span></h5> <button class="addbtn btn btn-outline-warning float-right" data-value="'.$ids[$i].'">+</button> </span>
                        </div>
                    </div>    
                </div>';
            $i=$i+1;
        }
?>
        </div> 
    </div>
    <div class="col-4" style="margin-right: -10px;">
        <h1> Cart</h1>
        
        <ul id="cart" >

        </ul>
        <div class="float-right">
            <h3>Total : <span id="total"></span></h3>
            <!-- <a type="button" href="payments.php" class="btn btn-outline-warning">Checkout</a> -->
            <button id="final"  class="btn btn-outline-warning">Checkout</button>
        </div>
        </div>
        
    </div>

    
</div> 


    <script src="node_modules/jquery/dist/jquery.slim.min.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>