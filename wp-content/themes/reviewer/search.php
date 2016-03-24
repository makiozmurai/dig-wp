<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn" class="pt25">
			<!-- post list -->
<?php if (is_search()) { ?>
<h1 class="archive-headline"><span><?php printf(__('Search results for - [ %s ]', 'tcd-w'), esc_attr(get_search_query()) ); ?></span></h1>
<?php }; ?>

<?php if ( have_posts() ) : ?>
			<ul id="recent-posts">
			<?php while ( have_posts() ) : the_post(); ?>
				<li class="clearfix">
					<div class="recent-posts-img ih-item square effect6 from_top_and_bottom"><a href="<?php the_permalink() ?>">
						<div class="img"><?php if ( has_post_thumbnail()) { the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/images/no_image2.jpg" alt="" title="">'; }; ?></div>
						<div class="info">
						</div>
					</a></div>
					<div class="recent-posts-data">
						<?php if ($options['show_date']||$options['show_category']) { ?>
						<ul class="meta clearfix">
							<?php if ($options['show_date']) { ?><li class="date"><?php the_time('Y.m.d'); ?></li><?php }; ?>
							<?php if ($options['show_category'] && get_post_type()=='post') { ?><li class="cate"><?php the_category(', '); ?></li><?php }; ?>
						</ul>
						<?php }; ?>
						<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
						<p class="excerpt"><a href="<?php the_permalink() ?>"><?php if(has_excerpt()){ the_excerpt(); }else{ new_excerpt(65); }; ?></a></p>
					</div>
				</li>
			<?php endwhile; ?>
			</ul>
<?php else: ?>
			<p class="no_post"><?php _e("There is no registered post.","tcd-w"); ?></p>
<?php endif; ?>
<?php include('navigation.php'); ?>
			<?php if(!is_mobile()){ echo '<hr>'; }; ?>
			<!-- /post list -->
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>