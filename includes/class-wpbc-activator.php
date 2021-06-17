<?php

/**
 * Fired during plugin activation
 *
 * @link       author@wpbc.com
 * @since      1.0.0
 *
 * @package    Wpbc
 * @subpackage Wpbc/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wpbc
 * @subpackage Wpbc/includes
 * @author     Band Customize <author@wpbc.com>
 */
class Wpbc_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_db();
	}

	public static function create_db() {

    global $wpdb;
    $table_name = $wpdb->prefix . "bc_fonts";
    $plugin_name_db_version = get_option( 'plugin-name_db_version', '1.0' );

    if( $wpdb->get_var( "show tables like '{$table_name}'" ) != $table_name ||
        version_compare( $version, '1.0' ) < 0 ) {

        $charset_collate = $wpdb->get_charset_collate();

        $sql[] = "CREATE TABLE " . $wpdb->prefix . "bc_fonts (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            font_name tinytext,
            font_url text,
            status tinyint DEFAULT 1,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        $sql[] = "CREATE TABLE " . $wpdb->prefix . "bc_colors (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            color_name tinytext,
            color_code tinytext,
            status tinyint DEFAULT 1,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        $sql[] = "CREATE TABLE " . $wpdb->prefix . "bc_cat (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            cat_name tinytext,
            cat_image mediumint(9),
            status tinyint DEFAULT 1,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        $sql[] = "CREATE TABLE " . $wpdb->prefix . "bc_clips (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            clipart_name tinytext,
            clipart_id mediumint(9),
            cat_id mediumint(9),
            status tinyint DEFAULT 1,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        /**
         * It seems IF NOT EXISTS isn't needed if you're using dbDelta - if the table already exists it'll
         * compare the schema and update it instead of overwriting the whole table.
         *
         * @link https://code.tutsplus.com/tutorials/custom-database-tables-maintaining-the-database--wp-28455
         */
        dbDelta( $sql );

        add_option( 'plugin-name_db_version', $plugin_name_db_version );

    }

}

}
