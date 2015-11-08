<?php

class MessageNotTextException extends Exception {
	
	private $_message = "I understand only text messages";
	private $_code = 400;
	private $_previous = null;

	function __constructor() {
		 parent::__construct( $this -> _message, $this -> _code, $this -> _previous );
	}
}

?>