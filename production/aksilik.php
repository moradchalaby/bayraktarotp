<?php 


include 'header.php';
if ($kullanicicek['kullanici_yetki']==5 ) {
  $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm");
$ogrencisor->execute(array(

  'kytdrm'=> 1
));
}elseif ($kullanicicek['kullanici_yetki']==4) {
  $birim = $kullanicicek['kullanici_birim'];
  $ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim ");
$ogrencisor->execute(array(

  'kytdrm'=> 1,
  'birim' => $birim
));
}elseif ($kullanicicek['kullanici_yetki']<=3) {

$birim = $kullanicicek['kullanici_birim'];
$sinif = $kullanicicek['kullanici_sinif'];
$ogrencisor=$db->prepare("SELECT * FROM ogrenci where ogrenci_kytdrm=:kytdrm and ogrenci_birim=:birim and ogrenci_sinif=:sinif ");
$ogrencisor->execute(array(

  'kytdrm'=> 1,
  'birim' => $birim,
  'sinif' => $sinif
));
}





?>
<!-- page content -->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>ERROR!!!!!!!!</h3>
      </div>
     
      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="row">
    
      <div class="col-md-12">
      
        <div class="x_panel">
        
          <div class="x_title">
          
            <h2></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
           <div class="alert alert-danger" align="center" role="alert">
          <h1>Hay aksi birşeyler ters gitti!!!!! <br><br><br><br><br> LÜTFEN GELİŞTİRİCİ İLE İRTİBAT KURUNUZ... <br><br><br><br><br><br><br><h1>Error code: <?php echo $_GET['hata'];?></h1></h1>
          <br><br><br><br><br><br><br>

</div>
            

            <!-- formlara eklenecek -->
          

            <?php 
       $url=$_SERVER['REQUEST_URI'];?>
                     

                    <input type="hidden" name=url value="<?php echo $url; ?>">,
              <!-- formlara eklenecek-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

  <?php 
  include 'footer.php';
  ?>