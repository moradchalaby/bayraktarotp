<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
//Bu fonksiyon türkçe karakterleri bozmadan ingilizve karakterlere dönüştürüyor

function seo($str, $options = array())
{
    $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


$gunler = array(

    0 => "Pazar",

    1 => "Pazartesi",

    2 => "Salı",

    3 => "Çarşamba",

    4 => "Perşembe",

    5 => "Cuma",

    6 => "Cumartesi"

);
$aylar = array(

    1 => "Ocak",

    2 => "Şubat",

    3 => "Mart",

    4 => "Nisan",

    5 => "Mayıs",

    6 => "Haziran",

    7 => "Temmuz",

    8 => "Ağustos",

    9 => "Eylül",
    10 => "Ekim",

    11 => "Kasım",

    12 => "Aralık"



);



function DersSayisi($tur, $date, $datem)
{


    $tarih1 = date_create($datem);
    $tarih2 = date_create($date);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");



    global $db;


    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_durum=:durum and kullanici_yetki>=3 and kullanici_id IN($tur)");
    $kullanicisor->execute(array(
        'durum' => 1
    ));


    while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {


        $m = 1 - $gun;
        $daytop = 0;
        while ($m <= 0) {
            $day = date('Y-m-d', strtotime("$m day", strtotime($date)));

            $hraporsor = $db->prepare("SELECT * from hrapor where kullanici_id=:id");
            $hraporsor->execute(array(
                'id' => $kullanicicek['kullanici_id']
            ));
            while ($hraporcek = $hraporsor->fetch(PDO::FETCH_ASSOC)) {
                if ($hraporcek['hrapor_tarih'] == $day) {
                    $daytop = $daytop + $hraporcek['hrapor_ders'];
                }
            }
            $m++;
        }
        $dersdata[] = round($daytop / $gun, 2);
        echo "<td>" . round($daytop / $gun, 2) . "</td>";
    }
    return $dersdata;
}

function SayfaSayisi($tur, $date, $datem)
{

    $tarih1 = date_create($datem);
    $tarih2 = date_create($date);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");



    global $db;

    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_durum=:durum and kullanici_id IN($tur)");
    $kullanicisor->execute(array(
        'durum' => 1
    ));

    while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {


        $m = 1 - $gun;
        $daytop = 0;
        while ($m <= 0) {
            $day = date('Y-m-d', strtotime("$m day", strtotime($date)));

            $hraporsor = $db->prepare("SELECT * from hrapor where kullanici_id=:id");
            $hraporsor->execute(array(
                'id' => $kullanicicek['kullanici_id']
            ));
            while ($hraporcek = $hraporsor->fetch(PDO::FETCH_ASSOC)) {
                if ($hraporcek['hrapor_tarih'] == $day) {
                    $daytop = $daytop + $hraporcek['hrapor_sayfa'];
                }
            }
            $m++;
        }
        $sayfadata[] = round($daytop / $gun, 2);
        echo "<td>" . round($daytop / $gun, 2) . "</td>";
    }
    return $sayfadata;
}

function HocaSaat($tur, $date, $datem)
{

    $tarih1 = date_create($datem);
    $tarih2 = date_create($date);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");



    global $db;

    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_durum=:durum and kullanici_id IN($tur)");
    $kullanicisor->execute(array(
        'durum' => 1
    ));

    while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {



        $m = 1 - $gun;
        $daytop = 0;
        while ($m <= 0) {
            $day = date('Y-m-d', strtotime("$m day", strtotime($date)));

            $hraporsor = $db->prepare("SELECT * from hrapor where kullanici_id=:id");
            $hraporsor->execute(array(
                'id' => $kullanicicek['kullanici_id']
            ));
            while ($hraporcek = $hraporsor->fetch(PDO::FETCH_ASSOC)) {
                if ($hraporcek['hrapor_tarih'] == $day) {
                    $daytop = $daytop + $hraporcek['hrapor_sayfa'];
                }
            }
            $m++;
        }


        $saatdata[] = round($daytop * 1.5 / 60 / $gun, 2);
        echo "<td>" . round($daytop * 1.5 / 60 / $gun, 2) . "</td>";
    }


    return $saatdata;
}

function OgrenciSayisi($tur, $date, $datem)
{

    $tarih1 = date_create($datem);
    $tarih2 = date_create($date);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");
    global $db;
    $daytop = 0;
    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_durum=:durum and kullanici_id IN($tur)");
    $kullanicisor->execute(array(
        'durum' => 1
    ));

    while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {

        $hraporsor = $db->prepare("SELECT COUNT(*) from ogrenci where kullanici_id=:id and ogrenci_kytdrm=1 ");
        $hraporsor->execute(array(
            'id' => $kullanicicek['kullanici_id']
        ));
        $daytop = $hraporsor->fetchColumn();
        $ogrencidata[] = $daytop;
        echo "<td>" . $daytop . "</td>";
    }
    return $ogrencidata;
}
function HocaSirala($tur, $date, $datem)
{

    $tarih1 = date_create($datem);
    $tarih2 = date_create($date);
    $diff = date_diff($tarih2, $tarih1);
    $gun = $diff->format("%a");
    global $db;

    $kullanicisor = $db->prepare("SELECT * from kullanici where kullanici_durum=:durum and kullanici_id IN($tur)");
    $hocavar = $kullanicisor->execute(array(
        'durum' => 1
    ));

    while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {
        if ($hocavar) {
            $adsoyad[] = $kullanicicek['kullanici_adsoyad'];
            echo "<th>" . $kullanicicek['kullanici_adsoyad'] . "</th>";
        }
    }
    return $adsoyad;
}
