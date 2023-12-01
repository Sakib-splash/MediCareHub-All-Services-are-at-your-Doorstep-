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


//start
//----modified-----
 
// $result=mysqli_query($con,"SELECT * FROM registration WHERE email= $userEmail");//$userEmail
    
// $row=mysqli_fetch_assoc($result);
// $_SESSION['admin_name']=$row['firstName'];
// $_SESSION['admin_email']=$row['email'];//change
// $_SESSION['admin_id']=$row['id'];


$admin_id=$_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:');

}

if(isset($_POST['logout'])){
    session_abort();
    session_destroy();
   unset($_SESSION['admin_name']);
    header('location:http://localhost/MedicareHub/Home/index.php');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">

    <title>Admin Pannel</title>
</head>
<body>
    <?php
    include 'admin_header.php' 
    ?>
    
        <section class="dashboard">
            <div class="box-container">
                <div class="box">
                    <?php 
                         $total_pendings = 0;
                         $select_pendings=mysqli_query($con,"SELECT * FROM `orders` WHERE payment_status = 'pending'")  or die('query failed');

                         while($fetch_pendings = mysqli_fetch_assoc($select_pendings) ){
                             $total_pendings += $fetch_pendings['total_price'];
                         }
                    ?>
                    <h3> <?php echo $total_pendings;?>/- </h3>
                    <p>total_pendings</p>

                </div>
                <div class="box">
                    <?php 
                         $total_completes = 0;
                         $select_completes=mysqli_query($con,"SELECT * FROM `orders` WHERE payment_status = 'complete'")  or die('query failed');

                         while($fetch_completes = mysqli_fetch_assoc($select_completes)){
                            $total_completes += $fetch_completes['total_price'];
                         }
                    ?>
                    <h3> <?php echo $total_completes;?>/- </h3>
                    <p>total_completes</p>

                </div>
                <div class="box">
                    <?php 
                         $select_orders=mysqli_query($con,"SELECT * FROM `orders`")  or die('query failed');
                         $num_of_orders = mysqli_num_rows($select_orders);

                         
                    ?>
                    <h3> <?php echo $num_of_orders;?></h3>
                    <p>order placed</p>

                </div>
                <div class="box">
                    <?php 
                         $select_products=mysqli_query($con,"SELECT * FROM `products`")  or die('query failed');
                         $num_of_products = mysqli_num_rows($select_products);

                         
                    ?>
                    <h3> <?php echo $num_of_products;?></h3>
                    <p>product added</p>

                </div>
                <div class="box">
                    <?php 
                         $select_users=mysqli_query($con,"SELECT * FROM `registration` WHERE   user_type='user' ")  or die('query failed');
                         $num_of_users = mysqli_num_rows($select_users);

                         
                    ?>
                    <h3> <?php echo $num_of_users;?></h3>
                    <p>total normal users</p>

                </div>
                <div class="box">
                    <?php 
                         $select_admin=mysqli_query($con,"SELECT * FROM `registration` WHERE   user_type='admin' ")  or die('query failed');
                         $num_of_admin = mysqli_num_rows($select_admin);

                         
                    ?>
                    <h3> <?php echo $num_of_admin;?></h3>
                    <p>total admin</p>

                </div>
                <div class="box">
                    <?php 
                         $select_users=mysqli_query($con,"SELECT * FROM `registration`")  or die('query failed');
                         $num_of_users = mysqli_num_rows($select_users);

                         
                    ?>
                    <h3> <?php echo $num_of_users;?></h3>
                    <p>total registered users</p>

                </div>
                <div class="box">
                    <?php 
                         $select_message=mysqli_query($con,"SELECT * FROM `message`")  or die('query failed');
                         $num_of_message = mysqli_num_rows($select_message);

                         
                    ?>
                    <h3> <?php echo $num_of_message;?></h3>
                    <p>new messages</p>

                </div>
                
            </div>
        </section>
    </div>
    <script src="script.js"></script>


</body>
</html>
