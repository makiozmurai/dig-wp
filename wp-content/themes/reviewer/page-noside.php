<?php
/*
Template Name:No Side
*/
?>
<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn-noside" class="pt25">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if ( has_post_thumbnail() and $page=='1') { if ($options['show_thumbnail']) : ?><p class="eyecatch"><?php the_post_thumbnail('single_size'); ?></p><?php endif; }; ?>
			<!-- content -->
			<div class="post">
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php custom_wp_link_pages(); ?>
			</div>
		<?php endwhile; endif; ?>
			<!-- /content -->
			
			<!-- bookmark -->
			<?php if($options['show_bookmark']) { include('bookmark.php'); };?>
			<!-- /bookmark -->
			
		</div>
		<!-- /mainColumn -->


<?php get_footer(); ?>