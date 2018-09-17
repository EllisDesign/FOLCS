<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FOLCS
 */

get_header();
?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro sequence-margin-first-abbreviated section-margin-last">

	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-26 ul-margin-26 type-content">
				<h2>That page can't be found.</h2>
				<p>Please try one of the links below.</p>
			</div>
		</div>
	</div>
</section>

<section class="past-events sequence-margin-last">
	
	<div class="column-limit">
	
	<?php 

	$posts = get_field('past_items', 5);

	if( $posts ): ?>

	<div class="row event-cards category-margin-5 h2-margin-2 sequence-margin-last">

	    <?php foreach( $posts as $post): ?>
	        <?php setup_postdata($post); ?>

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
					<div class="event-item" style="background-image: url('<?php esc_url(the_post_thumbnail_url('full')); ?>')"></div>
					<div class="event-details">
						<div class="type-category"><?php $term_list = wp_get_post_terms($post->ID, 'past-taxonomy', array( 'fields' => 'names' ));if ($term_list) { echo $term_list[0];} ?></div>
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


<?php
get_footer();
