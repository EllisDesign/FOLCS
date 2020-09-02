<?php
/**
 * Template part for displaying page content in page-standard.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro sequence-margin-first-abbreviated section-margin-last">

	<div class="column-limit">
		<div class="type-limit">
			<div class="h1-margin-30 h2-margin-15 p-margin-26 ul-margin-26 type-content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</section>

</div>