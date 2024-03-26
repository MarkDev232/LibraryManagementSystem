<?php
    session_start();
    include "connect.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'C:\xampp\htdocs\admin\PHPMailer\src\Exception.php';
    require 'C:\xampp\htdocs\admin\PHPMailer\src\PHPMailer.php';
    require 'C:\xampp\htdocs\admin\PHPMailer\src\SMTP.php';

    function sendemail_verify($name,$email,$verify_token){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'techlibra68@gmail.com';                     //SMTP username
            $mail->Password   = 'cria zizw ngle zvzy';                               //SMTP password
            $mail->SMTPSecure = 'ssl';
            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($email, 'library');
            $mail->addAddress($email, $name);     //Add a recipient
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Email Verification from Libratech';
            $mail->Body    = "
            <h2>You have Registered with Name</h2>
            <h5>Verify your email address to Login with a given link bellow</h5> <br>
            <a href='http://localhost/admin/verify-email.php?token=$verify_token'>Click Me</a>
            ";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            // echo '<script>alert("Message has been sent")</script>';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }


    if(isset($_POST['submit'])){
 

        $duplicate = mysqli_query($con, "Select * from user_info where User_Username = '$_POST[txtuser]'");
        if(mysqli_num_rows($duplicate) > 0){
            echo 
            "<script> alert('Username is Already Taken');
            window.location.href='register.php';
             </script>";
        }
        else{
            if($_POST["pass1"] == $_POST["pass2"]){
                $name = $_POST['txtname'];
                $user = $_POST['txtuser'];
                $email = $_POST['txtemail'];
                $verify_token = md5(rand());
                // $password = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
                $password = $_POST['pass1'];
        
                $check_email_query = "SELECT User_Email from user_info where  User_Email='$email' LIMIT 1";
                $check_username_query = "SELECT User_Username from user_info where  User_Username='$user' LIMIT 1";
                $check_email_query_run = mysqli_query($con, $check_email_query);
                $check_username_query_run = mysqli_query($con, $check_username_query);
            
        
                if(mysqli_num_rows($check_email_query_run) > 0){
                    echo '<script>alert("Email is already Exists");
                                    window.location.href="register.php";</script>';
                }
        
                if(mysqli_num_rows($check_username_query_run) > 0){
                    echo '<script>alert("Username is already Exists");
                                    window.location.href="register.php";</script>';
                }
            
                else{
                    $query = "INSERT into user_info(User_FName,User_Username,User_Email,User_password,verify_token,User_Img,verify_status) values('$name','$user','$email','$password','$verify_token','default-profile-image.jpg','Not Verify')";
                    $query_run = mysqli_query($con, $query);
        
                    if($query_run){
                        sendemail_verify("$name","$email","$verify_token");
                        echo '<script>
                        alert("Registration Successfull.! Please verify your Email Address.");
                        window.location.href="login.php";</script>';
                    }else{
                        echo '<script>alert("Register Failed");
                        window.location.href="register.php";</script>';
                    }
                }   
            }
            else{
                echo "<script> alert('Password Doesnt Match');
                location.href='register.php'; </script>";
            }
        }
    }



?>