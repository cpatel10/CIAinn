<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CIAinn/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript" src="../CIAinn/main.js"></script>
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

try
{
	$sql='SELECT roomno, bedsize, smokingallowed, noofbeds, noofguests,noofbathroom, price 
    from room 
    where roomno NOT IN (
      select roomno 
      from reservation where(
	       ('.$startdate. ' between startdate and enddate)
          or 
          ('.$enddate. ' between startdate and enddate)
          or 
          (startdate between '. $startdate. ' and '.$enddate.')
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
}

catch(PDOException $e)
{
	$error = 'Error fetching room details.' . $e->getMessage();
	include 'error.html.php';
	exit();
	
}
?>
<header>

    <h1><a href="index.php">CIAinn</a></h1>
	
</header>
<hr/>

<section>

<h3>Search Results</h3>

<hr/>
   
<!--     <table > -->
    <?php foreach ($result as $search): ?>
      <div class="searched-room">
        <p><strong>Bedsize: </strong><?php echo $search['bedsize']; ?></p>
        <p><strong>Number of beds: </strong><?php echo $search['noofbeds']; ?></p>
        <p><strong>Maximum number of guests: </strong><?php echo $search['noofguests']; ?></p>
        <p><strong>Number of bathrooms: </strong><?php echo $search['noofbathroom']; ?></p>
        <p>
        <?php 
          if ($search['smokingallowed'] == 1) {
            echo "Smoking allowed";
          } else {
            echo "Non-smoking room";
          }
        ?>
        </p>
        <p><strong>Price: $<?php echo $search['price']; ?></strong></p>
        <form action="reservation.php" method="post">
          <input type="hidden" name="roomno" value="<?php echo $search['roomno']; ?>">
          <input type="hidden" name="price" value="<?php echo $search['price']; ?>">
          <input type="hidden" name="startdate" value="<?php echo $startdate; ?>">
          <input type="hidden" name="enddate" value="<?php echo $enddate; ?>">
          <input type="hidden" name="guests" value="<?php echo $noofguests; ?>">
         <input type="submit" value="reserve">
        </form>
      </div>
<!--       <tr>
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
<!--     </table> -->
   
</section>
</body>
</html>