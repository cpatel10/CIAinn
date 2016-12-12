<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <title>profile</title>
</head>
  </head>
  <body>
 <header>

    <h1><a href="index.php">CIAinn</a></h1>
  </header>
  
  <div id="funtions">
	<a class="show" target="1">Personal Details</a> |
	<a class="show" target="2">Address</a> |
	<a class="show" target="3">Creditcard Details</a> |
	<a class="show" target="4">Previous Reservations</a>
  </div>


  <div id="fun1" class="custfun">
  <h3>Personal Details </h3>



          <?php foreach ($info as $detail): ?>

              <div class="personal-info">
                  <p><strong>First Name: </strong><?php echo $detail['fname']; ?> </p>
                  <p><strong>Last Name: </strong><?php echo $detail['lname']; ?> </p>
                  <p> <strong>Email: </strong><?php echo $detail['email']; ?> </p>
                  <p> <strong>Contact number: </strong><?php echo $detail['phone']; ?> </p>
              </div>
          <?php endforeach; ?>


  </div>
  <div id="fun2" class="custfun">

  <h3>Address </h3>



    <?php foreach ($loadAddress as $add): ?>

    <div id="add-info">
    <p><strong>Address Line 1 : </strong> <?php echo $add['addressline1']; ?> </p>
       <p><strong>Address Line 2 : </strong><?php echo $add['addressline2']; ?> </p>
	   <p><strong>City : </strong> <?php echo $add['city']; ?> </p>
	   <p><strong>State : </strong> <?php echo $add['state']; ?> </p>
        <p><strong>Zipcode : </strong> <?php echo $add['zipcode']; ?> </p>
        <p><form action="?deleteAdd" method="post">
            <input type="hidden" name="addressID" value="<?php echo $add['addressID']; ?>">
            <input type="submit" value="Delete">
        </form></p>
        <hr/>

       </div>
    <?php endforeach; ?>



    <h3> Add New Address</h3>
  <form id="addressDetails" action="?" method="post">
    <label for="addressline1">Address Line 1 : </label>
      <input id="addressline1" type="text" name="addressline1" required><br><br>
    <label for="addressline2">Address Line 2 : </label>
    <input id="addressline2" type="text" name="addressline2" ><br><br>
    <label for="city">City : </label>
    <input id="city" type="text" name="city" required><br><br>
    <label for="state">State : </label>
    <input id="state" type="text" name="state" required><br><br>
    <label for="zipcode">Zipcode : </label>
    <input id="zipcode" type="text" name="zipcode" required><br><br>
    <div><input type="submit" value="Add Address" style="float: left;"></div>
  </form>
  </div>


  <div id="fun3" class="custfun">
  <h3>Creditcard Details </h3>
    <form id="ccDetails" action="?" method="post">
      <label for="cardNo">Card Number : </label>
      <input id="cardNo" type="number" name="cardNo" required><br><br>
      <label for="cardHolder">Name on Card : </label>
      <input id="cardHolder" type="text" name="cardHolder" required ><br><br>
      <label for="cvv">CVV : </label>
      <input id="cvv" type="number" name="cvv" required><br><br>
      <label for="expireMM">Expiry Month : </label>
      <input id="expireMM" type="number" name="expireMM" required max="12" min="1"><br><br>
      <label for="expireYY">Expiry Year : </label>
      <input id="expireYY" type="number" name="expireYY" required min="2016"><br><br>

      <label for="aline1">Address : </label>
      <select name="aline1" id="aline1">

      <option value="select">Select</option>
      <?php foreach($loadAddress as $aline1):?>
        <option value="<?php echo $aline1['addressline1']; ?>" >
          <?php echo $aline1['addressline1'];?>
        </option>
      <?php endforeach; ?>
      </select>
        <br><br>

      <div><input type="submit" value="Add"></div>
    </form>
</div>

  <div id="fun4" class="custfun">
  <h3>Previous Reservations </h3>

      <?php foreach ($res as $reservation): ?>

          <div class="personal-info">
              <p><strong>Reservation ID: </strong><?php echo $reservation['reservationID']; ?> <br>
              <p><strong>Room No: </strong><?php echo $reservation['roomno'];?><br>
              <p><strong>Start Date: </strong><?php echo $reservation['startdate']; ?> <br>
              <p><strong>End Date: </strong><?php echo $reservation['enddate']; ?> <br>
              <p><strong>No of Guests: </strong><?php echo $reservation['noofguests']; ?> </p>
              <p><form action="?deleteRes" method="post">
                  <input type="hidden" name="reservationID" value="<?php echo $reservation['reservationID']; ?>">
                  <input type="hidden" name="startdate" value="<?php echo $reservation['startdate']; ?>">
                  <input type="hidden" name="roomno" value="<?php echo $reservation['roomno']; ?>">


                  <input type="submit" value="Cancel Reservation">
              </form></p>
              <hr/>
          </div>
      <?php endforeach; ?>
  </div>

  <script>
    $('.custfun').hide();
    $('.show').click(function () {
      $('.custfun').hide();
      $('#fun' + $(this).attr('target')).show();
    });

    $('.hide').click(function () {
      $('.custfun').hide();

    });

  </script>
  
  <div id="footer" style="text-align: center">
    <p>©2016 CIA Inn, Inc. All rights reserved.</p>
</div>
  </body>
</html>
