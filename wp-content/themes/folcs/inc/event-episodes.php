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
        	<?php if( get_post_type() === 'past' ): 

	    			$term_list = wp_get_post_terms($post->ID, 'past-taxonomy', array( 'fields' => 'names' ));
	    			$term = $term_list[0];
        		?>

        		<section class="sequence-margin-first sequence-margin-last">

        			<div class="column-limit">
        				<div class="type-limit">

        					<div class="category-margin-20 h1-margin-5 type-center">
        						<div class="type-category"><?php echo $term; ?></div>
        						<h1>
        							<?php echo get_sub_field('episode_title_detail'); ?>
        						</h1>
        						<div class="type-details">
        							<?php echo get_sub_field('episode_title_date'); ?>
        						</div>
        					</div>

        				</div>
        			</div>
        		</section>

        	<?php elseif( get_post_type() === 'blog' ): 

	    			$term_list = wp_get_post_terms($post->ID, 'blog-taxonomy', array( 'fields' => 'names' ));
	    			$term = $term_list[0];
        		?>

        		<section class="sequence-margin-first sequence-margin-last">

        			<div class="column-limit">
        				<div class="type-limit">

        					<div class="category-margin-20 h1-margin-5 type-center">
        						<div class="type-category"><?php echo $term; ?></div>
        						<h1>
        							<?php echo get_sub_field('episode_title_detail'); ?>
        						</h1>
        						<div class="type-details">
        							<?php echo get_sub_field('episode_title_date'); ?>
        						</div>
        					</div>

        				</div>
        			</div>
        		</section>

        	<?php else: 

        			$term_list = wp_get_post_terms($post->ID, 'upcoming-taxonomy', array( 'fields' => 'names' ));
        			$term = $term_list[0];

        		?>

				<section class="sequence-margin-first sequence-margin-last">

					<div class="column-limit">
						<div class="type-limit">

							<div class="category-margin-20 h1-margin-5 type-center"><!-- sequence-margin-last -->
								<div class="type-category"><?php echo $term; ?></div>
								<h1>
									<?php echo get_sub_field('episode_title_detail'); ?>
								</h1>
								<?php if(get_sub_field('episode_title_date') || get_sub_field('episode_title_start_time') || get_sub_field('episode_title_location')): ?>
								<div class="type-details">
									<?php if(get_sub_field('episode_title_date')): ?>
										<span><?php echo get_sub_field('episode_title_date'); ?></span>
									<?php endif; ?>
									<?php if(get_sub_field('episode_title_start_time')): ?>
										<span><?php echo get_sub_field('episode_title_start_time'); ?></span>
									<?php endif; ?>
									<?php if(get_sub_field('episode_title_location')): ?>
										<span><?php echo get_sub_field('episode_title_location'); ?></span>
									<?php endif; ?>
								</div>
								<?php endif; ?>
							</div>
							<?php
								$subject = rawurlencode(get_sub_field('episode_title_detail'));
								$url = rawurlencode(get_permalink());
							?>
							
							<?php if(get_sub_field('episode_title_link')): ?>

							<div class="event-tickets type-center">
								<a href="<?php echo get_sub_field('episode_title_link'); ?>" class="type-link block-link">GET TICKETS</a>
								<div class="event-social">
									<span><a href="" class="type-link js-share">Share</a>
										<span class="event-social-share js-social-share">
											<a href="https://www.facebook.com/dialog/share?app_id=1160471784117502&href=<?php echo $url; ?>" class="type-link" target="_blank">
												<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20">
												<path fill="#FFFFFF" d="M18.8961868,0H1.1038506C0.4942107,0,0,0.4942107,0,1.1038506v17.792305
													C0,19.5057449,0.4940841,20,1.1039487,20h9.5796452v-7.734375H8.0859375V9.2382812h2.5976562V7.01229
													c0-2.5832524,1.5776043-3.9898827,3.8819551-3.9898827c1.103754,0,2.0524511,0.0821829,2.3289824,0.118916v2.6985204
													l-1.5940571,0.0007272c-1.2498684,0-1.4918804,0.595541-1.4918804,1.4694571v1.9282532h2.9977989l-0.3903542,3.0273438h-2.6074448
													V20h5.0875931C19.505806,20,20,19.505806,20,18.8961868V1.1038125C20,0.4941937,19.505806,0,18.8961868,0z"/>
												</svg>
											</a><br>
											<a href="https://twitter.com/intent/tweet?text=<?php echo $subject; ?>&url=<?php echo $url; ?>" class="type-link" target="_blank">
												<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="21px" height="20px" viewBox="0 0 21 20">
												<g>
													<path fill="#FFFFFF" d="M6.6043568,18.0669193c7.9248457,0,12.2585983-6.5654917,12.2585983-12.2585907
														c0-0.1865726-0.003788-0.3722796-0.0123138-0.557004C19.6918163,4.6432061,20.4231129,3.8844173,21,3.0205276
														c-0.772028,0.3429048-1.6027794,0.5740559-2.4742622,0.6782413c0.8894749-0.5332992,1.5724545-1.377306,1.8945351-2.3833151
														c-0.8326588,0.4935251-1.7543488,0.8525075-2.7357121,1.0457832C16.8983212,1.523824,15.7786522,1,14.5396271,1
														c-2.3795443,0-4.3091335,1.9295807-4.3091335,4.3081584c0,0.3381672,0.0378933,0.6669178,0.1117878,0.9823632
														c-3.5806847-0.179987-6.7559271-1.894536-8.8806486-4.5014338C1.091244,2.425648,0.8781103,3.1654696,0.8781103,3.9545488
														c0,1.4947968,0.760662,2.8143444,1.9172751,3.5863128c-0.7066672-0.021739-1.3706955-0.215939-1.9513707-0.5389609
														C0.8430655,7.019877,0.8430655,7.03792,0.8430655,7.0568199c0,2.0868368,1.485322,3.8288546,3.4565833,4.2239151
														c-0.361855,0.098465-0.7426605,0.1515446-1.1357722,0.1515446c-0.2775526,0-0.5475285-0.0274687-0.8099196-0.0777092
														c0.5484695,1.7117186,2.1389339,2.9573803,4.0249443,2.9924755c-1.4748969,1.1556377-3.33249,1.8442955-5.351119,1.8442955
														c-0.3476508,0-0.690556-0.0198917-1.027782-0.0596657C1.906842,17.353632,4.1708264,18.0669193,6.6043568,18.0669193"/>
												</g>
												</svg>
											</a><br>
											<a href="mailto:?subject=<?php echo $subject; ?>&body=<?php echo $url; ?>" class="type-link event-email-link">
												<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28px" height="20px" viewBox="0 0 28 20">
													<polygon fill="#FFFFFF" points="0,2 0,0 28,0 28,2 14,12 "/>
													<polygon fill="#FFFFFF" points="0,4 14,14 28,4 28,20 0,20 "/>
												</svg>
											</a>
										</span>
									</span>
									<span><a href="/addtocalendar/?id=<?php echo get_the_ID(); ?>" class="type-link js-add-calendar">Add to Calendar</a></span>
									<!-- <a href="<?php echo get_feed_link('calendar'); ?>?id=<?php echo get_the_ID(); ?>">New Calendar</a> -->
								</div>
							</div>

							<?php endif; ?>

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
        		<div class="event-episode-feature-item" style="background-image:url('<?php echo $image['sizes'][$size]; ?>')">
        			<div class="event-episode-feature-details type-center color-light">
        				<?php echo get_sub_field('episode_feature_details'); ?>
        			</div>
        		</div>
        		<a href=""></a>
        	</section>


		<?php
	        elseif( get_row_layout() == 'event_episode_text' ):
        ?>
			<section class="event-episode-item event-episode-text h1-margin-30 p-margin-15 sequence-margin-first sequence-margin-last">
				<div class="column-limit">
					<div class="type-limit">
						<?php echo get_sub_field('episode_text_details'); ?>
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
								<?php echo get_sub_field('episode_quote_detail'); ?>
							</h1>
							<div class="type-category"><?php echo get_sub_field('episode_quote_author'); ?></div>
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
									<div class="type-category"><?php echo get_sub_field('episode_bio_type'); ?></div>
									<p class="type-bio">
										<b><?php echo get_sub_field('episode_bio_name'); ?></b><br>
										<?php echo get_sub_field('episode_bio_title'); ?>
									</p>
									<?php echo get_sub_field('episode_bio_details'); ?>
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
									<?php echo get_sub_field('episode_winners_details'); ?>
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
        						<div class="type-feature"><?php echo get_sub_field('episode_past_details'); ?></div>
        						<a href="/past-events/?q=&qseries=<?php echo get_sub_field('episode_past_link'); ?>" class="type-link block-link">View More</a>
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