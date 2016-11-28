<?php
session_start();
require_once("koulu.inc");

 if (!isset($_COOKIE["keksi"])|| ($_COOKIE["keksi"]!="keksi"))//cookieta ei ole joten palataan kirjautumisikkunaan
  {
  header("Location:login.php?virhe");
  exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<title>Hallinta</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="tyylit.css">
		<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="myscript.js"></script>
		<?php
			require_once("koulu.inc");
		?>	
	</head>
	<body>
	
	<!--MENUBAR-->
	<nav class="navbar navbar-default navbar-custom">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menubar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="etusivu.html"><img src="Kuvat/logo.png"></img></a>
			</div>
		</div>
	</nav>				
		
	<!--LISÄÄ TIETOKANTAAN-->
	<div class="container-fluid bg-1 text-center">
		<div class="card card-block">
			<h6 id="otsikko">LISÄÄ TIETOKANTAAN</h6>
			<p>Lisää uusi koulu tai maa allaolevista painikkeista</p>
			<button onclick="document.getElementById('addSchoolModal').style.display='block'" class="w3-btn w3-black w3-large">Lisää koulu</button>
			<button onclick="document.getElementById('addCountrylModal').style.display='block'" class="w3-btn w3-black w3-large">Lisää maa</button>
			<?php
				if (isset($_POST["add"]))
				{
					$addNimi = utf8_decode($_POST["addNimi"]);
					$addMaa = utf8_decode($_POST["addMaa"]);
					$addLinkki = utf8_decode($_POST["addLinkki"]);
					$addX = utf8_decode($_POST["addX"]);
					$addY = utf8_decode($_POST["addY"]);
					
					$addMaa = strtoupper($addMaa);
											
					$query = "INSERT INTO koulu (nimi, maa, linkki, koordinaattiy, koordinaattix)
					VALUES ('$addNimi', '$addMaa', '$addLinkki', $addY, $addX)"; //muokkaa nämä!!
					$tulos = mysqli_query($conn, $query);

					echo "<h1 id='succesfull' style='color:green;'>Koulu lisätty!</h1>";
				}

				if (isset($_POST["addNewMaa"]))                      
				{
					$addMaaNimi = utf8_decode($_POST["addMaaNimi"]);
					$addKuvaus = utf8_decode($_POST["addKuvaus"]);
					$addKokemus = utf8_decode($_POST["addKokemus"]);
					$addKokemusNimi = utf8_decode($_POST["addKokemusNimi"]);
					$addMaaX = utf8_decode($_POST["addMaaX"]);
					$addMaaY = utf8_decode($_POST["addMaaY"]);
					$addPosteri = utf8_decode($_POST["addPosteri"]);
					
					$addMaaNimi = strtoupper($addMaaNimi);
					
					$query = "INSERT INTO maa (maanimi, kuvaus, kokemus, kokemusnimi, maax, maay, posteri)
					VALUES ('$addMaaNimi', '$addKuvaus', '$addKokemus', '$addKokemusNimi', '$addMaaX', '$addMaaY', '$addPosteri')";
					$tulos = mysqli_query($conn, $query);
					
					echo "<h1 id='succesfull' style='color:green;'>Maa lisätty!</h1>";
					
				}					
			?>
		</div>	
	</div>
		
	<!--POISTA TIETOKANNASTA-->
	<div class="container-fluid bg-1 text-center">
		<div class="card card-block">
			<h6 id="otsikko">POISTA TIETOKANNASTA</h6>
			<p>Poista koulu tai maa allaolevista painikkeista</p>
			<button onclick="document.getElementById('delSchoolModal').style.display='block'" class="w3-btn w3-black w3-large">Poista koulu</button>
			<button onclick="document.getElementById('delCountryModal').style.display='block'" class="w3-btn w3-black w3-large">Poista maa</button>
		<?php
			if(isset($_POST["PoistaMaa"]))
			{
				$maanNimi = $_POST["maa"];
				$query = "DELETE FROM maa WHERE maanimi='$maanNimi'";
				$query2 = "DELETE FROM koulu WHERE maa='$maanNimi'";
				$tulos = mysqli_query($conn, $query);
				$tulos2 = mysqli_query($conn, $query2);
				echo "<h1 id='succesfull' style='color:green;'>Maa poistettu!</h1>";
			}
			
			if(isset($_GET["poistakoulu"]))
			{
				$id = $_GET["id"];
				$query = "DELETE FROM koulu WHERE id=$id";
				$tulos = mysqli_query($conn, $query);
				echo "<h1 id='succesfull' style='color:green;'>Koulu poistettu!</h1>";
			}
		?>
		</div>
	</div>
	
	<!--MUOKKAA MAA JA NAPIT-->
		<div class="container-fluid bg-1 text-center">
			<div class="card card-block">
				<h6 id="otsikko">MUOKKAA TIETOKANTAA</h6>
				<form action="hallinta.php" method="GET">
					<p>Valitse muokattava maa ja paina Muokkaa maata-painiketta</p>
					<select class="w3-select w3-border w3-center" name="muokattavaMaa">
						<?php
						$query = "SELECT maanimi FROM maa";
						$tulos = mysqli_query($conn, $query);
					
							while ($rivi = mysqli_fetch_assoc($tulos)) 
							{ 
								$maa = $rivi["maanimi"];							
						?>
							<option value="<?php echo $maa; ?>"><?php echo $maa; ?></option>	
						<?php
							}
						?>
					</select>
					<br>
					<button type="submit" class="w3-btn w3-black w3-large">Muokkaa maata</button>
				</form>
			<?php 
				if(isset($_POST["muokkaaMaa"]))
				{
					$newNimi = $_POST["label"];
					$newKuvaus = $_POST["newKuvaus"];
					$newKokemus = $_POST["newKokemus"];
					$newKokemusnimi = $_POST["newKokemusnimi"];
					$query = "UPDATE maa SET kuvaus ='$newKuvaus', kokemus ='$newKokemus', kokemusnimi = '$newKokemusnimi' WHERE maanimi = '$newNimi'";
					
					mysqli_set_charset($conn, 'utf8');
					$tulos = mysqli_query($conn, $query);
					echo "<h1 id='succesfull' style='color:green;'>Maata muokattu!</h1>";
				}
			?>
			</div>
		</div>
		
	<!--LISÄÄ KOULU-MODAALI-->
	<div id="addSchoolModal" class="w3-modal">
		<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
			<div class="w3-center"><br>
				<span onclick="document.getElementById('addSchoolModal').style.display='none'" class="w3-closebtn w3-hover-pink w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
			</div>
			<form class="w3-container" action="hallinta.php" method="POST">
				<div class="w3-section">
					<label>Koulun nimi:</label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Koulun nimi" name="addNimi" required>
					<label>Maa, jossa koulu sijaitsee:</label>
					<select class="w3-select w3-border w3-center" name="addMaa" required>
							<?php
								$query = "SELECT maanimi FROM maa";
								mysqli_set_charset($conn, 'utf8');
								$tulos = mysqli_query($conn, $query);
								
									while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) 
									{ 
										$maa = $rivi["maanimi"];
							?>
							<option value="<?php echo $maa; ?>"><?php echo $maa; ?></option>	
							<?php
									}
							?>
					</select>
					<label>Koulun internet-osoite:</label>
					<input class="w3-input w3-border" type="text" placeholder="Linkki" name="addLinkki" required>
					<label>Koordinaatit: (katso Google Mapsista)</label>
					<input class="w3-input w3-border" type="number" placeholder="X" name="addX" required><input class="w3-input w3-border" type="number" placeholder="Y" name="addY" required>
					<button class="w3-btn-block w3-black w3-section w3-padding" type="submit" value="add" name="add">Lisää koulu</button>
				</div>
			</form>
		</div>
	</div>
		
	<!--LISÄÄ MAA-MODAALI-->
	<div id="addCountrylModal" class="w3-modal">
		<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
			<div class="w3-center"><br>
				<span onclick="document.getElementById('addCountrylModal').style.display='none'" class="w3-closebtn w3-hover-pink w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
			</div>
			<form class="w3-container" action="hallinta.php" method="POST">
				<div class="w3-section">
					<label>Maan nimi:</label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Maan nimi" name="addMaaNimi" required>
					<label>Maan kuvaus: (Näkyy kun käyttäjä valitsee maan)</label>
					<input class="w3-input w3-border" type="text" placeholder="Maan kuvaus" name="addKuvaus" required>
					<label>Maan keskityskoordinaatti X:</label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Maan keskityskoordinaatti X" name="addMaaX" required>
					<label>Maan keskityskoordinaatti Y:</label>
					<input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Maan keskityskoordinaatti Y" name="addMaaY" required>
					<label>Opiskelijan kokemus: </label>
					<input class="w3-input w3-border" type="text" placeholder="Opiskelijan kokemus" name="addKokemus" required>
					<label>Opiskelijan nimi:</label>
					<input class="w3-input w3-border" type="text" placeholder="Opiskelijan nimi" name="addKokemusNimi" required>
					<label>Linkki posteriin: </label>
					<input type="file" name="addPosteri" value="addPosteri">
					<button class="w3-btn-block w3-black w3-section w3-padding" type="submit" value="addNewMaa" name="addNewMaa">Lisää maa</button>
				</div>
			</form>
		</div>
	</div>
	
	<!--------------------TÄSTÄ ALKAA MIKAN TEKEMINEN-------------------------------->
		
	<!--POISTA KOULU-MODAALI-->
		<div id="delSchoolModal" class="w3-modal w3-padding-32">
			<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
				<div class="w3-center"><br>
					<span onclick="document.getElementById('delSchoolModal').style.display='none'" class="w3-closebtn w3-hover-pink w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
				</div>
				<div class="w3-section w3-center">
					<h6 id="valiotsikko">POISTA KOULU</h6>
					<input class="w3-input w3-border w3-padding" type="text" placeholder="Search for names.." id="myInput" onkeyup="myFunction()">
					<?php
						$query = "SELECT nimi, ID FROM koulu";
						
						mysqli_set_charset($conn, 'utf8');
						$tulos = mysqli_query($conn, $query);
						
						echo "<table id='koulutaulukko' class='w3-table-all w3-hoverable w3-opacity'>";
						while ($rivi = mysqli_fetch_ASSOC($tulos)) 
						{ 
							$nimi = $rivi["nimi"];
							$id = $rivi["ID"];
							echo "<tr><td>$nimi</td><td><a href=\"hallinta.php?poistakoulu&id=$id&maa\">Poista</a></td></tr>";
						} 
						echo "</table>";
					?>
				</div>
			</div>
		</div>
		
	<!--POISTA MAA-MODAALI-->
	<div id="delCountryModal" class="w3-modal">
		<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">
			<div class="w3-center"><br>
				<span onclick="document.getElementById('delCountryModal').style.display='none'" class="w3-closebtn w3-hover-pink w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
			</div>
			<div class="w3-section">
				<h6 id="valiotsikko" style="text-align:center;">POISTA MAA</h6>
				<form class="w3-padding-32" action="hallinta.php" method="POST">
					<select class="w3-select w3-border w3-center" id="maanvalinta" name="maa">
					<?php
						$query = "SELECT maanimi FROM maa";
						$tulos = mysqli_query($conn, $query);
					
							while ($rivi = mysqli_fetch_assoc($tulos)) 
							{ 
								$maa = $rivi["maanimi"];							
					?>
					<option value="<?php echo $maa; ?>"><?php echo $maa; ?></option>	
					<?php
							}
					?>
					</select>
					<input type="submit" name="PoistaMaa" value="Poista"/>
				</form>
			</div>
		</div>
	</div>
	
	<!--MUOKKAA MAA-MODAALI-->

	<div id="editCountry" class="w3-modal">
			<div class="w3-modal-content w3-card-8 w3-animate-zoom" >
				<div class="w3-center"><br>
					<span onclick="document.getElementById('editCountry').style.display='none'" class="w3-closebtn w3-hover-pink w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
				</div>
				<div class="w3-section">
					<h6 style="text-align:center;">Muokkaa</h6>
					
				<?php
					if(isset($_GET["muokattavaMaa"]))
					{
						echo '<script language="javascript">';
						echo "document.getElementById('editCountry').style.display='block'";
						echo '</script>';
						
						$muokattavaMaa = $_GET["muokattavaMaa"];
						$query = "SELECT id,maanimi, kuvaus,kokemus,kokemusnimi FROM maa WHERE maanimi='$muokattavaMaa'";
						$tulos = mysqli_query($conn, $query);
						
						echo "<table class='w3-table-all'>";
						echo "<tr>
								<th>Nimi:</th>
								<th>Maan kuvaus:</th>
								<th>Opiskelijan nimi:</th>
								<th>Opiskelijan kokemus:</th>
							  </tr>";
						
						?> <form action="hallinta.php" method="POST">
						<?php
						while ($rivi = mysqli_fetch_ASSOC($tulos)) 
						{ 
							$id = $rivi["id"];
							$nimi = $rivi["maanimi"];
							$kuvaus = $rivi["kuvaus"];
							$kokemus = $rivi["kokemus"];
							$kokemusnimi = $rivi["kokemusnimi"];
							echo "<tr>
									<td><input name='label' value='$nimi' readonly></input></td>
									<td><textarea  rows='15' cols='70' class='w3-input w3-border w3-margin-bottom' type='text' name='newKuvaus' required >$kuvaus</textarea></td>
									<td><textarea class='w3-input w3-border w3-margin-bottom' rows='6' cols='50' type='text'  name='newKokemusnimi' required >$kokemusnimi</textarea></td>
									<td><textarea class='w3-input w3-border w3-margin-bottom' rows='6' cols='50' type='text'  name='newKokemus' required >$kokemus</textarea></td>
								</tr>";
						} 
						
						echo "</table>";
						?>
						<button type="submit" value="muokkaaMaa" name="muokkaaMaa">muokkaa</button>
						</form>
					<?php
					}
				?>
				</div>
			</div>
		</div>
		
	<!--FOOTER-->
	<footer class="container-fluid bg-5 text-center">
		<p id="footerteksti">©Taco Production 2016</p>
	</footer>
	
	</body>
</html>