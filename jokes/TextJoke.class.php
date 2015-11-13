<?php

if ( !defined( "JOKES_STORAGE_DIR" ) ) {
	die("uh oh, something wen't wrong here");
}

require_once( "Joke.class.php" );
class TextJoke  extends Joke {

	private $_fileExtension = ".txt";

	function __construct( $index ) {
		parent::__construct( $index );
	}

	function getMessage() {
		return file_get_contents( JOKES_STORAGE_DIR . $this -> _index . $this -> _fileExtension );
	}

}

?>