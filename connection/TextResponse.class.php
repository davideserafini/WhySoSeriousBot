<?php

if ( !defined( "BOT_TOKEN" ) ) {
	die("uh oh, something wen't wrong here");
}

require_once( "Response.class.php" );
class TextResponse extends Response {
	
	protected $_method;

	function __construct( $responseParams ) {
		 parent::__construct( $responseParams );
		 $this -> _method = "sendMessage";
	}
}

?>