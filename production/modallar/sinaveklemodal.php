<?php 

$dersinadsor=$db->prepare("SELECT * FROM ders where ders_id=:ders_id ");
$dersinadsor->execute(array(

  'ders_id' => $_GET['ders']
)); 
$dersadcek=$dersinadsor->fetch(PDO::FETCH_ASSOC);

$sinifinadsor=$db->prepare("SELECT * FROM sinif where sinif_id=:sinif_id ");
$sinifinadsor->execute(array(

  'sinif_id' => $_GET['sinif']
));


$sinifadcek=$sinifinadsor->fetch(PDO::FETCH_ASSOC);

?>

<div class="modal fade" id="sinavekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     <div class="modal-header">

      <h5 class="modal-title" id=""> <strong><?php echo $sinifadcek['sinif_ad']?></strong> Sınıfına 
        <strong><?php echo $dersadcek['ders_ad']?></strong> Dersi için İmtihan Kaydı Açılıyor 
      </h5>

    </div>
    <div class="modal-body">

     <form action="../netting/islem.php" method="POST">
       



       <input type="hidden" name="ders_id" value="<?php echo $dersadcek['ders_id'];  ?>">
       <input type="hidden" name="sinif_id" value="<?php echo $sinifadcek['sinif_id'];  ?>">
       <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];  ?>">
       <div class="form-group">

        <label for="recipient-name"  class="col-form-label">İmtihan Başlık</label>
        <input type="text" class="form-control" name="sinav_ad" id="recipient-name"  required="">

      </div>
      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">İmtihan Tarihi</label>
        <input type="date" class="form-control" name="sinav_zaman" id="recipient-name"  required="">

      </div>
    </div>
    <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
     <button type="submit" name="yenisinav" class="btn btn-primary">Ekle</button>
   </div>
 </form>
</div>
</div>
</div>