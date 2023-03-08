      <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
          <br>


          <?php
        $sinavpuansor = $db->prepare("SELECT * from sinavlar 
          INNER JOIN sinav_ogrenci ON sinav_ogrenci.sinav_id=sinavlar.sinav_id
          where sinav_ogrenci.ogrenci_id={$_GET['ogrenci_id']} ");
        $sinavpuansor->execute(array(  ));

        $tamsinav=0;
        while ($sinavpuancek = $sinavpuansor->fetch(PDO::FETCH_ASSOC)) {
          if ($sinavpuancek['sinav_not']!= 'Not Girilmedi') {
                        $tamsinav=$tamsinav+$sinavpuancek['sinav_not'];
                      }
        }
        $sinavpuankac = $sinavpuansor->rowcount(); 


        ?>
          <h3 align='center'>Genel Not</h3>

          <div class="progress progress_md">

              <div class="progress-bar bg-green" role="progressbar"
                  style="width: <?php echo $tamsinav / $sinavpuankac ;  ?>%"
                  aria-valuenow="<?php echo $tamsinav / $sinavpuankac ; ?>" aria-valuemin="0" aria-valuemax="100">
                  %<?php echo $tamsinav / $sinavpuankac ;  ?></div>





          </div>
          <h1 align="center">Genel Ortalama notu: <?php echo '%'.round($tamsinav / $sinavpuankac,2); ?></h1>



          <div class="col-md-12 col-sm-12 col-xs-12">

              <table class="table table-striped ">

                  <thead>



                      <tr>

                          <th style="text-align: center;"><?php echo $ogrencicek['ogrenci_adsoyad'] ?> <br><span>İmtihan
                                  Çetelesi</span></th>

                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>
                              <ul class="list-group">


                                  <?php
                $sinavderssor= $db->prepare("SELECT * from sinif_ders 
                  INNER JOIN ders ON sinif_ders.ders_id=ders.ders_id
                  INNER JOIN sinif ON sinif_ders.sinif_id=sinif.sinif_id
                  where sinif.sinif_id={$ogrencicek['ogrenci_sinif']}");
                $sinavderssor->execute(array(  ));



                ?>


                                  <?php 
                while ($sinavderscek = $sinavderssor->fetch(PDO::FETCH_ASSOC)) { 


                  $sinavsor = $db->prepare("SELECT * from sinavlar INNER JOIN sinav_ogrenci ON sinav_ogrenci.sinav_id=sinavlar.sinav_id
                    where sinavlar.ders_id={$sinavderscek['ders_id']} and sinavlar.sinif_id={$sinavderscek['sinif_id']} and sinav_ogrenci.ogrenci_id={$_GET['ogrenci_id']} ");
                  $sinavsor->execute(array(  ));
                
                $sinavvardir=$sinavsor->rowCount();
                if ($sinavvardir>=1) {

                  ?>

                                  <li class="list-group-item col-md-6 col-sm-6 col-xs-12">

                                      <div><?php echo $sinavderscek['ders_ad']; ?></div>

                                      <?php 
                    $ort=0;
                    $sinavsay=0;

                    while ($sinavcek = $sinavsor->fetch(PDO::FETCH_ASSOC)) { 
                      $sinavsay++;


                      if ($sinavcek['sinav_not']!= 'Not Girilmedi') {
                        $ort=$ort+$sinavcek['sinav_not'];
                      }

                      if ($sinavcek['sinav_not']>=60) {



                        ?>


                                      <button class="btn btn-xs btn-success"
                                          title="<?php echo $sinavcek['sinav_ad'] ?>"><?php echo $sinavcek['sinav_not'] ?></button>
                                      <?php   } elseif ($sinavcek['sinav_not']=='Not Girilmedi') { ?>

                                      <button class="btn btn-xs btn-danger"
                                          title="<?php echo $sinavcek['sinav_ad'] ?>">---</button>
                                      <?php        } else{ 


                        ?>

                                      <button class="btn btn-xs btn-danger"
                                          title="<?php echo $sinavcek['sinav_ad'] ?>"><?php echo $sinavcek['sinav_not'] ?>
                                          <?php  } ?>


                                          <?php  } ?>

                                          <br>
                                          <button class="btn btn-xl btn-info" title="ORTALAMA">Ortalama: <?php $ortalama=round($ort/$sinavsay,2);
                    if ($ortalama==Null) {
                        echo 'İmtihan Yok.';
                    } else {
                        echo $ortalama;
                    }
                    
                    ?></button>
                                  </li>
                                  <?php } } ?>

                              </ul>
                          </td>
                      </tr>
                  </tbody>

              </table>
          </div>


      </div>