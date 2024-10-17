<?php
ignore_user_abort(true);
set_time_limit(0);
$ch = curl_init("http://localhost:8080/tcobro/wstcobro/webser/actualiza");
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_exec ($ch);
curl_close ($ch);


?>