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


<!-- -----shop section -->
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
  <section class="popular-brands">
  <h2>Popular brands</h2>
  <div class="controls">
    <i class="bi bi-chevron-left left"></i>
    <i class="bi bi-chevron-right right"></i>

  </div>
  <div class="popular-brands-content">
    <?php
      $select_products= mysqli_query($con,"SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_products)>0){
        while($fetch_products = mysqli_fetch_assoc($select_products)){
        
      ?>
      <form method="post" class="card">
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
  </section>

  <!-----------------NAV LINK----------->
  <ul>
                <a href="http://localhost/MedicareHub/Home/"> Home</a>
                <a href="Services.html">Services</a>
                <a href="Blog.html">Blog</a></li>
                <a href="http://localhost/MediCareHub/Home/shop.php">About Us</a>
                <a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a>
                <a href="http://localhost/MedicareHub/login/">Log In</a>
                    
 </ul>