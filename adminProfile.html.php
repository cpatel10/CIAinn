<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <title>Admin Profile</title>
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';

    try {
    	$sql2='SELECT adminID FROM admin';
    	$result2 = $pdo->query($sql2);
    } catch(PDOException $e) {
    	$error = 'Error fetching adminID.' . $e->getMessage();
    	include 'error.html.php';
    	exit();
    }

    try {
    	$sql1='SELECT DISTINCT bedsize FROM room';
    	$result1 = $pdo->query($sql1);
    } catch(PDOException $e) {
    	$error = 'Error fetching bedsize.' . $e->getMessage();
    	include 'error.html.php';
    	exit();
    }
    ?>

    <div class="container">
        <div class="page-header row">
            <a href="index.php">CIAinn</a>
            <div class="btn-wrapper-right">
                <?php
                session_start();
                echo 'Welcome ' .$_SESSION['email1'];
                echo '<a class="btn btn-default" href="adminLogin.php?action=logout">Sign Out</a>';
                ?>
            </div>
        </div>

        <div class="row">
            <div class="panel-group" id="accordion-admin">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-admin" href="#edit-reservation">Edit Reservation</a>
                        </h3>
                    </div>
                    <div id="edit-reservation" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form class="form-horizontal" action="?editReservation" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="reservationId">Reservation ID</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="number" name="reservationId" min="1" required />
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="roomNoReserved">Room No </label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="number" name="roomNoReserved" min="1" required />
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="checkInReserved">Check In Date</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="date" name="checkInReserved" required />
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="checkOutReserved">Check Out Date</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="date" name="checkOutReserved" required/>
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="noOfGuestsReserved">No Of Guests</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="number" name="noOfGuestsReserved" min="1" required />
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input class="btn btn-default" type="submit" value="Edit Reservation" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title form-header">
                            <a data-toggle="collapse" data-parent="#accordion-admin" href="#add-new-room">Add New Room</a>
                        </h3>
                    </div>
                    <div id="add-new-room" class="panel-collapse collapse">
                        <div class="panel-body">
                            <form class="form-horizontal" action="?" method="post">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="roomno">Room No</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="number" name="roomno" required />
                                    </div>
                                    <div class="col-sm-3"></div>
                                </div>
                            </form>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="adminID">Admin ID</label>
                                <div class="col-sm-6">
                                    <select name="adminID">
                                        <option value="select">Select</option>
                                        <?php foreach($result2 as $adminID):?>
                                        <option value="<?php echo $adminID['adminID']; ?>" >
                                            <?php echo $adminID['adminID'];?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="bedsize">Bedsize</label>
                                <div class="col-sm-6">
                                    <select name="bedsize">
                                        <option value="select">Bedsize</option>
                                        <?php foreach($result1 as $bedsize):?>
                                        <option value="<?php echo $bedsize['bedsize']; ?>" >
                                            <?php echo $bedsize['bedsize'];?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="smokingallowed">Smoking Allowed</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="smokingallowed" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="noofbeds">Number of Beds</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="noofbeds" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="noofguests">Number of Guests</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="noofguests" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="noofbathroom">Number of bathroom</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="text" name="noofbathroom" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="isAvailable">Available</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="number" name="isAvailable" id="isAvailable" min="0" max="1" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="price">Price</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="number" name="price" id="price" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-default" type="submit" value="Add New Room">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#add-room">Add Room (Availability)</a>
                    </h3>
                </div>
                <div id="add-room" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form class="form-horizontal" action="?addRoom" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="roomno">Room No</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type= "text" name="rno" />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-default" type="submit" value="Add Room">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#remove-room">Remove Room</a>
                    </h3>
                </div>
                <div id="remove-room" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <?php foreach ($result as $availability): ?>
                            <tr>
                                <td>
                                    <button class="btn btn-default"><?php echo $availability['roomno']; ?> </button>
                                </td>
                            	<td>
                                    <form class="form-horizontal" action="?removeRoom" method="POST">
                                            <input type="hidden" name="rero" value="<?php echo $availability['roomno']; ?>">
                                            <input class="btn btn-default" type="submit" value="Remove Room">
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#guest-check-in">Guest Check In</a>
                    </h3>
                </div>
                <div id="guest-check-in" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form class="form-horizontal" action="?checkIn" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="reservationIdCheckIn">Reservation Id</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type= "number" name="reservationIdCheckIn" min="1" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-default" type="submit" value="Check In"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#guest-check-out">Guest Check Out</a>
                    </h3>
                </div>
                <div id="guest-check-out" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form class="form-horizontal" action="?checkOut" method="post">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="reservationIdCheckOut">Reservation Id</label>
                                <div class="col-sm-6">
                                    <input class="form-control" type="number" name="reservationIdCheckOut" min="1" required />
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                            <div class="col-sm-offset-3 col-sm-9">
                                <input class="btn btn-default" type="submit" value="Check Out" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#room-count">Room Availability</a>
                    </h3>
                </div>
                <div id="room-count" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-sm-offset-3 col-sm-6">

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p><strong>Total Number of Rooms available: </strong></p>
                                        </td>
                                        <td>
                                            <p><?php echo $totalRoom; ?></p>
                                        </td>
                                    </tr>
                                </tbody>
                           </table>
                           </div>
                       <div class="col-sm-3"></div>
                   </div>
               </div>
           </div>
           <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title form-header">
                        <a data-toggle="collapse" data-parent="#accordion-admin" href="#benefit-report">Benefit Report</a>
                    </h3>
                </div>
                <div id="benefit-report" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <p><strong>Total Income</strong></p>
                                    </td>
                                    <td>
                                        <p><?php echo '$'. $benefitcol; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
