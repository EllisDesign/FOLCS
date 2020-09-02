<?php
$press = get_field('press_item');
$size = 'large';
?>
	<div class="col-lg-4 col-md-6 col-sm-12 event-card">
		<div class="event-items">
			<a href="<?php the_field('press_link'); ?>" target="_blank" class="h2-has-hover"></a>
			<div class="event-item" style="background-image: url('<?php echo $press['sizes'][$size]; ?>')"></div>
			<div class="event-details">
				<div class="type-category"><?php the_field('press_name'); ?></div>
				<h2><span><?php the_field('press_title'); ?></span></h2>
			</div>
		</div>
	</div>
