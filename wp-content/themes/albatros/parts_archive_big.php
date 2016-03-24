							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">

					                <p class="byline entry-meta vcard">
					
									<span class="date updated"><?php the_time('Y.m.d'); ?></span>
					                <span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
					                <span class="author" style="display: none;"><span class="fn"><?php the_author(); ?></span></span>
					
					                </p>

									<h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

								</header>

								<?php if ( has_post_thumbnail()) : ?>
								<figure class="eyecatch">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('single-thum'); ?></a>
								</figure>
								<?php endif; ?>


								<section class="entry-content cf">

									<?php the_excerpt(); ?>
									<div class="readmore">
										<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">続きを読む</a>
									</div>
								</section>


							</article>

							<?php endwhile; ?>

							<?php pagination(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1>まだ投稿がありません。</h1>
										</header>
										<section class="entry-content">
											<p>表示する記事がみつかりませんでした。他の記事をお探し下さい。</p>
										</section>
									</article>

							<?php endif; ?>