<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>Reservation</title>
</head>

<body>
    <div class="container">
        <div class="page-header row">
            <a href="index.php">CIAinn</a>
        </div>

        <div class="row top-space">
            <h3 class="form-header">Payment Information</h3>
            <form class="form-horizontal" action="?" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="cardNumber">Credit Card Number</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="cardNumber" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="cardHolderName">Card Holder Name</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="cardHolderName" required/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="expireMM">Expiration Date</label>
                    <div class="col-sm-9">
                        <div class="col-sm-6">
                            <input class="form-control" type="number" name="expireMM" maxlength="2" placeholder="MM" required />
                        </div>
                        <div class="col-sm-6">
                            <input class="form-control" type="number" name="expireYY" maxlength="2" placeholder="YY" required />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="cvv">CVV</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="cvv" maxlength="3" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" ><strong>Billing Address</strong></label>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="addressLine1">Address Line 1</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="addressLine1" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="addressLine2">Address Line 2</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="addressLine2"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="city">City</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="city" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="state">Sate</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="text" name="state" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="zipCode">Zip Code</label>
                    <div class="col-sm-9">
                        <input class="form-control" type="number" name="zipCode" maxlength="5" required />
                    </div>
                </div>
                <div class="col-sm-offset-3 col-sm-9">
                    <input class="btn btn-default" type="submit" value="Reserve">
                </div>
            </form>
        </div>

        <div class="row top-space center-align">
            <footer>
                <a href="">About US</a><label>|</label>
                <a href="contact.html">Contact Us</a><label>|</label>
                <a href="">Subscribe</a><label>|</label>
                <a href="">Reviews</a><label>|</label>
                <a href="">Terms & Policies</a><label>|</label>
                <a href="">Careers</a></br>
                <copyright>©2016 CIA Inn, Inc. All rights reserved.</copyright>
            </footer>
        </div>
    </div>
</body>
</html>
