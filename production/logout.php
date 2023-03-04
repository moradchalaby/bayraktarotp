<?php 


session_start();

session_destroy();//session silme işlemi yapar

header("Location:login.php?durum=exit")
 ?>