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
class Wpbc_Font {

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
		$this->slug = $plugin_name.'-customize-fonts';
		$this->run();
	}


	public function run() {
		$action = $_REQUEST['action']??NULL;

			switch ($action) {
				case 'add':
					include( plugin_dir_path( __FILE__ ) . 'partials/fonts/'.$this->plugin_name.'-admin-font-add.php' );
				break;
				case 'edit':
					include( plugin_dir_path( __FILE__ ) . 'partials/fonts/'.$this->plugin_name.'-admin-font-add.php' );
				break;
				case 'store':
					$this->store_font();
				break;
				case 'update':
					$this->update_font();
				break;
				case 'delete':
					$this->delete_font();
				break;

				default:
					include( plugin_dir_path( __FILE__ ) . 'partials/fonts/'.$this->plugin_name.'-admin-font-display.php' );
				break;
			}
  }

	public function store_font() {

		if ( ! empty( $_REQUEST ) && check_admin_referer( 'add-font' ) ) {

			global $wpdb;
			$table_name = $wpdb->prefix . "bc_fonts";

			$font_name = sanitize_text_field( $_REQUEST['font_name'] );
			$font_url = sanitize_text_field( $_REQUEST['font_url'] );
			$status = sanitize_text_field( $_REQUEST['status'] );
			if($wpdb->insert($table_name,compact("font_name","font_url","status"))) {
				$url = admin_url("admin.php?page={$this->slug}&data-success");
				wp_redirect($url); exit(0);
			} else {
				$url = admin_url("admin.php?page={$this->slug}&data-error");
				wp_redirect($url); exit(0);

			}
		}
	}
	public function update_font() {
		if ( ! empty( $_REQUEST ) && check_admin_referer( 'update-font' ) ) {

			global $wpdb;
			$table_name = $wpdb->prefix . "bc_fonts";

			$font_name = sanitize_text_field( $_REQUEST['font_name'] );
			$font_url = sanitize_text_field( $_REQUEST['font_url'] );
			$status = sanitize_text_field( $_REQUEST['status'] );
			$updated = $wpdb->update( $table_name, compact("font_name","font_url","status"), [ 'id' => $_REQUEST['font_id'] ] );
			if ( false === $updated ) {
				$url = admin_url("admin.php?page={$this->slug}&data-error");
				wp_redirect($url); exit(0);
			} else {
				$url = admin_url("admin.php?page={$this->slug}&data-success");
				wp_redirect($url); exit(0);
			}
		}
	}
	public function delete_font() {
		global $wpdb;
		$table_name = $wpdb->prefix . "bc_fonts";

		$updated = $wpdb->delete( $table_name, [ 'id' => $_REQUEST['font_id'] ] );
		if ( false === $updated ) {
			$url = admin_url("admin.php?page={$this->slug}&data-error");
			wp_redirect($url); exit(0);
		} else {
			$url = admin_url("admin.php?page={$this->slug}&data-deleted");
			wp_redirect($url); exit(0);
		}

	}

}
