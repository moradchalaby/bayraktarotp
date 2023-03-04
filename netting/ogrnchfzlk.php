<?php
include '../netting/baglan.php';


include 'header.php';

//BELİRLİ VERİYİ SEÇME İŞLEMİ



$ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm");
$ogrencisor->execute(array(

  'kytdrm' => 1
));

if (isset($_GET['tablo'])) {


  $date1 = $_GET['date1'];
  $hafizlik_trh1 = date('Y-m-d',  strtotime($date1));

  if (!empty($_GET['date2'])) {
    $tarih1 = date_create($_GET['date1']);
    $tarih2 = date_create($_GET['date2']);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");
    // $gun = intval(date('d.m',strtotime($_GET['date1'])-strtotime($_GET['date2'])))-1;
    $date2 = $_GET['date2'];
    $hafizlik_trh2 = date('Y-m-d', strtotime($date2));
  } else {
    $gun = 0;
    $date2 = $_GET['date1'];
    $hafizlik_trh2 = $hafizlik_trh1;
  }

  $ogrencisor = $db->prepare("SELECT * FROM ogrenci  RIGHT JOIN  hfzlkyni on ogrenci.ogrenci_id = hfzlkyni.ogrenci_id  WHERE (hfzlkyni.hafizlik_trh BETWEEN :trh2 AND :trh1) order by ogrenci.ogrenci_adsoyad  asc ");
  $ogrencisor->execute(array(
    'trh1' => $hafizlik_trh1,
    'trh2' => $hafizlik_trh2
  ));
}


// $gun = floatval($_GET['gun'])-1;

?>




setlocale(LC_TIME, "turkish");

?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Öğrenci Hafızlık Listeleri<small>
            </div>


        </div>

    </div>

    <div class="x_content">
        <br />

        <!-- (/) => bu işaret en kök dizine çıkar (../) => bir ğst dizine çık  -->
        <form action="#" method="GET" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



            <div class="form-group">

                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlangıç Tarihi<span
                        class="required">*</span>
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <input type="date" id="first-name" value="<?php echo $_GET['date2']; ?>" name="date2"
                        class="form-control col-md-7 col-xs-12">

                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bitiş Tarihi<span
                        class="required">*</span>
                </label>
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <input type="date" id="first-name" name="date1" value="<?php if (isset($_GET['date1'])) {
                                                                    echo  $_GET['date1'];
                                                                  } else {
                                                                    echo date("Y-m-d");
                                                                  } ?>" required="required"
                        class="form-control col-md-7 col-xs-12">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sayfa<span
                        class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-2 col-xs-12">
                    <input type="text" id="first-name" name="sayfa" value="<?php if (isset($_GET['sayfa'])) {
                                                                    echo  $_GET['sayfa'];
                                                                  } else {
                                                                    echo "0";
                                                                  } ?>" placeholder="Sayfa"
                        class="form-control col-md-7 col-xs-12">
                </div>





                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Sınıf<span
                        class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-2 col-xs-12">
                    <?php
          $sinifsor = $db->prepare("SELECT * from sinif where sinif_id order by sinif_ad asc");

          $sinifsor->execute(array()); // sinifleri bulup seç

          ?>
                    <style type="text/css">
                    select {

                        text-align: center;
                        text-align-last: center;
                        /* webkit*/
                    }

                    option {
                        font-size: 20px;
                        text-align-last: center;
                        /* reset to left*/
                    }
                    </style>
                    <select class="select2_multiple form-control" name="sinif">
                        <option value="" selected>Tüm Sınıflar</option>
                        <?php

            while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {
              $sinif_id = $sinifcek['sinif_id']; // kullanicileri sırala

            ?>

                        <option value="<?php echo $sinifcek['sinif_id']; ?>" <?php if (isset($_GET['sinif']) and $_GET['sinif'] == $sinifcek['sinif_id']) {
                                                                      echo  'selected';
                                                                    } ?>><?php echo $sinifcek['sinif_ad']; ?></option>
                        <?php } ?>


                    </select>

                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Kota<span
                        class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="text" id="first-name" name="kota" value="<?php if (isset($_GET['kota'])) {
                                                                  echo  $_GET['kota'];
                                                                } else {
                                                                  echo "0";
                                                                } ?>" placeholder="Sınıf"
                        class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hoca<span
                        class="required">*</span>
                </label>
                <div class="col-md-5 col-sm-7 col-xs-12" style="text-align:center">
                    <?php
          $kullanicisor = $db->prepare("SELECT * from kullanici where (kullanici_yetki=:yetki3 or kullanici_yetki=:yetki4 or kullanici_yetki=:yetki5) and kullanici_durum=:durum order by kullanici_adsoyad asc");

          $kullanicisor->execute(array(
            'yetki3' => 3,
            'yetki4' => 4,
            'yetki5' => 5,
            'durum' => 1
          )); // kullanicileri bulup seç

          ?>
                    <style type="text/css">
                    select {

                        text-align: center;
                        text-align-last: center;
                        /* webkit*/
                    }

                    option {
                        font-size: 20px;
                        text-align-last: center;
                        /* reset to left*/
                    }
                    </style>
                    <select class="select2_multiple form-control" name="hoca">
                        <option value="" selected>Tüm Hocalar</option>
                        <?php

            while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {
              $kullanici_id = $kullanicicek['kullanici_id']; // kullanicileri sırala

            ?>

                        <option value="<?php echo $kullanicicek['kullanici_id']; ?>">
                            <?php echo $kullanicicek['kullanici_adsoyad']; ?></option>
                        <?php } ?>


                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3 col-md-offset-3">

                    <button type="submit" name="tablo" class="btn btn-success">Göster</button>
                </div>
                <label class="col-md-11 col-sm-12 col-xs-12">
                    <h3 align="center">
                        <strong>Ders eklemek istediğiniz öğrencinin ismine tıklayınız.</strong>
                    </h3>
                </label>
            </div>

        </form>

    </div>

    <!--Tablo Başlangıç-->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tam Liste <small>
                            <?php echo date('d-m-Y', strtotime($date2)) . " " . $gunler[date('w', strtotime($date2))] . " ve" . " " . date('d-m-Y', strtotime($_GET['date1'])) . " " . $gunler[date('w', strtotime($_GET['date1']))] . " " . "Günleri arası olan kayıtlar"; ?></small>

                    </h2>

                    <ul class="nav navbar-right panel_toolbox">

                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                        </li>

                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div id="ahmet" class="x_content col-xs-12">


                    <?php

          print_r($ogrencisor->errorInfo());
          $ogrencimsi = $ogrencisor->fetchAll(PDO::FETCH_ASSOC);
          print_r($ogrencimsi);
          ?>

                </div>
            </div>
        </div>
    </div>

</div>




<?php include 'footer.php'; ?>