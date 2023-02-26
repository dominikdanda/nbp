<?php

interface CurrencyDataProviderInterface {

	public function setNbpApiUri(string $uri): void;

	public function getExchangeRates(string $currencyCode, string $startDate, string $endDate): array;
}
