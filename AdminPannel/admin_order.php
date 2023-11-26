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
//start

session_start();

$admin_id=$_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:http://localhost/MedicareHub/login/');

}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:http://localhost/MedicareHub/login/');

}

    //------Delete Products from database--------
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
       
        mysqli_query($con,"DELETE FROM `orders` WHERE id='$delete_id'")or die('query failed');
        $message[]='user remove successfully';
        header('location:admin_order.php');//------admin_message.php hobe-----//

    }

    //---Updating Payment---
    if(isset($_POST['update_order'])){
        $order_id = $_POST['order_id'];
        $update_payment = $_POST['update_payment'];

        mysqli_query($con,"UPDATE `orders` SET payment_status='$update_payment' WHERE id='$order_id'") or die('query failed');

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
   <div class="line4">

   </div>
   <section class="order-container" >
    <h1 class="title">total user account</h1>
    <div class="box-container">
        <?php 
            $select_orders= mysqli_query($con,"SELECT * FROM `orders`") or die('query failed');
            if(mysqli_num_rows($select_orders)>0){
                while($fetch_orders=mysqli_fetch_assoc($select_orders)){

                
            
        ?>
        <div class="box">
            <p>user name: <span><?php echo $fetch_orders['name']; ?></span> </p>
            <p>user_id: <span><?php echo $fetch_orders['user_id']; ?></span> </p>
            <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
            <p>number : <span> <?php echo $fetch_orders['number']; ?></span></p>
            <p>email : <span> <?php echo $fetch_orders['email']; ?></span></p>
            <p>total price : <span> <?php echo $fetch_orders['total_price']; ?></span></p>
            <p>method : <span> <?php echo $fetch_orders['method']; ?></span></p>
            <p>address : <span> <?php echo $fetch_orders['address']; ?></span></p>
            <p>total product : <span> <?php echo $fetch_orders['total_products']; ?></span></p>
            <p>number : <span> <?php echo $fetch_orders['number']; ?></span></p>
            <form method="post" >
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>" >
                <select name="update_payment" id="">
                    <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                    <option value="pending">Pending</option>
                    <option value="complete">complete</option>
                </select>
                <input type="submit" name="update_order" value="update_payment" class="btn">

                <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>;"class="delete" onclick="return confirm('delete this message');" >delete</a><!--admin_message.php hobe-->

            </form>       


        </div>
        <?php
                }
             }
             else{
                echo '
                <div class="empty">
                <p>no order added yet!</p>
            </div>
                ';
            }
        ?>
    </div>
   </section>
        <dive class="line"></dive>
    <script src="./script.js"></script>


</body>
</html>
