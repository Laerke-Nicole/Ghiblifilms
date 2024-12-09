<?php
require_once("includes/functions.php");
require_once("includes/session.php");

// CSRF-protection
// generate a CSRF-token
function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// validate the CSRF-token
function validatecsrfToken($token) {
    if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
        die('CSRF validation failed.');
    }
}
?>