

<div class="modal fade" id="sinifders<?php echo $sinifcek['sinif_id'].$dersadcek['ders_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     <div class="modal-header">

      <h5 class="modal-title" id=""> <strong><?php echo $sinifcek['sinif_ad'] ?></strong> Sınıfına 
        <strong><?php echo $dersadcek['ders_ad'] ?></strong> Dersi Ayarlanıyor 
      </h5>

    </div>
    <div class="modal-body">

     <form action="../netting/islem.php" method="POST">

      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Ders</label>
        
        <input type="text" class="form-control" name="ders_ad" id="recipient-name" value="<?php echo $dersadcek['ders_ad'] ?>" >
        <input type="hidden" class="form-control" name="ders_id" id="recipient-name" value="<?php echo $dersadcek['ders_id'] ?>" >

      </div>
      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Sınıf</label>
        <input type="text" class="form-control" name="sinif_ad" id="recipient-name" value="<?php echo $sinifcek['sinif_ad'] ?>"  required="">
        <input type="hidden" class="form-control" name="sinif_id" id="recipient-name" value="<?php echo $sinifcek['sinif_id'] ?>" >

      </div>
      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Hoca</label>

        <select name="hoca_id" class="select2_multiple form-control col-md-7 col-xs-12">
          <option>Seçiniz</option>
          <?php 

          $hocasor=$db->prepare("SELECT * from kullanici where kullanici_birim=:kullanici_birim order by kullanici_adsoyad asc");
          $hocasor->execute(array(

            'kullanici_birim'=>$sinifcek['sinif_birim']
          ));

          while ($hocacek=$hocasor->fetch(PDO::FETCH_ASSOC)) {
           ?>


           <option value="<?php echo $hocacek['kullanici_id']; ?>" <?php if ($hocacek['kullanici_id']==$hadi['kullanici_id']){ echo 'selected'; } ?>><?php echo $hocacek['kullanici_adsoyad'] ?></option>
         <?php } ?>
       </select>


     </div>
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
     <button type="submit" name="sinifders" class="btn btn-primary">Ekle</button>
   </div>
 </form>
</div>
</div>
</div>