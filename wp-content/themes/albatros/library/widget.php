<?php
// ウィジェット
function theme_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'メインサイドバー', 'albatrostheme' ),
		'description' => __( 'メインのサイドバーです。', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'スクロール広告用', 'albatrostheme' ),
		'description' => __( '「テキスト」や「WordPress Popular Posts」などを追加してバナーや読んで欲しい記事を設定できる ※スマホの場合はサイドバーの一番上に表示される', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	
	register_sidebar(array(
		'id' => 'addbanner-sp-side',
		'name' => __( 'Adsense広告-サイドバー（mobile）', 'albatrostheme' ),
		'description' => __( 'サイドバー上部にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはモバイル用！【推奨サイズ】300×250', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-pc-side',
		'name' => __( 'Adsense広告-サイドバー（PC）', 'albatrostheme' ),
		'description' => __( 'サイドバー上部にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはパソコン用！【推奨サイズ】336×280', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-sp-titleunder',
		'name' => __( 'Adsense広告-記事タイトル下（mobile）', 'albatrostheme' ),
		'description' => __( '記事タイトル下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはモバイル用！【推奨サイズ】300×250', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'addbanner-pc-titleunder',
		'name' => __( 'Adsense広告-記事タイトル下（PC）', 'albatrostheme' ),
		'description' => __( '記事タイトル下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはパソコン用！【推奨サイズ】468×60 or レスポンシブ', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'addbanner-sp-contentfoot',
		'name' => __( 'Adsense広告-記事下（mobile）', 'albatrostheme' ),
		'description' => __( '記事コンテンツ下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはモバイル用！【推奨サイズ】300×250', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));


	register_sidebar(array(
		'id' => 'addbanner-pc-contentfoot',
		'name' => __( 'Adsense広告-記事下（PC）', 'albatrostheme' ),
		'description' => __( '記事コンテンツ下にAdsenseなどの広告を表示します。テキストウィジェットを追加して広告コードを貼り付けて下さい。こちらはパソコン用！【推奨サイズ】336×280', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	
	register_sidebar(array(
		'id' => 'footer1',
		'name' => __( 'フッター（左）', 'albatrostheme' ),
		'description' => __( 'フッターの左端', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	
	register_sidebar(array(
		'id' => 'footer2',
		'name' => __( 'フッター（真ん中）', 'albatrostheme' ),
		'description' => __( 'フッターの真ん中', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));
	
	register_sidebar(array(
		'id' => 'footer3',
		'name' => __( 'フッター（右）', 'albatrostheme' ),
		'description' => __( 'フッターの右端', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="widget footerwidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle"><span>',
		'after_title' => '</span></h4>',
	));

	register_sidebar(array(
		'id' => 'cta',
		'name' => __( 'CTA設定', 'albatrostheme' ),
		'description' => __( '記事（single）の一番下にColl To Actionを設置できます。「テキスト」を追加してテキストやコードを貼るか、「Black Studio TinyMCE Widget（プラグイン）」などのビジュアルエディタを追加してもOKです。', 'albatrostheme' ),
		'before_widget' => '<div id="%1$s" class="ctawidget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	));

}


//ウィジェット内でショートコードを使用可能に
add_filter('widget_text', 'do_shortcode');


// カテゴリの投稿数をaタグの中に
add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
function my_list_categories( $output, $args ) {
  $output = preg_replace('/<\/a>\s*\((\d+)\)/',' ($1)</a>',$output);
  return $output;
}

// アーカイブの投稿数をaタグの中に
add_filter( 'get_archives_link', 'my_archives_link' );
function my_archives_link( $output ) {
  $output = preg_replace('/<\/a>\s*(&nbsp;)\((\d+)\)/',' ($2)</a>',$output);
  return $output;
}

// 新着記事のフォーマットを変更
class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
 
	function widget($args, $instance) {
	
		extract( $args );
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
				
		if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
			$number = 10;
					
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if( $r->have_posts() ) :
			
			echo $before_widget;
			if( $title ) echo $before_title . $title . $after_title; ?>
			<ul>
				<?php while( $r->have_posts() ) : $r->the_post(); ?>				
				<li class="cf">
					<a class="cf" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<figure class="eyecatch">
							<?php the_post_thumbnail('home-thum'); ?>
						</figure>
						<?php else: ?>
						<figure class="eyecatch noimg">
							<img src="<?php echo get_template_directory_uri(); ?>/library/images/noimg.png">
						</figure>
						<?php endif; ?>
						<?php the_title(); ?>
						<span class="date"><?php the_time('Y.m.d'); ?></span>
					</a>
				</li>
				<?php endwhile; ?>
			</ul>
			 
			<?php
			echo $after_widget;
		
		wp_reset_postdata();
		
		endif;
	}
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');



?>
