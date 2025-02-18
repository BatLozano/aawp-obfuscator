<?php
/*
Plugin Name: AAWP Obfuscator
Description: Obfuscate external links from aawp plugin
Version: 1.1
Author: Baptiste Lozano
Copyright 2025 Baptiste Lozano
*/

define( 'BATLZ_AAWPOBF_LOADER'	, __FILE__ );
define( 'BATLZ_AAWPOBF_DIR'		, dirname(__FILE__) );
define( 'BATLZ_AAWPOBF_URL'		, plugins_url('/', __FILE__) );
define( 'BATLZ_AAWPOBF_OBFUSCATE_NUMBER' , 67);

// ===================== Autoloader with namespace  =====================
function batlz_aawpobf_autoloader( $class_name ) {

	if ( false !== strpos( $class_name, 'batlz_aawpobf\\' ) ) {

		$class_name = str_replace("batlz_aawpobf\\", "", $class_name);
		$class_name = str_replace("\\", "/", $class_name);

		$classFile 	= BATLZ_AAWPOBF_DIR . '/src/model/' .$class_name . '.class.php';
		
        if (file_exists($classFile)) require_once $classFile;
        else die("Missing file class : ".$classFile);
	   
	}

}
spl_autoload_register( 'batlz_aawpobf_autoloader' );


// ===================== When all plugins are loaded =====================
function batlz_aawpobf_plugins_loaded(){

	require_once( BATLZ_AAWPOBF_DIR . "/src/functions.php"  );
	new \batlz_aawpobf\obfuscator();
		
}
add_action( 'plugins_loaded', 'batlz_aawpobf_plugins_loaded' );

// ===================== Enqueue JS =====================
function batlz_aawpobf_enqueue_scripts() {

	wp_enqueue_script( 'batlz_aawpobf_front_js', BATLZ_AAWPOBF_URL . 'assets/js/front.js', ['jquery'] , \batlz_aawpobf\get_plugin_version() );
	wp_localize_script( 'batlz_aawpobf_front_js', 'batlz_aawpobf_magic_number', [BATLZ_AAWPOBF_OBFUSCATE_NUMBER] );
    
}
add_action('wp_enqueue_scripts', 'batlz_aawpobf_enqueue_scripts');
