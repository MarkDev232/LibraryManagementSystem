<?php
    session_start();
    include "connect.php";

if (isset($_POST['submit'])) {
    // $sql = "select * from user_info";
    // $sql_run = mysqli_query($con, $sql);
    // $sql_runs = mysqli_fetch_assoc($sql_run);
    // $ro = $sql_runs['User_Password'];
    // $password = password_hash($_POST['txtpass'], PASSWORD_DEFAULT);
    // $password1 = password_hash($ro, PASSWORD_DEFAULT);

    if (!empty(trim($_POST['txtuser'])) && !empty(trim($_POST['txtpass']))) {
    // if ($_POST['txtuser'] && password_verify($password, $password1)) {
        $email = mysqli_real_escape_string($con, $_POST['txtuser']);
        $password = mysqli_real_escape_string($con, $_POST['txtpass']);

        // Add code to check if the account is blocked
        $check_block_query = "SELECT * FROM user_info WHERE User_Username='$email' AND blocked=1 LIMIT 1";
        $check_block_query_run = mysqli_query($con, $check_block_query);
        if (mysqli_num_rows($check_block_query_run) > 0) {
            echo "<script>
                    alert('Your account is blocked. Please wait for admin approval.');
                    window.location.href='login.php';
                    </script>";
            exit(0);
        }

        $login_query = "SELECT * FROM user_info WHERE User_Username='$email' AND User_Password='$password' LIMIT 1";
        $login_query_run = mysqli_query($con, $login_query);
        $login_admin_query = "SELECT * FROM admin_info WHERE Admin_Username='$email' AND Admin_Password='$password' LIMIT 1";
        $login_admin_query_run = mysqli_query($con, $login_admin_query);

        if (mysqli_num_rows($login_query_run) > 0) {
            $row = mysqli_fetch_array($login_query_run);
            if ($row['verify_status'] == "Verify") {

                $_SESSION['aunthenticated'] = true;
                $_SESSION['auth_user'] = ['ID' => $row['User_ID'], 'FullName' => $row['User_FName'], 'UserName' => $row['User_Username'], 'Email' => $row['User_Email'], 'Mobile' => $row['User_Mobile'], 'Address' => $row['User_Address'], 'Password' => $row['User_Password'], 'ProfilePic' => $row['User_Img'], 'Status' => $row['verify_status']];
                echo "<script>
                    alert('You are Login Successfully!');
                    window.location.href='user.php';
                    </script>";
                exit(0);
            }
            elseif($row['verify_status'] == "Block"){
                echo "<script>
                    alert('Your Account has been Block Wait for Admin!');
                    window.location.href='login.php';
                    </script>";
                exit(0);
            } else {
                echo "<script>
                    alert('Please Verify your Email Address to Login.');
                    window.location.href='login.php';
                    </script>";
                exit(0);
            }
        } elseif (mysqli_num_rows($login_admin_query_run) > 0) {
            $rows = mysqli_fetch_array($login_admin_query_run);

            $_SESSION['aunthenticated'] = true;
            $_SESSION['auth_admin'] = ['adminID' => $rows['Admin_ID'], 'adminFullName' => $rows['Admin_FName'], 'UserAdmin' => $rows['Admin_Username'], 'adminEmail' => $rows['Admin_Email'], 'Password' => $rows['Admin_Password'], 'Profileadmin' => $rows['Admin_Img'], 'Status' => $rows['verify_status']];
            echo "<script>
                    alert('You are Login Successfully!');
                    window.location.href='admin.php';
                    </script>";
            exit(0);
        } else {
            // Add code to update login attempts and block the account if necessary
            $update_attempts_query = "UPDATE user_info SET login_attempts = login_attempts + 1 WHERE User_Username='$email'";
            mysqli_query($con, $update_attempts_query);

            $get_attempts_query = "SELECT login_attempts FROM user_info WHERE User_Username='$email'";
            $get_attempts_query_run = mysqli_query($con, $get_attempts_query);
            $attempts_row = mysqli_fetch_assoc($get_attempts_query_run);
            $remaining_attempts = 3 - $attempts_row['login_attempts'];

            if ($remaining_attempts <= 0) {
                // // Block the account
                // $block_account_query = "UPDATE user_info SET blocked = 1 WHERE User_Username='$email'";
                // mysqli_query($con, $block_account_query);
                // Block the account and update verify_status
                $block_account_query = "UPDATE user_info SET blocked = 1, verify_status = 'Block' WHERE User_Username=?";
                $block_account_stmt = mysqli_prepare($con, $block_account_query);
                mysqli_stmt_bind_param($block_account_stmt, "s", $email);
                mysqli_stmt_execute($block_account_stmt);

                echo "<script>
                        alert('Invalid Email or Password! Your account has been blocked. Please wait for admin approval.');
                        window.location.href='login.php';
                        </script>";
                exit(0);

                echo "<script>
                        alert('Invalid Email or Password! Your account has been blocked. Please wait for admin approval.');
                        window.location.href='login.php';
                        </script>";
                exit(0);
            } else {
                echo "<script>
                        alert('Invalid Email or Password! $remaining_attempts attempts remaining.');
                        window.location.href='login.php';
                        </script>";
                exit(0);
            }
        }
    } else {
        echo "<script>
                alert('All fields are Mandatory.');
                window.location.href='login.php';
                </script>";
        exit(0);
    }
}

?>