<?php
	// function to which location on page
	function redirect_to($location) {
			header("Location: {$location}");
			exit;
	}
?>