<div class="modal fade" id="katilimislem<?php echo $katilimcek['katilim_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     <div class="modal-header">

      <h5 class="modal-title" id=""> <strong><?php echo $sinifadcek['sinif_ad']?></strong> Sınıfı  <strong><?php echo $dersadcek['ders_ad']?></strong> Dersinin
        <strong><?php echo $katilimcek['katilim_ad']?></strong> Yoklama işlemleri
      </h5>

    </div>
    <div class="modal-body">

     <form action="../netting/islem.php" method="POST">
       <?php 
       $date1=date('d_m_Y');
       ?> 



       <input type="hidden" name="katilim_zaman" value="<?php echo date('Y-m-d');  ?>">
       <input type="hidden" name="katilim_id" value="<?php echo $katilimcek['katilim_id'];  ?>">
       <input type="hidden" name="ders_id" value="<?php echo $dersadcek['ders_id'];  ?>">
       <input type="hidden" name="sinif_id" value="<?php echo $sinifadcek['sinif_id'];  ?>">
       <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];  ?>">
       <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Yoklama Ders Başlık</label>
        <input type="text" class="form-control" name="katilim_ad" id="recipient-name" value="<?php echo $katilimcek['katilim_ad'] ?>"  required="">

      </div>
      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Yoklama Ders Tarihi</label>
        <input type="date" class="form-control" name="katilim_zaman" id="recipient-name" required="" value="<?php echo $katilimcek['katilim_zaman'] ?>">

      </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
     <button type="submit" name="katilimduzenle" class="btn bg-green">Düzelt</button>
     <button type="submit" name="katilimsil" class="btn bg-red">Sil</button>
   </div>
 </form>
</div>
</div>
</div>