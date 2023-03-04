


<?php 
include '../netting/baglan.php';


include 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ
$birim= $kullanicicek['kullanici_birim'];
$sinif= $kullanicicek['kullanici_sinif'];
$ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_sinif=:sinif and ogrenci_birim=:birim ");
$ogrencisor->execute(array(
  'birim'=> $birim,
  'sinif'=> $sinif,
  'kytdrm'=> 1));





  ?>
  

  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Öğrenci Listeleri<small><?php 
          if ($_GET['sil']=="ok") {?>

           <b style="color:green;">Kayıt Silindi</b>


         <?php   }elseif ($_GET['sil']=="no") {?>

          <b style="color:red;">İşlem Başarısız..</b>


        <?php }elseif($_GET['durum']=="kayitbasarili"){?>

          <b style="color:green;">Yeni Kayıt Oluşturuldu!</b>

          <?php } ?></small></h3>
        </div>


        


      </div>

    </div>

    <div class="clearfix"></div>

    <!--Tablo Başlangıç-->
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Tam Liste <small> Aktif olan bütün kayıtlar.</small>

            </h2>

            <ul class="nav navbar-right panel_toolbox">



            </ul>
            <div class="clearfix"></div>
          </div>
          <div id="ahmet" class="x_content col-xs-12">

            <table  id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
              <thead width="100%">
                <tr>
                  <th >Resim</th>
                  <th>Ad Soyad</th>
                  <th>Tc No</th>
                  <th>Birim</th>
                  <th>Sınıf</th>
                  <th>Okul Durumu</th>
                  <th>Doğum Tarihi</th>
                  <th>Adres</th>
                  <th>Baba Adı</th>
                  <th>Baba Tel</th>
                  <th>Baba Mesleği</th>
                  <th>Anne Adı</th>
                  <th>Anne Tel</th>








                </tr>
              </thead>
              <tbody>




                <?php 
                while($ogrencicek=$ogrencisor->fetch(PDO::FETCH_ASSOC)){?>

                  <tr>
                    <td >

                      <?php if (strlen($ogrencicek['ogrenci_resim']) > 0){ ?>
                        <img  src="../<?php echo $ogrencicek['ogrenci_resim']; ?>" style="max-width: 100%;">




                      <?php } else { ?> 
                       <img src="../dimg/logo-yok.png" style="max-width: 100%;">
                     <?php } ?>
                   </td>



                   <td><a href="ogrenci-detay.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>"><?php echo $ogrencicek['ogrenci_adsoyad']; ?></a></td>

                   <td><?php echo $ogrencicek['ogrenci_tc']; ?></td>

                   <td><?php


                   $birimsor=$db->prepare("SELECT * from birim where birim_id=:birim_id");
                   $birimsor->execute(array(
                    'birim_id' => $ogrencicek['ogrenci_birim']
                  ));

                   $birimcek=$birimsor->fetch(PDO::FETCH_ASSOC);



                   echo $birimcek['birim_ad'] ; ?></td>

                   <td><?php 


                   $sinifsor=$db->prepare("SELECT * from sinif where sinif_id=:sinif_id");
                   $sinifsor->execute(array(
                    'sinif_id'=>$ogrencicek['ogrenci_sinif']
                  ));

                   $sinifcek=$sinifsor->fetch(PDO::FETCH_ASSOC);

                   echo $sinifcek['sinif_ad']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_okuldurum']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_dt']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_adres']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_baba']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_babatel']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_babames']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_anne']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_annetel']; ?></td>                







                   <!-- Modal -->
                   <div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="alert alert-danger">
                          <h1 class="modal-title" id="exampleModalLabel">Dikkat</h1>

                        </div>
                        <div class="modal-body">
                         <h3> <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong> İsimli Öğrenci Kaydı Siliniyor..</h3>
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                        <a href="../netting/islem.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>&ogrencisil=ok"><button type="button" class="btn btn-primary">Evet</button> </a>
                      </div>
                    </div>
                  </div>
                </div> </td>
                <!-- <td style="width:1px;"><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></td> -->


              </tr>


            <?php }; ?>  


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Tablo Bitiş-->




<?php include 'footer.php'; ?>

