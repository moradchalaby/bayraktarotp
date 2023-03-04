<?php


include 'header.php';

// if ($kullanicicek['kullanici_yetki']==5 ) {
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1
//   ));
// }elseif ($kullanicicek['kullanici_yetki']==4) {
//   $birim = $kullanicicek['kullanici_birim'];
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim ");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1,
//     'birim' => $birim
//   ));
// }elseif ($kullanicicek['kullanici_yetki']<=3) {

//   $birim = $kullanicicek['kullanici_birim'];
//   $sinif = $kullanicicek['kullanici_sinif'];
//   $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim and ogrenci_sinif=:sinif ");
//   $ogrencisor->execute(array(

//     'kytdrm'=> 1,
//     'birim' => $birim,
//     'sinif' => $sinif
//   ));
// }

$sql = "SELECT id, title, aciklama, start, end, color, kullanici_id FROM events ";

$req = $db->prepare($sql);
$req->execute();

$events = $req->fetchAll();




?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">





                <h3>Takvim</h3>
            </div>
        </div>
        <div class="x_content">

            <div id='calendar'></div>

        </div>
    </div>
</div>

<div class=" modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="../netting/islem.php">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Etkinlik Ekle</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Başlık</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Başlık">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Açıklama</label>
                        <div class="col-sm-10">
                            <input type="text" name="aciklama" class="form-control" id="aciklama"
                                placeholder="Açıklama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Renk</label>
                        <input type="hidden" id='color' name='color'>
                        <div class="col-sm-10">
                            <div class="picker col-sm-3" id="picker1"></div>
                        </div>
                    </div>
                    <input type="hidden" name="start" class="form-control" id="start" readonly>
                    <input type="hidden" name="kullanici_id" class="form-control" id="kullanici_id"
                        value="<?php echo $kullanicicek['kullanici_id']; ?>" readonly>

                    <input type="hidden" name="end" class="form-control" id="end" readonly>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">İptal</button>
                    <button type="submit" name='addEvent' class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" action="../netting/islem.php">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Etkinliği Düzenle</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Başlık</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Başlık">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Açıklama</label>
                        <div class="col-sm-10">
                            <input type="text" name="aciklama" class="form-control" id="aciklama"
                                placeholder="Açıklama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="color" class="col-sm-2 control-label">Renk</label>
                        <input type="hidden" id='color1' name='color'>
                        <div class="col-sm-10">
                            <div class="picker col-sm-3" id="picker2"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">

                            <input type="text" name="kullanici" id="kullanici" readonly>

                        </div>
                    </div>

                    <input type="hidden" name="kullanici_id" class="form-control" id="kullanici_id"
                        value="<?php echo $kullanicicek['kullanici_id']; ?>" readonly>
                    <input type="hidden" name="id" class="form-control" id="id">


                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label class="text-danger"><input type="checkbox" name="delete"> Etkinliği sil </label>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
                    <button type="submit" name='editEvent' class="btn btn-primary">Dğişiklikleri kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- /calendar modal -->
<?php
include 'footer.php';
?>