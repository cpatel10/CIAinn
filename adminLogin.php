<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="../CIAinn/main.js"></script>
    <title>Admin-joinUS</title>
</head>
<body>

<header style="border-bottom:black 1px solid;">
    <h1><a href="index.php">CIAinn</a></h1>
    </header>
	
	
<?php
      if (isset($_GET['userNotFound']) && $_GET['userNotFound']) {
        echo "<p>Login information is invalid!</p>";
      }
      elseif(isset($_GET['userNameExists']) && $_GET['userNameExists']) {
         echo "<p>Username already exists! Please use another username or login.</p>";
      }
	  elseif(isset($_GET['logout'])){
		  session_unregister('email1');		  
	  }
    ?> 

    <section id="joinus">
	
	
	    <div id="login">
        <h3>Admin Login</h3>
            <form action="admin.php" method="post" >
                <label for="email1">Email : </label>
                <input class="logInTextField" type="text" id="email1" name="email1" required /><br><br>
                <label for="pwd">Password : </label>
                <input class="logInTextField" type="password" id="pwd" name="pwd" required/><br><br><br>
                <div id="submit"><input type="submit" value="Login" style="float:left; width: 30%"></div>

            </form>

            </div>

        <div id="signup">
            <h3>Admin Registration</h3>
            <form action="newAdmin.php" method="post">

                <label for="fName">First Name : </label>
                <input class="textField" type="text" id="fname" name="fname" required/><br><br>
                <label for="lName">Last Name : </label>
                <input class="textField" type="text" id="lName" name="lname" required/><br><br>
                <label for="email">Email : </label>
                <input class="textField" type="text" id="email" name="email" required/><br><br>
                <label for="pswd">Password : </label>
                <input class="textField" type="password" id="pswd" name="pswd" required/></br><br><br>
                <div id="submit1"><input type="submit" value="Sign up" style="float:left; width: 30%"></div>
                 </form>
        </div>
        </section>

<div id="footer" style="text-align: center">
    <p>©2016 CIA Inn, Inc. All rights reserved.</p>
</div>

</body>

</html>