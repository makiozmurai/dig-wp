<?php get_header(); $options = get_desing_plus_option(); ?>

		<!-- mainColumn -->
		<div id="mainColumn" class="pt25">
			<!-- ranking -->
			<h1 class="archive-headline"><span><?php echo ($options['index_headline_ranking']); ?></span></h1>
			<div id="ranking" class="clearfix mb20">
				<ol class="type-<?php echo ($options['ranking_style']); ?> clearfix">
				<?php
					$args = array('post_type' => 'ranking_post', 'orderby' => 'meta_value_num', 'meta_key' => 'my_rank', 'order' => 'ASC', 'numberposts' => get_option('posts_per_page'), 'paged' => $paged);
					$ranking_post = get_posts($args);
					if($ranking_post) :
						foreach($ranking_post as $post) : setup_postdata($post);
							$my_status= $post->post_status;
							if($my_status=="publish"):
								$my_rank = get_post_meta($post->ID, 'my_rank', true);
								$myItemName = get_post_meta($post->ID, 'myitemName', false);
								$spec_label = $custom_field_template->get_post_meta($post->ID, 'spec_label', false);
								$spec_data = $custom_field_template->get_post_meta($post->ID, 'spec_data', false);
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
					<li class="rank-best3 clearfix rank<?php echo $my_rank; ?>">
						<h3 class="rank-title"><span class="rank-num">No.<?php echo $my_rank; ?></span><span class="rank-title-text"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }; ?></span></h3>
						<div class="clearfix<?php if(!is_mobile()){ echo ' mb25'; }; ?>">
							<div class="rank-best3-img ih-item square effect6 from_top_and_bottom"><a href="<?php echo get_permalink($post->ID); ?>">
								<div class="img"<?php if (!is_mobile()) { echo 'style="height:240px;"'; }; ?>><?php if(get_the_post_thumbnail($post->ID, 'size1')){echo get_the_post_thumbnail($post->ID, 'size1');}else{echo '<img src="'; bloginfo('template_url'); echo '/images/no_image1.jpg" alt="" title="">';}; ?></div>
								<div class="info">
								<?php if(!is_mobile()&&$options['show_sns']): ?>
									<h3 style="margin-top:80px;"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></h3>
									<p><span class="tw"><?php echo number_format($twCount) ?></span><span class="fb"><?php echo number_format($fbCount) ?></span></p>
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
					<?php endif; endif; endforeach; endif; ?>
				</ol>
			</div>
			<!-- /ranking -->
			<?php include('navigation.php'); ?>
		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->

<?php get_footer(); ?>