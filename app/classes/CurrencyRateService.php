<?php

class CurrencyRateService {

	private $dataProvider;
	private $rateCalculator;

	public function __construct(CurrencyDataProvider $dataProvider, CurrencyRateCalculator $rateCalculator) {
		$this->dataProvider = $dataProvider;
		$this->rateCalculator = $rateCalculator;
	}

	public function getAverageBidRate(string $currencyCode, string $startDate, string $endDate): float {
		$exchangeRates = $this->dataProvider->getExchangeRates($currencyCode, $startDate, $endDate);

		return $this->rateCalculator->calculateAverageRate($exchangeRates);
	}

}
