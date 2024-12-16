<?php
	session_start();
	
	function logged_in() {
		return isset($_SESSION['UserID']);
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