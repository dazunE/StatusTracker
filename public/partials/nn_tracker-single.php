<?php
/**
 * The template for displaying all single posts.
 *
 * @package gamepress
 */

get_header();

global $post;

?>

<div id="primary" class="content-area">



	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

	<header class="entry-header">
		<?php
			
			the_title( '<h1 class="entry-title">', '</h1>' );
			
		?>
	</header><!-- .entry-header -->

	<div class="post-thumbnail">
		<?php the_post_thumbnail();?>
	</div>

	<div class="entry-meta">
		<span class="posted-on">
			<span class="">Order Date</span>
			<?php echo get_the_date( );?>
		</span>
		<?php nnpress_tracking_status($post->ID);?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			echo get_post_meta( $post->ID, 'nnpress_item_decription', true);
		?>
	</div><!-- .entry-content -->

	</article>

	<?php

	if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

	?>

</div>

<?php

get_footer();


?>


