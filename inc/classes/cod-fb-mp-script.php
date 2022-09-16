<?php

class Cod_Fp_Script_Header {
	function __construct() {
		add_action( 'wp_head', array( $this, 'add_script_to_header' ) );
	}

	public function add_script_to_header() {
		$pixel_ids = get_option( 'cod_facebook_pixels', array() );
		if ( ! empty( $pixel_ids ) ) :
			?>
<!-- Facebook Pixel Code ta3 youcef-->
<script>
! function(f, b, e, v, n, t, s) {
		if (f.fbq) return;
		n = f.fbq = function() {
			n.callMethod ?
				n.callMethod.apply(n, arguments) : n.queue.push(arguments)
		};
		if (!f._fbq) f._fbq = n;
		n.push = n;
		n.loaded = !0;
		n.version = '2.0';
		n.queue = [];
		t = b.createElement(e);
		t.async = !0;
		t.src = v;
		s = b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
	'https://connect.facebook.net/en_US/fbevents.js');
			<?php
			foreach ( $pixel_ids as $pixel_id ) {
				echo "fbq('init', '" . $pixel_id['pixel'] . "');\n";
			}
			?>
		fbq('track', 'PageView');
		</script>
		<noscript>
			<?php
			foreach ( $pixel_ids as $pixel_id ) {
				$src = "https://www.facebook.com/tr?id='" . $pixel_id['pixel'] . "'&ev='PageView'&noscript='1'";
				echo "<img height='1' width='1' style='display:none' src='$src' />\n";
			}
			?>
		</noscript>
<!-- End Facebook Pixel Code -->
			<?php
		endif;
	}

}
new Cod_Fp_Script_Header();

