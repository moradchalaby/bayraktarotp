 <div role="tabpanel" class="tab-pane fade" id="aidat" aria-labelledby="profile-tab" <br>

     <?php

        $aidatsor = $db->prepare("SELECT * from aidat  where ogrenci_id=:id ");
        $aidatsor->execute(array(
            'id' => $ogrencicek['ogrenci_id']

        ));
        $aidatcek = $aidatsor->fetch(PDO::FETCH_ASSOC);

        $makbuzsor = $db->prepare("SELECT * FROM makbuz ORDER BY makbuz_id DESC LIMIT 1;");
        $makbuzsor->execute(array());
        $makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);
        ?>
     <div class="col-md col-sm col-xs ">

         <table class="table table-striped ">

             <thead>
                 <tr>

                     <th><a href="#" data-toggle="modal" class="btn btn-success"
                             data-target=" #<?php echo $ogrencicek['ogrenci_id'] ?>aidatekle"
                             data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>">Yeni Aidat</a>

                         <?php
                            include 'modallar/aidateklemodal.php'; ?>
                     </th>

                 </tr>
             </thead>

             <div id="smartwizard">
                 <ul class="nav">
                     <li>
                         <a class="nav-link " href="#step-1">
                             2022
                         </a>
                     </li>
                     <li>
                         <a class="nav-link " href="#step-2">
                             2023
                         </a>
                     </li>
                     <li>
                         <a class="nav-link " href="#step-3">
                             2024
                         </a>
                     </li>

                 </ul>
                 <div class="tab-content">
                     <div id="step-1" class="tab-pane" role="tabpanel">
                         <?php
                            $startDate = strtotime(date('Y-01') . ' -1 year');
                            $endDate   = strtotime(date('Y-12') . ' -1 year');

                            $currentDate = $startDate;

                            while ($currentDate <= $endDate) {


                                $aidatdurumsor = $db->prepare("SELECT * from aidat where ogrenci_id=:ogrenci_id and aidat_ay=:aidat_ay");
                                $aidatdurumsor->execute(array(

                                    'ogrenci_id' => $ogrencicek['ogrenci_id'],
                                    'aidat_ay' => date('Y-m', $currentDate),
                                ));
                                $aidatdurumcek = $aidatdurumsor->fetch(PDO::FETCH_ASSOC);

                                $aidatkulsor = $db->prepare("SELECT * from kullanici where kullanici_id=:kullanici_id");
                                $aidatkulsor->execute(array(

                                    'kullanici_id' => $aidatdurumcek['kullanici_id'],

                                ));
                                $aidatkulcek = $aidatkulsor->fetch(PDO::FETCH_ASSOC);
                                $varmi = $aidatdurumsor->rowcount();
                                /*   echo $varmi;
                                    echo '<br>';
                                    echo $tarih;
                                    echo '<br>';
                                    echo $aidatdurumcek['ogrenci_id'];
                                    echo '<br>'; */
                                if ($varmi == 0) {

                            ?>
                         <li class="list-group-item bg-red border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day green"><?php echo $aylar[date('n', $currentDate)]; ?></p>
                                     <p class="month green"> <?php echo date('Y', $currentDate); ?></p>
                                 </a>
                                 <a class="btn pull-right col-sm border ">
                                     <p class="day">0 ₺</p>

                                 </a>
                                 <div class="media-body ">
                                     <a class="title black" href="#">ÖDEME YOK</a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                 </div>
                             </article>
                         </li>
                         <!--    <li class="list-group-item bg-red">

                                 <div><?php echo $aylar[$ay] . '   ' . $yil; ?>:</div>


                             </li> -->


                         <?php
                                } else {
                                ?>
                         <li class="list-group-item bg-green border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day red"><?php echo $aylar[date('n', $currentDate)]; ?></p>
                                     <p class="month red"> <?php echo date('Y', $currentDate) ?></p>
                                 </a>
                                 <div class=" pull-right">
                                     <a class="btn btn-primary btn-xs" target="_blank" rel="noopener noreferrer"
                                         href="./makbuz.php?makbuz_id=<?php echo $aidatdurumcek['aidat_makbuz'] ?>"><i
                                             class="fa fa-file-text-o"></i></a>
                                     <a href="#" data-toggle="modal" class="btn btn-danger btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatsil"
                                         data-whatever=""><i class="fa fa-trash"></i>
                                     </a>
                                     <a href="#" data-toggle="modal" class="btn btn-warning btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatduzenle"
                                         data-whatever=""><i class="fa fa-pencil"></i>
                                     </a>
                                     <p class="date text-center"><?php echo $aidatdurumcek['aidat_tutar']; ?> ₺</p>



                                 </div>
                                 <div class="media-body ">
                                     <a class="title primary"
                                         href="#"><?php echo $aidatkulcek['kullanici_adsoyad']; ?></a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                     <p><?php echo $aidatdurumcek['aidat_odeme_sekli']; ?></p>
                                 </div>
                             </article>
                         </li>

                         <?php
                                }
                                include('modallar/aidatduzenlemodal.php');
                                include('modallar/aidatsilmodal.php');
                                $currentDate = strtotime(date('Y-m-01', $currentDate) . ' +1 month');
                            }
                            ?>
                     </div>
                     <div id="step-2" class="tab-pane" role="tabpanel">
                         <?php
                            $startDate = strtotime(date('Y-01'));
                            $endDate   = strtotime(date('Y-12'));

                            $currentDate = $startDate;
                            while ($currentDate <= $endDate) {


                                $aidatdurumsor = $db->prepare("SELECT * from aidat where ogrenci_id=:ogrenci_id and aidat_ay=:aidat_ay");
                                $aidatdurumsor->execute(array(

                                    'ogrenci_id' => $ogrencicek['ogrenci_id'],
                                    'aidat_ay' => date('Y-m', $currentDate),
                                ));
                                $aidatdurumcek = $aidatdurumsor->fetch(PDO::FETCH_ASSOC);

                                $aidatkulsor = $db->prepare("SELECT * from kullanici where kullanici_id=:kullanici_id");
                                $aidatkulsor->execute(array(

                                    'kullanici_id' => $aidatdurumcek['kullanici_id'],

                                ));
                                $aidatkulcek = $aidatkulsor->fetch(PDO::FETCH_ASSOC);
                                $varmi = $aidatdurumsor->rowcount();
                                /*   echo $varmi;
                                    echo '<br>';
                                    echo $tarih;
                                    echo '<br>';
                                    echo $aidatdurumcek['ogrenci_id'];
                                    echo '<br>'; */
                                if ($varmi == 0) {

                            ?>
                         <li class="list-group-item bg-red border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day green"><?php echo $aylar[date('n', $currentDate)]; ?></p>
                                     <p class="month green"> <?php echo date('Y', $currentDate); ?></p>
                                 </a>
                                 <a class="btn pull-right col-sm border ">
                                     <p class="day">0 ₺</p>

                                 </a>
                                 <div class="media-body ">
                                     <a class="title black" href="#">ÖDEME YOK</a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                 </div>
                             </article>
                         </li>
                         <!--    <li class="list-group-item bg-red">

                                 <div><?php echo $aylar[$ay] . '   ' . $yil; ?>:</div>


                             </li> -->


                         <?php
                                } else {
                                ?>
                         <li class="list-group-item bg-green border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day red"><?php echo $aylar[date('n', $currentDate)]; ?></p>
                                     <p class="month red"> <?php echo date('Y', $currentDate) ?></p>

                                 </a>


                                 <div class=" pull-right">
                                     <a class="btn btn-primary btn-xs" target="_blank" rel="noopener noreferrer"
                                         href="./makbuz.php?makbuz_id=<?php echo $aidatdurumcek['aidat_makbuz'] ?>"><i
                                             class="fa fa-file-text-o"></i></a>
                                     <a href="#" data-toggle="modal" class="btn btn-warning btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatduzenle"
                                         data-whatever=""><i class="fa fa-pencil"></i>
                                     </a>
                                     <a href="#" data-toggle="modal" class="btn btn-danger btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatsil"
                                         data-whatever=""><i class="fa fa-trash "></i></a>

                                     <p class="date text-center"><?php echo $aidatdurumcek['aidat_tutar']; ?> ₺</p>



                                 </div>
                                 <div class="media-body ">
                                     <a class="title primary"
                                         href="#"><?php echo $aidatkulcek['kullanici_adsoyad']; ?></a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                     <p><?php echo $aidatdurumcek['aidat_odeme_sekli']; ?></p>
                                 </div>
                             </article>
                         </li>

                         <?php
                                }
                                include('modallar/aidatduzenlemodal.php');
                                include('modallar/aidatsilmodal.php');
                                $currentDate = strtotime(date('Y-m-01', $currentDate) . ' +1 month');
                            }

                            ?>
                     </div>
                     <div id="step-3" class="tab-pane" role="tabpanel">
                         <?php
                            $startDate = strtotime(date('Y-01') . ' +1 year');
                            $endDate   = strtotime(date('Y-12') . ' +1 year');

                            $currentDate = $startDate;
                            while ($currentDate <= $endDate) {


                                $aidatdurumsor = $db->prepare("SELECT * from aidat where ogrenci_id=:ogrenci_id and aidat_ay=:aidat_ay");
                                $aidatdurumsor->execute(array(

                                    'ogrenci_id' => $ogrencicek['ogrenci_id'],
                                    'aidat_ay' => date('Y-m', $currentDate),
                                ));
                                $aidatdurumcek = $aidatdurumsor->fetch(PDO::FETCH_ASSOC);

                                $aidatkulsor = $db->prepare("SELECT * from kullanici where kullanici_id=:kullanici_id");
                                $aidatkulsor->execute(array(

                                    'kullanici_id' => $aidatdurumcek['kullanici_id'],

                                ));
                                $aidatkulcek = $aidatkulsor->fetch(PDO::FETCH_ASSOC);
                                $varmi = $aidatdurumsor->rowcount();
                                /*   echo $varmi;
                                    echo '<br>';
                                    echo $tarih;
                                    echo '<br>';
                                    echo $aidatdurumcek['ogrenci_id'];
                                    echo '<br>'; */
                                if ($varmi == 0) {

                            ?>
                         <li class="list-group-item bg-red border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day green"><?php echo $aylar[date('n', $currentDate)]; ?></p>
                                     <p class="month green"> <?php echo date('Y', $currentDate); ?></p>

                                 </a>
                                 <a class="btn pull-right col-sm border ">
                                     <p class="day">0 ₺</p>

                                 </a>
                                 <div class="media-body ">
                                     <a class="title black" href="#">ÖDEME YOK</a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                 </div>
                             </article>
                         </li>
                         <!--    <li class="list-group-item bg-red">

                                 <div><?php echo $aylar[$ay] . '   ' . $yil; ?>:</div>


                             </li> -->


                         <?php
                                } else {
                                ?>
                         <li class="list-group-item bg-green border">
                             <article class="media event">
                                 <a class="pull-left  bg-primary  date">
                                     <p class="day red"><?php echo $aylar[date('m', $currentDate)]; ?></p>
                                     <p class="month red"> <?php echo date('Y', $currentDate) ?></p>

                                 </a>
                                 <div class=" pull-right">
                                     <a class="btn btn-primary btn-xs" target="_blank" rel="noopener noreferrer"
                                         href="./makbuz.php?makbuz_id=<?php echo $aidatdurumcek['aidat_makbuz'] ?>"><i
                                             class="fa fa-file-text-o"></i></a>
                                     <a href="#" data-toggle="modal" class="btn btn-warning btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatduzenle"
                                         data-whatever=""><i class="fa fa-pencil"></i>
                                     </a>
                                     <a href="#" data-toggle="modal" class="btn btn-danger btn-xs"
                                         data-target=" #<?php echo $aidatdurumcek['aidat_id'] ?>aidatsil"
                                         data-whatever=""><i class="fa fa-trash "></i></a>

                                     <p class="date text-center"><?php echo $aidatdurumcek['aidat_tutar']; ?> ₺</p>



                                 </div>
                                 <div class="media-body ">
                                     <a class="title primary"
                                         href="#"><?php echo $aidatkulcek['kullanici_adsoyad']; ?></a>
                                     <p><?php echo $aidatdurumcek['aidat_tarih']; ?></p>
                                     <p><?php echo $aidatdurumcek['aidat_odeme_sekli']; ?></p>
                                 </div>
                             </article>
                         </li>

                         <?php
                                }
                                include('modallar/aidatduzenlemodal.php');
                                include('modallar/aidatsilmodal.php');
                                $currentDate = strtotime(date('Y-m-01', $currentDate) . ' +1 month');
                            }

                            ?>
                     </div>
                 </div>
             </div>

         </table>


     </div>


     <?php

        if (isset($_GET['makbuz_no'])) {

        ?>


     <script type="text/javascript">
     var myWindow = window.open('../production/makbuz?makbuz_id=<?php echo $_GET['makbuz_no']; ?>', '',
         'width=1920,height=1080')
     </script>

     <?php } ?>

 </div>