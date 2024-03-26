<?php
    include "connect.php";
    session_start();
    $invoice = uniqid();  // Generates a unique ID based on the current timestamp
    if (isset($_POST['resetbtn'])) {
        // Clear the orders table
        mysqli_query($con, "TRUNCATE TABLE orders");
    }
?>
<!DOCTYPE html>
<?php
    include "connect.php";
    if(!isset($_SESSION['auth_admin']['adminFullName'])) {
        // Kung wala, ireredirect sa login page
        echo "<script> alert('Please Login First');
        location.href='login.php';</script>";
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
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

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Sales</h2>
        </div>

        
    </section>
    <div style="margin-left: 300px; ">
            <div style="margin-top: 20px;">
                <form method="POST" action="admin-sale-add-process.php" enctype="multipart/form-data">
                <table style="margin-left: 100px; margin-top:10px;" class='category-print'>
                            <tr>
                                <td>
                                    <label for="booktxt">Books </label>
                                    <select style="width: 200px;" name="item_id" id="item_id">
                                    <option value="">--Select Books--</option>
                                    <?php
                                    $sql = "SELECT * FROM book_info";
                                    $result = mysqli_query($con, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='{$row['book_ID']}'>{$row['book_Name']}</option>";
                                    }
                                    ?>
                                    </select>
                                </td>
                                <td>
                                    <label style for="">Quantity: </label>
                                    <input style="width: 100px;"type="number"  value="1" name="quantity_sold">
                                    <input style="width: 100px;" type="submit" value="Add Book" name="sellbtn">
                                </td>
                            </tr>
                        </table>
                </form>
            </div>
            <div >
                <table class="table" border="1px">
                    <tr>
                        <th>Book Name</th>
                        <th>Book Qty</th>
                        <th>Book Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $sql1 = "SELECT * FROM orders";
                    $result1 = mysqli_query($con, $sql1);
                    $subtotal = 0;
            
                    while ($rows = mysqli_fetch_array($result1)) {
                        $bookid = $rows['prod_id']; 
                                                echo "
                            <tr>
                                <td>{$rows['prod_name']}</td>
                                <td>{$rows['prod_qty']}</td>
                                <td>{$rows['prod_price']}</td>
                                <td>{$rows['Total_price']}</td>
                                <td>
							<a href='deletepos.php?deleteid=". $rows['id']."' class='delb'><i class='bx bxs-trash'></i></a></td>
                            </td>
                            </tr>
            
                            ";
            
                            $subtotal += $rows['Total_price'];
                    }
                    ?>
                </table>
            </div>
            <div>   
                <br><br>         
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Order No:<?php echo $invoice?></label><br><br>
                    <input style="width: 120px;" class="btn-sale" type="submit" name="resetbtn" value="New Transcation">
                </form><br>
                <form action="admin-sale-send.php?invoiceid=<?php echo $invoice ?>&bookid=<?php echo $bookid ?>" method="POST" enctype="multipart/form-data">
                    <label for="total">Sub_Total: <span><?php echo $subtotal; ?></span></label> <br><br>
                    <label for="vat">VATax: <span><?php $vat = ($subtotal / 100) * 12; echo number_format($vat, 2); ?></span></label><br><br>
                    <label for="">Total: <span><?php $total= $subtotal+$vat; echo number_format($total, 2); ?></span></label><br><br>
                    <label for="payment">Payment:</label>
                    <input style="width: 100px;" class="txt-payment" type="number" name="txtpayment"><br><br>
                    <input style="width: 120px;" class="btn-sale" type="submit" name="processbtn" value="Process Payment">
                </form>
            </div>
            </div>
        </div>
    
</body>
</html>