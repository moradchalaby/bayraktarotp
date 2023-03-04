<div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id']; ?>sinifdegis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
            <?php 
          $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id ");
          $sinifsor->execute(array());
          ?>
                <h5 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>"> <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrenci Dönüş Bitirdi</h5>

            </div>
            <div class="modal-body">

                <form action="../netting/islem.php" method="POST">

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Hoca Değişimi</label>
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
                        <select name="ogrenci_sinif" class="select2_multiple form-control col-md-7 col-xs-12">
                            <option selected><?php echo $ogrencicek['ogrenci_sinif']; ?></option>
                            
                    
                    <?php while ($sinifsirala = $sinifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                      <option value="<?php echo $sinifsirala['sinif_ad']; ?>"><?php echo $sinifsirala['sinif_ad']; ?></option>
                    <?php } ?>


                        </select>
                    </div>



                    <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>"  required="">





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="sinifdegis" class="btn btn-primary">Değiştir</button>
            </div>
            </form>
        </div>
    </div>
</div>