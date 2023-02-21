<?php

/**
 * Description of NBPApi
 *
 * @author Dominik
 */
class NBPApi {

	private $params;
	private $response;

	public function setParams($_params) {
		$this->params = $_params;
		return $this;
	}

	public function callNBPApi() {
		$curl = curl_init();
		$uri = NBP_API_ENDPOINT . 'exchangerates/rates/C/' . $this->params->currency . '/' . $this->params->dateFrom . '/' . $this->params->dateTo . '/';
		curl_setopt($curl, CURLOPT_URL, $uri);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$this->response = curl_exec($curl);
		if (!$this->response) {
#			$replyBroker->returnError();
		}

		curl_close($curl);

		/*
		  400 BadRequest - Przekroczony limit 367 dni / Limit of 367 days has been exceeded
		 */
		if (!curl_errno($curl)) {
			$info = curl_getinfo($curl);

			if ($info['http_code'] != 200) {
#				$replyBroker->setErrorDetails(['errCode' => 400, 'errInfo' => 'BadRequest'])->returnError();
			}
		}
		
		return $this;
	}
	
	public function getJSONesponse() {
		return json_decode($this->response);
	}
		

}
