<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION['auth_admin']['adminFullName'])) {
        // Kung wala, ireredirect sa login page
        echo "<script> alert('Please Login First');
        location.href='login.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav>
            <div class="brand-container">
                <img src="image/IMG_20231009_205609-removebg-preview.png" alt="My Personal Logo" width="60px">
                <h2 class="brand-title">WEBDEV-LIBRARY</h2>
            </div>

            <div class="brand-title">
                <a class="link" href="admin.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="link" href="admin-user.php"><i class="fa fa-user"></i> Users</a>
                <a class="link" href="admin-category.php"><i class="fa fa-category"></i> Category</a>
                <a class="link" href="admin-book.php"><i class="fa fa-book"></i> Books</a>
                <a class="link" href="admin-sale.php"><i class="fa fa-repeat"></i> Sales</a>
                <a class="link" href="admin-reports.php"><i class="fa fa-receipt"></i> Reports</a>
                <a class="link" href="admin-setting.php"><i class="fa fa-gear"></i> Settings</a>
                <a class="link" href="logout.php"><i class="fa fa-user"></i> Logout</a>
            </div>

        </nav>
    </header>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Setting</h2>
            </div>
            <div>
                <a href="admin-setting.php">Admin Info</a>
                <a href="admin-setting-changepassword.php">Change Password</a>
            </div>
            <div class="container-info">
                <h3>Admin Info</h3>
                <form action="admin-setting-changepassword-code.php" method="POST" enctype="multipart/form-data">
                    <h3>Change Password</h3> <br>
                    <input type="password" id="detailslayout" name="txtold" placeholder="Old Password" > <br><br>
                    <input type="password" id="detailslayout" name="txtnew" placeholder="New Password" > <br><br>
                    <input type="password"  id="detailslayout"  name="txtnew2" placeholder="Confirm Password"> <br><br>
                    <input type="submit" id="detailsbtn" name="submit" value="Save Changes">
                </form>
            </div>
        </div>

        
        
    </section>
    
</body>
</html>