

<div class="modal fade" id="dersekle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
     <div class="modal-header">

      <h5 class="modal-title" id=""> <strong>İHTİSAS </strong> Birimine 
        Ders Ekleniyor...
      </h5>

    </div>
    <div class="modal-body">

     <form action="../netting/islem.php" method="POST">

      <div class="form-group">

        <label for="recipient-name"  class="col-form-label">Ders</label>
        
        <input type="text" class="form-control" name="ders_ad" id="recipient-name" placeholder="Ders İsmi Giriniz" >
        <input type="hidden" class="form-control" name="ders_id" id="recipient-name" value="<?php echo $kullanicicek['kullanici_id'] ?>" >

      </div>
      
   </div>
   <div class="modal-footer">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
     <button type="submit" name="ihtisasders" class="btn btn-primary">Ekle</button>
   </div>
 </form>
</div>
</div>
</div>