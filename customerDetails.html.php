<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<!--    <script type="text/javascript" src="../CIAinn/main.js"></script>-->
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




  </div>
  <div id="fun2" class="custfun">

  <h3>Address </h3>


         <table >
    <?php foreach ($loadAddress as $add): ?>

    <tr>
      <td> <?php echo $add['addressline1']; ?> </td>
       <td><?php echo $add['addressline2']; ?> </td>
	   <td> <?php echo $add['city']; ?> </td>
	   <td> <?php echo $add['state']; ?> </td>
        <td> <?php echo $add['zipcode']; ?> </td>

       </tr>
    <?php endforeach; ?>
       </table>

    <h3> Add Address</h3>
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
      <div><input type="submit" value="Add" style="float: left;"></div>
    </form>

  </div>
  <div id="fun4" class="custfun">
  <h3>Previous Reservations </h3></div>

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
