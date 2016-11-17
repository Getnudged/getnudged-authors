<?php
/**
 * Plugin Name: Getnudged Authors
 * Plugin URI:  https://getnudged.de
 * Description: Ein Plugin das Ihnen eine schicke Autorenbox f&uuml;r Ihre Sidebar zur Verf&uuml;gung stellt.
 * Version:     1.0
 * Author:      Getnudged
 * Author URI:  https://getnudged.de
 * License:     MIT License
 * License URI: http://opensource.org/licenses/MIT
 */

/**
 * Define Plugin Dir Path
 */
define( 'G_AUTHORS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin Update Checker from YahnisElsts
 * https://github.com/YahnisElsts
 */
require 'plugin-update-checker/plugin-update-checker.php';
$className = PucFactory::getLatestClassVersion('PucGitHubChecker');
$myUpdateChecker = new $className(
    'https://github.com/Getnudged/getnudged-authors/',
    __FILE__,
    'master'
);

/**
 * Database Functions
 */

// Install Table
function g_authors_install() {
	
	global $wpdb;	
	$table_name = $wpdb->prefix . 'authors';	
	$charset_collate = $wpdb->get_charset_collate();
	
	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		post_id mediumint(9) NOT NULL,
		user text NOT NULL,
		author mediumint(9) NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );	
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'g_authors_install' );

// Truncate Table
function g_author_truncate() {
	global $wpdb;
	$table = $wpdb->prefix . 'authors';
	$delete = $wpdb->query("TRUNCATE TABLE $table");
}
# register_activation_hook( __FILE__, 'g_author_truncate' );

/**
 * Insert and get from table
 *
 * @param $post int Post ID
 * @param $user str Viewers md5 IP
 * @param $author str Authors ID
 * @return $views int View Counter
 */
function g_authors_view_count($post_id, $user, $author_id) {
	
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'authors';	
	
	$check = $wpdb->get_results("SELECT * FROM $table_name WHERE post_id = $post_id AND author = $author_id AND user = '$user';");
	
	if($check == null) { 		
		$wpdb->insert( 
			$table_name, 
			array( 
				'post_id' => $post_id, 
				'user' => $user, 
				'author' => $author_id, 
			)
		);		
	}
	
	$views = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE author = $author_id;");
	
	return $views;
}

/**
 * Load Scripts
 */
function g_authors_enqueue_scripts() 
{
	if( is_single() ) {
		
		// get stylesheet
		wp_enqueue_style( 'g-authors', plugins_url( '/assets/g-authors.css', __FILE__ ) );
		
		// get javascript
		wp_enqueue_script( 'g-authors', plugins_url( '/assets/g-authors.js', __FILE__ ), array('jquery'), '', true );
	}	
}
add_action( 'wp_enqueue_scripts', 'g_authors_enqueue_scripts' );

/**
 * Require Files in Include Folder
 */
foreach ( glob( G_AUTHORS_PATH . "includes/*.php" ) as $file ) {
    include_once $file;
}