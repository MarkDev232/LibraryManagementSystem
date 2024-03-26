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
    $CATE = $_GET['categoryid'];

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
    <section class="slideshow-container" id="home">

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
    <div style="text-align: center;"><h2>Books</h2></div>

    
    <div style="display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-evenly; margin-left:20px;">
                <?php
                //
                // Number of div elements per page
    $perPage = 6;

    // Current page (default to page 1 if not set)
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // Calculate the starting index for the current page
    $offset = ($page - 1) * $perPage;

    // Modify your SQL query to include LIMIT and OFFSET
    $sqlBooks = "SELECT * FROM book_info WHERE book_Category='$CATE' LIMIT $perPage OFFSET $offset";
    $resultBooks = mysqli_query($con, $sqlBooks);
// Calculate total pages based on the total number of records and records per page
$totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM book_info WHERE book_Category='$CATE'");
$totalRecords = mysqli_fetch_assoc($totalRecordsQuery)['total'];

// Ensure $perPage is not zero to prevent division by zero
if ($perPage > 0) {
    $totalPages = ceil($totalRecords / $perPage);
} else {
    $totalPages = 1; // Set a default value to avoid division by zero
}
                //

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
    <?php
// Display pagination links
    echo '<div style="padding:40px; ">';
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a style="border:1px solid black; padding:20px; background: black; color: white;" href="?page=' . $i . '&categoryid='.$CATE.'">' . $i . '</a> ';
    }
    echo '</div>';
?>
    
</body>
<script src="index.js"></script>
</html>