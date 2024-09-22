<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Company Register</title>
    <link rel="icon" href="../img/career-plus-logo-v.png" type="image/icon-type" />
    <link rel="stylesheet" href="../css/com_register.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-box">
            <h1>Create Account</h1>
            <form action="./dbh/com-register.php" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <input type="text" placeholder=" Full Name" name="fullName" required>
                    <input type="password" id="password" placeholder="Password" name="Password" required>
                </div>


                <div class="input-box">
                    <input type="text" placeholder="Company Name" name="companyName" required>
                    <input type="password" id="confpassword" placeholder="Confirm Password" name="confirmPassword"
                        required>
                </div>

                <div class="input-box">
                    <input type="email" placeholder="Email" name="Email" required>
                    <input type="text" placeholder="Phone Number" name="phoneNumber" required>
                </div>

                <div class="input-box">
                    <input type="text" placeholder="WebSite" name="webSite" required>
                    <input type="text" placeholder="Country" name="country" required>
                </div>

                <div class="input-box">
                    <textarea name="Introduction" rows="7" cols="90" placeholder="Brief Introduction about your company"
                        name="Introduction" required></textarea>
                </div>
                <div class="input-box">
                    <span>Add Company Logo hereby</span>
                    <input type="file" name="logo" required>
                </div>


                <div class="confirm">
                    <p><input type="checkbox" required><b>I hereby declare the above information provided is true and
                            correct</b></p>
                </div>

                <div>
                    <button type="submit" class="btn">Register</button></a>
                </div>
            </form>
        </div>
        <img src="../img/com_register.jpg" alt="register img">
    </div>

</body>

</html>