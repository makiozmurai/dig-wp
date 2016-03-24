<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!-- content -->
			<div class="post">
				<?php if($options['show_date']||$options['show_category']) { ?>
				<ul class="meta clearfix">
					<?php if ($options['show_date']) { ?><li class="date"><?php the_time('Y.m.d'); ?></li><?php }; ?>
				</ul>
				<?php }; ?>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php custom_wp_link_pages(); ?>
			</div>
		<?php endwhile; endif; ?>
			<!-- /content -->
			
			<!-- bookmark -->
			<?php if($options['show_bookmark']) { include('bookmark.php'); };?>
			<!-- /bookmark -->
			
			<!-- page nav -->
			<?php if ($options['show_next_post']) : ?>
			<div id="previous_next_post" class="clearfix">
				<p id="previous_post"><?php previous_post_link('%link', __( 'Previous post', 'tcd-w' )) ?></p>
				<p id="next_post"><?php next_post_link('%link', __( 'Next post', 'tcd-w' )) ?></p>
			</div>
			<?php endif; ?>
			<?php if(!is_mobile()){ echo '<hr>'; }; ?>
			<!-- /page nav -->
			
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>