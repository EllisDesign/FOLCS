<?php
/**
 * Template part for displaying page content in page-home.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('page-home nav-over nav-over nav-light'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app has-hero">

<section class="hero-video">
	<div class="intro-video" style="background-image:url('')">
		<video muted autoPlay loop playsinline poster="<?php the_field('video_poster'); ?>">
			<source src="<?php the_field('video_mp4'); ?>" type="video/mp4">
			<source src="<?php the_field('video_webm'); ?>" type="video/webm">
		</video>
	</div>
	<div class="type-feature js-opacity">
		<?php 
			$content = get_the_content();
			echo $content;
		?>
	</div>

  <div class="scrolldown js--scrolldown">
      <div class="scrolldown__graphic"></div>
  </div>

</section>

<section id="upcoming-events" class="section-bottom-border section-margin-first js-trigger js-upcoming-events">

	<div class="column-limit">
		<div class="type-limit">
			

				<?php 

				if( get_field('has_upcoming') ): ?>

				<div class="intro sequence-margin-last h1-margin-30 type-center">
					
					<?php the_field('upcoming_details'); ?>

				<?php else: ?>
				
				<div class="intro section-margin-last h1-margin-30 type-center">

					<?php the_field('no_upcoming_details'); ?>

				<?php endif; 

				?>
			</div>
		</div>
	</div>


	<?php

		if( get_field('has_upcoming') ):

		$posts = get_field('upcoming_items');

		if( $posts ): ?>

	<div class="home-events-items category-margin-20 h2-margin-7 p-margin-20 section-margin-last">

		    <?php foreach( $posts as $post): ?>
		        <?php setup_postdata($post); 

		        $term_list = wp_get_post_terms($post->ID, 'upcoming-taxonomy', array( 'fields' => 'names' ));
		        $term = $term_list[0];
		        ?>

		        <?php

		        if( have_rows('event_episode_items') ):

		            while ( have_rows('event_episode_items') ) : the_row(); ?>
						
						<?php
					        if( get_row_layout() == 'event_episode_title' ):

					        	$date = get_sub_field('episode_title_date', false, false);
					        	$date = new DateTime($date);
					        	$date = $date->format('F j');
								$title = get_sub_field('episode_title_detail');
				        ?>

				        <?php
					        elseif( get_row_layout() == 'event_episode_bio' && strtolower($term) !== 'conversations' ): 
				        
				        		if( have_rows('episode_bio_items') ):

				        			$names = array();
				        			$images = array();

				        		while ( have_rows('episode_bio_items') ) : the_row();

				        			$image = get_sub_field('episode_bio_item');
				        			$images[] = $image['sizes']['thumbnail'];

				        			$names[] = get_sub_field('episode_bio_name');

				        		endwhile;

				        			$allnames = 'With ';
				        			$countnames = count($names);

				        			for ($i= 0; $i<$countnames; $i++) {

				        				if($countnames === 1) {
				        					$allnames .= $names[$i];
				        				}else if ($i === $countnames-1) {
	        				                $allnames .= ' and '.$names[$i];
	        				            }else if($i === $countnames-2) {
	        				                $allnames .= $names[$i];
	        				            }else {
	        				                $allnames .= $names[$i].', ';
	        				            }
				        			}

				        			$allimages = array_map(
									   function ($image) {
									      return "<div class=\"events-portrait home-events-portrait\" style=\"background-image:url('{$image}')\"></div>";
									   },
									   $images
									);

									$allportraits = implode('', $allimages);

				        		endif;
							?>

	            		<?php

		                    endif;

	                endwhile;

	            else :

	            endif;

	            ?>
			
				<div class="home-events-item">
					<div class="home-events-hero" style="background-image:url(<?php esc_url(the_post_thumbnail_url('full')); ?>);"></div>
					<a href="<?php the_permalink(); ?>" class="h2-has-hover"></a>
					<div class="row">

						<div class="home-events-details">
							<div class="table">
								<div class="table-row">
									<div class="table-cell">

										<div class="type-category"><?php echo $term; ?></div>
										<div class="h2-qualifier h2-underline">
											<span><?php echo $date; ?></span>
										</div>
										<h2>
											<span><?php echo $title; ?></span>
										</h2>
										<?php if(strtolower($term) !== 'conversations'): ?>
										<p>
											<?php echo $allnames; ?>
										</p>
										<div class="home-events-portraits">
											<?php echo $allportraits; ?>
										</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>

					</div>
					
				</div>

			<?php endforeach; ?>
		    <?php wp_reset_postdata(); ?>

	</div>

	<?php 

		endif; 

		endif; ?>

</section>

<section class="home-past-events section-margin-first section-margin-first-border section-margin-last">

	<div class="column-limit">
		<div class="type-limit">

			<div class="intro sequence-margin-last h1-margin-30 type-center">
				<?php the_field('past_details'); ?>
			</div>

		</div>
		
		<div class="row event-cards category-margin-5 h2-margin-7">

			<?php 

			$posts = get_field('past_items');

			if( $posts ): ?>

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
							<div class="event-item" style="background-image: url('<?php esc_url(the_post_thumbnail_url('thumbnail_cropped')); ?>')"></div>
							<div class="event-details">
								<div class="type-category"><?php $term_list = wp_get_post_terms($post->ID, 'past-taxonomy', array( 'fields' => 'names' ));if ($term_list) { echo $term_list[0];} ?></div>
								<h2><span><?php echo $title; ?></span></h2>
								<div class="type-qualifier"><?php echo $date; ?></div>
							</div>
						</div>
					</div>

					<?php endforeach; ?>
				    <?php wp_reset_postdata(); ?>
				
			<?php endif; ?>

		</div>
	</div>
</section>

</div>
<div class="no-mobile"></div>