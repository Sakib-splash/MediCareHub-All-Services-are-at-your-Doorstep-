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

    if(!isset($user_id)){
    header('location:http://localhost/MedicareHub/login/');

    }

    if(isset($_POST['logout'])){
    session_destroy();
    session_abort();
    unset($_SESSION['user_name']);
    header('location:http://localhost/MedicareHub/login/');
    }

    if(isset($_POST['confirm-appointment-request'])){
         $name = $_POST['name'];
         $age = $_POST['age'];
         $number = $_POST['number'];
         $email = $_POST['email'];
         $time= $_POST['time'];
         $placed_on = date('d-M-Y');
        
         $appointment_query=mysqli_query($con, "SELECT * FROM `appointment` WHERE user_id='$user_id'" ) or die('query failed');
    

        mysqli_query($con, "INSERT INTO `appointment` (`user_id`,`name`,`age`,`number`,`email`,`time`) VALUES('$user_id','$name','$age','$number','$email','$time')");
    
        $message[] = 'Appointment request successfully done..........';
            
        header('location:http://localhost/MediCareHub/update/index.php');
    
       
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
    <title>Appointment</title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>
                Appoinments
            </h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tenetur consequa
               s.</p>
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
        </div>
    </div>


<div>
        <h1 class="title">Doctors Appoinment Process</h1>
       
        <div class="formdec">
        <form method="post">
            <div class="input-field">
                <label>Patient name</lable>
                <input type="text" name="name" placeholder="enter patients name">
            </div>
            <div class="input-field">
                <label>Patient Age</label>
                <input type="text" name="age" placeholder="enter patients age">
            </div>
            <div class="input-field">
                <label>Your Active number</lable>
                <input type="number" name="number" placeholder="enter your phone number">
            </div>
            <div class="input-field">
                <label>your email</lable>
                <input type="text" name="email" placeholder="enter your email">
            </div>
            <div class="input-field">
            <label>When you want to talk with doctor?</lable>
                <input type="text" name="time" placeholder="enter time= e.g 12:45pm">
        
            </div>
           
        <input type="submit" name="confirm-appointment-request" class="btn" value="confirm-appointment-request"  onclick="return confirm('are you sure to proceed for appointment procedure')">
          
        </form></div>

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
  
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>