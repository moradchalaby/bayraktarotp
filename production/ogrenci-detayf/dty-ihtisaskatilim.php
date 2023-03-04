<div role="tabpanel" class="tab-pane fade" id="katilim" aria-labelledby="profile-tab">

  <br>


    <?php
    $katilimpuansor = $db->prepare("SELECT * from katilimlar 
      INNER JOIN katilim_ogrenci ON katilim_ogrenci.katilim_id=katilimlar.katilim_id
      where katilim_ogrenci.ogrenci_id={$_GET['ogrenci_id']} ");
    $katilimpuansor->execute(array(  ));

    $tamkatilim=0;
    while ($katilimpuancek = $katilimpuansor->fetch(PDO::FETCH_ASSOC)) {
      if ($katilimpuancek['katilim_durum']==1) {
        $tamkatilim++;
      }
    }
    $katilimpuankac = $katilimpuansor->rowcount(); 


    ?>
<h3 align='center'>Genel Durum</h3>
    <div class="progress progress_md">

      <div class="progress-bar bg-green" role="progressbar" style="width: <?php echo $tamkatilim * 100 / $katilimpuankac; ?>%" aria-valuenow="<?php echo $tamkatilim * 100 / $katilimpuankac; ?>" aria-valuemin="0" aria-valuemax="100"></div>
      <div class="progress-bar bg-red" role="progressbar" style="width: <?php echo 100 - ($tamkatilim * 100 / $katilimpuankac); ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>




    </div>
    <h1 align="center">Devamsızlık Durumu: <?php echo '%'.round($tamkatilim * 100 / $katilimpuankac,2); ?><br><?php $eksikkatilim=$katilimpuankac-$tamkatilim; echo 'Girmediği Ders Sayısı: '.$eksikkatilim; ?></h1>

    
    
      <div class="col-md-12 col-sm-12 col-xs-12">

        <table  class="table table-striped ">

          <thead>



            <tr>

              <th style="text-align: center;"><?php echo $ogrencicek['ogrenci_adsoyad'] ?> <br><span>Yoklama Çetelesi</span></th>

            </tr>
          </thead>
          <tbody>
           <tr>
            <td>
             <ul class="list-group">


              <?php
              $katilimderssor= $db->prepare("SELECT * from sinif_ders 
                INNER JOIN ders ON sinif_ders.ders_id=ders.ders_id
                INNER JOIN sinif ON sinif_ders.sinif_id=sinif.sinif_id
                where sinif.sinif_id={$ogrencicek['ogrenci_sinif']}");
              $katilimderssor->execute(array(  ));



              ?>


              <?php 
              while ($katilimderscek = $katilimderssor->fetch(PDO::FETCH_ASSOC)) { 


                $katilimsor = $db->prepare("SELECT * from katilimlar INNER JOIN katilim_ogrenci ON katilim_ogrenci.katilim_id=katilimlar.katilim_id
                  where katilimlar.ders_id={$katilimderscek['ders_id']} and katilimlar.sinif_id={$katilimderscek['sinif_id']} and katilim_ogrenci.ogrenci_id={$_GET['ogrenci_id']} ");
                $katilimsor->execute(array(  ));
              
              $katilimvardir=$katilimsor->rowCount();
              
              if ($katilimvardir>=1) {

                ?>

                <li class="list-group-item col-md-6 col-sm-6 col-xs-12">

                  <div><?php echo $katilimderscek['ders_ad']; ?></div>
                  <?php while ($katilimcek = $katilimsor->fetch(PDO::FETCH_ASSOC)) { 


                


                      if ($katilimcek['katilim_durum']==1) {?>


                        <button class="btn btn-xs btn-success" title="<?php echo $katilimcek['katilim_ad'] ?>">+</button>
                      <?php   } else{ ?>

                        <button class="btn btn-xs btn-danger" title="<?php echo $katilimcek['katilim_ad'] ?>">-</button>
                      <?php  } ?>


                  <?php  }

                  ?>
                </li>
              <?php } } ?>
            </ul> 
          </td>
        </tr> 
      </tbody> 

    </table>
  </div>

  


</div>