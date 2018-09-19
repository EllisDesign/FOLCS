<?php
/**
 * Template part for displaying page content in page-event-series.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro sequence-margin-first section-margin-last">

	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 p-margin-26 ul-margin-26 type-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

<div class="sequence-margin-last">
<?php
	if( have_rows('event_series_items') ):

	    while ( have_rows('event_series_items') ) : the_row(); 

	    	$image = get_sub_field('event_series_item');
	    	$size = 'large';
    	?>

			<section class="event-series-items sequence-margin-last">
				<div class="column-limit">
					<div class="event-series-item">
						<?php 
							if($image) {
								echo wp_get_attachment_image( $image, $size );
							}
						?>
					</div>

					<div class="type-limit">
						<div class="event-series-details h1-margin-15 p-margin-30 type-center">
							<?php the_sub_field('event_series_details'); ?>
							<a href="<?php the_sub_field('event_series_link'); ?>" class="type-link block-link">Read More</a>
						</div>
					</div>
				</div>
			</section>

<?php
		endwhile;

	endif;
?>
</div>

</div>