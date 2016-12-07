<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
  </head>
  <body>
    <p>
      	<?php
      	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';

      	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';




	  	$email1 = $_POST['email1'];
	  	try {
	  		$sql = "SELECT * FROM customer WHERE email = '$email1'";
    		$result = $pdo->query($sql);
    		if($result->rowCount() == 0) {
    			header('Location: login.php?userNotFound=true');
				
  				exit();
			}
			else {
				$userpwd = $_POST['pwd'];
	  			$userEnteredPwdHash = password_hash($userpwd,PASSWORD_DEFAULT);
	  			$row = $result->fetch();
	  			$userhash = $row['pswd'];
	  		} 
  		}  catch (PDOException $e)  {
    		$error = 'Error retrieving user login information: ' . $e->getMessage();
    		include 'error.html.php';
    		exit();
  		}
	
	  	if (password_verify($userpwd, $userhash)){
			setcookie('username', $email1, time()+ 7200); // 2 hours
	  		header('Location: customerProfile.php');
			exit();
	  	} else {
	  		header('Location: login.php?passwordIncorrect=true');
			exit();
	  	}
      ?>
    </p>
    <p><a href="index.php"><?php echo $link; ?></a></p>
  </body>
</html>
