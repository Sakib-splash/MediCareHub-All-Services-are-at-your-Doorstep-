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
    <title>Shop</title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>Order</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tenetur consequa
               s.</p>
        </div>
    </div>
<div class="line"></div>

<div class="order-section">
    <div class="box-container">
        <?php
            $select_orders= mysqli_query($con,"SELECT * FROM `orders` WHERE user_id=$user_id") or die('query failed');
            if(mysqli_num_rows($select_orders)>0){
                while($fetch_orders = mysqli_fetch_assoc($select_orders)){
            
            ?>
            <div class="box">
            <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>

            <p>name: <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p>number: <span><?php echo $fetch_orders['number']; ?></span> </p>
            <p>email: <span><?php echo $fetch_orders['email']; ?></span> </p>
            <p>Address: <span><?php echo $fetch_orders['address']; ?></span> </p>
            
            <p>Your Order: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
            <p>Total Price: <span><?php echo $fetch_orders['total_price']; ?></span> </p>
            <p>Payment Status: <span><?php echo $fetch_orders['payment_status']; ?></span> </p>


            </div>
            <?php 
                    }
                }else{
                    echo '
                    <div class="empty">
                    <p>no order placed yet!</p>
                </div>
                ';
                }
                ?>
                
    </div>
</div>
  
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>