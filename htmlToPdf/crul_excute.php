<?php

function curl_get_result($url)
{
    $ch      = curl_init();
    //$timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$url = "http://localhost/htmlToPdf/index.php?p_id=22";
$pdfURL = curl_get_result($url);
echo $pdfURL;