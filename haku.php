<?php
require_once("koulu.inc");

if(isset($_GET["EtuMap"]))
{
	$haku3 = "select maax,maay,maanimi from maa";
	mysqli_set_charset($conn, 'utf8');
	$tulos2 = mysqli_query($conn,$haku3);
	
	if(!$tulos2)
	{
		echo "". mysqli_error($conn);
	}
	else
	{
		$maat = '{"maa":[';
		
			while ($rivi2 = mysqli_fetch_assoc($tulos2)){
				$maanimi = $rivi2["maanimi"];
				$maay = $rivi2["maay"];
				$maax = $rivi2["maax"];
				$maat .= '{"maanimi":"'.$maanimi.'","maay":"'.$maay.'","maax":"'.$maax.'"},';
			}
	}
		
	$maat = rtrim($maat,",");
	$maat .= ']}';
	echo $maat;
}

if(isset($_GET["maa"]) && isset($_GET["map"]))
{
	$maa = $_GET["maa"]; 

	$haku = "select koordinaattix, koordinaattiy, linkki, nimi from koulu where maa = '$maa' ";
	mysqli_set_charset($conn, 'utf8');
	$tulos = mysqli_query($conn, $haku);
		if ( !$tulos )
		{
			echo "" . mysqli_error($conn);
		}
		else
		{
			
			$text = '{"data":[';
				while ($rivi = mysqli_fetch_assoc($tulos)) 
				{ 
						$koordi1 = $rivi["koordinaattix"]; 
						$koordi2 = $rivi["koordinaattiy"]; 
						$linkki = $rivi["linkki"]; 
						$nimi = $rivi["nimi"];
						$text .= '{"koordi1":"'.$koordi1.'","koordi2":"'.$koordi2.'","linkki":"'.$linkki.'","nimi":"'.$nimi.'"},';		
				}
		}	
		
		$text = rtrim($text,",");
		$text .= ']}';
		echo $text;
}

if(isset($_GET["maat"]) && isset($_GET["maa"]))
{
	$maa = $_GET["maa"]; 

	$haku3 = "select kuvaus, kokemus, kokemusnimi, posteri from maa where maanimi ='$maa'";
	mysqli_set_charset($conn, 'utf8');
	$tulos3 = mysqli_query($conn,$haku3);
		if(!$tulos3)
		{
			echo "". mysqli_error($conn);
		}
		else{
			$text = '{"data":[';
				while ($rivi3 = mysqli_fetch_assoc($tulos3)){
					$kuvaus = $rivi3["kuvaus"];
					$kokemus = $rivi3["kokemus"];
					$kokemusnimi = $rivi3["kokemusnimi"];
					$posteri = $rivi3["posteri"];
					$text .= '{"kuvaus":"'.$kuvaus.'","kokemus":"'.$kokemus.'","kokemusnimi":"'.$kokemusnimi.'","posteri":"'.$posteri.'"},';//,"maa":"'.$maa.'","kokemus":"'.$kokemus.'","nimi":"'.$nimi.'"yms....
				}
		}
		$text = rtrim($text,",");
		$text .= ']}';
		echo $text;
}
?>