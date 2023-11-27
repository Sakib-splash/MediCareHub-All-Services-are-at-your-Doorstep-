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
    header('location:http://localhost/MedicareHub/update/');

}

    //------Delete Products from database--------
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
       
        mysqli_query($con,"DELETE FROM `message` WHERE id='$delete_id'")or die('query failed');

        header('location:index.php');//------admin_message.php hobe-----//

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
   <section class="message-container" >
    <h1 class="title">total user account</h1>
    <div class="box-container">
        <?php 
            $select_users= mysqli_query($con,"SELECT * FROM `registration`") or die('query failed');
            if(mysqli_num_rows($select_users)>0){
                while($fetch_users=mysqli_fetch_assoc($select_users)){

                
            
        ?>
        <div class="box">
            <p>user id: <span><?php echo $fetch_users['id']; ?></span> </p>
            <p>name: <span><?php echo $fetch_users['firstName']; ?></span> </p>
            <p>email: <span><?php echo $fetch_users['email']; ?></span> </p>
            <p>user type : <span> <?php echo $fetch_users['user_type']; ?></span></p>
            <a href="index.php?delete=<?php echo $fetch_users['id']; ?>;"class="delete" onclick="return confirm('delete this message');" >delete</a><!--admin_message.php hobe-->

        </div>
        <?php
                }
             }
             else{
                echo '
                <div class="empty">
                <p>no products added yet</p>
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
