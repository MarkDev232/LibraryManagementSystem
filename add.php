<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBookName = $_POST['booktxt'];
    $quantity = $_POST['quantity'];

    // Query to get the price of the book
    $sql_price = "SELECT book_Price FROM book_info WHERE book_Name = ?";
    $stmt_price = mysqli_prepare($con, $sql_price);
    mysqli_stmt_bind_param($stmt_price, "s", $selectedBookName);
    mysqli_stmt_execute($stmt_price);
    $result_price = mysqli_stmt_get_result($stmt_price);

    if ($result_price) {
        $row_price = mysqli_fetch_assoc($result_price);

        // Check if a valid result was obtained
        if ($row_price && isset($row_price['book_Price'])) {
            $price = $row_price['book_Price'];

            // Calculate total price
            $total_price = $price * $quantity;

            // Update book_Qty in book_info
            $sql_update_qty = "UPDATE book_info SET book_Qty = book_Qty - ? WHERE book_Name = ?";
            $stmt_update_qty = mysqli_prepare($con, $sql_update_qty);
            mysqli_stmt_bind_param($stmt_update_qty, "ss", $quantity, $selectedBookName);
            mysqli_stmt_execute($stmt_update_qty);

            // Insert information into orders table
            $sql_insert_order = "INSERT INTO orders (prod_name, prod_qty, prod_price, Total_price) VALUES (?, ?, ?, ?)";
            $stmt_insert_order = mysqli_prepare($con, $sql_insert_order);
            mysqli_stmt_bind_param($stmt_insert_order, "ssdd", $selectedBookName, $quantity, $price, $total_price);
            mysqli_stmt_execute($stmt_insert_order);


            echo "
            <script>
                alert('Added Books Successfully! Total Price: $total_price');
                location.href='form.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Invalid Book!');
                location.href='form.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Failed to retrieve book information!');
            location.href='form.php';
        </script>
        ";
    }
}
?>
