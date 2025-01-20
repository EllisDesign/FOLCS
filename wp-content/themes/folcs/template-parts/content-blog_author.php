<?php
/**
 * Template part for displaying page content in single-author.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('page-author past-events invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<div class="event-episode">

<section class="event-episode-item event-episode-bio sequence-margin-first sequence-margin-last">

	<div class="column-limit">
		<div class="type-limit">
	
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
			</div>

		</div>

	</div>

		</div>
	</div>

</section>


<?php

$blog_query = new WP_Query(

	array(
		'post_type'     => array( 'blog' ),
		'post_status'   => array( 'publish' ),
		'posts_per_page'=> -1,
		'nopaging'      => true,
		'meta_query' => array(
			array(
				'key' => 'blog_author', // name of custom field
				'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
				'compare' => 'LIKE'
			)
		)
	)
);

?>

<section class="past-events section-margin-last">
	<div class="column-limit">

	<?php if ( $blog_query->have_posts() ) : ?>

		<div class="row event-cards category-margin-5 h2-margin-2">

		<?php

		foreach ( $blog_query->posts as $post ) :

			setup_postdata( $post ); ?>


				<?php
				
    	        if( have_rows('event_episode_items') ):

    	            while ( have_rows('event_episode_items') ) : the_row(); ?>
    					
    					<?php
    				        if( get_row_layout() == 'event_episode_title' ):

    				        	$date = get_sub_field('episode_title_date');
    							$title = get_sub_field('episode_title_detail');
    			        ?>

			        <?php

			        		endif;

			        endwhile;

			    else :

			    endif;

			    ?>

				<div class="col-lg-4 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<a href="<?php the_permalink(); ?>" class="h2-has-hover"></a>
						<div class="event-item" style="background-image: url('<?php esc_url(the_post_thumbnail_url('thumbnail_cropped')); ?>')"></div>
						<div class="event-details">
							<div class="type-category"><?php $term_list = wp_get_post_terms($post->ID, 'blog-taxonomy', array( 'fields' => 'names' ));if ($term_list) { echo $term_list[0];} ?></div>
							<h2><span><?php echo $title; ?></span></h2>
							<div class="type-qualifier"><?php echo $date; ?></div>
						</div>
					</div>
				</div>


		<?php endforeach; ?>

			<?php wp_reset_postdata(); ?>

		</div>

	<?php endif; ?>

	</div>
</section>

</div>
</div>
