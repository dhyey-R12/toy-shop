<?php

/**
 * @link https://proficientdesigners.com/
 *
 * @package Proficient Designers Plugin
 * @subpackage pd Woo Tracking Order
 * @since 1.0.0
 * @version 1.0.0
 */

if ( ! class_exists('pdWooTrackingOrderFront') ) {
	
	class pdWooTrackingOrderFront {

		function __construct() {

			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front_end' ], 10, 1 );
			add_action( 'woocommerce_view_order', [ $this, 'html' ], 10, 1 );
			add_action( 'woocommerce_thankyou', [ $this, 'html' ], 10, 1 );		
		}

		public function public_path( $file ) {

			return plugin_dir_path( dirname(__FILE__) ) . 'front/' . $file;	
		}

		public function public_url( $file ) {

			return plugin_dir_url( dirname(__FILE__) ) . 'front/' . $file;	
		}

		public function enqueue_front_end() {

			wp_enqueue_style( 'pd-Woo-Tracking-Order', $this->public_url('front-ui.css'), [], false, 'all' );
		}

		public function html( $order_id ) {

			$order 	= wc_get_order( $order_id );
			$fields = get_post_meta( $order_id, '_pd_woo_track_order_meta', true );

			if ($fields) {
				$visibility		= esc_html( $fields['pd_woo_tracking_details_visiblity']  );
			} else {
				$visibility		= esc_html( get_option( 'pd_woo_tracking_details_visiblity' ) );
			}
			
			if ($visibility) {
				require $this->public_path( 'front-end-ui.php' );
			}
		}
	}
}