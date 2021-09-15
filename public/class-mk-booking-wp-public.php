<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/public
 * @author     Your Name <email@example.com>
 */
class MK_Booking_WP_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mk_booking_wp    The ID of this plugin.
	 */
	private $mk_booking_wp;

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
	 * @param      string    $mk_booking_wp       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $mk_booking_wp, $version ) {

		$this->mk_booking_wp = $mk_booking_wp;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in MK_Booking_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MK_Booking_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->mk_booking_wp, plugin_dir_url( __FILE__ ) . 'css/mk-booking-wp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in MK_Booking_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MK_Booking_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->mk_booking_wp, plugin_dir_url( __FILE__ ) . 'js/mk-booking-wp-public.js', array( 'jquery' ), $this->version, false );

	}

}
