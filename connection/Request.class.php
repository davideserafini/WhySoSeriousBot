<?php

/**
 * This class provides the general support for requests received from Telegram 
 * as described in https://core.telegram.org/bots/api#message
 */
abstract class Request {

	protected $_rawMessage;
	protected $_messageId;
	protected $_chatId;
	
	function __construct( $received_message ) {
		$this -> _rawMessage = json_decode( $received_message, true );
		
		if ( !$this -> _rawMessage ) {
			require_once( "WrongMessageException.class.php" );
			throw new WrongMessageException();
		}
	}

	public function parseMessage() {
		$this -> _messageId = $this -> _rawMessage[ 'message' ][ 'message_id' ];
  		$this -> _chatId = $this -> _rawMessage[ 'message' ][ 'chat' ][ 'id' ];
	}

	public function getMessageId() {
		return $this -> _messageId;
	}

	public function getChatId() {
		return $this -> _chatId;
	}

}

?>