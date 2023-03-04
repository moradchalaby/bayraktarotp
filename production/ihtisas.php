<!-- İhtisas -->
<div id="Progress_ihtisas" class="Progress_Status">
    <div id="ihtisasprogress" class="myprogressBar" align="center">
        <h1>İhtisas Grafik Hazırlanıyor...</h1>
    </div>
    <div id="ihtisasindir" align="center">
        <h1>İhtisas Grafik İndirildi</h1>
    </div>
</div>
<script>
    $("#Progress_ihtisas").hide();
    $("#ihtisasindir").hide();
</script>

<div class="row">

    <!-- Hafızlık Hocası -->
    <div class=" col-md-12 col-sm-12 col-xs-12" id="ihtisassayfa">
        <div class="x_panel">
            <div class="x_title">
                <h2>Akmescid <small>İhtisas Grafik</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><button id="ihtisasButton" type="button" class="btn btn-warning btn-xs">PDF <span>indir</span></button></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <canvas id="ihtisasgrafik" width="400" height="100" aria-label="Hello ARIA World"></canvas>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><strong>İhtisas Hoca</strong></th>
                            <?php

                            $ihtisas = "'İhtisas'";
                            $adsoyaddata =  HocaSirala($ihtisas); ?>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th style="background-color:#26B99A ; color: white; ">Öğrenci Sayısı</th>

                            <?php
                            $ogrencidata = OgrenciSayisi($ihtisas);

                            ?>

                        </tr>

                        <tr>
                            <th style="background-color:#03586A ; color: white; ">Ders Sayısı</th>

                            <?php
                            $dersdata =  DersSayisi($ihtisas);

                            ?>

                        </tr>

                        <tr>
                            <th style="background-color:#b48484 ; color: white; ">Sayfa Sayısı</th>

                            <?php
                            $sayfadata = SayfaSayisi($ihtisas);
                            ?>
                        </tr>
                        <tr>
                            <th style="background-color:#5b6773 ; color: white; ">Saat</th>

                            <?php
                            $saatdata = HocaSaat($ihtisas);
                            ?>
                        </tr>





                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $("#ihtisasButton").click(function() {
            var element = document.getElementById("ihtisasprogress");
            var width = 1;
            $("#Progress_ihtisas").toggle(1000);
            html2canvas($("#ihtisassayfa"), {

                useCORS: true,
                allowTaint: true,
                letterRendering: true,
                onrendered: function(canvas) {
                    var atx = canvas.getContext('2d');
                    atx.webkitImageSmoothingEnabled = false;
                    atx.mozImageSmoothingEnabled = false;
                    atx.imageSmoothingEnabled = false;

                    var wdt = $("#ihtisassayfa").width();
                    var hgt = $("#ihtisassayfa").height();

                    var dataURL = canvas.toDataURL('image/png');
                    var pdf = new jsPDF('l', 'pt', [wdt * 2, hgt * 2]);

                    pdf.addFont('ArialMS', 'Arial', 'bold');
                    pdf.setFont('Arial');
                    pdf.setFontType("bold");
                    pdf.setFontSize(36);

                    var identity = setInterval(scene, 10);


                    function scene() {
                        if (width >= 100) {
                            clearInterval(identity);
                            $("#ihtisasprogress").toggle(1000);
                            $("#ihtisasindir").toggle(1000);


                        } else {
                            width++;
                            element.style.width = width + '%';
                            element.innerHTML = width * 1 + '%';
                        }
                    };




                    pdf.addImage(dataURL, 'JPG', 0, 0, wdt * 2, hgt * 2);
                    pdf.save("download.pdf");


                }
            });
        });
    </script>
    <!-- /page content -->

    <!-- Chart.js -->




    <!-- Chart.js İhtisas Grafik-->
    <script>
        Chart.defaults.global.legend = {
            enabled: true
        };



        // Bar chart

        var ctx = document.getElementById("ihtisasgrafik");
        var mybarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["<?php echo implode('" ,"', $adsoyaddata); ?>"],
                datasets: [{
                    label: '# Öğrenci Sayısı',
                    yAxisID: 'ogrenci',
                    backgroundColor: "#26B99A",
                    data: ["<?php echo implode('" ,"', $ogrencidata); ?>"]
                }, {
                    label: '# Ders Sayısı',
                    yAxisID: 'ders',
                    backgroundColor: "#03586A",
                    data: ["<?php echo implode('" ,"', $dersdata); ?>"]
                }, {
                    label: '# Sayfa Sayısı',
                    yAxisID: 'sayfa',
                    backgroundColor: "#b48484",
                    data: ["<?php echo implode('" ,"', $sayfadata); ?>"]
                }, {
                    label: '# Saat',
                    yAxisID: 'saat',
                    backgroundColor: "#5b6773",
                    data: ["<?php echo implode('" ,"', $saatdata); ?>"]
                }]
            },

            options: {
                animation: {
                    duration: 500,
                    easing: "easeOutQuart",
                    onComplete: function() {
                        var ctx = this.chart.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale.maxHeight;
                                ctx.fillStyle = '#ffff';
                                var y_pos = model.y + 20;
                                // Make sure data value does not get overflown and hidden
                                // when the bar's value is too close to max value of scale
                                // Note: The y value is reverse, it counts from top down

                                ctx.fillText(dataset.data[i], model.x, y_pos)
                            }
                        });
                    }
                },

                scales: {
                    yAxes: [{
                        id: 'ogrenci',
                        type: 'linear',

                        scaleLabel: {
                            display: true,
                            labelString: 'Öğrenci Sayısı',
                            position: 'left',
                            fontSize: 16,
                            fontColor: "#26B99A"
                        },
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            stacked: true,
                            fontColor: "#26B99A"
                        }
                    }, {
                        id: 'ders',
                        type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Ders Sayısı',
                            fontSize: 16,
                            fontColor: "#03586A"
                        },
                        position: 'right',
                        ticks: {
                            beginAtZero: true,
                            stacked: true,
                            fontColor: "#03586A"
                        }
                    }, {
                        id: 'sayfa',
                        type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Sayfa Sayısı',
                            fontSize: 16,
                            fontColor: "#b48484"
                        },
                        position: 'right',
                        ticks: {
                            beginAtZero: true,
                            stacked: true,
                            fontColor: "#b48484"
                        }
                    }, {
                        id: 'saat',
                        type: 'linear',
                        scaleLabel: {
                            display: true,
                            labelString: 'Saat',
                            fontSize: 16,
                            fontColor: "#5b6773"
                        },
                        position: 'left',
                        ticks: {
                            beginAtZero: true,
                            stacked: true,
                            fontColor: "#5b6773"
                        }
                    }],
                    xAxes: [{

                        gridLines: {
                            offsetGridLines: true,
                            stacked: true
                        }
                    }]
                }
            },
        });
    </script>
    <!-- /Chart.js -->

</div>