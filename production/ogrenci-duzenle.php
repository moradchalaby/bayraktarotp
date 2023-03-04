<?php include 'header.php';


$ogrencisor = $db->prepare("SELECT * from ogrenci where ogrenci_id=:id");
$ogrencisor->execute(array(
  'id' => $_GET['ogrenci_id']
));

$ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC);


?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Öğrenci Bilgi Düzenle<small>


                                <?php
                if ($_GET['durum'] == "ok") { ?>

                                <b style="color:green;">İŞLEM BAŞARILI...</b>


                                <?php   } elseif ($_GET['durum'] == "no") { ?>

                                <b style="color:red;">İŞLEM BAŞARISIZ...</b>


                                <?php }
                ?>
                            </small>

                        </h2>
                        <ul class="nav navbar-right panel_toolbox">


                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js'
                        type='text/javascript'></script>



                    <div class="x_content">
                        <br />





                        <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2"
                            data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim<span
                                        class="required">*</span>
                                </label>



                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <?php
                  if (strlen($ogrencicek['ogrenci_resim']) > 0) { ?>
                                    <img width="200" src="../<?php echo $ogrencicek['ogrenci_resim']; ?> ">

                                    <?php } else { ?>

                                    <img width="200" src="../dimg/logo-yok.png">
                                    <?php } ?>


                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç
                                    <span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="input-group input-file" id="ogrenci_resim" name="ogrenci_resim">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
                                        </span>
                                        <input type="text" class="form-control" name="deger_resim" placeholder="<?php if (strlen($ogrencicek['ogrenci_resim']) > 0) {
                                                                                              echo $ogrencicek['ogrenci_resim'];
                                                                                            } else {
                                                                                              echo "Bir Dosya Seçiniz.";
                                                                                            } ?>" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-warning btn-reset" type="button">Reset</button>
                                        </span>

                                    </div>

                                </div>
                            </div>

                            <!--div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kimlik Fotokopisi<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12 ">
          <div class="input-group input-file" id="ogrenci_kmlk" name="ogrenci_kmlk">
            <span class="input-group-btn">
              <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
            </span>
            <input type="text" class="form-control" name="deger_kmlk" placeholder="<?php if (strlen($ogrencicek['ogrenci_kmlk']) > 0) {
                                                                                      echo $ogrencicek['ogrenci_kmlk'];
                                                                                    } else {
                                                                                      echo "Bir Dosya Seçiniz.";
                                                                                    } ?>" /> 
            <span class="input-group-btn">
             <button class="btn btn-warning btn-reset" type="button">Reset</button>
           </span>  

         </div>
       </div>
     </div>


     <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sağlık Raporu<span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12 ">
        <div class="input-group input-file" id="ogrenci_sglk" name="ogrenci_sglk">
          <span class="input-group-btn">
            <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
          </span>
          <input type="text" class="form-control" name="deger_sglk" placeholder="<?php if (strlen($ogrencicek['ogrenci_sglk']) > 0) {
                                                                                    echo $ogrencicek['ogrenci_sglk'];
                                                                                  } else {
                                                                                    echo "Bir Dosya Seçiniz.";
                                                                                  } ?>" /> 
          <span class="input-group-btn">
            <button class="btn btn-warning btn-reset" type="button">Reset</button>
          </span>

        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Belge-1 <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12 ">
        <div class="input-group input-file" id="ogrenci_belge1" name="ogrenci_belge1">
          <span class="input-group-btn">
            <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
          </span>
          <input type="text" class="form-control" name="deger_belge1" placeholder="<?php if (strlen($ogrencicek['ogrenci_belge1']) > 0) {
                                                                                      echo $ogrencicek['ogrenci_belge1'];
                                                                                    } else {
                                                                                      echo "Bir Dosya Seçiniz.";
                                                                                    } ?>" /> 
          <span class="input-group-btn">
           <button class="btn btn-warning btn-reset" type="button">Reset</button>

         </div>
       </div>
     </div>

     <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Belge-2 <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12 ">
        <div class="input-group input-file" id="ogrenci_belge2" name="ogrenci_belge2">
         <span class="input-group-btn">
          <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
        </span>
        <input type="text" class="form-control"  name="deger_belge2" placeholder="<?php if (strlen($ogrencicek['ogrenci_belge2']) > 0) {
                                                                                    echo $ogrencicek['ogrenci_belge2'];
                                                                                  } else {
                                                                                    echo "Bir Dosya Seçiniz.";
                                                                                  } ?>" /> 
        <span class="input-group-btn">
         <button class="btn btn-warning btn-reset" type="button">Reset</button>
       </span>

     </div>
   </div>
 </div>

 <div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Belge-3 <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12 ">
    <div class="input-group input-file" id="ogrenci_belge3" name="ogrenci_belge3">
     <span class="input-group-btn">
      <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
    </span>
    <input type="text" class="form-control" name="deger_belge3" placeholder="<?php if (strlen($ogrencicek['ogrenci_belge3']) > 0) {
                                                                                echo $ogrencicek['ogrenci_belge3'];
                                                                              } else {
                                                                                echo "Bir Dosya Seçiniz.";
                                                                              } ?>" /> 
    <span class="input-group-btn">
     <button class="btn btn-warning btn-reset" type="button">Reset</button>
   </span>

 </div>
