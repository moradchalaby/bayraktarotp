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
           <h2><?php echo $sinifadcek['sinif_ad']." --- ".$dersadcek['ders_ad'] ?> --- Derse Yoklama<small>


             <?php 
             if ($_GET['katilim']=="ok") {?>

               <b style="color:green;">İşlem Başarılı...</b>
               
               
             <?php   }elseif ($_GET['katilim']=="no") {?>

               <b style="color:red;">İşlem Başarısız..</b>
               
               
             <?php } ?> </small>
               
               
               
             </h2>
             <ul class="nav navbar-right panel_toolbox">
              <li> <a href="#"  data-toggle="modal" data-target="#katilimekle" data-whatever=""><button class="btn btn-success btn-xs">Yeni Ders</button></a></li>
              <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
              </li>
              <?php include 'modallar/katilimeklemodal.php' ?>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content <?php if ($_GET['odev'] or $_GET['not']): ?>
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
                        while ($katilimcek=$katilimsor->fetch(PDO::FETCH_ASSOC)) { ?>
                          <th><a href="#"  data-toggle="modal" data-target="#katilimislem<?php echo $katilimcek['katilim_id'] ?>" data-whatever="" style="color: inherit;"><?php echo $katilimcek['katilim_ad'] ?></a></th>

                        <?php include 'modallar/katilimislemmodal.php'; }       ?>


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
                       $katilimdsor=$db->prepare("SELECT * FROM katilimlar where sinif_id=:sinif_id and ders_id=:ders_id order by katilim_id desc");
                       $katilimdsor->execute(array(

                        
                        'sinif_id' => $_GET['sinif'],
                        'ders_id' => $_GET['ders']
                      ));

                       while ($katilimdcek=$katilimdsor->fetch(PDO::FETCH_ASSOC)) { 


                        $katilimdurumsor=$db->prepare("SELECT * FROM katilim_ogrenci where ogrenci_id=:ogrenci_id and katilim_id=:katilim_id order by katilim_id ");
                        $katilimdurumsor->execute(array(

                          'ogrenci_id' => $ogrencicek['ogrenci_id'],
                          'katilim_id' => $katilimdcek['katilim_id']
                        ));
                        while ($katilimdurumcek=$katilimdurumsor->fetch(PDO::FETCH_ASSOC)) {       

                          ?>
                          <?php if ($katilimdurumcek['katilim_durum'] == 0) { ?>
                            <td style="text-align: center;">
                             <form action="../netting/islem.php" method="POST">
                              <input type="hidden" name="katilim_id" value="<?php echo $katilimdurumcek['id']; ?>">
                              <input type="hidden" name="sinif_id" value="<?php echo $_GET['sinif']; ?>">
                              <input type="hidden" name="ders_id" value="<?php echo $_GET['ders']; ?>">
                              <button type="submit" name="katilimdurum" value="1" class="btn btn-danger btn-xs">-</button>

                            </form>
                          </td>

                        <?php  } elseif ($katilimdurumcek['katilim_durum']=="1") { ?> 

                         <td style="text-align: center;">

                          <form action="../netting/islem.php" method="POST">
                            <input type="hidden" name="katilim_id" value="<?php echo $katilimdurumcek['id']; ?>">
                            <input type="hidden" name="sinif_id" value="<?php echo $_GET['sinif']; ?>">
                            <input type="hidden" name="ders_id" value="<?php echo $_GET['ders']; ?>">

                            <button type="submit" value="0" name="katilimdurum" class="btn btn-success btn-xs">+</button>

                          </form>
                        </td>
                      <?php }?>



                          <?php   
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