<?php

/**
 * @link https://proficientdesigners.com/
 *
 * @package Proficient Designers Plugin
 * @subpackage pd Woo Tracking Order
 * @since 1.0.0
 * @version 1.0.0
 */

?>

<div class="wrap">
	
	<div class="card" style="min-width: 100%;">

		<?php settings_errors(); ?>

		<form method="post" action="options.php" id="pd-Woo-Tracking-Order-Meta-Box">
			<?php settings_fields( 'pd-woo-tracking-order' ); ?>
			<?php do_settings_sections( 'pd-woo-tracking-order' ); ?>
			<?php submit_button(); ?>
		</form>

	</div>

</div>