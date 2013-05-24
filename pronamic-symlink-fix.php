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
	 * $url = http://beta.remcotolsma.nl/wp-content/plugins/Users/pronamic/projects/pronamic-symlink-fix/readme.txt
	 */
	if ( ! empty( $plugin ) ) {
		/*
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
	}

	return $url;
}

add_filter( 'plugins_url', 'pronamic_symlink_fix', 10, 3 );

function pronamic_symlink_load_textdomain_mofile( $mofile, $domain ) {
	/*
	 * MO file normal plugin:
	 * $mofile = /Users/pronamic/Sites/example.com/public_html/wp-content/plugins/pronamic-symlink-fix/languages/pronamic_symlink_fix-nl_NL.mo
	 *
	 * MO file symlinked plugin:
	 * $mofile = /Users/pronamic/Sites/example.com/public_htm/wp-content/plugins/Users/pronamic/projects/pronamic-symlink-fix/languages/pronamic_symlink_fix-nl_NL.mo
	 */
	if ( ! is_readable( $mofile ) ) {
		$file = str_replace( WP_PLUGIN_DIR, '', $mofile );
		
		if ( is_readable( $file ) ) {
			$mofile = $file;
		}
	}
	
	return $mofile;
}

add_filter( 'load_textdomain_mofile', 'pronamic_symlink_load_textdomain_mofile', 10, 2 );
