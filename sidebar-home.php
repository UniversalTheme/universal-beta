<?php
/**
 * The Sidebar containing the home widget areas.
 *
 * @package Universal
 * @since Universal 1.0
 */
?>
<?php
	if ( ! is_active_sidebar( 'home-sidebar' )
	)
	return;
?>
<div id="home-sidebar" class="widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>

	<?php if (is_active_sidebar('home-sidebar')) : ?>

	<?php dynamic_sidebar('home-sidebar'); ?>

	<?php endif; //end of home-sidebar ?>

</div><!-- #home-sidebar .widget-area -->