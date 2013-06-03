<?php

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

if (!function_exists('universal_social_icons')) :

/**
 * Universal Social Icons
 * 
 */
function universal_social_icons() {

	$options = get_option('universal_theme_options');
		echo '<ul class="social-icons">';
			echo $options['twitter_uid'] ? '<li class="social-icon twitter-icon"><a href="' . esc_url( $options['twitter_uid'] ) . '"><i class="icon-twitter"></i></a></li>' : '';
			echo $options['facebook_uid'] ? '<li class="social-icon facebook-icon"><a href="' . esc_url( $options['facebook_uid'] ) . '"><i class="icon-facebook"></i></a></li>' : '';
			echo $options['google_plus_uid'] ? '<li class="social-icon google-plus-icon"><a href="' . esc_url( $options['google_plus_uid'] ) . '"><i class="icon-google-plus"></i></a></li>' : '';
			echo $options['linkedin_uid'] ? '<li class="social-icon linkedin-icon"><a href="' . esc_url( $options['linkedin_uid'] ) . '"><i class="icon-linkedin"></i></a></li>' : '';
			echo $options['youtube_uid'] ? '<li class="social-icon youtube-icon"><a href="' . esc_url( $options['youtube_uid'] ) . '"><i class="icon-youtube"></i></a></li>' : '';
			echo $options['vimeo_uid'] ? '<li class="social-icon vimeo-icon"><a href="' . esc_url( $options['vimeo_uid'] ) . '"><i class="icon-vimeo"></i></a></li>' : '';
			echo $options['instagram_uid'] ? '<li class="social-icon instagram-icon"><a href="' . esc_url( $options['instagram_uid'] ) . '"><i class="icon-instagram"></i></a></li>' : '';
			echo $options['pinterest_uid'] ? '<li class="social-icon pinterest-icon"><a href="' . esc_url( $options['pinterest_uid'] ) . '"><i class="icon-pinterest"></i></a></li>' : '';
			echo $options['yelp_uid'] ? '<li class="social-icon yelp-icon"><a href="' . esc_url( $options['yelp_uid'] ) . '"><i class="icon-yelp"></i></a></li>' : '';
			echo $options['foursquare_uid'] ? '<li class="social-icon foursquare-icon"><a href="' . esc_url( $options['foursquare_uid'] ) . '"><i class="icon-foursquare"></i></a></li>' : '';
			echo $options['rss_uid'] ? '<li class="social-icon mail-icon"><a href="' . esc_url( $options['rss_uid'] ) . '"><i class="icon-mail"></i></a></li>' : '';
			echo $options['rss_uid'] ? '<li class="social-icon rss-icon"><a href="' . esc_url( $options['rss_uid'] ) . '"><i class="icon-rss"></i></a></li>' : '';
		echo '</ul><!-- end of .social-icons -->';

} // end universal_social_icons

endif;