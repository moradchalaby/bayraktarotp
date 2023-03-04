


<div class="x_panel hidden-xs hidden-sm" >
        <div class="x_title ">
            <h2> Akmescid <small>Genel Grafik</small></h2>
            <ul class="nav navbar-right panel_toolbox">


           
            <li> <button  onclick="window.print();return false;" class="btn btn-md bg-blue gizle ">YAZDIR</button> </li>
               
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>

                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content" id="genelsayfa" width="100%">
   
         
         <input type="text" class="col-md-4 col-md-offset-4 text-center" style="font-size: 24px;" placeholder="Başlık Giriniz...">
        
       
       <br>
 
            <canvas id="genelgrafik" class="hidden-xs"></canvas>
       
       
       
            <table class="table table-bordered table-striped mb-0">
                <thead>
                    <tr>
                        <th><strong>Hoca Genel</strong></th>
                        <?php $adsoyaddata =  HocaSirala(implode(",",$_POST['idm']), $date, $datem); ?>

                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th ><button class="btn btn-xs" style="background-color: #039e79 !important; color: white !important; border: 0.5px solid grey;"><br> </button>Öğrenci Sayısı</th>

                        <?php
                   
                        $ogrencidata = OgrenciSayisi(implode(",",$_POST['idm']), $date, $datem);

                        ?>

                    </tr>

                    <tr>
                        <th ><button class="btn btn-xs" style="background-color: #03586A !important; color: white !important; border: 0.5px solid grey;"><br> </button>Ders Sayısı</th>

                        <?php
                    
                        $dersdata =  DersSayisi(implode(",",$_POST['idm']), $date, $datem);

                        ?>

                    </tr>

                    <tr>
                        <th ><button class="btn btn-xs" style="background-color: #b22c2c !important; color: white !important; border: 0.5px solid grey;"><br> </button>Sayfa Sayısı</th>

                        <?php
                        $sayfadata = SayfaSayisi(implode(",",$_POST['idm']), $date, $datem);
                        ?>
                    </tr>
                    <tr>
                   
                        <th  > <button class="btn btn-xs" style="background-color: #30363d !important; color: white !important; border: 0.5px solid grey;"><br> </button> Saat</th>

                        <?php
                        $saatdata = HocaSaat(implode(",",$_POST['idm']), $date, $datem);
                        ?>
                    </tr>





                </tbody>
            </table>
        </div>
     </div>

<style>
@media print {
  body * {
    visibility: hidden;
  }
  #genelsayfa, #genelsayfa * {
    visibility: visible;
  }
  #genelsayfa {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<script>


    $("#exportButton").click(function() {
        
 	 window.print();return false;
       /* html2canvas($("#genelsayfa"), {
            useCORS: true,
            allowTaint: true,
            letterRendering: true,
            onrendered: function(canvas) {
                var atx = canvas.getContext('2d');
                atx.webkitImageSmoothingEnabled = false;
                atx.mozImageSmoothingEnabled = false;
                atx.imageSmoothingEnabled = false;


                var wdt = $("#genelsayfa").innerWidth();
                var hgt = $("#genelsayfa").innerHeight();

                var dataURL = canvas.toDataURL('image/png');
                var pdf = new jsPDF('l', 'pt', 'a4');

                pdf.addFont('ArialMS', 'Arial', 'bold');
                pdf.setFont('Arial');
                pdf.setFontType("bold");
                pdf.setFontSize(36);
               

                



                pdf.addImage(dataURL, 'JPG', 20, 35, 800, 500,'pdf','FAST');

                pdf.save("download.pdf");




            }
        });


    });*/
</script>