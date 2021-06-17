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
class Wpbc_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpbc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpbc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpbc-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpbc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpbc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpbc-admin.js', array( 'jquery' ), $this->version, true );

	}

	public function add_menu()
  {
      // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
      add_menu_page( "Band Customizer", "Band Customizer", 'manage_options', $this->plugin_name . '-customize', array( $this, 'customizer_page' ),'dashicons-art');
			add_submenu_page( $this->plugin_name . '-customize', 'Fonts', 'Fonts', 'manage_options', $this->plugin_name . '-customize-fonts', array( $this, 'customizer_font_page' ),  null );
			add_submenu_page( $this->plugin_name . '-customize', 'Colors', 'Colors', 'manage_options', $this->plugin_name . '-customize-colors', array( $this, 'customizer_color_page' ),  null );
			add_submenu_page( $this->plugin_name . '-customize', 'Clipart Categories', 'Clipart Categories', 'manage_options', $this->plugin_name . '-customize-clipcats', array( $this, 'customizer_clipcat_page' ),  null );
			add_submenu_page( $this->plugin_name . '-customize', 'Cliparts', 'Cliparts', 'manage_options', $this->plugin_name . '-customize-cliparts', array( $this, 'customizer_clipart_page' ),  null );
  }

	public function customizer_page() {
	}
	public function customizer_font_page() {
		$font = new Wpbc_Font($this->plugin_name, $this->version);
  }
	public function customizer_color_page() {
		$color = new Wpbc_Color($this->plugin_name, $this->version);
  }
	public function customizer_clipcat_page() {
		$clipcat = new Wpbc_Clipcat($this->plugin_name, $this->version);
  }
	public function customizer_clipart_page() {
		$clipart = new Wpbc_Clipart($this->plugin_name, $this->version);
  }

}
