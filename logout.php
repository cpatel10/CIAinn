<?php 

	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';
	if (isset($_COOKIE['username'])) {
    	unset($_COOKIE['username']);
   		setcookie('username', null, -1);
      if (isset($_SESSION["roomno"])) {
        unset($_SESSION["roomno"]);
      }
   		debug_to_console("loged out!");
   		header('Location: .');
  		exit();
	} else {
		debug_to_console("failed to log out!");
	}
