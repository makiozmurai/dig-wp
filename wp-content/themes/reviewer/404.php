<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn">
			<!-- content -->
			<div class="post">
				<h1 class="post-title">404 Not Found</h1>
				<p><?php _e("Sorry, but you are looking for something that isn't here.", 'tcd-w');  ?></p>
			</div>
			<hr>
			<!-- /content -->
			
			<!-- ranking -->
<?php if($options['show_ranking']): ?>
			<h2 class="headline1"><?php echo ($options['index_headline_ranking']); ?></h2>
			<div id="ranking" class="clearfix">
				<ol class="type-<?php echo ($options['ranking_style']); ?> clearfix">
					<?php
						if($options['display_ranking_type']=="ranking_post"){
							$my_meta_key = "my_rank";
						}else if($options['display_ranking_type']=="ranking_post2"){
							$my_meta_key = "my_rank2";
						}else if($options['display_ranking_type']=="ranking_post3"){
							$my_meta_key = "my_rank3";
						}
						$args = array('post_type' => $options['display_ranking_type'], 'orderby' => 'meta_value', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'numberposts' => 3);
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
					?>
					<li class="rank-others clearfix rank<?php echo $my_rank; ?>">
						<h3 class="rank-title"><span class="rank-num">No.<?php echo $my_rank; ?></span><span class="rank-title-text"><?php if(is_array($myItemName)){ echo $myItemName[0]; }; ?></span></h3>
						<div class="rank-others-img ih-item square effect6 from_top_and_bottom"><a href="<?php echo get_permalink($post->ID); ?>">
							<div class="img"><?php if(get_the_post_thumbnail($post->ID, 'size2')){echo get_the_post_thumbnail($post->ID, 'size2');}else{echo '<img src="'; bloginfo('template_url'); echo '/images/no_image2.jpg" alt="" title="" />';}; ?></div>
							<div class="info">
							<?php if($options['show_sns']): ?>
								<h3><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></h3>
								<p><span class="tw"><?php echo number_format($twCount) ?></span><span class="fb"><?php echo number_format($fbCount) ?></span></p>
							<?php endif; ?>
							</div>
						</a></div>
						<p class="rank-others-txt"><a href="<?php echo get_permalink($post->ID); ?>"><?php new_excerpt2(30, get_the_title()); ?></a></p>
					</li>
					<?php endif; endforeach; endif; ?>
				</ol>
			</div>
			<hr />
<?php endif; ?>
			<!-- /ranking -->
			<!-- recommended posts -->
<?php if ($options['show_recommended_post']) : ?>
<?php
	$args = array('post_type' => 'post', 'numberposts' => 3, 'meta_key' => 'recommend_post', 'meta_value' => 'on', 'orderby' => 'rand');
	$recommend_post=get_posts($args);
	if ($recommend_post) {
?>
			<h2 class="headline1"><?php _e("Recommended Posts","tcd-w"); ?></h2>
			<ul id="recent-posts">
<?php foreach ($recommend_post as $post) : setup_postdata ($post); ?>
	<?php
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
	?>
				<li class="clearfix">
					<div class="recent-posts-img ih-item square effect6 from_top_and_bottom"><a href="<?php the_permalink() ?>">
						<div class="img"><?php if ( has_post_thumbnail()) { the_post_thumbnail('size2'); } else { echo '<img src="'; bloginfo('template_url'); echo '/images/no_image2.jpg" alt="" title="" />'; }; ?></div>
						<div class="info">
						<?php if($options['show_sns']): ?>
							<h3><?php the_title(); ?></h3>
							<p><span class="tw"><?php echo number_format($twCount) ?></span><span class="fb"><?php echo number_format($fbCount) ?></span></p>
						<?php endif; ?>
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
<?php endforeach; wp_reset_query(); ?>
			</ul>
<?php }; ?>
<?php endif; ?>
			<!-- /recommended posts -->
			<!-- single post banner -->
<?php if($options['single_ad_code1']||$options['single_ad_image1']) { ?>
			<hr />
			<div id="single-page-banner">
	<?php if ($options['single_ad_code1']) { ?>
				<div class="single-banner"><?php echo $options['single_ad_code1']; ?></div>
	<?php } else { ?>
				<div class="single-banner"><a href="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" alt="" title="" /></a></div>
	<?php }; ?>
	<?php if($options['single_ad_code2']||$options['single_ad_image2']) { ?>
		<?php if ($options['single_ad_code2']) { ?>
				<div class="single-banner"><?php echo $options['single_ad_code2']; ?></div>
		<?php } else { ?>
				<div class="single-banner"><a href="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" alt="" title="" /></a></div>
		<?php }; ?>
	<?php }; ?>
			</div>
<?php }; ?>
			<!-- /single post banner -->
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>