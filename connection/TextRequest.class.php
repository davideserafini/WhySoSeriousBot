<?php

/**
 * This class provides the support for request of type text 
 * as described in https://core.telegram.org/bots/api#message
 */

require_once( "Request.class.php" );
class TextRequest extends Request {

	protected $_text;

	function __construct( $received_message ) {
		 parent::__construct( $received_message );
	}

	public function parseMessage() {
		parent::parseMessage();
		
		if ( !isset( $this -> _rawMessage[ 'text' ] ) ) {
			require_once( "MessageNotTextException.class.php" );
  			throw new MessageNotTextException();
  		}
		$this -> _text = trim( $this -> _rawMessage[ 'text' ] );
	}

	public function  isStart() {
		return strpos( $this -> _text, "/start" ) === 0;
	}

	public function  isStop() {
		return strpos( $this -> _text, "/stop" ) === 0;
	}

}

?>