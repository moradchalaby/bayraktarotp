  <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
           <?php 

           $sinifadsor=$db->prepare("SELECT * FROM sinif where sinif_id=:sinif_id ");
           $sinifadsor->execute(array(

             'sinif_id' => $_GET['sinif']
           ));


           $sinifadcek=$sinifadsor->fetch(PDO::FETCH_ASSOC);
           $dersadsor=$db->prepare("SELECT * FROM ders where ders_id=:ders_id ");
           $dersadsor->execute(array(

             'ders_id' => $_GET['ders']
           )); 
           $dersadcek=$dersadsor->fetch(PDO::FETCH_ASSOC);

           ?>
           <h2><?php echo $sinifadcek['sinif_ad']." --- ".$dersadcek['ders_ad'] ?> --- ÖDEV <small>


             <?php 
             if ($_GET['odev']=="ok") {?>

               <b style="color:green;">İşlem Başarılı...</b>


             <?php   }elseif ($_GET['odev']=="no") {?>

               <b style="color:red;">İşlem Başarısız..</b>


             <?php } ?> </small>



             </h2>
             <ul class="nav navbar-right panel_toolbox">
              <li> <a href="#"  data-toggle="modal" data-target="#odevekle" data-whatever=""><button class="btn btn-success btn-xs">Yeni Ödev</button></a></li>
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              <?php include 'modallar/odeveklemodal.php' ?>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content <?php if ($_GET['not'] or $_GET['katilim']): ?>
          collapse
          <?php endif ?> ">

          <br />
                  <?php // echo $derscek['sinif_id'];  
                  $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_sinif=:ogrenci_sinif and ogrenci_kytdrm=:ogrenci_kytdrm order by ogrenci_adsoyad asc");
                  $ogrencisor->execute(array(

                    'ogrenci_sinif' => $_GET['sinif'],
                    'ogrenci_kytdrm'=>1
                  )); ?>
                 
                    <table id="datatable-responsive" class="table table-striped table-bordered jambo_table dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Resim</th>
                        <th>Ad Soyad</th>
                        <?php 
                        while ($odevcek=$odevsor->fetch(PDO::FETCH_ASSOC)) { ?>
                          <th><a href="#"  data-toggle="modal" data-target="#odevislem<?php echo $odevcek['odev_id'] ?>" data-whatever="" style="color: inherit;"><?php echo $odevcek['odev_baslik'] ?> </a></th>

                        <?php  include 'modallar/odevislemmodal.php'; }       ?>


                      </tr>
                    </thead>
                    <tbody>

                      <?php 

                      while($ogrencicek=$ogrencisor->fetch(PDO::FETCH_ASSOC)){?>

                        <tr>
                         <td >

                          <?php if (strlen($ogrencicek['ogrenci_resim']) > 0){ ?>
                            <img  src="../<?php echo $ogrencicek['ogrenci_resim']; ?>" class="avatar">




                          <?php } else { ?> 
                           <img src="../dimg/logo-yok.png" class="avatar">
                         <?php } ?>
                       </td>
                       <td><?php echo $ogrencicek['ogrenci_adsoyad']; ?></td>

                       <?php 
                       $odevdsor=$db->prepare("SELECT * FROM odevler where sinif_id=:sinif_id and ders_id=:ders_id order by odev_teslim desc");
                       $odevdsor->execute(array(

                        
                        'sinif_id' => $_GET['sinif'],
                        'ders_id' => $_GET['ders']
                      ));

                       while ($odevdcek=$odevdsor->fetch(PDO::FETCH_ASSOC)) { 

                        $odevdurumsor=$db->prepare("SELECT * FROM odev_ogrenci where ogrenci_id=:ogrenci_id and odev_id=:odev_id ");
                        $odevdurumsor->execute(array(

                          'ogrenci_id' => $ogrencicek['ogrenci_id'],
                          'odev_id' => $odevdcek['odev_id']
                        ));
                        while ($odevdurumcek=$odevdurumsor->fetch(PDO::FETCH_ASSOC)) {       

                          ?>


                          <?php if ($odevdurumcek['odev_durum'] == 0) { ?>
                            <td style="text-align: center;">
                             <form action="../netting/islem.php" method="POST">
                              <input type="hidden" name="odev_id" value="<?php echo $odevdurumcek['id']; ?>">
                              <input type="hidden" name="sinif_id" value="<?php echo $_GET['sinif']; ?>">
                              <input type="hidden" name="ders_id" value="<?php echo $_GET['ders']; ?>">
                              <button type="submit" name="odevdurum" value="1" class="btn btn-danger btn-xs">-</button>

                            </form>
                          </td>

                        <?php  } elseif ($odevdurumcek['odev_durum']=="1") { ?> 

                         <td style="text-align: center;">

                          <form action="../netting/islem.php" method="POST">
                            <input type="hidden" name="odev_id" value="<?php echo $odevdurumcek['id']; ?>">
                            <input type="hidden" name="sinif_id" value="<?php echo $_GET['sinif']; ?>">
                            <input type="hidden" name="ders_id" value="<?php echo $_GET['ders']; ?>">

                            <button type="submit" value="0" name="odevdurum" class="btn btn-success btn-xs">+</button>

                          </form>
                        </td>
                      <?php }?>

                      <?php 
                    } }

                    ?>



                  </tr>


                <?php } ?>  


              </tbody>
               
            </table>
          
          </div>

        </div>
      </div>
    </div>