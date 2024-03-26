<?php
    include "connect.php";
    if(isset($_GET['deleteid'])){
        $id =$_GET['deleteid'];

        $sql = "delete from category where Category_ID=$id";
        mysqli_query($con, $sql);

        echo "
        <script>
            alert('Deleted Successfully!');
            location.href='admin-category.php';
        </script>";
    }
?>