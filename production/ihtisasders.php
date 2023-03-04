
<?php 
include '../netting/baglan.php';


include 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ




?>


<!-- page content -->
<div class="right_col" role="main">

  <div class="page-title">
    <div class="title_left">
      <h3>Ders-Hoca-Sınıf Durumu<small><?php 
      if ($_GET['durum']=="ok") {?>

       <b style="color:green;">İşlem Başarılı...</b>


     <?php   }elseif ($_GET['durum']=="no") {?>

      <b style="color:red;">İşlem Başarısız...</b>


      <?php } ?></small></h3>
    </div>





  </div>



  <div class="clearfix"></div>

  <!--Tablo Başlangıç-->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Tam Liste <small> Hoca ataması yapmak için '---' nin üstüne tıklayınız.</small>

          </h2>

          <ul class="nav navbar-right panel_toolbox">

            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              <li> <a href="#"  data-toggle="modal" data-target="#dersekle" data-whatever="" ><button class="btn btn-success btn-xs">Ders Ekle</button></a></li>
            </li>

          </ul>
          <div class="clearfix"></div>
        </div>
        <div id="ahmet" class="x_content  col-xs-12">

          <table  id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" >
            <thead width="100%">
              <tr>

                <th>DERS // SINIF</th>
                <?php 


                $sinifadsor=$db->prepare("SELECT * FROM sinif where sinif_birim=:sinif_birim order by sinif_ad asc");
                $sinifadsor->execute(array(
                  'sinif_birim'=>3

                ));


                while ($sinifadcek=$sinifadsor->fetch(PDO::FETCH_ASSOC)) {


                  ?>
                  <th ><?php echo $sinifadcek['sinif_ad'] ?></th>


                <?php } ?>

              </tr>

            </thead>
            <tbody>

              <?php 

              $dersadsor=$db->prepare("SELECT * FROM ders where ders_id order by ders_ad asc");
              $dersadsor->execute(array(

              ));

              while ($dersadcek=$dersadsor->fetch(PDO::FETCH_ASSOC)) {

               ?>
               <tr>
                <th>  <?php echo $dersadcek['ders_ad'] ?></th>
                <?php 

                $sinifsor=$db->prepare("SELECT * FROM sinif where sinif_birim=:sinif_birim order by sinif_ad asc");
                $sinifsor->execute(array(
                  'sinif_birim'=>$kullanicicek['kullanici_birim']

                ));
                while ($sinifcek=$sinifsor->fetch(PDO::FETCH_ASSOC)) {


                 $derssinifsor=$db->prepare("SELECT *
                  FROM sinif_ders
                  INNER JOIN sinif ON sinif_ders.sinif_id = sinif.sinif_id
                  INNER JOIN ders ON sinif_ders.ders_id = ders.ders_id
                  INNER JOIN kullanici ON sinif_ders.hoca_id = kullanici.kullanici_id
                  where sinif.sinif_id =:sinif_id and ders.ders_id=:ders_id" );
                 $derssinifsor->execute(array(
                  'sinif_id'=>$sinifcek['sinif_id'],
                  'ders_id' => $dersadcek['ders_id']

                )); 

                 $hadi=$derssinifsor->fetch(PDO::FETCH_ASSOC);
                 
                 $sinif=$sinifcek['sinif_ad'];
                 $ders=$dersadcek['ders_ad'];

                 ?>
                 <td><a href="#"  data-toggle="modal" data-target="#sinifders<?php echo $sinifcek['sinif_id'].$dersadcek['ders_id']; ?>" data-whatever="" ><?php 
                      if ($hadi) {
                        echo $hadi['kullanici_adsoyad'];
                      } else {

                        echo '---';
                      }

                  ?></a></td>
              


             <?php
              include 'modallar/sinifdersmodal.php'; 
              } ?>

           </tr>
         <?php } ?>

           </tbody>
         </table>

       </div>
     </div>
   </div>
 </div>

 <!-- Tablo Bitiş-->




 <?php

include 'modallar/ihtisasdersmodal.php';
  include 'footer.php'; ?>
