<?php include 'header.php';


$ogrencisor = $db->prepare("SELECT * from ogrenci where ogrenci_id=:id");
$ogrencisor->execute(array(
  'id' => $_GET['ogrenci_id']
));
$sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id ");
$sinifsor->execute(array());
$ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC);


?>
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Yeni Öğrenci Ekleme<small>


                                <?php
                if ($_GET['durum'] == "ok") { ?>

                                <b style="color:green;">İŞLEM BAŞARILI...</b>


                                <?php   } elseif ($_GET['durum'] == "no") { ?>

                                <b style="color:red;">İŞLEM BAŞARISIZ...</b>


                                <?php } ?>
                            </small></h2>


                        <ul class="nav navbar-right panel_toolbox">


                        </ul>
                        <div class="clearfix"></div>
                    </div>




                    <div class="x_content">
                        <br />





                        <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demoform2"
                            data-parsley-validate class="form-horizontal form-label-left">


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç
                                    <span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12 ">
                                    <div class="input-group input-file" id="ogrenci_resim" name="ogrenci_resim">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
                                        </span>
                                        <input type="text" class="form-control" name="deger_resim"
                                            placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
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
                    <input type="text" class="form-control" name="deger_kmlk" placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
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
                    <input type="text" class="form-control" name="deger_sglk" placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
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
                    <input type="text" class="form-control" name="deger_belge1" placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
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
                      <input type="text" class="form-control" name="deger_belge2" placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                      <span class="input-group-btn">
                        <button class="btn btn-warning btn-reset" type="button">Reset</button>
                      </span>

                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Belge-3 <span class="required">*</span> </label>

                  <div class="col-md-6 col-sm-6 col-xs-12 ">
                    <div class="input-group input-file" id="ogrenci_belge3" name="ogrenci_belge3">
                      <span class="input-group-btn">
                        <button class="btn btn-default btn-choose" type="button">Dosya Seç</button>
                      </span>
                      <input type="text" class="form-control" name="deger_belge3" placeholder="Bir Dosya Seçiniz 'Max=2MB'" />
                      <span class="input-group-btn">
                        <button class="btn btn-warning btn-reset" type="button">Reset</button>
                      </span>

                    </div>
                  </div>
                </div-->






                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_adsoyad" placeholder="Ad Soyad"
                                        required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_tc" placeholder="TC No"
                                        maxlength="11" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum
                                    Tarihi<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="date" id="first-name" name="ogrenci_dt"
                                        class="form-control col-md-7 col-xs-12">
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
                                        <option selected>Seçiniz</option>
                                        <?php
                    $yetki = array(3, 4);
                    $hocasor = $db->prepare("SELECT * from kullanici where kullanici_yetki=:yetki3 or kullanici_yetki=:yetki4 order by kullanici_adsoyad asc");
                    $hocasor->execute(array(
                      'yetki3' => 3,
                      'yetki4' => 4
                    ));

                    while ($hocacek = $hocasor->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                                        <option value="<?php echo $hocacek['kullanici_id']; ?>">
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

                                        <option value="<?php echo $birimcek['birim_id'] ?>">
                                            <?php echo $birimcek['birim_ad'] ?></option>
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
                                        <option value="<?php echo $sinifsirala['sinif_id']; ?>">
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
                                        class="form-control col-md-7 col-xs-12" placeholder="Adres Giriniz"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Adı<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_baba" placeholder="Baba Adı"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba Tel<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_babatel"
                                        placeholder="Baba Telefon No" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Baba
                                    Meslek<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_babames" placeholder="Baba Mesleği"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Adı<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_anne" placeholder="Anne Adı"
                                        class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Anne Tel<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_annetel"
                                        placeholder="Anne Telefon No" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Okul
                                    Durumu<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="ogrenci_okuldurum"
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
                                        required="required" class="form-control col-md-7 col-xs-12"></textarea>
                                    <script>
                                    CKEDITOR.replace('editor1');
                                    </script>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="heard" class="form-control" name="ogrenci_kytdrm" required>


                                        <option value="1" selected>Aktif</option>


                                        <option value="0">Pasif</option>
                                    </select>

                                </div>
                            </div>






                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                                    <button type="submit" name="ogrenciekle" class="btn btn-success">Ekle</button>
                                    <a href="ogrenci.php"><button type="button"
                                            class="btn btn-default">İptal</button></a>
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