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


if(isset($_POST['logout'])){
  session_destroy();
  session_abort();
   unset($_SESSION['user_name']);
    header('location:http://localhost/MedicareHub/login/');

}
//-------adding product in wishlist--
if(isset($_POST['add_to_wishlists'])){
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];

  $wishlist_number = mysqli_query($con,"SELECT * FROM wishlist WHERE p_id='$product_id'");
  $cart_number = mysqli_query($con,"SELECT * FROM `cart` WHERE p_id = '$product_id'") or die('query failed');
  if(mysqli_num_rows($wishlist_number)>0){
    $message[]='Products already exist in wishlist';
  }else if(mysqli_num_rows($cart_number)>0){
    $message[]='Products already exist in cart';

  }else{
    mysqli_query($con,"INSERT INTO `wishlist`(`user_id`,`p_id`,`name`,`price`,`image`)VALUES ('$user_id','$product_id',' $product_name','$product_price','$product_image')");
    $message[]='Products successfully added in your wishlist';
  }

}

//--------adding product in cart----
if(isset($_POST['add_to_cart'])){
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = $_POST['product_quantity'];

 
  $cart_number = mysqli_query($con,"SELECT * FROM `cart` WHERE p_id = '$product_id'") or die('query failed');
  if(mysqli_num_rows($cart_number)>0){
    $message[]='Products already exist in cart';

  }else{
    mysqli_query($con,"INSERT INTO `cart`(`user_id`,`p_id`,`name`,`price`,`quantity`,`image`)VALUES ('$user_id','$product_id',' $product_name','$product_price','$product_quantity','$product_image')");
    $message[]='Products successfully added in your cart';
  }

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
    <link rel="stylesheet" href="style.css?v=?php echo time(); ?>">
    <title>Medical</title>
</head>
<body>



    <header class="header" >
        <div class="flex" >
            <a href="admin_pannel.php" class="logo" ><img src="../Home/Logo.png" ></a>
            <nav class="navbar" >
            <a href="http://localhost/MedicareHub/Home/"> Home</a>
                <a href="http://localhost/MediCareHub/Services/index.php">Services</a>
                <a href="http://localhost/MediCareHub/Home/order.php">Order</a>
                <a href="http://localhost/MediCareHub/Home/shop.php">SHOP</a>

                <a href="http://localhost/MediCareHub/Blog/Blog.html">Blog</a></li>
                <a href="http://localhost/MediCareHub/Home/shop.php">About Us</a>
                <a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a>
                <a href="http://localhost/MedicareHub/login/">Log In</a>
            </nav>
           
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
             <a href="#" class="sub-menu-link">
              <img src="../Home/img/setting.png" style="height: 50px;width: 65px;border-radius: 150px;" alt="">
              <p>Setting && Privacy</p>
              <span>></span>
             </a>
             <a href="#" class="sub-menu-link">
              <img src="../Home/img/help.png" style="height: 50px;width: 65px;border-radius: 150px; alt="">
              <p>Helps And Support</p>
              <span>></span>
             </a>
             
           

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










<div class="container" style="background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7),rgba(0,0,0,0.7),rgba(0,0,0,0.7));" >
         <!-- <div class="navbar">
            <img src="./Logo.png" class="logo">
            <nav>
                <ul>
                    <li><a href="http://localhost/MedicareHub/Home/"> Home</a></li>
                    <li><a href="Services.html">Services</a></li>
                    <li><a href="Blog.html">Blog</a></li>
                    <li><a href="http://localhost/MediCareHub/Home/shop.php">About Us</a></li>
                    <li><a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a></li>
                    <li><a href="http://localhost/MedicareHub/login/">Log In</a></li>
                    
                </ul>
                

                
          

            </nav> 
            

        </div> -->
  
        
        <div class="row">
            <div class="col">
                <p class="p1">Helping Your</p><br>
                <p class="p2">Stay Happy One</p><br>
                <p class="p3">Everyday we bring hope and smile to the patient we serve</p>
                <br>
                <br>
                <br>
                <a class="Reg" href="http://localhost/MedicareHub/Register/insert.php">Register</a>
                <a class="Log" href="http://localhost/MedicareHub/login/">Log In</a>
            </div>

            <div class="col">
                <div class="C1">
                    <div class="card0 card1">
                    <h5>Doctors</h5>
                    <p>You will find a list of doctors here.</p>
                    </div>

                    <div class="card0 card2">
                    <h5>Medicines</h5>
                    <p>You will find your required medicines here.</p>
                    </div>


                </div>
                <div class="C2">
                    <div class="card0 card3">
                    <h5>Ambulance</h5>
                    <p>You can call ambulance from here.</p>
                    </div>

                    <div class="card0 card4">
                    <h5>Self Checkup</h5>
                    <p>You are your doctor.</p>
                    </div>
                </div>
            </div>
      </div>
      </div>



    
    
    
    <footer class="full-footer">
          <div class="footer-body">
            <div class="row">
              <div class="col">
                <h4>About Us</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              </div>
              <div class="col">
                <h4>Categories</h4>
                <ul>
                <li><a href="http://localhost/MedicareHub/Home/"> Home</a></li>
                    <li><a href="Services.html">Services</a></li>
                    <li><a href="Blog.html">Blog</a></li>
                    <li><a href="http://localhost/MediCareHub/about/About.html">About Us</a></li>
                    <li><a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a></li>
                    <li><a href="http://localhost/MedicareHub/login/">SignUp</a></li>
                </ul>
              </div>
              <div class="col">
                <h4>Contact Us</h4>
                <p>123 Main Street<br>Anytown, USA<br>123-456-7890<br>info@example.com</p>
              </div>
            </div>
          </div>
      </footer>
    






  <script>
    $('.popular-brands-content').slick({
      lazyLoad: 'ondemand'
  slidesToShow: 4,
  slidesToScroll: 1,
  nextArrow: $('.left'),
  prevArrow: $('.right'),
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
  </script>
   
     <!-- <footer  class="ftr">
        
         <div class="ftr">
                    
                    <p>Email: <a href="#">mdsakibulislam736@gmail.com</a><br>
           Phone: <a href="#">01823129247</a></p>
                    </div>
               
        <div class="ftr">
           
         </div>
      </footer>    -->
</body>
</html>

