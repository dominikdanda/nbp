<?php

interface CurrencyDataProviderInterface {

	public function getExchangeRates(string $currencyCode, string $startDate, string $endDate): array;
}
