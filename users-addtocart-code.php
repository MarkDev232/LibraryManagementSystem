<?php
include "connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['updateid'];
    
    // Get book information based on book_ID
    $sql = "SELECT * FROM book_info WHERE book_ID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $selectedBookName = $row['book_Name'];
        $quantity = $_POST['txtnum'];

        // Get the price of the book
        $price = $row['book_Price'];

        // Calculate total price
        $total_price = $price * $quantity;

        // Update book_Qty in book_info
        $sql_update_qty = "UPDATE book_info SET book_Qty = book_Qty - ? WHERE book_ID = ?";
        $stmt_update_qty = mysqli_prepare($con, $sql_update_qty);
        mysqli_stmt_bind_param($stmt_update_qty, "ss", $quantity, $id);
        mysqli_stmt_execute($stmt_update_qty);

        // Insert information into addtocart table
        $sql_insert_order = "INSERT INTO addtocart (add_name, add_qty, add_price, Total_price) VALUES (?, ?, ?, ?)";
        $stmt_insert_order = mysqli_prepare($con, $sql_insert_order);
        mysqli_stmt_bind_param($stmt_insert_order, "sddd", $selectedBookName, $quantity, $price, $total_price);
        mysqli_stmt_execute($stmt_insert_order);

        echo "
        <script>
            alert('Added Books Successfully!');
            location.href='user.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Invalid Book ID!');
            location.href='user.php';
        </script>
        ";
    }
}
?>