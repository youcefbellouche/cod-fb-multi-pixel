<?php

class Cod_Multi_Pixel {
	function __construct() {
		add_action( 'admin_menu', array( $this, 'cod_fb_mp_settings' ) );
		add_action( 'init', array( $this, 'cod_fb_mp_settings_save' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_cod_facebook_pixels_scripts' ) );

	}
	public function cod_fb_mp_settings() {
		add_menu_page( __( 'Facebook Multi pixel' ), 'Multi Pixel', 'manage_options', 'cod-facebook-pixels', array( $this, 'cod_facebook_pixels_display' ), '', 7 );
	}
	public function cod_fb_mp_settings_save() {
		if ( ! isset( $_POST['cod_facebook_pixels_nonce'] )
		|| ! wp_verify_nonce( $_POST['cod_facebook_pixels_nonce'], 'save_facebook_pixels' )
		) {
			return;
		}
		if ( isset( $_POST['cod_facebook_pixels'] ) ) {
			$pixels = $_POST['cod_facebook_pixels'];
			foreach ( $pixels as $key => $pixel ) {
				if ( trim( $pixel['pixel'] ) != '' ) {

					$filtered_pixels[ $key ]['pixel'] = trim( $pixel['pixel'] );
					$filtered_pixels[ $key ]['api']   = trim( $pixel['api'] );
					$filtered_pixels[ $key ]['test']  = trim( $pixel['test'] );

				}
			}
			if ( ! empty( $filtered_pixels ) ) {
				update_option( 'cod_facebook_pixels', $filtered_pixels, true );
			} else {
				update_option( 'cod_facebook_pixels', array(), true );
			}
		}
	}


	public function cod_facebook_pixels_display() {
		require_once COD_FB_MP_PLUGIN_DIR . 'inc/partials/settings-page.php';
	}
	public function enqueue_cod_facebook_pixels_scripts() {
		wp_enqueue_script( 'cod-multi-pixel-js', COD_FB_MP_PLUGIN_URL . 'inc/partials/main.js', array( 'jquery' ), COD_FB_MP_PLUGIN_VERSION, true );
		wp_enqueue_style( 'cod-multi-pixel-css', COD_FB_MP_PLUGIN_URL . 'inc/partials/style.css', array(), COD_FB_MP_PLUGIN_VERSION, 'all' );
	}

}
new Cod_Multi_Pixel();

