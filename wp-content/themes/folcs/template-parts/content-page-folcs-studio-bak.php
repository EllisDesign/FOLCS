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

	$LOGIN_INFORMATION = array(
	  get_field('password')
	);

	define('LOGOUT_URL', '/folcs-studio');

	define('TIMEOUT_MINUTES', 1);

	$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);

	// if(isset($_POST['logout'])) {
	//   setcookie("verify", '', $timeout, '/');
	//   header('Location: ' . LOGOUT_URL);
	//   exit();
	// }

?>

<body <?php body_class('page-folcs-studio invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

	<!-- <pre>
	<?php 

	print_r($_COOKIE);

	?>
	</pre> -->

		<?php
			$live = get_field('live');
		?>

		<?php
			if($live):
		?>

		<section class="sequence-margin-first sequence-margin-last">

			<div class="column-limit">
				<div class="column-1">

					<div class="h1-margin-30 h2-margin-7 p-margin-26 ul-margin-26 type-content type-center">
						<?php echo get_field('live_text'); ?>
					</div>
				</div>
			</div>
		</section>
		<section class="sequence-margin-last">

			<div class="column-limit">
				<div class="column-1">

					<div class="h1-margin-30 h2-margin-7 p-margin-26 ul-margin-26 type-content type-center">
						<h2>
							<?php echo get_field('episode_title_detail'); ?>
						</h2>
						<?php if(get_field('episode_title_date') || get_field('episode_title_start_time')): ?>
						<div class="type-details">
							<?php if(get_field('episode_title_date')): ?>
								<span><?php echo get_field('episode_title_date'); ?></span>
							<?php endif; ?>
							<?php if(get_field('episode_title_start_time')): ?>
								<span><?php echo get_field('episode_title_start_time'); ?></span>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</section>

		<?php

		if(!function_exists('showLogin')):

		function showLogin($error_msg) {

		?>

		<section class="sequence-margin-last type-center">
		<div class="column-limit">
		<div class="login-limit">
		  <form method="post">
		    <p><b>Login to Watch</b></p>
		    <?php echo $error_msg; ?>
		    <div class="login-password">
		    	<input type="password" name="access_password" placeholder="Password">
		    </div>
		    <div class="login-submit"><input type="submit" name="Submit" value="Submit"></div>
		  </form>
		  <p class="login-register">
		  	Each event has a unique password.<br>
		  	Register <a href="<?php echo get_field('register_url'); ?>" target="_blank">here</a> to get yours.
		  </p>
		</div>
		</div>
		</section>

		<?php

		}
		endif;

		?>

		<?php

		function showLive($pass){

		?>

	    <section class="event-episode-item event-episode-video sequence-margin-first sequence-margin-last">
			<div class="column-limit">
				<?php echo get_field('embed'); ?>
			</div>
			<div class="column-limit leave-stream">
				<span class="type-link block-link js-leave-stream">Leave Stream</span>
			</div>
		</section>

		<?php

			echo "<script>";
			echo "var date = new Date(Date.now() + 86400e3);date = date.toUTCString();";
			echo "document.cookie = 'verify=".md5($pass)."; expires='+date+'; path=/; domain='+location.host;";
			echo "var leave = document.querySelector('.js-leave-stream');";
			echo "leave.addEventListener('click', function() {document.cookie = 'verify=".md5($pass)."; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain='+location.host;console.log('leave');window.history.replaceState(null, null, window.location.href);location.reload(true);});";
			echo "</script>";
		?>

		<script>
			// var leave = document.querySelector('.js-leave-stream');
			// var hascooke = false;

			// leave.addEventListener('click', function() {//Tue, 07 Nov 2023 21:09:21 GMT

			// 	if(hascooke){
			// 		document.cookie = "verify0=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/; domain="+location.host;
			// 		console.log("leave remove");
			// 	}else {
			// 		document.cookie = "verify0=leave; expires=Tue, 07 Nov 2023 21:09:21 GMT; path=/; domain="+location.host;
			// 		hascooke = true;
			// 		console.log("leave add");
			// 	}
				
				
			// }, false);

			// document.cookie = 'COOKIE_NAME=; Max-Age=0; path=/; domain=' + location.host;

		</script>

		<?php

			$email = "I thought you’d be interested in FOLCS’ event, ".get_field('episode_title_detail').", streaming live now.%0D%0AClick here to register and join the virtual conversation: ".get_field('register_url').".";
			$encoded = rawurlencode($email);
		?>

		<section class="event-episode-item sequence-margin-first sequence-margin-last folcs-studio-links">
			<div class="type-limit">
				<div class="type-center">
					<a href="/donate/" target="_blank" class="type-link block-link">
						Donate Now
					</a><a href="mailto:Enter%20an%20email?subject=FOLCS%20Studio%20Streaming%20Now&body=<?php echo $encoded; ?>" class="type-link block-link">
						Email a Friend
					</a>
				</div>
			</div>
		</section>
		
		<?php

		}

		?>


		<?php

		if (isset($_POST['access_password'])) {

		  $pass = $_POST['access_password'];

		  if (!in_array($pass, $LOGIN_INFORMATION)) {

		    showLogin('<p class="error"><span class="error-icon"><svg xmlns="https://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24"><path d="M12,2C6.48,2,2,6.48,2,12s4.48,10,10,10s10-4.4799995,10-10S17.5200005,2,12,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z"/></svg></span><span>Wrong password, try again.</span></p>');

		  }else {
		    // setcookie("verify", md5($pass), $timeout, '/');

		  	showLive($pass);
		  	// echo "post";

		  	unset($_POST['access_password']);
		  	unset($_POST['Submit']);
		  }

		}else {

		  if (!isset($_COOKIE['verify'])) {
		    showLogin("");

		  }else {

		  	$found = false;

		  	foreach($LOGIN_INFORMATION as $key=>$val) {

		  	  $lp = $val;

		  	  if ($_COOKIE['verify'] == md5($lp)) {
		  	    $found = true;
		  	    showLive($val);
		  	    // echo "pass";
		  	    break;
		  	  }
		  	}

		  	if (!$found) {
		  	  showLogin("");
		  	}
		  }

		}
		
		?>


		<?php
			else:
		?>

			<section class="sequence-margin-first sequence-margin-last">

				<div class="column-limit">
					<div class="column-1">

						<div class="h1-margin-30 h2-margin-7 p-margin-26 ul-margin-26 type-content type-center">
							<?php echo get_field('text'); ?>
						</div>

					</div>
				</div>
			</section>

			<?php

				$past_query = new WP_Query(

					array(
						'post_type'     => array( 'past' ),
						'post_status'   => array( 'publish' ),
						'posts_per_page'=> 3,
						// 'nopaging'      => true
					)
				);

			?>

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

						<?php wp_reset_postdata(); ?>

					

				<?php endif; ?>

				</div>
			</section>

		<?php
			endif;
		?>

</div>
