<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Universal
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function universal_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'universal_jetpack_setup' );
