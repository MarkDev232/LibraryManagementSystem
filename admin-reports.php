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
    <link rel="stylesheet" href="admin-report.css">
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

            <!-- <div class="profile-container" class="brand-title">
                <p>Hi,</p>
                <button class="brand-btn">Logout</button>
                <a class="link" href="login.html"><i class="fa fa-user"></i> Logout</a>
            </div> -->
        </nav>
    </header>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Reports</h2>
            </div>
        </div>
        <div>
            <table style="margin-left: 220px; margin-top:10px;">
                <!-- <tr>
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
                        filter fix -->
                        <!-- <form action="admin-report-printall.php" method="POST" enctype="multipart/form-data">
                            <input style="width: 80px;" type="submit" value="Print">
                        </form>
                    </div>
                    </td>
                    <td>
                        <label for="">Search: </label>
                        <input style="width: 200px;" type="text" name="txtsearch">
                        <input style="width: 80px;" type="submit" name="searchbtn">
                    </td>
                </tr> -->
            </table>    
        </div>
                    <div class='filter-date'>
                        <form method="GET" action="filter.php">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" required>

                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" required>

                            <input type="submit" value='filter'>
                        </form>
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