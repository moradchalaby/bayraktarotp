<?php

// Connexion à la base de données
if (empty($_POST)) {
	header("Location:../production/index.php");
}
ob_start();
session_start(); // $_SESSION çalışması için bunlar tanımlanacak
date_default_timezone_set("Europe/Istanbul");

include '../../netting/baglan.php';
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {


	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";


	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	} else {
		die('OK');
	}
}
//header('Location: '.$_SERVER['HTTP_REFERER']);