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

		<?php echo universal_social_icons(); ?>

		<?php if ( has_nav_menu( 'top-menu', 'universal' ) ) { 
			wp_nav_menu( array(
				'fallback_cb'    =>  false,
				'menu_class'     => 'top-menu',
				'theme_location' => 'top-menu' )
			); 
		} ?>

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