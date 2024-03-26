<?php
    include "connect.php";
    session_start();
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
                <a class="link" href="admin-sale.php"><i class="fa fa-repeat"></i> Sales</a>
                <a class="link" href="admin-reports.php"><i class="fa fa-receipt"></i> Reports</a>
                <a class="link" href="admin-setting.php"><i class="fa fa-gear"></i> Settings</a>
                <a class="link" href="logout.php"><i class="fa fa-user"></i> Logout</a>
            </div>

            <!-- <div class="profile-container" class="brand-title">
                <p>Hi,</p>
                <button class="brand-btn">Logout</button>
                <a class="link" href="login.html"><i class="fa fa-user"></i> Logout</a>
            </div> -->
        </nav>
    </header>
    <div style="position: absolute; width:400px; height:500px; background:white; box-shadow: 0 0 5px 1px rgb(0, 0, 0, 0.2); margin-top: 120px; margin-left:500px; padding:10px;">
        <a style="margin-left: 380px; text-decoration:none; color:black;" href="admin-reports.php">X</a><br><br>
            <?php
                if (isset($_GET['view'])) {
                    $invoice_id = $_GET['view'];
                
                    // Query to get transaction details for the specified invoice ID
                    $sql_transaction = "SELECT * FROM transaction WHERE invoice_id = $invoice_id";
                    $result_transaction = mysqli_query($con, $sql_transaction);
                
                    // Check if transaction exists
                    if ($result_transaction && mysqli_num_rows($result_transaction) > 0) {
                        $row_transaction = mysqli_fetch_assoc($result_transaction);
                
                        // Display transaction details
                        echo "<h2>Transaction Details for Invoice $invoice_id</h2>";
                
                        // Query to get ordered items for the specified invoice ID
                        $sql_ordered_items = "SELECT * FROM orders WHERE invoice_id = $invoice_id";
                        $result_ordered_items = mysqli_query($con, $sql_ordered_items);
                
                        // Display the ordered items
                        if ($result_ordered_items && mysqli_num_rows($result_ordered_items) > 0) {
                            echo "<h3>Ordered Items</h3>";
                            echo "<table border='1px'>
                                    <tr>
                
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Price</th>
                                    </tr>";
                
                            while ($row_ordered_items = mysqli_fetch_assoc($result_ordered_items)) {
                                echo "<tr>
                                        <td>{$row_ordered_items['prod_name']}</td>
                                        <td>{$row_ordered_items['prod_qty']}</td>
                                        <td>{$row_ordered_items['prod_price']}</td>
                                        <td>{$row_ordered_items['Total_price']}</td>
                                    </tr>";
                            }
                            // $Total= 
                
                            echo "</table>
                            <br>";
                        } else {
                            echo "<p>No ordered items found for Invoice $invoice_id.</p>";
                        }
                    } else {
                        echo "<p>Transaction not found for Invoice $invoice_id.</p>";
                    }
                    $total = number_format(($row_transaction['total_price']/100 )*1.12,2);
                    $finaltotal = number_format($total+$row_transaction['total_price'], 2);;
                
                    echo "<p>Sub-Total: {$row_transaction['total_price']}</p>";
                    echo "<p>Vat: $total</p>";
                    echo "<p>Total Price: $finaltotal</p>";
                    // echo "<p>Payment: {$row_transaction['total_payment']}</p>";
                    // echo "<p>Change: {$row_transaction['total_change']}</p>";
                    echo "<p>Date: {$row_transaction['date_create']}</p>";
                
                } else {
                    echo "<p>Invalid invoice ID.</p>";
                }

            ?>
            <br>
            
            <form action="admin-report.print.php?view=<?php echo$invoice_id?>" method="POST" enctype="multipart/form-data">
            <input style="margin-left: 1px; width: 80px; height:30px; background: blue; cursor:pointer;" type='submit' name='printbtn' value='Print'>
            </form>
        
            
        </div>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Reports</h2>
            </div>
        </div>
        <div>
            <table style="margin-left: 220px; margin-top:10px;">
                <tr>
                    <td >
                        <form action="admin-reports-filter.php" method="POST" enctype="multipart/form-data">
                            <select style="width: 200px;" name="txtfilter" id="">
                                <option value="day">Day</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                            <input style="width: 80px;" type="submit" value="Filter">
                        </form>
                    </td>
                    <td>
                    <div>
                        <form action="admin-report-printall.php" method="POST" enctype="multipart/form-data">
                            <input style="width: 80px;" type="submit" value="Print">
                        </form>
                    </div>
                    </td>
                    <td>
                        <label for="">Search: </label>
                        <input style="width: 200px;" type="text" name="txtsearch">
                        <input style="width: 80px;" type="submit" name="searchbtn">
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <table border="1px" style="margin-left: 300px;">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "Select * from transaction";
                        $result = mysqli_query($con, $sql);
                        $subtotal = 0;
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $id = $row['invoice_id'];
                                $first = $row['total_price'];
                                $second = $row['date_create'];
                                $subtotal += $row['total_price'];
                                echo '<tr>
                                <td>'.$id.'</td>
                                <td>'.$second.'</td>
                                <td>'.$first.'</td>
                                <td>
                                    <button id="btned"><a href="admin-reports-view.php?view='.$id.'"><i class="fa fa-pencil-square"></i> View</a></button>
                                    <button id="btned"><a href="admin-report.print.php?view='.$id.'"><i class="fa fa-pencil-square"></i> Print</a></button>
                                </td>
                            </tr>';
                            }
                        }
                    ?>
                </tbody>  
            </table>
        </div>
    </section>
    
</body>
</html>