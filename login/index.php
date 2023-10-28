<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
   <link rel="stylesheet" href="style.css">
   
    <title>Login</title>
</head>
<body>
    
   <header>
    <div class="navbar">
        <img src="../Home/Logo.png" class="logo">
        <nav>
            <ul>
                <li><a href="http://localhost/MedicareHub/Home/"> Home</a></li>
                <li><a href="Services.html">Services</a></li>
                <li><a href="Blog.html">Blog</a></li>
                <li><a href="http://localhost/MediCareHub/about/About.html">About Us</a></li>
                <li><a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a></li>
                <li><a href="http://localhost/MedicareHub/login/">SignUp</a></li>
            </ul>
        </nav>
     </div>
   </header>
   
    <section>
        
        
        <div class="form-box">
            <div>
                <form action="connect.php" method="post" autocomplete="off">
                    <h2>Login</h2>
                    <div class="input-box">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="userEmail" required>
                        <label for="">Email</label>
                    </div>
                    <div class="input-box">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="" >Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox" >Remember Me </label>
                        <a href="#" onclick="message()">Forget Password</a>
                        
                    </div>
                    <button type="submit" name="submit">Login</button>
                    <div class="register">
                        <p>Don't have an account <a href="http://localhost/MedicareHub/Register/insert.php" >Register</a></p>
                        
                    </div>
                </form>
            </div>
        </div>
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