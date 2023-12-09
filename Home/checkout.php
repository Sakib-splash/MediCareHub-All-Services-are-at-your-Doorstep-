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

    if(isset($_POST['order-btn'])){
         $name = $_POST['name'];
         $email = $_POST['email'];
         $number = $_POST['number'];
        $method=$_POST['order-btn'];
         $address = $_POST['address'];
         $total=$_POST['total'];
         $_SESSION['price']=$total;
         
        mysqli_query($con, "INSERT INTO `orders` (`user_id`,`name`,`number`,`email`,`method`,`address`,`total_price`) VALUES('$user_id','$name','$number','$email','$method','$address','$total')");
        mysqli_query($con,"DELETE FROM `cart` WHERE user_id='$user_id'");
        
        
        header('location: http://localhost/MediCareHub/update/index.php');
        
       
    }
    if(isset($_POST['payment-btn'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $number = $_POST['number'];
       $method=$_POST['order-btn'];
        $address = $_POST['address'];
        $total=$_POST['total'];
        $_SESSION['price']=$total;
        
       mysqli_query($con, "INSERT INTO `orders` (`user_id`,`name`,`number`,`email`,`method`,`address`,`total_price`) VALUES('$user_id','$name','$number','$email','$method','$address','$total')");
       mysqli_query($con,"DELETE FROM `cart` WHERE user_id='$user_id'");
       
       
       header('location: http://localhost/MediCareHub/Home/new.php');
       
      
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
    <title>checkout</title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>
                Checkout
            </h1>
            <p>Please, Provide your information in the form below.</p>
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
        <h1 class="title" style="font-size: 2rem;" >payment process</h1>
       
        <div class="display-order">
            <?php
            $select_cart=mysqli_query($con, "SELECT * FROM `cart` WHERE user_id= '$user_id'") or die('query failed');
            $total=0;
            $grand_total=0;
            if (mysqli_num_rows($select_cart)>0) {
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                    
                    $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                    $grand_total = $total += $total_price;
            ?>
            <div class="box-container">
                <div class="box">
                    <img src="../AdminPannel/img/<?php echo $fetch_cart['image']; ?>" >
                    <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
                </div>
            </div>
            <?php

                }
            }
            ?>
            <span class="grand-total">Total Amount payabale : $<?= $grand_total; ?></span>
        </div>
       <div class="formdec" >
       <form method="post">
            <div class="input-field">
                <label>your name</lable>
                <input type="text" name="name" placeholder="enter your name" >
            </div>
            <div class="input-field">
                <label>your number</lable>
                <input type="number" name="number" placeholder="enter your number" >
            </div><div class="input-field">
                <label>your email</lable>
                <input type="text" name="email" placeholder="enter your email" >
            </div><div class="input-field">
              
        
            </div>
            <div class="input-field">
                <label>address line</label>
                <input type="text" name="address" placeholder="e.g 16/A,Wari,Dhaka-1100">
            </div>
            <div class="input-field">
                <label>Total price of your products</label>
                <input type="text" name="total" value="<?php echo $grand_total;?>">
            </div>
           
            
            <input type="submit"  class="btn" name="order-btn" value="Cash on Delivery">

         <input type="submit"  class="btn" name="payment-btn" value="Payment Now">
           <!-- <input type="submit" name="order-btn" class="btn" value="Order Now"> -->
        </form>
       </div>

            </div>
</div>
  
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>