<?php
/**
 * @package cl-pf-boost
 * @version 1.0
 */
/*
Plugin Name: Creative Little Performance Boost

Description: Gives a little performance boost to your wordpress site by stripping queried strings from static resource urls, removing unused scripts, and cleaning up script tags.
Author: Creative Little Developer
Version: 1.0
*/

function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}

function clean_script_tag($input) {
    
    $input = str_replace("type='text/javascript' ", '', $input);
    
    return str_replace("'", '"', $input);
    
}

function remove_cssjs_ver( $src ) {

    if( strpos( $src, '?ver=' ) ) {
    
        $src = remove_query_arg( 'ver', $src );
    
    }
        
    return $src;
    
}


add_action( 'wp_footer', 'my_deregister_scripts' );

add_filter( 'script_loader_tag', 'clean_script_tag' );

add_filter( 'style_loader_src', 'remove_cssjs_ver' );

add_filter( 'script_loader_src', 'remove_cssjs_ver' );


remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

?>
