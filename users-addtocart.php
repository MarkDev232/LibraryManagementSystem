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
    $CATE = $_GET['category'];


    $id = $_GET['updateid'];
    $sql1 = "Select * from book_info where book_ID='$id'";
    $result1 = mysqli_query($con,$sql1);
    $rows = mysqli_fetch_assoc($result1);
    $img = $rows['book_Image'];
    $name = $rows['book_Name'];
    $cate = $rows['book_Category'];
    $aut = $rows['book_Author'];
    $price = $rows['book_Price'];
    $qty = $rows['book_Qty'];

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
    </header>
    <div>
    
    <div style="width: 650px;
    height: 400px;
    background: white;
    border-radius: 10px;
    border: 1px solid black;
    position: absolute;
    margin-left: 420px;
    margin-top: 150px;">
        <a style="position:absolute; margin-left: 620px; margin-top: 10px;" href="user-books.php?categoryid=<?php echo$CATE ?>">X</a>
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td >
                        <img src="<?php echo $img  ?>" alt="" style="margin-left: 120px; margin-top: 40px; width: 200px;height:300px;">
                    </td>
                    <td>
                        <div style="margin-left: 20px;">
                        <h2>Add to cart</h2>
                        <p>Category Book: <?php echo $cate ?></p>  
                        <p>Book Name: <?php echo $name ?></p>
                        <p>Book Author: <?php echo  $aut ?></p>
                        <p>Book Price: <?php echo $price?></p>
                        <input id="btnnum" type="number" value="1"  name="txtnum"><br> <br>
                        <input  style="width:100px; height:30px; background: blue;" type="submit" name="txtsubmit" value="Place Order" formaction="users-addtocart-code.php?updateid=<?php echo $id; ?>">
                        </div>

                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div style="text-align: center;"><h2>Books</h2></div>
    
    <div style="display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-evenly; margin-left:20px;">
                <?php

                $sqlBooks = "SELECT * FROM book_info WHERE book_Category='$CATE'";
                $resultBooks = mysqli_query($con, $sqlBooks);

                if (mysqli_num_rows($resultBooks) > 0) {
                    while ($book = mysqli_fetch_assoc($resultBooks)) {
                        $bookID = $book['book_ID'];
                        $bookName = $book['book_Name'];
                        $bookCategory = $book['book_Category'];
                        $bookPrice = $book['book_Price'];
                        $bookImage = $book['book_Image'];

                        echo '
                        <div style=" border: 1px solid black;
                        border-radius: 15px;
                        width: 350px;
                        height: 430px;
                        background: #FFFFFF;
                        // align-items: center;
                        // text-align: center;
                        display: flex;
                        padding-right: 60px;
                        margin: 20px;">
                            <form action="" method="POST" style="
                            width: 400px;
                            margin-left: 120px;
                            margin-top:10px">
                                <img src="' . $bookImage . '" alt="" width="150px" height="250px">
                                <p>' . $bookName . '</p>
                                <p>' . $bookCategory . '</p>
                                <p style="color:#286f6c">' . $bookPrice . '</p>
                                <table style="margin-left: -20px;">
                                    <tr>
                                        <td><button style="width:100px; height:30px; background: blue;" name="addToCart" "><a href="users-addtocart.php?category='.$CATE.'&updateid='.$bookID.'" style="text-decoration: none; color: white;"><i class="fa-solid fa-cart-shopping"></i> Add to cart</a></button></td>
                                        <td>
                                        <button style="width:100px; height:30px; background: blue;" name="addToBorrow" "><a href="users-borrow.php?categoryid='.$CATE.'&updateid='.$bookID.'" style="text-decoration: none; color: white;"><i class="fa-solid fa-book"></i> Borrow</a></button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>';
                    }
                }
            

        // Close the database connection
        mysqli_close($con);

        ?>
    </div>
    
</body>
<script src="index.js"></script>
</html>