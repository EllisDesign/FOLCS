<?php
/**
 * Template part for displaying page content in page-author.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<?php

$blog_query = new WP_Query(

	array(
		'post_type'     => array( 'author' ),
		'post_status'   => array( 'publish' ),
		'posts_per_page'=> -1,
		'nopaging'      => true
	)
);

?>

<body <?php body_class('page-author past-events invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro h1-margin-30 type-center p-margin-15 sequence-margin-first-abbreviated sequence-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>
	</div>
</section>

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
