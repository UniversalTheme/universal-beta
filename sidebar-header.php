<?php
/**
 * The Sidebar containing the Header widget areas.
 *
 * @package Universal
 * @since Universal 1.0
 */
?>
<?php
	if ( ! is_active_sidebar( 'header-sidebar' )
	)
	return;
?>
<div id="header-sidebar" class="widget-area" role="complementary">
	<?php do_action( 'before_sidebar' ); ?>

	<?php if (is_active_sidebar('header-sidebar')) : ?>

	<?php dynamic_sidebar('header-sidebar'); ?>

	<?php endif; //end of header-sidebar ?>

</div><!-- #header-sidebar .widget-area -->