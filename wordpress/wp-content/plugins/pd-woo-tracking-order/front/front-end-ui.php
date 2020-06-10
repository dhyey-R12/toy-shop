<?php

/**
 * @link https://proficientdesigners.com/
 *
 * @package Proficient Designers Plugin
 * @subpackage pd Woo Tracking Order
 * @since 1.0.0
 * @version 1.0.1
 */

if ( ! $order_id)
	return;

if ( in_array( $order->get_status(), ['pending', 'failed', 'cancelled', 'refunded'] ) ) 
	return;

$fields 			= get_post_meta( $order_id, '_pd_woo_track_order_meta', true );

if ($fields) {
	$status 		= $fields['pd_woo_track_order_status'];
	$carrier_name 	= $fields['pd_woo_track_order_carrier_name'];
	$pickup_date 	= $fields['pd_woo_track_order_carrier_pickup_date'];
	$tracking_id 	= $fields['pd_woo_track_order_tracking_id'];
	$message 		= get_option( 'pd_woo_track_order_message' );

	$search_val 	= ['{carrier_name}', '{pickup_date}', '{tracking_id}'];
	$replace_val 	= [ '<a>'.$carrier_name.'</a>', '<a>'.$pickup_date.'</a>', '<a>'.$tracking_id.'</a>' ];
	$order_message 	= str_replace($search_val, $replace_val, nl2br($message));

} else {
	$status 		= $order->get_status() == 'completed' ? 'delivered' : get_option( 'pd_woo_track_order_status' );
	$carrier_name 	= get_option( 'pd_woo_track_order_carrier_name' );
	$pickup_date 	= current_time( 'd-m-Y' );
}

switch ($status) {

	case 'confirmed':
	$class = 'stage-2';
	break;

	case 'packed':
	$class = 'stage-3';
	break;

	case 'shipped':
	$class = 'stage-4';
	break;

	case 'delivered':
	$class = 'stage-5';
	break;

	default:
	$class = 'stage-1';
	break;
}

?>

<h4 class="">Track your order #<?php echo $order_id ?> which is <a><?php echo $order->get_status(); ?></a></h4>

<div class="order-tracking-wrapper pd-woo-track-<?= $class ?>">

	<div class="order-tracking">
		<div class="track-line-wrapper">
			<div class="track-line">
				<div class="track-dot"></div>
			</div>
		</div>
		<div class="track-cont">
			<div>
				<div class="track-title">Order Placed</div>
				<div class="track-txt">Your order has been placed on <a><?php echo date( 'd-m-Y h:i A', strtotime($order->get_date_created()) ) ?></a></div>
			</div>
		</div>
	</div>

	<div class="order-tracking">
		<div class="track-line-wrapper">
			<div class="track-line">
				<div class="track-dot"></div>
			</div>
		</div>
		<div class="track-cont">
			<div>
				<?php if ( in_array( $class, ['stage-2', 'stage-3', 'stage-4', 'stage-5'] ) ) { ?>
					<div class="track-title">Order confirmed</div>
					<div class="track-txt">Your order has beed confirmed</div>
				<?php } else { ?>
					<div class="track-title">Order yet to confirm</div>
					<div class="track-txt"><?php echo $order->get_status(); ?></div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="order-tracking">
		<div class="track-line-wrapper">
			<div class="track-line">
				<div class="track-dot"></div>
			</div>
		</div>
		<div class="track-cont">
			<div>
				<?php if ( in_array( $class, ['stage-3', 'stage-4', 'stage-5'] ) ) { ?>
					<div class="track-title">Packed</div>
					<div class="track-txt">Items are packed and ready for dispatch</div>
				<?php } else { ?>
					<div class="track-title">Not yet packed</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="order-tracking">
		<div class="track-line-wrapper">
			<div class="track-line">
				<div class="track-dot"></div>
			</div>
		</div>
		<div class="track-cont">
			<div>
				<?php if ( in_array( $class, ['stage-4', 'stage-5'] ) ) { ?>
					<div class="track-title">Shipped</div>
					<div class="track-txt"><?php echo $order_message ?></div>
				<?php } else { ?>
					<div class="track-title">Not yet shipped</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="order-tracking">
		<div class="track-line-wrapper">
			<div class="track-line">
				<div class="track-dot"></div>
			</div>
		</div>
		<div class="track-cont">
			<div>
				<?php if ( in_array( $class, ['stage-5'] ) ) { ?>
					<div class="track-title">Delivered</div>
					<div class="track-txt">Your order has been delivered.</div>
				<?php } else { ?>
					<div class="track-title">Not yet delivered</div>
				<?php } ?>
			</div>
		</div>
	</div>

</div>
