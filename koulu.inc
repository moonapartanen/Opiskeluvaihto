<?php
	// tietokannan nimi
	define("DB_NAME", "projekti2_2016_syksy_tacoproductions");
	define("DB_USER", "dbadmin16stp");
	define("DB_PASSWD", "mmpayHM7ScEcbVJ2");
	define("DB_HOST", "codez.savonia.fi");

	// tehdään connect tietokantapalvelimelle
	$conn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME); 
	
	if ( mysqli_connect_errno() )
	{
		// Lopettaa tämän skriptin suorituksen ja tulostaa parametrina tulleen tekstin
		die ("Tietokantapalvelinta ei löydy, syy: " . mysqli_connect_error());
	}

	// valitaan tietokanta -> Ei välttämätöntä, jos kanta annettu mysqli_connect:ssa
	//mysqli_select_db($conn, DB_NAME) or die ("Tietokantaan " . DB_NAME . " ei saada yhteyttä");
?>