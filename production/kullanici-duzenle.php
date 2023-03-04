<?php include 'header.php';


$kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
  'id' => $_GET['kullanici_id']
));
$sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id ");
$sinifsor->execute(array());


$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);


?>

<!-- page content -->
<div class="right_col" role="main">


  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Yeni Kullanıcı Ekleme<small>


              <?php
              if ($_GET['durum'] == "ok") { ?>

                <b style="color:green;">İŞLEM BAŞARILI...</b>


              <?php   } elseif ($_GET['durum'] == "no") { ?>

                <b style="color:red;">İŞLEM BAŞARISIZ...</b>


              <?php } ?></small>

          </h2>

          <div class="clearfix"></div>
        </div>



        <div class="x_content">
          <br />

          <!-- (/) => bu işaret en kök dizine çıkar (../) => bir ğst dizine çık  -->

          <form action="../netting/islem.php" method="POST" data-parsley-validate enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim<span class="required">*</span>
              </label>



              <div class="col-md-6 col-sm-6 col-xs-12">
                <?php
                if (strlen($kullanicicek['kullanici_resim']) > 0) { ?>
                  <img width="200" src="../<?php echo $kullanicicek['kullanici_resim']; ?> ">

                <?php } else { ?>

                  <img width="200" src="../dimg/logo-yok.png">
                <?php } ?>


              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç <span class="required">*</span>
              </label>

              <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="input-group input-file" id="ogrenci_resim" name="kullanici_resim">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
                  </span>
                  <input type="text" class="form-control" name="deger_resim" placeholder="<?php if (strlen($kullanicicek['kullanici_resim']) > 0) {
                                                                                            echo $kullanicicek['kullanici_resim'];
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
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_adsoyad" value="<?php echo $kullanicicek['kullanici_adsoyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <!--div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_tc" readonly="" value="<?php echo $kullanicicek['kullanici_tc'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div-->

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="first-name" name="kullanici_dt" readonly="" value="<?php echo $kullanicicek['kullanici_dt'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numarası <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-mail<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_mail" readonly="" value="<?php echo $kullanicicek['kullanici_mail'] ?>" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="first-name" name="kullanici_adres" readonly="" required="required" class="form-control col-md-7 col-xs-12"><?php echo $kullanicicek['kullanici_adres'] ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şifre <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_password" placeholder="Şifre" class="form-control col-md-7 col-xs-12">
                 <input type="checkbox" onclick="sifregoster()">Göster/Gizle
                <script>
                  function sifregoster() {
                    var x = document.getElementById("password");
                    if (x.type === "password") {
                      x.type = "text";
                    } else {
                      x.type = "password";
                    }
                  }
                </script>
              </div>
            </div>


            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yetki<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="kullanici_yetki" required>
                   
                  <option value="1" <?php if ($kullanicicek['kullanici_yetki']==1): ?>
                    selected
                  <?php endif ?>>Personel</option>
                  <option value="2"<?php if ($kullanicicek['kullanici_yetki']==2): ?>
                    selected
                  <?php endif ?>>Yardımcı Hoca</option>
                  <option value="3"<?php if ($kullanicicek['kullanici_yetki']==3 and $kullanicicek['kullanici_birim']!=3 ): ?>
                    selected
                  <?php endif ?>>Hafızlık Hocası</option>
                  <option value="3"<?php if ($kullanicicek['kullanici_yetki']==3 and $kullanicicek['kullanici_birim']==3 ): ?>
                    selected
                  <?php endif ?>>Hafızlık ve İhtisas Ders Hocası</option>
                  <option value="4"<?php if ($kullanicicek['kullanici_yetki']==4): ?>
                    selected
                  <?php endif ?>>Birim Sorumlusu</option>
                  <option value="5"<?php if ($kullanicicek['kullanici_yetki']==5): ?>
                    selected
                  <?php endif ?>>Yurt Müdürü</option>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Birim<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="kullanici_birim" required>
                   
                   <?php 
              $birimsor=$db->prepare("SELECT * from birim where birim_id");
              $birimsor->execute(array(
              
              ));

              while ( $birimcek=$birimsor->fetch(PDO::FETCH_ASSOC)) { ?>
                
             <option value="<?php echo $birimcek['birim_id'] ?>" <?php if ($kullanicicek['kullanici_birim']==$birimcek['birim_id']): echo 'selected'; endif ?>><?php echo $birimcek['birim_ad'] ?></option>
              <?php 
              };


              ?>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sınıf<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select name="kullanici_sinif" class="select2_multiple form-control col-md-7 col-xs-12">
                  <option selected><?php echo $kullanicicek['kullanici_sinif'] ?></option>

                  <?php while ($sinifsirala = $sinifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $sinifsirala['sinif_id']; ?>" <?php if ($kullanicicek['kullanici_sinif']==$sinifsirala['sinif_id']): echo 'selected'; endif ?>><?php echo $sinifsirala['sinif_ad']; ?></option>
                  <?php } ?>


                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="kullanici_durum">


                  <option value="1" <?php echo $kullanicicek['kullanici_durum'] == '1' ? ' value="Aktif"' : ''; ?>>Aktif</option>


                  <option value="0" <?php if ($kullanicicek['kullanici_durum'] == 0) {
                                      echo 'value="Aktif"';
                                    } ?>>Pasif</option>
                </select>
              </div>
            </div>


            <input type="hidden" name="eski_password" value="<?php echo $kullanicicek['kullanici_password']; ?>">

            <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">

            <input type="hidden" name="eski_resim" value="<?php echo $kullanicicek['kullanici_resim']; ?>">



            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="kullaniciduzenle" class="btn btn-success">Güncelle</button>
                <a href="kullanici.php"><button type="button" class="btn btn-default">Kapat</button></a>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /page content -->
<?php include 'footer.php'; ?>