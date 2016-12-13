<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>Admin-joinUS</title>
</head>

<body>
    <div class="container">
        <div class="page-header row">
            <a class="logo" href="index.php">CIAinn</a>
        </div>

        <?php
        if(isset($_GET['userNotFound']) && $_GET['userNotFound']) {
            echo "<p>Login information is invalid!</p>";
        }
        elseif(isset($_GET['userNameExists']) && $_GET['userNameExists']) {
            echo "<p>Username already exists! Please use another username or login.</p>";
        }
        elseif(isset($_GET['passwordIncorrect']) && $_GET['passwordIncorrect']) {
            echo "<p>Password Incorrect. Please try again.</p>";
        }
        elseif(isset($_GET['logout'])){
        	session_unregister('email1');
        }
        ?>

        <div class="row top-space">
            <div class="col-lg-6">
                <h3 class="form-header">Admin Login</h3>
                <form class="form-horizontal" action="admin.php" method="post" >
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email1">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" name="email1" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="pwd">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" name="pwd" required/>
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-9">
                        <input class="btn btn-default" type="submit" value="Login">
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                <h3 class="form-header">Admin Register</h3>
                <form class="form-horizontal" action="newAdmin.php" method="post">
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="fName">First Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="fname" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="lName">Last Name</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="text" name="lname" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Email</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="email" name="email" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="pswd">Password</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password"name="pswd" required />
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-9">
                        <input class="btn btn-default" type="submit" value="Sign up" />
                    </div>
                </form>
            </div>
        </div>

        <div class="row top-space center-align">
            <footer>
                <a href="">About US</a><label>|</label>
                <a href="contact.html">Contact Us</a><label>|</label>
                <a href="">Subscribe</a><label>|</label>
                <a href="">Reviews</a><label>|</label>
                <a href="">Terms & Policies</a><label>|</label>
                <a href="">Careers</a></br>
                <copyright>©2016 CIA Inn, Inc. All rights reserved.</copyright>
            </footer>
        </div>
    </div>
</body>
</html>
