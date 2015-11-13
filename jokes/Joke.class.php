<?php

abstract class Joke {

	protected $_index;

	function __construct( $index ) {
		$this -> _index = $index;
	}

	abstract function getMessage();

}

?>