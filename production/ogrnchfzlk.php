<?php
include '../netting/baglan.php';

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
include 'header.php';

//BELİRLİ VERİYİ SEÇME İŞLEMİ





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
    $sqlm = "SELECT 
     ogrenci.ogrenci_id as id,
                    ogrenci.ogrenci_resim,
                    ogrenci.ogrenci_adsoyad as adsoyad,
                        ogrenci.ogrenci_sinif ,
                        ogrenci.kullanici_id,
kullanici.kullanici_id,
kullanici.kullanici_adsoyad as hoca_adsoyad,
sinif.sinif_id,
sinif.sinif_ad as sinif,
                    
                    hafizlikdurum.hafizlik_durum as durum,
                    hafizlikdurum.hafizlikdurum_bast as bast,
                    
                    hafizlikdurum.hafizlikdurum_bitt as sont,
                    hafizlikdurum.hafizlik_son as sonders,
             SUBSTRING_INDEX(hafizlikdurum.hafizlik_son, '/', 1) AS sayfa,

                  SUM(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_topl ELSE 0 END ) as say ,
               
                  GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_sayfa ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS hsayfa ,
                 
                       GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_cuz ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS hcuz ,
                      GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_hata ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS hatalar,
                      GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.kullanici_id ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS hocalar,
                     GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_usul ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS usuller,
                     GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_durum ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS durumlar,
                         GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_topl ELSE NULL END
                     ORDER BY hfzlkyni.hafizlik_id  ASC SEPARATOR '*') AS topla,
                 
                GROUP_CONCAT(CASE WHEN hfzlkyni.ogrenci_id = ogrenci.ogrenci_id THEN hfzlkyni.hafizlik_trh ELSE NULL END
                     ORDER BY hfzlkyni.ogrenci_id ASC SEPARATOR ',') AS gunler,
                GROUP_CONCAT(CASE WHEN ogrenci.ogrenci_id = hfzlkyni.ogrenci_id THEN hfzlkyni.hafizlik_id ELSE NULL END
                     ORDER BY hfzlkyni.ogrenci_id ASC SEPARATOR ',') AS dersId  FROM ogrenci  
                     LEFT JOIN hafizlikdurum on ogrenci.ogrenci_id = hafizlikdurum.ogrenci_id
                     LEFT JOIN kullanici on ogrenci.kullanici_id = kullanici.kullanici_id
                     LEFT JOIN sinif on ogrenci.ogrenci_sinif = sinif.sinif_id

    LEFT JOIN  hfzlkyni on ogrenci.ogrenci_id = hfzlkyni.ogrenci_id  WHERE  ogrenci.ogrenci_kytdrm=1 AND (hfzlkyni.hafizlik_trh BETWEEN :trh2 AND :trh1) OR ogrenci.ogrenci_kytdrm=1   
     GROUP BY ogrenci.ogrenci_id 
    order by ogrenci_adsoyad  asc";
    $ogrencisor = $db->prepare($sqlm);
    $ogrencisor->execute(array(
        'trh1' => $hafizlik_trh1,
        'trh2' => $hafizlik_trh2
    ));
}

/* DB::raw('GROUP_CONCAT(CASE WHEN hfzlkders.ogrenci_id = ogrenci.id THEN hfzlkders.hafizlik_topl ELSE NULL END
                     WITH ROLLUP) AS say'), */
