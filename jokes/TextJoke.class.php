<?php

if ( !defined( JOKES_STORAGE_DIR ) ) {
	die("uh oh, something wen't wrong here");
}

require_once( "Joke.class.php" );
class TextJoke extends Joke {

	private static const FILE_EXTENSION = ".txt";

	function __constructor( $index ) {
		parent::__construct( $index );
	}

	function getMessage() {
		return file_get_contents( JOKES_STORAGE_DIR . $this -> index . FILE_EXTENSION );
	}

}

?>