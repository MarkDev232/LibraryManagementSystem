<?php
	include ("connect.php");
if (isset($_GET['deleteid'])) {
        $id = $_GET['deleteid'];
        $sql1 = mysqli_query($con, "DELETE from orders where id = $id");
		
        header("Location: admin-sale.php");
}
?>