<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Universal
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! This page can&rsquo;t be found.', 'universal' ); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">

					<p><?php _e( 'The URL may be misspelled or the page you are looking for is no longer available.', 'universal' ); ?></p>
					<p><?php printf( __( 'You can return %s or search for the page you were looking for.', 'universal' ),
							sprintf( '<a href="%1$s" title="%2$s">%3$s</a>',
								esc_url( get_home_url() ),
								esc_attr__( 'Home', 'universal' ),
								esc_attr__( 'Home', 'universal' )
							)
						); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .not-found -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>