<div class="modal fade" id="<?php echo $makbuzcek['makbuz_id']; ?>editmakbuz" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">


        <div class="modal-content">
            <?php


            if ($yetkiler <= 4) {
                echo '<h5 style="color: red; text-align:center;"> Bu Değişim İdare Tarafından Yapılmaktadır!!!</h5>';
            } else { ?>
            <div class="modal-header">

                <h5 class="modal-title" id="">
                    <strong><?php echo $makbuzcek['makbuz_id']; ?> Nolu Makbuz Düzenle</strong>
                </h5>

            </div>
            <div align="center" class="modal-body">

                <form action="../netting/islem.php" method="POST">






                    <div class="form-group">



                        <label for="recipient-name" class="col-form-label">Tarih</label>
                        <input type="date" name="tarih" class="form-control"
                            value="<?php echo $makbuzcek['makbuz_tarih']; ?>">

                    </div>




                    <div class="form-group">


                        <label for="recipient-name" class="col-form-label">Tahsilat Yapan</label>
                        <input name="kullanici_adsoyad" readonly class="form-control" id="recipient-name"
                            value="<?php echo $makbuzcek['kullanici_adsoyad']; ?>">
                        <!--  <label for="recipient-name" class="col-form-label">Aidat Dönem Başlangıcı</label>

                        <input type="month" name="aidat_ay" class="form-control" value="<?php echo date('Y-m-d');  ?>">
                         --><label for="recipient-name" class="col-form-label">Ödeme Yapan</label>
                        <input type="text" class="form-control" name="makbuz_adsoyad"
                            value="<?php echo $makbuzcek['makbuz_adsoyad']; ?>">

                        <label for="recipient-name" class="col-form-label">Tutar</label>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" pattern="^\d*(\.\d{2}$)?"
                                    value="<?php echo $makbuzcek['makbuz_tutar']; ?>" name="tutar"
                                    class="form-control col-md-7 ">
                            </div>
                            <div class="col-md-2">
                                <select name="kur" class=" form-control" id="recipient-name">
                                    <option <?php if ($makbuzcek['makbuz_kur'] == '₺') {
                                                    echo "selected";
                                                } ?>>₺</option>
                                    <option <?php if ($makbuzcek['makbuz_kur'] == '€') {
                                                    echo "selected";
                                                } ?>>€</option>
                                    <option <?php if ($makbuzcek['makbuz_kur'] == '$') {
                                                    echo "selected";
                                                } ?>> $ </option>

                                </select>
                            </div>
                        </div>
                        <label for="recipient-name" class="col-form-label">Ödeme Şekli</label>
                        <select name="makbuz_odeme_sekli" class="form-control" id="recipient-name">
                            <option <?php if ($makbuzcek['makbuz_odeme_sekli'] == 'Nakit') {
                                            echo "selected";
                                        } ?>>Nakit</option>
                            <option <?php if ($makbuzcek['makbuz_odeme_sekli'] == 'Banka') {
                                            echo "selected";
                                        } ?>>Banka</option>

                        </select>
                        <!--label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea name="ac'klama" class="form-control"></textarea-->
                        <label for="recipient-name" class="col-form-label">Açıklama</label>
                        <textarea class="form-control" cols="20" rows="3" name="makbuz_aciklama"
                            value=""><?php echo $makbuzcek['makbuz_aciklama']; ?></textarea>

                        <label for="recipient-name" class="col-form-label">Makbuz No</label>
                        <input type="number" name="makbuz_no" class="form-control" readonly
                            value="<?php echo $makbuzcek['makbuz_id']; ?>">

                    </div>


                    <div class="form-group">
                        <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
                        <input type="hidden" name="kullanici_adsoyad"
                            value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>">

                        <input type="hidden" name="makbuz_id" value="<?php echo $makbuzcek['makbuz_id']; ?>">





                    </div>
                    <?php
                        $url = $_SERVER['REQUEST_URI']; ?>


                    <input type="hidden" name=url value="<?php echo $url; ?>">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="makbuzduzenle" class="btn btn-primary">Düzenle</button>


            </div>

            </form>

        </div>

    </div>

</div>
<?php } ?>