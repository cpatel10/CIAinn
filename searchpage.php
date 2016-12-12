<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <title>CIAinn</title>
</head>

<body>
    <?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/db.inc.php';
    include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';

    $startdate=$_POST['check-in'];
    $enddate=$_POST['check-out'];
    $noofguests=$_POST['guests'];
    $bedsize=$_POST['bedsize'];

    debug_to_console($startdate);
    debug_to_console($enddate);

    try {
    	$sql='SELECT roomno, bedsize, smokingallowed, noofbeds, noofguests,noofbathroom, price
        from room
        where roomno NOT IN (
            select roomno
            from reservation where(
                ("'.$startdate. '" between startdate and enddate)
                or "'.$startdate. '"= startdate
                or
                ("'.$enddate. '" between startdate and enddate)
                or "'.$enddate. '"= enddate
                or
                (startdate between "'. $startdate. '" and "'.$enddate.'")
            )
        )
        AND bedsize="'.$bedsize.'"
    	AND isAvailable=1
    	ORDER BY
        RAND()';
        //LIMIT 0, 1';
        $result = $pdo->query($sql);

     //  $sql='SELECT roomno, bedsize, smokingallowed, noofbeds, noofguests,noofbathroom
     //    from room
     //    where roomno NOT IN (
     //      select roomno
     //      from reservation where(
     //         (:startdate between startdate and enddate)
     //          or
     //          (:enddate between startdate and enddate)
     //          or
     //          (startdate between :startdate and :enddate)
     //      )
     //    )
     //    AND bedsize=:bedsize';

    	// $s = $pdo->prepare($sql);
     //  $s->bindValue(':startdate', $startdate);
     //  $s->bindValue(':enddate', $enddate);
     //  $s->bindValue(':bedsize', $bedsize);
     //  $s->execute();
     //  $result = $s->fetchAll();
        $numOfRecords = $result->rowCount();
        debug_to_console($numOfRecords);
    } catch(PDOException $e) {
    	$error = 'Error fetching room details.' . $e->getMessage();
    	include 'error.html.php';
    	exit();
    }
    ?>

    <div class="container">
        <div class="page-header row">
            <a href="index.php">CIAinn</a>
        </div>

        <div class="row">
            <h3>Search Results</h3>
        </div>

        <?php foreach ($result as $search): ?>
        <div class="row">
            <div class="searched-room">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Bedsize</strong></td>
                            <td><?php echo $search['bedsize']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Number of beds</strong></td>
                            <td><?php echo $search['noofbeds']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Maximum number of guests</strong></td>
                            <td><?php echo $search['noofguests']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Number of bathrooms</strong></td>
                            <td><?php echo $search['noofbathroom']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Room Type</strong></td>
                            <td>
                                <?php
                                if ($search['smokingallowed'] == 1) {
                                    echo "Smoking allowed";
                                } else {
                                    echo "Non-smoking room";
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Price</strong></td>
                            <td><strong>$<?php echo $search['price']; ?></strong></td>
                        </tr>
                        <tr>
                            <td>
                                <form class="form-horizontal" action="reservation.php" method="post">
                                    <input type="hidden" name="roomno" value="<?php echo $search['roomno']; ?>" />
                                    <input type="hidden" name="price" value="<?php echo $search['price']; ?>" />
                                    <input type="hidden" name="startdate" value="<?php echo $startdate; ?>" />
                                    <input type="hidden" name="enddate" value="<?php echo $enddate; ?>" />
                                    <input type="hidden" name="guests" value="<?php echo $noofguests; ?>" />
                                    <input class="btn btn-default" type="submit" value="reserve" />
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <!--   <tr>
    <td> <?php echo $search['roomno']; ?> </td>
    <td style= "width:150px"> <?php echo $search['bedsize']; ?> </td>
    <td> <?php echo $search['noofbeds']; ?> </td>
    <td> <?php echo $search['noofguests']; ?> </td>
    <td> <?php echo $search['smokingallowed']; ?> </td>
     <td> <?php echo $search['noofbathroom']; ?> </td>
     <td>
     <form action="" method="post">
      <input type="hidden" name="id" value="<?php echo $search['roomno']; ?>">
     <input type="submit" value="reserve">
    </form>
    </td>
    </tr> -->
        <?php endforeach; ?>
    </div>
</body>
</html>
