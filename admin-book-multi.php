<?php
    include "connect.php";
    session_start();
    $id = implode(",",$_GET['ids']);

    $sql1 = "SELECT * FROM admin_info";
    $confirmpass = mysqli_query($con, $sql1);
    $confirmpass_run = mysqli_fetch_assoc($confirmpass);
    $plainTextPassFromDB = $confirmpass_run['Admin_Password'];

    if (isset($_POST['btnpass'])) {
        $enteredPass = $_POST['txtpass'];

        if ($enteredPass == $plainTextPassFromDB) {
            $delete = "DELETE FROM book_info WHERE book_ID in($id)";
            mysqli_query($con, $delete);
            echo "
                <script>
                    alert('Deleted Successfully!');
                    window.location.href='admin-book.php';
                </script>
                ";
        } else {
            echo "
                <script>
                    alert('Invalid Password');
                    window.location.href='admin-book.php';
                </script>
            ";
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
    <title>BookByte</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin-books.css">
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
        </nav>
    </header>
    <div style="position: absolute; width: 450px; height: 200px; background:white; margin-left: 600px; margin-top: 200px; border:1px solid black;">
            <form action="" method="POST" enctype="multipart/form-data">
            <br>
                <label style="margin-left: 20px;" for="">Confirm Password</label><br><br>
                <input type="password" name="txtpass"><br><br>
                <input type="submit" name="btnpass" value="Submit">
            </form>
    </div>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Book</h2>
            </div>
            <table style="margin-left: 100px; margin-top:10px;" class='category-print'>
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