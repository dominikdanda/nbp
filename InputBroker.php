<?php

/**
 * Description of InputBroker
 *
 * @author Dominik
 */
class InputBroker {

	public $params;
	public $currency;
	public $dateTo;
	public $dateFrom;

	public function getURIParams() {
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->params = explode('/', $uri);

		return $this;
	}

	public function parseParams() {
		$this->currency = (string) substr($this->params[1], 0, 3);
		$this->dateFrom = (string) substr($this->params[2], 0, 10);
		$this->dateTo = (string) substr($this->params[3], 0, 10);

		return $this;
	}

}
