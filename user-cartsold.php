<?php
    include "connect.php";
    session_start();

    if(isset($_POST["processbtn"])){
        // Makuha ang impormasyon mula sa shopping cart
        $cart_query = "SELECT * FROM addtocart";
        $cart_result = mysqli_query($con, $cart_query);

        if (mysqli_num_rows($cart_result) > 0) {
            while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                if (isset($cart_row['book_ID'])) {
                    $book_ID = $cart_row['add_ID'];
                    $book_Qty = $cart_row['add_qty'];

                    // Debugging line
                    echo "book_ID: $book_ID, book_Qty: $book_Qty<br>";

                    // Ma-update ang SoldCount sa book_info
                    $update_sold_count_sql = "UPDATE book_info SET SoldCount = SoldCount + $book_Qty,book_Qty = book_Qty - $book_Qty  WHERE book_ID = $book_ID";

                    // Debugging line
                    echo "Query: $update_sold_count_sql<br>";

                    $query_result = mysqli_query($con, $update_sold_count_sql);

                    if ($query_result) {
                        echo "Query successful<br>";
                    } else {
                        echo "Query failed: " . mysqli_error($con) . "<br>";
                    }
                }
            }

            // I-clear ang shopping cart
            mysqli_query($con, "TRUNCATE TABLE addtocart");

            echo "<script> alert('Process Successfully!');
                    location.href='user-cart.php';</script>";
        } else {
            echo "No rows found in addtocart table.";
        }
    }
?>
