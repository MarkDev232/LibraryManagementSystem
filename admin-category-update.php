<?php
    include "connect.php";
    $id = $_GET['updateid'];
    $sql = "select * from category where Category_ID='$id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['Category_Name'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Fname = $_POST['txtname'];
        if(isset($_POST['txtsubmit'])){

            $sql1 = "UPDATE category set Category_ID='$id',Category_Name='$Fname' where Category_ID='$id'";
            mysqli_query($con, $sql1);
            echo "
            <script>
                alert('Updated Successfully!');
                location.href='admin-category.php';
            </script>";
            
        }
    }
    // if(!isset($_SESSION['auth_admin']['adminFullName'])) {
    //     // Kung wala, ireredirect sa login page
    //     echo "<script> alert('Please Login First');
    //     location.href='login.php';</script>";
    //     exit();
    // }
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
        <a id="back" href="admin-category.php">X</a><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <br>
            <h3>Update Category</h3><br>
            
            <label for="">Category Name</label><br>
            <input type="text" name="txtname" value="<?php echo $fname ?>"><br>
            <br><br>
            <input type="submit" name="txtsubmit" value="Submit">
        </form>
    </div>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Category</h2>
            </div>
            <table class='category-print' style="margin-left: 50px; margin-top:10px;" >
                <tr>
                    <td>
                        <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-category-add.php">Add Category</a></button>
                    </td>
                    <td>
                        <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-user-add.php">Print</a></button>
                    </td>
                </tr>
            </table>
            <div class="tables">
                <table border="1px" style="margin: 0 auto;">
                    <tr>
                        <th>Category_ID </th>
                        
                        <th>Category_Name</th>
                        <th>Action</th>
                        
                    </tr>
                    <?php
                            $sql = "Select * from category";
                            $result = mysqli_query($con, $sql);
                            if($result){
                                while($row = mysqli_fetch_assoc($result)){
                                    $id = $row['Category_ID'];
                                    $first = $row['Category_Name'];
                                    echo '<tr>
                                    <td>'.$id.'</td>
                                    <td>'.$first.'</td>
                                    <td><button id="btned"><a href="admin-category-update.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> Update</a></button>
                                        <button id="btndel"><a href="admin-category-delete.php?deleteid='.$id.'"><i class="fa fa-trash"></i> Delete</a></button>
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