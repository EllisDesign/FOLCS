<?php
/**
 * Template part for displaying page content in page-leadership.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('page-leadership leadership invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="h1-margin-30 sequence-margin-first-abbreviated section-margin-last section-bottom-border">
	<div class="column-limit">
		<div class="type-limit">
			<div class="type-center sequence-margin-last">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="row event-cards p-margin-5 leadership-portraits">
			
			<?php
				
				$posts = get_field('leadership_items');

				if( $posts ):

					foreach( $posts as $post):
					setup_postdata($post);

					$leader = get_field('leadership_item');
				?>

				<div class="col-lg-3 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<div class="event-item js-bio-portrait" data-portrait="<?php echo $leader['sizes']['medium']; ?>" style="background-image: url('<?php echo $leader['sizes']['thumbnail_cropped']; ?>')"></div>
						<div class="event-details js-bio-details" data-name="<?php echo get_field('leadership_name'); ?>" data-title="<?php echo get_field('leadership_title'); ?>">
							<p><b><?php echo get_field('leadership_name'); ?></b></p>
							<p><?php echo get_field('leadership_title'); ?></p>
						</div>
						<a href="" class="js-bio"></a>
						<div class="leadership-bio-data"><?php echo get_field('leadership_details'); ?></div>
					</div>
				</div>

			<?php
					endforeach;
					wp_reset_postdata(); 

				endif; 

			?>

		</div>

	</div>
</section>


<section class="h1-margin-30 section-margin-first-border section-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<div class="type-center sequence-margin-last">
				<?php echo get_field('secondary_details'); ?>
			</div>
		</div>

		<div class="row event-cards p-margin-5 leadership-portraits">

			<?php
				
				$posts = get_field('board_items');

				if( $posts ):

					foreach( $posts as $post):
					setup_postdata($post);

					$leader = get_field('leadership_item');
				?>

				<div class="col-lg-3 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<div class="event-item js-bio-portrait" data-portrait="<?php echo $leader['sizes']['medium']; ?>" style="background-image: url('<?php echo $leader['sizes']['thumbnail_cropped']; ?>')"></div>
						<div class="event-details js-bio-details" data-name="<?php echo get_field('leadership_name'); ?>" data-title="<?php echo get_field('leadership_title'); ?>">
							<p><b><?php echo get_field('leadership_name'); ?></b></p>
							<p><?php echo get_field('leadership_title'); ?></p>
						</div>
						<a href="" class="js-bio"></a>
						<div class="leadership-bio-data"><?php echo get_field('leadership_details'); ?></div>
					</div>
				</div>

			<?php
					endforeach;
					wp_reset_postdata(); 

				endif; 

			?>

		</div>

	</div>
</section>

<?php
	
	$memoriam = get_field('memoriam_items');

	if( $memoriam ):
?>

<section class="h1-margin-30 section-margin-first-border section-margin-last section-top-border">
	<div class="column-limit">
		<div class="type-limit">
			<div class="type-center sequence-margin-last">
				<?php echo get_field('third_details'); ?>
			</div>
		</div>

		<div class="row event-cards p-margin-5 leadership-portraits">

			<?php

				$posts = get_field('memoriam_items');

				if( $posts ):

				foreach( $posts as $post):
				setup_postdata($post);

				$leader = get_field('leadership_item');
			?>

				<div class="col-lg-3 col-md-6 col-sm-12 event-card">
					<div class="event-items">
						<div class="event-item js-bio-portrait" data-portrait="<?php echo $leader['sizes']['medium']; ?>" style="background-image: url('<?php echo $leader['sizes']['thumbnail_cropped']; ?>')"></div>
						<div class="event-details js-bio-details" data-name="<?php echo get_field('leadership_name'); ?>" data-title="<?php echo get_field('leadership_title'); ?>">
							<p><b><?php echo get_field('leadership_name'); ?></b></p>
							<p><?php echo get_field('leadership_title'); ?></p>
						</div>
						<a href="" class="js-bio"></a>
						<div class="leadership-bio-data"><?php echo get_field('leadership_details'); ?></div>
					</div>
				</div>

			<?php
				endforeach;
				wp_reset_postdata();

				endif;
			?>

		</div>

	</div>
</section>

<?php
	endif;
?>


<section class="leadership-bio p-margin-15 js-bio-detail">
	<div class="table">
		<div class="table-row">
			<div class="table-cell">
				<div class="column-limit">
					<div class="row">
						<div class="col-lg-6 col-md-12 leadership-bio-portrait">
							<div class="leadership-bio-portrait-item" style="background-image:url()"></div>
						</div>
						<div class="col-lg-6 col-md-12">
							<h2></h2>
							<p></p>
							<div class="leadership-bio-details">
								
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="leadership-bio-close js-bio-close"></div>
</section>


</div>