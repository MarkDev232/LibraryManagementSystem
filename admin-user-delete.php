<?php 
    include "connect.php";
    if(isset($_GET['deleteid'])){
        $id =$_GET['deleteid'];

        $sql = "delete from user_info where User_ID=$id";
        $result = mysqli_query($con, $sql);
        echo"
            <script>
                alert('Deleted Successfully!');
                location.href='admin-user.php';
            </script>
            ";
    }

?>