<?php
    include "connect.php";
    session_start();

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $verify_query = "SELECT verify_token,verify_status from user_info where verify_token='$token' LIMIT 1";
        $verify_query_run = mysqli_query($con, $verify_query);

        if(mysqli_num_rows($verify_query_run) > 0){
            $row= mysqli_fetch_array($verify_query_run);
            // echo $row['verify_token'];
            if($row['verify_status'] == "Not Verify"){
                $clicked_token = $row['verify_token'];
                $update_query = "UPDATE user_info SET verify_status='Verify' where verify_token='$clicked_token' LIMIT 1";
                $update_query_run = mysqli_query($con, $update_query);

                if($update_query_run){
                    echo "<script>
                    alert('Your Account has been verified Successfully.');
                    window.location.href='login.php';
                    </script>";
                    exit(0);
                }
                else{
                    echo "<script>
                    alert('Verification Failed!');
                    window.location.href='login.php';
                    </script>";
                    exit(0);
                }
            }
            else{
                echo "<script>
                alert('Email Already Verified. Please Login.');
                window.location.href='login.php';
              </script>";
              exit(0);
            }
        }
        else{
            echo "<script>
            alert('This token does not exists.');
            window.location.href='login.php';
          </script>";
        }

    }
    else{
        echo "<script>
                alert('Not Allowed');
                window.location.href='login.php';
              </script>";
    }
?>