<?php

class Cod_Fb_Conversion_Events {
	private $conversions_api;
	public function __construct() {
		$pixels = get_option( 'cod_facebook_pixels', array() );
		foreach ( $pixels as  $key => $pixel ) {
			if ( $pixel['api'] != '' ) {
				$this->conversions_api[] = new Cod_Fb_Conversion_Api( $pixel['api'], $pixel['pixel'], $pixel['test'] );
			}
		}
		add_action( 'init', array( $this, 'cod_event_init' ) );

	}
	public function cod_event_init() {
		add_action( 'cod_product_purchese_event', array( $this, 'cod_purchase_event' ),10,2 );
		add_action( 'cod_after_footer_events', array( $this, 'cod_view_product_event' ) , 10 ,3 );

	}
	public function cod_purchase_event( $order_meta, $devise ) {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array( $order_meta['email'] ), array( $order_meta['phone'] ), $order_meta['product_title'], $order_meta['quantity'], $devise, $order_meta['attribute_name']['price'], 'Purchase', home_url( $wp->request ) );
		}
	}
	public function cod_view_product_event( $product_name, $product_price, $devise ) {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array(), array(), $product_name, 0, $devise, $product_price, 'View Product', home_url( $wp->request ) );
		}
	}

}

new Cod_Fb_Conversion_Events();
