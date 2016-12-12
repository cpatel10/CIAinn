<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    <div class="container">
        <div class="page-header row">
            <a class="logo" href="index.php">CIAinn</a>
            <div class="btn-wrapper-right">
                <?php if (!isset($_COOKIE['username'])): ?>
                    <a class="btn btn-default" href="login.php">Register</a>
                    <a class="btn btn-default" href="login.php">Sign In</a>
                <?php else: ?>
                    <p> Welcome <?php echo $_COOKIE['username']; ?></p><br>
                    <a class="btn btn-default" href="logout.php">Sign Out</a>
                    <a class="btn btn-default" href="customerProfile.php">My Profile</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <form class="form-inline" method="post" action="searchpage.php">
                <div class="form-group">
                    <label for="check-in">Check In</label>
                    <input id="check-in" class="form-control" type="date" name="check-in" />
                </div>
                <div class="form-group">
                    <label for="check-out">Check Out</label>
                    <input id="check-out" class="form-control" type="date" name="check-out" />
                </div>
                <div class="form-group">
                    <label class="sr-only" for="no-of-guest">Number Of Guest</label>
                    <input id="no-of-guest" class="form-control" type="number" name="guests" required placeholder="Number of Guests" min="1" />
                </div>
                <div class="form-group">
                    <select class="form-control" name="bedsize">
                        <option value="select">Bedsize</option>
                        <?php foreach($result as $bedsize):?>
                        <option value="<?php echo $bedsize['bedsize']; ?>">
                            <?php echo $bedsize['bedsize'];?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="submit" name="submit" value="Search" />
                </div>
            </form>
        </div>

        <div class="row top-space">
            <div class="col-lg-8">
                <br>
                <div id="carousel-slides" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-slides" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-slides" data-slide-to="1"></li>
                        <li data-target="#carousel-slides" data-slide-to="2"></li>
                        <li data-target="#carousel-slides" data-slide-to="3"></li>
                        <li data-target="#carousel-slides" data-slide-to="4"></li>
                        <li data-target="#carousel-slides" data-slide-to="5"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img class="img-responsive" src="images/1.jpg" alt="Hotel Preview">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/2.jpg" alt="Hotel Preview">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/3.jpg" alt="Hotel Preview">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/4.jpg" alt="Hotel Preview">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/5.jpg" alt="Hotel Preview">
                        </div>
                        <div class="item">
                            <img class="img-responsive" src="images/6.jpg" alt="Hotel Preview">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-slides" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-slides" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div id="amneties">
                    <ul class="list-group">
                        <h3>Key Amneties</h3><br>
                        <li class="list-group-item">Free Wifi </li>
                        <li class="list-group-item">Free Breakfast</li>
                        <li class="list-group-item">Pet Friendly</li>
                        <li class="list-group-item">Onsite Parking</li>
                        <li class="list-group-item">Pool-Outdoor</li>
                        <li class="list-group-item">Business Center</li>
                    </ul>
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
