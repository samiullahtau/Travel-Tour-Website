<?php
session_start(); // Start the session
$_SESSION = array(); // Clear all session variables
session_destroy(); // Destroy the session
header('Location: index.php'); // Redirect to index.php
exit(); // Always call exit after header redirection
?>