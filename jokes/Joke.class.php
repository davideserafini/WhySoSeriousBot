<?php

abstract class Joke {

	protected $_index;

	function __constructor( $index ) {
		$this -> _index = $jokeIndex;
	}

	abstract function getMessage();

}

?>