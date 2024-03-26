<?php 
    include "connect.php";
    if(isset($_POST['txtsubmit'])){
        $img_loc = $_FILES['file']['tmp_name'];
        $img_name = $_FILES['file']['name'];
        $img_des = "userimg/".$img_name;
        move_uploaded_file($img_loc,'userimg/'.$img_name);
        $hashedPassword = password_hash($_POST['txtpass'], PASSWORD_DEFAULT);


        $sql = "INSERT INTO user_info(User_Img,User_FName,User_Email,User_Username,User_Mobile,User_Address,User_Password,User_Status) values('$img_des','$_POST[txtname]','$_POST[txtemail]','$_POST[txtuse]','$_POST[txtmob]','$_POST[txtadd]',$hashedPassword,'$_POST[txtstatus]')";
        $result = mysqli_query($con, $sql);
        echo"
        <script>
            alert('Added Successfully!');
            location.href='admin-user.php';
        </script>
        ";
    }
?>
