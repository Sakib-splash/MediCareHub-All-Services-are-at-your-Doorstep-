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

//--------updating qty----
if (isset($_POST['update_qty_btn'])) {
  $update_qty_id = $_POST['update_qty_id'];
  $update_value = $_POST['update_qty'];
  $update_query = mysqli_query($con, "UPDATE 'cart' SET quantity = $update_value' WHERE id='update_qty_id") or die('quary failed');
  if ($update_query) {
    header('loction:http://localhost/MediCareHub/Home/cart.php');
  }

}

//-----delete product fronm wishlist
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
   
    mysqli_query($con,"DELETE FROM `cart` WHERE id='$delete_id'")or die('query failed');

    header('location:cart.php');//------admin_product.php hobe-----//

}

//-----delete all---
if(isset($_GET['delete_all'])){

   
    mysqli_query($con,"DELETE FROM `cart` WHERE user_id='$user_id'")or die('query failed');

    header('location:cart.php');//------admin_product.php hobe-----//

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
            <h1>My Cart</h1>
            <p>Here is your Selected Product for purchase.
              Press proceed to continue....
            </p>
        </div>
    </div>


  <section class="shop">
  <h1 class="title">Products added in Cart....</h1>
  

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
    $grand_total = 0;
      $select_cart= mysqli_query($con,"SELECT * FROM `cart`") or die('query failed');
      if(mysqli_num_rows($select_cart)>0){
        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
        
      ?>
      <div class="box">
      <div class="icon">
            <a href="view_page.php?pid=<?php echo $fetch_cart['id']; ?>" class="bi bi-eye-fill"></a>
            <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x"onclick="return confirm('do you want to delete this item from your cart')"></a>
            <button type="submit" name="add_to_cart"class="bi bi-cart" ></button>
          </div>
          <img src="../AdminPannel/img/<?php echo $fetch_cart['image']; ?>">
          <div class="price">$<?php echo $fetch_cart['price']; ?>/-</div>
          <div class="name"><?php echo $fetch_cart['name']; ?></div>
          <form method="post">
              <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>">
              <div class="qty"> 
                <input type="number" min="1" name="update_qty" value="<?php echo $fetch_cart['quantity']; ?>">
                <input type="submit" name="update_qty_bin" value="update">
        </div>

          </form>
          <div class="total-amt">
            Total Amount : <span><?php echo $total_amt = ($fetch_cart['price']*$fetch_cart['quantity']) ?></span>
        </div>
        </div>
      <?php 
      $grand_total += $total_amt;
        }
      }else{
          echo '<p class="empty">no products added yet</p>';
      }
      ?>
      
    </div>
    <div class="dlt">
    <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your wishlist')" >DELETE ALL</a>
  </div>
  <div class="wishlist_total">
      <p>total amount payable : <span>$<?php echo $grand_total; ?>/-</span></p>
      <a href="shop.php"class="btn" >Continue Shopping...</a>
      <a href="checkout.php" class="btn <?php echo ($grand_total>1)?'':'disabled'?>" onclick="return confirm('do you want to proceed to checkout')" >proceed to checkout</a>

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