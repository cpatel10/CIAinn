<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$phone=$_POST['phone'];
	$email = $_POST['email'];
	$pswd= $_POST['pswd'];
	$userPwdHash = password_hash($pswd,PASSWORD_DEFAULT);


try {
		$sql = "SELECT email FROM customer WHERE email = '$email'";
   		$result = $pdo->query($sql);
    		if($result->rowCount() >=1) {		
			header('Location: login.php?userNameExists=true');
			exit();
		} 
	} catch (PDOException $e) {
    		$error = 'Error retrieving user information: ' . $e->getMessage();
    		include 'error.html.php';
    		exit();
  	}


	try {
    		$sql = 'INSERT INTO customer SET
				fname= :fname,
				lname= :lname,
				phone= :phone,
        		email = :email,
        		pswd = :pswd';


    		$s = $pdo->prepare($sql);
			$s->bindValue(':fname', $fname);
			$s->bindValue(':lname', $lname);
			$s->bindValue(':phone', $phone);
    		$s->bindValue(':email', $email);
    		$s->bindValue(':pswd', $userPwdHash);
    
    		$s->execute();
  	} catch (PDOException $e) {
    		$error = 'Error adding new user: ' . $e->getMessage();
    		include 'error.html.php';
    		exit();
  	}
	
	header('Location: customerProfile.php');

?>

