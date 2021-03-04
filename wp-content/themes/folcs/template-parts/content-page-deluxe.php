<?php
/**
 * Template part for displaying page content in single-event-series.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('event-episode invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<section class="intro intro-margin h1-margin-30 p-margin-15 sequence-margin-first-abbreviated sequence-margin-last">
	<div class="column-limit">
		<div class="type-limit">
			<?php the_content(); ?>
		</div>
	</div>
</section>


<?php include(get_template_directory() . '/inc/event-episodes.php'); ?>


</div>