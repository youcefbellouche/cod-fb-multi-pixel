<?php

require_once COD_FB_MP_PLUGIN_DIR . 'inc/classes/cod-fb-convirsion-api.php';

class Cod_Fp_Script_Convirsion_Events {
	private $conversions_api;
	public function __construct() {

		add_action( 'init', array( $this, 'cod_event_init' ) );

	}
	public function cod_event_init() {
		$pixels = get_option( 'cod_facebook_pixels', array() );
		foreach ( $pixels as  $key => $pixel ) {
			if ( $pixel['api'] != '' ) {
				$this->conversions_api[] = new Cod_Fp_Script_Convirsion_Api( $pixel['api'], $pixel['pixel'], $pixel['test'] );
			}
		}
		if ( ! empty( $this->conversions_api ) ) {
			add_action( 'cod_thank_you_page', array( $this, 'cod_purchase_event' ) );
			add_action( 'cod_after_footer', array( $this, 'cod_view_product_event' ), 10, 2 );
		}

	}
	public function cod_purchase_event( $order_meta ) {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array( $order_meta['email'] ), array( $order_meta['phone'] ), $order_meta['product'], $order_meta['quantity'], 'dzd', $order_meta['product_price'], 'Purchase', home_url( $wp->request ) );
		}
	}
	public function cod_view_product_event( $product_price, $product_name ) {
		foreach ( $this->conversions_api as  $api ) {
			$api->emit_event( array(), array(), $product_name, 0, 'dzd', $product_price, 'View Product', home_url( $wp->request ) );
		}
	}

}

new Cod_Fp_Script_Convirsion_Events();
