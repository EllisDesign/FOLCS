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

$query_series = isset( $_REQUEST['es'] ) ? sanitize_text_field( $_REQUEST['es'] ) : '';

$terms = get_terms( array(
    'taxonomy' => 'past-taxonomy',
    'hide_empty' => false,
) );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

if( ! empty($query_series) && in_array($query_series, array_column($terms, 'slug')) ){

	$past_query = new WP_Query(

		array(
			'post_type'     => array( 'past' ),
			'post_status'   => array( 'publish' ),
			'posts_per_page'=> 12,
			'paged' => $paged,
			'tax_query'     => array(
				array (
		            'taxonomy' => 'past-taxonomy',
		            'field' => 'slug',
		            'terms' => $query_series,
		        )
		    ),
			// 'nopaging'      => true,
			// 'order'         => 'DSC'
		)
	);

	$series = '';
	$series_url = '';

	if($query_series == 'conversations'){
		$series = 'Conversations';
		$series_url = 'conversations';
	}else if($query_series == 'film-series'){
		$series = 'Film Series';
		$series_url = 'film-series';
	}else if($query_series == 'trials-and-error'){
		$series = 'Trials &amp; Error';
		$series_url = 'trials-and-error';
	}else if($query_series == 'film-club'){
		$series = 'Film Club';
		$series_url = 'virtual-film-club';
	}else if($query_series == 'law-of-the-land'){
		$series = 'Law of the Land';
		$series_url = 'law-of-the-land';
	}else if($query_series == 'theater-of-law'){
		$series = 'Theater of Law';
		$series_url = 'theater-of-law';
	}else if($query_series == 'short-film'){
		$series = 'International Short Film Competition';
		$series_url = 'isfc';
	}

}else {

	$series = '';
	$series_url = '';
	
	$past_query = new WP_Query(

		array(
			'post_type'     => array( 'past' ),
			'post_status'   => array( 'publish' ),
			'posts_per_page'=> 12,
			'paged' => $paged,
			// 'nopaging'      => true
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

<section class="past-events-filter">
<div class="column-limit">
<div class="row">
<div class="col-lg-8 col-md-6 col-sm-12">
	<div class="past-events-search-results type-link">
		Displaying <?php echo ($series) ? '<a href="/event-series/'.$series_url.'/">'.$series.'</a>' : 'All <a href="/event-series/">Event Series</a>'; ?>
	</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-12">

	<div class="nav-past-events">
	    <div class="past-events-search-filter type-link color-dark js-past-events">
	        Filter by Event Series

	        <div class="filter-menu-icon">
	            <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false" class="style-scope more-icon" style="pointer-events: none; display: block; width: 100%; height: 100%;">
	                <g class="style-scope more-icon">
	                    <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" class="style-scope more-icon"></path>
	                  </g>
	              </svg>
	        </div>
	    </div>
	    <div class="past-events-search-filters js-past-event-filters">
	        <ul>
	        	<li data-filter="all" class="filter-all">All Event Series</li>
	            <li data-filter="conversations" class="filter-conversations">Conversations</li>
	            <li data-filter="film-series" class="filter-film-series">Film Series</li>
	            <li data-filter="trials-and-error" class="filter-trials-and-error">Trials &amp; Error</li>
	            <li data-filter="film-club" class="filter-film-club">Film Club</li>
	            <li data-filter="law-of-the-land" class="filter-law-of-the-land">Law of the Land</li>
	            <li data-filter="theater-of-law" class="filter-theater-of-law">Theater of Law</li>
	            <li data-filter="short-film" class="filter-short-film"><span class="nowrap">International Short</span> <span class="nowrap">Film Competition</span></li>
	        </ul>
	    </div>
	</div>

</div>
</div>
</div>
</section>

<section class="past-events section-margin-last">
	<div class="column-limit">

	<?php if ( $past_query->have_posts() ) : ?>

		<div class="row event-cards category-margin-5 h2-margin-2">

		<?php

		foreach ( $past_query->posts as $post ) :

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
							<div class="type-category"><?php $term_list = wp_get_post_terms($post->ID, 'past-taxonomy', array( 'fields' => 'names' ));if ($term_list) { echo $term_list[0];} ?></div>
							<h2><span><?php echo $title; ?></span></h2>
							<div class="type-qualifier"><?php echo $date; ?></div>
						</div>
					</div>
				</div>


		<?php endforeach; ?>

		</div>


		<div class="past-events-nav navigation pagination">
		<?php

			$big = 999999999;

			 echo paginate_links( array(
			    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			    'format' => '?paged=%#%',
			    'current' => max( 1, get_query_var('paged') ),
			    'total' => $past_query->max_num_pages,
			    'mid_size' => 1
			) );

		?>

		</div>

			<?php wp_reset_postdata(); ?>

		

	<?php endif; ?>

	</div>
</section>

</div>
