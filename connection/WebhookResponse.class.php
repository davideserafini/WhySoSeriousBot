<?php

if ( !defined( "BOT_TOKEN" ) ) {
	die("uh oh, something wen't wrong here");
}

require_once( "Response.class.php" );
class WebhookResponse extends Response {
	
	function __construct( $responseParams ) {
		 parent::__construct( $responseParams );
		 $this -> _method = "setWebhook";
	}
}

?>