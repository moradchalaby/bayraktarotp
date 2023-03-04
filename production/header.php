 <?php


    ob_start();
    session_start(); //$_SESSION kullanımı için
    include '../netting/baglan.php';
    include 'fonksiyon.php';


    //BELİRLİ VERİYİ SEÇME İŞLEMİ
    //AYARLAR 
    $ayarsor = $db->prepare("SELECT * from ayar where ayar_id=:id");
    $ayarsor->execute(array(
        'id' => 0
    ));

    $ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);



    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array(
        'mail' => $_SESSION['kullanici_mail']
    ));

    $say = $kullanicisor->rowCount();

    $kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
    $yetkiler = $kullanicicek['kullanici_yetki'];
    $birimler = $kullanicicek['kullanici_birim'];
    if ($say == 0) {

        header("Location:login.php?durum=izinsiz");
        exit;
    }
    /*1. yöntem
.ok güçlü değil
if (!isset($_SESSION['kullanici_mail'])) {



}*/

    ?>
 <!DOCTYPE html>
 <html lang="tr">

 <head>

     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

     <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-9" />
     <meta http-equiv="Content-Type" content="text/html; charset=windows-1254" />
     <!-- Meta, title, CSS, favicons, etc. -->
     <meta charset="utf-8">
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1">


     <title>ÖZEL AZİZ BAYRAKTAR ERKEK ÖĞRENCİ YURDU</title>



     <!-- Bootstrap -->
     <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="icon" type="image/png" href="../dimg/headlogo.png">
     <!--link rel="shortcut icon" href="../dimg/asd.ico" /-->
     <!-- Dropzone.js -->
     <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">


     <!-- surukle -->


     <!-- Font Awesome -->
     <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     <!-- NProgress -->
     <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
     <!-- iCheck -->
     <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

     <!-- FullCalendar -->
     <link href="js/fullcalendar.css" rel="stylesheet">
     <!-- <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
      -->
     <!-- Datatables -->
     <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
     <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
     <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
     <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
     <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/css/smart_wizard_all.min.css" rel="stylesheet"
         type="text/css" />
     <!-- Custom Theme Style -->
     <link href="../build/css/custom.css" rel="stylesheet">


     <link rel="stylesheet" href="css/calstyle.css">

     <!-- CK Editör -->
     <script src="js/ckeditor/ckeditor.js"></script>


     <link rel="stylesheet" href="css/colorPick.css">
     <!-- The following line applies the dark theme -->
     <link rel="stylesheet" href="css/colorPick.dark.theme.css">
     <style>
     .picker {
         border-radius: 5px;
         width: 36px;
         height: 36px;
         cursor: pointer;
         -webkit-transition: all linear .2s;
         -moz-transition: all linear .2s;
         -ms-transition: all linear .2s;
         -o-transition: all linear .2s;
         transition: all linear .2s;
         border: thin solid #eee;
     }



     .picker:hover {
         transform: scale(1.1);
     }
     </style>
 </head>

 <body class="nav-md">
     <div class="container body">
         <div class="main_container">
             <div class="col-md-3 left_col gizle">
                 <div class="left_col scroll-view gizle">
                     <div class="navbar nav_title" align="center" style="border: 0;">
                         <a href="index" class="site_title"><img src="../dimg/logoakm.png" width="75%"></a>
                     </div>

                     <div class="clearfix"></div>

                     <!-- menu profile quick info -->
                     <div class="profile clearfix">
                         <div class="profile_pic">
                             <?php if (strlen($kullanicicek['kullanici_resim']) > 0) { ?>
                             <img src="../<?php echo $kullanicicek['kullanici_resim']; ?>" alt="..."
                                 class="img-circle profile_img">




                             <?php } else { ?>
                             <img src="../dimg/logo-yok.png" class="img-circle profile_img">
                             <?php } ?>

                         </div>
                         <div class="profile_info">
                             <span>HOŞGELDİN,</span>
                             <h2><?php echo $kullanicicek['kullanici_adsoyad']; ?></h2>
                         </div>
                     </div>
                     <!-- /menu profile quick info -->

                     <br />

                     <!-- sidebar menu -->
                     <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">


                         <div class="menu_section">
                             <hr>
                             <ul class="nav side-menu">
                                 <li><a href="index.php"><i class="fa fa-home"></i> AnaSayfa</a></li>
                                 <li><a href="takvim.php"><i class="fa fa-calendar"></i> Takvim</a></li>
                                 <!-- GENEL -->
                                 <?php if ($kullanicicek['kullanici_yetki'] == 5) : ?>
                                 <li><a><i class="fa fa-pencil-square"></i>Eğitim <span
                                             class="fa fa-chevron-down"></span></a>
                                     <ul class="nav child_menu">
                                         <li><a href="ogrenci-ekle.php">Yeni Kayıt</a></li>
                                         <li><a href="ogrenci.php">Öğrenci Lİstesi</a></li>
                                         <li><a href="ogrenci-ayrilan.php">Ayrılan Öğrenci Lİstesi</a></li>
                                         <li><a href="sinif-duzenle.php">Sınıflar</a></li>
                                         <li><a href="ogrencihfzlk.php">Öğrenci Hafızlık Lİstesi</a></li>

                                     </ul>
                                 </li>

                                 <li><a><i class="fa fa-cogs"></i>Personeller <span
                                             class="fa fa-chevron-down"></span></a>

                                     <ul class="nav child_menu">
                                         <li><a href="kullanici.php">Tüm Personel Listesi</a></li>
                                         <li><a href="hoca.php">Hafızlık Hocaları</a></li>
                                         <li><a href="idare.php">Birim Hocaları</a></li>

                                     </ul>

                                 </li>
                                 <li><a href="muhasebe.php"><i class="fa fa-calculator"></i> Muhasebe</a></li>
                                 <?php include 'derssayfalar.php' ?>
                                 <?php endif ?>


                                 <!-- Birim Sorumlusu -->
                                 <?php if ($kullanicicek['kullanici_yetki'] == 4) : ?>
                                 <li><a href="ogrencihfzlk"><i class="fa fa-list"></i>Öğrenci Hafızlık Lİstesi</a></li>

                                 <li><a href="ogrenci"><i class="fa fa-list"></i>Birimdeki Öğrenciler</a></li>
                                 <li><a href="sinif-duzenle"><i class="fa fa-list"></i>Sınıflar</a></li>

                                 <?php if ($kullanicicek['kullanici_birim'] == 3) : ?>


                                 <li><a href="ihtisasders"><i class="fa fa-pencil-square"></i> Ders-Hoca-Sınıf</a></li>
                                 <?php include 'sinifsayfalar.php'; ?>
                             </ul>
                             </li>
                             <?php endif ?>
                             <?php include 'derssayfalar.php'; ?>
                             <?php endif ?>




                             <!-- SINIF HOCASI -->
                             <?php if ($kullanicicek['kullanici_yetki'] <= 3) : ?>
                             <li><a href="ogrencihfzlk.php"><i class="fa fa-list"></i>Öğrenci Hafızlık Lİstesi</a></li>
                             <!--****************************************************************-->
                             <?php include 'derssayfalar.php' ?>
                             <?php endif ?>









                         </div>

                     </div>
                     <!-- /sidebar menu -->

                     <!-- /menu footer buttons -->
                     <div class="sidebar-footer hidden-small">
                         <a data-toggle="tooltip" data-placement="top" title="Settings">
                             <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                         </a>
                         <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullScreen();">
                             <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                         </a>
                         <a data-toggle="tooltip" data-placement="top" title="Lock">
                             <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                         </a>
                         <a href="logout.php" data-toggle="tooltip" data-placement="top" title="Logout">
                             <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                         </a>
                     </div>
                     <!-- /menu footer buttons -->
                 </div>
             </div>

             <!-- top navigation -->
             <div class="top_nav gizle">
                 <div class="nav_menu">
                     <nav>
                         <div class="nav toggle gizle">
                             <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                         </div>

                         <ul class="nav navbar-nav navbar-right gizle">
                             <li class="">
                                 <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                     aria-expanded="false">
                                     <?php if (strlen($kullanicicek['kullanici_resim']) > 0) { ?>
                                     <img src="../<?php echo $kullanicicek['kullanici_resim']; ?>" alt="...">




                                     <?php } else { ?>
                                     <img src="../dimg/logo-yok.png">
                                     <?php } ?><?php echo $kullanicicek['kullanici_adsoyad']; ?>
                                     <span class=" fa fa-angle-down"></span>
                                 </a>
                                 <ul class="dropdown-menu dropdown-usermenu pull-right">



                                     <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Güvenli
                                             Çıkış</a></li>
                                 </ul>
                             </li>


                         </ul>
                     </nav>
                 </div>
             </div>
             <!-- /top navigation -->