
<?php
date_default_timezone_set('America/Guayaquil');
$fecha= date('Ymd');

$lineas = file("C:/TCOBRO/tablas_cuotas-".$fecha.".txt", FILE_SKIP_EMPTY_LINES);

$mysqli = new mysqli("localhost", "root", "", "tcobro2_base");
$mysqli->query("DELETE from cuotas");

foreach ($lineas as $num_linea => $linea) {
    $array = explode("|", $linea);
    if (!$mysqli->query("INSERT INTO cuotas (Column1,Column2,Column3,Column4,Column5,Column6,Column7,Column8,Column9,Column10,Column11,Column12)
	VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$array[8]','$array[9]','$array[10]','$array[11]')")){
            echo "Falló la llamada: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}


?>

