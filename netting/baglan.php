<?php
//error_reporting(E_ALL);
ini_set("display_errors", 0);

try {

	$db = new PDO("mysql:host=localhost;dbname=bayraktar;charset=utf8", 'bayraktar', '1993mro55');
	// echo "Veritabanı Bağlantısı Başarılı";
} catch (PDOException $e) {
	echo $e->getMessage();
}
date_default_timezone_set("Europe/Istanbul");