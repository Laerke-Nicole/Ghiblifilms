<?php require_once("includes/functions.php"); ?>
<?php
	// make sure session is started
	session_start();
	
	// unset all the session variables
	$_SESSION = array();
	
	// destroy the session cookie
	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}
	
	// destroy session
	session_destroy();
	
	redirect_to("index.php?page=login");
?>