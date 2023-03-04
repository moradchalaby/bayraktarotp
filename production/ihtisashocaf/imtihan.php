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
           <h2><?php echo $sinifadcek['sinif_ad']." --- ".$dersadcek['ders_ad'] ?> --- İMTİHAN<small>


             <?php 
             if ($_GET['not']=="ok") {?>

               <b style="color:green;">İşlem Başarılı...</b>
               
               
             <?php   }elseif ($_GET['not']=="no") {?>

               <b style="color:red;">İşlem Başarısız..</b>
               
               
             <?php } ?> </small>
               
               
               
             </h2>
             <ul class="nav navbar-right panel_toolbox">
              <li> <a href="#"  data-toggle="modal" data-target="#sinavekle" data-whatever=""><button class="btn btn-success btn-xs">Yeni İmtihan</button></a></li>
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              <?php include 'modallar/sinaveklemodal.php' ?>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content <?php if ($_GET['odev'] or $_GET['katilim']): ?>
          collapse
          <?php endif ?>">

          <br />
                  <?php // echo $derscek['sinif_id'];  
                  $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_sinif=:ogrenci_sinif and ogrenci_kytdrm=:ogrenci_kytdrm");
                  $ogrencisor->execute(array(

                    'ogrenci_sinif' => $_GET['sinif'],
                    'ogrenci_kytdrm'=>1
                  )); ?>
                  <table id="datatable-responsive" class="table responsive table-striped jambo_table table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr>
                        <th>Resim</th>
                        <th>Ad Soyad</th>
                        <?php 
                        while ($sinavcek=$sinavsor->fetch(PDO::FETCH_ASSOC)) { ?>
                          <th><a href="#"  data-toggle="modal" data-target="#sinavislem<?php echo $sinavcek['sinav_id'] ?>" data-whatever="" style="color: inherit;"><?php echo $sinavcek['sinav_ad'] ?></a></th>

                        <?php include 'modallar/sinavislemmodal.php'; }       ?>


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
                       $sinavdsor=$db->prepare("SELECT * FROM sinavlar where sinif_id=:sinif_id and ders_id=:ders_id order by sinav_id desc");
                       $sinavdsor->execute(array(

                       
                        'sinif_id' => $_GET['sinif'],
                        'ders_id' => $_GET['ders']
                      ));

                       while ($sinavdcek=$sinavdsor->fetch(PDO::FETCH_ASSOC)) { 


                        $sinavnotsor=$db->prepare("SELECT * FROM sinav_ogrenci where ogrenci_id=:ogrenci_id and sinav_id=:sinav_id order by sinav_id ");
                        $sinavnotsor->execute(array(

                          'ogrenci_id' => $ogrencicek['ogrenci_id'],
                          'sinav_id' => $sinavdcek['sinav_id']
                        ));
                        while ($sinavnotcek=$sinavnotsor->fetch(PDO::FETCH_ASSOC)) {       

                          ?>
                          <td><a href="#"  data-toggle="modal" data-target="#notgir<?php echo $sinavdcek['sinav_id'].$ogrencicek['ogrenci_id']; ?>" data-whatever="" ><?php echo $sinavnotcek['sinav_not']; ?></a></td>




                          <?php   include 'modallar/notgirmodal.php';    
                        }    ;  


                      }


                      ?>



                    </tr>


                  <?php } ?>  


                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>