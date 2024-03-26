<?php
    include "connect.php";
    session_start();
    // session_destroy();
    $sql = "Select * from edit_user";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['edit_ID'];
    $first = $row['edit_bg'];
    $two = $row['edit_font'];
    $three = $row['edit_logo'];
    $four = $row['edit_slide1'];
    $five = $row['edit_slide2'];
    $six = $row['edit_slide3'];

    if(!isset($_SESSION['auth_user']['FullName'])) {
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
    <link rel="stylesheet" href="user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background: <?php echo $first ?>; color:<?php echo $two ?>";>
    <header>
        <div>
            <img src="<?php echo $three ?>" alt="">
            <a href="user.php">Home</a>
            <a href="user-book.php">My Books</a>
            <a href="user-cart.php">My Cart</a>
            <a href="user-settings.php">Settings</a>
            <a href="logout.php">Logout</a>
        </div>
        <div>
            <a href="user-settings.php">User Profile</a>
            <a href="user-settings-password.php">Change Password</a>
        </div>
    </header>
    <div style="border: 1px solid black; width: 500px; height: 600px; margin: 30px auto; text-align:center;">
        <form action="usersetting-code.php" method="POST" enctype="multipart/form-data">
        <?php
                        $ids = $_SESSION['auth_user']['ID'];
                        $sql1 = "SELECT * FROM user_info WHERE User_ID='$ids'";
                        $result1 = mysqli_query($con, $sql1);
                    
                        if($result1){
                            while(
                                $rows = mysqli_fetch_assoc($result1)
                                ){
                                $id1 = $rows['User_ID'];
                                $first1 = $rows['User_FName'];
                                $two1 = $rows['User_Email'];
                                $three1 = $rows['User_Username'];
                                $four1 = $rows['User_Mobile'];
                                $five1 = $rows['User_Address'];
                                $six1 = $rows['User_Img'];
                                
                                echo '
                                <img style="margin-top: 20px;" src="'.$six1.'" alt="" width="150px" height="150px"><br>
                                <input type="file" name="file"> <br><br>
                                <input style="width:450px; height: 40px;" type="text" name="txtfname" placeholder="Full Name" value="'.$first1.'"><br><br>
                                <input style="width:450px; height: 40px;" type="text" name="txtemail" placeholder="Email Address" value="'.$two1.'"><br><br>
                                <input style="width:450px; height: 40px;" type="text" name="txtuser" placeholder="Username" value="'.$three1.'"><br><br>
                                <input style="width:450px; height: 40px;" type="text" name="txtmobile" placeholder="Mobile Number" value="'.$four1.'"><br><br>
                                <input style="width:450px; height: 40px;" type="text" name="txtadd" placeholder="Address" value="'.$five1.'"><br><br>
                                <input style="width:450px; height: 40px;" type="submit" id="detailsbtn" name="submit" value="Save Changes">
                                ';
                            }
                        }
                        
                    ?>
        </form>
    </div>

</body>
<script src="index.js"></script>
</html>