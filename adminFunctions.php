<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';

session_start();

if (isset($_GET['editReservation'])) {
    $reservationIdToEdit = $_POST['reservationId'];

    // get customer id
    try {
        include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';

        $sql = "SELECT customerID FROM reservation WHERE reservationID = '$reservationIdToEdit'";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        $customerId = $row['customerID'];
    } catch (PDOException $e) {
        $error = 'Error retrieving customer id: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    try {
        $sql = 'UPDATE reservation SET
            roomno = :roomno,
            startdate = :startdate,
            enddate = :enddate,
            noofguests = :noofguests
        Where reservationID = :reservationId';

        $s = $pdo->prepare($sql);
        $s->bindValue(':roomno', $_POST['roomNoReserved']);
        $s->bindValue(':startdate', $_POST['checkInReserved']);
        $s->bindValue(':enddate', $_POST['checkOutReserved']);
        $s->bindValue(':noofguests', $_POST['noOfGuestsReserved']);
        $s->bindValue(':reservationId', $reservationIdToEdit);

        $s->execute();

    } catch (PDOException $e) {
        $error = 'Error updating reservation: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }

    try  {
        $sql = 'INSERT INTO reservationlog SET
            reservationId = :reservationId,
            customerID = :customerID';

        $s = $pdo->prepare($sql);
        $s->bindValue(':reservationId', $reservationIdToEdit);
        $s->bindValue(':customerID', $customerId);

        $s->execute();

    } catch (PDOException $e) {
        $error = 'Error creating reservation log: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}


if (isset($_GET['addRoom'])) {
    try {
        $sql = 'UPDATE Room SET isAvailable = 1 Where RoomNo = :roomno';
        $s = $pdo->prepare($sql);
        $s->bindValue(':roomno', $_POST['roomno']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error adding room: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}

if (isset($_GET['removeRoom'])) {
    try {
        $sql = 'UPDATE Room SET isAvailable = 0 Where RoomNo = :roomno';
        $s = $pdo->prepare($sql);
        $s->bindValue(':roomno', $_POST['roomno']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error removing room: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}

if (isset($_POST['roomno'])) {
    try {
        $sql3 = 'INSERT INTO room SET
            roomno = :roomno,
            adminID = :adminID,
            bedsize = :bedsize,
            smokingallowed= :smokingallowed,
    		noofbeds = :noofbeds,
    		noofguests = :noofguests,
    		noofbathroom = :noofbathroom,
    		isAvailable = :isAvailable,
    		price = :price';
        $s1 = $pdo->prepare($sql3);
        $s1->bindValue(':roomno', $_POST['roomno']);
        $s1->bindValue(':adminID', $_POST['adminID']);
        $s1->bindValue(':bedsize', $_POST['bedsize']);
    	$s1->bindValue(':smokingallowed', $_POST['smokingallowed']);
    	$s1->bindValue(':noofbeds', $_POST['noofbeds']);
        $s1->bindValue(':noofguests', $_POST['noofguests']);
    	$s1->bindValue(':noofbathroom', $_POST['noofbathroom']);
    	$s1->bindValue(':isAvailable', $_POST['isAvailable']);
    	$s1->bindValue(':price', $_POST['price']);
        $s1->execute();
    } catch (PDOException $e) {
        $error = 'Error adding new ROOM: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
    header('Location: .');
    exit();
}

if (isset($_GET['checkIn'])) {
    try  {
        $sql = 'UPDATE reservation SET checkinstatus = 1 Where reservationID = :reservationId';
        $s = $pdo->prepare($sql);
        $s->bindValue(':reservationId', $_POST['reservationIdCheckIn']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error adding room: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}

if (isset($_GET['checkOut'])) {
    try  {
        $sql = 'UPDATE reservation SET checkoutstatus = 1 Where reservationID = :reservationId';
        $s = $pdo->prepare($sql);
        $s->bindValue(':reservationId', $_POST['reservationIdCheckOut']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Error adding room: ' . $e->getMessage();
        include 'error.html.php';
        exit();
    }
}


try {
    $sql = 'SELECT * FROM room where isAvailable=1';
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    $error = 'Error fetching rooms: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}


try{
    $sqlroomcount='SELECT Count(roomno) as Total_rooms FROM room where isAvailable=1';
    $resultRC = $pdo->query($sqlroomcount);
    $rc=$resultRC->fetch();
    $totalRoom=$rc['Total_rooms'];
} catch(PDOException $e) {
    $error= 'Error fetching available room count: '.$e->getMessage();
    include 'error.html.php';
    exit();
}

try {
    $sql = 'select sum(rm.price * datediff(enddate, startdate)) as benefit from reservation r join room rm on r.roomno = rm.roomno';
    $benefitresult = $pdo->query($sql);
    $benefitrow = $benefitresult->fetch();
    $benefitcol = $benefitrow['benefit'];
} catch (Exception $e) {
    $error = 'Error fetching rooms: ' . $e->getMessage();
    include 'error.html.php';
    exit();
}


include 'adminProfile.html.php';
?>