</div>
</div-->


                            <input type="hidden" name="eski_resim"
                                value="<?php echo $ogrencicek['ogrenci_resim']; ?>" />
                            <!--input type="hidden" name="eski_kmlk" value="<?php echo $ogrencicek['ogrenci_kmlk']; ?>"/>
<input type="hidden" name="eski_sglk" value="<?php echo $ogrencicek['ogrenci_sglk']; ?>"/>
<input type="hidden" name="eski_belge1" value="<?php echo $ogrencicek['ogrenci_belge1']; ?>"/>
<input type="hidden" name="eski_belge2" value="<?php echo $ogrencicek['ogrenci_belge2']; ?>"/>
<input type="hidden" name="eski_belge3" value="<?php echo $ogrencicek['ogrenci_belge3']; ?>"/-->




                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_adsoyad" placeholder="Ad Soyad"
                                        value="<?php echo $ogrencicek['ogrenci_adsoyad'] ?>" required="required"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_tc"
                                        value="<?php echo $ogrencicek['ogrenci_tc'] ?>" placeholder="TC No"
                                        maxlength="11" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum
                                    Tarihi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="first-name" value="<?php echo $ogrencicek['ogrenci_dt'] ?>"
                                        name="ogrenci_dt" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hoca<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                    <select name="kullanici_id"
                                        class="select2_multiple form-control col-md-7 col-xs-12">
                                        <option value="<?php echo $ogrencicek['kullanici_id']; ?>" selected>Seçiniz
                                        </option>
                                        <?php
                    $yetki = array(3, 4);
                    $hocasor = $db->prepare("SELECT * from kullanici where kullanici_yetki=:yetki3 or kullanici_yetki=:yetki4 order by kullanici_adsoyad asc");
                    $hocasor->execute(array(
                      'yetki3' => 3,
                      'yetki4' => 4
                    ));

                    while ($hocacek = $hocasor->fetch(PDO::FETCH_ASSOC)) {
                      $hocasi = ($ogrencicek['kullanici_id'] == $hocacek['kullanici_id']) ? "selected" : "";
                    ?>

                                        <option value="<?php echo $hocacek['kullanici_id'];  ?>" <?php echo $hocasi; ?>>
                                            <?php echo $hocacek['kullanici_adsoyad']; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Birim<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="ogrenci_birim" required>

                                        <?php
                    $birimsor = $db->prepare("SELECT * from birim where birim_id");
                    $birimsor->execute(array());

                    while ($birimcek = $birimsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                        <option value="<?php echo $birimcek['birim_id'] ?>" <?php if ($ogrencicek['ogrenci_birim'] == $birimcek['birim_id']) : echo 'selected';
                                                                          endif ?>><?php echo $birimcek['birim_ad'] ?>
                                        </option>
                                        <?php
                    };


                    ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sınıf<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="ogrenci_sinif"
                                        class="select2_multiple form-control col-md-7 col-xs-12">


                                        <?php
                    $sinifsor = $db->prepare("SELECT * from sinif where sinif_id");
                    $sinifsor->execute(array());

                    while ($sinifsirala = $sinifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value="<?php echo $sinifsirala['sinif_id']; ?>" <?php if ($ogrencicek['ogrenci_sinif'] == $sinifsirala['sinif_id']) : echo 'selected';
                                                                              endif ?>>
                                            <?php echo $sinifsirala['sinif_ad']; ?></option>
                                        <?php } ?>


                                    </select>
                                </div>
                            </div>






                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" id="first-name" name="ogrenci_adres"
                                        class="form-control col-md-7 col-xs-12"
                                        placeholder="Adres"><?php echo $ogrencicek['ogrenci_adres'] ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Adı<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_baba'] ?>"
                                        name="ogrenci_baba" placeholder="Baba Adı"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Tel<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name"
                                        value="<?php echo $ogrencicek['ogrenci_babatel'] ?>" name="ogrenci_babatel"
                                        placeholder="Baba Telefon No" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba
                                    Meslek<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name"
                                        value="<?php echo $ogrencicek['ogrenci_babames'] ?>" name="ogrenci_babames"
                                        placeholder="Baba Mesleği" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Adı<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" value="<?php echo $ogrencicek['ogrenci_anne'] ?>"
                                        name="ogrenci_anne" placeholder="Anne Adı"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Tel<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name"
                                        value="<?php echo $ogrencicek['ogrenci_annetel'] ?>" name="ogrenci_annetel"
                                        placeholder="Anne Telefon No" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Okul
                                    Durumu<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name"
                                        value="<?php echo $ogrencicek['ogrenci_okuldurum'] ?>" name="ogrenci_okuldurum"
                                        placeholder="Okul Durumu" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Özel
                                    Durumlar<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <textarea id="editor1" name="ogrenci_not"
                                        placeholder="Özel Durumlar (Vukuat) (Aile Durumu) (Referans) (Hakkında bilinmesi gerekenler)"
                                        class="form-control col-md-7 col-xs-12"><?php echo $ogrencicek['ogrenci_not'] ?></textarea>
                                    <script>
                                    CKEDITOR.replace('editor1');
                                    </script>
                                </div>
                            </div>

                                      <div class="form-group <?php echo $ogrencicek['ogrenci_kytdrm'] == '1'? 'hidden' : '' ?>">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="first-name">Mezun Tarihi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="first-name" value="<?php echo $ogrencicek['ogrenci_mznTrh'] ?>"
                                        name="ogrenci_mznTrh" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                                  
<div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayıt Tarihi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="first-name" value="<?php echo $ogrencicek['ogrenci_kytTrh'] ?>"
                                        name="ogrenci_kytTrh" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>




                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="ogrenci_kytdrm" required>


                                        <option value="1"
                                            <?php echo $ogrencicek['ogrenci_kytdrm'] == '1' ? ' selected' : ''; ?>>Aktif
                                        </option>


                                        <option value="0" <?php if ($ogrencicek['ogrenci_kytdrm'] == 0) {
                                        echo 'selected';
                                      } ?>>Pasif</option>
                                    </select>

                                </div>
                            </div>




                            <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id'] ?>">

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                    <button type="submit" name="ogrenciduzenle" class="btn btn-success">Kaydet</button>
                                    <a href="index.php"><button type="button" class="btn btn-default">İptal</button></a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
</div>
<!-- /page content -->
<?php include 'footer.php'; ?>