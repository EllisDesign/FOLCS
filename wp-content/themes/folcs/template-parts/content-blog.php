<?php
/**
 * Template part for displaying page content in single-blog.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOLCS
 */

?>

<body <?php body_class('event-episode invert'); ?>>
<?php include(get_template_directory() . '/inc/nav.php'); ?>

<div class="app">

<div class="event-episodes">
<?php include(get_template_directory() . '/inc/event-episodes.php'); ?>


	<section class="event-episode-item event-episode-bio sequence-margin-first sequence-margin-last">

		<div class="column-limit">
			<div class="type-limit">

    <?php
    	$posts = get_field('blog_author');
    	if($posts):
	?>
	<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
    <?php setup_postdata($post); ?>
		
		<?php $image = get_field('author_portrait'); ?>

		<div class="events-bio sequence-margin-last">

			<div class="row">

				<div class="events-bio-portrait-col">
					<div class="events-portrait events-bio-portrait" style="background-image:url('<?php echo $image['sizes']['thumbnail']; ?>')"></div>
				</div>

				<div class="events-bio-text-col category-margin-20 p-margin-10">
					<div class="type-category"><?php the_field('author_speaker_type'); ?></div>
					<p class="type-bio">
						<b><?php the_field('author_name'); ?></b><br>
						<?php the_field('author_title'); ?>
					</p>
					<?php the_field('author_bio'); ?>
					<p>
						<a href="<?php the_permalink(); ?>">More posts by <?php the_field('author_name'); ?></a>
					</p>
				</div>

			</div>

		</div>
		
		<?php endforeach; ?>

		<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

		<?php endif; ?>

			</div>
		</div>

	</section>


</div>

</div>