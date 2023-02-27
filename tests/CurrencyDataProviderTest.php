<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class CurrencyDataProviderTest extends TestCase {

	protected static $currencyDataProvider;

	public static function setUpBeforeClass(): void {
		static::$currencyDataProvider = new CurrencyDataProvider();
	}

	public function testEmptyTest(): void {
		$this->assertTrue(true);
	}


}
