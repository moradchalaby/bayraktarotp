<?php
include '../netting/baglan.php';


include 'header.php';

//BELİRLİ VERİYİ SEÇME İŞLEMİ



$ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm");
$ogrencisor->execute(array(

  'kytdrm' => 1
));






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
    <?php if (isset($_GET['tablo'])) :


    if (strlen($_GET['sinif']) > 0) {
      $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_sinif=:sinif order by ogrenci_adsoyad asc");
      $ogrencisor->execute(array(
        'kytdrm' => 1,
        'sinif' => $_GET['sinif']

      ));
    } elseif (strlen($_GET['hoca']) > 0) {

      $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
      $kullanicisor->execute(array(
        'id' => $_GET['hoca']

      ));
      $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);



      $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=1 and kullanici_id=:sinif order by ogrenci_adsoyad asc");
      $ogrencisor->execute(array(

        'sinif' => $_GET['hoca']

      ));
    } else {

      $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=1 order by ogrenci_adsoyad asc ");
      $ogrencisor->execute(array());
    }
    $date = $_GET['date1'];
    if (!empty($_GET['date2'])) {
      $tarih1 = date_create($_GET['date1']);
      $tarih2 = date_create($_GET['date2']);
      $diff = date_diff($tarih2, $tarih1);
      $gun = $diff->format("%a");
      // $gun = intval(date('d.m',strtotime($_GET['date1'])-strtotime($_GET['date2'])))-1;
      $date2 = $_GET['date2'];
    } else {
      $gun = 0;
      $date2 = $_GET['date1'];
    }



    // $gun = floatval($_GET['gun'])-1;

  ?>

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
                  while ($b <= 0) {

                  ?>
                                <th><?php echo date('d-m-Y', strtotime("$b day", strtotime($date))); ?></th>

                                <?php $b++;
                  } ?>




                            </tr>
                        </thead>
                        <tbody>




                            <?php


                $toplamders = $daytop;
                $sayfas = $_GET['sayfa'];
                $kota = $_GET['kota'];
                $say = 0;
                while ($ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC)) {
                  $say++;

                  $ogrenci_sinif  = $ogrencicek['kullanici_id'];
                  $ogrenci_sinifid  = $ogrencicek['ogrenci_sinif'];

                  $sinifidsor = $db->prepare("SELECT * FROM sinif where sinif_id=:sinifid");
                  $sinifidsor->execute(array(

                    'sinifid' => $ogrenci_sinifid
                  ));
                  $sinifidcek = $sinifidsor->fetch(PDO::FETCH_ASSOC);

                  $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:sinif");
                  $kullanicisor->execute(array(

                    'sinif' => $ogrenci_sinif
                  ));


                  $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);



                  $hafizliksor = $db->prepare("SELECT * from hafizlikdurum INNER JOIN hfzlkyni ON hfzlkyni.ogrenci_id = hafizlikdurum.ogrenci_id where hafizlikdurum.ogrenci_id=:id ");
                  $hafizliksor->execute(array(
                    'id' => $ogrencicek['ogrenci_id']

                  ));

                  $hafizlikcek = $hafizliksor->fetch(PDO::FETCH_ASSOC);

                  $hafizlikdurumsor = $db->prepare("SELECT * from hafizlikdurum  where ogrenci_id=:id ");
                  $hafizlikdurumsor->execute(array(
                    'id' => $ogrencicek['ogrenci_id']

                  ));

                  $hafizlikdurumcek = $hafizlikdurumsor->fetch(PDO::FETCH_ASSOC);




                  $daytop = 0;
                  $d = $e = -$gun;

                  while ($d <= 0) {
                    $hafizlik_trh = date('Y-m-d', strtotime("$d day", strtotime($date)));


                    $hafizliktoplsor = $db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                    $hafizliktoplsor->execute(array(
                      'hafizlik_trh' => $hafizlik_trh,
                      'ogrenci_id' => $ogrencicek['ogrenci_id']
                    ));
                    while ($hafizliktoplcek = $hafizliktoplsor->fetch(PDO::FETCH_ASSOC)) {
                      $daytop = floatval($daytop) + floatval($hafizliktoplcek['hafizlik_topl']);
                    }


                    $d++;
                  }

                  $sayfa = explode('/', $hafizlikdurumcek['hafizlik_son']); ?>


                            <?php if (intval($sayfa[0]) >= $sayfas) : ?>
                            <?php if ($daytop >= $kota) :
                      $toplamders += $daytop;
                    ?>




                            <tr>
                                <td> <a href="ogrenci-detay.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>" class="btn btn-primary btn-xs"> <?php echo $say ?> </a></td>
                                <td><a href="#" data-toggle="modal"
                                        data-target="#<?php echo $ogrencicek['ogrenci_id'] ?>dersekle"
                                        data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $ogrencicek['ogrenci_adsoyad']; ?></a>
                                </td>
                                <td><a href="#" data-toggle="modal"
                                        data-target="#<?php echo $ogrencicek['ogrenci_id'] ?>hocadegis"
                                        data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $kullanicicek['kullanici_adsoyad']; ?></a>
                                </td>

                                <td><?php echo $sinifidcek['sinif_ad']; ?></td>
                            <td><a href="#" data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id']; ?>hafizlikdurum" data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $hafizlikdurumcek['hafizlik_durum']; ?></a></td>
                                


                                <td><?php echo $daytop; ?></td>
                                <td><?php echo $hafizlikdurumcek['hafizlik_son'] ?></td>

                                <?php
                        $ara = 2;
                        while ($e <= 0) {
                          $tarh = date('Y-m-d', strtotime("$e day", strtotime($date))); /* $day = explode("_", $hafizlikcek[date('d_m_Y', strtotime("$e day", strtotime($date)))]);
                            
                            $hoca = explode("&", $day[2]);
                            $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id IN (" . implode(',', $hoca) . ") ORDER BY FIELD(kullanici_id, " . implode(',', $hoca) . ")");
                            $kullanicisor->execute(array());*/




                          $hafizlikderssor = $db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                          $varmi = $hafizlikderssor->execute(array(
                            'hafizlik_trh' => $tarh,
                            'ogrenci_id' => $ogrencicek['ogrenci_id']
                          ));

                          $dersarasi = $hafizlikderssor->rowcount();
                        ?>
                                <td>
                                    <?php while ($hafizlikderscek = $hafizlikderssor->fetch(PDO::FETCH_ASSOC)) { ?><a
                                        href="#" data-toggle="modal"
                                        data-target="#<?php echo $hafizlikderscek['hafizlik_id']; ?>hocagoster"
                                        data-whatever="<?php echo $tarh; ?>"><?php echo $hafizlikderscek['hafizlik_sayfa'] . '/' . $hafizlikderscek['hafizlik_cuz']; ?></a><?php

                                                                                                                                                                                                                                                                                                                                                      if ($dersarasi >= 2 and $dersarasi >= $ara) {
                                                                                                                                                                                                                                                                                                                                                        echo ' - ';
                                                                                                                                                                                                                                                                                                                                                      }
                                                                                                                                                                                                                                                                                                                                                      $ara++;
                                                                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                                                                      ?>

                                </td>

                                <?php

                          if (!$varmi) {
                            echo '<td></td>';
                          }
                          $e++;
                          $hafizlikmodalsor = $db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                          $hafizlikmodalsor->execute(array(
                            'hafizlik_trh' => $tarh,
                            'ogrenci_id' => $ogrencicek['ogrenci_id']
                          ));
                          while ($hafizlikdersmodal = $hafizlikmodalsor->fetch(PDO::FETCH_ASSOC)) {

                            include 'modallar/hocagostermodal.php';
                          }
                        } ?>



                                <?php endif ?>
                                <?php endif ?>


                                <?php


                  include 'modallar/derseklemodal.php';
                  include 'modallar/hocadegis-modal.php';
                include 'modallar/hfzlk-durum-modal.php';
                }

                  ?>


                            </tr>

                        </tbody>
                        <!--tfoot>
                            <tr>
                                <th>ORTALAMA</th>
                                 <td ALIGN=CENTER> <?php
                                    //echo  $toplamders / $say;
                                    ?></td>
                                <?php

                  //$a = 0;
                  //while ($a < (6 + $gun)) { ?>
                                <td ALIGN=CENTER> <?php
                                     // echo  $toplamders / $say;
                                      ?></td>
                                <?php// $a++;
           //       } ?>
                            </tr>
                        </tfoot-->
                    </table>


                </div>
            </div>
        </div>
    </div>

    <?php

  endif ?>
</div>




<?php include 'footer.php'; ?>