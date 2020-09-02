<?php
/**
 * Template part for displaying page content in page-standard.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('nav-over nav-light'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="hero-intro">
	<?php
		$image = get_field('hero_item');
		$size = 'large';

		if($image) {
			echo wp_get_attachment_image( $image, $size );
		}
	?>
</section>

<section class="intro sequence-margin-first section-margin-last">

	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-26 ul-margin-26 type-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

<?php 
// Sponsors Logos
if(get_the_ID() == 26): 
?>

<section class="section-margin-first section-margin-last section-top-border h2-margin-50">
	<div class="column-limit">
		<div class="type-limit">
			<h2 class="type-center">Our Sponsors</h2>
			<div class="sponsors-items">
			<?php
				if( have_rows('sponsors_items', 22) ):

				    while ( have_rows('sponsors_items', 22) ) : the_row(); 

				    	$image = get_sub_field('sponsors_item');
				    	$size = 'large';
			    	?><div class="i-blk blk-lg-4 blk-sm-6 sponsors-item"><img src="<?php echo $image['sizes'][$size] ?>"></div><?php

					endwhile;

				endif;

			?>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>

</div>