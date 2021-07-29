<?php
namespace batlz_aawpobf;

function get_plugin_version(){

	if ( ! function_exists( 'get_plugins' ) ) require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    $plugin_folder 	= get_plugins( '/' . plugin_basename( BATLZ_AAWPOBF_DIR ) );
	$plugin_file 	= basename( BATLZ_AAWPOBF_LOADER );
    $version 		= $plugin_folder[$plugin_file]["Version"];

	return $version;

}
