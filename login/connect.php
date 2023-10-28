<?php
session_start();
include "../connection.php";
// $host="localhost";
// $user="root";
// $pass="";
// $db="register";

// //Connect database
// $con=new mysqli($host,$user,$pass,$db);
// //if not connect
// if(!$con){
//     echo "There are some problem while connecting the database";

// }

if(isset($_POST["submit"])){
    $userEmail = $_POST["userEmail"];//change UserEmail to email
    $password=$_POST['password'];

    $result=mysqli_query($con,"SELECT * FROM registration WHERE email='$userEmail'");
    
     $row=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)>0){
        
     if($password==$row["password"]){
        $_SESSION["login"]=true;
         $_SESSION["id"]=$row["id"];
        //  $row=mysqli_fetch_assoc($result);

        if($row['user_type']=='admin'){
            
            $_SESSION['admin_name']=$row['firstName'];
            $_SESSION['admin_email']=$row['email'];//change
            $_SESSION['admin_id']=$row['id'];
            header('location:http://localhost/MedicareHub/AdminPannel/');
    }else if($row['user_type']=='user'){
        $_SESSION['user_name']=$row['firstName'];
            $_SESSION['user_email']=$row['email'];//change
            $_SESSION['user_id']=$row['id'];
            $_SESSION['phoneNumber']=$row['phoneNumber'];
            
            header('location:../update/index.php');
    }
    else{
             echo  "<script> alert('Wrong Password..'); </script>" ;
        }
        
        }


        // if($password==$row["password"]){
        //     $_SESSION["login"]=true;
        //     $_SESSION["id"]=$row["id"];
          
        //     header("location:welcome.php");
        // }
        // else{
        //     echo  "<script> alert('Wrong Password..'); </script>" ;
        // }
    }
    else{
        echo  "<script> alert('This mail is not registered..'); </script>" ;
    }
}




?>