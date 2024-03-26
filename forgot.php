<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
            height: 450px;
            background-color: #607274;
            opacity: 0.6;
            border-radius: 2%;
            box-shadow: 7px 54px 86px -32px rgba(0,0,0,0.75);
            -webkit-box-shadow: 7px 54px 86px -32px rgba(0,0,0,0.75);
            -moz-box-shadow: 7px 54px 86px -32px rgba(0,0,0,0.75);
        
        }
        #back-btn{
            text-decoration: none;
            font-size: 30px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            margin-left: 20px;
            color: white;
            border-radius: 50%;
            background-color: black;
            padding: 5px 10px 5px 10px;
            margin-top: 10px;
            position: absolute;
        }
        h2{
            padding-top: 80px;
            font-size: 40px;
            text-align: center;
            color: white;
        }
        input[type=email]{
            font-size: 20px;
            margin-left: 120px;
            margin-top: 10px;
            border: 2px solid black;
            color: black;
            font-weight: bold;
            height: 30px;
            width: 65%;
        }
        input[type=submit]{
            margin-left: 270px;
            margin-top: 20px;
            height: 40px;
            width: 120px;
            padding: auto 10px auto 10px;
            font-size: 20px;
            background-color: transparent;
            font-weight: bold;
        }
        input[type=submit]:hover{
            background-color: white;
            color: black;
            
        }
        p{
            text-align: center;
            padding-top: 20px;
        }
        p a{
            color: white;
            text-decoration: none;
        }
        p a:hover{
            color: blue;
        }
        .enter-email-p{
            font-size: 20px;
        }
    </style>
</head>
<body>
    
</body>
</html>
<div class='container'>
    <a id="back-btn" href="login.php">X</a>
    <form action="password-reset-code.php" method="POST" class="forms" enctype="multipart/form-data">
        <h2 >Forgot Password</h2>
        <p class='enter-email-p'>Enter your email address</p><br> <br>
        <input id="text" type="email" name="txtemail" placeholder="Enter email address"> <br>
        <input id="btn1" type="submit" name="submitforgot" value="Continue"><br><br>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>