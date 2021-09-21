<?php

/**
 * Fired during plugin activation
 *
 * @link       https://mkbox.org
 * @since      1.0.0
 *
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    MK_Booking_WP
 * @subpackage MK_Booking_WP/includes
 * @author     Madelle Kamois <mk@mkbox.org>
 */
class MK_Booking_WP_Activator {

	/**
	 * @since	   1.0.0
	 * @var String	TABLE_PREFIX	
	 */
	const TABLE_PREFIX = 'mk_wpbk_';

	/**
	 * Create and seed tables.
	 * 
	 * Call create database tables function and seed them if tables successfully created
	 *
	 * @access   public
	 * @static
	 * @since    1.0.0
	 */
	public static function activate() {
		$res = self::create_tables();
		if ($res === true) {
			self::seed_tables();
		} else {
			wp_die(__("An error occured while creating tables: ").implode(',', $res));
		}
	}

	/**
	 * Create tables.
	 * 
	 * Create next tables: appointments,customers,directions,schedules,mtypes.
	 *
	 * @access   private
	 * @static
	 * @since    1.0.0
	 */
	private static function create_tables() {
		global $wpdb;
		
		/**
		 * import upgrade.php to get dbDelta() function
		 */
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$charset_collate = $wpdb->get_charset_collate();
		$error = false;
		
		/**
		 *  create\update table appointments
		 */
		$table_name = $wpdb->prefix.self::TABLE_PREFIX."appointments";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name ( 
				id int(9) NOT NULL AUTO_INCREMENT,
				customer int(9) NOT NULL,
				address varchar(255) DEFAULT NULL,
				direction int(9) NOT NULL,
				region varchar(255) NOT NULL,
				measure_type varchar(32) DEFAULT NULL,
				measure_start datetime NOT NULL,
				measure_end datetime NOT NULL,
				trademark varchar(64) DEFAULT NULL,
				notes text COLLATE utf8mb4_unicode_520_ci,
				synced int(2) DEFAULT NULL,
				date_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				date_updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				PRIMARY KEY  (id)
			) $charset_collate;";
		if (empty(dbDelta($sql))) $error[] = __("Error creating appointments table");
		
		/**
		 *  create\update table customers
		 */
		$table_name = $wpdb->prefix.self::TABLE_PREFIX."customers";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name ( 
				id int(9) NOT NULL AUTO_INCREMENT,
				name varchar(32) DEFAULT NULL,
				surname varchar(32) DEFAULT NULL,
				middlename varchar(32) DEFAULT NULL,
				phone1 varchar(11) DEFAULT NULL,
				phone2 varchar(11) DEFAULT NULL,
				address varchar(1536) DEFAULT NULL,
				verified int(2) NOT NULL DEFAULT '0',
				code int(6) DEFAULT NULL,
				last_check timestamp NULL DEFAULT NULL,
				PRIMARY KEY  (id)
			) $charcol;";
		if (empty(dbDelta($sql))) $error[] = __("Error creating customers table");

		/**
		 *  create\update table directions
		 */
		$table_name = $wpdb->prefix.self::TABLE_PREFIX."directions";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name ( 
				id int(9) NOT NULL AUTO_INCREMENT,
				name varchar(255) NOT NULL,
				region varchar(255) DEFAULT NULL,
				basedir varchar(16) NOT NULL,
				PRIMARY KEY  (id)
			) $charcol;";
		if (empty(dbDelta($sql))) $error[] = __("Error creating directions table");

		/**
		 *  create\update table schedules
		 */
		$table_name = $wpdb->prefix.self::TABLE_PREFIX."schedules";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name ( 
				id int(9) NOT NULL AUTO_INCREMENT,
				date datetime NOT NULL,
				direction int(9) NOT NULL,
				time_intervals text NOT NULL,
				PRIMARY KEY  (id) 
			) $charcol;";
		if (empty(dbDelta($sql))) $error[] = __("Error creating schedules table");

		/**
		 *  create\update table mtypes
		 */
		$table_name = $wpdb->prefix.self::TABLE_PREFIX."mtypes";
		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
				id int(9) NOT NULL AUTO_INCREMENT,
				name varchar(32) NOT NULL,
				display_name varchar(64) DEFAULT NULL,
				PRIMARY KEY  (id)
			) $charcol;";
		if (empty(dbDelta($sql))) $error[] = __("Error creating mtypes table");

		if (!$error) return true;
		return $error;
	}

	/**
	 * Seed tables.
	 * 
	 * Seed next tables: .

	 * @access   private
	 * @static
	 * @since    1.0.0
	 */
	private static function seed_tables() {
		global $wpdb;

	}


}
