<?php include '../netting/baglan.php';


$dersler = explode("&", $day[0]);


                        

?>
<div class="modal fade" id="<?php echo $hafizlikdersmodal['hafizlik_id']; ?>hocagoster" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="<?php echo $ogrencicek['ogrenci_id'] ?>"><strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrencinin <strong><?php echo $tarh; ?></strong> tarihli ders durumu.</h5>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                
                <?php 


               $i = 0;
                while ($i < count($dersler)) {
                    $hocakimsor = $db->prepare("SELECT * FROM kullanici where kullanici_id={$hafizlikdersmodal['kullanici_id']} ");
                        $hocakimsor->execute(array());
                    $hocakimcek = $hocakimsor->fetch(PDO::FETCH_ASSOC);
                    
                    echo "<h2>".$hafizlikdersmodal['hafizlik_sayfa'].'/'.$hafizlikdersmodal['hafizlik_cuz'] . " = " . $hocakimcek['kullanici_adsoyad'] . "<br>
                     Yanlış durumu = ".$hafizlikdersmodal['hafizlik_hata']."<br> Okuma usulü = ".$hafizlikdersmodal['hafizlik_usul']."<br>Ders durumu = ".$hafizlikdersmodal['hafizlik_durum']."</h2>";
                    $i++;
                };
             
                ?>
            </div>
            <div class="modal-footer">
<?php if ($yetkiler>=4): ?>
    
    <form action="../netting/islem.php" method="POST">
        <?php 
$url=$_SERVER['REQUEST_URI'];?>


<input type="hidden" name=url value="<?php echo $url; ?>">
     <input type="hidden" name="hafizlik_id" value="<?php echo $hafizlikdersmodal['hafizlik_id'] ?> ">
     <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
     <button type="submit" name="hfzlksil" class="btn bg-red">Sil</button>
 </form>
    
<?php endif ?>
 

            </div>
        </div>
    </div>
</div>