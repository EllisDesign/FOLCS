<?php
/**
 * Template part for displaying page content in page-past-events.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<?php

global $post;

$query = isset( $_REQUEST['q'] ) ? sanitize_text_field( $_REQUEST['q'] ) : '';
$query_series = isset( $_REQUEST['qseries'] ) ? sanitize_text_field( $_REQUEST['qseries'] ) : '';

// retrieve our pagination if applicable
$qpage = isset( $_REQUEST['qpage'] ) ? absint( $_REQUEST['qpage'] ) : 1;

if ( ! empty( $query ) && class_exists( 'SWP_Query' ) ) {
	$engine = 'past_events';
	$swp_query = new SWP_Query(
		// see all args at https://searchwp.com/docs/swp_query/
		array(
			's'      => $query,
			'engine' => $engine,
			'posts_per_page' => -1,
			'page'   => $qpage,
		)
	);
	
	$pagination = paginate_links( array(
		'format'  => '?qpage=%#%',
		'current' => $qpage,
		'total'   => $swp_query->max_num_pages,
	) );

}else if( ! empty( $query_series ) ){
	$swp_query = new WP_Query(

		array(
			'post_type'     => array( 'past' ),
			'post_status'   => array( 'publish' ),
			'tax_query'     => array(
				array (
		            'taxonomy' => 'past-taxonomy',
		            'field' => 'slug',
		            'terms' => $query_series,
		        )
		    ),
			'nopaging'      => true,
			'order'         => 'ASC'
		)
	);
}

?>

<body <?php body_class('page-past-events past-events invert'); ?>>
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
				
		<div class="row past-events-search">

			<div class="col-lg-8 col-sm-12 past-events-search-field past-events-search-item">

				<form role="search" method="get" id="searchform" action="<?php echo esc_html( get_permalink() ); ?>">
					<input type="text" placeholder="Search" class="type-placeholder" name="q" id="s" value="<?php if ( ! empty( $query ) ){ echo $query; } ?>">
					<input type="hidden" id="qseries" name="qseries" value="">
				</form>

				
			</div>
			<div class="col-lg-4 col-sm-12 past-events-search-item">
				
				<div class="past-events-search-filter type-link color-light js-filter">
					Filter by Series

					<div class="past-events-search-filter-icon">
						<svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="style-scope more-icon" style="pointer-events: none; display: block; width: 100%; height: 100%;">
							<g class="style-scope more-icon">
						        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" class="style-scope more-icon"></path>
						      </g>
						  </svg>
					</div>
				</div>

			</div>

		</div>

			
			<?php 

			if ( ! empty( $query ) || ! empty( $query_series ) && isset( $swp_query ) && ! empty( $swp_query->posts ) ) { ?>
			
			<div class="past-events-search-count type-center type-section type-light">
				<?php echo count($swp_query->posts); ?> Events
			</div>

			<div class="row event-cards category-margin-5 h2-margin-2 sequence-margin-last">

				<?php

				foreach ( $swp_query->posts as $post ) {
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
								<div class="event-item" style="background-image: url('<?php esc_url(the_post_thumbnail_url('full')); ?>')"></div>
								<div class="event-details">
									<div class="type-category"><?php $term_list = wp_get_post_terms($post->ID, 'past-taxonomy', array( 'fields' => 'names' ));if ($term_list) { echo $term_list[0];} ?></div>
									<h2><span><?php echo $title; ?></span></h2>
									<div class="type-qualifier"><?php echo $date; ?></div>
								</div>
							</div>
						</div>

				<?php

				}
				
				wp_reset_postdata(); 

				?>

				</div>

				<?php

				// pagination
				
				if ( $swp_query->max_num_pages > 1 ) { ?>

					<div class="navigation pagination" role="navigation">
						<!-- <h2 class="screen-reader-text">Posts navigation</h2> -->
						<div class="nav-links">
							<?php echo wp_kses_post( $pagination ); ?>
						</div>
					</div>

				<?php 

				}
			
				?>

			<?php

			}else if( ! empty( $query ) && isset( $swp_query ) ) { ?>
				
				<div class="past-events-search-count type-center type-section type-light">
					<?php echo count($swp_query->posts); ?> Events
				</div>

			<?php

			}else { ?>
				
				<?php 

				$posts = get_field('past_items', 5);

				if( $posts ): ?>

				<div class="past-events-search-count type-center type-section type-light">
					<?php echo count($posts); ?> Events
				</div>

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

			<?php } ?>
		
		<!-- <div class="past-events-search-more type-link type-center block-link is-disabled">
			View More
		</div> -->

	</div>
</section>

</div>

<div class="past-events-search-filters js-filters">
	<ul>
		<li class="js-filter-search" data-filter="conversations">Conversations</li>
		<li class="js-filter-search" data-filter="film-series">Film Series</li>
		<li class="js-filter-search" data-filter="trials-and-error">Trials and Error</li>
		<li class="js-filter-search" data-filter="theater-of-law">Theater of Law</li>
		<li class="js-filter-search" data-filter="law-of-the-land">Law of the land</li>
		<li class="js-filter-search" data-filter="short-film">International Short Film Competition</li>
		<li class="js-filter-search" data-filter="featured">Featured Events</li>
	</ul>
</div>