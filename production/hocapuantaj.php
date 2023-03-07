<script src="js/jspdf.debug.js">
</script>
<div class="title_right ">
    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

    </div>
</div>
<?php

if (empty($_POST['date']) and empty($_POST['datem'])) {
	$date = date('Y-m-d');
	$datem = date('Y-m-d', strtotime("last Saturday"));
} else {
	$date = $_POST['date'];
	$datem = $_POST['datem'];
}
?>

<div class="clearfix"></div>

<?php




if (isset($_POST['idm'])) {
	$idler = implode(",", $_POST['idm']);
}

/* echo 'date= '.$_POST['date'];
echo 'datem= '.$_POST['datem'].'<br>';

 echo 'date= '.$date;
echo 'datem= '.$datem;*/
?>
<!-- Genel Grafik -->

<form action="#" method="POST">
    Başlangıç Tarihi <input type="date" name="datem" value="<?php echo $datem; ?>">
    Bitiş Tarihi <input type="date" name="date" value="<?php echo $date; ?>">

    <button type='submmit' name='dateler' class="btn btn-md bg-green hidden-xs">Tarih</button>

    <button type='submmit' name='idler' class="btn btn-md bg-green hidden-xs">Grafik</button>
    <div class=" col-md-12 col-sm-12 col-xs-12">


        <?php
		if (!empty($_POST['idm'])) {

			include 'hocagrafik.php';
		}

		?>



        <?php
		$birimsor = $db->prepare("SELECT * from birim");

		$birimsor->execute(array()); // kullanicileri bulup seç

		?>

        <?php


		while ($birimcek = $birimsor->fetch(PDO::FETCH_ASSOC)) {  ?>





        <div class="x_panel <?php if (!empty($_POST['idm'])) {
									echo 'gizle';
								} ?>">


            <div class="x_title">
                <h2><?php echo $birimcek['birim_ad'] ?></h2>






                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">







                <!-- start project list -->
                <table class="table table-striped projects raportab">

                    <thead>
                        <tr>
                            <th style="width: 1%" class="hidden-xs gizle"><input type="checkbox"
                                    onclick="toggle<?php echo $birimcek['birim_id']; ?>(this);" /></th>
                            <script>
                            function toggle<?php echo $birimcek['birim_id']; ?>(source) {
                                var checkboxes = document.querySelectorAll(
                                    'input[class="birim<?php echo $birimcek['birim_id']; ?>"]');
                                for (var i = 0; i < checkboxes.length; i++) {
                                    if (checkboxes[i] != source)
                                        checkboxes[i].checked = source.checked;
                                }
                            }
                            </script>
                            <th style="width: 20%">Ad Soyad</th>
                            <th style="width: 5%">Öğrenci Sayısı</th>
                            <th style="width: 5%">Ders Sayısı</th>
                            <th style="width: 5%">Sayfa Sayısı</th>
                            <th style="width: 5%">Saat</th>




                            <th class="hidden-md hidden-xs hidden-sm">Başarı Durumu</th>
                            <th class="hidden-xs gizle">İşlemler</th>

                        </tr>
                    </thead>


                    <tbody>

                        <?php

							$hocalarsor = $db->prepare("SELECT * from kullanici where kullanici_durum=1 and kullanici_yetki IN(3,4) and kullanici_birim={$birimcek['birim_id']} order by kullanici_adsoyad asc");
							$hocalarsor->execute(array());
							$say == 1;

							while ($hocalarcek = $hocalarsor->fetch(PDO::FETCH_ASSOC)) {

								$ogrencivarmi = $db->prepare("SELECT * from ogrenci where ogrenci_kytdrm=1 and kullanici_id={$hocalarcek['kullanici_id']}");
								$ogrencivarmi->execute(array());
								$varmis = $ogrencivarmi->rowCount();
								if ($varmis >= 1) {
									$raporlistsor = $db->prepare("SELECT * from hrapor INNER JOIN kullanici  ON hrapor.kullanici_id = kullanici.kullanici_id where kullanici.kullanici_id=:id ");
									$raporlistsor->execute(array(
										'id' => $hocalarcek['kullanici_id']

									));

									$raporlistcek = $raporlistsor->fetch(PDO::FETCH_ASSOC);





									$tarih1 = date_create($datem);
									$tarih2 = date_create($date);
									$diff = date_diff($tarih2, $tarih1);
									$gun = $diff->format("%a");
									$d = $gun - 1;
									$e = $gun - 1; ?>

                        <tr>
                            <td class="gizle hidden-xs "><input type="checkbox" name="idm[]"
                                    class="birim<?php echo $birimcek['birim_id']; ?>"
                                    value="<?php echo $hocalarcek['kullanici_id']; ?>" /></td>
                            <td>
                                <!--a href="#" data-toggle="modal" data-target="#<?php echo $hocalarcek['kullanici_id']; ?>dersekle" data-whatever="<?php echo $hocalarcek['kullanici_adsoyad']; ?>"--><?php echo $hocalarcek['kullanici_adsoyad']; ?>
                                <!--/a-->
                                <br />
                                <?php $sayfalarsor = $db->prepare("SELECT * from ogrenci INNER JOIN hafizlikdurum  ON hafizlikdurum.ogrenci_id = ogrenci.ogrenci_id where ogrenci.kullanici_id=:id ");
											$sayfalarsor->execute(array(
												'id' => $hocalarcek['kullanici_id']

											));
											$sayfasayisi = 0;
											while ($sayfalarcek = $sayfalarsor->fetch(PDO::FETCH_ASSOC)) {

												$sayf = explode("/", $sayfalarcek['hafizlik_son']);
												$iht = explode(".", $sayf[0]);

												if (isset($iht[1])) {
													$sayfasayisi = $sayfasayisi + 5;
												} else {
													$sayfasayisi = $sayfasayisi + intval($sayf[0]);
												}
											}




											?>

                            </td>


                            <?php $ogrencimiz = OgrenciSayisi($hocalarcek['kullanici_id'], $date, $datem); ?>
                            <?php $dersimiz = DersSayisi($hocalarcek['kullanici_id'], $date, $datem); ?>
                            <?php $sayfamiz = SayfaSayisi($hocalarcek['kullanici_id'], $date, $datem); ?>
                            <?php $saatimiz = HocaSaat($hocalarcek['kullanici_id'], $date, $datem); ?>



                            <td class="project_progress  hidden-xs">

                                <div class="progress progress_sm">






                                    <div class="progress-bar " style="background-color: #30363d !important;"
                                        role="progressbar"
                                        data-transitiongoal="<?php echo floatval($sayfamiz[0]) * 100 / $sayfasayisi; ?>">
                                    </div>


                                </div>
                                <small>Başarı: %<?php echo round(floatval($sayfamiz[0]) * 100 / $sayfasayisi, 2); ?> -
                                    Örenci Sayfa Sayısı: <?php echo $sayfasayisi; ?> Sayfa - Günlük Saat:
                                    <?php echo $sayfasayisi * 1.5 / 60; ?> </small>

                            <td class="gizle hidden-xs">
                                <!--a href="ogrenci-detay.php?ogrenci_id=<?php echo $hocalarcek['kullanici_id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Bilgi </a-->
                                <a href="kullanici-duzenle.php?kullanici_id=<?php echo $hocalarcek['kullanici_id'] ?>"
                                    class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Düzenle </a>
                                <a class="btn btn-danger btn-xs" data-toggle="modal"
                                    data-target="#<?php echo $hocalarcek['kullanici_id']; ?>sil"><i
                                        class="fa fa-trash-o"></i> Sil </a>
                            </td>

                            <div class="modal fade" id="<?php echo $hocalarcek['kullanici_id']; ?>sil" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="alert alert-danger">
                                            <h1 class="modal-title" id="exampleModalLabel">Dikkat</h1>

                                        </div>
                                        <div class="modal-body">
                                            <h3> <strong><?php echo $hocalarcek['kullanici_adsoyad'] ?></strong> İsimli
                                                Hocanın Kaydı Siliniyor..</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Hayır</button>
                                            <!--a href="../netting/islem.php?ogrenci_id=<?php echo $ogrencicek['ogrenci_id'] ?>&ogrencisil=ok"><button type="button" class="btn btn-primary">Evet</button> </a-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>
                        <?php }
							} ?>


                    </tbody>
                </table>
                <!-- end project list -->

            </div>

        </div>



        <?php } ?>
    </div>
