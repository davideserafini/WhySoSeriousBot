<?php

class WrongMessageException extends Exception {
	
	private $_message = "";
	private $_code = 400;
	private $_previous = null;

	function __constructor() {
		 parent::__construct( $this -> _message, $this -> _code, $this -> _previous );
	}
}

?>