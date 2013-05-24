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
	$plugin_dir = plugin_dir_path( $plugin );

	if ( strpos( $url, $plugin_dir ) !== false ) {
		$replace = dirname( $plugin_dir );

		$url = str_replace( $replace, '', $url );
	}

	return $url;
}

add_filter( 'plugins_url', 'pronamic_symlink_fix', 10, 3 );
