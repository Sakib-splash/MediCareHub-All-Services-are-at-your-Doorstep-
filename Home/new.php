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

   
       
        
       
    $grand_total=$_SESSION['price'];



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
    <title>new</title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>
                Get Ready For Payment
            </h1>
            <p>Check the amount for sure and Click Order Now For Payment</p>
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


<div class="checkout_form">
        <h1 class="title">payment process</h1>
       
        
            <span class="grand-total">Total Amount payabale : $<?= $grand_total; ?></span>
        
            <div class="formdec" >
            <form action="#">
            <div class="input-field">
                <label>Total price of your products</label>
                <input type="text" name="total" value="<?php echo $grand_total;?>">
            </div>
            

         <a href="http://localhost/MediCareHub/Home/payment.php?price=<?php echo $grand_total ?>"><input  class="btn" name="order-btn" value="Payment"></a>
           <!-- <input type="submit" name="order-btn" class="btn" value="Order Now"> -->
        </form>
    </div>

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