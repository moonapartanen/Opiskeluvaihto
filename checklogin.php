<?php
session_start();

$keksi="keksi";
$tunnus = ($_GET["username"]);
$salasana = ($_GET["password"]);

if($tunnus=="" && $salasana=="")
  {
	  setcookie("keksi",$keksi);
	  header("location:hallinta.php");
	  exit();
  }
else
  {
	  setcookie("keksi", "", time() -3600, "/");
	  header("location:yllapito.php?virhe"); 
	  exit();
  }
 ?>
