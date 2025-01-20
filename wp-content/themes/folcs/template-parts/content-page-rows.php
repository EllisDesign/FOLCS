<?php
/**
 * Template part for displaying page content in page-rows.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<?php
	$image = get_field('hero_item');
	$nav = ($image) ? 'nav-over nav-light' : 'invert';
?>

<body <?php body_class($nav); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<?php
	if($image):
	$size = 'large';
?>

<section class="hero-intro">
	<?php
		echo wp_get_attachment_image( $image, $size );
	?>
</section>

<?php
	endif;
?>

<section class="<?php echo ($image) ? 'sequence-margin-first' : 'sequence-margin-first-abbreviated'; ?> section-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-15 type-content">

				<div class="sequence-margin-last">
					<?php the_content(); ?>
				</div>

		        <?php
        	        if( have_rows('row_items') ):

        	            while ( have_rows('row_items') ) : the_row(); ?>

							<div class="donate-item">
								<div class="row">
									<div class="col-lg-8 col-sm-12 donate-details">
										<?php echo get_sub_field('row_details'); ?>
									</div>
									<?php if( get_sub_field('row_link_url') ): ?>
									<div class="col-lg-4 col-sm-12 donate-link">
										<a href="<?php echo get_sub_field('row_link_url'); ?>" class="type-link block-link multi-line" target="_blank"><?php echo get_sub_field('row_link_text'); ?></a>
									</div>
								<?php endif; ?>
								</div>
							</div>

						<?php

						endwhile;

					endif;
				?>
	
			</div>
		</div>
	</div>

</section>

</div>