<?php

		include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';

$email = $_COOKIE['username'];
debug_to_console('user email: ' . $email);

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

if (isset($_POST['addressline1'])){

    try{

    $addressline1 = $_POST['addressline1'];
    $addressline2 = $_POST['addressline2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];

    $sqlAdd = 'INSERT INTO address SET
				customerID= :customerID,
				addressline1= :addressline1,
				addressline2= :addressline2,
        		city = :city,
        		state = :state,
        		zipcode = :zipcode';



    $sadd = $pdo->prepare($sqlAdd);
    $sadd->bindValue(':customerID', $customerId);
    $sadd->bindValue(':addressline1', $addressline1);
    $sadd->bindValue(':addressline2', $addressline2);
    $sadd->bindValue(':city', $city);
    $sadd->bindValue(':state', $state);
    $sadd->bindValue(':zipcode', $zipcode);

    $sadd->execute();
}
catch (PDOException $e)
{
    $error = 'Error adding address: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}
    echo "<script>alert('Address was added Successfully!!')</script>";
//    header('Location:customerProfile.php');
   echo "<script>setTimeout(\"location.href = 'customerProfile.php';\",2000);</script>";
}

try{

    $sqlLoadAddress="SELECT addressline1, addressline2, city, state, zipcode FROM address WHERE customerID='$customerId' ";

    $loadAddress=$pdo ->query($sqlLoadAddress);

} catch (PDOException $e){
    $error = 'Error fetching address: ' . $e->getMessage();
    include 'error.html.php';
    exit();

}


//if (isset($_POST['cardNumber'])) {
//    debug_to_console('post credit card is set');
//
//    $cardNumber = $_POST['cardNumber'];
//    $cardHolderName = $_POST['cardHolderName'];
//    $cvv = $_POST['cvv'];
//    $expireMM = $_POST['expireMM'];
//    $expireYY = $_POST['expireYY'];
//
//
//
//
//
//
//}


		include 'customerDetails.html.php';


		
?>