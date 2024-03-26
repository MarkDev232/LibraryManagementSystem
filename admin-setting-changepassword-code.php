<?php
    session_start();
    include "connect.php";

    $id = $_SESSION['auth_admin']['adminID'];
    $pass = $_SESSION['auth_admin']['Password'];


    if(isset($_POST['submit'])){
        $old = mysqli_real_escape_string($con, $_POST['txtold']);
        $new = mysqli_real_escape_string($con, $_POST['txtnew']);
        $new2 = mysqli_real_escape_string($con, $_POST['txtnew2']);

        if(!empty($old) && !empty($new) && !empty($new2)){
            //checking old password is valid or not
            $check_token = "SELECT Admin_Password from admin_info where Admin_Password='$old' LIMIT 1";
            $check_token_run = mysqli_query($con,$check_token);

            if(mysqli_num_rows($check_token_run) > 0){
                if($new && $new2){
                    $update_password = "UPDATE admin_info set Admin_Password='$new' where Admin_ID='$id' LIMIT 1";
                    mysqli_query($con, $update_password);

                    echo "<script>
                    alert('Change Password Successfully!');
                    location.href='admin-setting-changepassword.php';
                    </script>";
                    exit(0);

                }
                else{
                    echo "<script>
                        alert('Password and Confirm Password does not match');
                        location.href='admin-setting-changepassword.php';
                    </script>";
                    exit(0);
                }
            }
            else{
                echo "<script>
                        alert('Old Password does not match');
                        location.href='admin-setting-changepassword.php';
                    </script>";
                    exit(0);
            }

        }
        else{
            echo "<script>
                    alert('All Field are Mandatory');
                    location.href='admin-setting-changepassword.php';
                  </script>";
                  exit(0);
        }
    }
?>