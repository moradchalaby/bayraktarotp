<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<div class="modal fade" id="<?php echo $dersid[$value]; ?>hocagoster" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="<?php echo $ogrencicek['id'] ?>">
                    <strong><?php echo $ogrencicek['adsoyad'] ?></strong> İsimli Öğrencinin
                    <strong><?php echo $ganc; ?></strong> tarihli ders durumu.</h5>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="text-align: center;">

                <?php



                echo "<h2>" . $sayfalar[$value] . '/' .  $cuzler[$value] . " = " . $hocalar[$value] . "<br>
                     Yanlış durumu = " . $yanlislar[$value] . "<br> Okuma usulü = " . $usuller[$value] . "<br>Ders durumu = " . $durumlar[$value] . "</h2>";



                ?>
            </div>
            <div class="modal-footer">
                <?php if ($yetkiler >= 4) : ?>

                    <form action="../netting/islem.php" method="POST">
                        <?php
                        $url = $_SERVER['REQUEST_URI']; ?>


                        <input type="hidden" name=url value="<?php echo $url; ?>">
                        <input type="hidden" name="hafizlik_id" value="<?php echo $dersid[$value]; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" name="hfzlksil" class="btn bg-red">Sil</button>
                    </form>

                <?php endif ?>


            </div>
        </div>
    </div>
</div>