<?php
    include 'connect.php';
    session_start();
    $id = $_GET['updateid'];
    $sql = "select * from user_info where User_ID='$id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['User_FName'];
    $emails = $row['User_Email'];
    $user = $row['User_Username'];
    $pass = $row['User_Password'];
    $mobi = $row['User_Mobile'];
    $addr = $row['User_Address'];
    $sta = $row['verify_status'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Fname = $_POST['txtname'];
        $Email = $_POST['txtemail'];
        $Uname = $_POST['txtuse'];
        $Apass = $_POST['txtpass'];
        $Addr = $_POST['txtadd'];
        $Mobile = $_POST['txtmob'];
        $Sta = $_POST['txtstatus'];
    
        // Check if a new file has been uploaded
        if(isset($_POST['txtsubmit'])){
            if ($_FILES['file']['error'] != 4) { // Error code 4 means no file was uploaded
                $img_loc = $_FILES['file']['tmp_name'];
                $img_name = $_FILES['file']['name'];
                $img_des = "userimg/".$img_name;
                move_uploaded_file($img_loc,'userimg/'.$img_name);
        
                // Update the image in the database
                $query = "UPDATE user_info SET User_Img='$img_des' WHERE User_ID='$id'";
                mysqli_query($con, $query);
            }
            else if($_POST['txtstatus'] > 0){
                $query1 = "UPDATE user_info SET verify_status='$Sta' ,login_attempts=0, blocked=0 WHERE User_ID='$id'";
                mysqli_query($con, $query1);
            }
        
            // Update other fields
            $query1 = "update user_info set User_ID='$id',User_FName='$Fname',User_Email='$Email',User_Username='$Uname',User_Mobile='$Mobile',User_Address='$Addr',User_Password='$Apass' where User_ID='$id'";
            mysqli_query($con, $query1);
        
            echo "
            <script>
                alert('Updated Successfully!');
                location.href='admin-user.php';
            </script>";
        }
    }

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
            <img src="image/mainlogo.png" alt="My Personal Logo" width="60px">
                <h2 class="brand-title">ADMIN-LIBRARY</h2>  
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

    <div class="pop">
        <br>
        <a id="back" href="admin-user.php">X</a><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <br>
            <h3>Update User</h3><br>
            <label for="">Image</label><br>
            <input type="file" name="file" ><br>
            <label for="">Full Name</label><br>
            <input type="text" name="txtname" value=<?php echo $fname ?>><br>
            <label for="">Email</label><br>
            <input type="text" name="txtemail" value=<?php echo $emails ?> ><br>
            <label for="">Username</label><br>
            <input type="text" name="txtuse" value=<?php echo $user ?> ><br>
            <label for="">Mobile</label><br>
            <input type="text" name="txtmob" value=<?php echo $mobi ?>><br>
            <label for="">Address</label><br>
            <input type="text" name="txtadd" value=<?php echo $addr ?>><br>
            <label for="">Password</label><br>
            <input type="password" name="txtpass" value=<?php echo $pass ?>><br>
            <label for="">Status</label><br>
            <select name="txtstatus" id="">
                <option value="<?php echo $sta?>"><?php echo $sta?></option>
                <option value="Verify">Verify</option>
                <option value="Not Verify">Not Verify</option>
                <option value="Block">Block</option>
            </select> <br><br><br>
            <input type="submit" name="txtsubmit" value="Submit">
        </form>
    </div>

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
            <div class="tables">
                <table border="1px" style="margin: 0 auto;">
                    <tr>
                        <th>User_ID </th>
                        <th>User_Img</th>
                        <th>User_FName</th>
                        <th>User_Email</th>
                        <th>User_Username	</th>
                        <th>User_Mobile</th>
                        <th>User_Address</th>
                        <th>User_Borrowed</th>
                        <th>User_Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                            $sql = "Select * from user_info";
                            $result = mysqli_query($con, $sql);
                            if($result){
                                // echo $row['name'];
                                while($row = mysqli_fetch_assoc($result)){
                                    $id = $row['User_ID'];
                                    $first = $row['User_Img'];
                                    $two = $row['User_FName'];
                                    $three = $row['User_Email'];
                                    $four = $row['User_Username'];
                                    $five = $row['User_Mobile'];
                                    $six = $row['User_Address'];
                                    // $seven= $row['User_Password'];
                                    $eigth= $row['verify_status'];
                                    $seven = $row['BorrowedBooksCount'];
                                    // $nine = $row[''];
                                    echo '<tr>
                                    <td>'.$id.'</td>
                                    <td><img src='.$first.' width="50" height="50"></td>
                                    <td>'.$two.'</td>
                                    <td>'.$three.'</td>
                                    <td>'.$four.'</td>
                                    <td>'.$five.'</td>
                                    <td>'.$six.'</td>
                                    <td>'.$seven.'</td>
                                    <td>'.$eigth.'</td>

                                    <td>
                                        <button id="btned"><a href="admin-user-view.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> View</a></button>
                                        <button id="btned"><a href="admin-user-update.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> Update</a></button>
                                        <button id="btndel"><a href="admin-user-delete.php?deleteid='.$id.'"><i class="fa fa-trash"></i> Delete</a></button>
                                    </td>
                                    </tr>
                                    ';
                                }
                            }
                        ?>
                </table>
            </div>
        </div>

        
        
    </section>
    
</body>
</html>