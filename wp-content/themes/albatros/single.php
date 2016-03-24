<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="//schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="//schema.org/BlogPosting">
		
		                <header class="article-header entry-header">
		                  <p class="byline entry-meta vcard">
		
							<span class="date entry-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></span>
			                <span class="cat-name"><?php $cat = get_the_category(); ?><?php $cat = $cat[0]; ?><?php echo get_cat_name($cat->term_id); ?></span>
			                <span class="author" style="display: none;"><span class="fn"><?php the_author(); ?></span></span>
		
		                  </p>
		
		
		                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
		
		                </header>
		
						<?php if ( has_post_thumbnail() && !get_option( 'post_options_eyecatch' ) ) :?>
						<figure class="eyecatch">
							<?php the_post_thumbnail('single-thum'); ?>
						</figure>
						<?php endif; ?>

						<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
						<?php get_template_part( 'parts_sns_short' ); ?>
						<?php endif; ?>

						<?php if ( is_active_sidebar( 'addbanner-sp-titleunder' ) ) : ?>
							<?php if ( is_mobile() ) : ?>
							<div class="add titleunder">
								<?php dynamic_sidebar( 'addbanner-sp-titleunder' ); ?>
							</div>
							<?php endif; ?>
						<?php endif; ?>

		                <section class="entry-content cf" itemprop="articleBody">

						<?php if ( is_active_sidebar( 'addbanner-pc-titleunder' ) && !is_mobile()) : ?>
							<div class="add titleunder">
								<?php dynamic_sidebar( 'addbanner-pc-titleunder' ); ?>
							</div>
						<?php endif; ?>


						<?php the_content();
			              
						wp_link_pages( array(
							'before'      => '<div class="page-links cf"><ul>',
							'after'       => '</ul></div>',
							'link_before' => '<li><span>',
							'link_after'  => '</span></li>',
							'nextpagelink'     => __('Next page'),
							'previouspagelink' => __('Previous page'),
						) );    
					    ?>

						<?php if ( is_active_sidebar( 'addbanner-pc-contentfoot' ) && !is_mobile() ) : ?>
							<div class="add">
								<?php dynamic_sidebar( 'addbanner-pc-contentfoot' ); ?>
							</div>
						<?php endif; ?>

		                </section>

						<?php if ( is_active_sidebar( 'addbanner-sp-contentfoot' ) && is_mobile() ) : ?>
							<div class="add">
								<?php dynamic_sidebar( 'addbanner-sp-contentfoot' ); ?>
							</div>
						<?php endif; ?>
						
						



						

						<?php if ( !get_option( 'sns_options_hide' ) ) : ?>
						<div class="sharewrap">
						<?php if ( get_option( 'sns_options_text' ) ) : ?>
				            <h3><?php echo get_option( 'sns_options_text' ); ?></h3>
					    <?php else : ?>
				            <h3>シェア！</h3>
						<?php endif; ?>
							<?php get_template_part( 'parts_sns' ); ?>
						</div>
						<?php endif; ?>
						
						<?php if ( is_active_sidebar( 'cta' ) ) : ?>
							<div class="add cta-wrap">
								<?php dynamic_sidebar( 'cta' ); ?>
							</div>
						<?php endif; ?>

						<?php comments_template(); ?>

		                <footer class="article-footer">

							<div class="category-newpost-wrap">
							<h3><?php the_category(' / ') ?>の最新記事</h3>
							<?php
							foreach((get_the_category()) as $cat) {
							$catid = $cat->cat_ID ;
							break ;
							}
							$get_posts_parm = "'numberposts=3&category=" . $catid . "'";
							?>
							<ul class="category-newpost cf">
							<?php $posts = get_posts($get_posts_parm); ?>
							<?php foreach($posts as $post): ?>
							<li class="cf"><span class="date"><?php the_time('Y.m.d'); ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <?php the_title(); ?></a></li>
							<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
							</ul>
							</div>
	
			                <?php echo get_the_category_list(); ?>
			
			                <?php the_tags( '<p class="tags">', '', '</p>' ); ?>
		
		                </footer>
						
		              </article>
		

<?php get_template_part( 'parts_singlefoot' ); ?>


						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1>記事が見つかりませんでした</h1>
									</header>
									<section class="entry-content">

										<p>お探しのページが見つかりませんでした。下記カテゴリーから記事をお探しになるか、キーワードで検索してみてください。</p>
		
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
									<footer class="article-footer">

									</footer>
							</article>

						<?php endif; ?>


					</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
