<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package universal
 */
?>

	</div><!-- #main -->

	<footer id="footer" class="site-footer" role="contentinfo">

	 <?php $options = get_option('universal_theme_options');
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
	 ?>

		<div class="site-info">
			<?php do_action( 'universal_credits' ); ?>
			<?php esc_attr('&copy;'); ?> <?php _e(date('Y')); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"><?php bloginfo('name'); ?></a>
			<a href="<?php echo esc_url('http://universalthe.me/'); ?>" title="<?php esc_attr('Universal Theme'); ?>"><?php printf('Universal Theme'); ?></a>
            <?php esc_attr_e('powered by', 'universal'); ?> <a href="<?php echo esc_url(__('http://wordpress.org/','universal')); ?>" title="<?php esc_attr('WordPress'); ?>"><?php printf('WordPress'); ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>