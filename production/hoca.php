

<?php 
include '../netting/baglan.php';


include 'header.php';
//BELİRLİ VERİYİ SEÇME İŞLEMİ

//tüm kullanıcılar için kullanici
$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_yetki=:yetki");
$kullanicisor->execute(array(
'yetki'=> 3));
 ?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kullanıcı Listeleri <small>


              <?php 
              if ($_GET['sil']=="ok") {?>

               <b style="color:green;">Kayıt Silindi</b>


             <?php   }elseif ($_GET['sil']=="no") {?>

              <b style="color:red;">İşlem Başarısız..</b>


            <?php }
            ?>
          </small>

        </h2>
        <ul class="nav navbar-right panel_toolbox">
          <li> <a href="kullanici-ekle"><button class="btn btn-success btn-xs">Yeni Ekle</button></a></li>
          
          
          
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <p class="text-muted font-13 m-b-30">
          Responsive is an extension for DataTables that resolves that problem by optimising the table's layout for different screen sizes through the dynamic insertion and removal of columns from the table.
        </p>
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Kayıt Tarihi</th>
              <th>Ad Soyad</th>
              <th>Mail Adresi</th>
              <th>telefon</th>
              
              <th></th><!--button için boş bırakıldı yoksa kaymalar olr.-->
              <th></th>
            </tr>
          </thead>
          <tbody>

            <?php 

            while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)){?>

              <tr>
                <td><?php echo $kullanicicek['kullanici_zaman']; ?></td>
                <td><?php echo $kullanicicek['kullanici_adsoyad']; ?></td>
                <td><?php echo $kullanicicek['kullanici_mail']; ?></td>
                <td><?php echo $kullanicicek['kullanici_gsm']; ?></td>
                <td style="width:1px;"><a href="kullanici-duzenle-<?php echo $kullanicicek['kullanici_id'] ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></td>
                

                <td style="width:1px;"><a href="../netting/islem.php?kullanici_id=<?php echo $kullanicicek['kullanici_id'] ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></td>


              </tr>


            <?php } ?>  

            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


</div>
</div>
</div>
<!-- /page content -->
<?php include 'footer.php'; ?>

</body>
</html>
