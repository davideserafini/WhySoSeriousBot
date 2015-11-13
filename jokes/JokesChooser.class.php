<?php

if ( !defined( "JOKES_STORAGE_DIR" ) ) {
	die("uh oh, something wen't wrong here");
}

class JokesChooser {
	
	public static function getJoke() {
		$fi = new FilesystemIterator( JOKES_STORAGE_DIR, FilesystemIterator::SKIP_DOTS );
		$numberOfJokes = iterator_count($fi);

		$chosenJokeIndex = rand(0, $numberOfJokes - 1 );

		require_once( "TextJoke.class.php" );
		return new TextJoke( $chosenJokeIndex );
	}

}

?>