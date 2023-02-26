<?php

class CurrencyDataProvider implements CurrencyDataProviderInterface {

	private $nbpApiUri;
	public function setNbpApiUri(string $uri): void {
		$this->nbpApiUri = $uri;
		error_log('NBP_API_URI: '. NBP_API_URI);
		// NBP_API_URI
	}
	
	public function getExchangeRates(string $currency, string $dateFrom, string $dateTo): array {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'http://api.nbp.pl/api/exchangerates/rates/C/' . $currency . '/' . $dateFrom . '/' . $dateTo . '/');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($curl);
		curl_close($curl);

		return json_decode($response, true)['rates'] ?? [];
	}

}
