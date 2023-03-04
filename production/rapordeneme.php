<div class="title_right">
  <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

  </div>
</div>
</div>



<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Haftalık Rapor</h2>
        <?php if ($yetkiler==4) {?>
        <form action="#" method="GET" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left gizle">
         <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hoca<span class="required">*</span>
        </label>
        <div class="col-md-5 col-sm-7 col-xs-12" style="text-align:center">
         <?php 
         $kullanicisor=$db->prepare("SELECT * from kullanici where (kullanici_yetki=:yetki3 or kullanici_yetki=:yetki4) and kullanici_durum=:durum and kullanici_birim=:birim order by kullanici_adsoyad asc");

         $kullanicisor->execute(array(
          'yetki3' => 3,
          'yetki4' => 4,
          'birim' => $kulbirim,
          'durum' => 1
            ));// kullanicileri bulup seç

            ?>
            <style type="text/css">

             select {

              text-align: center;
              text-align-last: center;
              /* webkit*/
            }
            option {
              font-size: 20px;
              text-align-last: center;
              /* reset to left*/
            }
          </style>
          <select class="select2_multiple form-control"  name="hoca" >
           <option value="" selected>Seçiniz</option>
           <?php 
       $birimdesor=$db->prepare("SELECT * from kullanici where kullanici_birim=:birim order by kullanici_adsoyad asc");
       $birimdesor->execute(array(
           'birim'=> $birimler));

           while ($birimdecek=$birimdesor->fetch(PDO::FETCH_ASSOC)) {
                $kullanici_id=$birimdecek['kullanici_id'];// kullanicileri sırala

                ?>

                <option value="<?php echo $birimdecek['kullanici_id']; ?>"><?php echo $birimdecek['kullanici_adsoyad']; ?></option>
              <?php } ?>


            </select>
          </div>
        </div>
         <div class="form-group">
         <div class="col-md-6 col-sm-6 col-xs-12 col-sm-offset-3 col-md-offset-3" >

          <button type="submit" name="tablo" class="btn btn-success center">Göster</button>
        </div>
       
       </div>
        </form>
        <?php } ?>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <p><span>*</span>Ders eklemek için öğrencinin ismine tıklayınız.</p>
        <p><span>*</span>Hafızlık durum değişimi için hafızlık durumuna tıklayınız.</p>

        <!-- start project list -->
        <table  class="table table-striped projects raportab">
          <thead>
            <tr>
              <th style="width: 1%">#</th>
              <th style="width: 20%">Ad Soyad</th>
              <th>Durum</th>
              <?php
              $date = date('Y-m-d');
              $datem = date('Y-m-d', strtotime("last Saturday"));
              $tarih1 = date_create($datem);
              $tarih2 = date_create($date);
              $diff = date_diff($tarih2, $tarih1);
              $gun = $diff->format("%a"); 
              $guns = $gun-1;
              while ($guns >= 0) { ?>

               <td class="hidden-xs"><?php echo $gunler[date('w', strtotime("-$guns day", strtotime($date)))]; ?></td>
               <?php   $guns--;
             }
             ?>
             

             <th>Hafta Başarısı</th>
             <!--th class="hidden">Başarı Durumu</th-->
             <th  class="gizle">İşlemler</th>
           </tr>
         </thead>


         <tbody>

          <?php
          $say==1;
          while ($ogrencicek = $ogrencisor->fetch(PDO::FETCH_ASSOC)) {


            $hafizliksor = $db->prepare("SELECT * from hafizlikdurum INNER JOIN hfzlkyni  ON hafizlikdurum.ogrenci_id = hfzlkyni.ogrenci_id where hafizlikdurum.ogrenci_id=:id ");
            $hafizliksor->execute(array(
              'id' => $ogrencicek['ogrenci_id']

            ));

            $hafizlikcek = $hafizliksor->fetch(PDO::FETCH_ASSOC);
            
             $hafizlikdurumsor = $db->prepare("SELECT * from hafizlikdurum  where ogrenci_id=:id ");
            $hafizlikdurumsor->execute(array(
              'id' => $ogrencicek['ogrenci_id']

            ));

            $hafizlikdurumcek = $hafizlikdurumsor->fetch(PDO::FETCH_ASSOC);




            $tarih1 = date_create($datem);
            $tarih2 = date_create($date);
            $diff = date_diff($tarih2, $tarih1);
            $gun = $diff->format("%a");
            $d = $gun - 1;
            $e = $gun - 1;
            $daytop = 0;
            while ($d >= 0) {
              $hafizlik_trh=date('Y-m-d',strtotime("-$d day",strtotime($date)));


              $hafizliktoplsor=$db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
              $hafizliktoplsor->execute(array(
                'hafizlik_trh'=>$hafizlik_trh,
                'ogrenci_id'=>$ogrencicek['ogrenci_id']));
              while ($hafizliktoplcek=$hafizliktoplsor->fetch(PDO::FETCH_ASSOC)) { 
                $daytop = floatval($daytop)+floatval($hafizliktoplcek['hafizlik_topl']);
              }
              $d--;
            } ?>

            <tr>
              <td><?php echo $say; $say++ ?></td>
              <td>
                <a href="#" data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id']; ?>dersekle" data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $ogrencicek['ogrenci_adsoyad']; ?></a>
              
              </td>


              <td><a href="#" data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id']; ?>hafizlikdurum" data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $hafizlikdurumcek['hafizlik_durum']; ?></a></td>
              <?php
              $ara=2;
              while ($e >= 0) {

                 $tarh = date('Y-m-d', strtotime("-$e day", strtotime($date)));/*
                $day = explode("_", $hafizlikcek[date('d_m_Y', strtotime("-$e day", strtotime($date)))]);
               
                $hoca = explode("&", $day[2]);
                $kullanicisor = $db->prepare("SELECT * FROM kullanici where kullanici_id IN (" . implode(',', $hoca) . ") ORDER BY FIELD(kullanici_id, " . implode(',', $hoca) . ")");
                $kullanicisor->execute(array());*/

                $hafizlikderssor=$db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                $varmi= $hafizlikderssor->execute(array(
                  'hafizlik_trh'=>$tarh,
                  'ogrenci_id'=>$ogrencicek['ogrenci_id']));

                $dersarasi=$hafizlikderssor->rowcount();

                ?>

                <td class="hidden-xs">



                  <?php 
                   if ($dersarasi==0) {
                      echo '---';
                    }


                  while ($hafizlikderscek=$hafizlikderssor->fetch(PDO::FETCH_ASSOC)) { ?>



                    <a href="#" data-toggle="modal" data-target="#<?php echo $hafizlikderscek['hafizlik_id']; ?>hocagoster" data-whatever="<?php echo $tarh; ?>"><?php echo $hafizlikderscek['hafizlik_sayfa'].'/'.$hafizlikderscek['hafizlik_cuz']; ?></a>

                    <?php if ($dersarasi>=2) {
                      echo '<br>';
                    } 
                    $ara++;
                   

                  }  
                  ?>

                </td>

                <?php
              $hafizlikmodalsor=$db->prepare("SELECT * from hfzlkyni where hafizlik_trh=:hafizlik_trh and ogrenci_id=:ogrenci_id");
                            $hafizlikmodalsor->execute(array(
                              'hafizlik_trh'=>$tarh,
                              'ogrenci_id'=>$ogrencicek['ogrenci_id']));
                          while	($hafizlikdersmodal=$hafizlikmodalsor->fetch(PDO::FETCH_ASSOC)) {
                          
                          include 'modallar/hocagostermodal.php';
                         
                          
                          }
                include 'modallar/hfzlk-durum-modal.php';
                $e--;
              } ?>


              <td class="project_progress">
                <div class="progress progress_sm">
                  <?php if (floatval($daytop) >= $gun) { ?>
                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                  <?php }elseif (floatval($daytop) >= ($gun - 2)) { ?>
                    <div class="progress-bar bg-blue" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                  <?php } elseif (floatval($daytop) == ($gun - 3)) { ?>
                    <div class="progress-bar bg-orange" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                  <?php } else { ?>
                    <div class="progress-bar bg-red" role="progressbar" data-transitiongoal="<?php echo floatval($daytop) * 100 / 7; ?>"></div>
                  <?php  } ?>

                </div>
                <small><?php echo floatval($daytop); ?> Ders verildi</small>
              </td>
              <!--td class="hidden">
                <?php if (floatval($daytop) >= $gun) { ?>
                  <button type="button" class="btn bg-green btn-xs">PEKİYİ</button>
                <?php } elseif (floatval($daytop) >= ($gun - 2)) { ?>
                  <button type="button" class="btn bg-blue btn-xs">İYİ</button>
                <?php } elseif (floatval($daytop) == ($gun - 3)) { ?>
                  <button type="button" class="btn bg-orange btn-xs">ORTA</button>
                <?php } else { ?>
                  <button type="button" class="btn btn-danger btn-xs">ZAYIF</button>
                <?php } ?>
              </td-->
              <td class="gizle">
                <a href="ogrenci-detay.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Bilgi </a>
                     </td>

                   
                    </tr>
                    <?php



                    include 'modallar/derseklemodal.php';
                   


                  } ?>


                </tbody>
              </table>
              <!-- end project list -->

            </div>
          </div>
        </div>

  <!-- /page content -->