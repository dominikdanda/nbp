<?php

/**
 * Simple NBP's data validation
 *
 * @author Dominik
 */
class SimpleValidator {

	private $supportedCurrencies = ['USD', 'EUR', 'CHF', 'GBP'];
	public $currency;
	public $dateFrom;
	public $dateTo;
	private $errStatus = true;
	private $errCode = 404;
	private $errInfo = 'NotFound';
	private $errDetails = ''; // addidional details (may be used when loggin errors)

	public function validate() {
		$this->validateCurrency();
		$this->validateDate();

		return $this->errStatus;
	}

	private function validateCurrency() {
		if (!in_array($this->currency, $this->supportedCurrencies)) {
			$this->errCode = 400;
			$this->errInfo = 'Unsupported Currency';
			$this->errDetails = 'Requested currency is beyond supported currencies';
			$this->errStatus = false;
		}
	}

	private function validateDate() {
		if (!strtotime($this->dateFrom) || !strtotime($this->dateTo)) { // eg. wrong date
			$this->errInfo = 'wrong date';
			$this->errStatus = false;
		}

		if (!preg_match("^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$^", $this->dateFrom)) { // wrong date format
			$this->errInfo = 'wrong dateFrom format';
			$this->errStatus = false;
		}

		if (!preg_match("^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$^", $this->dateTo)) { // wrong date format
			$this->errInfo = 'wrong dateTo format';
			$this->errStatus = false;
		}

		if (strtotime($this->dateTo) < strtotime($this->dateFrom)) { // dateTo before dateFrom
			$this->errInfo = 'dateTo is before dateFrom';
			$this->errStatus = false;
		}
	}

	public function getErrorDetails() {
		return [
			'errCode' => $this->errCode,
			'errInfo' => $this->errInfo,
			'errDetails' => $this->errDetails,
		];
	}

}
