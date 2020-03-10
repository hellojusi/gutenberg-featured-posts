<?php 

/**
 * Plugin Name: Simple Latest Posts Block
 * Plugin URI: https://github.com/hellojusi/gutenberg-latest-posts
 * Description: A simple block for the Gutenberg editor. Display your latest posts with featured images and greater control.
 * Version: 1.0.0
 * Author: Justyna Ratajczak
 * Author URI: https://jusi.codes
 */

// If this file is accessed directly, abort.
defined( 'ABSPATH' ) || exit;


/**
 * Load plugin translations from the /languages/ folder.
 */
function jusi_load_textdomain() {
  load_plugin_textdomain( 'jusi', false, basename( __DIR__ ) . '/languages' );
}
add_action( 'init', 'jusi_load_textdomain' );


/**
 * Add custom block category
 */

function jusi_block_categories( $categories, $post ) {
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'jusi',
        'title' => __( 'Jusi', 'jusi' ),
        'icon' => 'palmtree'
      )
    )
  );
}
add_action( 'block_categories', 'jusi_block_categories', 10, 2 );

/** 
 * Register block assets
 */

function jusi_register_blocks() {

  // Exit if block editor isn't active
  if ( ! function_exists( 'register_block_type' ) ) {
    return;
  }

  // Register the frontend style 
  wp_register_style(
    'jusi-frontend-styles',
    plugins_url( 'build/style.css', __FILE__ ),
    array( ),
    filemtime( plugin_dir_path( __FILE__ ) . 'build/style.css' )
  );

  // Register the block editor style 
  wp_register_style(
    'jusi-editor-styles',
    plugins_url( 'build/style.css', __FILE__ ),
    array( 'wp-edit-blocks' ),
    filemtime( plugin_dir_path( __FILE__ ) . 'build/editor.css' )
  );

  // Register the block editor script
  wp_register_script(
    'jusi-editor-script',
    plugins_url( 'build/index.js', __FILE__ ),
    array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
    filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' )
  );

  // Register the block
  register_block_type( 'jusi/latest-posts', array(
    'style' => 'jusi-frontend-style',
    'editor_style' => 'jusi-editor-style',
    'editor_script' => 'jusi-editor-script'
  ) );

  
}
add_action( 'init', 'jusi_register_blocks' );
