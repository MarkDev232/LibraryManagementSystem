<?php
    include "connect.php";
    session_start();
    $id = $_GET['updateid'];
    $sql = "Select * from book_info where book_ID=$id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    $img = $row['book_Image'];
    $name = $row['book_Name'];
    $cate = $row['book_Category'];
    $aut = $row['book_Author'];
    $price = $row['book_Price'];
    $qty = $row['book_Qty'];

    $sql1 = "Select * from admin_info";
    $confirmpass = mysqli_query($con, $sql1);
    $confirmpass_run = mysqli_fetch_assoc($confirmpass);
    $pass = $confirmpass_run['Admin_Password'];


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $names = $_POST['txtname'];
        $cates = $_POST['txtstatus'];
        $auts = $_POST['txtaut'];
        $prices = $_POST['txtprice'];
        $qtys = $_POST['txtqty'];
    
        if($_POST['txtpass'] == $pass){
            // Check if a new file has been uploaded
            if ($_FILES['file']['error'] != 4) { // Error code 4 means no file was uploaded
                $img_loc = $_FILES['file']['tmp_name'];
                $img_name = $_FILES['file']['name'];
                $img_des = "image/".$img_name;
                move_uploaded_file($img_loc,'image/'.$img_name);
        
                // Update the image in the database
                $query = "UPDATE book_info SET book_Image='$img_des' WHERE book_ID='$id'";
                mysqli_query($con, $query);
            }
            else if($_POST['txtstatus'] > 0){
                $query1 = "UPDATE book_info SET book_Category='$cates' WHERE book_ID='$id'";
                mysqli_query($con, $query1);
            }


        
            // Update other fields
            $query1 = "UPDATE book_info SET book_Name='$names', book_Author='$auts', book_Price='$prices', book_Qty='$qtys' WHERE book_ID='$id'";
            mysqli_query($con, $query1);
            // echo"
            //     <script>
            //         alert('Updated Successfully!');
            //         location.href='admin-book.php';
            //     </script>
            //     ";
            echo(  mysqli_query($con, $query1));
            }
        else{
            echo"
                <script>
                    alert('Invalid Password');
                    location.href='admin-book.php';
                </script>
                ";
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
    <title>BookByte</title>
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
    <div class="pop">
        <br>
        <a id="back" href="admin-book.php">X</a><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <br>
            <h3>Update Book</h3><br>
            <label for="">Image</label><br>
            <input type="file" name="file" ><br>
            <label for="">Book Name</label><br>
            <input type="text" name="txtname" value="<?php echo $name ?>" ><br>
            <label for="">Author</label><br>
            <input type="text" name="txtaut" value="<?php echo $aut ?>"><br>         
            <label for="">Category</label><br>
            <select name="txtstatus" id="">
                <option value="<?php echo $cate ?>"><?php echo $cate ?></option>
                <?php
                        $sql = "SELECT Category_ID, Category_Name FROM category";
                        $result = mysqli_query($con, $sql);
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['Category_Name']}'>{$row['Category_Name']}</option>";
                        }
                        ?>
            </select> <br>
            <label for="">Price</label><br>
            <input type="number" name="txtprice" value="<?php echo $price ?>"><br>
            <label for="">Qty</label><br>
            <input type="number" name="txtqty" value="<?php echo $qty ?>"><br>
            <br>
            <label for="">Password </label>
            <input type="password" name="txtpass">
            <br><br>
            <input type="submit" name="txtsubmit" value="Submit">
        </form>
    </div>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Book</h2>
            </div>
            <table style="margin-left: 50px; margin-top:10px;">
                <tr>
                    <td>
                            <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-book-add.php">Add Book</a></button>
                    </td>
                    <td>
                            <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-book-print.php">Print</a></button>
                    </td>
                    <form action="admin-books-fastslow.php" method="POST" enctype="multipart/form-data">
                    <td>
                            
                        <select style="width: 150px; height: 30px;" name="txtfilter" id="">
                            <option value="">--Fast/Slow moving--</option>
                            <option value="DESC">--Fast moving--</option>
                            <option value="ASC">--Slow moving--</option>
                        </select>
                                
                    </td>
                    <td>
                        <input style="width: 100px; height:30px;" type="submit" value="Filter">
                    </td>
                    </form>
                    <td>
                        <form action="admin-books-search.php" method="POST" enctype="multipart/form-data">
                            <label for="">Search </label>
                            <input style="width:200px;" type="text" name="txtsearch">
                            <input style="width:80px;" type="submit" name="searchnbtn">
                        </form>
                    </td>
                    
                    <form action="admin-book-multi.php" method="GET" enctype="multipart/form-data">
                    <td>
                        <button style="height:30px;" type="submit" name="delete" >Delete List</button>
                    </td>
                    
                </tr>
            </table>
            <div class="tables">
                    <table border="1px" style="margin: 0 auto;">
                        <tr>
                            <th>List</th>
                            <th>Book_ID </th>
                            <th>Book_Img</th>
                            <th>Book_Name</th>
                            <th>Book_Author</th>
                            <th>Book_Category</th>
                            <th>Book_Price</th>
                            <th>Book_Qty</th>
                            <th>Book_Sold</th>
                            <th>Book_Borrow</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        include "connect.php";
                        $rows = mysqli_query($con, "SELECT * FROM book_info");
                        $i = 1;
                        // foreach($rows as $ro)
                        
                        $sql = "Select * from book_info";
                        $result = mysqli_query($con, $sql);
                        if($result){
                            // echo $row['name'];
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['book_ID'];
                                $img = $row['book_Image'];
                                $name = $row['book_Name'];
                                $cate = $row['book_Category'];
                                $aut = $row['book_Author'];
                                $price = $row['book_Price'];
                                $qty = $row['book_Qty'];
                                $sold = $row['SoldCount'];
                                $borrow = $row['BorrowCount'];
                                
                                echo '<tr>
                                <td><input style="width: 20px;" type="checkbox" name="ids[]" value="'.$id.'" ></td>
                                <td>'.$id.'</td>
                                <td><img src='.$img.' width="50" height="50"></td>
                                <td>'.$name.'</td>
                                <td>'.$aut.'</td>
                                <td>'.$cate.'</td>
                                <td>'.$price.'</td>
                                <td>'.$qty.'</td>
                                <td>'.$sold.'</td>
                                <td>'.$borrow.'</td>
                                <td>
                                <button id="btned"><a href="admin-book-update.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> Update</a></button>
                                    <button id="btndel"><a href="admin-book-delete.php?deleteid='.$id.'" ><i class="fa fa-trash"></i> Delete</a></button>
                                </td>
                                </tr>
                                ';
                            }
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>

        
        
    </section>
    
</body>
</html>