<?php
if (isset($_COOKIE['remember_me'])) {
    $rememberedEmail = $_COOKIE['remember_me'];
} else {
    $rememberedEmail = "";
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.0">
    <title>
        Company Log in
    </title>
    <link rel="icon" href="../img/career-plus-logo-v.png" type="image/icon-type" />
    <link rel="icon" href="img/career-plus-logo-v.png" type="image/icon-type" />
    <link rel="stylesheet" href="../css/c_style.css">
</head>

<body>
    <div class="login">
        <form action="dbh/com-login.php" method="post">
            <h1>LOG IN</h1>
            <label>Email</label>
            <input type="email" value=" <?php echo $rememberedEmail; ?> " required name="Email">
            <label> Password</label>
            <input type="password" required name="Password">
            <label>
                <div class="button-container">
                    Remember me <input type="checkbox" id="remme" name="remme">
                </div>
            </label>
            <button type="submit" class="btn" name="login">Login In</button>
            <label class="login-register">
                <div class="button-container">
                    Don't have an account?<a href="company_register.php">Register</a>
                </div>
            </label>
            <label>
                <div class="button-container">
                    Forgot password?<a href="company_forgot.html">Reset</a>
                </div>
            </label>
        </form>
        <img src="../img/com_login.jpg" alt="login img">
    </div>

</body>

</html>