


<?php 
include '../netting/baglan.php';


include 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ

//tüm kullanıcılar için kullanici
$kullanicisor=$db->prepare("SELECT * FROM kullanici");
$kullanicisor->execute();





?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Listeleri <small>


              <?php 
              if ($_GET['sil']=="ok") {?>

                <b style="color:green;">Kayıt Silindi</b>


              <?php   }elseif ($_GET['sil']=="no") {?>

                <b style="color:red;">İşlem Başarısız..</b>


              <?php }elseif($_GET['durum']=="kayitbasarili"){?>

                <b style="color:green;">Yeni Kayıt Oluşturuldu!</b>

                <?php } ?> </small>



              </h2>
              <ul class="nav navbar-right panel_toolbox">
                <li> <a href="kullanici-ekle.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a></li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <br />

              <table id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Resim</th>
                    <th>Ad Soyad</th>
                    
                    <th>Birim</th>
                    <th>Sınıf</th>
                    <th>Mail Adresi</th>
                    <th>telefon</th>

                    <th></th><!--button için boş bırakıldı yoksa kaymalar olr.-->

                  </tr>
                </thead>
                <tbody>

                  <?php 

                  while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){?>

                    <tr>
                     <td >

                      <?php if (strlen($kullanicicek['kullanici_resim']) > 0){ ?>
                        <img  src="../<?php echo $kullanicicek['kullanici_resim']; ?>" class="avatar">




                      <?php } else { ?> 
                       <img src="../dimg/logo-yok.png" class="avatar">
                     <?php } 

                     $birimsor=$db->prepare("SELECT * from birim where birim_id=:birim_id");
                     $birimsor->execute(array(
                      'birim_id' => $kullanicicek['kullanici_birim']
                     ));

                     $birimcek=$birimsor->fetch(PDO::FETCH_ASSOC);

                     $sinifsor=$db->prepare("SELECT * from sinif where sinif_id=:sinif_id");
                     $sinifsor->execute(array(
                      'sinif_id'=>$kullanicicek['kullanici_sinif']
                     ));

                     $sinifcek=$sinifsor->fetch(PDO::FETCH_ASSOC);


                     ?>
                   </td>
                   <td><?php echo $kullanicicek['kullanici_adsoyad']; ?></td>
                   <td><?php echo $birimcek['birim_ad']; ?></td>
                   <td><?php echo $sinifcek['sinif_ad']; ?></td>
                   <td><?php echo $kullanicicek['kullanici_mail']; ?></td>
                   <td><?php echo $kullanicicek['kullanici_gsm']; ?></td>
                   <td style="width:1px;"><a href="kullanici-duzenle.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a><button type="submit" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $kullanicicek['kullanici_id'] ?>">Sil</button></td>
                   <!-- Modal -->
                   <div class="modal fade" id="<?php echo $kullanicicek['kullanici_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="alert alert-danger">
                          <h1 class="modal-title" id="exampleModalLabel">Dikkat</h1>

                        </div>
                        <div class="modal-body">
                          <h3> <strong><?php echo $kullanicicek['kullanici_adsoyad'] ?></strong> İsimli Personel Siliniyor..</h3>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                          <a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&kullanicisil=ok"><button type="button" class="btn btn-primary">Evet</button> </a>
                        </div>
                      </div>
                    </div>
                  </div> 
                  <!-- <td style="width:1px;"><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></td> -->


                </tr>


              <?php } ?>  


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<?php include 'footer.php'; ?>


