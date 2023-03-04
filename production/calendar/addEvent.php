<?php



// Connexion à la base de données
ob_start();
session_start(); // $_SESSION çalışması için bunlar tanımlanacak
date_default_timezone_set("Europe/Istanbul");

include '../../netting/baglan.php';

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])) {

	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$sql = "INSERT INTO events(title, start, end, color) values ('$title', '$start', '$end', '$color')";
	//$req = $bdd->prepare($sql);
	//$req->execute();

	echo $sql;

	$query = $db->prepare($sql);


	if ($query == false) {
		print_r($db->errorInfo());
		die('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	}
} else {
	echo 'BOŞ';
}
//header('Location: ' . $_SERVER['HTTP_REFERER']);