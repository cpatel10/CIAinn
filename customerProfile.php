<?php

		include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';

$email = $_COOKIE['username'];
debug_to_console('user email: ' . $email);

try {
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


try{
    $sqlInfo="SELECT * FROM customer WHERE customerID='$customerId' ";
    $info=$pdo->query($sqlInfo);

} catch (PDOException $e){
    $error = 'Error fetching customer details: ' . $e->getMessage();
    include 'error.html.php';
    exit();

}

try{
    $sqlRes="SELECT * FROM reservation WHERE customerID='$customerId' ";
    $res=$pdo->query($sqlRes);

} catch (PDOException $e){
    $error = 'Error fetching reservation details: ' . $e->getMessage();
    include 'error.html.php';
    exit();

}

// Delete address

if (isset($_GET['deleteAdd']))
{
    $addressID=$_POST['addressID'];
    try {
        $sqlCheck = "SELECT * FROM creditcard where addressID= '$addressID'";
        $sCheck = $pdo->query($sqlCheck);
        $num=$sCheck->rowCount();
        debug_to_console('rows:' .$num);
        if ($sCheck->rowCount()==0) {

            try{
                $sqlDeleteAdd="DELETE FROM address WHERE addressID=:addressID";

                $deleteAdd=$pdo->prepare($sqlDeleteAdd);
                $deleteAdd->bindValue(':addressID', $_POST['addressID']);
                $deleteAdd->execute();

                echo "<script>alert('Address deleted!!')</script>";
            }
            catch(PDOException $e){
                $error = 'Error deleting address information: ' . $e->getMessage();
                include 'error.html.php';
                exit();

            }

        }
 else {
        echo"<script>alert('This Address cannot be deleted as it is used as billing address!!')</script>";
        }
    }

    catch (PDOException $e)
    {
        $error = 'Error checking address information: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }


}

// Add Address to logged in customer
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

}

// Load addresses for logged in customer
try{
    $sqlLoadAddress="SELECT * FROM address WHERE customerID='$customerId' ";
    //$loadAddress=$pdo->query($sqlLoadAddress);
    $s = $pdo->prepare($sqlLoadAddress);
    $s->execute();
    $loadAddress=$s->fetchAll();

    //debug_to_console("num of addresses: " . $loadAddress->rowCount());
    debug_to_console("num of addresses: " . count($loadAddress));

} catch (PDOException $e){
    $error = 'Error fetching address: ' . $e->getMessage();
    include 'error.html.php';
    exit();

}



//if (isset($_POST['cardNumber'])) {
//
//    $cardNumber = $_POST['cardNumber'];
//    $cardHolderName = $_POST['cardHolderName'];
//    $cvv = $_POST['cvv'];
//    $expireMM = $_POST['expireMM'];
//    $expireYY = $_POST['expireYY'];
//    $addressID = $_POST['addressID']
//
//    $sqlCard = 'INSERT INTO creditcard SET
//    			cardnumber = :cardNumber,
//				customerID= :customerID,
//				addressID= :addressID,
//				cardholdername= :cardHolderName,
//        		cvv = :cvv,
//        		expirymm = :expireMM,
//        		expiryyy = :expireYY';
//
//
//    $sc = $pdo->prepare($sqlCreditCard);
//    $sc->bindValue(':cardNumber', $cardNumber);
//    $sc->bindValue(':customerID', $customerId);
//    $sc->bindValue(':cardHolderName', $cardHolderName);
//    $sc->bindValue(':cvv', $cvv);
//    $sc->bindValue(':expireMM', $expireMM);
//    $sc->bindValue(':expireYY', $expireYY);
//
//    $scc->execute();
//
//
//
//
//
//}

// cancel reservation
if (isset($_POST['cancelreservation'])){
    $today=date("Y-m-d");
    $sd=$_POST['startdate'];
    $reservationID=$_POST['reservationID'];
    debug_to_console('todays date' .$today);
    debug_to_console('res id' .$reservationID);
   if (strtotime($today) > strtotime($sd)){
       echo "<script>alert('This reservation cannot be canceled as it has passed the start date!!')</script>";
   }

   else{

       $sqlDeleteRes='DELETE FROM reservation where reservationID= :reservationID';
       $dRes=$pdo->prepare($sqlDeleteRes);
       $dRes->bindValue(':reservationID', $reservationID);
       $dRes->execute();
       echo "<script>alert('The reservation has been canceled. The amount will be reimbursed to your account in 2-3 working days.')</script>";

   }


}
    include 'customerDetails.html.php';


		
?>