<?php

/**
 * Simple NBP's data validation
 *
 * @author Dominik
 */
class ReplyBroker {

	private $errCode = 404;
	private $errInfo = 'NotFound';
	private $errDetails = ''; // addidional details (may be used when loggin errors)

	public function setErrorDetails($_details) {
		$this->errCode = $_details['errCode'] ?? '';
		$this->errInfo = $_details['errInfo'] ?? '';
		$this->errDetails = $_details['errDetails'] ?? '';

		return $this;
	}

	public function returnJSONResponse($resp) {
		exit(json_encode($resp));
	}

	public function returnError() {
		http_response_code($this->errCode);
		$errResp = "$this->errCode $this->errInfo";
		header("HTTP/1.1 $errResp");

		exit($errResp);
	}

}
