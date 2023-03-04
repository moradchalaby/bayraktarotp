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
<style>
@media print {


    .no-print * {
        display: none !important;
    }
}
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Muhasebe Rapor<small>
            </div>


        </div>

    </div>

    <div class="x_content">
        <br />

        <!-- (/) => bu işaret en kök dizine çıkar (../) => bir ğst dizine çık  -->
        <form action="#" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


            <div class="form-group">

                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Başlangıç Tarihi<span
                        class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="date" id="first-name" value="<?php if (isset($_POST['date2'])) {
                                                      echo  $_POST['date2'];
                                                    } else {
                                                      echo date("Y-m-d");
                                                    } ?>" name="date2" class="form-control col-md-7 col-xs-12">

                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bitiş Tarihi<span
                        class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="date" id="first-name" name="date1" value="<?php if (isset($_POST['date1'])) {
                                                                    echo  $_POST['date1'];
                                                                  } else {
                                                                    echo date("Y-m-d");
                                                                  } ?>" required="required"
                        class="form-control col-md-7 col-xs-12">
                </div>
            </div>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kur<span
                        class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-2 col-xs-12">

                    <select name="kur" class=" form-control col-md-7 col-xs-12" id="recipient-name">
                        <option selected>Tümü</option>
                        <option <?php if ($_POST['kur'] == '₺') {
                      echo  'selected';
                    } ?>>₺</option>

                        <option <?php if ($_POST['kur'] == '€') {
                      echo  'selected';
                    } ?>>€</option>

                        <option <?php if ($_POST['kur'] == '$') {
                      echo  'selected';
                    } ?>>$</option>
                    </select>
                </div>





                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Ödeme Türü<span
                        class="required">*</span>
                </label>
                <div class="col-md-3 col-sm-3 col-xs-12">

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
                    <select class="select2_multiple form-control" name="odemesekli">
                        <option value="Tümü" selected>Tümü</option>


                        <option <?php if (isset($_POST['odemesekli']) and $_POST['odemesekli'] == 'Banka') {
                      echo  'selected';
                    } ?>>Banka</option>
                        <option <?php if (isset($_POST['odemesekli']) and $_POST['odemesekli'] == 'Nakit') {
                      echo  'selected';
                    } ?>>Nakit</option>


                    </select>

                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Makbuz No<span
                        class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="text" id="first-name" name="makbuzno" value="<?php if (isset($_POST['makbuz_no'])) {
                                                                      echo  $_POST['makbuz_no'];
                                                                    } else {
                                                                      echo "0";
                                                                    } ?>" placeholder="Makbuz No"
                        class="form-control col-md-7 col-xs-12">
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3 col-md-offset-3 ">

                    <button type="submit" name="tablo" class="btn btn-success">Göster</button>

                </div>



            </div>

        </form>

    </div>

    <!--Tablo Başlangıç-->
    <?php

  //print_r($_POST);
  $date = date('Y-m-d');
  $query =
    "SELECT * FROM makbuz where (makbuz_tarih BETWEEN '{$date}' and '{$date}') order by makbuz_id desc";
  if (isset($_POST['tablo'])) {

    $query = "SELECT * FROM makbuz where (makbuz_tarih BETWEEN '{$_POST['date2']}' and '{$_POST['date1']}')";
    $execute = array();
    if ($_POST['makbuzno'] > 0) {
      $query = "SELECT * FROM makbuz where" . ' and makbuz_id=:id,';
      $execute['id'] = $_POST['makbuzno'];
    };
    if ($_POST['kur'] != 'Tümü') {
      $query = $query . " and makbuz_kur=:kur";
      $execute['kur'] = $_POST['kur'];
    }
    if ($_POST['odemesekli'] != 'Tümü') {
      $query   = $query . " and makbuz_odeme_sekli=:odemesekli";
      $execute['odemesekli'] = $_POST['odemesekli'];
    }
  }
  $makbuzsor = $db->prepare("$query");
  $makbuzsor->execute($execute);
  // echo $query . '<br>';
  //print_r($execute);
  //print_r($makbuzsor->errorInfo());


  ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tam Liste <small>
                            <?php echo date('d-m-Y', strtotime($_POST['date2'])) . " " . $gunler[date('w', strtotime($_POST['date2']))] . " ve" . " " . date('d-m-Y', strtotime($_POST['date1'])) . " " . $gunler[date('w', strtotime($_POST['date1']))] . " " . "Günleri arası olan kayıtlar"; ?></small>

                    </h2>
                    <a href="#" data-toggle="modal" class="btn btn-round btn-info navbar-right"
                        data-target=" #yenimakbuz" data-whatever="">Yeni
                        Makbuz</a>
                    <ul class="nav ">

                        <li>

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
                                <th>Tahsilat Yapan</th>
                                <th>Tarih</th>
                                <th>Ödeme Şekli</th>
                                <th>Açıklama</th>
                                <th>Tutar</th>

                            </tr>
                        </thead>
                        <tbody>




                            <?php
              $usdtop = 0;

              $eutop = 0;
              $tltop = 0;
              $colspan = 0;
              $say = 0;
              while ($makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC)) {
                $say++;
                if ($makbuzcek['makbuz_kur'] == '₺') {
                  $tltop += $makbuzcek['makbuz_tutar'];
                } elseif ($makbuzcek['makbuz_kur'] == '€') {
                  $eutop += $makbuzcek['makbuz_tutar'];
                } elseif ($makbuzcek['makbuz_kur'] == '$') {
                  $usdtop += $makbuzcek['makbuz_tutar'];
                }
              ?>

                            <tr>

                                <td><?php echo $say ?></td>
                                <td><?php echo $makbuzcek['makbuz_adsoyad']; ?>
                                </td>
                                <td><?php echo $makbuzcek['kullanici_adsoyad']; ?>
                                </td>

                                <td><?php echo $makbuzcek['makbuz_tarih']; ?></td>
                                <td><?php echo $makbuzcek['makbuz_odeme_sekli'] ?></td>


                                <td><?php echo $makbuzcek['makbuz_aciklama']; ?></td>
                                <td><a class="btn btn-primary btn-xs" target="_blank" rel="noopener noreferrer"
                                        href="./makbuz.php?makbuz_id=<?php echo $makbuzcek['makbuz_id'] ?>"><i
                                            class="fa fa-file-text-o"></i></a>
                                    <a href="#" data-toggle="modal" class="btn btn-warning btn-xs"
                                        data-target=" #<?php echo $makbuzcek['makbuz_id'] ?>editmakbuz"
                                        data-whatever=""><i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" class="btn btn-danger btn-xs"
                                        data-target=" #<?php echo $makbuzcek['makbuz_id'] ?>makbuzsil"
                                        data-whatever=""><i class="fa fa-trash "></i></a>
                                    <?php echo $makbuzcek['makbuz_tutar'] . $makbuzcek['makbuz_kur'] ?>
                                </td>


                            </tr>
                            <?php
                include 'modallar/makbuzsilmodal.php';
                include 'modallar/makbuzduzenlemodal.php';
              }
              ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>TOPLAM</th>
                                <?php
                if ($tltop == 0) {
                  $colspan += 3;
                }
                if ($usdtop == 0) {
                  $colspan += 3;
                }
                if ($eutop == 0) {
                  $colspan += 3;
                }
                if ($usdtop > 0) {
                ?>

                                <th>USD</th>
                                <td colspan="<?php echo $colspan; ?>" ALIGN=CENTER> <?php
                                                                      echo  $usdtop . '$';
                                                                      ?></td>
                                <?php
                }
                if ($eutop > 0) {
                ?>

                                <th>EUR</th>
                                <td colspan="<?php echo $colspan; ?>" ALIGN=CENTER> <?php
                                                                      echo  $eutop . '€';
                                                                      ?></td>
                                <?php
                }
                if ($tltop > 0) {
                ?>

                                <th>TL</th>
                                <td colspan="<?php echo $colspan; ?>" ALIGN=CENTER> <?php
                                                                      echo  $tltop . '₺';
                                                                      ?></td>
                                <?php
                }

                ?>
                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </div>


</div>



<?php
include 'modallar/makbuzeklemodal.php';

include 'footer.php'; ?>