<?php
// users-borrow-code.php

include "connect.php";
session_start();


if (isset($_POST['txtsubmit'])) {
    $id = $_GET['updateid'];
    $CATE = $_GET['categoryid'];
    $quantityToBorrow = $_POST['txtnum'];

    // Get user's current borrowed books count
    $userID = mysqli_real_escape_string($con, $_SESSION['auth_user']['FullName']);
    $userBorrowedBooksCountQuery = "SELECT BorrowedBooksCount FROM user_info WHERE User_FName = ?";
    $stmt = mysqli_prepare($con, $userBorrowedBooksCountQuery);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $userBorrowedBooksCountResult = mysqli_stmt_get_result($stmt);
    $userBorrowedBooksCount = mysqli_fetch_assoc($userBorrowedBooksCountResult)['BorrowedBooksCount'];

    // Get book information based on book_ID
    $sql = "SELECT * FROM book_info WHERE book_ID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $selectedBookName = $row['book_Name'];
    $selectedBookCate = $row['book_Category'];
    $selectedBookAut = $row['book_Author'];

    // Check if user can borrow more books
    $allowedBooksToBorrow = 5 - $userBorrowedBooksCount;

    if ($quantityToBorrow <= $allowedBooksToBorrow) {
        // Proceed with the borrowing process
        $newBorrowedBooksCount = $userBorrowedBooksCount + $quantityToBorrow;
        $pending = "Pending";
        if ($newBorrowedBooksCount <= 5) {
            // Update the user_info table to reflect the new borrowed books count
            $updateUserInfoQuery = "UPDATE user_info SET BorrowedBooksCount = ? WHERE User_FName = ?";
            $stmt = mysqli_prepare($con, $updateUserInfoQuery);
            mysqli_stmt_bind_param($stmt, "ss", $newBorrowedBooksCount, $userID);
            mysqli_stmt_execute($stmt);

            $borrowInsertQuery = "INSERT INTO borrow (book_name, book_Cat, book_Aut, quantity, status_info) VALUES (?, ?, ?, ?, 'Pending')";
            $stmt1 = mysqli_prepare($con, $borrowInsertQuery);
            mysqli_stmt_bind_param($stmt1, "sssi", $selectedBookName, $selectedBookCate, $selectedBookAut, $quantityToBorrow);
            mysqli_stmt_execute($stmt1);

            // Update other necessary tables or perform additional actions as needed
            // ...

            // Redirect or display success messagelocation.href='users-borrow.php?updateid=$id&categoryid=$CATE'
            echo "<script>alert('Borrow Books Successfully!'); location.href='user.php';</script>";
            exit;
        } else {
            // Display an error message that the user has reached the borrowing limit
            echo "<script>alert('You can only borrow up to 5 books.'); location.href='users-borrow.php?updateid=$id&categoryid=$CATE';</script>";
            exit;
        }
    } else {
        // Display an error message that the user has reached the borrowing limit
        echo "<script>alert('You can only borrow up to $allowedBooksToBorrow more books.'); location.href='user.php';</script>";
        exit;
    }
}
?>