</form>


<!-- /page content -->

<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>



<!-- Chart.js Genel Grafik-->
<script>
Chart.defaults.global.legend = {
    enabled: true
};



// Bar chart

var ctx = document.getElementById("genelgrafik");
var mybarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["<?php echo implode('" ,"', $adsoyaddata); ?>"],
        datasets: [{
            label: '# Öğrenci Sayısı',
            yAxisID: 'ogrenci',
            backgroundColor: "#039e79",
            data: ["<?php echo implode('" ,"', $ogrencidata); ?>"]
        }, {
            label: '# Ders Sayısı',
            yAxisID: 'ders',
            backgroundColor: "#03586A",
            data: ["<?php echo implode('" ,"', $dersdata); ?>"]
        }, {
            label: '# Sayfa Sayısı',
            yAxisID: 'sayfa',
            backgroundColor: "#b22c2c",
            data: ["<?php echo implode('" ,"', $sayfadata); ?>"]
        }, {
            label: '# Saat',
            yAxisID: 'saat',
            backgroundColor: "#30363d",
            data: ["<?php echo implode('" ,"', $saatdata); ?>"]
        }]
    },

    options: {
        animation: {
            duration: 500,
            easing: "easeOutQuart",
            onComplete: function() {
                var ctx = this.chart.ctx;
                ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart
                    .defaults.global.defaultFontFamily);
                ctx.textAlign = 'center';
                ctx.textBaseline = 'bottom';

                this.data.datasets.forEach(function(dataset) {
                    for (var i = 0; i < dataset.data.length; i++) {
                        var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                            scale_max = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._yScale
                            .maxHeight;
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
                    fontColor: "#039e79"
                },
                position: 'left',
                ticks: {
                    beginAtZero: true,
                    stacked: true,
                    fontColor: "#039e79"
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
                    fontColor: "#b22c2c"
                },
                position: 'right',
                ticks: {
                    beginAtZero: true,
                    stacked: true,
                    fontColor: "#b22c2c"
                }
            }, {
                id: 'saat',
                type: 'linear',
                scaleLabel: {
                    display: true,
                    labelString: 'Saat',
                    fontSize: 16,
                    fontColor: "#30363d"
                },
                position: 'left',
                ticks: {
                    beginAtZero: true,
                    stacked: true,
                    fontColor: "#30363d"
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