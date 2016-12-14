<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Customer Profile</title>
</head>

<body>
    <div class="container">
        <div class="page-header row">
            <a href="index.php">CIAinn</a>
            <div class="btn-wrapper-right">
            <p> Welcome <?php echo $_COOKIE['username']; ?></p>
            <a class="btn btn-default" href="logout.php">Sign Out</a>
            </div>
        </div>

        <div class="row">
            <div class="panel-group" id="accordion-cus">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-cus" href="#personal-details">Personal Details</a>
                        </h3>
                    </div>
                    <div id="personal-details" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="col-sm-offset-3 col-sm-6">
                                <?php foreach ($info as $detail): ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><strong>First Name</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $detail['fname']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Last Name</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $detail['lname']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Email</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $detail['email']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Contact number</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $detail['phone']; ?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-cus" href="#address">Address</a>
                        </h3>
                    </div>
                    <div id="address" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="col-sm-offset-3 col-sm-6">
                                <?php foreach ($loadAddress as $add): ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><strong>Address Line 1</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $add['addressline1']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Address Line 2</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $add['addressline2']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>City</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $add['city']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>State</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $add['state']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Zipcode</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $add['zipcode']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <form class="form-horizontal" action="?deleteAdd" method="post">
                                                    <input type="hidden" name="addressID" value="<?php echo $add['addressID']; ?>">
                                                    <input class="btn btn-default" type="submit" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-cus" href="#add-new-address">Add New Address</a>
                        </h3>
                    </div>
                    <div id="add-new-address" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form class="form-horizontal" action="?" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="addressline1">Address Line 1</label>
                                    <div class="col-sm-9">
                                        <input  type="text" name="addressline1" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="addressline2">Address Line 2</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="addressline2" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="city">City</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="city" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="state">State</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="state" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="zipcode">Zipcode</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="zipcode" required />
                                    </div>
                                </div>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input class="btn btn-default" type="submit" value="Add Address">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-cus" href="#cc-details">Creditcard Details</a>
                        </h3>
                    </div>
                    <div id="cc-details" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form class="form-horizontal" action="?" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cardNo">Card Number</label>
                                    <div class="col-sm-9">
                                        <input  class="form-control" type="number" name="cardNo" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cardHolder">Name on Card</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="text" name="cardHolder" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="cvv">CVV</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="cvv" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label class="col-sm-3 control-label" for="expireMM">Expiry  Month</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="expireMM" max="12" min="1" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="col-sm-3 control-label" for="expireYY">Expiry Year</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="number" name="expireYY" min="2016" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="aline1">Address</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="aline1">
                                            <option value="select">Select</option>
                                            <?php 
                                            foreach($loadAddress as $aline1):?>
                                                <option value="<?php echo $aline1['addressID']; ?>" >
                                                    <?php echo $aline1['addressline1'];?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <input class="btn btn-default" type="submit" value="Add">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-cus" href="#reserve">Reservations</a>
                        </h3>
                    </div>
                    <div id="reserve" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="col-sm-offset-3 col-sm-6">
                                <?php foreach ($res as $reservation): ?>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p><strong>Reservation ID</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $reservation['reservationID']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Room No</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $reservation['roomno']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>Start Date</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $reservation['startdate']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>End Date</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $reservation['enddate']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p><strong>No of Guests</strong></p>
                                            </td>
                                            <td>
                                                <p><?php echo $reservation['noofguests']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <form class="form-horizontal" action="?" method="post">
                                                    <input type="hidden" name="reservationID" value="<?php echo $reservation['reservationID']; ?>">
                                                    <input type="hidden" name="startdate" value="<?php echo $reservation['startdate']; ?>">
                                                    <input class="btn btn-default" type="submit" name="cancelreservation" value="Cancel Reservation">
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
