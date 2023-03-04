<div class="modal fade" id="<?php echo $makbuzcek['makbuz_id']; ?>makbuzsil" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">


        <div class="modal-content">
            <?php
            $sechocasor = $db->prepare("SELECT * FROM makbuz ORDER BY makbuz_id DESC LIMIT 1;");
            $sechocasor->execute(array());

            $sechoca = $sechocasor->fetch(PDO::FETCH_ASSOC);
            $makbuzno = $sechoca['makbuz_id'] + 1;

            if ($yetkiler <= 4) {
                echo '<h5 style="color: red; text-align:center;"> Bu Değişim İdare Tarafından Yapılmaktadır!!!</h5>';
            } else { ?>
            <div class="modal-header">

                <h5 class="modal-title" id="">
                    <strong>Makbuz Sil</strong>
                </h5>

            </div>
            <div align="center" class="modal-body">

                <form action="../netting/islem.php" method="POST">






                    <div class="form-group">



                        <label for="recipient-name" class="col-form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control" value="<?php echo date('Y-m-d');  ?>">

                    </div>




                    <div class="form-group">


                        <label for="recipient-name" class="col-form-label">Tahsilat Yapan</label>
                        <input name="kullanici_adsoyad" class="form-control" id="recipient-name"
                            value="<?php echo $makbuzcek['kullanici_adsoyad']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Ödeme Yapan</label>
                        <input type="text" class="form-control" name="makbuz_adsoyad"
                            value="<?php echo $makbuzcek['makbuz_adsoyad']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Tutar</label>

                        <input type="text" name="tutar" class="form-control col-md-7 "
                            value="<?php echo $makbuzcek['makbuz_tutar'] . $makbuzcek['makbuz_kur']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <input type="text" name="tutar" class="form-control col-md-7 "
                            value="<?php echo $makbuzcek['makbuz_odeme_sekli']; ?>">
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Açıklama</label>
                        <input type="text" class="form-control" name="makbuz_aciklama"
                            value="<?php echo $makbuzcek['makbuz_aciklama']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Makbuz No</label>
                        <input type="number" name="makbuz_no" class="form-control" readonly
                            value="<?php echo $makbuzcek['makbuz_id']; ?>">

                    </div>


                    <div class="form-group">
                        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
                        <input type="hidden" name="kullanici_adsoyad"
                            value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>">







                    </div>
                    <?php
                        $url = $_SERVER['REQUEST_URI']; ?>


                    <input type="hidden" name=url value="<?php echo $url; ?>">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <a class="btn btn-danger" rel="noopener noreferrer"
                    href="../netting/islem.php?makbuz_id=<?php echo $makbuzcek['makbuz_id'] ?>">Sil</a>

            </div>

            </form>

        </div>

    </div>

</div>
<?php } ?>