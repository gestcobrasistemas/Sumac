
<?php
date_default_timezone_set('America/Guayaquil');
$fecha= date('Ymd');
$fp = fopen("C:\TCOBRO\cargatc-".$fecha.".txt", "r");

    //$linea = fgets($fp);
    //echo $linea;
	if ($fp) {
	while (!feof($fp)) {
    $line = fgets($fp);
	$array = explode("|", $line);
	print_r($array);
    //echo $line;
	//echo '</br>';
	//echo '------';
	//echo '</br>';
	//echo '<u>Section</u><p>nl2br'.($line).'</p>';
  }
	}

fclose($fp);


?>

