<?php
session_start();
$host="localhost";
$user="root";
$pass="";
$db="register";

//Connect database
$con=new mysqli($host,$user,$pass,$db);
//if not connect
if(!$con){
    echo "There are some problem while connecting the database";

}
$user_id = $_SESSION['user_id'];


if(isset($_POST['logout'])){
  session_destroy();
  session_abort();
   unset($_SESSION['user_name']);
    header('location:http://localhost/MedicareHub/login/');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../AdminPannel/style.css">
    <title>
        Doctors
    </title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>Best Doctors List</h1>
            <p>We have the best doctors for telemedicine.</p>
        </div>
    </div>


  <section class="shop">
  <h1 class="title">Booking a Doctor's Appoinment.............</h1>
  

  </div>
  <?php
        if(isset($message)){
            foreach($message as $message){
                echo '
                    <div class="message">
                    <span>' .$message. '</span>
                    <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>
                ';
            }
        }
        ?>
 
        <div class="doctor-list" >
            <div>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d1.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d2.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d3.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d4.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d5.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d6.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d7.png" alt=""></a>
                <a href="http://localhost/MedicareHub/Home/appoinment.php"><img src="../Home/newDoctor/d8.png" alt=""></a>
            </div>
        </div>
        <div class="last-header" >
            <div>
                <h1>Affordable telemedicine health service

                </h1>
                <p>MediCareHub is committed to serving telemedicine service in the whole Bangladesh</p>
                <p>our service is open for doctor and patient 24/7</p>
            </div>
        </div>
   


        <footer class="full-footer">
          <div class="footer-body">
            <div class="row">
              <div class="col">
                <h4>About Us</h4>
                <p>We are always here to hear you.</p>
              </div>
              <div class="col">
                <h4>Categories</h4>
                <ul>
                <li><a href="http://localhost/MedicareHub/Home/"> Home</a></li>
                    <li><a href="Services.html">Services</a></li>
                    <li><a href="Blog.html">Blog</a></li>
                    <li><a href="http://localhost/MediCareHub/about/About.html">About Us</a></li>
                    <li><a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a></li>
                    <li><a href="http://localhost/MedicareHub/login/">SignUp</a></li>
                </ul>
              </div>
              <div class="col">
                <h4>Contact Us</h4>
                <p>JAGANNATH UNIVERSITY<br>DHAKA,BANGLADESH<br>01518951189<br>sakibsplash.blogspot.com/</p>
              </div>
            </div>
          </div>
      </footer>
    
  </section>
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>