<?php

/**
 *
 * @link              https://mkbox.org/projects/booking-wp
 * @since             1.0.0
 * @package           MK_Booking_WP
 *
 * @wordpress-plugin
 * Plugin Name:       MK Booking WP
 * Plugin URI:        https://mkbox.org/projects/booking-wp
 * Description:       another booking plugin
 * Version:           1.0.0
 * Author:            Madelle Kamois
 * Author URI:        https://mkbox.org/
 * License:           MPL2.0
 * License URI:       https://www.mozilla.org/en-US/MPL/2.0/
 * Text Domain:       mk-booking-wp
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MK_BOOKING_WP_VERSION', '1.0.0' );

function activate_mk_booking_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mk-booking-wp-activator.php';
	MK_Booking_WP_Activator::activate();
}

function deactivate_mk_booking_wp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mk-booking-wp-deactivator.php';
	MK_Booking_WP_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mk_booking_wp' );
register_deactivation_hook( __FILE__, 'deactivate_mk_booking_wp' );

require plugin_dir_path( __FILE__ ) . 'includes/class-mk-booking-wp.php';

function run_mk_booking_wp() {

	$plugin = new MK_Booking_WP();
	$plugin->run();

}
run_mk_booking_wp();