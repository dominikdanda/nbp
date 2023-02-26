<?php

class CurrencyRateCalculator implements CurrencyRateCalculatorInterface {

	public function calculateAverageRate(array $exchangeRates): float {
		$sum = 0.0;
		foreach ($exchangeRates as $rate) {
			$sum += $rate['bid'] ?? 0.0;
		}

		return count($exchangeRates) > 0 ? $sum / count($exchangeRates) : 0.0;
	}

}