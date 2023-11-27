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
//start

session_start();

$admin_id=$_SESSION['admin_name'];

if(!isset($admin_id)){
    header('location:http://localhost/MedicareHub/login/');

}

if(isset($_POST['logout'])){
    session_destroy();
    header('location:http://localhost/MedicareHub/login/');

}
//--------adding product to database
  
    if(isset($_POST['add_product'])){
        $product_name=mysqli_real_escape_string($con,$_POST['name']);
        $product_price=mysqli_real_escape_string($con,$_POST['price']);
        $product_detail=mysqli_real_escape_string($con,$_POST['detail']);
        $image=$_FILES['image']['name'];
        $image_size=$_FILES['image']['size'];
        $image_tmp_name=$_FILES['image']['tmp_name'];
        $image_folder='img/'.$image;

        $select_product_name=mysqli_query($con,"SELECT name FROM `products` WHERE name='$product_name'") 
        or die('query failed');

        if(mysqli_num_rows($select_product_name)>0){
            $message[] = 'product name already exists';
        }
        else{
            $insert_product=mysqli_query($con,"INSERT INTO `products`(`name`,`price`,`product_detail`,`image`)
            VALUES('$product_name','$product_price','$product_detail','$image')") or die("query failed");

            if($insert_product){
                if($image_size > 2000000){
                    $message[]= 'image size is too large. ';
                }else{
                    move_uploaded_file( $image_tmp_name,$image_folder);
                    $message[] = 'product added successfully.';
                }
            }
        }


    }

    //------Delete Products from database--------
    if(isset($_GET['delete'])){
        $delete_id=$_GET['delete'];
        $select_delete_image = mysqli_query($con,"SELECT image FROM `products` WHERE id='$delete_id'") or die('query failed');
        $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
        unlink('img/'.$fetch_delete_image['image']);

        mysqli_query($con,"DELETE FROM `products` WHERE id='$delete_id'")or die('query failed');
        mysqli_query($con,"DELETE FROM `cart` WHERE p_id='$delete_id'")or die('query failed');
        mysqli_query($con,"DELETE FROM `message` WHERE p_id='$delete_id'")or die('query failed');

        header('location:admin_product.php');//------admin_product.php hobe-----//

    }

    //----update product---
    if(isset($_POST['update_product'])){
        $update_id=$_POST['update_id'];
        $update_name=$_POST['update_name'];
        $update_price=$_POST['update_price'];
        $update_detail=$_POST['update_detail'];
        $update_image=$_FILES['update_image']['name'];
        $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
        $update_image_folder = 'img/'.$update_image;

        $update_query=mysqli_query($con,"UPDATE `products` SET `id`=' $update_id',`name`='$update_name',
        `price`='$update_price',`product_detail`='$update_detail',`image`='$update_image' WHERE id='$update_id'") or die('query failed');
        if($update_query){
            move_uploaded_file($update_image_tmp_name,$update_image_folder);
            header('location:index.php');//------admin_product.php hobe-----//

        }

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">

    <title>Admin Pannel</title>
</head>
<body>
    <?php
    include 'admin_header.php' 
    ?>
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
   <div class="line2">

   </div>
        <section class="add-products form-container" >
            <form method="POST" action="" enctype="multipart/form-data" >
                <div class="input-field">
                    <label for="">Product name</label>
                    <input type="text" name="name" required>
                </div>
                <div class="input-field">
                    <label for="">Product price</label>
                    <input type="text" name="price" required>
                </div>
                <div class="input-field">
                    <label for="">Product detail</label>
                    <textarea name="detail" id="" cols="30" rows="10"required></textarea>
                </div>
                <div class="input-field">
                    <label for="">Product image</label>
                    <input type="file" name="image" accept="image/jpg, image/jpeg, image/webp" required>

                </div>

                <input type="submit" name="add_product" value="add product" class="btn" >
            </form>
        </section>
        

        </div>
        
        <section class="show-products">
            <div class="box-container">
                <?php
                    $select_products=mysqli_query($con,"SELECT * FROM `products`") or die('query failed');
                    if(mysqli_num_rows($select_products)>0){
                        while($fetch_products=mysqli_fetch_assoc($select_products)){
                        
                    
                ?>
                <div class="box">
                            <img src="img/<?php echo $fetch_products['image']; ?>" alt="">
                            <p>price: <?php echo $fetch_products['price']; ?></p>
                            <h4><?php echo $fetch_products['name']; ?></h4>
                            <details><?php echo $fetch_products['product_detail']; ?></details>
                            <a href="admin_product.php?edit=<?php echo $fetch_products['id']; ?>" class="edit">edit</a> <!---admin_product.php hobe--->
                            <a href="admin_product.php?delete=<?php echo $fetch_products['id']; ?>" class="delete" onclick="
                            return confirm('want to delete this product');">delete</a>
                </div>

                <?php
                        }
                     } else{
                            echo '
                            <div class="empty">
                            <p>no products added yet</p>
                        </div>
                            ';
                        }
                    

                    ?>
                   
            </div>
        </section>
        <div class="line"></div>
        <!-- update products -->
        <section class="update-container">
                <?php
                    if(isset($_GET['edit'])){
                        $edit_id=$_GET['edit'];
                        $edit_query = mysqli_query($con,"SELECT * FROM `products` WHERE id='$edit_id'") or die('query failed');
                        if(mysqli_num_rows($edit_query)>0){
                            while($fetch_edit=mysqli_fetch_assoc($edit_query)){

                            
                    

                ?>
                <form method="post" enctype="multipart/form-data">
                    <img src="img/<?php echo $fetch_edit['image']; ?>">
                    <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id']; ?>" >
                    <input type="text" name="update_name" value="<?php echo $fetch_edit['name']; ?>" >
                    <input type="number" name="update_price" min="0" value="<?php echo $fetch_edit['price']; ?>" >
                    <textarea name="update_detail" ><?php echo $fetch_edit['product_detail']; ?></textarea>
                    <input type="file" name="update_image" accept="image/jpg,image/jpeg,image/png,image/webp" >
                    <input type="submit" name="update_product" value="update" class="edit" >
                    <input type="reset" name="" value="cancel" class="option-btn btn" id="close-form" >
                </form>
                <?php
                            }
                        }
                        echo "<script> document.querySelector('.update-container').style.display='block';</script>";//---kaj korsena
                    }
                ?>
        </section>
    <script src="./script.js"></script>


</body>
</html>
