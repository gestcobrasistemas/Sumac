
<?php
date_default_timezone_set('America/Guayaquil');
$fecha= date('Ymd');
$fp = fopen("C:\TCOBRO\cargatc-".$fecha.".txt", "r");

$lineas = file("C:\TCOBRO\cargatc-".$fecha.".txt", FILE_SKIP_EMPTY_LINES);

$mysqli = new mysqli("localhost", "root", "", "esepe");
//
foreach ($lineas as $num_linea => $linea) {
    $array = explode("|", $linea);
    if (!$mysqli->query("INSERT INTO datos VALUES ('$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$array[8]','$array[9]','$array[10]','$array[11]','$array[12]','$array[13]',NULL,'$array[15]','$array[16]','$array[17]','$array[18]','$array[19]','$array[20]','$array[21]','$array[22]','$array[23]','$array[24]','$array[25]','$array[26]')")){
            echo "Falló la llamada: (" . $mysqli->errno . ") " . $mysqli->error;
    }
}

?>

