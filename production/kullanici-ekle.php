<?php include 'header.php'; 


$kullanicisor=$db->prepare("SELECT * from kullanici where kullanici_id=:id");
$kullanicisor->execute(array(
  'id' => $_GET['kullanici_id']
));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


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
           if ($_GET['durum']=="ok") {?>

            <b style="color:green;">İŞLEM BAŞARILI...</b>


          <?php   }elseif ($_GET['durum']=="no") {?>

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
              
              <input type="text" class="form-control" name="  deger_resim" placeholder="Bir Dosya Seçiniz   'Max=2MB'" /> 
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

         <!--div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TC No<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <input type="text" id="first-name" name="kullanici_tc" placeholder="TC No" maxlength="11"  class="form-control col-md-7 col-xs-12">
           </div>
         </div-->

         <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğum Tarihi<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <input type="date" id="first-name" name="kullanici_dt"  class="form-control col-md-7 col-xs-12"  value="2020-01-01">
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
             <input type="text" id="first-name" name="kullanici_mail"  placeholder="E-Mail" required="required" class="form-control col-md-7 col-xs-12" >
           </div>
         </div>

         <div class="form-group">
           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Adres<span class="required">*</span>
           </label>
           <div class="col-md-6 col-sm-6 col-xs-12">
             <textarea type="text" id="first-name" name="kullanici_adres"   class="form-control col-md-7 col-xs-12" placeholder="Adres"></textarea> 
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
            <option value="5">Yurt Müdürü</option>
          </select>
        </div>
      </div>

      <div class="form-group">
       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Durum<span class="required">*</span>
       </label>
       <div class="col-md-6 col-sm-6 col-xs-12">
         <select id="heard" class="form-control" name="kullanici_durum" required>


           <option value="1" selected="">Aktif</option>


           <option value="0">Pasif</option>
         </select>
       </div> 
     </div>

     <div class="ln_solid"></div>
     <div class="form-group">
       <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

         <button type="submit" name="kullanicikaydet" class="btn btn-success">Kayıt Ekle</button>
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


