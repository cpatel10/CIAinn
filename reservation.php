<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';

	// Start the session
	session_start();

	//first time reservation.php is called
	if (!isset($_SESSION["roomno"])) {
		$_SESSION["roomno"] = $_POST['roomno'];
		$_SESSION["startdate"] = $_POST['startdate'];
		$_SESSION["enddate"] = $_POST['enddate'];
		$_SESSION["guests"] = $_POST['guests'];
		$_SESSION["price"] = $_POST['price'];
	}

	// if user is not loged in
	if (!isset($_COOKIE['username'])) {
		include 'login.php';
		exit();
	}

	// if canceled reservation form
	if (isset($_GET['cancelReservationForm'])) {
		unset($_SESSION["roomno"]);
		header('Location: customerProfile.php');
    	exit();
	}

	// if payment details are submitted
	if (isset($_POST['cardNumber'])) {
		debug_to_console('post credit card is set');

		$cardNumber = $_POST['cardNumber'];
		$cardHolderName = $_POST['cardHolderName'];
		$expireMM = $_POST['expireMM'];
		$expireYY = $_POST['expireYY'];
		$cvv = $_POST['cvv'];

		$addressLine1 = $_POST['addressLine1'];
		$addressLine2 = $_POST['addressLine2'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zipCode = $_POST['zipCode'];

		$email = $_COOKIE['username'];
		debug_to_console('user email: ' . $email);

		// get customer id
		try {
			include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';

			$sql = "SELECT customerID FROM customer WHERE email = '$email'";
	   		$result = $pdo->query($sql);
	    	$row = $result->fetch();
	    	$customerId = $row['customerID'];
		} catch (PDOException $e) {
	    		$error = 'Error retrieving user information: ' . $e->getMessage();
	    		include 'error.html.php';
	    		exit();
	  	}

	  	debug_to_console('customer id: ' . $customerId);

	  	//get customers credit cards
	  	try {
			$sqlGetCreditCards = "SELECT cardnumber, cardholdername, cvv, expirymm, expiryyy,
				addressline1, addressline2, city, state, zipcode
			 	FROM creditcard LEFT JOIN address ON creditcard.addressID = address.addressID
			 	WHERE creditcard.customerID = '$customerId'";
	   		$sCreditGet = $pdo->prepare($sqlGetCreditCards);
	   		$sCreditGet->execute();
	    	$creditCards = $sCreditGet->fetchAll();
	    	debug_to_console("found credit cards: " . count($creditCards));
		} catch (PDOException $e) {
	    		$error = 'Error retrieving user information: ' . $e->getMessage();
	    		include 'error.html.php';
	    		exit();
	  	}

	  	debug_to_console("before checking credit card for equality");
	  	//check if entered credit card has been previously used
	  	$creditCardExists = FALSE;
	  	foreach ($creditCards as $record) {
	  		debug_to_console($record['cardnumber']);
	  		if ($cardNumber == $record['cardnumber']) {
	  			$creditCardExists = TRUE;
	  		debug_to_console("exact credit card found");
	  		}
	  	}

	  	debug_to_console("after checking credit card for equality: " . $creditCardExists);

	  	//insert values
	  	try {
	  		$pdo->beginTransaction();

	  		if (!$creditCardExists) {
		  		$sqlAddress = 'INSERT INTO address SET
					customerID= :customerID,
					addressLine1= :addressLine1,
					addressLine2= :addressLine2,
	        		city = :city,
	        		state = :state,
	        		zipcode = :zipcode';


	    		$sa = $pdo->prepare($sqlAddress);
				$sa->bindValue(':customerID', $customerId);
				$sa->bindValue(':addressLine1', $addressLine1);
				$sa->bindValue(':addressLine2', $addressLine2);
	    		$sa->bindValue(':city', $city);
	    		$sa->bindValue(':state', $state);
	    		$sa->bindValue(':zipcode', $zipCode);

	    		$sa->execute();

	    		$sqlCreditCard = 'INSERT INTO creditcard SET
	    			cardnumber = :cardNumber,
					customerID= :customerID,
					addressID= LAST_INSERT_ID(),
					cardholdername= :cardHolderName,
	        		cvv = :cvv,
	        		expirymm = :expireMM,
	        		expiryyy = :expireYY';


	    		$scc = $pdo->prepare($sqlCreditCard);
				$scc->bindValue(':cardNumber', $cardNumber);
				$scc->bindValue(':customerID', $customerId);
				$scc->bindValue(':cardHolderName', $cardHolderName);
	    		$scc->bindValue(':cvv', $cvv);
	    		$scc->bindValue(':expireMM', $expireMM);
	    		$scc->bindValue(':expireYY', $expireYY);

	    		$scc->execute();
    		}

    		$sqlReservation = 'INSERT INTO reservation SET
				customerID= :customerID,
				roomno = :roomNo,
				cardnumber = :cardNumber,
				startdate= :startdate,
        		enddate = :enddate,
        		checkinstatus = 0,
        		checkoutstatus = 0,
        		noofguests = :noOfGuests';


    		$sr = $pdo->prepare($sqlReservation);
			$sr->bindValue(':customerID', $customerId);
			$sr->bindValue(':roomNo', $_SESSION["roomno"]);
			$sr->bindValue(':cardNumber', $cardNumber);
			$sr->bindValue(':startdate', $_SESSION["startdate"]);
    		$sr->bindValue(':enddate',$_SESSION["enddate"]);
    		$sr->bindValue(':noOfGuests', $_SESSION["guests"]);

    		$sr->execute();

    		$pdo->commit();

			unset($_SESSION["roomno"]);

			echo '<script>alert("The reservation was made successfully!")</script>';
            echo "<script>setTimeout(\"location.href = 'customerProfile.php';\",1500);</script>";
	  	} catch (PDOException $e) {
	  			$pdo->rollBack();
	    		$error = 'Error inserting values into database: ' . $e->getMessage();
	    		include 'error.html.php';
	    		exit();
	  	}
	} else { // if payment details haven't been submitted
		include 'reservationForm.php';
	}
 ?>
