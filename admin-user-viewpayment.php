<?php
    include "connect.php";
    $query2 = "SELECT * from borrow;";
                         $query_run2 = mysqli_query($con, $query2);
                         
                        $roz = mysqli_fetch_assoc($query_run2);
                                    $one = $roz['status_b'];
                                     $six = $roz['borrow_date'];
                                     $date = $roz['approval_date'];
                                     $pena = $roz['penalty'];
                                    $return_date = $roz['return_date'];

    $payment = $_POST['txtpayment'];
    $id = $_GET['borrowid'];

    if($payment >= $pena){

        $sql = "UPDATE borrow set penalty = '0.00', status_b = 'Paid' where borrow_id = $id";
        mysqli_query($con, $sql);
        echo "<script>
                alert('Payment for penalty processed successfully!');
                location.href='admin-user.php';
                </script>";
    }
    else{
        echo "<script>
                alert('Insufficient amount!');
                location.href='admin-user.php';
                </script>";
    }

?>