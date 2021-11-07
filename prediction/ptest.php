<?php



function convertCurrency($amount,$from_currency,$to_currency){
  $apikey = '586cf272fc5a44070928';

  $from_Currency = urlencode($from_currency);
  $to_Currency = urlencode($to_currency);
  $query =  "{$from_Currency}_{$to_Currency}";

  $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/convert?q={$query}&compact=ultra&apiKey={$apikey}");
  $obj = json_decode($json, true);

  $val = floatval($obj["$query"]);


  $total = $val * $amount;
  return number_format($total, 2, '.', '');
}

$curr="USD";
$rate1= convertCurrency(10, $curr, "INR");
echo $rate1;


 ?>