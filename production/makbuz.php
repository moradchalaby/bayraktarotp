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
$makbuzsor = $db->prepare("SELECT * from makbuz where makbuz_id=:id");
$makbuzsor->execute(array(
    'id' => $_GET['makbuz_id']
));

$makbuzcek = $makbuzsor->fetch(PDO::FETCH_ASSOC);




function sayiyiYaziyaCevir($sayi, $kurusbasamak = 2, $parabirimi, $parakurus, $diyez, $bb1, $bb2, $bb3)
{
    // kurusbasamak virgülden sonra gösterilecek basamak sayısı
    // parabirimi = TL gibi , parakurus = Kuruş gibi
    // diyez başa ve sona kapatma işareti atar # gibi
    if ($parabirimi == '₺') {
        $parabirimi = 'TÜRK LİRASI';
        $parakurus = 'KURUŞ';
    } elseif ($parabirimi == '$') {
        $parabirimi = 'DOLAR';
        $parakurus = 'CENT';
    } elseif ($parabirimi == '€') {
        $parabirimi = 'EURO';
        $parakurus = 'CENT';
    }
    $b1 = array("", "Bir ", "İki ", "Üç ", "Dört ", "Beş ", "Altı ", "Yedi ", "Sekiz ", "Dokuz ");
    $b2 = array("", "On ", "Yirmi ", "Otuz ", "Kırk ", "Elli ", "Altmış ", "Yetmiş ", "Seksen ", "Doksan ");
    $b3 = array("", "Yüz ", "Bin ", "Milyon ", "Milyar ", "Trilyon ", "Katrilyon ");

    if ($bb1 != null) { // farklı dil kullanımı yada farklı yazım biçimi için
        $b1 = $bb1;
    }
    if ($bb2 != null) { // farklı dil kullanımı
        $b2 = $bb2;
    }
    if ($bb3 != null) { // farklı dil kullanımı
        $b3 = $bb3;
    }

    $say1 = "";
    $say2 = ""; // say1 virgül öncesi, say2 kuruş bölümü
    $sonuc = "";

    $sayi = str_replace(",", ".", $sayi); //virgül noktaya çevrilir

    $nokta = strpos($sayi, "."); // nokta indeksi

    if ($nokta > 0) { // nokta varsa (kuruş)

        $say1 = substr($sayi, 0, $nokta); // virgül öncesi
        $say2 = substr($sayi, $nokta, strlen($sayi)); // virgül sonrası, kuruş

    } else {
        $say1 = $sayi; // kuruş yoksa
    }

    $son = '';
    $w = 1; // işlenen basamak
    $sonaekle = 0; // binler on binler yüzbinler vs. için sona bin (milyon,trilyon...) eklenecek mi?
    $kac = strlen($say1); // kaç rakam var?
    $sonint = ''; // işlenen basamağın rakamsal değeri
    $uclubasamak = 0; // hangi basamakta (birler onlar yüzler gibi)
    $artan = 0; // binler milyonlar milyarlar gibi artışları yapar
    $gecici = '';

    if ($kac > 0) { // virgül öncesinde rakam var mı?

        for ($i = 0; $i < $kac; $i++) {

            $son = $say1[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(

            if ($w == 1) { // birinci basamak bulunuyor

                $sonuc = $b1[$sonint] . $sonuc;
            } else if ($w == 2) { // ikinci basamak

                $sonuc = $b2[$sonint] . $sonuc;
            } else if ($w == 3) { // 3. basamak

                if ($sonint == 1) {
                    $sonuc = $b3[1] . $sonuc;
                } else if ($sonint > 1) {
                    $sonuc = $b1[$sonint] . $b3[1] . $sonuc;
                }
                $uclubasamak++;
            }

            if ($w > 3) { // 3. basamaktan sonraki işlemler

                if ($uclubasamak == 1) {

                    if ($sonint > 0) {
                        $sonuc = $b1[$sonint] . $b3[2 + $artan] . $sonuc;
                        if ($artan == 0) { // birbin yazmasını engelle
                            $sonuc = str_replace($b1[1] . $b3[2], $b3[2], $sonuc);
                        }
                        $sonaekle = 1; // sona bin eklendi
                    } else {
                        $sonaekle = 0;
                    }
                    $uclubasamak++;
                } else if ($uclubasamak == 2) {

                    if ($sonint > 0) {
                        if ($sonaekle > 0) {
                            $sonuc = $b2[$sonint] . $sonuc;
                            $sonaekle++;
                        } else {
                            $sonuc = $b2[$sonint] . $b3[2 + $artan] . $sonuc;
                            $sonaekle++;
                        }
                    }
                    $uclubasamak++;
                } else if ($uclubasamak == 3) {

                    if ($sonint > 0) {
                        if ($sonint == 1) {
                            $gecici = $b3[1];
                        } else {
                            $gecici = $b1[$sonint] . $b3[1];
                        }
                        if ($sonaekle == 0) {
                            $gecici = $gecici . $b3[2 + $artan];
                        }
                        $sonuc = $gecici . $sonuc;
                    }
                    $uclubasamak = 1;
                    $artan++;
                }
            }

            $w++; // işlenen basamak

        }
    } // if(kac>0)

    if ($sonuc == "") { // virgül öncesi sayı yoksa para birimi yazma
        $parabirimi = "";
    }

    $say2 = str_replace(".", "", $say2);
    $kurus = "";

    if ($say2 != "") { // kuruş hanesi varsa

        if ($kurusbasamak > 3) { // 3 basamakla sınırlı
            $kurusbasamak = 3;
        }
        $kacc = strlen($say2);
        if ($kacc == 1) { // 2 en az
            $say2 = $say2 . "0"; // kuruşta tek basamak varsa sona sıfır ekler.
            $kurusbasamak = 2;
        }
        if (strlen($say2) > $kurusbasamak) { // belirlenen basamak kadar rakam yazılır
            $say2 = substr($say2, 0, $kurusbasamak);
        }

        $kac = strlen($say2); // kaç rakam var?
        $w = 1;

        for ($i = 0; $i < $kac; $i++) { // kuruş hesabı

            $son = $say2[$kac - 1 - $i]; // son karakterden başlayarak çözümleme yapılır.
            $sonint = $son; // işlenen rakam Integer.parseInt(

            if ($w == 1) { // birinci basamak

                if ($kurusbasamak > 0) {
                    $kurus = $b1[$sonint] . $kurus;
                }
            } else if ($w == 2) { // ikinci basamak
                if ($kurusbasamak > 1) {
                    $kurus = $b2[$sonint] . $kurus;
                }
            } else if ($w == 3) { // 3. basamak
                if ($kurusbasamak > 2) {
                    if ($sonint == 1) { // 'biryüz' ü engeller
                        $kurus = $b3[1] . $kurus;
                    } else if ($sonint > 1) {
                        $kurus = $b1[$sonint] . $b3[1] . $kurus;
                    }
                }
            }
            $w++;
        }
        if ($kurus == "") { // virgül öncesi sayı yoksa para birimi yazma
            $parakurus = "";
        } else {
            $kurus = $kurus . " ";
        }
        $kurus = $kurus . $parakurus; // kuruş hanesine 'kuruş' kelimesi ekler
    }

    $sonuc = $diyez . $sonuc . " " . $parabirimi . " " . $kurus . $diyez;
    return $sonuc;
}

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
    span {
        font-style: oblique;
        font-weight: bold;
    }

    @media print {

        .no-print,
        .no-print * {
            display: none !important;
        }
    }
    </style>
</head>

<body>




    <table id="datatable-responsive" class="table table-striped jambo_table table-bordered dt-responsive nowrap"
        cellspacing="0" width="100%">

        <tbody>
            <tr style="height: 18px;">
                <td style="width: 27.9867%; height: 36px; text-align: center; border-collapse: collapse; border-style: inset;"
                    colspan="2" rowspan="2">AZİZ BAYRAKTAR ORTA ÖĞRETİM <br> ERKEK ÖĞRENCİ YURDU <br><br> Tel no: 0216
                    532 44 44</td>
                <td style="width: 52.3137%; height: 18px;font-size: 30px; text-align: center; border-collapse: collapse; border-style: inset;"
                    colspan="3" rowspan="2">TAHSİLAT MAKBUZU</td>
                <td
                    style="width: 18.4205%; height: 18px; text-align: center; border-collapse: collapse; border-style: inset;">
                    MAKBUZ NO<br />
                    <span><?php echo $makbuzcek['makbuz_id']; ?></span>
                </td>

            </tr>
            <tr style="height: 18px; text-align: center;">

                <td style="width: 18.4205%; height: 18px; text-align: center; border-collapse: collapse; border-style: inset;"
                    TARİH<br />
                <span><?php echo $makbuzcek['makbuz_tarih']; ?></span>
                </td>
            </tr>
            <tr style="height: 18px; text-align: center;">
                <td style="width: 62.6228%; height: 18px; text-align: left; border-collapse: collapse; border-style: inset;"
                    colspan="6">ÖDEME YAPAN: <span>
                        <?php echo $makbuzcek['makbuz_adsoyad']; ?></span>
                </td>

            </tr>
            <tr>
                <td style="width: 62.6228%; text-align: left; border-collapse: collapse; border-style: inset;"
                    colspan="6">TUTAR: <span>
                        <?php echo $makbuzcek['makbuz_tutar'] . $makbuzcek['makbuz_kur'] . '  (' . sayiyiYaziyaCevir($makbuzcek['makbuz_tutar'], 0, $makbuzcek['makbuz_kur'], null, "", null, null, null) . ')'; ?>
                    </span>
                </td>

            </tr>
            <tr style="height: 18px; text-align: center;">
                <td style="height: 18px; text-align: left; border-collapse: collapse; border-style: inset; width: 62.6228%;"
                    colspan="4">ÖDEME ŞEKLİ: <span><?php echo $makbuzcek['makbuz_odeme_sekli']; ?></span>
                </td>
                <td style="border-collapse: collapse;   vertical-align: top; border-style: inset; height: 104.333px; width: 36.0981%;"
                    colspan="2" rowspan="2">TAHSİLAT YAPAN <br>
                    <span><?php echo $makbuzcek['kullanici_adsoyad']; ?></span>
                </td>
            </tr>
            <tr style="height: 18px; text-align: center;">
                <td style="height: 68.3333px; vertical-align: top; text-align: left; border-collapse: collapse; border-style: inset; width: 62.6228%;"
                    colspan="4">AÇIKLAMA: <span>
                        <?php echo $makbuzcek['makbuz_aciklama']; ?></span>
                </td>
            </tr>
        </tbody>
    </table>
    <a onclick="print();" class="no-print btn btn-primary">YAZDIR</a>




    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- surukle -->
    <!-- jquery kütüphanelerimizi ekliyoruz -->

    <!-- Mobil cihazlar ve tabletlerde sürükle bıark özelliğini aktif ediyoruz-->

    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Dropzone.js -->
    <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- input -->
    <script src="../vendors/jquery/dist/jquery-ui.min.js"></script>
    <!-- jquery kütüphanelerimizi ekliyoruz -->
    <script src="../vendors/jquery/dist/jquery.ui.touch-punch.min.js"></script>

    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.js"></script>

    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js">
    </script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <script src="../vendors/moment/moment.js"></script>
    <script src="../vendors/fullcalendar/dist/fullcalendar.js"></script>
    <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript">
    </script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script src="js/colorPick.js"></script>
    <script src="../vendors/fullcalendar/dist/lang/tr.js"></script>
    <script src="../vendors/moment/locale/tr.js"></script>










</body>

</html>