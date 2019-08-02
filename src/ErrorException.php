<?php

namespace Phy\CoreApi;

use Exception;

class ErrorException extends Exception {

	private $errorMessage;
	private $statusCode;

	public function __construct($errorMessage = "", $statusCode = 500){
		$this->errorMessage = $errorMessage;
		$this->statusCode = $statusCode;
	}

	public function getErrorMessage(){
		return $this->errorMessage;
	}

	public function getErrorCode(){
		return $this->statusCode;
	}
}