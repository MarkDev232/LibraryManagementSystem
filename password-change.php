<div>
    <a id="back-btn" href="index.html">X</a>
    <form action="password-reset-code.php" method="POST" class="forms" enctype="multipart/form-data">
        <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
        <h2>Change Password</h2>
        <input id="text" type="email" name="txtemail" value="<?php if(isset($_GET['User_Email'])){echo $_GET['User_Email'];} ?>" placeholder="Enter Your Email">
        <input  id="text"type="password" name="txtpass" placeholder="Enter New Password">
        <input id="text" type="password" name="txtpass1" placeholder="Enter Confirm Password">
        <input id="btn1" type="submit" name="submitchange" value="Save Changes">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>