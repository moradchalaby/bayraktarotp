 <?php
  include '../netting/baglan.php';


  include 'header.php';
  //BELİRLİ VERİYİ SEÇME İŞLEMİ

  if ($kullanicicek['kullanici_yetki'] == 4) {
    $hoca = $kullanicicek['kullanici_id'];
    $sinif = $kullanicicek['kullanici_sinif'];
    $birim = $kullanicicek['kullanici_birim'];
    $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and (kullanici_id=:hoca or ogrenci_birim=:sinif)");
    $ogrencisor->execute(array(

      'kytdrm' => 1,
      'hoca' => $hoca,
      'sinif' => $birim
    ));
  } elseif ($kullanicicek['kullanici_yetki'] == 5) {
    # code...


    $ogrencisor = $db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm ");
    $ogrencisor->execute(array(

      'kytdrm' => 1
    ));
  }





  ?>


 <!-- page content -->
 <div class="right_col" role="main">

   <div class="page-title">
     <div class="title_left">
       <h3>Öğrenci Listeleri<small><?php
                                    if (isset($_GET['sil']) && $_GET['sil'] == "ok") { ?>

             <b style="color:green;">Kayıt Silindi</b>


           <?php   } elseif (isset($_GET['sil']) && $_GET['sil'] == "no") { ?>

             <b style="color:red;">İşlem Başarısız..</b>


           <?php } elseif (isset($_GET['sil']) && $_GET['durum'] == "kayitbasarili") { ?>

             <b style="color:green;">Yeni Kayıt Oluşturuldu!</b>

           <?php } ?></small></h3>
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

             <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
             <li> <a href="ogrenci-ekle.php"><button class="btn btn-success btn-xs">Yeni Ekle</button></a>
             </li>
             </li>

           </ul>
           <div class="clearfix"></div>
         </div>
         <div id="ahmet" class="x_content  col-xs-12">

           <table id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
             <thead width="100%">
               <tr>
                 <th>Resim</th>
                 <th>Ad Soyad</th>

                 <th>Hoca</th>
                 <th>Sınıf</th>
                 <th>Birim</th>

                 <th>Okul Durumu</th>
                 <th>Doğum Tarihi</th>
                 <th>Adres</th>
                 <th>Baba Adı</th>
                 <th>Baba Tel</th>
                 <th>Baba Mesleği</th>
                 <th>Anne Adı</th>
                 <th>Anne Tel</th>

                 <th>İşlem</th>
                 <!--button için boş bırakıldı yoksa kaymalar olr.-->






               </tr>
             </thead>
             <tbody>




               <?php
                while ($ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC)) {


                  $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_id=:id");
                  $kullanicisor->execute(array(
                    'id' => $ogrencicek['kullanici_id']
                  ));



                  $hocacek = $kullanicisor->fetch(PDO::FETCH_ASSOC);


                ?>



                 <tr>
                   <td>

                     <?php if (strlen($ogrencicek['ogrenci_resim']) > 0) { ?>
                       <img src="../<?php echo $ogrencicek['ogrenci_resim']; ?>" class="avatar"">




                          <?php } else { ?> 
                           <img src=" ../dimg/logo-yok.png" class="avatar"">
                         <?php } ?>
                       </td>



                       <td><a href=" ogrenci-detay.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>"><?php echo $ogrencicek['ogrenci_adsoyad']; ?></a>
                   </td>



                   <td><a href="#" data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id'] ?>hocadegis" data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $hocacek['kullanici_adsoyad']; ?></a>
                   </td>

                   <td><?php

                        $sinifsor = $db->prepare("SELECT * from sinif where sinif_id={$ogrencicek['ogrenci_sinif']}");
                        $sinifsor->execute();
                        $sinifcek = $sinifsor->fetch(PDO::FETCH_ASSOC);
                        echo $sinifcek['sinif_ad']; ?></a></td>
                   <td><?php

                        $birimsor = $db->prepare("SELECT * from birim where birim_id={$ogrencicek['ogrenci_birim']}");
                        $birimsor->execute();
                        $birimcek = $birimsor->fetch(PDO::FETCH_ASSOC);
                        echo $birimcek['birim_ad']; ?></a></td>



                   <td><?php echo $ogrencicek['ogrenci_okuldurum']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_dt']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_adres']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_baba']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_babatel']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_babames']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_anne']; ?></td>

                   <td><?php echo $ogrencicek['ogrenci_annetel']; ?></td>


                   <td><a href="ogrenci-duzenle.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a><button type="submit" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id'] ?>">Sil</button></td>




                   <!-- Modal -->
                   <div class="modal fade" id="<?php echo $ogrencicek['ogrenci_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="alert alert-danger">
                           <h1 class="modal-title" id="exampleModalLabel">Dikkat</h1>

                         </div>
                         <div class="modal-body">
                           <h3> <strong><?php echo $ogrencicek['ogrenci_adsoyad'] ?></strong>
                             İsimli Öğrenci Kaydı Siliniyor..</h3>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
                           <a href="../netting/islem.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>&ogrencisil=ok"><button type="button" class="btn btn-primary">Evet</button> </a>
                         </div>
                       </div>
                     </div>
                   </div>
                   <!-- <td style="width:1px;"><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></td> -->


                 </tr>


               <?php

                  include 'modallar/hocadegis-modal.php';
                  include 'modallar/sinifdegis-modal.php';
                }; ?>


             </tbody>
           </table>

         </div>
       </div>
     </div>
   </div>

   <!-- Tablo Bitiş-->




   <?php include 'footer.php'; ?>