<?php
    session_start();
    include "connect.php";


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';

    function send_password_reset($get_name,$get_email,$token){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'techlibra68@gmail.com';                     //SMTP username
            $mail->Password   = 'rvud zjtc imwv msnr';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($get_email, 'library');
            $mail->addAddress($get_email, $get_name);     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification from library';
            $mail->Body    = "
            <h2>Hello</h2>
            <h3>You are receiving this email because we received a password reset request for your account.</h3> <br><br>
            <a href='http://localhost/admin/password-change.php?token=$token&User_Email=$get_email'>Click Me</a>
            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo '<script>alert("Message has been sent")</script>';
            // header('Location:register.php');
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
        echo "Message has been sent";
    }


    if(isset($_POST['submitforgot'])){
        $email = mysqli_real_escape_string($con, $_POST['txtemail']);
        $token = md5(rand());

        $check_email = "SELECT User_Email from user_info where User_Email='$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        if(mysqli_num_rows($check_email_run) > 0){
            $row = mysqli_fetch_array($check_email_run);
            $get_name = $row['User_FName'];
            $get_email = $row['User_Email'];

            $update_token = "UPDATE user_info set verify_token='$token' where User_Email='$email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            if($update_token_run){
                send_password_reset($get_name,$get_email,$token);
                echo "<script>
                alert('We send on your email a password reset link');
                location.href='forgot.php';
                </script>";
                exit(0);

            }
            else{
                echo "<script>
                    alert('Something went wrong.');
                    location.href='forgot.php';
                  </script>";
                  exit(0);
            }
        }
        else{
            echo "<script>
                    alert('No Email Found');
                    location.href='forgot.php';
                  </script>";
                  exit(0);
        }


    }

    if(isset($_POST['submitchange'])){
        $email = mysqli_real_escape_string($con, $_POST['txtemail']);
        $new_password = mysqli_real_escape_string($con, $_POST['txtpass']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['txtpass1']);
        $token = mysqli_real_escape_string($con, $_POST['password_token']);

        if(!empty($token)){
            if(!empty($token) && !empty($new_password) && !empty($confirm_password)){
                //checking token is valid or not
                $check_token = "SELECT verify_token from user_info where verify_token='$token' LIMIT 1";
                $check_token_run = mysqli_query($con,$check_token);

                if(mysqli_num_rows($check_token_run) > 0){

                    if($new_password && $confirm_password){
                        $update_password = "UPDATE user_info set User_Password='$new_password' where verify_token='$token' LIMIT 1";
                        $update_password_run = mysqli_query($con, $update_password);

                        if($update_password_run){
                            $new_token = md5(rand());
                            $update_new_token = "UPDATE user_info set verify_token='$new_token' where verify_token='$token' LIMIT 1";
                            $update_new_token_run = mysqli_query($con, $update_new_token);

                            echo "<script>
                            alert('Change Password Successfully!');
                            location.href='login.php';
                            </script>";
                            exit(0);
                        }
                        else{
                            echo "<script>
                            alert('Did not Update password. Something went wrong!');
                            location.href='password-change.php?token=$token&User_Email=$email';
                            </script>";
                            exit(0);
                        }
                    }
                    else{
                        echo "<script>
                            alert('Password and Confirm Password does not match');
                            location.href='password-change.php?token=$token&User_Email=$email';
                        </script>";
                        exit(0);
                    }



                }
                else{
                    echo "<script>
                    alert('Invalid Token');
                    location.href='password-change.php?token=$token&User_Email=$email';
                  </script>";
                  exit(0);
                }



            }
            else{
                echo "<script>
                    alert('All Field are Mandatory');
                    location.href='password-change.php?token=$token&User_Email=$email';
                  </script>";
                  exit(0);
            }
        }
        else{
            echo "<script>
                    alert('No Token Available');
                    location.href='password-change.php?token=$token&User_Email=$email';
                  </script>";
                  exit(0);
        }
    }



?>