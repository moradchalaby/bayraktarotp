<div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id']; ?>dersekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
  <?php $sonders = explode("/",$hafizlikdurumcek['hafizlik_son']);
       $hafizsa = explode("(",$hafizlikdurumcek['hafizlik_durum']);
       $hassa = explode(".",$hafizlikdurumcek['hafizlik_durum']);
       if ($sonders[1]==30 and $hafizsa[0]!=='Hafız' and $hassa[1] !=='Has' ){
       $sonsayfa=$sonders[0]+1;
       $soncuz = 1;
     } elseif ($sonders[1]==30 and ($hafizsa[0] =='Hafız' or $hassa[1] =='Has')  ) {
       $sonsayfa=$sonders[0];
       $soncuz = 1;



       
     } else {

       $sonsayfa=$sonders[0];
       $soncuz = $sonders[1]+1;
     }



     ?>
  
 
     <div class="modal-content">
        <?php if ($yetkiler<=2) {
echo '<h5 style="color: red; text-align:center;"> Bu Değişim Birim Hocaları Tarafından Yapılmaktadır!!!</h5>';
} else { ?> 
      <div class="modal-header">

       <h5 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>"> <strong><?php echo $ogrencicek['ogrenci_adsoyad']?></strong> İsimli Öğrenci Ders Verdi</h5>

     </div>
     <div align="center" class="modal-body">
     
     
      <?php if ($sonders[1]==21) { ?>
    <div class="alert alert-danger">
  <strong>22. Cüz</strong> Yasin Suresi Dinlenmesi Gerekiyor.
</div>
     <?php } elseif ($sonders[1]==29) { ?>
      <div class="alert alert-danger">
  <strong>30. Cüz</strong> Sayfanın Gerektirdiği Sureler Dinlenmesi Gerekiyor.
</div>
     <?php } else { } ?>
   
  

    <?php if ($hafizlikdurumcek['hafizlik_durum']=='Yüzüne') { ?>
   <h1> <a href="ogrenci-detay.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>" > Yüzüne Takip Tablosu İçin Tıklatınız</a></h1>
 <?php   } else { ?>
      <form action="../netting/islem.php" method="POST">
     
       



     <input type="hidden" name="hafizlik_durum" value="<?php echo $hafizlikdurumcek['hafizlik_durum']; ?>">
     

     <div class="form-group">
     
     

       <label for="recipient-name"  class="col-form-label">Tarih</label>
       <input type="date" name="tarih" class="form-control" value="<?php echo date('Y-m-d');  ?>">

     </div>




     <div class="form-group">
     
     
     <label for="recipient-name"  class="col-form-label">Hoca</label>
    <select name="kullanici_id" class="form-control" id="recipient-name">

      <?php
    
    $sechocasor = $db->prepare("SELECT * FROM kullanici where kullanici_id order by kullanici_adsoyad asc");
                        $sechocasor->execute(array());
                    
    while ($sechoca = $sechocasor->fetch(PDO::FETCH_ASSOC)) { ?>
       <option value="<?php echo $sechoca['kullanici_id']; ?>" <?php if ($sechoca['kullanici_id']==$ogrencicek['kullanici_id'] ) {
         echo 'selected';
       } ?>><?php echo $sechoca['kullanici_adsoyad']; ?></option>
     <?php } ?>
   </select>
     
     
 
      <label for="recipient-name" class="col-form-label">Cüz</label>
       <select name="cuz" class="form-control" id="recipient-name">

        <?php for ($i=1; $i <= 30 ; $i++) { ?>
         <option value="<?php echo $i; ?>" <?php if ($i==$soncuz) {
           echo 'selected';
         } ?>><?php echo $i; ?></option>
       <?php } ?>
     </select>

   </div>


   <div class="form-group">
    <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
    <!--input type="hidden" name="kullanici_id" value="<?php echo $_SESSION['kullanici_id']; ?>"-->
    <input type="hidden" name="ogrenci_birim" value="<?php echo $ogrencicek['ogrenci_birim']; ?>">
   
   


    <?php if ($hafizsa[0] =='Hafız'){ 


      ?>
   <input type="hidden" name="sayfa" value="20">
      <!--label for="recipient-name"  class="col-form-label">Hizb</label>
      <select name="sayfa" class="form-control" id="recipient-name">

        <?php for ($i=1; $i <= 4 ; $i++) { ?>
         <option value="<?php echo $i.'. Hizb'; ?>" <?php if ($i==$sonsayfa) {
           echo 'selected';
         } ?>><?php echo $i.'. Hizb'; ?></option>
       <?php } ?>
     </select-->


   <?php

  
    } else { ?>
    <label for="recipient-name"  class="col-form-label">Sayfa</label>
    <select name="sayfa" class="form-control" id="recipient-name">

      <?php for ($i=1; $i <= 20 ; $i++) { ?>
       <option value="<?php echo $i; ?>" <?php if ($i==$sonsayfa) {
         echo 'selected';
       } ?>><?php echo $i; ?></option>
     <?php } ?>
   </select>

 <?php } ?>


 <label for="recipient-name"  class="col-form-label">Ders Durumu</label>
    <select name="hafizlik_hata" class="form-control" id="recipient-name">
<option selected>Yanlışsız</option>
<option>1 Yanlış</option>
<option>2 Yanlış</option>
   </select>
   
   <label for="recipient-name"  class="col-form-label">Okuma Usulü</label>
    <select name="hafizlik_usul" class="form-control" id="recipient-name">
<option selected>Hadr</option>
<option>Tedvir</option>
<option>Tahkik</option>
   </select>
</div>
<?php 
$url=$_SERVER['REQUEST_URI'];?>


<input type="hidden" name=url value="<?php echo $url; ?>">


</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
  <button type="submit" name="ders" class="btn btn-primary">Ekle</button>
   
</div>
  
</form>
   <?php } } ?>
</div>
 
</div>
  
</div>