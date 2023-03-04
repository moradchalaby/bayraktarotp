
<?php 

$cuz=$_POST['cuz'];
$drm=$_POST['drm'];
$sayfa=$_POST['sayfa'];
 ?>
<form action="" method="POST">
	

	<input type="text" name="cuz"><br>
	<input type="text" name="sayfa"><br>
	<select name="drm">
		<option>Ham</option>
		<?php $has=0;
		while ( $has <= 20) {
			$has++;

		echo "<option>$has.Has</option>";
	}
		 ?>
		

	</select>

<button type="submit">ekle</button>
</form>


<?php

if (substr($drm, 0,-4)>0) {
	$imlec=1/(2**substr($drm, 0,-4));
}else {
	$imlec=1;
}


 echo "$cuz'$imlec'$sayfa";





// isim ve tc ile klasör oluşturma
 if (isset($_POST['dosyayukle'])) {
	$klasoryol = "../dimg/ogrenci/dokumans/";
	$klasorad = $klasoryol.$_POST['ogrenci_adsoyad']."-".$_POST['ogrenci_tc'];
	

	mkdir("$klasorad");
	
echo $klasorad." isminde klasör oluşturuldu."." yol: <a href=\"$klasorad\">";


}




  ?>


