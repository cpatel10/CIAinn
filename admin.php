<?php
      	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';

		session_start();

	  	$email1 = $_POST['email1'];
	  	try {
	  		$sql = "SELECT * FROM admin WHERE email = '$email1'";
    		$result = $pdo->query($sql);
    		if($result->rowCount() == 0) {
    			header('Location: adminLogin.php?userNotFound=true');
  				exit();
			}
			else {
				$userpwd = $_POST['pwd'];
	  			$userEnteredPwdHash = password_hash($userpwd,PASSWORD_DEFAULT);
	  			$row = $result->fetch();
	  			$userhash = $row['password'];
	  		}
  		}  catch (PDOException $e)  {
    		$error = 'Error retrieving user login information: ' . $e->getMessage();
    		include 'error.html.php';
    		exit();
  		}

	  	if (password_verify($userpwd, $userhash)){
			$_SESSION['email1']= $email1;
			setcookie('username', $email1, time()+ 7200);
	  		header('Location: adminFunctions.php');
	  	} else {
			header('Location: adminLogin.php?passwordIncorrect=true');
			exit();
	  	}
      ?>
    </p>
    <p><a href="index.php"><?php echo $link; ?></a></p>
  </body>
</html>
