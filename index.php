<?php

# php -S 127.0.0.1:8000 -t ./
/**
  Write a service that provides the calculated average buy rate based on data from the National Bank of
  Poland. The data downloaded from the NBP are: buy rate. Upload the code to a repository. The task
  should be done in PHP.
 * 
 * http://api.nbp.pl/
 * http://api.nbp.pl/api/exchangerates/rates/C/EUR/2013-01-28/2013-01-31/
 * 
 * [2013-01-28 - 2013-01-31]
 * GET /EUR/2013-01-28/2013-01-31/

  Tabela A kursów średnich walut obcych,
  Tabela B kursów średnich walut obcych,
  Tabela C kursów kupna i sprzedaży walut obcych;

  [...] Bid – przeliczony kurs kupna waluty (dotyczy tabeli C)
 */

require './bootstrap.php';

$simpleValidator = new SimpleValidator();
$replyBroker = new ReplyBroker();
$inputBroker = new InputBroker();

$params = $inputBroker->getURIParams()->parseParams();

$simpleValidator->currency = $params->currency;
$simpleValidator->dateFrom = $params->dateFrom;
$simpleValidator->dateTo = $params->dateTo;

if (!$simpleValidator->validate()) {
	$replyBroker->setErrorDetails($simpleValidator->getErrorDetails())->returnError();
}

// ISO 4217: assigns a three-digit numeric code to each currency
// ISO 8601: YYYY-MM-DD (YYYYMMDD)

$result = $NBPApi->setParams($params)->callNBPApi()->getJSONesponse();

$sum = 0.0;
foreach ($result->rates as $row) {
	$sum += $row->bid;
}

$avg = $sum / count($result->rates);
$resp['average_price'] = number_format($avg, 4, ','); // round($avg, 4); number_format(), cause the task description mentioned output as "4,1505"

$replyBroker->returnJSONResponse($resp);
