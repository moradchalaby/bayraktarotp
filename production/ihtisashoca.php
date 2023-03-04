<?php 
require_once '../netting/baglan.php';


require_once 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ

//tüm kullanıcılar için kullanici
$derssor=$db->prepare("SELECT * FROM sinif_ders where hoca_id=:hoca_id and ders_id=:ders_id");
$derssor->execute(array(

  
  'ders_id' => $_GET['ders']
));

$derscek=$derssor->fetch(PDO::FETCH_ASSOC);

$odevsor=$db->prepare("SELECT * FROM odevler where sinif_id=:sinif_id and ders_id=:ders_id order by odev_teslim desc");
$odevsor->execute(array(

  
  'sinif_id' => $_GET['sinif'],
  'ders_id' => $_GET['ders']
));

$sinavsor=$db->prepare("SELECT * FROM sinavlar where sinif_id=:sinif_id and ders_id=:ders_id order by sinav_id desc");
$sinavsor->execute(array(

  
  'sinif_id' => $_GET['sinif'],
  'ders_id' => $_GET['ders']
));

$katilimsor=$db->prepare("SELECT * FROM katilimlar where sinif_id=:sinif_id and ders_id=:ders_id order by katilim_id desc");
$katilimsor->execute(array(

  
  'sinif_id' => $_GET['sinif'],
  'ders_id' => $_GET['ders']
));


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
  <?php require_once 'ihtisashocaf/odev.php'; ?>

    <div class="clearfix"></div>
   
<?php require_once 'ihtisashocaf/imtihan.php'; ?>

  <div class="clearfix"></div>
   
<?php require_once 'ihtisashocaf/katilim.php'; ?>

    </div>
  </div>




  <?php require_once 'footer.php'; ?>
