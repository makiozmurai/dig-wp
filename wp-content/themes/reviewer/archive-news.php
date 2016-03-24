<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn" class="pt25">
			<!-- post list -->
			<h1 class="archive-headline"><span><?php if($options['index_headline_news']){ echo ($options['index_headline_news']); }else{ _e("Latest News","tcd-w"); }; ?></span></h1>

<?php if ( have_posts() ) : ?>
			<ul id="top-news" class="mb30">
			<?php while ( have_posts() ) : the_post(); ?>
				<li><a href="<?php the_permalink() ?>"><span class="date"><?php the_time('Y/m/d'); ?></span><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>
<?php else: ?>
			<p class="no_post"><?php _e("There is no registered post.","tcd-w"); ?></p>
<?php endif; ?>
<?php include('navigation.php'); ?>
			<hr>
			<!-- /post list -->
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>