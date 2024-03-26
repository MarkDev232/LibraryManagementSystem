<?php
session_start();
include "connect.php";
if (isset($_POST['submit'])) {
    $Fname = $_POST['txtfname'];
    $Email = $_POST['txtemail'];
    $Uname = $_POST['txtuser'];
    $Mob = $_POST['txtmobile'];
    $Add = $_POST['txtadd'];

    // Check if a new file has been uploaded
    if ($_FILES['file']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['file']['tmp_name'];
        $img_name = $_FILES['file']['name'];
        $img_des = "userimg/".$img_name;
        move_uploaded_file($img_loc,'userimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE user_info SET User_Img='$img_des' WHERE User_FName='{$_SESSION['auth_user']['FullName']}'";
        mysqli_query($con, $query);
    }

    // Update other fields
    $query1 = "UPDATE user_info SET User_FName='$Fname', User_Email='$Email', User_Username='$Uname', User_Mobile='$Mob', User_Address='$Add' WHERE User_FName='{$_SESSION['auth_user']['FullName']}'";

    mysqli_query($con, $query1);

    echo "<script> alert('Save changes Successfully!');
                    location.href='user-settings.php';</script>";
}
?>
