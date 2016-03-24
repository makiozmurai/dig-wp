							<div class="top-post-list hentry">
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
								<article class="post-list cf" role="article">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								
									<?php if ( has_post_thumbnail()) : ?>
									<figure class="eyecatch">
										<?php the_post_thumbnail('home-thum'); ?>
									</figure>
									<?php else: ?>
									<figure class="eyecatch noimg">
										<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png">
									</figure>
									<?php endif; ?>
								
									<section class="entry-content cf">
									    <p class="byline entry-meta vcard">
									
										<span class="date updated"><?php the_time('Y.m.d'); ?></span>
									    <span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
										<span class="author" style="display: none;"><span class="fn"><?php the_author(); ?></span></span>
										
									    </p>
									
										<h1 class="h2 entry-title"><?php the_title(); ?></h1>
								
									<?php if( !is_mobile() ): ?>
										<p class="description"><?php the_excerpt(); ?></p>
									<?php endif; ?>
								
									</section>
									</a>
								</article>
							
							<?php endwhile; ?>
							
							<?php pagination(); ?>
	
							<?php else : ?>
								
								<article id="post-not-found" class="hentry cf">
								<header class="article-header">
									<h1>まだ投稿がありません！</h1>
								</header>
								<section class="entry-content">
									<p>表示する記事がまだありません。</p>
								</section>
								</article>
							
							<?php endif; ?>
							</div>