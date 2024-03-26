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

    if(isset($_POST["delete"]) && isset($_POST["deleteId"])){
        foreach($_POST["deleteId"] as $deleteId){
            $delete = "DELETE FROM addtocart where add_ID='$deleteId'";
            mysqli_query($con, $delete);
        }
    }
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
    <br>
    <div>
        <form action="usercart-multi.php" method="GET" enctype="multipart/form-data">
        <button style="margin-left:50px;" type="submit" name="delete"><i class="fa fa-trash"></i> Delete Selected</button><br><br>
            <table style="margin-left: 50px;" border="1px">
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
                // $id = $row['add_ID'];
                while ($row1 = mysqli_fetch_array($resul)) {
                    $id = $row1['add_ID'];
                    echo "
                        <tr>
                            <td> <input type='checkbox' name='ids[]' value='".$id."' id='checkbtn' ></td>
                            <td>{$row1['add_ID']}</td>
                            <td>{$row1['add_name']}</td>
                            <td>{$row1['add_qty']}</td>
                            <td>{$row1['add_price']}</td>
                            <td>{$row1['Total_price']}</td>
                            <td>
                            <button id='btndel'><a href='usercart-valid.php?deleteid={$row1['add_ID']}'><i class='fa fa-trash'></i> Remove</a></button>
                            </td>
                        </tr>
                    ";

                    $subtotal += $row1['Total_price'];
                }
                ?>

            </table>
        </form>
                <br>
        <div style="margin-left: 50px;">
            <form action="user-cartsold.php" method="POST" enctype="multipart/form-data">
                <label for="total">Sub_Total: <span><?php echo $subtotal; ?></span></label> 
                <input style="width: 100px; height: 30px; background: #00d2ff; cursor:pointer;" type="submit" name="processbtn" value="Place Order">
            </form>
        </div>
    </div>
    </div>
    
</body>
</html>