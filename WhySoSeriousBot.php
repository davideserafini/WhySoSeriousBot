<?php

// Set inclusion 
define( "INCLUSION", true );

// Set directories
define( "CONFIG_DIR", "config/" );
define( "CONNECTION_DIR", "connection/" );
define( "JOKES_DIR", "jokes/" );
define( "JOKES_STORAGE_DIR", "jokes-storage/" );

// Include config
require_once( CONFIG_DIR . "bot-config.php" );

// Read request
$content = file_get_contents("php://input");
error_log($content);

// Create Request object
require_once( CONNECTION_DIR . "TextRequest.class.php" );
require_once( CONNECTION_DIR . "WrongMessageException.class.php" );
require_once( CONNECTION_DIR . "MessageNotTextException.class.php" );

$textRequest = null;

try {
	$textRequest = new TextRequest( $content );
	$textRequest -> parseMessage();
} catch ( WrongMessageException $exception ) { 
	// received wrong message, must not happen
	error_log( "WrongMessageException: " . $content );
	exit; 
} catch ( MessageNotTextException $exception ) { 
	// Received message that is not text, abort and alert user

	// Create Response
	// Set message from exception
	require_once( CONNECTION_DIR . "TextResponse.class.php" );
	$responseParams = array(
		"chat_id" => $textRequest -> getChatId(),
		"reply_to_message_id" => $textRequest -> getMessageId(),
		"text" => $responseMessage = $exception -> getMessage()
	);
	$response = new TextResponse( $responseParams );
	$response -> send();
	exit;
}

if ( !$textRequest -> isStop() ) {

	// Find a joke and send it to the user
	// Let's do it simple for now: jokes are saved in simple txt files
	// Read the content and send it to the bot

	require_once( JOKES_DIR . "JokesChooser.class.php" );
	$joke = JokesChooser::getJoke();
	
	// Create Response
	// Set message from exception
	require_once( CONNECTION_DIR . "TextResponse.class.php" );
	$responseParams = array(
		"chat_id" => $textRequest -> getChatId(),
		"text" => $responseMessage = $joke -> getMessage()
	);
	$response = new TextResponse( $responseParams );
	$response -> send();
	exit;
}


?>