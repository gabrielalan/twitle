<?php

namespace Twitle\Response;

class Json {

	public $result = [];

	public $errors = null;

	public $success = true;

	public function __construct(array $result = [], array $errors = [], $success = true) {
		$this->result = $result;
		$this->errors = $errors;
		$this->success = $success;
	}
} 