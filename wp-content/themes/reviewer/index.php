<?php $options = get_desing_plus_option(); if (!is_paged()): get_header(); ?>

		<?php if (!is_mobile()&&$options['maincopy']) { ?>
		<div id="maincopy"><span><?php echo $options['maincopy']; ?></span></div>
		<?php }; ?>
		<?php if($options['slider_image1']): ?>
		<!-- slider -->
		<div id="slider" class="nivoSlider">
		<?php for($i = 1; $i <= 5; $i++): ?>
			<?php if($options['slider_image'.$i]) { ?>
				<?php if($options['slider_url'.$i]) { ?>
					<a href="<?php esc_attr_e( $options['slider_url'.$i] ); ?>"<?php if ($options['slider_target'.$i]) {echo ' target="_blank"';}; ?>><img src="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" alt=""></a>
				<?php } else { ?>
					<img src="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" alt="">
				<?php }; ?>
			<?php }; ?>
		<?php endfor; ?>
		</div>
		<!-- /slider -->
		<?php endif; ?>
		<?php if (is_mobile()&&$options['maincopy']) { ?>
		<div id="maincopy"><span><?php echo $options['maincopy']; ?></span></div>
		<?php }; ?>
		
		<!-- mainColumn -->
		<div id="mainColumn"<?php if (!is_mobile()) {echo ' class="pt40"';}; ?>>
			<!-- news -->
			<?php if ($options['show_index_news']) { ?>
			<div id="top-news-headline" class="clearfix">
				<h2 class="headline1"><?php if($options['index_headline_news']){ echo ($options['index_headline_news']); }else{ _e("Latest News","tcd-w"); }; ?></h2>
				<?php if (!is_mobile()&&$options['show_index_news_link']) { ?><div class="top-news-btn"><a href="<?php echo get_post_type_archive_link('news'); ?>"><?php if ($options['index_headline_news_archive']){echo ($options['index_headline_news_archive']);}else{_e("Older News","tcd-w");}; ?></a></div><?php };?>
			</div>
			<ul id="top-news">
<?php
	$args = array('post_type' => 'news', 'numberposts' => $options['index_news_num']);
	$news_post=get_posts($args);
	if ($news_post) :
	foreach ($news_post as $post) : setup_postdata ($post);
?>
				<li><a href="<?php the_permalink() ?>"><span class="date"><?php the_time('Y.m.d'); ?></span><?php the_title(); ?></a></li>
<?php endforeach; else: ?>
				<li><?php _e("There is no registered news.","tcd-w"); ?></li>
<?php endif; ?>
			</ul>
				<?php if (is_mobile()&&$options['show_index_news_link']) { ?><div class="top-news-btn"><a href="<?php echo get_post_type_archive_link('news'); ?>"><?php if ($options['index_headline_news_archive']){echo ($options['index_headline_news_archive']);}else{_e("Older News","tcd-w");}; ?></a></div><?php };?>
				<?php if(!is_mobile()){ ?>
			<hr>
				<?php }; ?>
			<?php }; ?>
			<!-- /news -->

			<!-- ranking -->
			<?php if ($options['show_index_ranking']) : ?>
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
					$args = array('post_type' => $options['display_ranking_type'], 'orderby' => 'meta_value_num', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'numberposts' => $options['index_ranking_num']);
					$ranking_post = get_posts($args);
					if($ranking_post) :
						foreach($ranking_post as $post) : setup_postdata($post);
							$my_status= $post->post_status;
							if($my_status=="publish"):
								$my_rank = get_post_meta($post->ID, $my_meta_key, true);
								$myItemName = get_post_meta($post->ID, 'myitemName', false);
								$spec_label = $custom_field_template->get_post_meta($post->ID, 'spec_label', false);
								$spec_data = $custom_field_template->get_post_meta($post->ID, 'spec_data', false);
								if($options['show_sns']){
									$url = get_permalink($post->ID);
									//$twJson = @file_get_contents("http://urls.api.twitter.com/1/urls/count.json?url=".rawurlencode($url));
									//$twJsonArray = json_decode($twJson,true);
									//$twCount = $twJsonArray["count"];
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
							<?php if($my_rank<4): ?>
					<li class="rank-best3 clearfix rank<?php echo $my_rank; ?>">
						<h3 class="rank-title clearfix"><span class="rank-num">No.<?php echo $my_rank; ?></span><span class="rank-title-text"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></span></h3>
						<div class="clearfix<?php if(!is_mobile()){ echo ' mb25'; }; ?>">
							<div class="rank-best3-img ih-item square effect6 from_top_and_bottom"><a href="<?php echo get_permalink($post->ID); ?>">
								<div class="img"<?php if (!is_mobile()) { echo ' style="height:240px;"'; }; ?>><?php if(get_the_post_thumbnail($post->ID, 'size1')){echo get_the_post_thumbnail($post->ID, 'size1');}else{echo '<img src="'; bloginfo('template_url'); echo '/images/no_image1.jpg" alt="" title="">';}; ?></div>
								<div class="info">
								<?php if(!is_mobile()&&$options['show_sns']): ?>
									<h3 style="margin-top:80px;"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></h3>
									<p><!--<span class="tw"><?php //echo number_format($twCount) ?></span>--><span class="fb"><?php echo number_format($fbCount) ?></span></p>
								<?php endif; ?>
								</div>
							</a></div>
							<div class="rank-best3-txt">
								<p class="rank-best3-copy"><a href="<?php echo get_permalink($post->ID); ?>"><?php the_title(); ?></a></p>
								<?php if ( is_array($spec_label) ) { ?>
								<table class="rank-best3-table">
									<?php foreach($spec_label as $key => $val) { ?>
									<tr>
										<th><?php echo $spec_label[$key]; ?></th>
										<?php
											$myData = $spec_data[$key];
											$star = strpos($myData, "[star");
											if($star===false):
										?>
										<td><?php echo $spec_data[$key]; ?></td>
										<?php
											else:
												$myNum = intval(substr($myData,0,$star));
												$myColor = intval(substr($myData, ($star+5), ($star+6)));
												if($myColor==0){$myColor=1;};
										?>
										<td><?php for ($i=1; $i < 6; $i++) {
											if($i<=$myNum) {
												echo '<img src="'; bloginfo('template_url'); echo '/images/star'.$myColor.'.png" alt="" title="">';
											}else{
												echo '<img src="'; bloginfo('template_url'); echo '/images/no_star.png" alt="" title="">';
											}
										} ?></td>
										<?php endif; ?>
									</tr>
									<?php }; ?>
								</table>
								<?php }; ?>
							</div>
						</div>
						<p class="rank-best3-desc"><?php new_excerpt(140); ?></p>
						<p class="rank-best3-link"><a href="<?php echo get_permalink($post->ID); ?>"><?php _e("More","tcd-w"); ?></a></p>
					</li>
							<?php else: ?>
								<?php if(!is_mobile()): ?>
					<li class="rank-others clearfix rank<?php echo $my_rank; ?>">
						<h3 class="rank-title"><span class="rank-num">No.<?php echo $my_rank; ?></span><span class="rank-title-text"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></span></h3>
						<div class="rank-others-img ih-item square effect6 from_top_and_bottom"><a href="<?php echo get_permalink($post->ID); ?>">
							<div class="img" style="height:165px;"><?php if(get_the_post_thumbnail($post->ID, 'size2')){echo get_the_post_thumbnail($post->ID, 'size2');}else{echo '<img src="'; bloginfo('template_url'); echo '/images/no_image2.jpg" alt="" title="">';}; ?></div>
							<div class="info">
							<?php if($options['show_sns']): ?>
								<h3 style="margin-top:45px;"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></h3>
								<p><!--<span class="tw"><?php //echo number_format($twCount) ?></span>--><span class="fb"><?php echo number_format($fbCount) ?></span></p>
							<?php endif; ?>
							</div>
						</a></div>
						<p class="rank-others-txt"><a href="<?php echo get_permalink($post->ID); ?>"><?php new_excerpt2(30, get_the_title()); ?></a></p>
					</li>
						<?php endif; ?>
					<?php endif; endif; endif; endforeach; endif; ?>
				</ol>
			</div>
			<?php if ($options['show_index_ranking_link']) { ?><div id="ranking-index-link"><a href="<?php echo get_post_type_archive_link($options['display_ranking_type']); ?>"><?php if ($options['index_headline_ranking_archive']){echo ($options['index_headline_ranking_archive']);}else{_e('Ranking Index', 'tcd-w');}; ?></a></div><?php }; ?>
			<?php if(!is_mobile()){ echo '<hr>'; }; ?>
			<?php endif; ?>
			<!-- /ranking -->
			
			<!-- recent post -->
<?php if($options['show_index_blog']): ?>
			<h2 class="headline1"><?php if($options['index_headline_blog']){ echo ($options['index_headline_blog']); }else{ _e("Recent Posts","tcd-w"); }; ?></h2>
			<ul id="recent-posts">
<?php
	$args = array('post_type' => 'post', 'numberposts' => get_option('posts_per_page'));
	$index_recent_post=get_posts($args);
	if ($index_recent_post) :
	foreach ($index_recent_post as $post) : setup_postdata ($post);
?>
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
						<p class="excerpt"><?php if(is_mobile()){ echo '<a href="'; the_permalink(); echo '">'; }; ?><?php if(has_excerpt()){ the_excerpt(); }else{ new_excerpt(65); }; ?><?php if(is_mobile()){ echo '</a>'; }; ?></p>
					</div>
				</li>
<?php endforeach; else: ?>
				<li class="no_post"><p><?php _e("There is no registered post.","tcd-w"); ?></p></li>
<?php endif; ?>
			</ul>
			<div id="more-recent-posts"><?php next_posts_link(__('Older Entries', 'tcd-w')); ?></div>
			<!-- /recent post -->
<?php endif; ?>
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); else: include('archive.php'); endif; ?>