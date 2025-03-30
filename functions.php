<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Remove strandart styles, injection and unused features
 */
function wp_deregister_styles(): void {
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'wp_deregister_styles', 100 );

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'rest_url' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_print_auto_sizes_contain_css_fix', 1 );
remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
// Remove Standard end



function voron_empty_theme_setup(): void {

	load_theme_textdomain( 'voron-empty-theme', get_template_directory() . '/languages');

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

    register_nav_menus(
        array(
            'header_nav' => esc_html__( 'Header navigation', 'voron-empty-theme' ),
            'footer_nav' => esc_html__( 'Footer navigation', 'voron-empty-theme' ),
        )
    );

    add_theme_support('html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

    add_theme_support(
        'custom-background',
        apply_filters(
            'voron_empty_theme_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );
}
add_action( 'after_setup_theme', 'voron_empty_theme_setup', 0);


/**
 * Enqueue scripts and styles.
 */
function voron_empty_theme_scripts(): void {
	wp_enqueue_style( 'voron-empty-theme-style', get_template_directory_uri() . '/assets/css/index.css', [], _S_VERSION, 'all' );

	wp_enqueue_script( 'voron-empty-theme-scripts', get_template_directory_uri() . '/assets/js/index.js', [], _S_VERSION, ["strategy" => 'defer', "in_footer" => false] );

//    wp_register_script(); // register but not place to DOM
//    wp_register_style();
}
add_action( 'wp_enqueue_scripts', 'voron_empty_theme_scripts' );

