<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

  <br>


    <?php
    $odevpuansor = $db->prepare("SELECT * from odevler 
      INNER JOIN odev_ogrenci ON odev_ogrenci.odev_id=odevler.odev_id
      where odev_ogrenci.ogrenci_id={$_GET['ogrenci_id']} ");
    $odevpuansor->execute(array(  ));

    $tamodev=0;
    while ($odevpuancek = $odevpuansor->fetch(PDO::FETCH_ASSOC)) {
      if ($odevpuancek['odev_durum']==1) {
        $tamodev++;
      }
    }
    $odevpuankac = $odevpuansor->rowcount(); 


    ?>
<h3 align='center'>Genel Ödev Durum</h3>
    <div class="progress progress_md">

      <div class="progress-bar bg-green" role="progressbar" style="width: <?php echo $tamodev * 100 / $odevpuankac; ?>%; " aria-valuenow="<?php echo $tamodev * 100 / $odevpuankac; ?>" aria-valuemin="0" aria-valuemax="100"></div>
      <div class="progress-bar bg-red" role="progressbar" style="width: <?php echo 100 - ($tamodev * 100 / $odevpuankac); ?>%; " aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
    
   
    </div>
  <h1 align="center">Ödev Başarısı: <?php echo '%'.round($tamodev * 100 / $odevpuankac,2); ?><br><?php $eksikodev=$odevpuankac-$tamodev; echo 'Eksik Ödev Sayısı: '.$eksikodev; ?></h1>
   

    
    
      <div class="col-md-12 col-sm-12 col-xs-12">

        <table  class="table table-striped ">

          <thead>



            <tr>

              <th style="text-align: center;"><?php echo $ogrencicek['ogrenci_adsoyad'] ?> <br><span>Ödev Çetelesi</span></th>

            </tr>
          </thead>
          <tbody>
           <tr>
            <td>
             <ul class="list-group">



              <?php
              $odevderssor= $db->prepare("SELECT * from sinif_ders 
                INNER JOIN ders ON sinif_ders.ders_id=ders.ders_id
                INNER JOIN sinif ON sinif_ders.sinif_id=sinif.sinif_id
                where sinif.sinif_id={$ogrencicek['ogrenci_sinif']}");
              $odevderssor->execute(array(  ));
              
              
              while ($odevderscek = $odevderssor->fetch(PDO::FETCH_ASSOC)) { 
				
                 

                $odevsor = $db->prepare("SELECT * from odevler INNER JOIN odev_ogrenci ON odev_ogrenci.odev_id=odevler.odev_id
                  where odevler.ders_id={$odevderscek['ders_id']} and odevler.sinif_id={$odevderscek['sinif_id']} and odev_ogrenci.ogrenci_id={$_GET['ogrenci_id']} order by odevler.odev_teslim desc ");
                $odevsor->execute(array(  ));
	$odevvardir=$odevsor->rowCount();
              if ($odevvardir>=1) { 
                                   
                                
                ?>

                <li class="list-group-item col-md-6 col-sm-6 col-xs-12">

                  <h2><?php echo $odevderscek['ders_ad']; ?></h2>
                  <?php 

                  $yapilan=0;
				
                  while ($odevcek = $odevsor->fetch(PDO::FETCH_ASSOC)) { 

						
							                  
                


                      if ($odevcek['odev_durum']==1) {
                        $yapilan++;?>

                        <button class="btn btn-xs btn-success" title="<?php echo $odevcek['odev_baslik'] ?>">+</button>
                      <?php   } else{ ?>

                        <button class="btn btn-xs btn-danger" title="<?php echo $odevcek['odev_baslik'] ?>">-</button>
                      <?php  } ?>


                  <?php  }
$odevkac= $odevsor->rowcount();
              
              if ($odevkac<=22) { 
  				for ($i=0; $i < 23 ; $i++) { 
                              # code...
                                    
              echo '<button class="btn btn-xs " style="opacity:0;" >-</button>';
              }     }
                  ?>
                   <div class="progress progress_sm">

      <div class="progress-bar bg-green" role="progressbar" style="width: <?php echo $yapilan * 100 / $odevkac; ?>%" aria-valuenow="<?php echo $yapilan * 100 / $odevkac; ?>" aria-valuemin="0" aria-valuemax="100"></div>
      <div class="progress-bar bg-red" role="progressbar" style="width: <?php echo 100 - ($yapilan * 100 / $odevkac); ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>



    </div>
     
<h5>Ödev Başarısı: <?php echo '%'.round($yapilan * 100 / $odevkac,2); ?></h5>
<h5><?php $eksikodev=$odevkac-$yapilan; echo 'Eksik Ödev Sayısı: '.$eksikodev; ?></h5>
                </li>
             <?php } } ?>
            </ul> 
          </td>
        </tr> 
      </tbody> 

    </table>
  </div>

  


</div>
