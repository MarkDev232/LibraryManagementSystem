<?php
    include "connect.php";
    session_start();
    $sql1 = "Select * from admin_info";
    $confirmpass = mysqli_query($con, $sql1);
    $confirmpass_run = mysqli_fetch_assoc($confirmpass);
    $pass = $confirmpass_run['Admin_Password'];

    if(isset($_POST['txtsubmit'])){
        

        
        if($_POST['txtpass'] == $pass){
                $img_loc = $_FILES['file']['tmp_name'];
                $img_name = $_FILES['file']['name'];
                $img_des = "uploads/".$img_name;
                move_uploaded_file($img_loc,'uploads/'.$img_name);
    
                $sql = "INSERT into book_info(book_Image,book_Name,book_Category,book_Author,book_Price,book_Qty) values('$img_des','$_POST[txtname]','$_POST[txtstatus]','$_POST[txtaut]','$_POST[txtprice]','$_POST[txtqty]')";
    
    
                mysqli_query($con, $sql);
                echo"
                <script>
                    alert('Added Successfully!');
                    location.href='admin-book.php';
                </script>
                ";
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

?>

<!-- <!DOCTYPE html>
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
                <a class="link" href="borrow.php"><i class="fa fa-repeat"></i> Sales</a>
                <a class="link" href="reports.php"><i class="fa fa-receipt"></i> Reports</a>
                <a class="link" href="admin-setting.php"><i class="fa fa-gear"></i> Settings</a>
                <a class="link" href="login.php"><i class="fa fa-user"></i> Logout</a>
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
            <table style="margin-left: 50px; margin-top:10px;">
                <tr>
                    <td>
                            <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-book-add.php">Add Book</a></button>
                    </td>
                    <td>
                            <button style="height:30px;"><a style="text-decoration: none; color:black;" href="admin-book-add.php">Print</a></button>
                    </td>
                    <form action="" method="POST" enctype="multipart/form-data">
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
                            <th>Action</th>
                        </tr>
                        <?php
                        // include "connect.php";
                        // $rows = mysqli_query($con, "SELECT * FROM book_info");
                        // $i = 1;
                        // // foreach($rows as $ro)
                        
                        // $sql = "Select * from book_info";
                        // $result = mysqli_query($con, $sql);
                        // if($result){
                        //     // echo $row['name'];
                        //     while($row = mysqli_fetch_assoc($result)){
                        //         $id = $row['book_ID'];
                        //         $img = $row['book_Image'];
                        //         $name = $row['book_Name'];
                        //         $cate = $row['book_Category'];
                        //         $aut = $row['book_Author'];
                        //         $price = $row['book_Price'];
                        //         $qty = $row['book_Qty'];
                                
                        //         echo '<tr>
                        //         <td><input type="checkbox" name="ids[]" value="'.$id.'" ></td>
                        //         <td>'.$id.'</td>
                        //         <td><img src='.$img.' width="50" height="50"></td>
                        //         <td>'.$name.'</td>
                        //         <td>'.$aut.'</td>
                        //         <td>'.$cate.'</td>
                        //         <td>'.$price.'</td>
                        //         <td>'.$qty.'</td>
                        //         <td>
                        //         <button id="btned"><a href="admin-book-update.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> Update</a></button>
                        //             <button id="btndel"><a href="admin-book-delete.php?deleteid='.$id.'" ><i class="fa fa-trash"></i> Delete</a></button>
                        //         </td>
                        //         </tr>
                        //         ';
                        //     }
                        // }
                        ?>
                    </table>
                </form>
            </div>
        </div>

        
        
    </section>
    
</body>
</html> -->