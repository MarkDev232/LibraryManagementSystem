<?php
include "connect.php";
$invoiceid = $_GET['invoiceid'];
$bookidd = $_GET['bookid'];

    // $sqll = "SELECT * FROM orders WHERE invoice_id = $invoiceid";
    // $result1t = mysqli_query($con,$sqll);
    // if (mysqli_num_rows($result1t)< 1) {  
    //     $invoiceidi = $invoiceid + 1;
    //         $sqlll = "UPDATE orders SET invoice_id = $invoiceidi WHERE invoice_id = $invoiceid";
    //         $resultee = mysqli_query($con, $sqlll);
    // }

    if (isset($_POST['processbtn'])) {
        $subtotal = 0;
    
        // Check if the form is submitted
        if (isset($_POST['txtpayment'])) {
            // Sanitize user input
            $total = number_format($_POST['txtpayment'], 2);
    
            // Check if $total is defined and calculated correctly
            if (isset($total)) {
                $total_price = number_format($subtotal, 2);
    
                // Check if the payment is sufficient
                if ($total >= $total_price) {
                    // Get order details and update book_Qty in items for each item
                    $result1 = mysqli_query($con, "SELECT * FROM orders");
    
                    while ($rows = mysqli_fetch_array($result1)) {
                        $selectedBookName = $rows['prod_name'];
                        $quantity = $rows['prod_qty'];
    
                        // Update book_Qty in items for the specific item
                        $sql_update_qty = "UPDATE book_info SET book_Qty = book_Qty - ?, SoldCount = SoldCount + ? WHERE book_Name = ?";
                        $stmt_update_qty = mysqli_prepare($con, $sql_update_qty);
                        mysqli_stmt_bind_param($stmt_update_qty, "iss", $quantity, $quantity, $selectedBookName);
                        mysqli_stmt_execute($stmt_update_qty);

                        mysqli_query($con, "TRUNCATE TABLE orders");
    
                        // Save order details to orders table with the invoice_id
                        $sql_save_order = "INSERT INTO orders (invoice_id,prod_name, prod_qty, prod_price, Total_price) VALUES ( ?, ?, ?, ?, ?)";
                        $stmt_save_order = mysqli_prepare($con, $sql_save_order);
                        
    
                        mysqli_stmt_bind_param($stmt_save_order, "ssidd", $invoiceid, $selectedBookName, $quantity, $rows['prod_price'], $rows['Total_price']);
                        mysqli_stmt_execute($stmt_save_order);
    
                        $subtotal += $rows['Total_price'];
                    }
                    
                    // Calculate VAT
                    $vat = ($subtotal / 100) * 12;
                    $subtotal += $vat;
                    $changes = $total - $subtotal;
    
                    // Save the order details to the transaction table
                    $insert_sql = "INSERT INTO transaction (invoice_id, total_price, total_change, total_vat) VALUES (?, ?, ?, ?)";
                    $stmt = mysqli_prepare($con, $insert_sql);
                    mysqli_stmt_bind_param($stmt, "sddd", $invoiceid, $subtotal, $changes, $vat);
                    mysqli_stmt_execute($stmt);
    
                    // Redirect to a success page or do further processing
                    echo "<script>alert('Order processed successfully! Change: $changes'); location.href='admin-sale.php';</script>";
                    exit;
                } else {
                    // If payment is insufficient, redirect back to the payment page
                    echo "<script>alert('Insufficient amount!'); location.href='admin-sale.php';</script>";
                    exit;
                }
            } else {
                // Handle the case where $total is not defined or calculated correctly
                echo "<script>alert('Error: Total amount not defined.'); location.href='admin-sale.php';</script>";
                exit;
            }
        }
    }
    


?>