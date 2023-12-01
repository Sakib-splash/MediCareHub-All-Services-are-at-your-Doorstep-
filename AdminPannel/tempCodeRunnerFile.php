<?php
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

session_start();
//start
$admin_id=$_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:http://localhost/MedicareHub/login/');

}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:http://localhost/MedicareHub/login/');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Admin Pannel</title>
</head>
<body>
    <?php
    include 'admin_header.php'?>
    <div class="line4" >
        <section class="dashboard">
            <div class="box-container">
                <div class="box">
                    <?php 
                         $total_pendings = 0;
                         $select_pendings=mysqli_query($conn,"SELECT * FROM 'orders' WHERE payment_status = 'pending'")  or die('query failed');

                         while($fetch_pending = mysqli_fetch_assoc($select_pendings)){
                            $total_pendings += $fetch_pending['total_price'];
                         }
                    ?>
                    <h3> <?php echo $total_pendings;?>/- </h3>
                    <p>total_pendings</p>

                </div>
            </div>
        </section>
    </div>
    <script src="script.js"></script>


</body>
</html>