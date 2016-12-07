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

try
{
	$sql='SELECT DISTINCT bedsize FROM room';
	$result = $pdo->query($sql);
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
    <div id="btn">
    <?php if (!isset($_COOKIE['username'])): ?>
        <button id="register" ><a href="login.php" style="text-decoration: none; color: black">Register</a></button>
        <button id="sign_in"><a href="login.php" style="text-decoration: none; color: black">Sign In</a></button>
    <?php else: ?>
       <p> Welcome <?php echo $_COOKIE['username']; ?></p><br>
        <button id="log_out"><a href="logout.php" style="text-decoration: none; color: black">Sign Out</a></button>
		<button id="pro"><a href="customerProfile.php" style="text-decoration: none; color: black" >My Profile</a></button>
    <?php endif; ?>
    </div>
    </header>
	
	
<section>
    <div id="container">
    <form id="search" method="post" action="searchpage.php">
        <input class="text-field" type="date" name="check-in" required placeholder="Check-in" style="height: 28px;">
        <input class="text-field" type="date" name="check-out" required placeholder="Check-out" style="height: 28px;">
        <input class="text-field" type="number" name="guests" required placeholder="Number of Guests" min="1" style="height: 25px">
        <select class="text-field" name="bedsize" id="bedsize" style="height: 30px">
        <option value="select">Bedsize</option>
		<?php foreach($result as $bedsize):?>
		<option value="<?php echo $bedsize['bedsize']; ?>" >
		<?php echo $bedsize['bedsize'];?>
		</option>
		<?php endforeach; ?>
    </select>
        <input class="text-field" type="submit" name="submit" value="Search" style="height: 30px">
</form>
 </div>
    </form>
    </section>

<section id="wrapper">

    <div id="banner" style="max-width: 790px; max-height: 400px" >
        <img class="mySlides" src="../CIAinn/images/1.jpg" style="width: 100%">
        <img class="mySlides" src="../CIAinn/images/2.jpg" style="width: 100%">
        <img class="mySlides" src="../CIAinn/images/3.jpg" style="width: 100%">
        <img class="mySlides" src="../CIAinn/images/4.jpg" style="width: 100%">
        <img class="mySlides" src="../CIAinn/images/5.jpg" style="width: 100%">
        <img class="mySlides" src="../CIAinn/images/6.jpg" style="width: 100%">

        </div>
    <script>
    var myIndex = 0;
    carousel();
    </script>

    <div id="amneties">
        <ul>
            <h3>Key Amneties</h3><br>
            <li class="fw">Free Wifi </li>
            <li class="fb">Free Breakfast</li>
            <li class="pf">Pet Friendly</li>
            <li class="op">Onsite Parking</li>
            <li class="po">Pool-Outdoor</li>
            <li class="bc">Business Center</li>
        </ul>
        </div>
        </section>
<br>
<br>

<footer align="center">

    <a href="">About US</a> <a href="contact.html">Contact Us</a> <a href="">Subscribe</a> <a href="">Reviews </a> <a href=""> Terms & Policies</a>
    <a href="">Careers</a>
	
<br>
    <br>
    <p align="center">©2016 CIA Inn, Inc. All rights reserved.</p>
</footer>



</body>


</html>