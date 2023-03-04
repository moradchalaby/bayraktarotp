                           <?php 



                           $derslerimsor=$db->prepare("SELECT *
                            FROM sinif_ders
                            INNER JOIN sinif ON sinif_ders.sinif_id = sinif.sinif_id
                            INNER JOIN ders ON sinif_ders.ders_id = ders.ders_id
                            INNER JOIN kullanici ON sinif_ders.hoca_id = kullanici.kullanici_id
                            where sinif_ders.hoca_id =:hoca_id order by sinif_ders.ders_id" );
                           $derslerimsor->execute(array(
                            'hoca_id' => $kullanicicek['kullanici_id']

                          )); 


                           $dersvarmi = $derslerimsor->rowCount();
                           ?>


                           <?php if ($dersvarmi>0): ?>


                            <li><a><i class="fa fa-pencil-square"></i>Derslerim<span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">

                                <?php 


                                $ulli=0;
                                while ($derslerimcek=$derslerimsor->fetch(PDO::FETCH_ASSOC)) {




                                  if ($ders_id==$derslerimcek['ders_id']) { 




                                    ?>

                                    <li><a href="ihtisashoca.php?ders=<?php echo $derslerimcek['ders_id']; ?>&sinif=<?php echo $derslerimcek['sinif_id']; ?>"><?php echo $derslerimcek['sinif_ad']  ?></a></li>



                                  <?php    } else {   

                                   ?>
                                   <?php if ($ulli>=1): ?>
                                   </ul></li>
                                   <?php

                                 endif ?>

                                 <li><a><?php echo $derslerimcek['ders_ad']; ?><span class="fa fa-chevron-down"></span></a>

                                  <ul class="nav child_menu">

                                    <li><a href="ihtisashoca.php?ders=<?php echo $derslerimcek['ders_id']; ?>&sinif=<?php echo $derslerimcek['sinif_id']; ?>"><?php echo $derslerimcek['sinif_ad']  ?></a></li>

                                  <?php }

                                  $ulli++;

                                  $ders_id=$derslerimcek['ders_id'];

                                }  ?>  


                              </ul>
                            </li>




                            <?php endif ?>