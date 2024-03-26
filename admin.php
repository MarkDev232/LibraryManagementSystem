<?php
    include "connect.php";
    session_start();
    if(!isset($_SESSION['auth_admin']['adminFullName'])) {
        // Kung wala, ireredirect sa login page
        echo "<script> alert('Please Login First');
        location.href='login.php';</script>";
        exit();
       
    }
    

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        *{
    margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', Courier, monospace;
}

nav{
    width: 250px; /*300*/
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background-color: #607274;
    /* border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
    box-shadow: 0 0 5px 3px rgb(0, 0, 0, 0.5); */
}

.brand-container{
    text-align: center;
    color: white;
    font-family: Verdana;
    padding: 20px 0;
}

.brand-title{
    margin: 0;
    margin-top: 0px; /*15px*/
    font-family: Castellar;
}

.link{
    display: block;
    color: white;
    padding: 12px 25px;
    text-decoration: none;
    margin: 10px 0;
    font-family: Verdana;
    transition: 0.2s;
    /*text-align: center;*/
}

.link:hover{
    background-color: white;
    color: rgb(30, 30, 30);
}

.profile-container{
    color: white;
    font-family: Verdana;
    margin: 0;
    padding: 12px 25px;
    position: absolute;
    bottom: 0;
    margin-bottom: 10px;
    text-align: center;
}

.brand-btn{
    padding: 10px 70px;
    background-color: rgb(30, 30, 30);
    border-radius: 15px;
    color: white;
    font-family: Verdana;
    transition: 0.2s;
    margin-top: 15px;
    
}

.brand-btn:hover{
    background-color: #f9f5e8;
    color: black;
}

body{
    background: #E0E1E4; 
}
.main-container{
    margin-left: 250px;
    /* margin-top: 25px; */
    /* background: #E0E1E4; */
    box-shadow: 0 0 2px 1px rgb(0, 0, 0, 0.4);
    background-color: #DED0B6;
}

.header-title{
    width: 100%;
    height: 50px;
    background: white;
    text-align: start;
    padding: 20px 0 0 20px;
}

/* .profile-logo{
    position: absolute;
    margin-left: 1180px;
    margin-top: -60px;

} */

/* .dashboard-links{
    display: flex;  
}

.dash-container{
    position: absolute;
    width: 300px;
    height: 150px;
    background: white;
    margin: 200px 0 0 500px;
} */

.dashboard-container{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    margin-left: 250px;
    margin-top: 30px;
}

.dash-list{
    width: 260px;
    height: 180px;
    background: #f9f5e8;
    border: 1px solid rgb(0, 0, 0, 0.4);
    border-radius: 10px;
    display: flex;
    color: black;
}



.left{
    width: 50%;
    margin: 10px 20px;
}

.left h3{
    padding-bottom: 50px;
    font-size: 30px;
}

.rigth{
    width: 70%;
    margin: 70px 50px 50px -70px;
    
}
img{
    width: 80px;
}


/*user table*/
.table-container{
    width: 1170px;
    height: 550px;
    background: white;
    margin-left: 300px;
    margin-top: 100px;
    border-radius: 10px;
    position: absolute;
    box-shadow: 0 0 2px 1px rgb(0, 0, 0, 0.2);
}

.info{
    width: 1170px;
    height: 620px;
    background: white;
    margin-left: 300px;
    margin-top: 40px;
    border-radius: 10px;
    position: absolute;
    box-shadow: 0 0 2px 1px rgb(0, 0, 0, 0.2);
}

.add-item{
    width: 120px;
    height: 20px;
    padding: 10px;
    background: white;
    margin-left: 300px;
    margin-top: 35px;
    position: absolute;
    border-radius: 10px;
    box-shadow: 0 0 2px 1px rgb(0, 0, 0, 0.2);
}

.add-item a{
    text-decoration: none;
    color: black;
}

.tables{
    margin-top: 20px;
}
.tables table{
    background: white;
}


/* .tables table,tr,td{
    padding: 0 20px;
} */
/*add-pop*/
.add-pop{
    margin-top: 20px;
    /* margin-left: 230px; */
    width: 100px;
    height: 30px;
    background: white;
    text-align: center;
    padding-top: 10px;
}
.add-pop a{
    text-decoration: none;
    color: black;

}

/*pop cointainer add*/
.pop{
    width: 1250px;
    height: 650px;
    background: white;
    position: absolute;
    margin-top: 100px;
    margin-left: 260px;
    /* text-align: center; */
}
.pop input,select,h3{
    width: 1100px;
    height: 30px;
    margin-left: 70px;
}

.pop label{
    margin-left: 70px;
}
#back{
    /* padding-top: 30px; */
    margin-left: 1220px;
    text-decoration: none;
    color: black;
}

