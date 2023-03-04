<?php
if (empty($_POST) and empty($_GET)) {
	header("Location:../production/index.php");
}
ob_start();
session_start(); // $_SESSION çalışması için bunlar tanımlanacak
date_default_timezone_set("Europe/Istanbul");
include 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['editEvent']) && isset($_POST['delete']) && isset($_POST['id'])) {


	$id = $_POST['id'];

	$sql = "DELETE FROM events WHERE id = $id";
	$query = $db->prepare($sql);
	if ($query == false) {
		print_r($db->errorInfo());
		die('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
		print_r($query->errorInfo());
		die('Erreur execute');
	}
	header('Location: ' . $_SERVER['HTTP_REFERER']);
} elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])) {

	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];
	$aciklama = $_POST['aciklama'];

	$sql = "UPDATE events SET  title = '$title', aciklama='$aciklama', color = '$color' WHERE id = $id ";


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
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}



if (isset($_POST['Event'][4]) && isset($_POST['Event'][3]) && isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {


	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];
	$kullanici_id = $_POST['Event'][4];

	$sql = "UPDATE events SET  start = '$start', end = '$end', kullanici_id = '$kullanici_id' WHERE id = $id ";


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
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
}


if (isset($_POST['kullanici_id']) && isset($_POST['addEvent']) && isset($_POST['title']) && isset($_POST['aciklama'])  && isset($_POST['color'])) {

	$title = $_POST['title'];
	$aciklama = $_POST['aciklama'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];
	$kullanici_id = $_POST['kullanici_id'];

	$sql = "INSERT INTO events(title,aciklama, start, end, color, kullanici_id) values ('$title', '$aciklama','$start', '$end', '$color','$kullanici_id')";
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
	header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if (isset($_POST['kullanicigiris'])) {

	$kullanici_mail = $_POST['kullanici_mail'];

	$kullanici_password = md5($_POST['kullanici_password']);

	$kullanicisor = $db->prepare("SELECT * from kullanici where  kullanici_mail=:mail and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(

		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'durum' => 1

	));

	$say = $kullanicisor->rowCount();

	$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
	if ($say == 1) {


		$_SESSION['kullanici_mail'] = $kullanici_mail;
		$_SESSION['kullanici_id'] = $kullanicicek['kullanici_id'];
		$_SESSION['kullanici_adsoyad'] = $kullanicicek['kullanici_adsoyad'];
		//bu işlem tarayıcı kapatılana kadar kaydı tutar
		header("Location:../production/takvim.php?durum=loginbasarili");
	} else {

		header("Location:../production/login.php?durum=loginbasarisiz");
	}
}



if (isset($_POST['yuzunederssil'])) {


	$derskaydet = $db->prepare(
		"DELETE FROM yuzuneders WHERE 
		yuzune_id=:yuzune_id AND
		ogrenci_id=:ogrenci_id"
	);

	$insert = $derskaydet->execute(array(

		'yuzune_id' => $_POST['yuzune_id'],
		'ogrenci_id' => $_POST['ogrenci_id']

	));

	if ($insert) {
		$url = $_POST['url'];
		header("Location:$url");
		exit;
	} else {
		header("Location:../production/ihtisasders.php?durum=no");
	}
}

if (isset($_POST['yuzuneders'])) {


	$derskaydet = $db->prepare(
		"INSERT INTO yuzuneders SET 
		yuzune_id=:yuzune_id,
		ogrenci_id=:ogrenci_id,
		kullanici_id=:kullanici_id"
	);

	$insert = $derskaydet->execute(array(

		'yuzune_id' => $_POST['yuzune_id'],
		'ogrenci_id' => $_POST['ogrenci_id'],
		'kullanici_id' => $_POST['kullanici_id']

	));

	if ($insert) {
		$url = $_POST['url'];
		header("Location:$url");
		exit;
	} else {
		header("Location:../production/ihtisasders.php?durum=no");
	}
}



if (isset($_POST['katilimsil'])) {
	$katilimsil = $db->prepare("DELETE FROM katilim_ogrenci where katilim_id=:katilim_id");
	$delete1 = $katilimsil->execute(array('katilim_id' => $_POST['katilim_id']));
	$katilimlarsil = $db->prepare("DELETE FROM katilimlar where katilim_id=:katilim_id");
	$delete2 = $katilimlarsil->execute(array('katilim_id' => $_POST['katilim_id']));

	if ($delete1 and $delete2) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}
