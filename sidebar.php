<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Universal
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>

		<?php echo universal_default_widgets(); ?>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
