<?php
/**
 * Universal functions and definitions
 *
 * @package Universal
 * @since Universal 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Universal 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 1024; /* pixels */

if ( ! function_exists( 'universal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Universal 1.0
 */
function universal_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Custom Theme Options
	 */
	require( get_template_directory() . '/inc/theme-options/theme-options.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Universal, use a find and replace
	 * to change 'universal' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'universal', get_template_directory() . '/languages' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
        add_editor_style();

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'top-menu'		=> __( 'Top Menu', 'universal' ),
		'primary'		=> __( 'Primary Menu', 'universal' ),
		'footer-menu'	=> __( 'Footer Menu', 'responsive' )
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video', 'audio' ) );

	/**
	 * Add theme support for infinite scroll
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content'
	) );

	/**
	 * This feature allows users to use custom background for a theme.
	 * http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Background
	 */
	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) {
			
        add_theme_support('custom-background');
		
		} else {
		
	// < 3.4 Backward Compatibility
		
	/**
         * This is a old feature allows users to use custom background for a theme.
         * @see http://codex.wordpress.org/Function_Reference/add_custom_background
         */
		
        add_custom_background();

	}

}
endif; // universal_setup
add_action( 'after_setup_theme', 'universal_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Universal 1.0
 */
function universal_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Header Sidebar', 'universal' ),
		'id' => 'header-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget-wrapper %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'universal' ),
		'id' => 'main-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget-wrapper %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Home Sidebar', 'universal' ),
		'id' => 'home-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget-wrapper %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'universal_widgets_init' );

/**
 * Allow shortcodes in text widgets
 *
 * @since Universal 1.0
 */
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

/**
 * Allow shortcodes in excerpts
 *
 * @since Universal 1.0
 */
add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

/**
 * Enqueue scripts and styles
 */
function universal_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font/font-awesome.css', true );

	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), '20121118', true );

	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '20121118', true );

	wp_enqueue_script( 'universal-scripts', get_template_directory_uri() . '/js/universal-scripts.js', array( 'jquery' ), '20121118', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'universal_scripts' );

/**
 * Apply styles to the visual editor
 * Specifically Font Awesome
 */
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {
    if ( !empty($url) )
        $url .= ',';
    // Retrieves the plugin directory URL and adds editor stylesheet
    $url .= trailingslashit( get_template_directory_uri() ) . '/font/font-awesome.css';
    return $url;
}

/**
 * This function removes WordPress generated category and tag atributes.
 * For W3C validation purposes only.
 * 
 */
function responsive_category_rel_removal ( $output ) {
	$output = str_replace( ' rel="category tag"', '', $output );
	return $output;
}

add_filter('wp_list_categories', 'responsive_category_rel_removal');
add_filter('the_category', 'responsive_category_rel_removal');

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );