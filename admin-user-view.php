<?php
    include "connect.php";
    session_start();
    $query = "SELECT * from user_info;";
    $query_run1 = mysqli_query($con, $query);
    $ros = mysqli_fetch_assoc($query_run1);
    $id = $ros['User_ID'];
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
    <link rel="stylesheet" href="admin-user.css">
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
    <div style="width: 600px; height:500px; background:white; position:absolute;margin-left:500px; margin-top: 100px; border: 1px solid black;">
        <a style="position:absolute; margin-left: 570px; margin-top: 10px;" href="admin-user.php">X</a>
        <form action="" method="POST" enctype="multipart/form-data">
                    <br>
                    <br>
                    <label style="margin-left:20px; font-weight: bold;" for="">Customer ID:<?php echo $id ?></label><br><br>
                    <table class="table" border="1px" style="margin-left: 25px;">
                        <tr>
                            <th>No.</th>
                            <th>BookName</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Qty</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <?php
                            $query = "SELECT * from borrow;";
                            $query_run = mysqli_query($con, $query);
                            
                                if($query_run){
                                    while($ro = mysqli_fetch_assoc($query_run)){
                                        $ids = $ro['borrow_ID'];
                                        $one = $ro['user_id'];
                                        $two = $ro['book_name'];
                                        $three = $ro['book_Cat'];
                                        $four = $ro['book_Aut'];
                                        $five = $ro['quantity'];
                                        $six = $ro['borrow_date'];
                                        echo '
                                        <form action="" method="POST" enctype="multipart/form-data">
                                        <tr>
                                        <td>'.$ids.'</td>
                                        <td>'.$two.'</td>
                                        <td>'.$three.'</td>
                                        <td>'.$four.'</td>
                                        <td>'.$five.'</td>
                                        <td>'.$six.'</td>
                                        <td>
                                            <input style="width:80px;" type="submit" name="returnbtn" value="Return" formaction="dmin-user-returncode.php?borrowid='.$ids.'&user='.$id.'">
                                        </td>
                                        </tr>
                                        </form>
                                        ';
                                    }
                                }

                            ?>      
                        </tr>
                    </table>
                    <br>
                    <div style="margin-left: 20px;">
                        <label for="approval_date">Approval Date:</label>
                        <input style="width: 100px;"  type="date" name="approval_date">
                        <input style="width: 100px;" type="submit" name="btnapp" value="Aprove">
                    </div><br>
                </form>
                <?php
                    if(isset($_POST['btnapp'])){
                        $approval_date = $_POST['approval_date'];
                    
                        // Calculate and apply penalty if necessary
                        $return_date = date('Y-m-d', strtotime($approval_date. ' + 3 days')); // Assuming 3 days return period
                        
                        // Update the borrow table with the approval date
                        $update_query = "UPDATE borrow SET approval_date = '$approval_date', return_date = '$return_date' ,status_info = 'Approved' WHERE borrow_id = $ids";
                        $update_query_run = mysqli_query($con, $update_query);
                    
                        

                        $sql = "SELECT * from borrow";
                        $result = mysqli_query($con, $sql);

                            $row = mysqli_fetch_assoc($result);
                            
                            $due = $row['return_date'];
                            $currentDates = date("Y-m-d");

                            $datetimeDues = new DateTime($due);
                            $datetimeNows = new DateTime($currentDates);
                            $intervals = $datetimeDues->diff($datetimeNows);
                            $daysPasseds = $intervals->days;

                            if ($daysPasseds > 0) {
                                $penaltyPerDays = 50;
                                $penaltyAmounts = $penaltyPerDays * $daysPasseds;
                                $update_penalty_query = "UPDATE borrow SET penalty = $penaltyAmounts, status_b = 'Penalty' WHERE borrow_id = $ids";
                                 $update_penalty_query_run = mysqli_query($con, $update_penalty_query);
                            } else {
                                
                                echo "No penalty.";
                            }
                            echo "<script>
                                    alert('Approve Successfully');
                                    </script>";
                    }
                ?>
                <div style="margin-left: 20px;">
                    <?php
                        $one= null;
                        $six = null;
                        $date = null;
                        $pena = null;
                        $return_date = null;
                        
                         $query2 = "SELECT * from borrow;";
                         $query_run2 = mysqli_query($con, $query2);
                         
                        while($roz = mysqli_fetch_assoc($query_run2)){
                            $one = $roz['status_b'];
                            $six = $roz['borrow_date'];
                            $date = $roz['approval_date'];
                            $pena = $roz['penalty'];
                           $return_date = $roz['return_date'];
                        }
                                    

                         ?>     
                    <form action="admin-user-viewpayment.php?borrowid=<?php echo $ids?>" method="POST" enctype="multipart/form-data">
                        <label for="">Status: <?php echo $one ?></label> <br>
                        <label for="">Approval date:<?php echo $date ?></label> <br>
                        <label for="">Return Date: <?php echo $return_date ?></label> <br>
                        <label for="">Penalty: <span style="color: red;"><?php echo $pena ?></span></label><br>
                        <label for="">Payment: </label>
                        <input style="width: 100px;" type="text" name="txtpayment">
                        
                        <input style="width: 100px;" type="submit" name="paymentbtn" value="Submit">
                    </form>

                </div>
    </div>

    <section>
    <div class="main-container">
            <div class="header-title">
                <h2>Users</h2>
            </div>
            <!-- <div class="add-pop">
                <a href="admin-user-add.php">Add Users</a>
            </div> -->
            <table style="margin-left: 100px; margin-top:10px;" class='category-print'>
                <tr>
                    <td>
                        <button class='btn1'><a style="text-decoration: none;" href="admin-user-add.php">Add Users</a></button>
                    </td>
                    <td>
                        <button class='btn2'><a style="text-decoration: none;" href="admin-user-print.php">Print</a></button>
                    </td>
                    <td>
                        <button class='btn3'><a style="text-decoration: none;" href="admin-user-edit.php">Edit User Page</a></button>
                    </td>
                </tr>
            </table>
            <div class="tables">
                <table border="1px" style="margin: 0 auto;">
                    <tr>
                        <th>User_ID </th>
                        <th>User_Img</th>
                        <th>User_FName</th>
                        <th>User_Email</th>
                        <th>User_Username	</th>
                        <th>User_Mobile</th>
                        <th>User_Address</th>
                        <th>User_Borrowed</th>
                        <th>User_Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                            $sql = "Select * from user_info";
                            $result = mysqli_query($con, $sql);
                            if($result){
                                // echo $row['name'];
                                while($row = mysqli_fetch_assoc($result)){
                                    $id = $row['User_ID'];
                                    $first = $row['User_Img'];
                                    $two = $row['User_FName'];
                                    $three = $row['User_Email'];
                                    $four = $row['User_Username'];
                                    $five = $row['User_Mobile'];
                                    $six = $row['User_Address'];
                                    // $seven= $row['User_Password'];
                                    $eigth= $row['verify_status'];
                                    $seven = $row['BorrowedBooksCount'];
                                    // $nine = $row[''];
                                    echo '<tr>
                                    <td>'.$id.'</td>
                                    <td><img src='.$first.' width="50" height="50"></td>
                                    <td>'.$two.'</td>
                                    <td>'.$three.'</td>
                                    <td>'.$four.'</td>
                                    <td>'.$five.'</td>
                                    <td>'.$six.'</td>
                                    <td>'.$seven.'</td>
                                    <td>'.$eigth.'</td>

                                    <td>
                                        <button id="btned"><a href="admin-user-view.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> View</a></button>
                                        <button id="btned"><a href="admin-user-update.php?updateid='.$id.'"><i class="fa fa-pencil-square"></i> Update</a></button>
                                        <button id="btndel"><a href="admin-user-delete.php?deleteid='.$id.'"><i class="fa fa-trash"></i> Delete</a></button>
                                    </td>
                                    </tr>
                                    ';
                                }
                            }
                        ?>
                </table>
            </div>
        </div>

        
        
    </section>
    
</body>
</html>