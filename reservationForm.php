<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="../CIAinn/main.js"></script>
    <title>Reservation</title>
</head>
<body id="reg">

<header>
    <h1><a href="index.php">CIAinn</a></h1>
    </header>


<section>	

    <div id="reservation">
    <h3>Payment Information</h3>
        <form action="?" method="post" >
            <label for="cardNumber">Credit Card Number:</label>
            <input class="textField" type="text" id="cardNumber" name="cardNumber" required /><br><br>
            <label for="cardHolderName">Card Holder Name:</label>
            <input class="textField" type="text" id="cardHolderName" name="cardHolderName" required/><br><br>
            <label for="expireMM">Expiratiion Date:</label>
            <input class="textField" type="number" id="expireMM" name="expireMM" maxlength="2" placeholder="MM" required />
            <input class="textField" type="number" id="expireYY" name="expireYY" maxlength="2" placeholder="YY" required /><br><br>
            <label for="cvv">CVV:</label>
            <input class="textField" type="number" id="cvv" name="cvv" maxlength="3" required /><br><br>

            <label>Billing Address</label><br>
            <label for="addressLine1">Address Line 1:</label>
            <input class="textField" type="text" id="addressLine1" name="addressLine1" required /><br><br>
            <label for="addressLine2">Address Line 2:</label>
            <input class="textField" type="text" id="addressLine2" name="addressLine2"/><br><br>
            <label for="city">City:</label>
            <input class="textField" type="text" id="city" name="city" required /><br><br>
            <label for="state">Sate:</label>
            <input class="textField" type="text" id="state" name="state" required /><br><br>
            <label for="zipCode">Zip Code:</label>
            <input class="textField" type="number" id="zipCode" name="zipCode" maxlength="5" required /><br><br><br>


            <div id="submit"><input type="submit" value="Reserve" style="float:left; width: 30%"></div>

        </form>

        </div>

    </section>

<div id="footer" style="text-align: center">
    <p>©2016 CIA Inn, Inc. All rights reserved.</p>
</div>

</body>

</html>