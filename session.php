<?php
	require_once 'register-controller.php';

	// setcookie('temporal', '', time() - 10);

	session_start();
	
	$_SESSION['miGalletita'] = $_COOKIE['temporal'];

	myDebug($_SESSION, 'print_r');
