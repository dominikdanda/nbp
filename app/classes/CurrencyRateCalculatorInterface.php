<?php

interface CurrencyRateCalculatorInterface {
	
	public function calculateAverageRate(array $exchangeRates): float;
}