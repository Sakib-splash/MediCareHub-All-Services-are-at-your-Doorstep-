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
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:http://localhost/MedicareHub/login/');

}

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
//-------------------search bar-----------------
if(isset($_POST['search-btn']))
{
  $searchKey =$_POST['search'];
  $sql ="SELECT * FROM `products` WHERE `name` LIKE '%$searchKey%' ";
}else{
$sql ="SELECT * FROM `products`";
$searchKey="";

}
$result =mysqli_query($con,$sql) or die('query failed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../AdminPannel/style.css">
    <script src="script.js"></script>
    <title>Shop</title>
</head>
<body>
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
                <div class="icons">
                      <i class="bi bi-person" id="user-btn"onclick="toggleMenu()"></i>
                      <?php 
                        $select_wishlist=mysqli_query($con,"SELECT * FROM `wishlist` WHERE user_id='$user_id'") or die('query fialed');
                        $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                      ?>
                      <a href="wishlist.php"><i class="bi bi-heart"></i> <sup> <?php echo $wishlist_num_rows; ?></sup> </a>
                      <?php 
                        $select_cart=mysqli_query($con,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query fialed');
                        $cart_num_rows = mysqli_num_rows($select_cart);
                      ?>
                      <a href="cart.php"> <i class="bi bi-cart"></i> <sup> <?php echo $cart_num_rows; ?></sup></a>
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
             
             <form action="index.php" method="post">
                    <button type="logout" name="logout" class="logout-btn" style="height: 30px; width: 120px; background: yellow; margin-right: 90px; border-radius: 80px; " >Logout</button>
                </form>
             

              </div>
           
            </div>
          

            </nav>
            

        </div> -->

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>Our Shop</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tenetur consequa
               s.</p>
        </div>
    </div>
    <form action="#" class="search-bar" method="POST" >
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Search for medicine"value="<?php echo $searchKey ?>" id="search-item">
                <input type="submit" name="search-btn" value="search">
            </form>
<div class="line"></div>

  <section class="shop">
  <h1 class="title">Shop best Seller</h1>
  

  </div>
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
  <div class="box-container">
    <?php
    //   $select_products= mysqli_query($con,"SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($result )>0){
        while($fetch_products = mysqli_fetch_assoc($result)){
        
      ?>
      <form method="post" class="box">
          <img src="../AdminPannel/img/<?php echo $fetch_products['image']; ?>">
          <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
          <div class="name"><?php echo $fetch_products['name']; ?></div>
          <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
          <input type="hidden" name="product_quantity" value="1" min="1">
          <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
          <div class="icon">
            <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" class="bi bi-eye-fill"></a>
            <button type="submit" name="add_to_wishlists"class="bi bi-heart" ></button>
            <button type="submit" name="add_to_cart"class="bi bi-cart" ></button>
          </div>
      </form>
 
      <?php 
        }
      }else{
          echo '<p class="empty">no products added yet</p>';
      }
      
      ?>
           
  </div>
  <div id="products" ></div>
  </section>
  <script type="text/javascript" src="../Home/script.js" ></script>
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>