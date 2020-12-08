<?php 
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
    $name="Global Fusion Restaurant";
    $city="Mumbai";
   
$cities=array("Mumbai","Port-Blair","Visakhapatnam");//,"Vijaywada","Tangwa","Patna","Chandighar","Raipur-chhattisgarh","Delhi","Goa","Ahmedabad","Karnal",
//"Shimla","Srinagar","Ranchi","Banglore","Thiruvananthapuram","Bhopal","Bhubaneshwar","Amritsar","Jaipur","Gangtok","Chennai","Lucknow","Nainital",
//"Durgapur");
$rest=array("Country Inn & Suites By Carlson Jaipur",
"Barbeque Nation",
"F Bar & Lounge Jaipur",
"Sharma Dhaba",
"Sethi Bar-Be-Que",
"Romils Roof",
"Blackout Restaurant",
"Sankalp",
"Area 51 Ultra Lounge",
"On The Bar B-Q",
"Cocoa House",
"Chokha Punjab",
"Chawlas Restaurant",
"Kanha Sweets & Multicuisine Restaurant",
"Kebabs & Curries Company",
);
echo count($rest);
// $sql = "INSERT INTO restaurant (Rest_Name, City) VALUES ('$name','$city','$ad')";
    $det =array("Country Inn & Suites By Carlson Jaipur Area:M I Road Phone No: +911413388705 Address: Khasa Kothi Circle, M I Road, Jaipur, Pin Code: 302001(1)5%(824)4",
    "Barbeque Nation Area:Tonk Road Phone No: +911416060000 Address: Ground Floor , City Plex Mall, Tonk Road Junction, Tonk Road, Jaipur, Pin Code: 302018 Landmark: Ashram Marg(2)4%(685)4",
    "F Bar & Lounge Jaipur Area:M I Road Phone No: +911414268730 Address: Golden Tulip, Mirza Ismail Road, M I Road, Jaipur, Pin Code: 302001 Landmark: Near Audi Showroom, Opposite Gpo, Behind Jangid Bhawan(3)3%(459)3",
    "Sharma Dhaba Area:Vishwakarma Industrial Area Phone No: +911412331582 Address: Road No-8,Sikar Road, Vishwakarma Industrial Area, Jaipur, Pin Code: 302013(4)2%(410)4",       
    "Sethi Bar-Be-Que Area:Malviya Nagar Phone No: +919828612345 Address: Crystal Court Mall, Behind Gaurav Tower, Malviya Nagar, Jaipur, Malviya Nagar, Jaipur, Pin Code: 302017(5)2%(386)4",
    "Romils Roof Area:Vaishali Nagar Phone No: +917222072583 Address: 8th Floor, Shree Govindam Business Tower, Gautam Marg, Vaishali Nagar, Jaipur, Pin Code: 302021 Landmark: Above F Salon(6)2%(365)3",
    "Blackout Restaurant Area:C Scheme Phone No: +911413382888 Address: C/O Hotel Golden Oak, 8th Floor, Landmark Building, C Scheme, Jaipur, Pin Code: 302001 Landmark: Ahinsa Circle(7)2%(351)4",
    "Sankalp Area:Vaishali Nagar Phone No: +911412359432 Address: 32-33, vidhyut nagar, Vaishali Nagar, Jaipur, Pin Code: 302021 Landmark: Opposite Sub Hospital, Purani Chungi(8)2%(335)4",
    "Area 51 Ultra Lounge Area:Raja Park Phone No: +911414045151 Address: 11/1, Govind Marg, Raja Park, Jaipur, Pin Code: 302004(9)1%(302)3",
    "On The Bar B-Q Area:Malviya Nagar Phone No: +911415115555 Address: 6th Floor, Crystal Court Mall, Malviya Nagar, Jaipur, Pin Code: 302017(10)1%(267)3",
    "Cocoa House Area:Tonk Road Phone No: +911414004114 Address: Sb-52,Krishna Tower, Tonk Road, Tonk Road, Jaipur, Pin Code: 302015(11)1%(228)4",
    "Chokha Punjab Area:Ajmer Road Phone No: +911415167000 Address: 8th Mile, Ajmer Road, Jaipur, Pin Code: 302001(12)1%(204)4",
    "Chawlas Restaurant Area:C Scheme Phone No: +911415106506 Address: G, Pin Code: 1, Shree Gopal Tower, Krishna Marg, C Scheme, Jaipur, Pin Code: 302001(13)1%(193)4",
    "Kanha Sweets & Multicuisine Restaurant Area:Shastri Nagar Phone No: +911414030938 Address: Ground Floor ,Arya Square Mall, Jhotwara Road, Shubash Marg, Shastri Nagar, Jaipur, Pin Code: 302016 Landmark: Near Doodh Mandi(14)1%(190)4",
    "Kebabs & Curries Company Area:Malviya Nagar Phone No: +911412553480 Address: Shop No 1, Malviya Nagar, Jaipur, Pin Code: 302017 Landmark: Indira Palace,Crystal Court(15)1%(186)5",
    );
    $i=0;
    $j=0;
        $city="Jaipur";
  
        while($j<=14){

            $name=$rest[$j];
            $ads=$det[$j];
            $sql = "INSERT INTO restaurant (Rest_Name, City,Rest_Details) VALUES ('$name','$city','$ads')";
            if( mysqli_query($conn, $sql)){
                echo "Successful :)";
            }else {
                echo "Error deleting record: " . mysqli_error($conn);
              }
            $j=$j+1;
        }
    // $result = mysqli_query($conn, $sql);
    if( mysqli_query($conn, $sql)){
        echo "Successful :)";
    }else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
?>