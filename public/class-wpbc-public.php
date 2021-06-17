<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       author@wpbc.com
 * @since      1.0.0
 *
 * @package    Wpbc
 * @subpackage Wpbc/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wpbc
 * @subpackage Wpbc/public
 * @author     Band Customize <author@wpbc.com>
 */
class Wpbc_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for enqueue the frontend styles.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpbc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpbc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'fancybox',  'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css', array(), '3.2.5', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpbc-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for enqueue the frontend scripts.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpbc_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpbc_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( 'fancybox',  'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js', array( 'jquery' ), '3.2.5', true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpbc-public.js', array( 'jquery' ), $this->version, true );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {

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

		// add_shortcode('customizer')
		add_shortcode( 'wpbc_customizer', array( $this, 'customizer_function') );

	}

	/**
	 * Shortcode Function
	 */

	public function customizer_function() {
		ob_start();
		include_once(plugin_dir_path( dirname( __FILE__ ) ) . '/public/partials/wpbc-public-display.php');
		return ob_get_clean();
	}

}
