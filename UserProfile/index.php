<?php
session_start();
include "../connection.php";

$user_id=$_SESSION['user_id'];
$result=mysqli_query($con,"SELECT * FROM registration WHERE id='$user_id'");
$row=mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
    $_SESSION['firstname']=$row['firstName'];
    $_SESSION['lastname']=$row['lastName'];
    $_SESSION['email']=$row['email'];
    $_SESSION['dateOfBirth']=$row['dateOfBirth'];
    $_SESSION['phoneNumber']=$row['phoneNumber'];
    $_SESSION['address']=$row['address'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="style.css">
    <title>User Profile</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="profile-links">
                    <img src="../Home/img/profile.png" alt="">
                    <li><b><a href="#" class="link-style"><span> <?php echo $_SESSION['firstname'],' ', $_SESSION['lastname']; ?></span></a></b></li>
                    <li><a href="#" class="link-style">Privacy Setting</a></li>
                    <li><a href="http://localhost/MedicareHub/Home/" class="link-style">Back to Home</a></li>
                    <li><a href="#" class="link-style">help</a></li>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-custum">
                    <div class="details">
                        <div class="row">
                            <div class="col-8">
                                Name
                            </div>
                            <div class="col-4">
                            <span> <?php echo $_SESSION['firstname'],' ', $_SESSION['lastname']; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <div class="row">
                            <div class="col-8">
                                Email Address: 
                            </div>
                            <div class="col-4">
                            <?php echo $_SESSION['email'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <div class="row">
                            <div class="col-8">
                                Phone Number:
                            </div>
                            <div class="col-4">
                            <?php echo $_SESSION['phoneNumber'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <div class="row">
                            <div class="col-8">
                                Address: 
                            </div>
                            <div class="col-4">
                            <?php echo $_SESSION['address'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="mt-5"> About me</h3>
                <p class="text-justify">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Qui, a! Quia fuga ab doloribus officiis, pariatur, perspiciatis quo accusantium reprehenderit quidem harum culpa similique architecto enim amet, veniam dolor non tempore adipisci facilis dolores vero voluptatum? Possimus provident labore repellendus corrupti rem, atque pariatur? Optio quod sint amet quasi rerum.

                </p>
            </div>
        </div>
    </div>

</body>

</html>