<?php
/**
 * Cod facebook Callback
 *
 * @package cod
 */


$pixels = get_option( 'cod_facebook_pixels', array() );

?>
<form method="POST" class="pixel-form-container">
	<div class="cod_facebook_pixels">
		<h1>Facebook pixels</h1>
		<?php wp_nonce_field( 'save_facebook_pixels', 'cod_facebook_pixels_nonce' ); ?>

		<?php foreach ( $pixels as  $key => $pixel ) : ?>
		<div class="cod_facebook_pixel">
			<input require type=text placeholder="Pixel ID" name="cod_facebook_pixels[<?php echo $key; ?>][pixel]" value="<?php echo $pixel['pixel']; ?>" >
			<input type=text placeholder="Confersion Api" name="cod_facebook_pixels[<?php echo $key; ?>][api]" value="<?php echo $pixel['api']; ?>" >
			<button class="button-red remove_pixel_field" style="margin-left: 5px;">Delete</button>
		</div>
		<?php endforeach; ?>
	</div>
	<button style="margin-top: 20px ;" class="button add_price_field">Add Field</button>
	<input class="button button-primary" type="submit" value="Submit">
</form>
