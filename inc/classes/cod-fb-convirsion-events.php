<?php

require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/cod-fb-convirsion-api.php';

class Cod_Fp_Script_Convirsion_Events {
	private $conversions_api;
	public function __construct() {
		add_action( 'init', array( $this, 'add_fb_conversion_events' ) );
	}
	public function add_fb_conversion_events() {
		$pixels = get_option( 'cod_facebook_pixels', array() );
		foreach ( $pixels as  $key => $pixel ) {
			if ( $pixel['api'] != '' ) {
				$this->conversions_api[] = new Cod_Fp_Script_Convirsion_Api( $pixel['api'], $pixel['pixel'] );
			}
		}
		if ( $this->conversions_api ) {
			add_action( 'cod_thank_you_page', array( $this, 'cod_purchase_event' ) );
			add_action( 'cod_after_footer', array( $this, 'cod_View_Product_event' ) );}

	}
	public function cod_purchase_event( $order_meta ) {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array( $order_meta['email'] ), array( $order_meta['phone'] ), $order_meta['product'], $order_meta['quantity'], 'dzd', $order_meta['product_price'], 'Purchase', home_url( $wp->request ) );
		}
	}
	public function cod_View_Product_event() {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array(), array(), get_the_title(), 0, 'dzd', $product_price, 'View Product', home_url( $wp->request ) );
		}
	}

}


