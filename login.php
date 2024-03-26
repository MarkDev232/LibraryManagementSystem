<?php
include "connect.php";
session_start();
session_destroy();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;

        }
        .container{
            margin-left: 25%;
            margin-top: 100px;
            width: 50%;
            height: 340px;
            background-color: #607274;
            opacity: 0.6;
            border-radius: 10%;
            box-shadow:  10px 1px 10px 0px ;
        }
        h3{
            padding-top: 30px;
            font-size: 40px;
            text-align: center;
            color: white;
        }
        input[type=text],input[type=password]{
            font-size: 20px;
            margin-left: 220px;
            margin-top: 10px;
            border: 2px solid black;
            color: black;
            font-weight: bold;
        }
        #link{
            margin-left: 265px;
            padding-top: 50px;;
            text-decoration: none;
            color: white;
            font-weight: bolder;
        }
        #btn3{
            margin-left: 270px;
            margin-top: 20px;
            height: 40px;
            width: 100px;
            font-size: 20px;
            background-color: transparent;
            font-weight: bold;
        }
        p{
            text-align: center;
        }
        #sign{
            margin-left: 3px;
            
        }
        #sign a{
            text-decoration: none;
            color: white;
            font-weight: bolder;
        }
        #sign a:hover{
            color: blue;
        }
        #link:hover{
            color: blue;
        }


    </style>
</head>
<body>
<div class="container">
    <form action="logincode.php" method="POST" enctype="multipart/form-data">
        <h3>Sign In</h3>
        <input id="text" type="text" name="txtuser" placeholder="Username"> <br>
        <input id="pass" type="password" name="txtpass" placeholder="Password"> <br>
        <br>
        <a id="link" href="forgot.php">Forgot Password</a> <br>
        <br>
        <p>Not have an account?</p>
        <p id='sign'><a href="register.php">Sign Up here</a></p>
        <input id="btn3" type="submit" name="submit" value="Login" formaction="logincode.php"><br>
        <!-- <button id="btn1" onclick="add()">Login</button> -->
         </p>
    </form>

</div>
    
</body>
</html>
