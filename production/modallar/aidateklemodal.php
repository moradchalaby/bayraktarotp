<div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id']; ?>aidatekle" tabindex="-1" role="dialog"
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

                <h5 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>">
                    <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrenci Aidat Girdisi
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
                            value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>">
                        <label for="recipient-name" class="col-form-label">Aidat Dönem Başlangıcı</label>

                        <input type="month" name="aidat_ay" class="form-control" value="<?php echo date('Y-m-d');  ?>">
                        <label for="recipient-name" class="col-form-label">Dönem</label>
                        <input type="number" name="donem" class="form-control" value="1">

                        <label for="recipient-name" class="col-form-label">Tutar</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" pattern="^\d*(\.\d{2}$)?" name="tutar"
                                    class="form-control col-md-7 ">
                            </div>
                            <div class="col-md-2">
                                <select name="kur" class=" form-control" id="recipient-name">
                                    <option selected>₺</option>
                                    <option>€</option>
                                    <option>$</option>

                                </select>
                            </div>
                        </div>
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <select name="aidat_odeme_sekli" class="form-control" id="recipient-name">
                            <option selected>Nakit</option>
                            <option>Banka</option>

                        </select>
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->

                        <label for="recipient-name" class="col-form-label">Makbuz No</label>
                        <input type="number" name="makbuz_no" class="form-control" readonly
                            value="<?php echo $makbuzno; ?>">

                    </div>


                    <div class="form-group">
                        <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
                        <input type="hidden" name="kullanici_adsoyad"
                            value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>">
                        <input type="hidden" name="makbuz_adsoyad"
                            value="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>">






                    </div>
                    <?php
                        $url = $_SERVER['REQUEST_URI']; ?>


                    <input type="hidden" name=url value="<?php echo $url; ?>">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="aidat" class="btn btn-primary">Ekle</button>

            </div>

            </form>

        </div>

    </div>

</div>
<?php } ?>