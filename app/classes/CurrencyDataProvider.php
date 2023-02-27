<?php

class CurrencyDataProvider implements CurrencyDataProviderInterface {

	public function getExchangeRates(string $currency, string $dateFrom, string $dateTo): array {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, NBP_API_URI . 'exchangerates/rates/C/' . $currency . '/' . $dateFrom . '/' . $dateTo . '/');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response, true)['rates'] ?? [];
	}

}