/*settings*/
.container-info{
    width: 500px;
    height: 550px;
    background: white;
    margin: 0 auto;
    /* text-align: center; */
}
.container-info h3{
    margin: 0 0 0 40px ;
    padding: 10px 0;

}

.container-info form,input{
    width: 400px;
    margin-left: 20px;
    height: 40px;
}
.container-info label{
    margin-left: 20px;
}
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="brand-container">
                <img src="image/mainlogo.png" alt="My Personal Logo" width="60px">
                <h2 class="brand-title">ADMIN-LIBRARY</h2>
            </div>

            <div class="brand-title">
                <a class="link" href="admin.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                <a class="link" href="admin-user.php"><i class="fa fa-user"></i> Users</a>
                <a class="link" href="admin-category.php"><i class="fa fa-category"></i> Category</a>
                <a class="link" href="admin-book.php"><i class="fa fa-book"></i> Books</a>
                <a class="link" href="admin-sale.php"><i class="fa fa-repeat"></i> Sales</a>
                <a class="link" href="admin-reports.php"><i class="fa fa-receipt"></i> Reports</a>
                <a class="link" href="admin-setting.php"><i class="fa fa-gear"></i> Settings</a>
                <a class="link" href="login.php"><i class="fa fa-user"></i> Logout</a>
            </div>

            <!-- <div class="profile-container" class="brand-title">
                <p>Hi,</p>
                <button class="brand-btn">Logout</button>
                <a class="link" href="login.html"><i class="fa fa-user"></i> Logout</a>
            </div> -->
        </nav>
    </header>

    <section>
        <div class="main-container">
            <div class="header-title">
                <h2>Dashboard</h2>
            </div>
            <!-- <div class="profile-logo">
                <a href="settings.html">
                    <img src="image/icons8-user-50.png" alt="">
                </a>
            </div> -->
        </div>
        
        <div class="dashboard-container">
            <div class="dash-list">
                <div class="left">
                    <h3>Users</h3>
                    <p id='uservalue'>1</p>
                </div>
                <?php
        $sql22 = "SELECT count(*) as count FROM `user_info`";
        $result22 = mysqli_query($con, $sql22);
                 if(mysqli_num_rows($result22) > 0){
                     while ($row = mysqli_fetch_assoc($result22)) {
                         $countt = $row['count'];
                         
                         echo"<script> document.getElementById('uservalue').innerHTML = $countt</script>";
                     }
                 }
        ?>
                <div class="rigth">
                    <img src="image/icons8-people-50.png" alt="">
                </div>
            </div>
            
            <div class="dash-list">
                <div class="left">
                    <h3>Books</h3>
                    <p id="book-value">1</p>
                </div>
                 <?php
        $sql22 = "SELECT count(*) as count FROM `book_info`";
        $result22 = mysqli_query($con, $sql22);
                 if(mysqli_num_rows($result22) > 0){
                     while ($row = mysqli_fetch_assoc($result22)) {
                         $countt = $row['count'];
                         
                         echo"<script> document.getElementById('book-value').innerHTML = $countt</script>";
                     }
                 }
        ?>
                <div class="rigth">
                    <img src="image/book.png" alt="">
                </div>
            </div>
            <div class="dash-list">
                <div class="left">
                    <h3>Borrow</h3>
                    <p id="borrow-value">0</p>
                </div>
                <?php
        $sql22 = "SELECT count(*) as count FROM `borrow`";
        $result22 = mysqli_query($con, $sql22);
                 if(mysqli_num_rows($result22) > 0){
                     while ($row = mysqli_fetch_assoc($result22)) {
                         $countt = $row['count'];
                         
                         echo"<script> document.getElementById('barrow-value').innerHTML = $countt</script>";
                     }
                 }
        ?>
                <div class="rigth">
                    <img src="image/icons8-borrow-book-50.png" alt="">
                </div>
            </div>
            <div class="dash-list">
                <div class="left">
                    <h3>Return</h3>
                    <p>1</p>
                </div>
                <div class="rigth">
                    <img src="image/books-return.png" alt="">
                </div>
            </div>
        </div>
        
        <!-- <div class="dashboard-links">
            <div class="dash-container">
                <div class="left">
                    <h5>Users</h5>
                    <p>1</p>
                </div>
                <div class="rigth"></div>
            </div>
            <div class="dash-container">
                <div class="left">
                    <h5>Books</h5>
                    <p>1</p>
                </div>
                <div class="rigth"></div>
            </div>
            <div class="dash-container">
                <div class="left">
                    <h5>Return</h5>
                    <p>1</p>
                </div>
                <div class="rigth"></div>
            </div>
            <div class="dash-container">
                <div class="left">
                    <h5>Not Return</h5>
                    <p>1</p>
                </div>
                <div class="rigth"></div>
            </div>
        </div> -->
    </section>
    
</body>
</html>