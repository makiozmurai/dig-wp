<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
						<div class="archivettl">
						<h1 class="archive-title"><span>キーワード</span> <?php echo esc_attr(get_search_query()); ?></h1>
						</div>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="entry-header article-header">

              						<p class="byline entry-meta vcard">
										<span class="date updated"><?php the_time('Y.m.d'); ?></span>
						                <span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
										<span class="author" style="display: none;"><span class="fn"><?php the_author(); ?></span></span>
              						</p>

									<h3 class="search-title h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

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
								<h1>記事が見つかりませんでした。</h1>
							</header>
								
							<section class="entry-content">

								<p>お探しのキーワードで記事が見つかりませんでした。別のキーワードで再度お探しいただくか、カテゴリ一覧からお探し下さい。</p>

							<div class="search">
								<h2>キーワード検索</h2>
								<?php get_search_form(); ?>
							</div>


							<div class="cat-list cf">
								<h2>カテゴリーから探す</h2>
							<ul>
							<?php $args = array(
								'title_li' => '',
							); ?>
							<?php wp_list_categories($args); ?>
							</ul>
							</div>


							</section>

						</article>

						<?php endif; ?>

						</main>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
