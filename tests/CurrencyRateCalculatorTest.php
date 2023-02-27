<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CurrencyRateCalculatorTest extends TestCase {

	protected static $currencyRateCalculator;

	public static function setUpBeforeClass(): void {
		static::$currencyRateCalculator = new CurrencyRateCalculator();
	}

	public function testEmptyTest(): void {
		$this->assertTrue(true);
	}

	public function testCalculateAverageRate(): void {
		$arr = [
			['bid' => 1.2],
			['bid' => 2.2],
			['bid' => 3.2]
		];

		$avg = static::$currencyRateCalculator->calculateAverageRate($arr);
		$this->assertEquals(2.2, $avg);
	}

}
