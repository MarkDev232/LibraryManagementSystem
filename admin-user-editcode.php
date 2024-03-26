<?php
include "connect.php";
session_start();
$sql1 = "Select * from admin_info";
$confirmpass = mysqli_query($con, $sql1);
$confirmpass_run = mysqli_fetch_assoc($confirmpass);
$pass = $confirmpass_run['Admin_Password'];
if($_POST['txtpass'] == $pass){


if (isset($_POST['submit'])) {
    $bg = $_POST['txtbg'];
    $color = $_POST['txtcolor'];

    // Check if a new file has been uploaded
    if ($_FILES['txtlogo']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['txtlogo']['tmp_name'];
        $img_name = $_FILES['txtlogo']['name'];
        $img_des = "editimg/".$img_name;
        move_uploaded_file($img_loc,'editimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE edit_user SET edit_logo='$img_des' WHERE edit_ID='{$_SESSION['auth_admin']['adminID']}'";
        mysqli_query($con, $query);
    }

    if ($_FILES['txtslide1']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['txtslide1']['tmp_name'];
        $img_name = $_FILES['txtslide1']['name'];
        $img_des = "editimg/".$img_name;
        move_uploaded_file($img_loc,'editimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE edit_user SET edit_slide1='$img_des' WHERE edit_ID='{$_SESSION['auth_admin']['adminID']}'";
        mysqli_query($con, $query);
    }

    if ($_FILES['txtslide2']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['txtslide2']['tmp_name'];
        $img_name = $_FILES['txtslide2']['name'];
        $img_des = "editimg/".$img_name;
        move_uploaded_file($img_loc,'editimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE edit_user SET edit_slide2='$img_des' WHERE edit_ID='{$_SESSION['auth_admin']['adminID']}'";
        mysqli_query($con, $query);
    }

    if ($_FILES['txtslide3']['error'] != 4) { // Error code 4 means no file was uploaded
        $img_loc = $_FILES['txtslide3']['tmp_name'];
        $img_name = $_FILES['txtslide3']['name'];
        $img_des = "editimg/".$img_name;
        move_uploaded_file($img_loc,'editimg/'.$img_name);

        // Update the image in the database
        $query = "UPDATE edit_user SET edit_slide3='$img_des' WHERE edit_ID='{$_SESSION['auth_admin']['adminID']}'";
        mysqli_query($con, $query);
    }


    // Update other fields
    $query1 = "UPDATE edit_user SET edit_bg='$bg', edit_font='$color' WHERE edit_ID='{$_SESSION['auth_admin']['adminID']}'";

    mysqli_query($con, $query1);

    echo "<script> alert('Save changes Successfully!');
                    location.href='admin-user-edit.php';
        </script>";
}}else{
    echo"
        <script>
            alert('Invalid Password');
            location.href='admin-user.php';
        </script>
        ";
}
?>
