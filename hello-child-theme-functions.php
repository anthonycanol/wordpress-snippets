<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 */
function hello_elementor_child_enqueue_scripts() {
	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 20 );

function my_custom_scripts() {
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ),'',true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

// add inner class
function inner_body_class( $classes ) {
	if ( ! is_front_page() ) {
		$classes[] = 'inner';
	}
	return $classes;
}
add_filter( 'body_class', 'inner_body_class' );

// function to replace the specific code
function start_modify_html() {
    ob_start();
}
add_action( 'wp_head', 'start_modify_html' );

function end_modify_html() {
    $html = ob_get_clean();
    $year = date('Y');
    $blog_name= get_bloginfo( 'name' );

    $html = str_replace( '{year}', $year, $html );
    $html = str_replace( '{blog-name}', $blog_name, $html );
    echo $html;
}
add_action( 'wp_footer', 'end_modify_html' );
