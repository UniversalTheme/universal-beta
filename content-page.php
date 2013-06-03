<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Universal
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php if ( has_post_thumbnail() ) : // Featured Image ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail(); ?>
			</a>
		<?php endif; ?>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'universal' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'universal' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-<?php esc_html( the_ID() ); ?> -->
