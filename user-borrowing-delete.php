<?php
    include "connect.php";
    session_start();
    $sql1 = "Select * from book_info";
    $result1 = mysqli_query($con,$sql1);
    $rows = mysqli_fetch_assoc($result1);
    $img = $rows['book_Image'];
    $name = $rows['book_Name'];
    $cate = $rows['book_Category'];
    $aut = $rows['book_Author'];
    $price = $rows['book_Price'];
    $qty = $rows['book_Qty'];
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
    $userid = $_SESSION['auth_user']['ID'];


    if(!isset($_SESSION['auth_user']['FullName'])) {
        // Kung wala, ireredirect sa login page
        echo "<script> alert('Please Login First');
        location.href='login.php';</script>";
        exit();
    }
    if(isset($_POST['yesbtn'])){
        $ids =$_GET['deleteid'];
        $updateBorrow = "UPDATE user_info SET BorrowedBooksCount = BorrowedBooksCount - 1 WHERE User_ID =  $userid";
        mysqli_query($con, $updateBorrow );

        $sql = "delete from borrow where borrow_ID=$ids";
        $result = mysqli_query($con, $sql);
        echo"
        <script>
            alert('Deleted Successfully!');
            location.href='user-book.php';
        </script>
        ";
    }
    elseif(isset($_POST['nobtn'])){
        echo "<script>
        location.href='user-book.php';</script>";
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
    </header>
    <div style="position:absolute; border:1px solid black; margin-top: 200px; margin-left:550px; width:350px; background-color: white; height: 150px;">
            <form action="" method="POST" enctype="multipart/form-data">
                <br>
                <br>
                
                <label style="margin-left: 80px;" for="">Are sure you want to Delete?</label><br><br>
                <table style="margin-left: 70px;">
                    <tr>
                        <td>
                            <input style="width:100px; height:30px; background: blue;" type="submit" name="yesbtn" value="Yes">
                        </td>
                        <td>
                            <input style="width:100px; height:30px; background: red;" type="submit" name="nobtn" value="No">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    <div>
        <form action="users-borrow-multi.php" method="GET" enctype="multipart/form-data">
            <br>
        <button style="margin-left: 50px;" type="submit" name="delete"><i class="fa fa-trash"></i> Delete Selected</button><br><br>
            <table style="margin-left: 50px;" border="1px">
                <tr>
                    <th>CheckBox</th>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Book Qty</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                $sq = "SELECT * FROM borrow";
                $resul = mysqli_query($con, $sq);
                $subtotal = 0;
                // $id = $row['add_ID'];
                while ($row1 = mysqli_fetch_array($resul)) {
                    $id = $row1['borrow_ID'];
                    echo "
                        <tr>
                            <td> <input type='checkbox' name='ids[]' value='".$id."' id='checkbtn' ></td>
                            <td>{$row1['borrow_ID']}</td>
                            <td>{$row1['book_name']}</td>
                            <td>{$row1['book_Cat']}</td>
                            <td>{$row1['book_Aut']}</td>
                            <td>{$row1['quantity']}</td>
                            <td>{$row1['status_info']}</td>
                            <td>
                            <button id='btndel'><a href='user-borrowing-delete.php?deleteid={$row1['borrow_ID']}'><i class='fa fa-trash'></i> Remove</a></button>
                            </td>
                        </tr>
                    ";
                }
                ?>

            </table>
        </form>
        <br>

        <!-- <form action="" method="POST" enctype="multipart/form-data">
            <input type="submit" name="processbtn" value="Borrow Now">
        </form> -->
        <div style="margin-left: 50px;">
                    <?php
                         $query2 = "SELECT * from borrow;";
                         $query_run2 = mysqli_query($con, $query2);
                         
                        $roz = mysqli_fetch_assoc($query_run2);
                                     $id = $roz['borrow_id'];
                                     $one = $roz['user_id'];
                                     $two = $roz['book_name'];
                                     $three = $roz['book_Cat'];
                                     $four = $roz['book_Aut'];
                                     $five = $roz['quantity'];
                                     $six = $roz['borrow_date'];
                                     $date = $roz['approval_date'];
                                     $pena = $roz['penalty'];
                                     $return_date = $roz['return_date'];
                                     $status = $roz['status_b']; 
                         ?>   
                    <label for="">Status: <?php echo $status ?></label>  <br>
                    <label for="">Approval date: <?php echo $date ?></label> <br>
                    <label for="">Return Date: <?php echo $return_date ?></label> <br>
                    <label for="">Penalty: <span style="color:red;"><?php echo $pena ?></span></label>
        </div>
    </div>
    
    
</body>
</html>