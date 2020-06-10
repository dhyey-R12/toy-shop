<?php

/**
 * @link https://proficientdesigners.com/
 *
 * @package Proficient Designers Plugin
 * @subpackage pd Woo Tracking Order
 * @since 1.0.0
 * @version 1.0.1
 */

$fields 			= get_post_meta( get_the_ID($post), '_pd_woo_track_order_meta', true );

if ($fields) {
	$visibility		= esc_html( $fields['pd_woo_tracking_details_visiblity']  );
	$status 		= esc_html( $fields['pd_woo_track_order_status']  );
	$carrier_name 	= esc_html( $fields['pd_woo_track_order_carrier_name']  );
	$pickup_date 	= esc_html( $fields['pd_woo_track_order_carrier_pickup_date']  );
	$tracking_id 	= esc_html( $fields['pd_woo_track_order_tracking_id']  );
} else {
	$visibility		= esc_html( get_option( 'pd_woo_tracking_details_visiblity' ) );
	$status 		= esc_html( get_option( 'pd_woo_track_order_status' ) );
	$carrier_name 	= esc_html( get_option( 'pd_woo_track_order_carrier_name' ) );
	$pickup_date 	= current_time( 'd-m-Y' );
	$tracking_id 	= '';
}

?>

<p>
	<input type="checkbox" name="pd_woo_tracking_details_visiblity" <?php echo $visibility ? 'checked' : '' ?>>
	<label><strong>Order Tracking visibility</strong></label>
</p>

<p>
	<label><strong>Order Status</strong></label>
</p>

<p>
	<select name="pd_woo_track_order_status" onchange="showTrackingBox(this.value)">
		<option value="processing" <?= selected( 'processing', $status ); ?>>Order Placed</option>
		<option value="confirmed" <?= selected( 'confirmed', $status ); ?>>Order Confirmed</option>
		<option value="packed" <?= selected( 'packed', $status ); ?>>Order Packed</option>
		<option value="shipped" <?= selected( 'shipped', $status ); ?>>Order Shipped</option>
		<option value="delivered" <?= selected( 'delivered', $status ); ?>>Order Delivered</option>
	</select>
</p>

<p>
	<label><strong>Carrier Name</strong></label><br>
</p>
<p>
	<input type="text" name="pd_woo_track_order_carrier_name" value="<?php echo @$carrier_name ?>">
</p>

<p>
	<label><strong>Carrier Pickup Date</strong></label>
</p>
<p>
	<input type="text" id="pdWooTrcOrdrDatePicker" name="pd_woo_track_order_carrier_pickup_date" value="<?php echo @$pickup_date  ?>">
</p>

<p>
	<label><strong>Tracking ID</strong></label>
</p>
<p>
	<input type="text" name="pd_woo_track_order_tracking_id" value="<?php echo @$tracking_id  ?>">
</p>

<?php wp_nonce_field( 'pd_woo_tracking_details_nonce', 'pd_woo_tracking_details' ); ?>