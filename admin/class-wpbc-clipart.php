<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       author@wpbc.com
 * @since      1.0.0
 *
 * @package    Wpbc
 * @subpackage Wpbc/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpbc
 * @subpackage Wpbc/admin
 * @author     Band Customize <author@wpbc.com>
 */
class Wpbc_Clipart {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $slug;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->slug = $plugin_name.'-customize-cliparts';
		$this->run();
	}


	public function run() {
		$action = $_REQUEST['action']??NULL;

			switch ($action) {
				case 'add':
					include( plugin_dir_path( __FILE__ ) . 'partials/cliparts/'.$this->plugin_name.'-admin-clipart-add.php' );
				break;
				case 'edit':
					include( plugin_dir_path( __FILE__ ) . 'partials/cliparts/'.$this->plugin_name.'-admin-clipart-add.php' );
				break;
				case 'store':
					$this->store();
				break;
				case 'update':
					$this->update();
				break;
				case 'delete':
					$this->delete();
				break;

				default:
					include( plugin_dir_path( __FILE__ ) . 'partials/cliparts/'.$this->plugin_name.'-admin-clipart-display.php' );
				break;
			}
  }

	public function store() {

		if ( ! empty( $_REQUEST ) && check_admin_referer( 'add-clipart' ) ) {

			global $wpdb;
			$table_name = $wpdb->prefix . "bc_clips";

			$clipart_name = sanitize_text_field( $_REQUEST['clipart_name'] );
			$cat_id = sanitize_text_field( $_REQUEST['cat_id'] );
			$clipart_id = sanitize_text_field( $_REQUEST['clipart_id'] );
			$status = sanitize_text_field( $_REQUEST['status'] );
			$insert = $wpdb->insert($table_name,compact("clipart_name","clipart_id","cat_id","status"));
			if($insert===false) {
				$url = admin_url("admin.php?page={$this->slug}&data-error");
				wp_redirect($url); exit(0);
			} else {
				$url = admin_url("admin.php?page={$this->slug}&data-success");
				wp_redirect($url); exit(0);
			}
		}
	}
	public function update() {
		if ( ! empty( $_REQUEST ) && check_admin_referer( 'update-clipart' ) ) {

			global $wpdb;
			$table_name = $wpdb->prefix . "bc_clips";

			$clipart_name = sanitize_text_field( $_REQUEST['clipart_name'] );
			$cat_id = sanitize_text_field( $_REQUEST['cat_id'] );
			$clipart_id = sanitize_text_field( $_REQUEST['clipart_id'] );
			$status = sanitize_text_field( $_REQUEST['status'] );
			$updated = $wpdb->update( $table_name, compact("clipart_name","clipart_id","cat_id","status"), [ 'id' => $_REQUEST['clip_id'] ] );
			if ( false === $updated ) {
				$url = admin_url("admin.php?page={$this->slug}&data-error");
				wp_redirect($url); exit(0);
			} else {
				$url = admin_url("admin.php?page={$this->slug}&data-success");
				wp_redirect($url); exit(0);
			}
		}
	}
	public function delete() {
		global $wpdb;
		$table_name = $wpdb->prefix . "bc_clips";

		$updated = $wpdb->delete( $table_name, [ 'id' => $_REQUEST['clip_id'] ] );
		if ( false === $updated ) {
			$url = admin_url("admin.php?page={$this->slug}&data-error");
			wp_redirect($url); exit(0);
		} else {
			$url = admin_url("admin.php?page={$this->slug}&data-deleted");
			wp_redirect($url); exit(0);
		}

	}

}
