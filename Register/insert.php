
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <header>
    <div class="navbar">
        <img src="../Home/Logo.png" class="logo">
        <nav>
            <ul>
                <li><a href="http://localhost/MedicareHub/Home/"> Home</a></li>
                <li><a href="http://localhost/MediCareHub/Services/index.php">Services</a></li>
                <li><a href="http://localhost/MediCareHub/Blog/Blog.html">Blog</a></li>
                <li><a href="http://localhost/MediCareHub/about/About.html">About Us</a></li>
                <li><a href="http://localhost/MedicareHub/contact/Contact.html">Contact Us</a></li>
                <li><a href="http://localhost/MedicareHub/login/">SignIn</a></li>
            </ul>
        </nav>
     </div>
   </header>
    <section>
        <div class="form-box">  
            <div>
                <form action="send.php" method="post" autocomplete="off" >
                    <h2>Registration Form</h2>
                    <div class="input-box">
                        <input type="text" class="input" name="firstName">
                        <label for="">First Name</label>
                        
                    </div>
                    <div class="input-box">
                        <input type="text" class="input" name="lastName">
                        <label for="">Last Name</label>
                       
                    </div>
                    <div class="input-box">
                        <input type="date" class="input" name="dateOfBirth">
                        <label for="">Date of Birth</label>
                        
                    </div>
                    <!-- <div class="input-box">
                        <input type="text" class="input">
                        <label for="">NID Number</label>
                       
                    </div> -->
                    <div class="input-box">
                        <input type="email" class="input" name="email">
                        <label for="">Email Address</label>
                        
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" class="input">
                        <label for="">Password</label>
                       
                    </div>
                    <div class="input-box">
                        <input type="password" name="confirmPassword" class="input">
                        <label for="">Confirm Password</label>
                        
                    </div>
                    <div >
                        <label for="">Gender</label>
                       <div>
                            <label for="Male"><input type="radio" name="gender" value="m">Male </label>
                            <label for="Female"><input type="radio" name="gender" value="f">Female </label>
                            <label for="Other"><input type="radio" name="gender" value="o">Other </label>
                            <!-- <select name="" id="" required>
                                <option value="">Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select> -->
                        </div> 
                    </div>
                    <div class="input-box">
                        <input type="text" name="phoneNumber" class="input">
                        <label for="">Phone Number</label>
                        
                    </div>
                    <div class="input-box">
                        <label for=""></label>
                        <textarea class="address-box" name="address" placeholder="Enter Your Address Here"></textarea>
                    </div>
                    <div class="input-box">
                        <input type="text" name="postalCode" class="input">
                        <label for="">Postal Code</label>
                        
                    </div>
                    <div class="agreed">
                        <label for="">
                            <input type="checkbox" name="" id="">
                            Agreed to terms and conditions
                        </label>
                    </div>
                    <div>
                    <button type="submit" name="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>