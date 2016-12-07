<?php

		include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
        include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';
		
		
if (isset($_GET['addRoom']))
{
  try
  {
    $sql = 'UPDATE Room SET isAvailable = 1 Where RoomNo = :roomno';
    $s = $pdo->prepare($sql);
    $s->bindValue(':roomno', $_POST['roomno']);
    $s->execute();
	
  }
	
  catch (PDOException $e)
  {
    $error = 'Error adding room: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  } 
  
}
		
if (isset($_GET['removeRoom']))
{
  try
  {
    $sql = 'UPDATE Room SET isAvailable = 0 Where RoomNo = :roomno';
    $s = $pdo->prepare($sql);
    $s->bindValue(':roomno', $_POST['roomno']);
    $s->execute();
	
  }
	
  catch (PDOException $e)
  {
    $error = 'Error removing room: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  } 
  
}

if (isset($_POST['roomno']))
{
  try
  {
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
  }
  catch (PDOException $e)
  {
    $error = 'Error adding new ROOM: ' . $e->getMessage();
    include 'error.html.php';
    exit();
  }
  header('Location: .');
  exit();
}



try
{
  $sql = 'SELECT * FROM room where isAvailable=1';
  $result = $pdo->query($sql);
}
catch (PDOException $e)
{
  $error = 'Error fetching rooms: ' . $e->getMessage();
  include 'error.html.php';
  exit();
}
include 'adminProfile.html.php';
?>
