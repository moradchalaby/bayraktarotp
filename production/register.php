<?php 




?>
<?php 



include '../netting/baglan.php';


//BELİRLİ VERİYİ SEÇME İŞLEMİ
//AYARLAR 

$sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id ");
$sinifsor->execute(array());






?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1254" />
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <title>AZİZ BAYRAKTAR</title>



  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
  
  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


  <!-- Güncelleme  -->
 


  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">





  <!-- CK Editör -->
  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" align="center" style="border: 0;">
            <a href="index.php" class="site_title"><img src="../dimg/logoakm.png" width="100%"></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
     
            
         
        
           <!-- /sidebar menu -->

           <!-- /menu footer buttons -->
           
          <!-- /menu footer buttons -->
        </div>
      </div>



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
          <form action="../netting/islem.php" method="POST" enctype="multipart/form-data" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Resim Seç <span class="required">*</span></label>


              <div class="col-md-6 col-sm-6 col-xs-12 ">
                <div class="input-group input-file" id="ogrenci_resim  " name="kullanici_resim">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type=" button">Dosya Seç</button></span>

                  <input type="text" class="form-control" name="kullanici_resim" placeholder="Bir Dosya Seçiniz   'Max=2MB'" />
                  <span class="input-group-btn">
                    <button class="btn btn-warning btn-reset" type=" button">Reset</button></span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_adsoyad" placeholder="Ad Soyad" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_tc" placeholder="TC No" maxlength="11" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <?php  ?>

            

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="date" id="first-name" name="kullanici_dt"  class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefon Numarası <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_gsm" placeholder="Telefon Numarası"  class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">E-mail<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="first-name" name="kullanici_mail" placeholder="E-Mail" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea type="text" id="first-name" name="kullanici_adres"  class="form-control col-md-7 col-xs-12" placeholder="Adres"></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Şifre <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              
                <input type="password" id="password" name="kullanici_password" placeholder="Şifre" required="required" class="form-control col-md-7 col-xs-12">
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
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Birim<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <select id="heard" class="form-control" name="kullanici_birim" required>
              <option>Seçiniz</option>
              <?php 
              $birimsor=$db->prepare("SELECT * from birim where birim_id");
              $birimsor->execute(array(
                
              ));

              while ( $birimcek=$birimsor->fetch(PDO::FETCH_ASSOC)) { ?>
                
             <option value="<?php echo $birimcek['birim_id'] ?>"><?php echo $birimcek['birim_ad'] ?></option>
<?php 
              };


              ?>
              
            
            </select>
          </div>
        </div>

        <div class="form-group">
         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yetki<span class="required">*</span>
         </label>
         <div class="col-md-6 col-sm-6 col-xs-12">
           <select id="heard" class="form-control" name="kullanici_yetki" required>
            <option>Seçiniz</option>
            <option value="1">Personel</option>
            <option value="2">Yardımcı Hoca</option>
            <option value="2">İhtisas Ders Hocası</option>
            <option value="3">Hafızlık ve İhtisas Ders Hocası</option>
            <option value="3">Hafızlık Hocası</option>
            <option value="4">Birim Sorumlusu</option>
            <option value="4">Organize Hocası</option>
            <option value="5">Yurt Müdürü</option>
          </select>
        </div>
      </div>

            <div class="hidden form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span class="required">*</span>
              </label>
              <div class="hidden col-md-6 col-sm-6 col-xs-12">
                <select id="heard" class="form-control" name="kullanici_durum" required>


                  <option value="1" selected="">Aktif</option>


                  <option value="0">Pasif</option>
                </select>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="kullanicikaydet" class="btn btn-success">Kayıt OL</button>
                <a class="btn btn-default" href="login.php">İptal</a>
                
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