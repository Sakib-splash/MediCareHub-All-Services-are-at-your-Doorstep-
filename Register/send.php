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
//there are no errors then let's get data form
if(isset($_POST["submit"])){
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $dateOfBirth=$_POST['dateOfBirth'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $gender=$_POST['gender'];
    $phoneNumber=$_POST['phoneNumber'];
    $address=$_POST['address'];
    $postalCode=$_POST['postalCode'];
    $duplicate=mysqli_query($con,"SELECT * FROM registration WHERE email='$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo  "<script> alert('This Email Has Already Taken..'); </script>" ;
       
    }
    else{
        if($password==$confirmPassword){
            $qry="INSERT INTO `registration` (`firstName`, `lastName`, `dateOfBirth`, `email`, `password`, `gender`, `phoneNumber`, `address`, `postalCode`) VALUES ('$firstName','$lastName','$dateOfBirth','$email', '$password', '$gender', $phoneNumber, '$address', '$postalCode')";
            

            $insert=mysqli_query($con,$qry);

            echo  "<script> alert('Registration successful...'); </script>" ;
            header('location:http://localhost/MedicareHub/Home/');
            // if(!$insert){}
            // echo "There are some problem while inserting the data";
            //  }else{
            //  echo "Data inserted successfully" ;
            //  }

        }
        else{
            echo  "<script> alert('password doesnot matching'); </script>" ;

        }
    }
}



?>
