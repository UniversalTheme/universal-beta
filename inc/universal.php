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
 * Universal Social Icons
 * 
 */
if (!function_exists('universal_social_icons')) :

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

/*
 * Universal Default Widgets
 * 
 */
if (!function_exists('universal_default_widgets')) :
function universal_default_widgets() {

	?>
	<aside id="search" class="widget widget_search">
		<?php get_search_form(); ?>
	</aside>

	<aside id="archives" class="widget">
		<h1 class="widget-title"><?php _e( 'Archives', 'universal' ); ?></h1>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</aside>

	<aside id="meta" class="widget">
		<h1 class="widget-title"><?php _e( 'Meta', 'universal' ); ?></h1>
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</aside>
	<?php

} // end universal_default_widgets

endif;


function universal_breadcrumbs() {

	/* === OPTIONS === */
	$text['home']     = 'Home'; // text for the 'Home' link
	$text['category'] = 'Archive by Category "%s"'; // text for a category page
	$text['search']   = 'Search Results for "%s" Query'; // text for a search results page
	$text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
	$text['author']   = 'Articles Posted by %s'; // text for an author page
	$text['404']      = 'Error 404'; // text for the 404 page

	$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
	$show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
	$show_title     = 1; // 1 - show the title for the links, 0 - don't show
	$delimiter      = ' &raquo; '; // delimiter between crumbs
	$before         = '<span class="current">'; // tag before the current crumb
	$after          = '</span>'; // tag after the current crumb
	/* === END OF OPTIONS === */

	global $post;
	$home_link    = home_url('/');
	$link_before  = '<span typeof="v:Breadcrumb">';
	$link_after   = '</span>';
	$link_attr    = ' rel="v:url" property="v:title"';
	$link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
	$parent_id    = $parent_id_2 = $post->post_parent;
	$frontpage_id = get_option('page_on_front');

	if (is_home() || is_front_page()) {

		if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';

	} else {

		echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
		if ($show_home_link == 1) {
			echo sprintf($link, $home_link, $text['home']);
			if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;
		}

		if ( is_category() ) {
			$this_cat = get_category(get_query_var('cat'), false);
			if ($this_cat->parent != 0) {
				$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
			}
			if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;

		} elseif ( is_search() ) {
			echo $before . sprintf($text['search'], get_search_query()) . $after;

		} elseif ( is_day() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, $delimiter);
				if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
				$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
				$cats = str_replace('</a>', '</a>' . $link_after, $cats);
				if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
				echo $cats;
				if ($show_current == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($parent_id);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, $delimiter);
			$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
			$cats = str_replace('</a>', '</a>' . $link_after, $cats);
			if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
			echo $cats;
			printf($link, get_permalink($parent), $parent->post_title);
			if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

		} elseif ( is_page() && !$parent_id ) {
			if ($show_current == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $parent_id ) {
			if ($parent_id != $frontpage_id) {
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					if ($parent_id != $frontpage_id) {
						$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
					}
					$parent_id = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo $delimiter;
				}
			}
			if ($show_current == 1) {
				if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;
				echo $before . get_the_title() . $after;
			}

		} elseif ( is_tag() ) {
			echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

		} elseif ( is_author() ) {
	 		global $author;
			$userdata = get_userdata($author);
			echo $before . sprintf($text['author'], $userdata->display_name) . $after;

		} elseif ( is_404() ) {
			echo $before . $text['404'] . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div><!-- .breadcrumbs -->';

	}
} // end universal_breadcrumbs()