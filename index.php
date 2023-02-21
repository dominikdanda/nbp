<?php

/**
  Write a service that provides the calculated average buy rate based on data from the National Bank of
  Poland. The data downloaded from the NBP are: buy rate. Upload the code to a repository. The task
  should be done in PHP.
 * 
 * http://api.nbp.pl/
 * http://api.nbp.pl/api/exchangerates/rates/C/EUR/2013-01-28/2013-01-31/
 * 
 * 
 * [2013-01-28 - 2013-01-31]
 * GET /EUR/2013-01-28/2013-01-31/
 */
/*
  Tabela A kursów średnich walut obcych,
  Tabela B kursów średnich walut obcych,
  Tabela C kursów kupna i sprzedaży walut obcych;

  [...] Bid – przeliczony kurs kupna waluty (dotyczy tabeli C)
 */


$supportedCurrencies = ['USD', 'EUR', 'CHF', 'GBP'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$currency = $uri[1];
$dateFrom = $uri[2];
$dateTo = $uri[3];

if (!in_array($currency, $supportedCurrencies)) {
	exit('Unsupported Currency');
}

// ISO 4217: assigns a three-digit numeric code to each currency
// ISO 8601: YYYY-MM-DD (YYYYMMDD)

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'http://api.nbp.pl/api/exchangerates/rates/C/'.$currency.'/'.$dateFrom.'/'.$dateTo.'/');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($curl);
curl_close($curl);

$result = json_decode($response);

$sum = 0.0;
foreach ($result->rates as $row) {
	$sum += $row->bid;
}

$avg = $sum / count($result->rates);
$resp['average_price'] = number_format($avg, 4, ','); // round($avg, 4); number_format(), cause the task description mentioned output as "4,1505"

print_r(json_encode($resp));
