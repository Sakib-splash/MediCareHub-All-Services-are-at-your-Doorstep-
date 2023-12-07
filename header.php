<?php

if($_SESSION['user_id']){
}
else{
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
    <link rel="stylesheet" href="../AdminPannel/style.css">
    <title>Document</title>
</head>
<body>
    <header class="header" >
        <div class="flex" >
            <a href="admin_pannel.php" class="logo" ><img src="../Home/Logo.png" ></a>
            <nav class="navbar" >
            <a href="http://localhost/MediCareHub/update/index.php"> Home</a>
                <a href="http://localhost/MediCareHub/Services/index.php">Services</a>
                
                <a href="http://localhost/MediCareHub/Home/shop.php">SHOP</a>

                <a href="http://localhost/MediCareHub/Blog/Blog.html">Blog</a></li>
                <a href="http://localhost/MediCareHub/about/About.html">About Us</a>
                <a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a>
                <a href="http://localhost/MedicareHub/login/">Log In</a>
            </nav>
            <div class="icons">
                      <i class="bi bi-person" id="user-btn"onclick="toggleMenu()"></i>
                      <?php 
                        $select_wishlist=mysqli_query($con,"SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query fialed');
                        $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                      ?>
                      <a href="http://localhost/MediCareHub/Home/wishlist.php"><i class="bi bi-heart"></i> <sup> <?php echo $wishlist_num_rows; ?></sup> </a>
                      <?php 
                        $select_cart=mysqli_query($con,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query fialed');
                        $cart_num_rows = mysqli_num_rows($select_cart);
                      ?>
                      <a href="http://localhost/MediCareHub/Home/cart.php"> <i class="bi bi-cart"></i> <sup> <?php echo $cart_num_rows; ?></sup></a>
                      <i class="bi bi-list" id="menu-btn" ></i>
</div>
            <div class="sub-menu-wrap" id="subMenu">
              <div class="sub-menu">
                <div class="user-info">
                  <img src="../Home/img/profile.png" style="height: 50px;width: 65px;border-radius: 150px;" alt="">
                  <p>Name : <span> <?php echo $_SESSION['user_name']; ?></span> </p>
                </div>  
             <hr>
             <a href="../UserProfile/index.php" class="sub-menu-link">
              <img src="../Home/img/profile.png" style="height: 50px;width: 65px;border-radius: 150px;" alt="">
              <p>User Profile</p>
              <span>></span>
             </a>
             <a href="http://localhost/MediCareHub/ChangePassword/index.php" class="sub-menu-link">
              <img src="../Home/img/setting.png" style="height: 50px;width: 65px;border-radius: 150px;" alt="">
              <p>Setting && Privacy</p>
              <span>></span>
             </a>
             <a href="#" class="sub-menu-link">
              <img src="../Home/img/help.png" style="height: 50px;width: 65px;border-radius: 150px; alt="">
              <p>Helps And Support</p>
              <span>></span>
             </a>
             
             <!-- <form action="index.php" method="post">
                    <button type="logout" name="logout" class="logout-btn" style="height: 30px; width: 120px; background: yellow; margin-right: 90px; border-radius: 80px; " >Logout</button>
                </form> -->
                <form action="index.php" method="post">
                    <button type="submit" name="logout" class="logout-btn" >Logout</button>
                </form>

              </div>
           
</div>
            
        </div>
    </header>
    <!-- <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tenetur consequa
               s.</p>

        </div>
    </div> -->
    <script src="../AdminPannel/script.js" ></script>

    <script>
  let subMenu =document.getElementById("subMenu");

  function toggleMenu(){
    subMenu.classList.toggle("open-menu");
  }
</script>
<script>
const header = document.querySelector('header');

function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0)
}
fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function () {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

userBtn.addEventListener('click', function () {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})

const closeBtn = document.querySelector('#close-form');

closeBtn.addEventListener('click', () => {
    document.querySelector('.update-container').style.display = 'none';
})
  </script>
  <script>
  const backToTopLink = document.querySelector('.back-to-top');
if (backToTopLink) {
  backToTopLink.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}
</script>
</body>
</html>