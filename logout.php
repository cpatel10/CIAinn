<?php 

	include_once $_SERVER['DOCUMENT_ROOT'] . '/CIAinn/includes/helpers.inc.php';
	if (isset($_COOKIE['username'])) {
    	unset($_COOKIE['username']);
   		setcookie('username', null, -1);
   		debug_to_console("loged out!");
   		header('Location: .');
  		exit();
    	return true;
	} else {
		debug_to_console("failed to log out!");
    	return false;
	}
