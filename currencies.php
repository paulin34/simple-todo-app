<?php

$apikey = "fca_live_HKpKiIDpC5eE1TMDIDq4x8HSnMcv7gOmijQdmwVq";
$url = "https://api.freecurrencyapi.com/v1/currencies";

$apikey = http_build_query(array("apikey"=>$apikey));
$url .= "?" . $apikey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );

$response = curl_exec($ch);
if(curl_errno($ch))
{
    echo curl_error($ch);
    exit;
}
$decodedResponse = json_decode($response,1)['data'];
$currenciesList = [];
foreach($decodedResponse as $currency=>$info)
{
    array_push($currenciesList, $currency);
}

function generateOptions() : void
{
    /// <option value="USD">USD</option>
    global $currenciesList;
    foreach($currenciesList as $currency)
    {
        echo '<option value="' . $currency . '">' . $currency . "</option>";
    }
}



