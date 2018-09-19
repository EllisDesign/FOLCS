<?php
/**
 * Template part for displaying page content in single-event-series.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('event-episode invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro intro-margin h1-margin-30 p-margin-15 sequence-margin-first-abbreviated sequence-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>
	</div>
</section>


<?php include(get_template_directory() . '/inc/event-episodes.php'); ?>


<?php
	$args = array (
		'post_type'     => array( 'series' ),
		'post_status'   => array( 'publish' ),
		'post__not_in' => array($post->ID),
		'nopaging'      => true,
		'order'         => 'ASC',
		// 'orderby'       => 'menu_order',
	);

	$series = new WP_Query( $args );

	if ( $series->have_posts() ) : ?>

		<section class="event-episode-item event-episode-related type-center h1-margin-30 sequence-margin-first section-margin-last">
			<div class="column-limit">
				<h1>Explore Our Other Series</h1>
				<div class="row event-cards cards-multi-gallery js-multi-gallery">

		<?php 

		while($series->have_posts()) : $series->the_post(); ?>
		
		<div class="col-lg-4 col-sm-12 event-card">
			<div class="event-items">
				<div class="related-item" style="background-image: url('<?php esc_url(the_post_thumbnail_url('thumbnail')); ?>')"></div>
				<h2><?php the_title(); ?></h2>
				<a href="<?php the_permalink(); ?>"></a>
			</div>
		</div>

	<?php
		endwhile; ?>

				</div>
			</div>
		</section>

	<?php

	endif; 

	wp_reset_query();
	// wp_reset_postdata();
?>


</div>