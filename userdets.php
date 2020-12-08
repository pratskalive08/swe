
<?php 
session_start();
$e=$_SESSION['email'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname ="food_delivery";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    //$sql = "INSERT INTO users (Email, Password, Address, Contact, City) VALUES('$email','$pass','$ad','$c','$city')";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $p = $_POST["password"];
        $cont = $_POST["contcat"];
        $city = $_POST["loc1"];
        $address = $_POST["message"];
        $sql1 = "UPDATE users SET  Password='$p', Address='$address', Contact='$cont', City='$city' WHERE Email='$e' ";
    
        if (mysqli_query($conn,$sql1)) {
            echo "Record UPDATED successfully";
          } else {
            echo "Error deleting record: " . mysqli_error($conn);
          }
    }

    $sql = "SELECT * FROM users WHERE Email='$e' ";

    $result = mysqli_query($conn, $sql);
    $flag=0;
    while($row = mysqli_fetch_assoc($result)){
        $p=$row['Password'];
        $c=$row['Contact'];
        $city=$row['City'];
        $ad=$row["Address"];
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>
            User Details
        </title>
        <style>
            .navbar{
                background:#0d151f;
                height: 90px;
            }
            .navbar ul{
                overflow: auto;
            }
            .navbar li{
                float: left;
                list-style: none;
                margin: 13px 20px;
                padding-top: 20px;
            }
            .navbar li a{
                padding: 3px 3px;
                text-decoration: none;
                color: white;
                font-family: 'Bree Serif', serif;
                font-size: 1.3em;
            }
            
                #contact{
                    position: relative;
                }

                #contact::before{
                    content: "";
                    position: absolute;
                    background:url("tree.jpg") no-repeat center center/cover;
                    width: 100%;
                    height: 621px;
                    z-index: -1;
                    opacity: 0.9;
                }

                #contact-box{
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    padding-bottom: 34px;
                }
                #contact-box input,
                #contact-box textarea{
                    width: 100%;
                    padding: 0.5rem;
                    font-size: 1.1rem;
                }

                #contact-box form{
                    width: 30%;
                    margin-top: 50px;
                }
            
                #contact-box form .form-group{
                   padding:5px;
                }

                #contact-box label{
                    font-size: 1.3rem;
                    font-family: 'Bree Serif', serif;
                }
                        </style>
    </head>
    <body>
        <header>
        <nav class="navbar">
            <ul>
                <li class="item"><a href="userdets.php">My Profile</a></li>
                <li class="item"><a href="login.php">Home</a></li>
                <li class="item"><a href="orderDetails.php">My Orders</a></li>
                <li class="item"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
            <section id="contact">
            <div id="contact-box">
                <form action="userdets.php" method="POST">
                   
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" name="email" id="email" disabled="disabled" value=<?php echo $e?>>
                    </div>
                    <div class="form-group">
                        <label for="email">Password </label>
                        <input type="password" name="password" id="password" placeholder="Enter Your password" value=<?php echo $p?> >
                    </div>
                     <div class="form-group">
                        <label for="name">Contact</label>
                        <input type="text" name="contcat" id="name"  value=<?php echo $c?>>
                    </div> 
                    <div class="form-group">
                        <label for="loc">Location </label>
                        <select id="city"class="btn-outline-warning mt-2 p-2" name="loc1" value=<?php echo $city?> >
                            <option>Port-Blair</option>
                            <option>Delhi</option>
                            <option>Jaipur</option>
                            <option>Patna</option>
                            <option>Lucknow</option>
                        </select>
                        <input type="text" name="loc" id="loc" placeholder="Enter Your Location" disabled="disabled" value=<?php echo $city?>>
                    </div>
                    <div class="form-group">
                        <label for="message">Address </label>
                        <textarea name="message" id="message" cols="30" rows="5" ><?php echo $ad ?></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="update">
                    </div>
                </form>
                    
            </div>
        </section>
        </header>
    </body>
</html>