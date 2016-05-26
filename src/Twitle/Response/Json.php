<?php

namespace Twitle\Response;

class Json {

	public $result = [];

	public $errors = null;

	public $success = true;

	public function __construct($result = [], array $errors = []) {
		$this->result = $result;
		$this->errors = $errors;
		$this->success = empty($errors);
	}
} 