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
    <link rel="stylesheet" href="admin-user.css">
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

            <!-- <div class="profile-container" class="brand-title">
                <p>Hi,</p>
                <button class="brand-btn">Logout</button>
                <a class="link" href="login.html"><i class="fa fa-user"></i> Logout</a>
            </div> -->
        </nav>
    </header>

    <section>
    <div class="main-container">
            <div class="header-title">
                <h2>Users</h2>
            </div>
            <!-- <div class="add-pop">
                <a href="admin-user-add.php">Add Users</a>
            </div> -->
            <table style="margin-left: 100px; margin-top:10px;" class='category-print'>
                <tr>
                    <td>
                        <button class='btn1'><a style="text-decoration: none;" href="admin-user-add.php">Add Users</a></button>
                    </td>
                    <td>
                        <button class='btn2'><a style="text-decoration: none;" href="admin-user-print.php">Print</a></button>
                    </td>
                    <td>
                        <button class='btn3'><a style="text-decoration: none;" href="admin-user-edit.php">Edit User Page</a></button>
                    </td>
                </tr>
            </table>
           <form action="admin-user-editcode.php" method="POST" enctype="multipart/form-data">
            <div style="margin-left: 300px;margin-top: 30px; background: white; width:610px; padding: 20px;">
                    <?php
                    $sql = "Select * from edit_user";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        // echo $row['name'];
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row['edit_ID'];
                            $first = $row['edit_bg'];
                            $two = $row['edit_font'];
                            $three = $row['edit_logo'];
                            $four = $row['edit_slide1'];
                            $five = $row['edit_slide2'];
                            $six = $row['edit_slide3'];
                        
                        echo '<table>
                        <tr>
                            <td>
                                <label for="">Background Color: </label>
                            </td>
                            <td>
                                <input type="text" name="txtbg" placeholder="Background Color" value="'.$first.'">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Font Color: </label>
                            </td>
                            <td>
                                <input type="text" name="txtcolor" placeholder="Font Color" value="'.$two.'">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Logo Image: </label>
                            </td>
                            <td>
                            <img src="'.$three.'" alt="" width="50px" height="50px">
                            <input type="file"  id="detailslayout"  name="txtlogo"  >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Slide 1: </label>
                            </td>
                            <td>
                                <img src="'.$four.'" alt="" width="300px" height="50px"><br>
                                <input type="file"  id="detailslayout"  name="txtslide1" ><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Slide 2: </label>
                            </td>
                            <td>
                                <img src="'.$five.'" alt="" width="300px" height="50px"><br>
                                <input type="file"  id="detailslayout"  name="txtslide2" > <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Slide 3: </label>
                            </td>
                            <td>
                                <img src="'.$six.'" alt="" width="300px" height="50px"><br>
                                <input type="file"  id="detailslayout"  name="txtslide3" > <br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="">Password</label><br>
                                
                            </td>
                            <td>
                            <input type="password" name="txtpass"><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" id="detailsbtn" name="submit" value="Save Changes" style="background-color: #3ab563;color: white; padding: 10px; border: none">
                            </td>
                        </tr>
                    </table>';
                            }
                        }
                    ?>
                </div>
            </div>
           </form>

        
        
    </section>
    
</body>
</html>