// $gun = floatval($_GET['gun'])-1;




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
                    <input type="date" id="first-name" name="date2" value='<?php echo $_GET["date2"]; ?>'
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
                                                                                    } ?>>
                            <?php echo $sinifcek['sinif_ad']; ?></option>
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

                    <table id="datatable-responsive"
                        class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0"
                        width="100%">
                        <thead width="100%">
                            <tr>
                                <th>Sıra</th>
                                <th>Ad Soyad</th>
                                <th>Hoca</th>
                                <th>Sınıf</th>
                                <th>Durum</th>
                                <th>Toplam</th>
                                <th>Son Ders</th>


                                <?php $b = -$gun;
                                $daterange = [];
                                while ($b <= 0) {
                                    array_push($daterange, date('Y-m-d', strtotime("$b day", strtotime($date1))));

                                ?>
                                <th><?php echo date('d-m-Y', strtotime("$b day", strtotime($date1))); ?></th>

                                <?php $b++;
                                } ?>




                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //$ogrencimsi = $ogrencisor->fetchAll(PDO::FETCH_ASSOC);
                            // print_r($ogrencimsi);

                            while ($ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                            <tr>
                                <td><?php echo $ogrencicek['id']; ?></td>
                                <td><?php echo $ogrencicek['adsoyad']; ?></td>
                                <td><?php echo $ogrencicek['hoca_adsoyad']; ?></td>
                                <td><?php echo $ogrencicek['sinif']; ?></td>
                                <td><?php echo $ogrencicek['durum']; ?></td>

                                <?php
                                    $topla = 0;
                                    foreach ($daterange as $date) {
                                    ?>


                                <?php
                                        if ($ogrencicek['say'] > 0) {


                                            $ganc = $date;


                                            $dersid = explode(',', $ogrencicek['dersId']);
                                            $gunler = array_reverse(explode(',', $ogrencicek['gunler']));
                                            $durumlar = explode('*', $ogrencicek['durumlar']);
                                            $usuller = explode('*', $ogrencicek['usuller']);
                                            $yanlislar = explode('*', $ogrencicek['hatalar']);
                                            $toplamlar = explode('*', $ogrencicek['topla']);
                                            $sayfalar = explode('*', $ogrencicek['hsayfa']);
                                            $hocalar = explode('*', $ogrencicek['hocalar']);
                                            $cuzler
                                                = explode('*', $ogrencicek['hcuz']);


                                            if (in_array($ganc, $gunler)) {
                                                $tekrar =   array_count_values($gunler);
                                                $say = $tekrar[$ganc];
                                                $topla = $topla + $toplamlar[array_search($ganc, $gunler)];


                                                for ($i = 1; $i < $say; $i++) {

                                                    $topla = $topla + $toplamlar[array_search($ganc, $gunler) + $i];
                                                }
                                            }
                                        }
                                        //echo $topla;
                                        # code...
                                        ?>

                                <?php }


                                    ?>
                                <td><?php echo $topla; ?></td>

                                <td><?php echo $ogrencicek['sonders']; ?></td>
                                <?php $b = -$gun;
                                    $derslerim = [];
                                    foreach ($daterange as $date) { ?>

                                <td>
                                    <?php
                                            if ($ogrencicek['say'] > 0) {


                                                $ganc = $date;


                                                $dersid = explode(',', $ogrencicek['dersId']);
                                                $gunler = array_reverse(explode(',', $ogrencicek['gunler']));

                                                $usuller = explode('*', $ogrencicek['usuller']);
                                                $yanlislar = explode('*', $ogrencicek['hatalar']);
                                                $sayfalar = explode('*', $ogrencicek['hsayfa']);
                                                $hocalar = explode('*', $ogrencicek['hocalar']);
                                                $cuzler
                                                    = explode('*', $ogrencicek['hcuz']);


                                                if (in_array($ganc, $gunler)) {
                                                    array_push($derslerim, array_search($ganc, $gunler));
                                                    $tekrar =   array_count_values($gunler);
                                                    $say = $tekrar[$ganc];
                                                    $ders =  '<a href="#" data-toggle="modal" data-target="#' . $dersid[array_search($ganc, $gunler)] . 'hocagoster">'
                                                        . $sayfalar[array_search($ganc, $gunler)] . '/' .  $cuzler[array_search($ganc, $gunler)] . '</a>';


                                                    for ($i = 1; $i < $say; $i++) {
                                                        array_push($derslerim, array_search($ganc, $gunler) + $i);
                                                        $ders .= ' - '
                                                            . '<a href="#" data-toggle="modal" data-target="#' . $dersid[array_search($ganc, $gunler) + $i] . 'hocagoster">'
                                                            . $sayfalar[array_search($ganc, $gunler) + $i] . '/' .  $cuzler[array_search($ganc, $gunler) + $i] . '</a>';
                                                    }
                                                } else {
                                                    $ders = '';
                                                }
                                            } else {
                                                $ders = '';
                                            }
                                            echo $ders;
                                            # code...
                                            ?>
                                </td>

                                <?php

                                    }
                                    /*    foreach ($derslerim as $key => $value) {
                                        include 'modallar/hocagostermodal.php';
                                    } */
                                    ?>

                            </tr>

                            <?php
                                /* include 'modallar/derseklemodal.php';
                                include 'modallar/hocadegis-modal.php';
                                include 'modallar/hfzlk-durum-modal.php'; */
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>




<?php include 'footer.php'; ?>