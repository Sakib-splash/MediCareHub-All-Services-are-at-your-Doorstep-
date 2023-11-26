<?php

if($_SESSION['admin_name']){
}
else{
    header('location:http://localhost/MedicareHub/Home/index.php');
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
    <title>Document</title>
</head>
<body>
    <header class="header" >
        <div class="flex" >
            <a href="admin_pannel.php" class="logo" ><img src="../AdminPannel/img/admin.png" ></a>
            <nav class="navbar" >
                <a href="index.php">Home</a>
                <a href="admin_product.php">Products</a>
                <a href="admin_order.php">Orders</a>
                <a href="admin_user.php">Users</a>
                <a href="admin_message.php">Messages</a>
            </nav>
            <div class="icons">
                <i class="bi bi-person" id="user-btn" ></i>
                <i class="bi bi-list" id="menu-btn" ></i>
            </div>
            <div class="user-box">
                <p>Username : <span> <?php echo $_SESSION['admin_name']; ?></span> </p>
                <p>Email : <span> <?php echo $_SESSION['admin_email']; ?></span> </p>
                <form action="index.php" method="post">
                    <button type="submit" name="logout" class="logout-btn" >Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="banner">
        <div class="detail">
            <h1>admin dashboard</h1>
            <p>Check Carefully. Complete the task,order and so on.</p>

        </div>
    </div>
<script src="script.js"></script>
</body>
</html>