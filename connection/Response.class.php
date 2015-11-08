<?php

/**
 * This class provides the general support for response to Telegram.
 * Some code taken from https://core.telegram.org/bots/samples/hellobot
 */

if ( !defined( BOT_TOKEN ) ) {
	die("uh oh, something wen't wrong here");
}

abstract class Response {

 	protected $_url = "https://api.telegram.org/bot" . BOT_TOKEN . "/";
	protected $_method = "";
	protected $_responseParams;
	
	function __construct( $responseParams ) {
		$this -> _responseParams = $responseParams;
	}

	protected function prepareParams() {
		foreach ($this -> _responseParams as $key => &$val) {
		    // encoding to JSON array parameters
		    if ( !is_numeric( $val ) && !is_string( $val ) ) {
		    	$val = json_encode( $val );
		    }
		}
	}

	protected function setupRequest() {
		$finalUrl = API_URL . $this -> _method . '?' . http_build_query( $this -> _responseParams );
		$responseInstance = curl_init( $finalUrl );
		curl_setopt($responseInstance, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($responseInstance, CURLOPT_CONNECTTIMEOUT, 5);
  		curl_setopt($responseInstance, CURLOPT_TIMEOUT, 60);
  		return $responseInstance;
	}
	
	protected function doRequest( $request ) {
		$response = curl_exec( $request );
		if ($response === false) {
		    $errno = curl_errno( $request );
		    $error = curl_error( $request );
		    error_log("Curl returned error $errno: $error\n");
		    curl_close( $request );
		    return false;
		}

		$http_code = intval( curl_getinfo($request, CURLINFO_HTTP_CODE) );
		curl_close( $request );

		if ( $http_code >= 500 ) {
			// do not wat to DDOS server if something goes wrong
			sleep(10);
			return false;
		} else if ( $http_code != 200 ) {
			$response = json_decode( $response, true );
			error_log( "Request has failed with error {$response['error_code']}: {$response['description']}\n" );
			if ( $http_code == 401 ) {
				throw new Exception( 'Invalid access token provided' );
			}
			return false;
		} else {
			$response = json_decode( $response, true );
			if ( isset($response['description']) ) {
				error_log( "Request was successfull: {$response['description']}\n" );
			}
			$response = $response[ 'result' ];
		}

		return $response;
	}

	public function send() {
		$requestToDo = setupRequest();
		doRequest( $requestToDo );
	}

}

?>