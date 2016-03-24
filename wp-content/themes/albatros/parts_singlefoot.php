						<div class="authorbox">
<?php if(get_the_author_meta('description')) : ?>
							<div class="inbox">
								<div class="profile cf">
									<h2 class="h_ttl"><span class="gf">ABOUT</span>この記事をかいた人</h2>
										<?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
										<p class="name author"><?php the_author_posts_link(); ?></p>
										<div class="profile_description">
											<?php the_author_meta("description" ); ?>
										</div>
										<div class="author_sns">
											<ul>
<?php if(get_the_author_meta('user_url')) : ?>
												<li><a href="<?php the_author_meta( 'user_url' ); ?>" target="_blank"><i class="fa fa-globe"></i>WebSite</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('twitter')) : ?>
												<li><a href="<?php the_author_meta( 'twitter' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-twitter fa-lg"></i>Twitter</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('facebook')) : ?>
												<li><a href="<?php the_author_meta( 'facebook' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-facebook fa-lg"></i>Facebook</a></li>
<?php endif ;?>
<?php if(get_the_author_meta('googleplus')) : ?>
												<li><a href="<?php the_author_meta( 'googleplus' ); ?>" rel="nofollow" target="_blank"><i class="fa fa-google-plus fa-lg"></i>Google+</a></li>
<?php endif ;?>
											</ul>
										</div>
								</div>
							
							
								<div class="author-newpost cf">
									<h2 class="h_ttl"><span class="gf">NEW POST</span>最新の記事</h2>
										<ul>
										<?php
										  $author_id = get_the_author_meta( 'ID' );
										  $args = array(
										  'post_type' => 'post',
										  'author' => $author_id,
										  'showposts' => 4, /* 表示個数 */
										); ?>
										<?php $loop = new WP_Query( $args ); ?>
										<?php while ($loop->have_posts()) : $loop->the_post(); ?>
										<li>
											<a href="<?php the_permalink() ?>">
											<figure class="eyecatch">
											<?php if(has_post_thumbnail()) { ?>
								                <?php the_post_thumbnail('home-thum'); ?>
											<?php } else { ?>
								                <img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png" />
											<?php } ?>
											</figure>
												<span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
												<time class="date"><?php the_time( 'Y.n.j' ); ?></time>
												<h3 class="ttl">
													<?php if(mb_strlen($post->post_title)>38) { $title= mb_substr($post->post_title,0,38) ; echo $title. … ;
													} else {echo $post->post_title;}?>
												</h3>
											</a>
										</li>
										<?php endwhile; ?>
										<?php wp_reset_query();?>
										</ul>
								</div>
							</div>
							<?php endif ;?>
						
							<div class="np-post">	
								<div class="navigation">
								<?php if( get_previous_post() ): ?>
								<div class="prev"><?php previous_post_link('%link', '%title'); ?></div>
								<?php endif; ?>
								<?php if( get_next_post() ): ?>
								<div class="next"><?php next_post_link('%link', '%title'); ?></div>
								<?php endif; ?>
								</div>
							</div>
						</div>



	<?php //プラグインYARPPを使っている場合はプラグインの設定画面から「カスタム > yarpp-template-relative.php」を選ぶとプラグインのレコメンド機能を実装できます。 ;?>

	<?php if(function_exists('related_posts')): ?>
		<?php related_posts(); ?>
	<?php else :?>
		<?php include( TEMPLATEPATH . '/related-entries.php' ); ?>
	<?php endif;?>