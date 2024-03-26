<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sellbtn"])) {
        // Get values from the form
        $item_id = $_POST["item_id"];
        // $item_id = $_GET['item_id'];
        $quantity_sold = $_POST["quantity_sold"];

        // Get item details from the items table
        $item_query = "SELECT book_Name,book_Price,book_Qty FROM book_info WHERE book_ID = '$item_id'";
        $item_result = $con->query($item_query);

        if ($item_result->num_rows > 0) {
            $item_row = $item_result->fetch_assoc();
            $item_name = $item_row["book_Name"];
            $item_price = $item_row["book_Price"];

            $available_quantity = $item_row["book_Qty"];

            // Check if there is enough quantity to sell
            if ($quantity_sold <= $available_quantity) {
                // Calculate total price
                $total_price = $quantity_sold * $item_price;  // You may need to adjust this based on your pricing logic

                // Insert order into the orders table
                $insert_query = "INSERT INTO orders (prod_id, prod_name, prod_qty, prod_price, Total_price) 
                                 VALUES ('$item_id', '$item_name', '$quantity_sold', '$item_price', '$total_price')";
                $con->query($insert_query);

                // echo "Order successfully placed.";
                echo "<script>alert('Order successfully placed'); location.href='admin-sale.php';</script>";
            } else {
                echo "Not enough quantity available.";
            }
        } else {
            // echo "Item not found.";
            echo "<script>alert('Item not found.'); location.href='admin-sale.php';</script>";
        }
    }
}
?>
