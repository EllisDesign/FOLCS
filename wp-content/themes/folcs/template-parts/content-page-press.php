<?php
/**
 * Template part for displaying page content in page-press.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro h1-margin-30 sequence-margin-first-abbreviated sequence-margin-last section-bottom-border">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>

		<div class="row event-cards press-event-cards category-margin-5 h2-margin-2 h2-limit">

			<?php
				$args = array (
					'post_type'     => array( 'press' ),
					'post_status'   => array( 'publish' ),
					'tax_query' => array(
						array (
				            'taxonomy' => 'press-taxonomy',
				            'field' => 'slug',
				            'terms' => 'featured',
				        )
				    ),
					'nopaging'      => true,
					'order'         => 'ASC',
					// 'orderby'       => 'menu_order',
				);

				$series = new WP_Query( $args );

				if ( $series->have_posts() ) :

				while($series->have_posts()) : $series->the_post(); 

					$press = get_field('press_item');
					$size = 'large';
				?>

				<div class="col-lg-4 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<a href="<?php the_field('press_link'); ?>" target="_blank" class="h2-has-hover"></a>
						<div class="event-item" style="background-image: url('<?php echo $press['sizes'][$size]; ?>')"></div>
						<div class="event-details">
							<div class="type-category"><?php the_field('press_name'); ?></div>
							<h2><span><?php the_field('press_title'); ?></span></h2>
						</div>
					</div>
				</div>

			
				<?php
					endwhile; 

				endif; 

				wp_reset_query();
				// wp_reset_postdata();
			?>
		</div>

	</div>
</section>


<section class="intro h1-margin-30 section-margin-first-border section-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_field('secondary_details'); ?>
		</div>

		<div class="row event-cards press-event-cards category-margin-5 h2-margin-2 sequence-margin-last">

			<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

				$press_args = array (
					'post_type'     => array( 'press' ),
					'post_status'   => array( 'publish' ),
					'tax_query' => array(
						array (
				            'taxonomy' => 'press-taxonomy',
				            'field' => 'slug',
				            'terms' => 'featured',
				            'operator' => 'NOT IN'
				        )
				    ),
					// 'nopaging'      => false,
					'posts_per_page'=> 6,
					'paged' => $paged,
					'order'         => 'ASC',
				);

				$press_query = new WP_Query( $press_args );

				if ( $press_query->have_posts() ) :

				while($press_query->have_posts()) : $press_query->the_post(); 

					$press = get_field('press_item');
					$size = 'large';

				?>

				<div class="col-lg-4 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<a href="<?php the_field('press_link'); ?>" target="_blank" class="h2-has-hover"></a>
						<div class="event-item" style="background-image: url('<?php echo $press['sizes'][$size]; ?>')"></div>
						<div class="event-details">
							<div class="type-category"><?php the_field('press_name'); ?></div>
							<h2><span><?php the_field('press_title'); ?></span></h2>
						</div>
					</div>
				</div>

			
				<?php
					endwhile; ?>

				<?php

				endif; ?>

		</div>
		
		<div class="past-events-search-more type-link type-center block-link misha_loadmore<?php echo ($press_query->max_num_pages > 1 ? '' : ' is-disabled'); ?>">
			View More
		</div>

		<script>
		var current_pagePress = <?php echo $paged ?>,
		    max_pagePress = <?php echo $press_query->max_num_pages ?>
		</script>
		
		<?php

		wp_reset_query();
		// wp_reset_postdata();
		?>
	</div>
</section>

</div>