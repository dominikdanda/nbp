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

require './app/bootstrap.php';

$uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
$params = explode('/', $uri);

$currency = (string) substr($params[1], 0, 3);
$dateFrom = (string) substr($params[2], 0, 10);
$dateTo = (string) substr($params[3], 0, 10);

if (!in_array($currency, $supportedCurrencies)) {
	exit('Unsupported Currency');
}

$currencyDataProvider = new CurrencyDataProvider();
$currencyRateCalculator = new CurrencyRateCalculator();
$currencyRateService = new CurrencyRateService($currencyDataProvider, $currencyRateCalculator);

$averageRate = $currencyRateService->getAverageBidRate($currency, $dateFrom, $dateTo);

$resp['average_price'] = number_format($averageRate, 4, ','); // round($averageRate, 4); number_format(), cause the task description mentioned output as "4,1505"

print_r(json_encode($resp));
