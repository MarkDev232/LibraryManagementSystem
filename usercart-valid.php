<?php
    include "connect.php";
    session_start();
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

    if(isset($_POST['yesbtn'])){
        $id =$_GET['deleteid'];

        $sql = "delete from addtocart where add_ID=$id";
        $result = mysqli_query($con, $sql);
        echo"
        <script>
            alert('Deleted Successfully!');
            location.href='user-cart.php';
        </script>
        ";
    }
    elseif(isset($_POST['nobtn'])){
        echo "<script>
        location.href='user-cart.php';</script>";
        exit();
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="userstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background: <?php echo $first ?>; color:<?php echo $two ?>;">
    <header>
        <nav>
            <div class="image-logo">
                <img src="<?php echo $three ?>" alt="">
            </div>
            <div class="nav-links">
                <a href="users.php">Home</a>
                <a href="user-borrowing.php">Books</a>
                <a href="#contact">Contact</a>
                <a href="usercart.php">Cart</a>
                <a href="usersettings.php">Setting</a>
                <a id="btn" href="logout.php"> <?=$_SESSION['auth_user']['FullName']; ?> | Logout</a>
            </div>
        </nav>

    </header>


    <div class="style-books">
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
        <button id="btndelete" type="submit" name="delete"><i class="fa fa-trash"></i> Delete Selected</button>
        <form action="user-cartsold.php" method="POST" enctype="multipart/form-data">
            <table class="table" border="1px">
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Book Qty</th>
                    <th>Book Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>

                <?php
                include "connect.php";  // Include this line again to reopen the connection

                $sq = "SELECT * FROM addtocart";
                $resul = mysqli_query($con, $sq);
                $subtotal = 0;

                while ($row1 = mysqli_fetch_array($resul)) {
                    echo "
                        <tr>
                            <td> <input type='checkbox' name='deleteId[]' value='".$id."' id='checkbtn' ></td>
                            <td>{$row1['add_ID']}</td>
                            <td>{$row1['add_name']}</td>
                            <td>{$row1['add_qty']}</td>
                            <td>{$row1['add_price']}</td>
                            <td>{$row1['Total_price']}</td>
                            <td>
                            <button id='btndel'><a href='usercart-delete.php?deleteid={$row1['add_ID']}'><i class='fa fa-trash'></i> Remove</a></button>
                            </td>
                        </tr>
                    ";

                    $subtotal += $row1['Total_price'];
                }
                ?>

            </table>
            <div style="margin-left: 40px;">
            <form action="user-cartsold.php" method="POST" enctype="multipart/form-data">
                <label for="total">Sub_Total: <span><?php echo $subtotal; ?></span></label> 
                <input style="width: 100px; height: 30px; background: #00d2ff; cursor:pointer;" type="submit" name="processbtn" value="Place Order">
            </form>
        </div>
        </form>
    </div>
    </div>


</body>
</html>