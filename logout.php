<?php
    session_start(); 
    $_SESSION = array();


    session_destroy();

    echo "<script>
            alert('You are Logged Out Successfully!');
            window.location.href='login.php';
          </script>";
          exit();

?>
