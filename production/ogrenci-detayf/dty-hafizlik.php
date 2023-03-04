 <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
   <br>
   <?php

    $hafizlikdurumsor = $db->prepare("SELECT * from hafizlikdurum  where ogrenci_id=:id ");
    $hafizlikdurumsor->execute(array(
      'id' => $ogrencicek['ogrenci_id']

    ));

    $hafizlikdurumcek = $hafizlikdurumsor->fetch(PDO::FETCH_ASSOC);


    $url = $_SERVER['REQUEST_URI'];
    if ($hafizlikdurumcek['hafizlik_durum'] == 'Yüzüne') { ?>
     <table class="table table-striped jambo_table table-bordered yuzunetab" cellspacing="0">
       <thead>

         <tr>
           <th>Harfler</th>
           <th>Tecvid</th>
           <th>Dua Ve Sureler</th>
           <th>Esas Ezberler</th>
           <th>Önemli uygulamalar</th>
           <th>Tanımlar</th>
         </tr>
       </thead>

       <tbody>

         <td>
           <table class="table table-striped jambo_table table-bordered " width="25%">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Harfler'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>



             </tbody>
           </table>
         </td>
         <td>
           <table class="table table-striped jambo_table table-bordered dt-responsive nowrap" width="25%">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Tecvid'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>



             </tbody>
           </table>
         </td>
         <td>
           <table class="table table-striped jambo_table table-bordered dt-responsive nowrap " width="25%">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Dua Ve Sûreler'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>



             </tbody>
           </table>
         </td>
         <td>
           <table class="table table-striped jambo_table table-bordered dt-responsive nowrap " width="25%">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Esas Ezberler'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>



             </tbody>
           </table>
         </td>
         <td>
           <table class="table table-striped jambo_table table-bordered dt-responsive nowrap col-md-2 cols-sm-2 col-xs-2">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Önemli Uygulamalar'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>




             </tbody>
           </table>
         </td>
         <td>
           <table class="table table-striped jambo_table table-bordered dt-responsive nowrap col-md-2 cols-sm-2 col-xs-2">

             <tbody>
               <?php
                $yuzunesor = $db->prepare("SELECT * FROM yuzune where yuzune_tur2='Tanımlar'");
                $yuzunesor->execute(array());

                while ($yuzunecek = $yuzunesor->fetch(PDO::FETCH_ASSOC)) { ?>
                 <tr>
                   <th><?php echo $yuzunecek['yuzune_ad']; ?></th>
                   <td>
                     <form action="../netting/islem.php" method="POST"> <input type="hidden" name=url value="<?php echo $url; ?>">
                       <input type="hidden" name="ogrenci_id" value="<?php echo $ogrencicek['ogrenci_id']; ?>">
                       <input type="hidden" name="kullanici_id" value="<?php echo $ogrencicek['kullanici_id']; ?>">
                       <input type="hidden" name="yuzune_id" value="<?php echo $yuzunecek['yuzune_id']; ?>">
                       <?php
                        $yuzunederssor = $db->prepare("SELECT * FROM yuzuneders where yuzune_id=:yuzune_id AND ogrenci_id=:ogrenci_id");
                        $yuzunederssor->execute(array(
                          'yuzune_id' => $yuzunecek['yuzune_id'],
                          'ogrenci_id' => $ogrencicek['ogrenci_id']
                        ));
                        $yuzunevar = $yuzunederssor->rowCount();

                        if ($yuzunevar == 1) { ?>
                         <button type="submit" value="0" name="yuzunederssil" class="btn btn-success btn-xs">+</button>
                       <?php } else { ?>
                         <button type="" value="0" name="yuzuneders" class="btn btn-danger btn-xs">-</button>
                       <?php } ?>
                     </form>
                   </td>
                 </tr>
               <?php  }  ?>



             </tbody>
           </table>
         </td>


       </tbody>


     </table>
   <?php } else { ?>
     <?php

      $a = 4;
      $hafta = 0;

      while ($a > 0) {
        $a--;
        $hafta++;

        $date = date('Y-m-d', strtotime(" -$a Saturday ", strtotime(date('Y-m-d'))));
        $datem = date('Y-m-d', strtotime("-1 week", strtotime($date)));
        $datea = date('Y-m-d', strtotime("-4 week", strtotime($date)));
        $tarih1 = date_create($datem);
        $tarih2 = date_create($date);
        $diff = date_diff($tarih2, $tarih1);
        $gun = $diff->format("%a");
        $d = $gun - 1;
        $e = $gun - 1;
        $daytop = 0;
        while ($d >= 0) {
          $hafizlik_trh = date('Y-m-d', strtotime("-$d day", strtotime($date)));


          $hafizliktoplsor = $db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
          $hafizliktoplsor->execute(array(
            'hafizlik_trh' => $hafizlik_trh,
            'ogrenci_id' => $ogrencicek['ogrenci_id']
          ));
          while ($hafizliktoplcek = $hafizliktoplsor->fetch(PDO::FETCH_ASSOC)) {
            $daytop = floatval($daytop) + floatval($hafizliktoplcek['hafizlik_topl']);
          }
          $d--;
        }
      ?>
       <div class="col-md-3 col-sm-3 col-xs-6">

         <table class="table table-striped ">

           <thead>
             <tr>

               <th><?php if ($hafta == 4) {
                      echo 'Bu ';
                    } else {
                      echo $hafta . '.';
                    } ?>Hafta <br><span><?php echo date('d.m.Y', strtotime($datem)) ?> ve <?php echo date('d.m.Y', strtotime($date)) ?> Tarihleri arası</span></th>

             </tr>
           </thead>
           <tbody>
             <tr>

               <?php

                $hafizliksor = $db->prepare("SELECT * from hafizlikdurum INNER JOIN hfzlkyni  ON hafizlikdurum.ogrenci_id = hfzlkyni.ogrenci_id where hafizlikdurum.ogrenci_id=:id ");
                $hafizliksor->execute(array(
                  'id' => $ogrencicek['ogrenci_id']

                ));

                $hafizlikcek = $hafizliksor->fetch(PDO::FETCH_ASSOC); ?>



               <td>
                 <ul class="list-group">

                   <li class="project_progress list-group-item">
                     <div class="progress progress_sm">
                       <?php if (floatval($daytop) >= $gun) { ?>
                         <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                       <?php } elseif (floatval($daytop) >= ($gun - 2)) { ?>
                         <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                       <?php } elseif (floatval($daytop) == ($gun - 3)) { ?>
                         <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                       <?php } else { ?>
                         <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                       <?php  } ?>

                     </div>
                     <small><?php echo floatval($daytop); ?> Ders verildi</small>
                   </li>

                   <?php

                    while ($e >= 0) {

                      $tarh = date('Y-m-d', strtotime("-$e day", strtotime($date)));

                      $hafizlikderssor = $db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                      $varmi = $hafizlikderssor->execute(array(
                        'hafizlik_trh' => $tarh,
                        'ogrenci_id' => $ogrencicek['ogrenci_id']
                      ));

                      $dersarasi = $hafizlikderssor->rowcount();

                      if ($dersarasi == 0) {
                        echo "<li class=\"list-group-item bg-red\"><div>" . $gunler[date('w', strtotime('-' . $e . ' day', strtotime($date)))] . " :</div>Ders Yok</li>";
                      } else { ?>
                       <li class="list-group-item bg-green">

                         <div><?php echo $gunler[date('w', strtotime("-$e day", strtotime($date)))] ?>:</div>

                         <?php $ara = 2;
                          while ($hafizlikderscek = $hafizlikderssor->fetch(PDO::FETCH_ASSOC)) {

                            echo $hafizlikderscek['hafizlik_sayfa'] . '/' . $hafizlikderscek['hafizlik_cuz'];

                            if ($dersarasi >= 2 and $dersarasi >= $ara) {
                              echo ' - ';
                            }
                            $ara++;
                          }    ?>

                       </li>

                   <?php
                      }
                      $e--;
                    } ?>

                 </ul>
               </td>
             </tr>
           </tbody>

         </table>


       </div>

   <?php }
    } ?>



 </div>