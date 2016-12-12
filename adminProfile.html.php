
<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="../CIAinn/main.js"></script>
    <title>profile</title>
</head>
  </head>
  <body>
  <?php
  include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
  
  try
{
	$sql2='SELECT adminID FROM admin';
	$result2 = $pdo->query($sql2);
}

catch(PDOException $e)
{
	$error = 'Error fetching adminID.' . $e->getMessage();
	include 'error.html.php';
	exit();
	
}
try
{
	$sql1='SELECT DISTINCT bedsize FROM room';
	$result1 = $pdo->query($sql1);
}

catch(PDOException $e)
{
	$error = 'Error fetching bedsize.' . $e->getMessage();
	include 'error.html.php';
	exit();
	
}
?>
 
   <header>
    <h1><a href="index.html">CIAinn</a></h1>
	<div id=btn>
	
	<?php
   session_start();
   echo '<br><br><button id="log_out"><a href="adminLogin.php?action=logout" style="text-decoration: none; color: black">Sign Out</a></button>';
   ?>
  </div>	
  </header>
  <div>
  <?php
echo 'Welcome ' .$_SESSION['email1'];  
?>
 <br><br>
 </div>
  
<div class="buttons">
    <a class="show" target="1">Edit Reservation</a> |
	<a class="show" target="2">Add New Room</a> |
    <a class="show" target="3">Add Room</a> |
	<a class="show" target="4">Remove Room</a> |
    <a class="show" target="5">Guest Check In</a> |
    <a class="show" target="6">Guest Check Out</a>     
</div>

 
<div id="fn1" class="adminfn">
    <h3>Edit Reservation</h3>
    <form id="editReservation" action="?editReservation" method="post">
        <label for="reservationId">Reservation ID: </label>
        <input type="number" name="reservationId" min="1" required/></br>
        <label for="roomNoReserved">Room No: </label>
        <input type="number" name="roomNoReserved" min="1" required/></br>
        <label for="checkInReserved">Check In Date: </label>
        <input type="date" name="checkInReserved" required/><br>
        <label for="checkOutReserved">Check Out Date: </label>
        <input type="date" name="checkOutReserved" required/><br>
        <label for="noOfGuestsReserved">No Of Guests: </label>
        <input type="number" name="noOfGuestsReserved" min="1" required/><br>

        <label for="changesMade">Changes Made: </label>
        <input type="text" name="changesMade" required/><br>

        <input type="submit" value="Edit Reservation">
    </form>
</div>
 
 
 <div id="fn2" class="adminfn">
 <h3>Add New Room</h3>
 <form id="addNewRoom" action="?" method="post">
     <label for="roomno">Room No:</label>
        <input type="number" name="roomno" id="roomno" required><br/><br/>
      <label for="adminID">Admin ID:</label>
        <select name="adminID" id="adminID">
		<option value="select">Select</option>
		<?php foreach($result2 as $adminID):?>
		<option value="<?php echo $adminID['adminID']; ?>" >
		<?php echo $adminID['adminID'];?>
		</option>
		<?php endforeach; ?>
		</select>		<br/><br/>
      
	  <label for="bedsize">Bedsize : </label>
        <select name="bedsize" id="bedsize">
        <option value="select">Bedsize</option>
		<?php foreach($result1 as $bedsize):?>
		<option value="<?php echo $bedsize['bedsize']; ?>" >
		<?php echo $bedsize['bedsize'];?>
		</option>
		<?php endforeach; ?>
		</select><br/><br/>
      
	  <label for="smokingallowed">Smoking Allowed :
        <input type="text" name="smokingallowed" id="smokingallowed" required></label><br/><br/>
      
	  <label for="noofbeds">Number of Beds :
        <input type="text" name="noofbeds" id="noofbeds" required></label><br/><br/>
      
	  <label for="noofguests">Number of Guests :
        <input type="text" name="noofguests" id="noofguests" required></label><br/><br/>
      
	  <label for="noofbathroom">Number of bathroom :
        <input type="text" name="noofbathroom" id="noofbathroom" required></label><br/><br/>
      
	  <label for="isAvailable">Available :
        <input type="number" name="isAvailable" id="isAvailable" min="0" max="1" required></label><br/><br/>
      
	  <label for="price">Price:
        <input type="number" name="price" id="price" required></label><br/><br/>
      
	  <div><input type="submit" value="Add New Room" style="float: left;"></div>
	  </form>
 </div>
 
 
<div id="fn3" class="adminfn">
<h3>Add room (Availability)</h3>
	<form action="?addRoom" method="post">
		<label for="roomno">Room No: </label>
		<input type= "text" name="roomno" id="roomno">
		<input type="submit" value="Add Room">
	</form>

</div>


<div id="fn4" class="adminfn">
<h3>Remove Room</h3>

<table >
    <?php foreach ($result as $availability): ?>
      <tr>
      <td> <button><?php echo $availability['roomno']; ?> </button></td>
	    <td>  
         <form action="?removeRoom" method="POST">
          <input type="hidden" name="roomno" value="<?php echo $availability['roomno']; ?>">
         <input type="submit" value="Remove Room">
        </form>
      </td>
      </tr>
    <?php endforeach; ?>
    </table>
</div>

<div id="fn5" class="adminfn">
<h3>Guest Check In</h3>
    <form action="?checkIn" method="post">
        <label for="reservationIdCheckIn">Reservation Id: </label>
        <input type= "number" name="reservationIdCheckIn" min="1" required/>
        <input type="submit" value="Check In"/>
    </form>
</div>

<div id="fn6" class="adminfn">
<h3>Guest Check Out</h3>
    <form action="?checkOut" method="post">
        <label for="reservationIdCheckOut">Reservation Id: </label>
        <input type= "number" name="reservationIdCheckOut" min="1" required/>
        <input type="submit" value="Check Out"/>
    </form>
</div>

<script>
$('.adminfn').hide();
$('.show').click(function () {
    $('.adminfn').hide();
    $('#fn' + $(this).attr('target')).show();
});

$('.hide').click(function () {
    $('.adminfn').hide();
  
});

</script>

  </body>
</html>