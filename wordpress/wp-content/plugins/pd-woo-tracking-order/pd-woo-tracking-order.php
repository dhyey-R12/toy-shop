<?php
/**
 * Plugin Name: pd Woo Tracking Order
 * Description: You can set the custom Woocommerce Order Status and can able to add a Tracking ID of your carrier service provider with a nice front end user interface of tracking system.
 * Plugin URI: https://proficientdesigners.in/creations/pd-woo-tracking-order/
 * Author: Proficient Designers
 * Author URI: https://proficientdesigners.com
 * Version: 1.0.4
 * WC requires at least: 3.0
 * WC tested up to: 4.0.1
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pd-woo-tracking-order
 * Network: false
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default Variables
 */
$plugin_uri		= basename( plugin_dir_path(  __FILE__ ) );
$plugin_name 	= 'pd Woo Tracking Order';

/**
 * Version checks
 */
global $wp_version;

if (version_compare( $wp_version, '4.0', '<' ))
{
	wp_die(
		'Sorry, <b>'.$plugin_name.'</b> plugin requires WordPress 4.0 or newer. <p><a class="button" href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a></p>',
		'Warning !!',
		['back_link' => true]
	);
}

if ( version_compare( phpversion(), '5.6', '<' ) )
{
	wp_die(
		'Sorry, <b>'.$plugin_name.'</b> plugin requires php version 5.6 or above',
		'Warning !!',
		['back_link' => true]
	);
}

/**
 * Include all classes
 */
foreach ( glob( plugin_dir_path(  __FILE__ ) . 'class/*.php' ) as $file ) {
	require_once $file;
}

/**
 * Intiating main class for pd-woo-tracking-order
 */
if ( ! class_exists( 'pdWooTrackingOrder' ) ) {

	class pdWooTrackingOrder {

		public function __construct() {

			register_activation_hook( __FILE__, [ $this , 'activate' ] );
			add_action( 'admin_init', [ $this, 'detect_woo_deactivation' ], 10 );
			add_action( 'plugins_loaded', [$this, 'on_load'] );
		}

		/**
		 * Check if WooCommerce is active
		 */
		public function activate() {
			
			if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

				wp_die(
					'Sorry, <b>'.$plugin_name.'</b> plugin requires <b><a href="https://wordpress.org/plugins/woocommerce/">Woocommerce 3.0</a></b> or higher...',
					'Warning !!',
					['back_link' => true]
				);
			}
		}

		/**
		 * Deactivate this plugin when Woocommerce is deactivated automatically and if its
		 * deactivated show wp a admin notice this plugin is deactivated
		 */
		public function detect_woo_deactivation() {

			if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

				deactivate_plugins( plugin_basename(__FILE__) );

				add_action( 'admin_notices', function() {
					$class = 'notice notice-error dismissible';
					$message = 'It seems <b>Woocommerce</b> is deactivated and so <b><a>pd Woo Tracking Order</a></b> also got deactivated too, but your settings remains saved !!';
					printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
				}, 10 );
			}
		}

		/**
		 * This func loads Admin & Front classes
		 */
		public function on_load() {

			if (class_exists('pdWooTrackingOrderFront')) {
				new pdWooTrackingOrderFront();
			}

			if ( ! current_user_can( 'activate_plugins' ) )
				return;

			add_action( 'admin_init', [ $this, 'defaults' ] );
			add_filter( 'plugin_action_links', [ $this, 'add_settings_link' ], 10, 5 );
			

			if (class_exists('pdWooTrackingOrderAdmin')) {
				global $plugin_uri;
				new pdWooTrackingOrderAdmin( $plugin_uri );
			}
		}

		/**
		 * Default settings are added while the plugin is activated
		 */
		public function defaults() {

			add_option( 'pd_woo_tracking_details_visiblity', 1);
			add_option( 'pd_woo_track_order_status', 'processing');
			add_option( 'pd_woo_track_order_carrier_name', 'FedEx');
			add_option( 'pd_woo_track_order_message', 'Your order has been picked up by {carrier_name} on {pickup_date}. The tracking id is {tracking_id}');
		}

		/**
		 * Plugin settings and documentation links are added
		 * @param [array] $actions
		 * @param [base_dir] $plugin_file
		 */
		public function add_settings_link( $actions, $plugin_file ) {

			static $plugin;

			if ( !isset($plugin) )

				$plugin = plugin_basename(__FILE__);

			if ( $plugin == $plugin_file ) {

				$settings 	= ['settings' => '<a href="admin.php?page=pd-woo-tracking-order">' . __( 'Settings' ) . '</a>'];
				$docs_link 	= ['docs' => '<a href="https://proficientdesigners.in/creations/pd-woo-tracking-order/" target="_blank">' . __( 'Docs' ) . '</a>' ];

				$actions = array_merge($settings, $actions);
				$actions = array_merge($docs_link, $actions);
			}

			return $actions;
		}
	}

	new pdWooTrackingOrder();
}