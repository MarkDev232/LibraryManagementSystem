<?php
include "connect.php";

$borrow_id = $_GET['borrowid'];
$id = $_GET['user'];

    // Get information about the borrowed book
    $select_query = "SELECT * FROM borrow WHERE borrow_id = $borrow_id";
    $select_query_run = mysqli_query($con, $select_query);
   
    
    if ($select_query_run) {
        $borrowed_book = mysqli_fetch_assoc($select_query_run);

        // Update the BookCount in book_info
        $book_name = $borrowed_book['book_name'];
        $quantity = $borrowed_book['quantity'];

        $update_book_query = "UPDATE book_info SET BorrowCount = BorrowCount + $quantity WHERE book_name = '$book_name'";
        $update_book_query_run = mysqli_query($con, $update_book_query);

        $user_update = "UPDATE user_info set BorrowedBooksCount = BorrowedBooksCount - $quantity where User_ID = $id";
        $user_update_run = mysqli_query($con, $user_update);

        if ($update_book_query_run) {
            // Delete the record from the borrow table


            $delete_query = "DELETE FROM borrow WHERE borrow_id = $borrow_id";
            $delete_query_run = mysqli_query($con, $delete_query);

            if ($delete_query_run) {
                // echo 'Book returned successfully.';
                // echo '
                // <script>
                // alert("Book returned successfully");
                // href.location="admin-dashboard-view.php";
                // <script>
                // ';
                echo "<script>
                alert('Book returned successfully');
                location.href='admin-user.php';
                </script>";
            } else {
                // echo 'Error deleting record from borrow table.';
                echo "<script>
                alert('Error deleting record from borrow table.');
                location.href='admin-user.php';
                </script>";
            }
        } else {
            echo 'Error updating BorrowCount in book_info.';
        }
    } else {
        echo 'Error fetching borrowed book information.';
    }



?>