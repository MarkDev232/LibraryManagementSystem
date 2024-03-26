<?php
include ('connect.php');

$startdate = $_GET['start_date'];
$enddate = $_GET['end_date'];

// $start = strtotime($start_date);
// $end = strtotime($end_date);

// echo "<script>alert($startdate);</script>";
    

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
        <nav style="background-color:#089da1;">
            <div class="brand-container">
                <img src="logo.png" alt="My Personal Logo" width="150px">
                <h2 style="color:black;"class="brand-title">WEBDEV-LIBRARY</h2>
            </div>

            <div class="brand-title">
                <a style="color:black;"class="link" href="admin.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
                <a style="color:black;"class="link" href="admin-user.php"><i class="fa-solid fa-users"></i> Users</a>
                <a style="color:black;"class="link" href="admin-category.php"><i class="fa-solid fa-layer-group"></i> Category</a>
                <a style="color:black;"class="link" href="admin-book.php"><i class="fa-solid fa-book-open"></i> Books</a>
                <a style="color:black;"class="link" href="admin-sale.php"><i class="fa-brands fa-salesforce"></i> Sales</a>
                <a style="color:black;"class="link" href="admin-reports.php"><i class="fa fa-receipt"></i> Reports</a>
                <a style="color:black;"class="link" href="admin-setting.php"><i class="fa-solid fa-gears"></i> Settings</a>
                <a style="color:black;"class="link" href="login.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
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
                <tr>
                    <!-- <td >
                        <form action="admin-reports-filter.php" method="POST" enctype="multipart/form-data">
                            <select style="width: 200px;" name="txtfilter" id="">
                                <option value="day">Day</option>
                                <option value="month">Month</option>
                                <option value="year">Year</option>
                            </select>
                            <input style="width: 80px;" type="submit" value="Filter">
                        </form>
                    </td> -->
                    <td>
                    
                    <div id='filter-date'>
                         <!-- filter fix  -->
                         <form action="admin-report.print.php" method="GET" enctype="multipart/form-data">
                                <input type="hidden" name="start_date" value="<?php echo $_GET['start_date'];?>">
                                <input type="hidden" name="end_date" value="<?php echo $_GET['end_date'];?>">
                            <input style="width: 80px;margin-left:100px;background:blue;" type="submit" value="Print">
                        </form>
                    </div>
                    </td>
                    <!-- <td>
                        <label for="">Search: </label>
                        <input style="width: 200px;" type="text" name="txtsearch">
                        <input style="width: 80px;" type="submit" name="searchbtn">
                    </td> -->
                </tr>
            </table>  
         <!-- </div>
                    <div style="margin-left: 250px;margin-top:10px;"class='filter-date'>
                        <form method="GET" action="filter.php">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" value="<?php echo $_GET['start_date'];?>"required>

                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" value="<?php echo $_GET['end_date']; ?>"required>

                            <input style="background: blue;"type="submit" value='Filter'>
                        </form>
                    </div>
        <br>
        <div>  -->
            <table border="1px" style="margin-left: 300px;">
                <!-- <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead> -->
                <tbody>
                <?php
include('connect.php');

// Tignan kung mayroong naka-submit na form
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Check if the date inputs are valid
    if (!strtotime($start_date) || !strtotime($end_date)) {
        die("Invalid date format");
    }

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM transaction WHERE date_create BETWEEN ? AND ?";
    $stmt = $con->prepare($sql);

    // Bind parameters and execute
    $stmt->bind_param("ss", $start_date, $end_date);
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        die("Error: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table border="1px" style="margin-left: 300px;">
                <thead>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';

        while ($row = $result->fetch_assoc()) {
            $id = $row['invoice_id'];
            $first = $row['total_price'];
            $second = $row['date_create'];

            echo '<tr>
                    <td>' . $id . '</td>
                    <td>' . $second . '</td>
                    <td>' . $first . '</td>
                    <td>
                        <button id="btned"><a href="admin-reports-view.php?view=' . $id . '"><i class="fa fa-pencil-square"></i> View</a></button>
                        <button style="background: red;" id="btned"><a href="admin-report.printall.php?view=' . $id . '"><i class="fa fa-pencil-square"></i> Print</a></button>
                    </td>
                </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo "No results found.";
    }

    $stmt->close();
    $con->close();
}
?>
                </tbody>  
            </table>
        </div>
    </section>
    
</body>
</html>