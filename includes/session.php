<?php
	session_start();
	
	function logged_in() {
		return isset($_SESSION['UserID']);
	}

	function is_admin() {	
		if (!logged_in()) {
			return false;
		}

		global $dbCon;
		$userID = $_SESSION['UserID'];
	
		// check if the user is an admin
		include ("controllers/userController.php");
	
		// check users role is admin
		return $admin && $admin['Role'] === 'Admin';
	}


	function confirm_is_admin() {
		if (!is_admin()) {
			if (headers_sent()) {
				// js redirect
				echo "<script>window.location.href='index.php?page=login';</script>";
				exit;
			} else {
				header("Location: index.php?page=login");
				exit;
			}
		}
	}

	function confirm_logged_in() {
		if (!logged_in()) {
			if (headers_sent()) {
				// js redirect
				echo "<script>window.location.href='index.php?page=login';</script>";
				exit;
			} else {
				header("Location: index.php?page=login");
				exit;
			}
		}
	}
?>