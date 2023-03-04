<?php include 'header.php';

if ($yetkiler >= 5) {
    
    $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id");
    $sinifsor->execute(array(

    ));
} else {


    $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_birim=:sinif_birim");
    $sinifsor->execute(array(

        'sinif_birim'=> $kullanicicek['kullanici_birim']));
}

$sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC);

$sira = $sinifsor->rowCount();
?>


<style>
    li {
        cursor: move;
    }

    div.selected {
        background-color: GoldenRod
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Yeni Öğrenci Ekleme<small>


                            <?php
                            if (isset($_GET['durum']) and $_GET['durum'] == "ok") { ?>

                                <b style="color:green;">İŞLEM BAŞARILI...</b>


                            <?php   } elseif (isset($_GET['durum']) and $_GET['durum'] == "no") { ?>

                                <b style="color:red;">İŞLEM BAŞARISIZ...</b>


                            <?php }
                            ?>
                        </small>

                    </h2>
                    <ul class="nav navbar-right panel_toolbox">


                    </ul>
                    <div class="clearfix"></div>
                </div>



                <div class="x_content">
                    <br />
                    <form action="../netting/islem.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                        
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Sınıf Ekle <span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-2 col-xs-11">
                                <input type="text" id="first-name" style="text-align: center;" name="sinif_ad" placeholder="" required="required" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" id="first-name" style="text-align: center;" name="sinif_birim" value="<?php echo $kullanicicek['kullanici_birim'] ?>" class="form-control col-md-7 col-xs-12">

                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1">

                                <button type="submit" name="sinifekle" class="btn btn-info "><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="../netting/islem.php" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">Sınıf Sil <span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2 col-xs-11">
                            <select name="sinif_id" class="form-control col-md-7 col-xs-12">
                                <option value="">Sınıflar</option>
                                <?php while ($sinifsirala = $sinifsor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $sinifsirala['sinif_id']; ?>"><?php echo $sinifsirala['sinif_ad']; ?></option>
                                <?php } ?>
                            </select>


                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-1">

                            <button type="submit" name="sinifsil" class="btn btn-danger "><i class="fa fa-trash-o"></i></button>
                        </div>
                    </div>
                </div>
            </form>

            <?php
              //print_r($_POST['sinif1']);
              //echo "<br>";
              //print_r($_POST['sinif2']);
              //echo "<br>";
              //print_r($_POST['sinif3']);
              //echo "<br>";
              //print_r($_POST['sinif4']);



            ?>
            <form action="../netting/islem.php" method="POST">

                <button type="submit" id="bas" class="form-control btn btn-success col-md-12 col-sm-12 col-xs-12" style="   position:fixed;
                bottom:0;
                
                width:100%;

                height:35px; z-index: 5;" name="sinif">Kaydet</button>
                <?php
            
                if ($yetkiler>=5) {
                    
                    $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_id");
                    $sinifsor->execute(array(

                    ));
                } else {


                    $sinifsor = $db->prepare("SELECT * FROM sinif where sinif_birim=:sinif_birim");
                    $sinifsor->execute(array(

                        'sinif_birim'=> $kullanicicek['kullanici_birim']));
                }
                $hr = 0;
                while ($sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC)) {
                    $hr++;
                    ?>



                    <div id="n<?php echo $sinifcek['sinif_id']; ?>" class="connectedSortable mro col-md-4 col-sm-12 col-xs-12" style="border: 2px solid ;
                    border-radius: 5px;">
                    <div class="list-group-item  mrodis" id="baslik<?php echo $sinifcek['sinif_id']; ?>" style="border: 5px solid ;
                    border-radius: 5px;">
                    <h2><?php echo $sinifcek['sinif_ad'] ?></h1>
                    </div>
                    <?php

                    $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_sinif=:sinif");
                    $ogrencisor->execute(array(

                        'kytdrm' => 1,
                        'sinif' => $sinifcek['sinif_id']
                    ));

                    while ($ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC)) { ?>

                        <div class="list-group-item col-md-12 col-sm-6 col-xs-12" id="<?php echo $ogrencicek['ogrenci_id']; ?>">
                            <label><?php echo $ogrencicek['ogrenci_adsoyad']; ?></label>
                            <input type="hidden" class="talebe col-md-1 col-sm-6 col-xs-12" readonly name="sinif<?php echo $sinifcek['sinif_id']; ?>[]" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                        </div>



                    <?php }  ?>

                </div>
                <?php if ($hr%3==0) : ?>
                    <label class="col-md-12 hidden-xs"><hr></label>
                <?php endif ?>
            <?php    }  ?>




        </form>




    </div>
</div>
</div>
</div>


</div>
</div>

<script>




</script>

<script src="../vendors/jquery/dist/custom.js"></script><!-- Ajax ve sıralama ile ilgili ayarları custom.js de yapıyoruz. -->
<!-- /page content -->
<?php include 'footer.php'; ?>