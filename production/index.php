<?php


include 'header.php';

// if ($kullanicicek['kullanici_yetki']==5 ) {
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1
//   ));
// }elseif ($kullanicicek['kullanici_yetki']==4) {
//   $birim = $kullanicicek['kullanici_birim'];
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim ");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1,
//     'birim' => $birim
//   ));
// }elseif ($kullanicicek['kullanici_yetki']<=3) {

//   $birim = $kullanicicek['kullanici_birim'];
//   $sinif = $kullanicicek['kullanici_sinif'];
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim and ogrenci_sinif=:sinif ");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1,
//     'birim' => $birim,
//     'sinif' => $sinif
//   ));
// }





?>
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">

                <?php
        //echo 'Uzak Host: '. gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $birimsor = $db->prepare("SELECT * from birim where birim_id=:birim_id");
        $birimsor->execute(array(
          'birim_id' => $kullanicicek['kullanici_birim']
        ));

        $birimcek = $birimsor->fetch(PDO::FETCH_ASSOC);


        ?>



                <h3>Ana Sayfa <small><?php echo $birimcek['birim_ad'] ?></small></h3>
            </div>


            <?php
      if ($kullanicicek['kullanici_yetki'] == 4) {
        if (strlen($_GET['hoca']) > 0) {





          $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=1 and kullanici_id=:sinif order by ogrenci_adsoyad asc");
          $ogrencisor->execute(array(

            'sinif' => $_GET['hoca']

          ));
          include 'rapordeneme.php';
        } else {
          /*  $kullanici_id = $kullanicicek['kullanici_id'];
        $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:ogrenci_birim order by ogrenci_adsoyad asc");
        $ogrencisor->execute(array(

          'kytdrm'=> 1,
          'ogrenci_birim' => $birimler
        )); */

          include 'rapordeneme.php';   ?>

            <?php }
      } elseif ($kullanicicek['kullanici_yetki'] <= 3) {


        $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm  and kullanici_id=:kullanici_id order by ogrenci_adsoyad asc ");
        $ogrencisor->execute(array(

          'kytdrm' => 1,
          'kullanici_id' => $kullanicicek['kullanici_id']
        ));

        include 'rapordeneme.php';
      } elseif ($kullanicicek['kullanici_yetki'] >= 5) {



        include 'hocapuantaj.php';
      }
      if ($_GET['durum'] == 'loginbasarili') {
        include 'modallar/guncellemodal.php';
      }
      ?>
        </div>
    </div>
</div>
<!-- /page content -->

<?php
include 'footer.php';
?>