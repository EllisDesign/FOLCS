<?php
/**
 * Template part for displaying page content in page-author.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('page-authors past-events invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<?php

$blog_query = new WP_Query(

	array(
		'post_type'     => array( 'blog_author' ),
		'post_status'   => array( 'publish' ),
		'posts_per_page'=> -1,
		'nopaging'      => true,
		'meta_key'		=> 'author_last_name',
		'orderby'		=> 'meta_value',
		'order'			=> 'ASC'
	)
);

?>

<div class="event-episode">

<section class="event-episode-item event-episode-bio sequence-margin-first sequence-margin-last">

	<div class="column-limit">
		<div class="type-limit">


	<?php if ( $blog_query->have_posts() ) : ?>

	<?php

	while( $blog_query->have_posts() ) : $blog_query->the_post(); 

	// foreach ( $blog_query->posts as $post ) :

		// setup_postdata( $post ); 

	?>

	
	<?php $image = get_field('author_portrait'); ?>

	<div class="events-bio sequence-margin-last">

		<div class="row">

			<div class="events-bio-portrait-col author-portrait-col">
				<div class="events-portrait events-bio-portrait author-portrait" style="background-image:url('<?php echo $image['sizes']['thumbnail']; ?>')"></div>
			</div>

			<div class="events-bio-text-col author-text-col category-margin-20 p-margin-10">
				<div class="type-category"><?php echo get_field('author_speaker_type'); ?></div>
				<p class="type-bio">
					<b><?php echo get_field('author_first_name'); ?> <?php echo get_field('author_last_name'); ?></b><br>
					<?php echo get_field('author_title'); ?>
				</p>
				<?php echo get_field('author_bio'); ?>
				<p>
					<a href="<?php the_permalink(); ?>">Posts by <?php echo get_field('author_first_name'); ?></a>
				</p>
			</div>

		</div>

	</div>

	<?php
	endwhile;
	// endforeach;
	?>

	<?php 
	
	// wp_reset_postdata();
	?>

	<?php endif; ?>

	<?php wp_reset_query(); ?>

		</div>
	</div>

</section>

</div>

</div>
