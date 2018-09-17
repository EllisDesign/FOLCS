<?php
/**
 * Template part for displaying page content in page-sponsors.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="sequence-margin-first-abbreviated sequence-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-15 type-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

<section class="sequence-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<div class="sponsors-items">
			<?php
				if( have_rows('sponsors_items') ):

				    while ( have_rows('sponsors_items') ) : the_row(); 

				    	$image = get_sub_field('sponsors_item');
				    	$size = 'large';
			    	?><div class="i-blk blk-lg-4 sponsors-item"><img src="<?php echo $image['sizes'][$size] ?>"></div><?php

					endwhile;

				endif;

			?>
			</div>
		</div>
	</div>
</section>

<section class="section-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-15 type-content">
				<?php the_field('secondary_details'); ?>
			</div>
		</div>
	</div>
</section>

</div>