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
        <div class="nav">
            <img src="<?php echo $three ?>" alt="" style="width: 100px; height: 100px;">
            <a href="user.php" style="font-size: 40px; text-decoration:none; ">Home</a>
            <a href="user-book.php " style="font-size: 40px; text-decoration:none;">My Books</a>
            <a href="user-cart.php" style="font-size: 40px; text-decoration:none;">My Cart</a>
            <a href="user-settings.php" style="font-size: 40px; text-decoration:none;">Settings</a>
            <a href="logout.php" style="font-size: 40px; text-decoration:none;">Logout</a>
        </div>
    </header>
    <div>
    <div class="mySlides fade">
          <div class="numbertext">1 / 3</div>
          <img src="<?php echo $four ?>" style="width:100%; height: 750px;">
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">2 / 3</div>
          <img src="<?php echo $five ?>" style="width:100%; height: 750px;">
          
        </div>
        
        <div class="mySlides fade">
          <div class="numbertext">3 / 3</div>
          <img src="<?php echo $six ?>" style="width:100%; height: 750px;">
          
          </div>
        </div>
        <div class="text-align" style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
          </div>
        
    </section>
    </div>
    <div style="display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-evenly;
        ">
        <?php $sqlCategories = "SELECT * FROM category";
        $resultCategories = mysqli_query($con, $sqlCategories);

        if (mysqli_num_rows($resultCategories) > 0) {
            while ($category = mysqli_fetch_assoc($resultCategories)) {
                $categoryName = mysqli_real_escape_string($con, $category['Category_Name']);
 
                     echo "<a href='user-books.php?categoryid=$categoryName' style='text-decoration: none;
                     color: black;'><h4>$categoryName</h4></a>";
            }}

        ?>
    </div>
    <div style="text-align: center;"><h3>Best Borrowed Books</h3></div>
    
    <div style="display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-evenly; margin-left: 180px;
    margin-bottom: 100px;">
                <?php

                $sqlBooks = "SELECT * FROM `book_info` ORDER BY `book_info`.`BorrowCount` DESC";
                $resultBooks = mysqli_query($con, $sqlBooks);

                if (mysqli_num_rows($resultBooks) > 0) {
                    while ($book = mysqli_fetch_assoc($resultBooks)) {
                        $bookID = $book['book_ID'];
                        $bookName = $book['book_Name'];
                        $bookCategory = $book['book_Category'];
                        $bookPrice = $book['BorrowCount'];
                        $bookImage = $book['book_Image'];

                        echo '
                        <div id="boroow">
                            <form action="" method="POST" style="
                            width: 400px;
                            margin-left: 10px;
                            margin-top:10px">
                                <img src="' . $bookImage . '" alt="" width="150px" height="250px">
                                <p>' . $bookName . '</p>
                                <p>' . $bookCategory . '</p>
                                <p style="color:#286f6c">Borrow:' . $bookPrice . '</p>
                                <table>
                                        <td >
                                        <button style="text-align: center; margin-left: 80px;" id="btnuser1" name="addToBorrow" "><a href="users-borrow.php?categoryid='.$bookCategory.'&updateid='.$bookID.'" style="text-decoration: none; color: white;"><i class="fa-solid fa-book"></i> Borrow</a></button>
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
        <style>
        #boroow:nth-child(n+7){
            display: none;
        }
    </style>
    </div>
    
</body>
<script src="index.js"></script>
</html>