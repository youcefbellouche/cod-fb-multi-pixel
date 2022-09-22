<?php
use \FacebookAds\Api;
use \FacebookAds\Logger\CurlLogger;
use \FacebookAds\Object\ServerSide\ActionSource;
use \FacebookAds\Object\ServerSide\Content;
use \FacebookAds\Object\ServerSide\CustomData;
use \FacebookAds\Object\ServerSide\DeliveryCategory;
use \FacebookAds\Object\ServerSide\Event;
use \FacebookAds\Object\ServerSide\EventRequest;
use \FacebookAds\Object\ServerSide\UserData;

class Cod_Fp_Script_Conversion_Api {
	private $access_token;
	private $pixel_id;
	private $user_data;
	private $content;
	private $custom_data;
	private $event;
	private $request;
	public function __construct( $access_token, $pixel_id, $test_code = null ) {
		$this->test_code    = $test_code;
		$this->access_token = $access_token;
		$this->pixel_id     = $pixel_id;
		$api                = Api::init( null, null, $this->access_token );
		$api->setLogger( new CurlLogger() );
	}
	public function set_user_data( array $email, array $phone ) {
		$this->user_data = ( new UserData() )
			->setEmails( $email )
			->setPhones( $phone )
			->setClientIpAddress( $_SERVER['REMOTE_ADDR'] )
			->setClientUserAgent( $_SERVER['HTTP_USER_AGENT'] );
		return $this;
	}
	public function set_content( string $product_id, int $quantity ) {
		$this->content = ( new Content() )
			->setProductId( $product_id )
			->setQuantity( $quantity )
			->setDeliveryCategory( DeliveryCategory::HOME_DELIVERY );
		return $this;
	}
	public function set_custom_data( $currency = 'usd', $product_price = 0 ) {
		$this->custom_data = ( new CustomData() )
			->setContents( array( $this->content ) )
			->setCurrency( $currency )
			->setValue( $product_price );
		return $this;
	}
	public function set_event( $event_name = 'Purchase', $page_url ) {
		$this->event = ( new Event() )
			->setEventName( $event_name )
			->setEventTime( time() )
			->setEventSourceUrl( $page_url )
			->setUserData( $this->user_data )
			->setCustomData( $this->custom_data )
			->setActionSource( ActionSource::WEBSITE );
		return $this;
	}
	public function set_request() {
		 $events = array();
		array_push( $events, $this->event );
		$this->request = ( new EventRequest( $this->pixel_id ) )
			->setEvents( $events )
			->setTestEventCode( $this->test_code );
		return $this;
	}
	public function emit_event( array $email, array $phone, string $product_id, int $quantity, $currency = 'usd', $product_price = 0, $event_name = 'Purchase', $page_url ) {
		$this->set_content( $product_id, $quantity );
		$this->set_user_data( $email, $phone );
		$this->set_custom_data( $currency, $product_price );
		$this->set_event( $event_name, $page_url );
		$this->set_request();
		if ( $this->access_token && $this->pixel_id ) {
			$this->request->execute();
		}
	}

}


