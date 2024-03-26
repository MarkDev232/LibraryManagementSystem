<?php
session_start();
include "connect.php";
if (isset($_POST['submit'])) {
    $Fname = $_POST['txtname'];
    $Email = $_POST['txtemail'];
    $Uname = $_POST['txtuser'];

    // Check if a new file has been uploaded
    if ($_FILES['file']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['file']['tmp_name'];
        $img_name = $_FILES['file']['name'];
        $img_des = "userimg/".$img_name;
        move_uploaded_file($img_loc,'userimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE admin_info SET Admin_Img='$img_des' WHERE Admin_ID='{$_SESSION['auth_admin']['adminID']}'";
        mysqli_query($con, $query);
    }

    // Update other fields
    $query1 = "UPDATE admin_info SET Admin_FName='$Fname', Admin_Email='$Email', Admin_Username='$Uname' WHERE Admin_ID='{$_SESSION['auth_admin']['adminID']}'";

    mysqli_query($con, $query1);

    echo "<script> alert('Save changes Successfully!');
                    location.href='admin-setting.php';</script>";
}


?>