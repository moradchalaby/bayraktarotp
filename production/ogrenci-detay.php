<?php
include '../netting/baglan.php';


include 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ
$ogrencisor = $db->prepare("SELECT * from ogrenci where ogrenci_id=:id");
$ogrencisor->execute(array(
    'id' => $_GET['ogrenci_id']
));

$ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC);

$sondersimsor = $db->prepare("SELECT * from hafizlikdurum where ogrenci_id=:id");
$sondersimsor->execute(array(
    'id' => $_GET['ogrenci_id']
));

$sondersimcek = $sondersimsor->fetch(PDO::FETCH_ASSOC);



setlocale(LC_TIME, "turkish");

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title gizle">
            <div class="title_left">
                <h3>Öğrenci Profili</h3>
            </div>

            <div class="title_right gizle">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search gizle">

                </div>
            </div>
        </div>

        <div class="clearfix gizle"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo $ogrencicek['ogrenci_adsoyad']; ?><small class="h1 text-danger">
                                <?php

                                $birimsor = $db->prepare("SELECT * FROM birim where birim_id=:birim_id");
                                $birimsor->execute(array('birim_id' => $ogrencicek['ogrenci_birim']));
                                $birimcek = $birimsor->fetch(PDO::FETCH_ASSOC);
                                if ($ogrencicek['ogrenci_kytdrm'] == 0) : echo ' - AYRILDI - ';
                                else : echo $birimcek['birim_ad'];
                                endif ?></small>
                        </h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <?php if (strlen($ogrencicek['ogrenci_resim']) > 0) { ?>
                                    <img class="img-responsive avatar-view"
                                        src="../<?php echo $ogrencicek['ogrenci_resim']; ?>">




                                    <?php } else { ?>
                                    <img class="img-responsive  avatar-view " src="../dimg/logo-yok.png">
                                    <?php } ?>

                                </div>
                            </div>
                            <h3><?php echo $ogrencicek['ogrenci_adsoyad']; ?></h3>

                            <ul class="list-unstyled user_data">
                                <li><b>Sınıf:</b> <?php

                                                    $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id=:sinif_id");
                                                    $sinifsor->execute(array('sinif_id' => $ogrencicek['ogrenci_sinif']));
                                                    $sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC);
                                                    echo $sinifcek['sinif_ad'] ?>
                                </li>



                                <?php
                                $hocasisor = $db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
                                $hocasisor->execute(array(

                                    'id' => $ogrencicek['kullanici_id']
                                ));


                                $hocasicek = $hocasisor->fetch(PDO::FETCH_ASSOC); ?>
                                <b>Hocası:</b><?php echo $hocasicek['kullanici_adsoyad'] ?>
                                </li>

                                <li class="gizle">
                                    <b>Doğum Tarihi:</b> <?php echo $ogrencicek['ogrenci_dt'] ?>
                                </li>
                                <li class="gizle">
                                    <b>Kayıt Tarihi:</b> <?php echo $ogrencicek['ogrenci_kytTrh'] ?>
                                </li>
                                <?php if ($ogrencicek['ogrenci_kytdrm'] == 0) { ?>
                                <li class="gizle">
                                    <b>Mezun Tarihi:</b> <?php echo $ogrencicek['ogrenci_mznTrh'] ?>
                                </li>

                                <?php  } ?>

                                <li class="gizle">
                                    <b>Son Ders:</b> <?php echo $sondersimcek['hafizlik_son'] ?>
                                </li>
                            </ul>

                            <?php if ($kullanicicek['kullanici_yetki'] >= 4) : ?>
                            <a href="ogrenci-duzenle.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>"
                                name="ogrenciduzenle" class="btn btn-success gizle"><i
                                    class="fa fa-edit m-right-xs"></i>Düzenle</a>
                            <?php endif ?>
                            <br />


                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs gizle" role="tablist">
                                    <li role="presentation" class="active gizle"><a href="#tab_content1" id="home-tab"
                                            role="tab" data-toggle="tab" aria-expanded="true">1 Aylık Ders Durumu</a>
                                    </li>
                                    <?php if ($kullanicicek['kullanici_yetki'] >= 4) : ?>
                                    <li role="presentation" class="gizle"><a href="#tab_content2" role="tab"
                                            id="profile-tab2" data-toggle="tab" aria-expanded="false">Özel Not</a>
                                    </li>
                                    <li role="presentation" class="gizle"><a href="#tab_content3" role="tab"
                                            id="profile-tab3" data-toggle="tab" aria-expanded="false">Bilgiler</a>
                                    </li>
                                    <?php if ($kullanicicek['kullanici_yetki'] == 5) : ?>
                                    <li role="presentation" class="gizle"><a href="#aidat" role="tab" id="profile-tab3"
                                            data-toggle="tab" aria-expanded="true">Aidat</a>
                                    </li>
                                    <?php endif ?>
                                    <?php endif ?>
                                    <?php if ($ogrencicek['ogrenci_birim'] == 3) : ?>
                                    <li role="presentation" class="gizle"><a href="#tab_content4" role="tab"
                                            id="profile-tab4" data-toggle="tab" aria-expanded="false">İhtisas Ödev</a>
                                    </li>
                                    <li role="presentation" class="gizle"><a href="#tab_content5" role="tab"
                                            id="profile-tab5" data-toggle="tab" aria-expanded="false">İhtisas
                                            İmtihan</a>
                                    </li>
                                    <li role="presentation" class="gizle"><a href="#katilim" role="tab"
                                            id="profile-tab5" data-toggle="tab" aria-expanded="false">Derse Yoklama</a>
                                    </li>
                                    <?php endif ?>

                                </ul>
                                <div id="myTabContent" class="tab-content">

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2"
                                        aria-labelledby="profile-tab">
                                        <?php if (empty($ogrencicek['ogrenci_not'])) {
                                            echo "<center>Herhangi bir not eklenmedi.<center>";
                                        } else {
                                            echo $ogrencicek['ogrenci_not'];
                                        } ?>

                                    </div>
                                    <?php include 'ogrenci-detayf/dty-hafizlik.php'; ?>
                                    <?php include 'ogrenci-detayf/dty-ogrencibilgi.php'; ?>
                                    <?php include 'ogrenci-detayf/dty-aidat.php'; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->





<?php include 'footer.php'; ?>