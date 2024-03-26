<?php
    session_start();
    include "connect.php";

    $id = $_SESSION['auth_user']['FullName'];
    $pass = $_SESSION['auth_user']['Password'];


    if(isset($_POST['submit'])){
        $old = mysqli_real_escape_string($con, $_POST['txtold']);
        $new = mysqli_real_escape_string($con, $_POST['txtnew']);
        $new2 = mysqli_real_escape_string($con, $_POST['txtcon']);

        if(!empty($old) && !empty($new) && !empty($new2)){
            //checking old password is valid or not
            $check_token = "SELECT User_Password from user_info where User_Password='$old' LIMIT 1";
            $check_token_run = mysqli_query($con,$check_token);

            if(mysqli_num_rows($check_token_run) > 0){
                if($new === $new2){
                    $update_password = "UPDATE user_info set User_Password='$new' where User_FName='$id' LIMIT 1";
                    mysqli_query($con, $update_password);

                    echo "<script>
                    alert('Change Password Successfully!');
                    location.href='user-settings-password.php';
                    </script>";
                    exit(0);

                }
                else{
                    echo "<script>
                        alert('Password and Confirm Password does not match');
                        location.href='user-settings-password.php';
                    </script>";
                    exit(0);
                }
            }
            else{
                echo "<script>
                        alert('Old Password does not match');
                        location.href='user-settings-password.php';
                    </script>";
                    exit(0);
            }

        }
        else{
            echo "<script>
                    alert('All Field are Mandatory');
                    location.href='user-settings-password.php';
                  </script>";
                  exit(0);
        }
    }

?>