<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn" class="pt25">
			<!-- post list -->
<?php if (is_category()) { ?>
<h1 class="archive-headline"><span><?php echo single_cat_title('', false); ?></span></h1>

<?php } elseif( is_tag() ) { ?>
<h1 class="archive-headline"><span><?php echo single_tag_title('', false); ?></span></h1>

<?php } elseif (is_day()) { ?>
<h1 class="archive-headline"><span><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w'))); ?></span></h1>

<?php } elseif (is_month()) { ?>
<h1 class="archive-headline"><span><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w'))); ?></span></h1>

<?php } elseif (is_year()) { ?>
<h1 class="archive-headline"><span><?php printf(__('Archive for &#8216; %s &#8217;', 'tcd-w'), get_the_time(__('Y', 'tcd-w'))); ?></span></h1>

<?php } elseif (is_author()) { ?>
<?php global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
<h1 class="archive-headline"><span><?php printf(__('Archive for the &#8216; %s &#8217;', 'tcd-w'), $curauth->display_name ); ?></span></h1>

<?php } else { ?>
<h1 class="archive-headline"><span><?php _e('Blog Archives', 'tcd-w'); ?></span></h1>
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
							<?php if ($options['show_category']) { ?><li class="cate"><?php the_category(', '); ?></li><?php }; ?>
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
			<!-- ranking -->
<?php if($options['show_ranking']): ?>
	<?php
		if($options['display_ranking_type']=="ranking_post"){
			$my_meta_key = "my_rank";
			if($options['index_headline_ranking']){
				$my_headline = $options['index_headline_ranking'];
			}else{
				$my_headline = __("Ranking","tcd-w");
			}
		}else if($options['display_ranking_type']=="ranking_post2"){
			$my_meta_key = "my_rank2";
			if($options['index_headline_ranking2']){
				$my_headline = $options['index_headline_ranking2'];
			}else{
				$my_headline = __("Ranking","tcd-w");
			}
		}else if($options['display_ranking_type']=="ranking_post3"){
			$my_meta_key = "my_rank3";
			if($options['index_headline_ranking3']){
				$my_headline = $options['index_headline_ranking3'];
			}else{
				$my_headline = __("Ranking","tcd-w");
			}
		}
	?>
			<h2 class="headline1"><?php echo $my_headline; ?></h2>
			<div id="ranking" class="clearfix">
				<ol class="type-<?php echo ($options['ranking_style']); ?> clearfix">
					<?php
						$args = array('post_type' => $options['display_ranking_type'], 'orderby' => 'meta_value_num', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'numberposts' => 3);
						$ranking_post = get_posts($args);
						if($ranking_post) :
							foreach($ranking_post as $post) : setup_postdata($post);
								$my_status= $post->post_status;
								if($my_status=="publish"):
									$my_rank = get_post_meta($post->ID, $my_meta_key, true);
									$myItemName = get_post_meta($post->ID, 'myitemName', false);
									if($options['show_sns']){
										$url = get_permalink($post->ID);
										$twJson = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".rawurlencode($url));
										$twJsonArray = json_decode($twJson,true);
										$twCount = $twJsonArray["count"];
										$fbJson = @file_get_contents("http://graph.facebook.com/?id=".rawurlencode($url));
										$fbArray = json_decode($fbJson,true);
										if(isset($fbArray["shares"])){
											$fbCount = $fbArray["shares"];
										}else{
											$fbCount = 0;
										}
									}
									if($my_rank!=""):
					?>
					<?php if(is_mobile()){ ?>
					<a href="<?php echo get_permalink($post->ID); ?>">
					<?php }; ?>
					<li class="rank-others clearfix rank<?php echo $my_rank; ?>">
						<h3 class="rank-title"><span class="rank-num">No.<?php echo $my_rank; ?></span><span class="rank-title-text"><?php if(is_array($myItemName)){ echo $myItemName[0]; }; ?></span></h3>
						<?php if(!is_mobile()): ?>
						<div class="rank-others-img ih-item square effect6 from_top_and_bottom"><a href="<?php echo get_permalink($post->ID); ?>">
							<div class="img"><?php if(get_the_post_thumbnail($post->ID, 'size2')){echo get_the_post_thumbnail($post->ID, 'size2');}else{echo '<img src="'; bloginfo('template_url'); echo '/images/no_image2.jpg" alt="" title="">';}; ?></div>
							<div class="info">
							<?php if($options['show_sns']): ?>
								<h3><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></h3>
								<p><span class="tw"><?php echo number_format($twCount) ?></span><span class="fb"><?php echo number_format($fbCount) ?></span></p>
							<?php endif; ?>
							</div>
						</a></div>
						<p class="rank-others-txt"><a href="<?php echo get_permalink($post->ID); ?>"><?php new_excerpt2(30, get_the_title()); ?></a></p>
						<?php endif; ?>
					</li>
					<?php if(is_mobile()){ echo '</a>'; }; ?>
					<?php endif; endif; endforeach; endif; ?>
				</ol>
			</div>
			<?php if(!is_mobile()){ echo '<hr>'; }; ?>
<?php endif; ?>
			<!-- /ranking -->
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>