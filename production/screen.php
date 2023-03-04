<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
require __DIR__ . '/../lrvl/vendor/autoload.php';
use Spatie\Browsershot\Browsershot;


// an image will be saved
Browsershot::url('https://yuzaki.com')->save("image.png");
?>