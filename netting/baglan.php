<?php
/* 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 */
try {

	$db = new PDO("mysql:host=localhost;dbname=bayraktar;charset=utf8", 'root', '');
	// echo "Veritabanı Bağlantısı Başarılı";
} catch (PDOException $e) {
	echo $e->getMessage();
}
date_default_timezone_set("Europe/Istanbul");
