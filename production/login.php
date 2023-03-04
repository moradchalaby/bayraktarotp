<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ÖZEL AZİZ BAYRAKTAR ERKEK ÖĞRENCİ YURDU</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
   <link rel="icon" type="image/png" href="../dimg/headlogo.png">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    
<style type="text/css" media="screen">
html{overflow-x:hidden;overflow-y:auto;}
html,body,#preloader{height:100%;}
body > #preloader{height:auto;min-height:100%;}
body{margin:0px; padding:0px;}
#preloader{filter:alpha(opacity=90);-moz-opacity:.90;opacity:.90;position:absolute; left:0px; background:#000;z-index:99; top:0px; width:100%; height:100%;line-height:600px;color:#fff; text-align:center;}
#yukleniyor{width:75%;height:75%;}

</style>
<script type="text/javascript" language="javascript">
function is_loaded() { //DOM
if (document.getElementById){
setTimeout("document.getElementById('preloader').style.visibility='hidden'",2000);
}else{
if (document.layers){ //NS4
setTimeout("document.preloader.visibility = 'hidden'",2000);
}
else { //IE4
setTimeout("document.all.preloader.style.visibility = 'hidden'",2000);
}
}
}
</script>
  </head>

  <body  onload="is_loaded(); myMove();" class="login">
 
<div id="preloader" > <center> <div id="yukleniyor"><img  src="../dimg/logoakm.png" width="100%"></div></center> </div>
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div  class="login_wrapper">
        <div  class="animate form login_form">
          <section   class="login_content">

            <form  action="../netting/islem.php" method="POST">


              <img  src="../dimg/logoakm.png" width="100%">
              <br>
              <br>
                <?php if (!empty($_GET['durum']) and $_GET['durum']=="izinsiz") {?>

                  <div class="alert alert-danger alert-dismissible fade in lgn" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Lütfen!</strong> Tekrar giriş yapınız...
                  </div>
               
              <?php } elseif (!empty($_GET['durum']) and $_GET['durum']=="loginbasarisiz")  {?> 

                <div class="alert alert-danger alert-dismissible fade in lgn" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>Lütfen!</strong> Giriş bilgilerinizi kontrol ediniz...
                  </div>
                
              <?php } ?>
              <div>
                
                <input type="text" name="kullanici_mail" class="form-control" placeholder="Kullanıcı Adınız (Mail)" required="" />
              </div>
              <div>
                <input type="password" name="kullanici_password" class="form-control" placeholder="Şifreniz" required="" />
              </div>
              <div align="center">
                <button class="btn btn-default" type="submit" name="kullanicigiris">Giriş Yap</button><!--br><span>veya </span-->
                
              </div>
              <!--a class="btn btn-default" href="register.php">KAYIT OL</a-->
              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"></div>
                <br />

                <div>
                
                  <p>©2020 <br> ÖZEL AZİZ BAYRAKTAR ERKEK ÖĞRENCİ YURDU</p>
                </div>
              </div>
            </form>
          </section>

          <script>
function myMove() {
  var elem = document.getElementById("yukleniyor");   
  var pos = 100;
  var id = setInterval(frame, 5);
  var hareket = "opacity";
  function frame() {
    if (pos == 0) {
      clearInterval(id);
    } else {
     pos = pos-0.3; 
      elem.style.opacity = pos + "%"; 
      
    }
  }
}


</script>
        </div>

      </div>
    </div>
  </body>
</html>
