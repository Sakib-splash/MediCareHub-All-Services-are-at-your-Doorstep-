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

//--------adding product in cart----
if(isset($_POST['add_to_cart'])){
  $product_id = $_POST['product_id'];
  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = 1;

 
  $cart_number = mysqli_query($con,"SELECT * FROM `cart` WHERE p_id = '$product_id'") or die('query failed');
  if(mysqli_num_rows($cart_number)>0){
    $message[]='Products already exist in cart';

  }else{
    mysqli_query($con,"INSERT INTO `cart`(`user_id`,`p_id`,`name`,`price`,`quantity`,`image`)VALUES ('$user_id','$product_id',' $product_name','$product_price','$product_quantity','$product_image')");

    $message[]='Products successfully added in your cart';
  }

}

//-----delete product fronm wishlist
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
   
    mysqli_query($con,"DELETE FROM `wishlist` WHERE id='$delete_id'")or die('query failed');

    header('location:wishlist.php');//------admin_product.php hobe-----//

}

//-----delete all---
if(isset($_GET['delete_all'])){

   
    mysqli_query($con,"DELETE FROM `wishlist` WHERE user_id='$user_id'")or die('query failed');

    header('location:wishlist.php');//------admin_product.php hobe-----//

}


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
    <title>Wishlist</title>
</head>
<body>

        <?php 
          include '../header.php'
          ?>
    
<div class="banner">
        <div class="detail">
            <h1>My Wishlist</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas tenetur consequa
               s.</p>
        </div>
    </div>

  <section class="shop">
  <h1 class="title">Products added in wishlist....</h1>
  

  
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
    $grand_total = 0;
      $select_wishlist= mysqli_query($con,"SELECT * FROM `wishlist`") or die('query failed');
      if(mysqli_num_rows($select_wishlist)>0){
        while($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)){
        
      ?>
      <form method="post" class="box">
          <img src="../AdminPannel/img/<?php echo $fetch_wishlist['image']; ?>">
          <div class="price">$<?php echo $fetch_wishlist['price']; ?>/-</div>
          <div class="name"><?php echo $fetch_wishlist['name']; ?></div>
          <input type="hidden" name="product_id" value="<?php echo $fetch_wishlist['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $fetch_wishlist['name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $fetch_wishlist['price']; ?>">
          <input type="hidden" name="product_image" value="<?php echo $fetch_wishlist['image']; ?>">
          <div class="icon">
            <a href="view_page.php?pid=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-eye-fill"></a>
            <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-x"onclick="return confirm('do you want to delete this item from your wishlist')"></a>
            <button type="submit" name="add_to_cart"class="bi bi-cart" ></button>
          </div>
      </form>
      
      <?php 
      $grand_total += $fetch_wishlist['price'];
        }
      }else{
          echo '<p class="empty">no products added yet</p>';
      }
      ?>
  </div>
  <div class="wishlist_total">
      <p>total amount payable : <span>$<?php echo $grand_total; ?>/-</span></p>
      <a href="shop.php"class="btn" >Continue Shopping...</a>
      <a href="wishlist.php?delete_all" class="btn <?php echo ($grand_total)?'':'disabled'?>" onclick="return confirm('do you want to delete all items in your wishlist')" >DELETE ALL</a>
  </div>
  </section>
  <footer class="full-footer">
          <div class="footer-body">
            <div class="row">
              <div class="col">
                <h4>About Us</h4>
                <p>We are always here to hear you.</p>
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
                <p>JAGANNATH UNIVERSITY<br>DHAKA,BANGLADESH<br>01518951189<br>sakibsplash.blogspot.com/</p>
              </div>
            </div>
          </div>
      </footer>
<script type="text/javascript" src="../AdminPannel/script.js" >

</script>
</body>
</html>