

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
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <p>Ders eklemek için öğrencinin ismine tıklayınız.</p>

            <!-- start project list -->
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th style="width: 20%">Ad Soyad</th>
                  <th>Son 7 Gün</th>
                  <th>1 Haftalık Başarı</th>
                  <th>Status</th>
                  <th style="width: 20%">İşlemler</th>
                </tr>
              </thead>


              <tbody>

               <?php 
               $date= date('Y-m-d');
               while($ogrencicek=$ogrencisor->fetch(PDO::FETCH_ASSOC)) { 


                $hafizliksor=$db->prepare("SELECT * from hafizlik where hafizlik_id=:id");
                $hafizliksor->execute(array(
                  'id'=> $ogrencicek['ogrenci_id']

                ));       

                while($hafizlikcek=$hafizliksor->fetch(PDO::FETCH_ASSOC)){

                  ?>
                  <?php 

                  $daytop=0;
                  $d= 6;
                  $e= 6;

                  while ($d >= 0) {

                    $day = explode("_",$hafizlikcek[date('d_m_Y',strtotime("-$d day",strtotime($date)))]);
                    $daytop= floatval($daytop)+floatval($day[1]);
                    $d--; } ?> 

                    <tr>
                      <td>#</td>
                      <td>
                        <a href="#"  data-toggle="modal" data-target="#<?php echo $ogrencicek['ogrenci_id'] ?>" data-whatever="<?php echo $ogrencicek['ogrenci_adsoyad']; ?>"><?php echo $ogrencicek['ogrenci_adsoyad']; ?></a>
                        <br />
                        <small>Created 01.01.2015</small>
                      </td>
                      <td>
                        <ul class="list-inline">
                          <li><?php echo $hafizlikcek['hafizlik_durum']; ?></li>
                         <?php 

                         while ($e >= 0) {
                          $day = explode("_",$hafizlikcek[date('d_m_Y',strtotime("-$e day",strtotime($date)))]);

                          ?>

                          <li><?php echo $day[0]; ?></li>

                          <?php $e--; } ?> 
                          
                        </ul>
                      </td>
                      <td class="project_progress">
                        <div class="progress progress_sm">
                          <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="<?php echo floatval($daytop)*100/7; ?>"></div>
                        </div>
                        <small><?php echo floatval($daytop); ?> Ders verildi</small>
                      </td>
                      <td>
                        <?php if (floatval($daytop)>=7) { ?>
                          <button type="button" class="btn btn-success btn-xs">Başarılı</button>
                        <?php } elseif (floatval($daytop)>5){ ?>
                        <button type="button" class="btn btn-normal btn-xs">Orta</button>
                        <?php } elseif (floatval($daytop)>4){ ?>
                          <button type="button" class="btn btn-danger btn-xs">Başarısız</button>
                        <?php } ?>
                      </td>
                      <td>
                        <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                        <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                        <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                      </td>
                    </tr>
                    <?php include 'derseklemodal.php'; } } ?>
                
                </tbody>
              </table>
              <!-- end project list -->

            </div>
          </div>
        </div>
 
  <!-- /page content -->

