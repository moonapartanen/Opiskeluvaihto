<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Ylläpito</title>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="tyylit.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="myscript.js"></script>
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
			<div class="collapse navbar-collapse" id="menubar">
			  <ul class="nav navbar-nav navbar-right">
				<li><a id="mblinkki" href="#yhteyshenkilotlinkki">YHTEYSHENKILÖT</a></li>
				<li><a id="mblinkki" href="#infoalinkki">INFOA</a></li>
				<li><a id="mblinkki" href="#rahoituslinkki">RAHOITUS</a></li>
				<li><a id="mblinkki" href="#mitentoiminlinkki">MITEN TOIMIN?</a></li>
			  </ul>
			</div>
		  </div>
		</nav>

		<!--YLLÄPITO-PALSTA-->
		<div class="container-fluid bg-1 text-center">
			<div id="yllapito" class="card card-block">
				<h6 id="otsikko">YLLÄPITO</h6>
				<hr>
				<p>Tämä sivusto on tarkoitettu ylläpitäjille. Ole hyvä ja kirjaudu sisään.</p><br>	
				<form class="form-inline" action="checklogin.php" method="GET">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Käyttäjätunnus" name="username">
						<input type="password" class="form-control" placeholder="Salasana" name="password">
						<button type="submit" class="btn btn-default">Kirjaudu sisään</button>
					</div>
					<br>
					<?php
						if (isset($_GET["virhe"]))
						{
							echo "<h1 id='succesfull' style='color:red;'>Väärä salasana tai käyttäjätunnus!</h1>";
						}
					?>
				</form>
			</div>
		</div>

		<!--FOOTER-->
		<footer class="container-fluid bg-5 text-center">
			<p id="footerteksti">©Taco Production 2016 <a href="yllapito.php"><span id="meisseli" class="glyphicon glyphicon-wrench"></span></a></p>
		</footer>
		
		<!--BACK-TO-UP-NUOLI-->
		<span id="top-link-block" class="hidden">
			<a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
				<i id="nuoli" aria-hidden="true">&#8593</i>
			</a>
		</span>
	</body>
</html>