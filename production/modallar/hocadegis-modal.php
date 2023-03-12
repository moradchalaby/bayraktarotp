<div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id']; ?>hocadegis" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">


                <h5 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>">
                    <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrencinin Hocasını Değiştir
                </h5>

            </div>
            <div class="modal-body">
                <?php if ($yetkiler >= 4) { ?>
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
                        <select name="kullanici_id" class="select2_multiple form-control col-md-7 col-xs-12">

                            <?php
                                $yetki = array(3, 4, 5);
                                $hocasor = $db->prepare("SELECT * from kullanici where kullanici_yetki=:yetki3 or kullanici_yetki=:yetki4 or kullanici_yetki=:yetki5 order by kullanici_adsoyad asc");
                                $hocasor->execute(array(
                                    'yetki3' => 3,
                                    'yetki4' => 4,
                                    'yetki5' => 5
                                ));




                                ?>




                            <?php


                                while ($hocacek = $hocasor->fetch(PDO::FETCH_ASSOC)) {


                                ?>



                            <option value="<?php echo $hocacek['kullanici_id']; ?>" <?php if ($ogrencicek['kullanici_id'] == $hocacek['kullanici_id']) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                <?php echo $hocacek['kullanici_adsoyad']; ?></option>
                            <?php }

                                $url = $_SERVER['REQUEST_URI'];

                                ?>
                        </select>
                    </div>

                    <input type="hidden" name=url value="<?php echo $url; ?>">

                    <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="hocadegis" class="btn btn-primary">Değiştir</button>
            </div>
            </form>
            <?php } else { ?>


            <h5 style="color: red;"> Bu Değişim Birim Hocaları Tarafından Yapılmaktadır!!!</h5>


            <?php } ?>
        </div>
    </div>
</div>