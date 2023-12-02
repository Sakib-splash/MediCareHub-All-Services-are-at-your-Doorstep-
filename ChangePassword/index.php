
<?php
session_start();
include "../connection.php";


if(isset($_POST["submit"])){
    $userEmail = $_POST["userEmail"];//change UserEmail to email
    $password=$_POST['password'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];

    $result=mysqli_query($con,"SELECT * FROM registration WHERE email='$userEmail'");
    
     $row=mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)>0){
        
        if($password==$row["password"]){
       
            if($newpassword=$confirmnewpassword){
       
                $sql=mysqli_query($con,"UPDATE registration SET password='$newpassword' WHERE email='$userEmail'") or die('query failed');
                if($sql)
                {
                echo "Congratulations You have successfully changed your password";
                }
               else
                {
                echo "Passwords do not match";
                }
            }

        }
        else{
             echo  "<script> alert('Wrong Password..'); </script>" ;
            }
        
        }
}
else{
        echo  "<script> alert('wrong username..'); </script>" ;
    }










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="../AdminPannel/style.css">
   <link rel="stylesheet" href="../login/style.css">
   
    <title>Change Password</title>
</head>
<body>
    
<header class="header" >
        <div class="flex" >
            <a href="admin_pannel.php" class="logo" ><img src="../AdminPannel/img/admin.png" ></a>
            <nav class="navbar" >
            <li><a href="http://localhost/MedicareHub/Home/"> Home</a>
                    <a href="http://localhost/MedicareHub/Services/">Services</a>
                    <a href="Blog.html">Blog</a>
                    <a href="http://localhost/MediCareHub/about/About.html">About Us</a>
                    <a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a>
                    <a href="http://localhost/MedicareHub/login/">Log In</a></li>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn" ></i>
                <i class="bi bi-list" id="menu-btn" ></i>
            </div>
            <div class="user-box">
                <p>Username : <span> <?php echo $_SESSION['admin_name']; ?></span> </p>
                <p>Email : <span> <?php echo $_SESSION['admin_email']; ?></span> </p>
                <form action="index.php" method="post">
                    <button type="submit" class="logout-btn" >Logout</button>
                </form>
            </div>
        </div>
    </header>
  
    <section class="add-products form-container" >
            <form method="POST" action="" enctype="multipart/form-data" >
                <div class="input-field">
                    <label for="">Old Password</label>
                    <input type="text" name="password" required>
                </div>
                <div class="input-field">
                    <label for="">New Password</label>
                    <input type="text" name="new_password" required>
                </div>
                <div class="input-field">
                    <label for="">Confirm New Password</label>
                    <input type="text" name="confirm_new_password" required>
                </div>
                
                <input type="submit" name="changePassword" value="Confirm Change" class="btn" >
            </form>
        </section>
    

    <!-- Footer Section
    <footer>
          <div class="footer-body">
            <div class="row">
              <div class="col">
                <h4>About Us</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
              <div class="col">
                <h4>Categories</h4>
                <ul>
                  <li><a href="#">Clothing</a></li>
                  <li><a href="#">Shoes</a></li>
                  <li><a href="#">Accessories</a></li>
                  <li><a href="#">Electronics</a></li>
                </ul>
              </div>
              <div class="col">
                <h4>Contact Us</h4>
                <p>123 Main Street<br>Anytown, USA<br>123-456-7890<br>info@example.com</p>
              </div>
            </div>
          </div>
      </footer> -->

    <script>
        function message()
        {
            alert("Password mone koro")
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>