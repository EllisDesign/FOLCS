<?php
/**
 * Template part for displaying page content in page-join-mailing-list.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="sequence-margin-first-abbreviated sequence-margin-last type-content h1-margin-30 h2-margin-7 p-margin-26 no-underline">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>
	</div>
</section>

</div>