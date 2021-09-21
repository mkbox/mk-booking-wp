<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mkbox.org
 * @since      1.0.0
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/admin
 * @author     Madelle Kamois <mk@mkbox.org>
 */
class MK_Booking_WP_Admin {

	/**
	 * Required capability tu access admin functionality.
	 * @since    1.0.0
	 * @var      string    REQUIRED_CAPABILITY
	 */
	const REQUIRED_CAPABILITY = 'administrator';

	/**
	 * The ID of this plugin.
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
	 * User_id of currently logged in user.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $user_id
	 */
	private $user_id;

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
		$this->user_id = get_current_user_id();
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
		 * defined in MK_Booking_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MK_Booking_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->mk_booking_wp, plugin_dir_url( __FILE__ ) . 'css/mk-booking-wp-admin.css', array(), $this->version, 'all' );

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
		 * defined in MK_Booking_WP_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The MK_Booking_WP_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->mk_booking_wp, plugin_dir_url( __FILE__ ) . 'js/mk-booking-wp-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Render view.
	 *
	 * @since    1.0.0
	 * @access   private
	 */

	private function render_template( $default_template_path = false, $variables = [], $require = 'once' ) {
		$template_content = '';
		$template_path = locate_template( basename( $default_template_path ) );

		if ( !$template_path ) {
			$template_path = dirname( __DIR__ ).'/admin/'.$default_template_path;
		}
		$template_path = apply_filters( $this->plugin_name.'_template_path', $template_path );

		if ( is_file( $template_path ) ) {
			extract( $variables );
			ob_start();

			if ( $require == 'always' ) {
				require( $template_path );
			} else {
				require_once( $template_path );
			}

			$template_content = apply_filters( $this->plugin_name.'_template_content', ob_get_clean(), $default_template_path, $template_path, $variables );
		} else {
			$template_content = '';
		}

		do_action( $this->plugin_name.'_render_template_post', $default_template_path, $variables, $template_path, $template_content );

		return $template_content;
	}

	/**
	 * Adds pages to the Admin Panel menu
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_settings_pages() {
		add_options_page( $this->plugin_name.' Settings',	__('Booking Settings'), self::REQUIRED_CAPABILITY, 'mk_wpbk_settings', array($this, 'markup_settings_page'));
	}

	/**
	 * Creates the markup for the Settings page
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function markup_settings_page() { 
		if ( current_user_can( self::REQUIRED_CAPABILITY ) ) {
        echo $this->render_template( 'partials/mk-booking-wp-admin-display.php' );
    } else {
        wp_die( __( 'Access denied.' ) );
    }
	}

	/**
	 * Registers settings sections, fields and settings
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_settings() {
		register_setting( 'mk_wpbk_settings','mk_wpbk_settings',	[ $this, 'sanitize_settings' ] ); 

		add_settings_section( 'mk_wpbk_section_import', __( 'Import' ), [ $this, 'markup_section_headers' ], 'mk_wpbk_settings' );

		add_settings_section( 'mk_wpbk_section_constants', __( 'Constants' ), [ $this, 'markup_section_headers' ], 'mk_wpbk_settings' );

		add_settings_section( 'mk_wpbk_section_shortcode', __( 'Shortcodes' ), [ $this, 'markup_section_headers' ], 'mk_wpbk_settings' );

		add_settings_section( 'mk_wpbk_section_schedule', __( 'Schedule' ), [ $this, 'markup_section_headers' ], 'mk_wpbk_settings' );
	}

		/**
	 * Display introduction text to the Settings page
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $section
	 */
	public function markup_section_headers( $section ) {
		switch ( $section[ 'id' ] ) {
			case 'mk_wpbk_section_import':
				echo $this->render_template( 'partials/mk-booking-wp-settings-import-headers.php', [ 'section' => $section ], 'always' );
				break;
			case 'mk_wpbk_section_constants':
				echo $this->render_template( 'partials/mk-booking-wp-settings-const-headers.php', [ 'section' => $section ], 'always' );
				break;
			case 'mk_wpbk_section_schedule':
				echo $this->render_template( 'partials/mk-booking-wp-settings-schedule-headers.php', [ 'section' => $section ], 'always' );
				break;
			case 'mk_wpbk_section_shortcode':
				echo $this->render_template( 'partials/mk-booking-wp-settings-shortcode-headers.php', [ 'section' => $section ], 'always' );
				break;
		
			default: 
				break;
		}
	}

	/**
	 * Validates setting values
	 *
	 * @since    1.0.0
	 * @access   public
	 * @param array $new_settings
	 * @return array
	 */
	public function sanitize_settings( $settings ) { 
		/* $new_settings = shortcode_atts( $this->settings, $settings );

		if (!filter_var($new_settings['endpoint'], FILTER_VALIDATE_URL)) {
			$new_settings['endpoint'] = self::$default_settings['endpoint'];       
		}
		
		return $new_settings; */
		return $settings;
	}

		/**
	 * Update form variables
	 *
	 * @since    1.0.0
	 * @access   private
	 **/
	private function process_form_data() { 

	}

}
