<div>
	<style>
		.categorie {
			font-size: 1.2rem;
			padding: 0px 0px 5px 15px;
			background: #000000;
			color: #fff;
		}

		.capitol a {
			color: #fff;

		}



		.capitol {
			border-bottom: 1px solid #dadaec;
			/*background: #3180c2; */
			color: #fff;
			padding: 15px;
		}

		.even {
			background-color: #3180c2;
		}

		.odd {
			background-color: #3180c2e0;
		}

		.tbl {
			box-shadow: 5px 5px 7px 2px #8b9dad;
		}

		.buton {

			display: inline-block;
			padding: 10px 20px;
			border-radius: 0px;
			line-height: 30px;
			-webkit-box-sizing: content-box;
			-moz-box-sizing: content-box;
			box-sizing: content-box;
			box-shadow: 5px 5px 7px 2px #8b9dad;
		}

		.rosu:hover {

			background: #ff0000;
			border: 1px solid #d81111;
			box-shadow: inset 1px 1px 1px rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.2);
			text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.4);

		}

		.rosu {

			background-color: #c71414;
			background-image: -moz-linear-gradient(top, #f00, #831b1b);
			background-image: -webkit-linear-gradient(top, #f00, #831b1b);
			background-image: linear, to bottom, #f00, #831b1b;
			background-repeat: repeat-x;
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF319CE2', endColorstr='#FF247AB4', GradientType=0);
			border: 1px solid #d81111;
			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.2);
			text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.4);
			color: #fff;

		}

		.albastru {

			background-color: #0e2cf1;
			background-image: -moz-linear-gradient(top, #f00, #831b1b);
			background-image: -webkit-linear-gradient(top, #83add8d4, #045275);
			background-image: linear, to bottom, #f00, #831b1b;
			background-repeat: repeat-x;
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FF319CE2', endColorstr='#FF247AB4', GradientType=0);
			border: 1px solid #060606;
			box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.3), 0 2px 2px rgba(0, 0, 0, 0.2);
			text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.4);
			color: #fff;

		}

		g.block {
			border: #0067a2 solid 2px;
		}
	</style>

	<?
	$dataCapitole = '';
	$dataCategorii = $ObjPPVSB->incarcaDateCategorie($codSubiect);
	
	echo "<p>Durata de utilizare a unui program este de 1 an de zile de la achizitie</p>";
	echo "<div class='tbl'>";
	foreach ($dataCategorii as $key => $value) {
		echo "<div class='g-grid'>";
		echo "<div class='g-block size-100 categorie'>" . strtoupper($value->denumire_categorie);
		$dataCapitole = $ObjPPVSB->incarcaDatePacheteVanzare($value->cod_categorie);

		$c = 0;
		foreach ($dataCapitole as $key => $value) {
			$codProdus = $value->cod_capitol;
			$credite = $ObjPPVSB->incarcaValoareaPachet($codProdus);
			$noOfVideos = $ObjPPVSB->numarVideoPachet($codProdus);
			if ($ObjPPVSB->verifyProductOwner($codProdus, $iduser) == 1) {
				$buttonLink = "<div class='g-block size-20'><a href='/vizionare?prod=" . $codProdus . "' class='buton albastru'>Vizioneaza</a></div>";
			} else {
				$buttonLink = "<div class='g-block size-20'><a href='/achz-ppvb?tp=PPVB&prod=" . $codProdus . "' class='buton rosu'>Cumpara</a></div>";
			}
			$linkExemplu=$ObjPPVSB->incarcaLinkExemplu($value->cod_capitol);
			//print_r($linkExemplu);

			echo "<div class='" . (($c++ % 2 == 1) ? 'g-grid size-100 capitol odd' : 'g-grid size-100 capitol even') . "'>";

			echo "<div class='g-block size-30'>" . $value->denumire_capitol . "</div>
			<div class='g-block size-20'>" . $value->cod_capitol . "</div>
			<div class='g-block size-15'>" . $noOfVideos . " video-uri</div>
			<div class='g-block size-15'>" . $credite . " credite</div>
			" . $buttonLink . "<button id='myBtn'>Exemplu</button>" ;
			echo "</div>";

			echo '<div id="myModal" class="modal">

			<!-- Modal content -->
			<div class="modal-content">
			  <span class="close">&times;</span>
			  <div class="g-grid size-100 cadru">
			  <div class="g-block size-100 titleofprogram">Monotonia unei functii derivabile - Exercitii - #2 - Exercitii 01</div>
			  <div class="g-grid size-100 iframediv hidden-phone hidden-tablet visible-desktop visible-large"><iframe src="'.$linkExemplu.'" width="1280" height="720" frameborder="0" allow="autoplay; fullscreen" allowfullscreen="">
				</iframe></div><div class="g-grid size-100 iframediv visible-phone visible-tablet hidden-desktop hidden-large"><iframe src="'.$linkExemplu.'" width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen=""></iframe>
				</div>
				</div>
			</div>
		  
		  </div>
		  ';
		}
		echo "</div>";
		echo "</div>";
	}
	echo "</div>";


	if ($dataCapitole == '' or empty($dataCapitole)) {
		echo "<p class='alert alert-info'>Programele legate de acest subiect vor fi introduse in curand.</p>";
	}
	?>
</div>

<script>
	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function() {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>