if (isset($_POST['katilimduzenle'])) {

	$katilimduzenle = $db->prepare("UPDATE katilimlar set 
		katilim_ad=:katilim_ad,
		katilim_zaman=:katilim_zaman
	 where katilim_id={$_POST['katilim_id']}");
	$update = $odevduzenle->execute(array(
		'katilim_ad' => $_POST['katilim_ad'],
		'katilim_zaman' => $_POST['katilim_zaman']

	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}

if (isset($_POST['sinavsil'])) {
	$sinavsil = $db->prepare("DELETE FROM sinav_ogrenci where sinav_id=:sinav_id");
	$delete1 = $sinavsil->execute(array('sinav_id' => $_POST['sinav_id']));
	$sinavlarsil = $db->prepare("DELETE FROM sinavlar where sinav_id=:sinav_id");
	$delete2 = $sinavlarsil->execute(array('sinav_id' => $_POST['sinav_id']));
	echo $delete1 . '<br>';
	echo $delete2;
	exit;
	if ($delete1 and $delete2) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}
if (isset($_POST['sinavduzenle'])) {

	$sinavduzenle = $db->prepare("UPDATE sinavlar set 
		sinav_ad=:sinav_ad,
		sinav_zaman=:sinav_zaman
	 where sinav_id={$_POST['sinav_id']}");
	$update = $odevduzenle->execute(array(
		'sinav_ad' => $_POST['sinav_ad'],
		'sinav_zaman' => $_POST['sinav_zaman']

	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}

if (isset($_POST['odevsil'])) {
	$odevsil = $db->prepare("DELETE FROM odev_ogrenci where odev_id=:odev_id");
	$delete1 = $odevsil->execute(array('odev_id' => $_POST['odev_id']));
	$odevlersil = $db->prepare("DELETE FROM odevler where odev_id=:odev_id");
	$delete2 = $odevlersil->execute(array('odev_id' => $_POST['odev_id']));

	if ($delete1 and $delete2) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}
if (isset($_POST['odevduzenle'])) {

	$odevduzenle = $db->prepare("UPDATE odevler set 
		odev_baslik=:odev_baslik,
		odev_teslim=:odev_teslim
	 where odev_id={$_POST['odev_id']}");
	$update = $odevduzenle->execute(array(
		'odev_baslik' => $_POST['odev_baslik'],
		'odev_teslim' => $_POST['odev_teslim']

	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}
if (isset($_POST['ihtisasders'])) {


	$derskaydet = $db->prepare(
		"INSERT INTO ders SET 
		ders_ad=:ders_ad
		"

	);

	$insert = $derskaydet->execute(array(

		'ders_ad' => $_POST['ders_ad']


	));

	if ($insert) {
		header("Location:../production/ihtisasders.php?durum=ok");
	} else {
		header("Location:../production/ihtisasders.php?durum=no");
	}
}

if (isset($_POST['sinifders'])) {

	$buders = $db->prepare("SELECT * from sinif_ders where sinif_id=:sinif_id and ders_id=:ders_id");

	$buders->execute(array(
		'sinif_id' => $_POST['sinif_id'],
		'ders_id' => $_POST['ders_id']
	));
	$varmi = $buders->rowCount();
	if ($varmi > 0) {

		$sinifderskaydet = $db->prepare("UPDATE sinif_ders set hoca_id=:hoca_id where sinif_id={$_POST['sinif_id']} and ders_id={$_POST['ders_id']}");
		$update = $sinifderskaydet->execute(array(
			'hoca_id' => $_POST['hoca_id']
		));
	} else {
		$sinifderskaydet = $db->prepare("INSERT into sinif_ders set 
			hoca_id=:hoca_id,
			 sinif_id=:sinif_id,
			 ders_id=:ders_id");
		$update = $sinifderskaydet->execute(array(
			'hoca_id' => $_POST['hoca_id'],
			'sinif_id' => $_POST['sinif_id'],
			'ders_id' => $_POST['ders_id']
		));
	}
	if ($update or $insert) {
		header("Location:../production/ihtisasders.php?durum=ok");
	} else {
		header("Location:../production/ihtisasders.php?durum=no");
	}
}

if (isset($_POST['odevdurum'])) {

	/*print_r($_POST);
	exit;*/

	$odevdurum = $db->prepare("UPDATE odev_ogrenci set  odev_durum=:odevdurum
		where id={$_POST['odev_id']}");

	$update = $odevdurum->execute(array(
		'odevdurum' => $_POST['odevdurum']
	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}

if (isset($_POST['yeniodev'])) {

	/*echo $_POST['odev_baslik'].'<br>';
	echo $_POST['odev_zaman'].'<br>';
	echo $_POST['odev_teslim'].'<br>';
	echo $_POST['kullanici_id'].'<br>';
	echo $_POST['ders_id'].'<br>';
	echo $_POST['sinif_id'].'<br>';

	exit;*/
	$odevteslim = date('Y-m-d', strtotime($_POST['odev_teslim']));
	$odevkaydet = $db->prepare(
		"INSERT INTO odevler SET 
		odev_baslik=:odev_baslik,
		odev_zaman=:odev_zaman,
		odev_teslim=:odev_teslim,
		kullanici_id=:kullanici_id,
		ders_id=:ders_id,
		sinif_id=:sinif_id"

	);

	$insert = $odevkaydet->execute(array(

		'odev_baslik' => $_POST['odev_baslik'],
		'odev_zaman' => $_POST['odev_zaman'],
		'odev_teslim' => $odevteslim,
		'kullanici_id' => $_POST['kullanici_id'],
		'ders_id' => $_POST['ders_id'],
		'sinif_id' => $_POST['sinif_id']


	));

	$odevid = $db->prepare("SELECT LAST_INSERT_ID()");

	$odevid->execute(array());

	$odevidal = $odevid->fetch(PDO::FETCH_ASSOC);
	$sonodev = $odevidal['LAST_INSERT_ID()'];


	$sinifsor = $db->prepare("SELECT * from ogrenci where ogrenci_sinif=:ogrenci_sinif");

	$sinifsor->execute(array(
		'ogrenci_sinif' => $_POST['sinif_id']

	));

	while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {

		$odevsinifkaydet = $db->prepare(
			"INSERT INTO odev_ogrenci SET 
			odev_id={$odevidal['LAST_INSERT_ID()']},		
			ogrenci_id=:ogrenci_id
           "

		);

		$insert1 = $odevsinifkaydet->execute(array(


			'ogrenci_id' => $sinifcek['ogrenci_id']


		));
		//print_r($odevsinifkaydet->errorInfo());
		//  echo '<br>';
	}

	//exit;
	if ($insert and $insert1) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&odev=no");
	}
}

if (isset($_POST['notgir'])) {

	/*print_r($_POST);
	exit;*/

	$sinavdurum = $db->prepare("UPDATE sinav_ogrenci set  sinav_not=:sinav_not
		where id={$_POST['sinav_id']}");

	$update = $sinavdurum->execute(array(
		'sinav_not' => $_POST['sinav_not']
	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&not=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&not=no");
	}
}


if (isset($_POST['yenisinav'])) {

	/*echo $_POST['odev_baslik'].'<br>';
	echo $_POST['odev_zaman'].'<br>';
	echo $_POST['odev_teslim'].'<br>';
	echo $_POST['kullanici_id'].'<br>';
	echo $_POST['ders_id'].'<br>';
	echo $_POST['sinif_id'].'<br>';

	exit;*/

	$sinavkaydet = $db->prepare(
		"INSERT INTO sinavlar SET 
		sinav_ad=:sinav_ad,
		sinav_zaman=:sinav_zaman,
		
		kullanici_id=:kullanici_id,
		ders_id=:ders_id,
		sinif_id=:sinif_id"

	);

	$insert = $sinavkaydet->execute(array(

		'sinav_ad' => $_POST['sinav_ad'],
		'sinav_zaman' => $_POST['sinav_zaman'],

		'kullanici_id' => $_POST['kullanici_id'],
		'ders_id' => $_POST['ders_id'],
		'sinif_id' => $_POST['sinif_id']


	));

	$sinavid = $db->prepare("SELECT LAST_INSERT_ID()");

	$sinavid->execute(array());

	$sinavidal = $sinavid->fetch(PDO::FETCH_ASSOC);
	$sonsinav = $sinavidal['LAST_INSERT_ID()'];


	$sinifsor = $db->prepare("SELECT * from ogrenci where ogrenci_sinif=:ogrenci_sinif");

	$sinifsor->execute(array(
		'ogrenci_sinif' => $_POST['sinif_id']

	));

	while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {

		$sinavsinifkaydet = $db->prepare(
			"INSERT INTO sinav_ogrenci SET 
			sinav_id=:sinav_id,		
			ogrenci_id=:ogrenci_id"

		);

		$insert1 = $sinavsinifkaydet->execute(array(

			'sinav_id' => $sonsinav,
			'ogrenci_id' => $sinifcek['ogrenci_id']


		));
	}
	if ($insert and $insert1) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&not=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&not=no");
	}
}

if (isset($_POST['katilimdurum'])) {

	/*print_r($_POST);
	exit;*/

	$katilimdurum = $db->prepare("UPDATE katilim_ogrenci set  katilim_durum=:katilimdurum
		where id={$_POST['katilim_id']}");

	$update = $katilimdurum->execute(array(
		'katilimdurum' => $_POST['katilimdurum']
	));

	if ($update) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&katilim=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&katilim=no");
	}
}

if (isset($_POST['yenikatilim'])) {

	/*echo $_POST['odev_baslik'].'<br>';
	echo $_POST['odev_zaman'].'<br>';
	echo $_POST['odev_teslim'].'<br>';
	echo $_POST['kullanici_id'].'<br>';
	echo $_POST['ders_id'].'<br>';
	echo $_POST['sinif_id'].'<br>';

	exit;*/

	$katilimkaydet = $db->prepare(
		"INSERT INTO katilimlar SET 
		katilim_ad=:katilim_ad,
		katilim_zaman=:katilim_zaman,
		
		kullanici_id=:kullanici_id,
		ders_id=:ders_id,
		sinif_id=:sinif_id"

	);

	$insert = $katilimkaydet->execute(array(

		'katilim_ad' => $_POST['katilim_ad'],
		'katilim_zaman' => $_POST['katilim_zaman'],

		'kullanici_id' => $_POST['kullanici_id'],
		'ders_id' => $_POST['ders_id'],
		'sinif_id' => $_POST['sinif_id']


	));

	$katilimid = $db->prepare("SELECT LAST_INSERT_ID()");

	$katilimid->execute(array());

	$katilimidal = $katilimid->fetch(PDO::FETCH_ASSOC);
	$sonkatilim = $katilimidal['LAST_INSERT_ID()'];


	$sinifsor = $db->prepare("SELECT * from ogrenci where ogrenci_sinif=:ogrenci_sinif");

	$sinifsor->execute(array(
		'ogrenci_sinif' => $_POST['sinif_id']

	));

	while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {

		$katilimsinifkaydet = $db->prepare(
			"INSERT INTO katilim_ogrenci SET 
			katilim_id=:katilim_id,		
			ogrenci_id=:ogrenci_id"

		);

		$insert1 = $katilimsinifkaydet->execute(array(

			'katilim_id' => $sonkatilim,
			'ogrenci_id' => $sinifcek['ogrenci_id']


		));
	}
	if ($insert and $insert1) {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&katilim=ok");
	} else {
		header("Location:../production/ihtisashoca.php?ders=" . $_POST['ders_id'] . "&sinif=" . $_POST['sinif_id'] . "&katilim=no");
	}
}
if (isset($_POST['sinifsil'])) {
	$sinifkaydet = $db->prepare(
		'DELETE From sinif WHERE
		sinif_id=:sinif_id'
	);

	$delete = $sinifkaydet->execute(array(

		'sinif_id' => $_POST['sinif_id']

	));
	if ($delete) {
		$table = "sinif";
		$sql1 = "ALTER TABLE " . $table . " AUTO_INCREMENT = 1";
		$gereset = $db->query($sql1);
		header("Location:../production/sinif-duzenle.php?durum=ok");
	} else {
		header("Location:../production/sinif-duzenle.php?durum=no");
	}
}
if (isset($_POST['sinifekle'])) {
	$sinifkaydet = $db->prepare(
		'INSERT INTO sinif SET 
		sinif_ad=:sinif_ad,
		sinif_birim=:sinif_birim'

	);

	$insert = $sinifkaydet->execute(array(

		'sinif_ad' => $_POST['sinif_ad'],
		'sinif_birim' => $_POST['sinif_birim']


	));
	if ($insert) {
		header("Location:../production/sinif-duzenle.php?durum=ok");
	} else {
		header("Location:../production/sinif-duzenle.php?durum=no");
	}
}


if (isset($_POST['sinif'])) {

	$sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id");
	$sinifsor->execute(array());



	while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {

		$pst = "sinif" . $sinifcek['sinif_id'];


		$id = $_POST[$pst];

		if (isset($id)) {
			# code...

			for ($i = 0; $i < count($id); $i++) {
				$ayarkaydet = $db->prepare("UPDATE ogrenci set 	ogrenci_sinif=:ogrenci_sinif where ogrenci_id={$id[$i]}");



				$update = $ayarkaydet->execute(array(
					'ogrenci_sinif' => $sinifcek['sinif_id']
				));
				if (!$update) {
					header("Location:../production/sinif-duzenle.php?durum=no");
				}
			}
		}
	}




	if ($update) {

		header("Location:../production/sinif-duzenle.php?durum=ok");
		exit;
	}
}
//upload.php
if (isset($_POST['hdrmdegis'])) {
	$bast = $_POST['bast'];
	if ($_POST['hafizlik_durum'] == 'Ham') {
		$bitt = date('Y-m-d', strtotime("60 day", strtotime($bast)));
	} elseif ($_POST['hafizlik_durum'] == 'Şartlı') {
		$bitt = date('Y-m-d', strtotime("5 week", strtotime($bast)));
	} elseif ($_POST['ogrenci_birim'] == 3) {
		$bitt = date('Y-m-d', strtotime("90 day", strtotime($bast)));
	} else {
		$bitt = date('Y-m-d', strtotime("30 day", strtotime($bast)));
	}

	$ayarkaydet = $db->prepare("UPDATE hafizlikdurum set 

		hafizlik_durum=:hafizlik_durum,
		hafizlikdurum_bast=:hafizlikdurum_bast,
		hafizlikdurum_bitt=:hafizlikdurum_bitt
		where ogrenci_id={$_POST['ogrenci_id']}");



	$update = $ayarkaydet->execute(array(
		'hafizlik_durum' => $_POST['hafizlik_durum'],
		'hafizlikdurum_bast' => $bast,
		'hafizlikdurum_bitt' => $bitt
	));

	if ($update) {

		$url = $_POST['url'];
		header("Location:..$url");
		exit;
	} else {
		header("Location:../production/index.php?durum=hdbasarisiz");
		exit;
	}
}

if (isset($_POST['hocadegis'])) {

	$ayarkaydet = $db->prepare("UPDATE ogrenci set 

		kullanici_id=:kullanici_id
		
		where ogrenci_id={$_POST['ogrenci_id']}");



	$update = $ayarkaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id']
	));
	$url = $_POST['url'];
	if ($update) {

		header("Location:..$url");
		exit;
	} else {
		header("Location:../production/index.php?durum=hdbasarisiz");
		exit;
	}
}


if (isset($_POST['sinifdegis'])) {

	$ayarkaydet = $db->prepare("UPDATE ogrenci set 

		ogrenci_sinif=:ogrenci_sinif
		
		where ogrenci_id={$_POST['ogrenci_id']}");



	$update = $ayarkaydet->execute(array(
		'ogrenci_sinif' => $_POST['ogrenci_sinif']
	));

	if ($update) {

		header("Location:../production/ogrenci.php?");
		exit;
	} else {
		header("Location:../production/index.php?durum=hdbasarisiz");
		exit;
	}
}



//HAfızlık dersi ekleme
if (isset($_POST['ders'])) {



	$hafizlikdurum = explode('.', $_POST['hafizlik_durum']);
	if (isset($hafizlikdurum[1]) and $hafizlikdurum[1] == 'Has') {
		$imlec = 1 / (2 ** $hafizlikdurum[0]);
		$sayfa = $_POST['sayfa'];
	}
	/**elseif ($_POST['ogrenci_birim']==3) {
		$imlec = 1/2;
		$sayfa=5;
	}*/

	else {
		$imlec = 1;
		$sayfa = $_POST['sayfa'];
	}


	$derskaydet = $db->prepare(
		'INSERT INTO hfzlkyni SET 
		ogrenci_id=:ogrenci_id,
		kullanici_id=:kullanici_id,
		hafizlik_sayfa=:hafizlik_sayfa,
		hafizlik_cuz=:hafizlik_cuz,
		hafizlik_hata=:hafizlik_hata,
		hafizlik_usul=:hafizlik_usul,
        hafizlik_durum=:hafizlik_durum,
		hafizlik_topl=:hafizlik_topl,
		hafizlik_trh=:hafizlik_trh'

	);

	$insert = $derskaydet->execute(array(

		'ogrenci_id' => $_POST['ogrenci_id'],
		'kullanici_id' => $_POST['kullanici_id'],
		'hafizlik_sayfa' => $_POST['sayfa'],
		'hafizlik_cuz' => $_POST['cuz'],
		'hafizlik_hata' => $_POST['hafizlik_hata'],
		'hafizlik_usul' => $_POST['hafizlik_usul'],
		'hafizlik_durum' => $_POST['hafizlik_durum'],
		'hafizlik_topl' => $imlec,
		'hafizlik_trh' => $_POST['tarih']


	));





	$hafizlik_son = $_POST['sayfa'] . '/' . $_POST['cuz'];

	$raporkaydet = $db->prepare("INSERT INTO hrapor set 

		kullanici_id=:kullanici_id,
		hrapor_sayfa=:hrapor_sayfa,
		hrapor_ders=:hrapor_ders,
		hrapor_tarih=:hrapor_tarih

		");



	$raporup = $raporkaydet->execute(array(
		'kullanici_id' => $_POST['kullanici_id'],
		'hrapor_sayfa' => $sayfa,
		'hrapor_ders' => 1,
		'hrapor_tarih' => $_POST['tarih']


	));
	//	print_r($raporkaydet->errorInfo());
	//	exit;

	$ayarkaydet = $db->prepare("UPDATE hafizlikdurum set 

		hafizlik_son=:hafizlik_son
		
		where ogrenci_id={$_POST['ogrenci_id']}");



	$update = $ayarkaydet->execute(array(
		'hafizlik_son' => $hafizlik_son
	));
	//	echo $insert."-".$raporup."-".$update;
	//	exit;


	if ($insert and $raporup and $update) {

		$url = $_POST['url'];
		header("Location:..$url");
		exit;
	} else {
		exit;
		header("Location:../production/aksilik.php?hata=dersekle");
		exit;
	}

	exit;
}

if (isset($_POST['hfzlksil'])) {
	$derssil = $db->prepare(
		'DELETE From hfzlkyni WHERE
		hafizlik_id=:hafizlik_id'
	);

	$delete1 = $derssil->execute(array(

		'hafizlik_id' => $_POST['hafizlik_id']

	));

	$hraporsil = $db->prepare(
		'DELETE From hrapor WHERE
		hrapor_id=:hafizlik_id'
	);

	$delete2 = $hraporsil->execute(array(

		'hafizlik_id' => $_POST['hafizlik_id']

	));

	if ($delete1 and $delete2) {
		$url = $_POST['url'];
		header("Location:..$url");
		exit;
	} else {
		exit;
		header("Location:../production/aksilik.php?hata=dersekle");
		exit;
	}
}

if (isset($_POST['kullanicikaydet'])) {




	if (strlen($_POST['kullanici_password']) >= 6) {

		//substr ile klasör linkinin ilk 6 hanesi yani klasöre kadar olan kısmını seçiyoruz  2. / ekliyoruz  3. rastgele ürettiğimiz sayıyı ekleyip yeni benzersiz bir sayı üretiyoruz.
		$kullanici_password = $_POST['kullanici_password'];

		$kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_mail=:mail");
		$kullanicisor->execute(array(
			'mail' => $_POST['kullanici_mail']
		));


		$say = $kullanicisor->rowCount();

		if ($say == 0) {


			//md5 fonksiyonu php içinde vardır şifreyi md5 şifreli hale getirir
			$password = md5($kullanici_password);


			$uploads_dir = '../dimg/personel'; //resimlerin yükleneceği klasör birde forma bunu ekle enctype="multipart/form-data"
			@$tmp_name = $_FILES['kullanici_resim']["tmp_name"]; //önbelleğe alınıyor
			@$name = $_FILES['kullanici_resim']["name"]; //isim veriliyor

			$benzersizsayi4 = rand(20000, 32000); //rastgele sayı üretiyor
			$refimgyol = substr($uploads_dir, 3) . "/" . $benzersizsayi4 . $name;



			@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

			$kullanicikaydet = $db->prepare("INSERT into kullanici SET
				kullanici_resim=:kullanici_resim,
				kullanici_adsoyad=:kullanici_adsoyad,
				
				kullanici_dt=:kullanici_dt,
				
				kullanici_gsm=:kullanici_gsm,
				kullanici_adres=:kullanici_adres,
				kullanici_mail=:kullanici_mail,
				kullanici_birim=:kullanici_birim,
				kullanici_yetki=:kullanici_yetki,
				kullanici_password=:kullanici_password
				");

			$insert = $kullanicikaydet->execute(array(
				'kullanici_resim' => $refimgyol,
				'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],

				'kullanici_dt' => $_POST['kullanici_dt'],

				'kullanici_gsm' => $_POST['kullanici_gsm'],
				'kullanici_adres' => $_POST['kullanici_adres'],
				'kullanici_mail' => $_POST['kullanici_mail'],
				'kullanici_birim' => $_POST['kullanici_birim'],
				'kullanici_yetki' => $_POST['kullanici_yetki'],
				'kullanici_password' => $password
			));
			// print_r($kullanicikaydet->errorInfo());
			// exit;

			if ($insert) {


				header("Location:../production/kullanici.php");
			} else {

				header("Location:../production/kullanici-ekle.php?durum=basarisiz");
			}
		} elseif (!$say == 0) {

			header("Location:../production/kullanici-ekle.php?durum=mukarrerkayit");
		}
	} else {

		header("Location:../production/kullanici-ekle.php?durum=eksiksifre");
	}
}

if (isset($_POST['kullaniciduzenle'])) {

	$kullanici_id = $_POST['kullanici_id'];

	$password = $_POST['eski_password'];

	$resim_yol = "";

	// exit;//isim veriliyor




	$uploads_dir = '../dimg/ogrenci/dokumans';

	if (strlen($_POST['deger_resim']) > 0) {

		@$resim_tmp = $_FILES['kullanici_resim']["tmp_name"]; //önbelleğe alınıyor
		@$resim_name = $_FILES['kullanici_resim']["name"]; //isim veriliyor
		$benzersizresim = rand(20000, 32000);
		$resim_yol = substr($uploads_dir, 3) . "/" . $benzersizresim . "-resim-" . $resim_name;
		@move_uploaded_file($resim_tmp, "$uploads_dir/$benzersizresim-resim-$resim_name");
		$sil = $_POST['eski_resim'];
		unlink("../$sil");
	} else {

		$resim_yol = $_POST['eski_resim'];
	}


	if (strlen($_POST['kullanici_password']) >= 6) {


		$password = md5($_POST['kullanici_password']);
	}
	$ayarkaydet = $db->prepare("UPDATE kullanici set 

		kullanici_resim=:kullanici_resim,
		kullanici_adsoyad=:kullanici_adsoyad,
		kullanici_dt=:kullanici_dt,
		kullanici_gsm=:kullanici_gsm,
		kullanici_mail=:kullanici_mail,
		kullanici_adres=:kullanici_adres,		
		kullanici_yetki=:kullanici_yetki,
		kullanici_sinif=:kullanici_sinif,
		kullanici_birim=:kullanici_birim,
		kullanici_password=:kullanici_password,
		kullanici_durum=:kullanici_durum
		where kullanici_id={$_POST['kullanici_id']}");



	$update = $ayarkaydet->execute(array(
		'kullanici_resim' => $resim_yol,
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'kullanici_dt' => $_POST['kullanici_dt'],
		'kullanici_gsm' => $_POST['kullanici_gsm'],
		'kullanici_mail' => $_POST['kullanici_mail'],
		'kullanici_adres' => $_POST['kullanici_adres'],
		'kullanici_yetki' => $_POST['kullanici_yetki'],
		'kullanici_sinif' => $_POST['kullanici_sinif'],
		'kullanici_birim' => $_POST['kullanici_birim'],
		'kullanici_password' => $password,
		'kullanici_durum' => $_POST['kullanici_durum']


	));
	//print_r($ayarkaydet->errorInfo());
	//exit;
	if ($update) {

		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok"); //eski linki silior

	} else {
		header("Location:../production/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}
}

if (isset($_POST['ogrenciekle'])) {
	echo 'burada';
	$uploads_dir = '../dimg/ogrenci/dokumans';
	/*mkdir($uploads_dir, 0711); */
	//resimlerin yükleneceği klasör
	//$kmlk_yol = "";
	$resim_yol = "";
	//	$sglk_yol = "";
	//	$belge1_yol = "";
	//	$belge2_yol = "";
	//	$belge3_yol = "";
	//kmlk
	/*	if (strlen($_POST['deger_kmlk']) > 0) {
		$kmlk_tmp = $_FILES['ogrenci_kmlk']["tmp_name"]; //önbelleğe alınıyor
		$kmlk_name = seo($_FILES['ogrenci_kmlk']["name"]); //isim veriliyor	
		$benzersizkmlk = rand(20000, 32000);
		$kmlk_yol = substr($uploads_dir, 3) . "/" . $benzersizkmlk . "-kmlk-" . $kmlk_name;
		@move_uploaded_file($kmlk_tmp, "$uploads_dir/$benzersizkmlk-kmlk-$kmlk_name");
	}*/



	//resim
	if (strlen($_POST['deger_resim']) > 0) {
		$ogrenciisim = $_POST['ogrenci_adsoyad'];
		@$resim_tmp = $_FILES['ogrenci_resim']["tmp_name"]; //önbelleğe alınıyor
		@$resim_name = seo($_FILES['ogrenci_resim']["name"]); //isim veriliyor
		$benzersizresim = rand(20000, 32000);
		$resim_yol = substr($uploads_dir, 3) . "/" . $benzersizresim . "-resim-" . seo($ogrenciisim);
		move_uploaded_file($resim_tmp, $uploads_dir . "/" . $benzersizresim . "-resim-" . seo($ogrenciisim));
	}


	//sglk

	/*	if (strlen($_POST['deger_sglk']) > 0) {
		$sglk_tmp = $_FILES['ogrenci_sglk']["tmp_name"]; //önbelleğe alınıyor
		$sglk_name = seo($_FILES['ogrenci_sglk']["name"]);
		$benzersizsglk = rand(20000, 32000);
		$sglk_yol = substr($uploads_dir, 3) . "/" . $benzersizsglk . "-sglk-" . $sglk_name;
		$sil = $_POST['eski_sglk'];
	}



	//blg1
	if (strlen($_POST['deger_belge1']) > 0) {
		$belge1_tmp = $_FILES['ogrenci_belge1']["tmp_name"]; //önbelleğe alınıyor
		$belge1_name = seo($_FILES['ogrenci_belge1']["name"]); //isim veriliyor
		$benzersizbelge1 = rand(20000, 32000);
		$belge1_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge1 . "-belge1-" . $belge1_name;

		move_uploaded_file($belge1_tmp, "$uploads_dir/$benzersizbelge1-belge1-$belge1_name");
	}



	//belge2

	if (strlen($_POST['deger_belge2']) > 0) {
		$belge2_tmp = $_FILES['ogrenci_belge2']["tmp_name"]; //önbelleğe alınıyor
		$belge2_name = seo($_FILES['ogrenci_belge2']["name"]); //isim veriliyor
		$benzersizbelge2 = rand(20000, 32000);
		$belge2_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge2 . "-belge2-" . $belge2_name;

		move_uploaded_file($belge2_tmp, "$uploads_dir/$benzersizbelge2-belge2-$belge2_name");
	}

	//belge3
	if (strlen($_POST['deger_belge3']) > 0) {
		$belge3_tmp = $_FILES['ogrenci_belge3']["tmp_name"]; //önbelleğe alınıyor
		$belge3_name = seo($_FILES['ogrenci_belge3']["name"]);
		$benzersizbelge3 = rand(20000, 32000);
		$belge3_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge3 . "-belge3-" . $belge3_name;
		@move_uploaded_file($belge3_tmp, "$uploads_dir/$benzersizbelge3-belge3-$belge3_name");
	}*/
	$kytTrh = date('Y-m-d');

	$ogrencikaydet = $db->prepare('INSERT INTO ogrenci SET
		ogrenci_resim=:ogrenci_resim,
		
		ogrenci_adsoyad=:ogrenci_adsoyad,
		
		ogrenci_dt=:ogrenci_dt,
		kullanici_id=:kullanici_id,
		ogrenci_sinif=:ogrenci_sinif,
		ogrenci_birim=:ogrenci_birim,
        ogrenci_tc=:ogrenci_tc,
		ogrenci_okuldurum=:ogrenci_okuldurum,
		ogrenci_baba=:ogrenci_baba,
		ogrenci_anne=:ogrenci_anne,
		ogrenci_babames=:ogrenci_babames,
		ogrenci_babatel=:ogrenci_babatel,
		ogrenci_annetel=:ogrenci_annetel,
		ogrenci_adres=:ogrenci_adres,
		ogrenci_not=:ogrenci_not,
		ogrenci_kytdrm=:ogrenci_kytdrm,
        ogrenci_kytTrh=:ogrenci_kytTrh
		
		');

	$insert = $ogrencikaydet->execute(array(
		'ogrenci_resim' => $resim_yol,

		'ogrenci_adsoyad' => $_POST['ogrenci_adsoyad'],

		'ogrenci_dt' => $_POST['ogrenci_dt'],
		'kullanici_id' => $_POST['kullanici_id'],
		'ogrenci_sinif' => $_POST['ogrenci_sinif'],
		'ogrenci_tc' => $_POST['ogrenci_tc'],
		'ogrenci_birim' => $_POST['ogrenci_birim'],
		'ogrenci_okuldurum' => $_POST['ogrenci_okuldurum'],
		'ogrenci_baba' => $_POST['ogrenci_baba'],
		'ogrenci_anne' => $_POST['ogrenci_anne'],
		'ogrenci_babames' => $_POST['ogrenci_babames'],
		'ogrenci_babatel' => $_POST['ogrenci_babatel'],
		'ogrenci_annetel' => $_POST['ogrenci_annetel'],
		'ogrenci_adres' => $_POST['ogrenci_adres'],
		'ogrenci_not' => $_POST['ogrenci_not'],
		'ogrenci_kytdrm' => $_POST['ogrenci_kytdrm'],
		'ogrenci_kytTrh' => $kytTrh,


	));
	/* print_r($ogrencikaydet->errorInfo());
	exit; */
	if ($insert) {
		$ogrenciid = $db->prepare("SELECT LAST_INSERT_ID()");

		$ogrenciid->execute(array());

		$ogrenciidal = $ogrenciid->fetch(PDO::FETCH_ASSOC);
		$sonkayit = $ogrenciidal['LAST_INSERT_ID()'];

		$hafizlikdurumkaydet = $db->prepare('INSERT INTO hafizlikdurum SET
				ogrenci_id=:ogrenci_id,
				hafizlikdurum_id=:hafizlikdurum_id

				');

		$hdinsert = $hafizlikdurumkaydet->execute(array(
			'ogrenci_id' => $sonkayit,
			'hafizlikdurum_id' => $sonkayit
		));


		if ($hdinsert) {
			header("Location:../production/ogrenci.php?durum=ok");
		} else {

			header("Location:../production/ogrenci-ekle.php?durum=no");
		}
	}
}

if (isset($_POST['ogrenciduzenle'])) {


	//resimlerin yükleneceği klasör

	//kmlk

	//kmlk

	/*if (strlen($_POST['deger_kmlk']) > 0) {
		$kmlk_tmp = $_FILES['ogrenci_kmlk']["tmp_name"]; //önbelleğe alınıyor
		$kmlk_name = seo($_FILES['ogrenci_kmlk']["name"]); //isim veriliyor	
		$benzersizkmlk = rand(20000, 32000);
		$kmlk_yol = substr($uploads_dir, 3) . "/" . $benzersizkmlk . "-kmlk-" . $kmlk_name;
		@move_uploaded_file($kmlk_tmp, "$uploads_dir/$benzersizkmlk-kmlk-$kmlk_name");
		$sil = $_POST['eski_kmlk'];
		unlink("../$sil");
	} else {

		$kmlk_yol = $_POST['eski_kmlk'];
	}*/



	//resim




	//sglk

	/*if (strlen($_POST['deger_sglk']) > 0) {
		$sglk_tmp = $_FILES['ogrenci_sglk']["tmp_name"]; //önbelleğe alınıyor
		$sglk_name = seo($_FILES['ogrenci_sglk']["name"]);
		$benzersizsglk = rand(20000, 32000);
		$sglk_yol = substr($uploads_dir, 3) . "/" . $benzersizsglk . "-sglk-" . $sglk_name;
		$sil = $_POST['eski_sglk'];
		unlink("../$sil");
		move_uploaded_file($sglk_tmp, "$uploads_dir/$benzersizsglk-sglk-$sglk_name");
	} else {


		$sglk_yol = $_POST['eski_sglk'];
	}



	//blg1
	if (strlen($_POST['deger_belge1']) > 0) {
		$belge1_tmp = $_FILES['ogrenci_belge1']["tmp_name"]; //önbelleğe alınıyor
		$belge1_name = seo($_FILES['ogrenci_belge1']["name"]); //isim veriliyor
		$benzersizbelge1 = rand(20000, 32000);
		$belge1_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge1 . "-belge1-" . $belge1_name;
		$sil = $_POST['eski_belge1'];
		unlink("../$sil");
		move_uploaded_file($belge1_tmp, "$uploads_dir/$benzersizbelge1-belge1-$belge1_name");
	} else {

		$belge1_yol = $_POST['eski_belge1'];
	}



	//belge2

	if (strlen($_POST['deger_belge2']) > 0) {
		$belge2_tmp = $_FILES['ogrenci_belge2']["tmp_name"]; //önbelleğe alınıyor
		$belge2_name = seo($_FILES['ogrenci_belge2']["name"]); //isim veriliyor
		$benzersizbelge2 = rand(20000, 32000);
		$belge2_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge2 . "-belge2-" . $belge2_name;
		$sil = $_POST['eski_belge2'];
		unlink("../$sil");
		move_uploaded_file($belge2_tmp, "$uploads_dir/$benzersizbelge2-belge2-$belge2_name");
	} else {


		$belge2_yol = $_POST['eski_belge2'];
	}

	//belge3
	if (strlen($_POST['deger_belge3']) > 0) {
		$belge3_tmp = $_FILES['ogrenci_belge3']["tmp_name"]; //önbelleğe alınıyor
		$belge3_name = seo($_FILES['ogrenci_belge3']["name"]);
		$benzersizbelge3 = rand(20000, 32000);
		$belge3_yol = substr($uploads_dir, 3) . "/" . $benzersizbelge3 . "-belge3-" . $belge3_name;
		@move_uploaded_file($belge3_tmp, "$uploads_dir/$benzersizbelge3-belge3-$belge3_name");
		$sil = $_POST['eski_belge3'];
		unlink("../$sil");
	} else {

		$belge3_yol = $_POST['eski_belge3'];
	}*/

	// echo $_POST['eski_resim'];
	// exit;//isim veriliyor
	$ogrenci_id = $_POST['ogrenci_id'];
	$uploads_dir = '../dimg/ogrenci/dokumans';


	if (strlen($_POST['deger_resim']) > 0) {
		$ogrenciisim = $_POST['ogrenci_adsoyad'];
		@$resim_tmp = $_FILES['ogrenci_resim']["tmp_name"]; //önbelleğe alınıyor
		@$resim_name = $_FILES['ogrenci_resim']["name"]; //isim veriliyor
		$benzersizresim = rand(20000, 32000);
		$resim_yol = substr($uploads_dir, 3) . "/" . $benzersizresim . "-resim-" . seo($ogrenciisim);
		move_uploaded_file($resim_tmp, $uploads_dir . "/" . $benzersizresim . "-resim-" . seo($ogrenciisim));
		$sil = $_POST['eski_resim'];
		unlink("../$sil");
	} else {

		$resim_yol = $_POST['eski_resim'];
	}
	if ($_POST['ogrenci_kytdrm'] == 0 && $_POST['ogrenci_mznTrh'] == null) {
		$mznTrh = date('Y-m-d');
	} else {
		$mznTrh = null;
	}
	$ayarkaydet = $db->prepare("UPDATE ogrenci set 
		ogrenci_resim=:ogrenci_resim,
		
		ogrenci_adsoyad=:ogrenci_adsoyad,
		
		ogrenci_dt=:ogrenci_dt,
		kullanici_id=:kullanici_id,
		ogrenci_sinif=:ogrenci_sinif,
        ogrenci_tc=:ogrenci_tc,
		ogrenci_birim=:ogrenci_birim,
		ogrenci_okuldurum=:ogrenci_okuldurum,
		ogrenci_baba=:ogrenci_baba,
		ogrenci_anne=:ogrenci_anne,
		ogrenci_babames=:ogrenci_babames,
		ogrenci_babatel=:ogrenci_babatel,
		ogrenci_annetel=:ogrenci_annetel,
		ogrenci_adres=:ogrenci_adres,
		ogrenci_not=:ogrenci_not,
		ogrenci_kytdrm=:ogrenci_kytdrm,
        ogrenci_kytTrh=:ogrenci_kytTrh,
        ogrenci_mznTrh=:ogrenci_mznTrh
		where ogrenci_id={$_POST['ogrenci_id']}");

	$update = $ayarkaydet->execute(array(
		'ogrenci_resim' => $resim_yol,

		'ogrenci_adsoyad' => $_POST['ogrenci_adsoyad'],

		'ogrenci_dt' => $_POST['ogrenci_dt'],
		'kullanici_id' => $_POST['kullanici_id'],
		'ogrenci_sinif' => $_POST['ogrenci_sinif'],
		'ogrenci_tc' => $_POST['ogrenci_tc'],
		'ogrenci_birim' => $_POST['ogrenci_birim'],
		'ogrenci_okuldurum' => $_POST['ogrenci_okuldurum'],
		'ogrenci_baba' => $_POST['ogrenci_baba'],
		'ogrenci_anne' => $_POST['ogrenci_anne'],
		'ogrenci_babames' => $_POST['ogrenci_babames'],
		'ogrenci_babatel' => $_POST['ogrenci_babatel'],
		'ogrenci_annetel' => $_POST['ogrenci_annetel'],
		'ogrenci_adres' => $_POST['ogrenci_adres'],
		'ogrenci_not' => $_POST['ogrenci_not'],
		'ogrenci_kytdrm' => $_POST['ogrenci_kytdrm'],
		'ogrenci_kytTrh' => $_POST['ogrenci_kytTrh'],
		'ogrenci_mznTrh' => $mznTrh

	));
	//print_r($ayarkaydet->errorInfo());
	//   exit;
	if ($update) {

		header("Location:../production/ogrenci-duzenle.php?ogrenci_id=$ogrenci_id&durum=ok"); //eski linki silior

	} else {

		header("Location:../production/ogrenci-duzenle.php?ogrenci_id=$ogrenci_id&durum=no");
	}
}




if (isset($_GET['kullanicisil']) && $_GET['kullanicisil'] == "ok") {


	$sil = $db->prepare("DELETE from kullanici where kullanici_id=:id");

	$kontrol = $sil->execute(array(
		'id' => $_GET['kullanici_id']
	));

	if ($kontrol) {

		header("Location:../production/kullanici.php?sil=ok");
		# code...
	} else {

		header("Location:../production/kullanici.php?sil=no");
	}
}


if (isset($_GET['ogrencisil']) && $_GET['ogrencisil'] == "ok") {

	$kytdrm = 0;

	$ogrenci_id = $_GET['ogrenci_id'];

	$ayarkaydet = $db->prepare("UPDATE ogrenci set 
		ogrenci_kytdrm=:ogrenci_kytdrm,ogrenci_mznTrh=:ogrenci_mznTrh where ogrenci_id=$ogrenci_id");



	$update = $ayarkaydet->execute(array(

		'ogrenci_kytdrm' => $kytdrm,
		'ogrenci_mznTrh' => date('Y-m-d')


	));

	if ($update) {

		header("Location:../production/ogrenci.php?sil=ok");
	} else {

		header("Location:../production/ogrenci.php?sil=no");
	}
}



if (isset($_POST['aidat'])) {



	/**elseif ($_POST['ogrenci_birim']==3) {
		$imlec = 1/2;
		$sayfa=5;
	}*/

	if ($_POST['donem'] == 1) {
		$aciklama = date('Y-m', strtotime($_POST['aidat_ay'])) . ' ÖDEME BEDELİ';
	} elseif ($_POST['donem'] < 3) {

		$aciklama = date('Y-m', strtotime($_POST['aidat_ay'])) . ' VE ' . date('Y-m', strtotime($_POST['aidat_ay'] . ' +1'  . 'month')) . ' ÖDEME BEDELİ';
	} else {
		$aciklama = date('Y-m', strtotime($_POST['aidat_ay'])) . ' VE ' . date('Y-m', strtotime($_POST['aidat_ay'] . ' +' . ($_POST['donem'] - 1)  . 'month')) . ' ARASI ÖDEME BEDELİ';
	}
	$makbuzkaydet = $db->prepare(
		'INSERT INTO makbuz SET 
		makbuz_adsoyad=:makbuz_adsoyad,
		kullanici_adsoyad=:kullanici_adsoyad,
		makbuz_tutar=:makbuz_tutar,
		makbuz_kur=:makbuz_kur,
		makbuz_odeme_sekli=:makbuz_odeme_sekli,
		makbuz_tarih=:makbuz_tarih,
		makbuz_aciklama=:makbuz_aciklama'

	);

	$makbuz = $makbuzkaydet->execute(array(

		'makbuz_adsoyad' => $_POST['makbuz_adsoyad'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'makbuz_tutar' => $_POST['tutar'],
		'makbuz_kur' => $_POST['kur'],
		'makbuz_odeme_sekli' => $_POST['aidat_odeme_sekli'],
		'makbuz_tarih' => $_POST['tarih'],
		'makbuz_aciklama' => $aciklama,



	));

	$makbuzsor = $db->prepare("SELECT * FROM makbuz ORDER BY makbuz_id DESC LIMIT 1;");
	$makbuzsor->execute(array());

	$makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);
	$tutar = $_POST['tutar'] / $_POST['donem'];
	for ($i = 0; $i < $_POST['donem']; $i++) {
		$aidatkaydet = $db->prepare(
			'INSERT INTO aidat SET 
		ogrenci_id=:ogrenci_id,
		kullanici_id=:kullanici_id,
		aidat_tutar=:aidat_tutar,
		aidat_kur=:aidat_kur,
		aidat_odeme_sekli=:aidat_odeme_sekli,
		aidat_ay=:aidat_ay,
		aidat_makbuz=:aidat_makbuz,
        aidat_tarih=:aidat_tarih'

		);

		$insert = $aidatkaydet->execute(array(

			'ogrenci_id' => $_POST['ogrenci_id'],
			'kullanici_id' => $_POST['kullanici_id'],
			'aidat_tutar' => $tutar,
			'aidat_kur' => $_POST['kur'],
			'aidat_odeme_sekli' => $_POST['aidat_odeme_sekli'],
			'aidat_ay' => date('Y-m', strtotime($_POST['aidat_ay'] . ' +' . $i . 'month')),
			'aidat_makbuz' => $makbuzcek['makbuz_id'],
			'aidat_tarih' => $_POST['tarih']


		));
	}



	if ($insert && $makbuz) {

		$url = $_POST['url'];

		header("Location:../production/ogrenci-detay?ogrenci_id=" . $_POST['ogrenci_id'] . '&makbuz_no=' . $makbuzcek['makbuz_id']);
	} else {
		print_r($makbuzsor->errorInfo());
		print_r($aidatkaydet->errorInfo());
		exit;
		header("Location:../production/aksilik.php?hata=dersekle");
		exit;
	}

	exit;
}

if (isset($_POST['makbuzekle'])) {



	/**elseif ($_POST['ogrenci_birim']==3) {
		$imlec = 1/2;
		$sayfa=5;
	}*/

	$makbuzkaydet = $db->prepare(
		'INSERT INTO makbuz SET 
		makbuz_adsoyad=:makbuz_adsoyad,
		kullanici_adsoyad=:kullanici_adsoyad,
		makbuz_tutar=:makbuz_tutar,
		makbuz_kur=:makbuz_kur,
		makbuz_odeme_sekli=:makbuz_odeme_sekli,
		makbuz_tarih=:makbuz_tarih,
		makbuz_aciklama=:makbuz_aciklama'

	);

	$makbuz = $makbuzkaydet->execute(array(

		'makbuz_adsoyad' => $_POST['makbuz_adsoyad'],
		'kullanici_adsoyad' => $_POST['kullanici_adsoyad'],
		'makbuz_tutar' => $_POST['tutar'],
		'makbuz_kur' => $_POST['kur'],
		'makbuz_odeme_sekli' => $_POST['makbuz_odeme_sekli'],
		'makbuz_tarih' => $_POST['tarih'],
		'makbuz_aciklama' => $_POST['makbuz_aciklama'],



	));



	$makbuzsor = $db->prepare("SELECT * FROM makbuz ORDER BY makbuz_id DESC LIMIT 1;");
	$makbuzsor->execute(array());

	$makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);

	if ($makbuz) {

		$url = $_POST['url'];
		header("Location:../production/muhasebe?makbuz_no=" . $makbuzcek['makbuz_id']);
	} else {
		print_r($makbuzsor->errorInfo());
		print_r($aidatkaydet->errorInfo());
		exit;
		header("Location:../production/aksilik.php?hata=makbuzekle");
		exit;
	}

	exit;
}
if (isset($_GET['makbuz_id'])) {
	$makbuz_sil = $db->prepare("DELETE FROM makbuz where makbuz_id=:makbuz_id");
	$delete1 = $makbuz_sil->execute(array('makbuz_id' => $_GET['makbuz_id']));
	$aidat_sil = $db->prepare("DELETE FROM aidat where aidat_makbuz=:aidat_makbuz");
	$delete2 = $aidat_sil->execute(array('aidat_makbuz' => $_GET['makbuz_id']));

	if ($delete1) {

		header("Location:../production/muhasebe");
	} else {
		print_r($makbuz_sil->errorInfo());

		exit;
		header("Location:../production/aksilik.php?hata=makbuzsil");
		exit;
	}
}


if (isset($_POST['aidatduzenle'])) {

	$aidatsor = $db->prepare("SELECT * FROM aidat where aidat_id=:id ;");
	$aidatsor->execute(array(
		'id' => $_POST['aidat_id']
	));
	$aidatcek = $aidatsor->fetch(PDO::FETCH_ASSOC);

	$fark = $_POST['tutar'] - $aidatcek['aidat_tutar'];
	$makbuzsor = $db->prepare("SELECT * FROM makbuz where makbuz_id=:id ;");
	$makbuzsor->execute(array(
		'id' => $aidatcek['aidat_makbuz']
	));
	$makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);
	$aidatduzenle = $db->prepare("UPDATE aidat set 
		aidat_tarih=:aidat_tarih,
		aidat_ay=:aidat_ay,
		aidat_tutar=:aidat_tutar,
		aidat_kur=:aidat_kur,
		aidat_odeme_sekli=:aidat_odeme_sekli
	 where aidat_id={$_POST['aidat_id']}");
	$update = $aidatduzenle->execute(array(
		'aidat_tarih' => $_POST['tarih'],
		'aidat_ay' => $_POST['aidat_ay'],
		'aidat_tutar' => $_POST['tutar'],
		'aidat_kur' => $_POST['kur'],
		'aidat_odeme_sekli' => $_POST['aidat_odeme_sekli']

	));
	$sonaciklama = $makbuzcek['makbuz_aciklama'] . "\r" . $aidatcek['aidat_ay'] . " Tarihli ödeme değişikliğe uğramıştır. ";
	if ($fark != 0) {
		$sontutar = $makbuzcek['makbuz_tutar'] + $fark;

		$makbuzuzenle = $db->prepare("UPDATE makbuz set 
		makbuz_tutar=:makbuz_tutar,
		makbuz_kur=:makbuz_kur,
		makbuz_odeme_sekli=:makbuz_odeme_sekli,
		makbuz_tarih=:makbuz_tarih,
		makbuz_aciklama=:makbuz_aciklama
	 where makbuz_id={$makbuzcek['makbuz_id']}");
		$updatem = $makbuzuzenle->execute(array(
			'makbuz_tutar' => $sontutar,

			'makbuz_kur' => $_POST['kur'],
			'makbuz_odeme_sekli' => $_POST['aidat_odeme_sekli'],
			'makbuz_tarih' => $_POST['tarih'],
			'makbuz_aciklama' => $sonaciklama,

		));
	} else {

		$makbuzuzenle = $db->prepare("UPDATE makbuz set 
		
		makbuz_kur=:makbuz_kur,
		makbuz_odeme_sekli=:makbuz_odeme_sekli,
		makbuz_tarih=:makbuz_tarih,
		makbuz_aciklama=:makbuz_aciklama
	 where makbuz_id={$makbuzcek['makbuz_id']}");
		$updatem = $makbuzuzenle->execute(array(

			'makbuz_kur' => $_POST['kur'],
			'makbuz_odeme_sekli' => $_POST['aidat_odeme_sekli'],
			'makbuz_tarih' => $_POST['tarih'],
			'makbuz_aciklama' => $sonaciklama,

		));
	}

	if ($update) {

		$url = $_POST['url'];

		header("Location:../production/ogrenci-detay?ogrenci_id=" . $_POST['ogrenci_id']);
	} else {
		print_r($makbuzuzenle->errorInfo());
		print_r($aidatduzenle->errorInfo());
		exit;
		header("Location:../production/aksilik.php?hata=dersekle");
		exit;
	}

	exit;
}

if (isset($_POST['aidat_sil'])) {
	$makbuzsor = $db->prepare("SELECT * FROM makbuz where makbuz_id=:id ;");
	$makbuzsor->execute(array(
		'id' => $_POST['aidat_makbuz']
	));
	$makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);
	$fark = $_POST['tutar'] - $makbuzcek['makbuz_tutar'];

	$aidat_sil = $db->prepare("DELETE FROM aidat where aidat_id=:aidat_id");
	$delete1 = $aidat_sil->execute(array('aidat_id' => $_POST['aidat_id']));
	if ($fark == 0) {
		$makbuz_sil = $db->prepare("DELETE FROM makbuz where makbuz_id=:makbuz_id");
		$delete1 = $makbuz_sil->execute(array('makbuz_id' => $_POST['makbuz_id']));
	} else {
		if ($fark < 0) {
			$fark = $fark * (-1);
		}
		$sonaciklama = $makbuzcek['makbuz_aciklama'] . "\n" . $_POST['aidat_ay'] . ' Tarihli aidat silinmiştir. ';
		$makbuzuzenle = $db->prepare("UPDATE makbuz set 
		makbuz_tutar=:makbuz_tutar,
		makbuz_aciklama=:makbuz_aciklama
	 where makbuz_id={$_POST['aidat_makbuz']}");
		$delete1 = $makbuzuzenle->execute(array(
			'makbuz_tutar' => $fark,
			'makbuz_aciklama' => $sonaciklama

		));
	}
	if ($delete1) {

		header("Location:../production/ogrenci-detay?ogrenci_id=" . $_POST['ogrenci_id']);
	} else {
		print_r($makbuzuzenle->errorInfo());

		exit;
		header("Location:../production/aksilik.php?hata=aidatsil");
		exit;
	}
}


if (isset($_POST['makbuzduzenle'])) {



	$makbuzduzenle = $db->prepare("UPDATE makbuz set 
		makbuz_tutar=:makbuz_tutar,
		makbuz_kur=:makbuz_kur,
		makbuz_adsoyad=:makbuz_adsoyad,
		makbuz_odeme_sekli=:makbuz_odeme_sekli,
		makbuz_tarih=:makbuz_tarih,
		makbuz_aciklama=:makbuz_aciklama

	 where makbuz_id={$_POST['makbuz_id']}");
	$update = $makbuzduzenle->execute(array(
		'makbuz_tutar' => $_POST['tutar'],
		'makbuz_kur' => $_POST['kur'],
		'makbuz_adsoyad' => $_POST['makbuz_adsoyad'],
		'makbuz_odeme_sekli' => $_POST['makbuz_odeme_sekli'],
		'makbuz_tarih' => $_POST['tarih'],
		'makbuz_aciklama' => $_POST['makbuz_aciklama']


	));


	if ($update) {


		header("Location:../production/muhasebe");
	} else {
		print_r($makbuzduzenle->errorInfo());

		exit;
		header("Location:../production/aksilik.php?hata=dersekle");
		exit;
	}
}
exit;