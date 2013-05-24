<?php
/*                                                                                                            
Plugin Name: Pronamic Symlink Fix
Plugin URI: https://github.com/pronamic/wp-pronamic-symlink-fix                                                   
Description: Allows a symlinked folder to be used as the plugins folder.
Version: 1.0.0
Author: Pronamic                                                                                               
Author URI: http://pronamic.eu/                                                                                   
License: GPL2                                                                                                           
*/

function pronamic_symlink_fix( $url, $path, $plugin ) {
	/*
	 * URL normal plugin:
	 * $url = http://example.com/wp-content/plugins/pronamic-symlink-fix/readme.txt
	 * 
	 * URL symlinked plugin:
	 * $url = http://beta.remcotolsma.nl/wp-content/plugins/Users/pronamic/projects/plugins/pronamic-symlink-fix/readme.txt
	 *
	 * $plugin     = /Users/pronamic/Sites/example.com/public_html/wp-content/plugins/pronamic-symlink-fix/pronamic-symlink-fix.php
	 * $plugin_dir = /Users/pronamic/Sites/example.com/public_html/wp-content/plugins/pronamic-symlink-fix/
	 */
	$plugin_dir = plugin_dir_path( $plugin );

	if ( strpos( $url, $plugin_dir ) !== false ) {
		/*
		 * $replace = /Users/pronamic/Sites/example.com/public_html/wp-content/plugins
		 */
		$replace = dirname( $plugin_dir );

		/*
		 * $url = http://example.com/wp-content/plugins/pronamic-symlink-fix/readme.txt
		 */
		$url = str_replace( $replace, '', $url );
	}

	return $url;
}

add_filter( 'plugins_url', 'pronamic_symlink_fix', 10, 3 );
