<?php

// Set inclusion 
define( "INCLUSION", true );

// Set directories
define( "CONFIG_DIR", "config/" );
define( "CONNECTION_DIR", "connection/" );

require_once( "config/bot-config.php" );

// Create Response for webhooks setup
require_once( CONNECTION_DIR . "WebhookResponse.class.php" );

$responseParams = array(
	"url" => WEBHOOK_URL
);
$response = new WebhookResponse( $responseParams );
$response -> send();

?>