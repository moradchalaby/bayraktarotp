<div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id']; ?>hafizlikdurum" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <?php if ($yetkiler <= 3) { ?>
            <h5 style="color:red; text-align:center;"> Bu Değişim Birim Hocaları Tarafından Yapılmaktadır!!!</h5>
            <?php } else { ?>

            <div class="modal-header">

                <h5 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>">
                    <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrenci Dönüş Bitirdi
                </h5>

            </div>
            <div class="modal-body">

                <?php
          $bitt = date("Y-m-d", strtotime($hafizlikcek['hafizlikdurum_bast']));
          $fark1 = date_create($bitt);
          $fark2 = date_create($date);
          $diffark = $fark2->diff($fark1);
          $fark = $diffark->format("%a");



          if (strtotime($hafizlikdurumcek['hafizlikdurum_bitt']) <= strtotime($date)) { ?>


                <h2 class="gizle" style="color: red;">Dönüş Başlama Tarihi:
                    <?php echo date('d-m-Y', strtotime($hafizlikdurumcek['hafizlikdurum_bast'])); ?>
                    <br>
                    <b><?php echo $fark . " gün oldu."; ?></b>
                </h2>
                <?php } else { ?>

                <h2 class="gizle">Dönüş Başlama Tarihi:
                    <?php echo date('d-m-Y', strtotime($hafizlikdurumcek['hafizlikdurum_bast'])); ?>
                    <br>
                    <b><?php echo $fark . " gün oldu."; ?></b>
                </h2>

                <?php } ?>

                <form action="../netting/islem.php" method="POST">
                    <?php
            $hassayi = explode(".", $hafizlikdurumcek['hafizlik_durum']);
            $hafiz = explode("(", $hafizlikdurumcek['hafizlik_durum']);
            ?>
                    <input type="hidden" name="hafizlik_durum"
                        value="<?php echo $hafizlikdurumcek['hafizlik_durum']; ?>">
                    <input type="hidden" name="ogrenci_birim" value="<?php echo $ogrencicek['ogrenci_birim']; ?>">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Hafızlık Durumu</label>
                        <select class="form-control" name="hafizlik_durum" id="recipient-name">
                            <option selected=""><?php echo $hafizlikdurumcek['hafizlik_durum']; ?></option>
                            <option>Yüzüne</option>
                            <option>Ham</option>
                            <option>Şartlı</option>
                            <option><?php $yenihafiz = intval($hafiz[1]) + 1;
                        if (intval($hafiz[1]) >= 1) {
                          echo "Hafız($yenihafiz)";
                        } else {
                          echo "Hafız(1)";
                        } ?></option>
                            <option><?php $yenihas = intval($hassayi[0]) + 1;
                        if (intval($hassayi[0]) >= 1) {
                          echo $yenihas . ".Has";
                        } else {
                          echo "1.Has";
                        } ?></option>



                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Başlangıç Tarihi</label>

                        <input type="date" class="form-control" name="bast" value="<?php echo date('Y-m-d'); ?>"
                            required="">



                    </div>



                    <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>" required="">

                    <?php
            $url = $_SERVER['REQUEST_URI']; ?>


                    <input type="hidden" name=url value="<?php echo $url; ?>">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <button type="submit" name="hdrmdegis" class="btn btn-primary">Değiştir</button>
            </div>
            </form>
            <?php } ?>
        </div>
    </div>
</div>