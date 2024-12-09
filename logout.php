<?php
session_start();
if (isset($_POST['logout'])) {
	$msg = '<div class="alert alert-success" role="alert">
                        <strong>Success! </strong>You are Logged out.
                        </div>';
	foreach ($_SESSION as $field => $value){
		unset($_SESSION[$field]);
	}
	session_destroy();
	header("Location: https://mywebtraining.net/webdev/LouisCK/php/register.php");
	exit;
}


?>


