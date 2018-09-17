<?php

if( have_rows('event_episode_items') ):

    while ( have_rows('event_episode_items') ) : the_row(); ?>


        <?php
	        if( get_row_layout() == 'event_episode_video' ):

	        	$iframe = get_sub_field('episode_video_item');

	        	preg_match('/src="(.+?)"/', $iframe, $matches);
	        	$src = $matches[1];


	        	$params = array(
	        	    'rel'    => 0,
	        	    'showinfo'    => 0
	        	);

	        	$new_src = add_query_arg($params, $src);

	        	$iframe = str_replace($src, $new_src, $iframe);
		?>
			<section class="event-episode-item event-episode-video sequence-margin-first sequence-margin-last">
				<div class="column-limit">
					<div class="video-container">
						<?php echo $iframe; ?>
					</div>
				</div>
			</section>


		<?php
	        elseif( get_row_layout() == 'event_episode_title' ):
        ?>	
        	<?php if( get_post_type() === 'past' ): ?>

        		<section class="sequence-margin-first sequence-margin-last">

        			<div class="column-limit">
        				<div class="type-limit">

        					<div class="category-margin-20 h1-margin-5 type-center">
        						<div class="type-category">Film Series</div>
        						<h1>
        							<?php the_sub_field('episode_title_detail'); ?>
        						</h1>
        						<div class="type-details">
        							<?php the_sub_field('episode_title_date'); ?>
        						</div>
        					</div>

        				</div>
        			</div>
        		</section>

        	<?php else: ?>

				<section class="sequence-margin-first sequence-margin-last">

					<div class="column-limit">
						<div class="type-limit">

							<div class="category-margin-20 h1-margin-5 type-center sequence-margin-last">
								<div class="type-category">CONVERSATIONS</div>
								<h1>
									<?php the_sub_field('episode_title_detail'); ?>
								</h1>
								<div class="type-details">
									<span><?php the_sub_field('episode_title_date'); ?></span><span><?php the_sub_field('episode_title_start_time'); ?></span><span><?php the_sub_field('episode_title_location'); ?></span>
								</div>
							</div>
							<?php
								$subject = rawurlencode(get_sub_field('episode_title_detail'));
								$url = rawurlencode(get_permalink());
							?>
							<div class="event-tickets type-center">
								<a href="<?php the_sub_field('episode_title_link'); ?>" class="type-link block-link">GET TICKETS</a>
								<div class="event-social">
									<span><a href="" class="type-link js-share">Share</a>
										<span class="event-social-share js-social-share">
											<a href="https://www.facebook.com/dialog/share?app_id=1160471784117502&href=<?php echo $url; ?>" class="type-link" target="_blank">Facebook</a><br>
											<a href="https://twitter.com/intent/tweet?text=<?php echo $subject; ?>&url=<?php echo $url; ?>" class="type-link" target="_blank">Twitter</a><br>
											<a href="mailto:?subject=<?php echo $subject; ?>&body=<?php echo $url; ?>" class="type-link">Email</a>
										</span>
									</span>
									<span><a href="/addtocalendar/?id=<?php echo get_the_ID(); ?>" class="type-link js-add-calendar">Add to Calendar</a></span>
									<!-- <a href="<?php echo get_feed_link('calendar'); ?>?id=<?php echo get_the_ID(); ?>">New Calendar</a> -->
								</div>
							</div>

						</div>
					</div>
				</section>

			<?php endif; ?>



		<?php
	        elseif( get_row_layout() == 'event_episode_feature' ):

	        	$image = get_sub_field('episode_feature_item');
	        	$size = 'large';
        ?>
        	<section class="event-episode-item event-episode-feature sequence-margin-first sequence-margin-last">
        		<div class="event-episode-feature-item" style="background-image:url('<?php echo $image['sizes'][$size]; ?>)">
        			<div class="event-episode-feature-details type-center color-light">
        				<?php the_sub_field('episode_feature_details'); ?>
        			</div>
        		</div>
        		<a href=""></a>
        	</section>


		<?php
	        elseif( get_row_layout() == 'event_episode_text' ): 
        ?>
			<section class="event-episode-item event-episode-text p-margin-15 sequence-margin-first sequence-margin-last">
				<div class="column-limit">
					<div class="type-limit">
						<?php the_sub_field('episode_text_details'); ?>
					</div>
				</div>
			</section>
			

		<?php
	        elseif( get_row_layout() == 'event_episode_quote' ): 
        ?>
			<section class="event-episode-item event-episode-quote type-center h1-margin-15 sequence-margin-first sequence-margin-last">
				<div class="section-margin-first section-margin-last">
					<div class="column-limit">
						<div class="type-limit">
							<h1>
								<?php the_sub_field('episode_quote_detail'); ?>
							</h1>
							<div class="type-category"><?php the_sub_field('episode_quote_author'); ?></div>
						</div>
					</div>
				</div>
			</section>


        <?php
	        elseif( get_row_layout() == 'event_episode_gallery' ): 

	        	$images = get_sub_field('episode_gallery_items');
	        	$size = 'large'; // (thumbnail, medium, large, full or custom size)
        ?>
        	<?php if( $images ): ?>

        		<?php if( count($images) > 1 ): ?>

					<section class="event-episode-item event-episode-gallery sequence-margin-first sequence-margin-last">
						<div class="column-limit">
							<div class="event-episode-gallery-items js-gallery">
								<?php foreach( $images as $image ): ?>
									<div class="event-episode-gallery-item">
										<img src="<?php echo $image['sizes'][$size]; ?>" alt="">
									</div>
								<?php endforeach; ?>
							</div>
							<div class="event-episode-gallery-count type-center"><p><span class="js-gallery-status"></span>&nbsp;&nbsp;/&nbsp;&nbsp;<span class="js-gallery-total"></span></p></div>
						</div>
					</section>
				
				<?php else: ?>

					<section class="event-episode-item sequence-margin-first sequence-margin-last">
						<div class="column-limit">
							<div class="hero-standard">
								<?php foreach( $images as $image ): ?>
									<img src="<?php echo $image['sizes'][$size]; ?>" alt="">
								<?php endforeach; ?>
							</div>
						</div>
					</section>

				<?php endif; ?>

			<?php endif; ?>


        <?php
	        elseif( get_row_layout() == 'event_episode_bio' ): 
        ?>
        	<?php
        		if( have_rows('episode_bio_items') ):

			?>
					<section class="event-episode-item event-episode-bio sequence-margin-first sequence-margin-last">

						<div class="column-limit">
							<div class="type-limit">

        		    <?php

        		    while ( have_rows('episode_bio_items') ) : the_row(); 

        		    	$image = get_sub_field('episode_bio_item');
    		    	?>

						<div class="events-bio sequence-margin-last">

							<div class="row">

								<div class="events-bio-portrait-col">
									<div class="events-portrait events-bio-portrait" style="background-image:url('<?php echo $image['sizes']['thumbnail']; ?>')"></div>
								</div>

								<div class="events-bio-text-col category-margin-20 p-margin-10">
									<div class="type-category"><?php the_sub_field('episode_bio_type'); ?></div>
									<p class="type-bio">
										<b><?php the_sub_field('episode_bio_name'); ?></b><br>
										<?php the_sub_field('episode_bio_title'); ?>
									</p>
									<?php the_sub_field('episode_bio_details'); ?>
								</div>

							</div>

						</div>


			            <!-- <div class="events-bio">

			                <div class="row">

			                    <div class="events-bio-portrait-col">
			                        <div class="events-portrait events-bio-portrait" style="background-image:url('images/kristen-bio.jpg')"></div>
			                    </div>

			                    <div class="events-bio-text-col category-margin-20 p-margin-10">
			                        <div class="type-category">guest</div>
			                        <p class="type-bio">
			                            <b>Kristin Stewart</b><br>
			                            Actor
			                        </p>
			                        <p>
			                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo.
			                        </p>
			                    </div>

			                </div>

			            </div> -->

        			<?php

	        		endwhile; ?>

	        				</div>
	        			</div>

	        		</section>

				<?php

        		endif;
        	?>


        <?php
	        elseif( get_row_layout() == 'event_episode_winners' ): 
        ?>
        	<?php
        		if( have_rows('episode_winners_items') ):

			?>
					<section class="event-episode-item event-episode-winners sequence-margin-first sequence-margin-last">

						<div class="column-limit">
							<div class="type-limit">

        		    <?php

        		    while ( have_rows('episode_winners_items') ) : the_row(); 

        		    	$image = get_sub_field('episode_winners_item');
    		    	?>

						<div class="events-winners sequence-margin-last">

							<div class="row">

								<div class="events-winners-item-col">
									<div class="events-winners-item" style="background-image:url('<?php echo $image['sizes']['large']; ?>')"></div>
								</div>

								<div class="events-winners-text-col p-margin-10">
									<?php the_sub_field('episode_winners_details'); ?>
								</div>

							</div>

						</div>

        			<?php

	        		endwhile; ?>

	        				</div>
	        			</div>

	        		</section>
			

				<?php

        		endif;
        	?>


		<?php
	        elseif( get_row_layout() == 'event_episode_past' ):

	        	$image = get_sub_field('episode_past_item');
	        	$size = 'large';
        ?>
        	<section class="event-episode-item event-episode-past sequence-margin-first sequence-margin-last">
        		<div class="event-episode-past-item" style="background-image:url('<?php echo $image['sizes'][$size]; ?>')">
        			<div class="event-episode-past-details type-center color-light">
        				<div class="column-limit">
        					<div class="type-limit">
        						<div class="type-feature"><?php the_sub_field('episode_past_details'); ?></div>
        						<a href="/past-events/?q=&q_series=<?php the_sub_field('episode_past_link'); ?>" class="type-link block-link">View More</a>
        					</div>
        				</div>
        			</div>
        		</div>
        		<!-- <a href=""></a> -->
        	</section>


		<?php

        endif;

    endwhile;

else :

endif;

?>