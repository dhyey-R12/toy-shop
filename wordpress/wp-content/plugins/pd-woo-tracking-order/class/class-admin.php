<?php

/**
 * @link https://proficientdesigners.com/
 *
 * @package Proficient Designers Plugin
 * @subpackage pd Woo Tracking Order
 * @since 1.0.0
 * @version 1.0.1
 */

if ( ! class_exists('pdWooTrackingOrderAdmin') ) {
	
	class pdWooTrackingOrderAdmin {

		function __construct( $plugin_uri ) {

			if ( ! current_user_can( 'activate_plugins' ) )
				return;

			$this->plugin_uri = $plugin_uri;

			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin' ], 10, 1 );
			add_action( 'add_meta_boxes', [ $this, 'meta_boxes' ], 10, 2 );
			add_action( 'admin_menu', [ $this, 'options_page' ] );
			add_action( 'admin_init', [ $this, 'admin_settings_page_init' ] );
			add_action( 'save_post', [ $this, 'save_order_tracking_details'], 10, 2 );
		}

		public function admin_path( $file ) {

			return plugin_dir_path( dirname(__FILE__) ) . 'admin/' . $file;	
		}

		public function admin_url( $file ) {

			return plugin_dir_url( dirname(__FILE__) ) . 'admin/' . $file;	
		}

		public function enqueue_admin() {

			wp_enqueue_style( 'pd-Woo-Tracking-Order', $this->admin_url('admin-ui.css'), [], false, 'all' );
			wp_enqueue_script( 'pd-Woo-Tracking-Order', $this->admin_url('admin.js'), array('jquery'), '1.0', false);
			wp_enqueue_script( 'jquery-ui-datepicker' );
		}

		public function meta_boxes() {

			add_meta_box( 'pd-Woo-Tracking-Order-Meta-Box', 'pd Woo Track Order', [ $this, 'meta_boxes_cb' ], 'shop_order', 'side', 'default' );
		}

		public function meta_boxes_cb( $post ) {

			require $this->admin_path( 'metabox.php' );
		}

		public function options_page() {

			$icon_url = "data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDMwIDMwIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCAzMCAzMDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6IzE0MTQxNDt9DQoJLnN0MXtmaWxsOiM2RDlGMjE7fQ0KPC9zdHlsZT4NCjxnPg0KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0yOC44Myw3LjQ3Yy0wLjMxLTEuNzEtMS4wNS0zLjItMi4yMi00LjQ4Yy0xLjY2LTEuODEtMy43Mi0yLjc4LTYuMTUtMi45N2MtMC43NC0wLjA2LTEuNDgtMC4wMS0yLjIxLDAuMTINCgkJYy0xLjgyLDAuMzMtMy4zOSwxLjE0LTQuNzIsMi40MmMtMC42MiwwLjYtMS4yMiwxLjIxLTEuODMsMS44M2MtMC4xNiwwLjE3LTAuMzUsMC4yNC0wLjU4LDAuMjRjLTAuNjIsMC0xLjI0LDAtMS44NiwwDQoJCWMtMC41MywwLTEuMDUsMC0xLjU4LDBjLTAuMTksMC0wLjM3LDAuMDEtMC41NiwwLjAzQzYuMTcsNC43OSw1LjM2LDUuMTksNC43LDUuODdDMy45Myw2LjY2LDMuNTYsNy42MywzLjU1LDguNzMNCgkJYy0wLjAxLDEuODQtMC4wMSwzLjY3LDAsNS41MWMwLDAuMjEtMC4wNiwwLjM5LTAuMiwwLjU0Yy0wLjM3LDAuNDItMC42OSwwLjg2LTAuOTksMS4zM2MtMC44NCwxLjM0LTEuMjksMi43OS0xLjM0LDQuMzcNCgkJYy0wLjAyLDAuNSwwLjAxLDEuMDEsMC4wNywxLjUxYzAuMDgsMC42OCwwLjIzLDEuMzUsMC40NiwyYzAuNDYsMS4zMywxLjIzLDIuNDcsMi4yNCwzLjQ1YzIuMTgsMi4xMiw1LjEzLDIuOSw3Ljg2LDIuNDQNCgkJYzEuOTEtMC4zMiwzLjU2LTEuMTgsNC45NC0yLjU0YzAuNTgtMC41OCwxLjE2LTEuMTUsMS43My0xLjczYzAuMTctMC4xNywwLjM2LTAuMjUsMC41OS0wLjI1YzEuMTUsMCwyLjMsMCwzLjQ2LDANCgkJYzAuNTMsMCwxLjA1LTAuMSwxLjU0LTAuM2MxLjUtMC42MiwyLjQ3LTIsMi41My0zLjYxYzAuMDItMC41MiwwLjAxLTEuMDQsMC4wMS0xLjU2YzAtMC42NiwwLTEuMzIsMC0xLjk3YzAtMC43MywwLTEuNDUsMC0yLjE4DQoJCWMwLTAuMTgsMC4wNi0wLjM1LDAuMTktMC40OGMwLjAzLTAuMDQsMC4wNy0wLjA3LDAuMS0wLjExYzEuNDItMS42MywyLjE1LTMuNTMsMi4yNS01LjY4QzI5LjAxLDguNzksMjguOTUsOC4xMywyOC44Myw3LjQ3eg0KCQkgTTI1LjQ5LDEwLjljLTAuMjgsMC44OC0wLjc2LDEuNjQtMS4zOSwyLjMxYy0wLjA3LDAuMDctMC4xNCwwLjE1LTAuMjEsMC4yMWMtMC4wNSwwLjA1LTAuMDcsMC4xLTAuMDcsMC4xN2MwLDAuMjYsMCwwLjUzLDAsMC43OQ0KCQljMCwyLjI1LDAsNC41LDAsNi43NWMwLDAuMjUtMC4wMywwLjQ5LTAuMTMsMC43MmMtMC4yMiwwLjQ5LTAuNjEsMC43Ni0xLjEzLDAuODRjLTAuMTIsMC4wMi0wLjI0LDAuMDItMC4zNywwLjAyDQoJCWMtMS43MiwwLTMuNDQsMC01LjE2LDBjLTAuMDksMC0wLjE5LDAtMC4yOSwwYy0wLjA5LTAuMDEtMC4xNSwwLjAyLTAuMjEsMC4wOWMtMC4zOSwwLjQtMC43OSwwLjgtMS4xOSwxLjINCgkJYy0wLjM3LDAuMzctMC43NCwwLjc1LTEuMTIsMS4xMWMtMC44NywwLjg0LTEuODksMS4zOC0zLjA5LDEuNThjLTIuNDksMC40MS00LjkxLTAuNzItNi4xMy0yLjg5Yy0wLjM5LTAuNjgtMC42MS0xLjQyLTAuNzItMi4yDQoJCWMtMC4xMS0wLjgyLTAuMDYtMS42NCwwLjE5LTIuNDNjMC4yNS0wLjgsMC42Ni0xLjUsMS4yLTIuMTNjMC4xMy0wLjE1LDAuMjctMC4zLDAuNDEtMC40NGMwLjA2LTAuMDYsMC4wOS0wLjEzLDAuMDktMC4yMQ0KCQljMC0xLjY2LDAtMy4zMywwLTQuOTljMC0wLjc1LDAtMS41MSwwLTIuMjZjMC0wLjE3LTAuMDEtMC4zNCwwLTAuNWMwLjA2LTAuNjYsMC41NS0xLjIsMS4yLTEuMzFDNy41OCw3LjI3LDcuNzksNy4yOCw4LDcuMjgNCgkJYzAuODEsMCwxLjYyLDAsMi40NCwwYzAsMCwwLDAsMCwwYzAuOTMsMCwxLjg3LDAsMi44LDBjMC4xLDAsMC4xNy0wLjAzLDAuMjQtMC4xYzAuNzctMC43NywxLjU0LTEuNTUsMi4zMi0yLjMyDQoJCWMwLjktMC44OCwxLjk4LTEuMzksMy4yMi0xLjU3YzIuNTgtMC4zNyw0Ljk4LDAuOTgsNi4wOCwzLjE0YzAuMzMsMC42NSwwLjUyLDEuMzMsMC42MSwyLjA1QzI1LjgsOS4zMSwyNS43NCwxMC4xMSwyNS40OSwxMC45eiIvPg0KCTxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0yMS44MSwyMC41NmMwLTIuNDIsMC00Ljg0LDAtNy4yN2MwLTIuNDEsMC00LjgzLDAtNy4yNGMwLTAuMDUsMC0wLjA5LDAtMC4xNGMwLTAuMTUtMC4wNC0wLjE5LTAuMTktMC4xOQ0KCQljLTAuODMsMC0xLjY3LDAtMi41LDBjLTAuMTQsMC0wLjIsMC4wNi0wLjIxLDAuMTljMCwwLjA0LDAsMC4wOCwwLDAuMTJjMCwxLjA4LDAsMi4xNywwLDMuMjVjMCwwLjA1LDAsMC4xLDAsMC4xNQ0KCQljLTAuMDEsMC4xLTAuMDcsMC4xMy0wLjE1LDAuMDdjLTAuMDUtMC4wMy0wLjA5LTAuMDctMC4xMy0wLjExQzE4LjQ0LDkuMjQsMTguMjQsOS4xMiwxOCw5LjA3Yy0wLjY5LTAuMTYtMS4zLTAuMDEtMS44MSwwLjUNCgkJYy0wLjI1LDAuMjUtMC40MywwLjU2LTAuNTYsMC45Yy0wLjI1LDAuNjQtMC4zNSwxLjMxLTAuMzUsMS45OGMtMC4wMSwxLjYxLTAuMDEsMy4yMSwwLDQuODJjMCwwLjUzLDAuMDUsMS4wNSwwLjE2LDEuNTcNCgkJYzAuMDksMC40MSwwLjIxLDAuODIsMC40NCwxLjE4YzAuMywwLjQ5LDAuNzEsMC44LDEuMywwLjg2YzAuNDcsMC4wNSwwLjkyLTAuMDQsMS4zMi0wLjMyYzAuMDYtMC4wNCwwLjEyLTAuMDksMC4xOC0wLjEyDQoJCWMwLjA5LTAuMDUsMC4xMi0wLjA1LDAuMTgsMC4wNGMwLjA2LDAuMDksMC4xMiwwLjE4LDAuMTcsMC4yOGMwLjA2LDAuMSwwLjEzLDAuMTQsMC4yNSwwLjE0YzAuNzYtMC4wMSwxLjUyLDAsMi4yNywwDQoJCWMwLjAzLDAsMC4wNiwwLDAuMSwwYzAuMDktMC4wMSwwLjE1LTAuMDYsMC4xNi0wLjE2QzIxLjgxLDIwLjY3LDIxLjgxLDIwLjYyLDIxLjgxLDIwLjU2eiBNMTguNzUsMTcuNzYNCgkJYy0wLjA0LDAuMDQtMC4wOCwwLjA3LTAuMTMsMC4wOWMtMC4xNiwwLjA3LTAuMzItMC4wMS0wLjM2LTAuMThjLTAuMDItMC4wOS0wLjAzLTAuMTktMC4wMy0wLjI4YzAtMC43OSwwLTEuNTksMC0yLjM4DQoJCWMwLTAuOCwwLTEuNiwwLTIuMzljMC0wLjA5LDAuMDEtMC4xOCwwLjAzLTAuMjdjMC4wNi0wLjI1LDAuMjktMC4zMiwwLjQ4LTAuMTRjMC4xLDAuMDksMC4xNSwwLjIxLDAuMTYsMC4zNWMwLDAuMDQsMCwwLjA4LDAsMC4xMg0KCQljMCwxLjU1LDAsMy4xMSwwLDQuNjZDMTguOTEsMTcuNSwxOC44NywxNy42NSwxOC43NSwxNy43NnoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTQuNywxMy4yNWMwLTAuNDItMC4wMS0wLjg0LTAuMDQtMS4yNmMtMC4wMi0wLjQ3LTAuMTEtMC45NC0wLjI1LTEuMzljLTAuMTEtMC4zNi0wLjI2LTAuNjktMC41MS0wLjk5DQoJCWMtMC4yMi0wLjI3LTAuNDktMC40Ni0wLjgzLTAuNTRjLTAuNTMtMC4xNC0xLjA0LTAuMDYtMS41MiwwLjIxYy0wLjA3LDAuMDQtMC4xMywwLjA5LTAuMiwwLjE0Yy0wLjE1LDAuMTEtMC4xOSwwLjEtMC4yOS0wLjA1DQoJCWMtMC4wNS0wLjA4LTAuMS0wLjE1LTAuMTQtMC4yM0MxMC44OSw5LjA0LDEwLjgyLDksMTAuNzEsOUM5Ljk0LDkuMDEsOS4xOCw5LDguNDIsOWMtMC4wMywwLTAuMDUsMC0wLjA4LDANCgkJYy0wLjEsMC4wMS0wLjE2LDAuMDctMC4xNiwwLjE3YzAsMC4wNSwwLDAuMTEsMCwwLjE2YzAsMi4zNiwwLDQuNzMsMCw3LjA5YzAsMi4zOSwwLDQuNzcsMCw3LjE2YzAsMC4yNSwwLjA2LDAuMjcsMC4yOCwwLjI3DQoJCWMwLjc4LDAsMS41NywwLDIuMzUsMGMwLjAzLDAsMC4wNiwwLDAuMSwwYzAuMTEtMC4wMSwwLjE2LTAuMDYsMC4xNy0wLjE3YzAtMC4wNSwwLTAuMDksMC0wLjE0YzAtMC45OCwwLTEuOTUsMC0yLjkzDQoJCWMwLTAuMDQtMC4wMS0wLjA4LDAtMC4xMmMwLjAxLTAuMDUsMC4wMi0wLjEzLDAuMDYtMC4xNWMwLjA2LTAuMDQsMC4xLDAuMDMsMC4xNSwwLjA3YzAuNDksMC40NSwxLjA2LDAuNTYsMS42OSwwLjM5DQoJCWMwLjUtMC4xNCwwLjg2LTAuNDcsMS4xMy0wLjkxYzAuMzEtMC41MSwwLjQ1LTEuMDgsMC41My0xLjY3YzAuMDYtMC40NSwwLjA3LTAuODksMC4wNy0xLjM0QzE0LjcsMTUuNjcsMTQuNzEsMTQuNDYsMTQuNywxMy4yNXoNCgkJIE0xMS43NCwxNy4zM2MwLDAuMDgtMC4wMSwwLjE3LTAuMDMsMC4yNWMtMC4wNiwwLjE5LTAuMjYsMC4yNS0wLjQzLDAuMTNjLTAuMTQtMC4xLTAuMTktMC4yNS0wLjItMC40MWMwLTAuMDQsMC0wLjA3LDAtMC4xMQ0KCQljMC0xLjU1LDAtMy4xLDAtNC42NWMwLTAuMTUsMC4wMy0wLjI5LDAuMTMtMC40MWMwLjA3LTAuMDgsMC4xNS0wLjEyLDAuMjUtMC4xM2MwLjEyLTAuMDEsMC4yMywwLjA1LDAuMjYsMC4xNw0KCQljMC4wMiwwLjA3LDAuMDMsMC4xNCwwLjAzLDAuMjFjMCwwLjgzLDAsMS42NiwwLDIuNDlDMTEuNzQsMTUuNywxMS43NCwxNi41MSwxMS43NCwxNy4zM3oiLz4NCjwvZz4NCjwvc3ZnPg==";

			add_menu_page( 'Woocommerce Tracking Order', 'Tracking Order', 'manage_options', $this->plugin_uri, [$this, 'options_page_cb'], $icon_url );
		}

		public function options_page_cb() {

			require $this->admin_path( 'settings.php' );
		}

		public function all_fields() {

			return [
				'pd_woo_tracking_details_visiblity' => 'Track Order Visibility',
				'pd_woo_track_order_carrier_name' => 'Carrier Name',
				'pd_woo_track_order_message' => 'Track Order Message'
			];
		}

		public function admin_settings_page_init() {

			add_settings_section( 'pd_Woo_Tracking_Order_Section', 'Woocommerce Tracking Order', [$this, 'admin_settings_page_section_cb'], $this->plugin_uri );

			foreach ($this->all_fields() as $key => $value) {

				add_settings_field( $key, $value, function() use ($key, $value) {

					switch ($key) {

						case 'pd_woo_tracking_details_visiblity':
						$attr = @get_option( $key, true ) ? 'checked' : '';
						echo '<input type="checkbox" name="'.$key.'" '.$attr.' />';
						echo "<small><i><b>Note:</b> You can set the visibility of the tracking order feature globally.</small>";
						break;

						case 'pd_woo_track_order_carrier_name':
						echo '<input type="text" name="'.$key.'" value="'. @get_option( $key, true ) .'">';
						echo "<small><i><b>Note:</b> You can set the default carrier name for all your shipments in common or you can change it for each order.</small>";
						break;

						case 'pd_woo_track_order_message':
						echo '<textarea rows="7" name="'.$key.'">'. @get_option( $key, true ) .'</textarea>';
						echo '<small><i><b>Note:</b> You can edit this text as you wish, but to show the carrier name, pickup time etc, use this placeholders as it is along with curley braces </i><code>{carrier_name}</code>, <code>{pickup_date}</code>, <code>{tracking_id}</code></small>';
						break;
					}

				}, $this->plugin_uri, 'pd_Woo_Tracking_Order_Section');

				register_setting( $this->plugin_uri, $key );
			}
		}

		public function admin_settings_page_section_cb() {

			echo "<p>Here you can set the default settings of your order tracking system.</p>";
		}

		public function save_order_tracking_details($post_id, $post) {

			/* Verify the nonce before proceeding. */
			if ( !isset( $_POST['pd_woo_tracking_details'] ) )
				return $post_id;

			if ( !wp_verify_nonce( $_POST['pd_woo_tracking_details'], 'pd_woo_tracking_details_nonce' ) )
				return;

			if ( get_post_type( $post ) !== 'shop_order' )
				return;

			$fields = [
				'pd_woo_tracking_details_visiblity' 		=> sanitize_text_field( $_POST['pd_woo_tracking_details_visiblity'] ),
				'pd_woo_track_order_status' 				=> sanitize_text_field( $_POST['pd_woo_track_order_status'] ),
				'pd_woo_track_order_carrier_name' 			=> sanitize_text_field( $_POST['pd_woo_track_order_carrier_name'] ),
				'pd_woo_track_order_carrier_pickup_date' 	=> sanitize_text_field( $_POST['pd_woo_track_order_carrier_pickup_date'] ),
				'pd_woo_track_order_tracking_id' 			=> sanitize_text_field( $_POST['pd_woo_track_order_tracking_id'] )
			];

			update_post_meta( $post_id, '_pd_woo_track_order_meta', $fields );

		}
	}
}