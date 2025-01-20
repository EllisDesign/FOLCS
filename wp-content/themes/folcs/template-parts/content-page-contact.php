<?php
/**
 * Template part for displaying page content in page-contact.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="sequence-margin-first-abbreviated sequence-margin-last type-content p-margin-26 no-underline">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>
	</div>
</section>

<section class="faq-items sequence-margin-first section-margin-last">

	<div class="column-limit">
		<div class="type-limit">

			<div class="h2-margin-15 p-margin-15 type-content">
				<h2 class="type-center">
					Frequently Asked Questions
				</h2>
				
				<?php
        	        if( have_rows('faqs_items') ):

        	            while ( have_rows('faqs_items') ) : the_row(); ?>

				<div class="faq-item">
					<p>
						<?php echo get_sub_field('faqs_question'); ?>
					</p>
					<p>
						<?php echo get_sub_field('faqs_answer'); ?>
					</p>
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