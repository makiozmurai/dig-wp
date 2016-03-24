<?php

/*********************
head内クリーンアップ
*********************/

function opencage_head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	add_filter( 'style_loader_src', 'opencage_remove_wp_ver_css_js', 9999 );
	add_filter( 'script_loader_src', 'opencage_remove_wp_ver_css_js', 9999 );
}

// titleタグを最適化（ | でつなぐ）
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  if ( is_feed() ) return $title;

  $sep = " | ";
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } elseif ( is_home() || is_front_page() ){
	$title = $title . get_bloginfo( 'name' );  
  } else {
    $title = $title . "{$sep}" . get_bloginfo( 'name' );
  }

  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= "{$sep}{$site_description}";
  }

  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( '%sページ目', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

}

function opencage_rss_version() { return ''; }

function opencage_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

function opencage_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

function opencage_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}




/*********************
SCRIPTS
*********************/

if (!is_admin()) {
	function register_script(){
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), '1.7.2' );
		wp_register_script( 'css-modernizr', get_bloginfo('template_directory'). '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', true );
		wp_register_script( 'jquery.meanmenu', get_bloginfo('template_directory'). '/library/js/libs/jquery.meanmenu.min.js', array('jquery'), '2.0.8', true );
		wp_register_script( 'jquery.bxslider', get_bloginfo('template_directory'). '/library/js/libs/jquery.bxslider.min.js', array('jquery'), '4.1.2', true );
		wp_register_script( 'main-js', get_bloginfo('template_directory'). '/library/js/scripts.js', array( 'jquery' ), '', true );
	}
	function add_script() {
		register_script();
		if(is_front_page() || is_home()) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'jquery.meanmenu' );
			wp_enqueue_script( 'jquery.bxslider' );
			wp_enqueue_script( 'main-js' );
			wp_enqueue_script( 'css-modernizr' );
			}
			else {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'jquery.meanmenu' );
			wp_enqueue_script( 'main-js' );
			wp_enqueue_script( 'css-modernizr' );
			}
	}
	add_action('wp_print_scripts', 'add_script');
}

/*********************
CSS
*********************/
function register_style() {
	wp_register_style('style', get_bloginfo('template_directory').'/style.css');
	wp_register_style('shortcode', get_bloginfo('template_directory').'/library/css/shortcode.css');
	wp_register_style('slider', get_bloginfo('template_directory').'/library/css/bx-slider.css');
	wp_register_style('lp_css', get_bloginfo('template_directory').'/library/css/lp.css');
}
	function add_stylesheet() {
		register_style();
			wp_enqueue_style('style');
			wp_enqueue_style('shortcode');
		if(is_singular( 'post_lp' )) {
			wp_enqueue_style('lp_css');
		}
		elseif (is_home() || is_front_page()) {
			wp_enqueue_style('slider');
		}
	}
add_action('wp_print_styles', 'add_stylesheet');



/*********************
アーカイブページ設定
*********************/

// 一覧ページの抜粋のPを削除
function opencage_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// more
function opencage_excerpt_more($more) {
	global $post;
	return '...';
}



/*********************
include function file
*********************/
require_once( 'library/admin.php' );
require_once( 'library/shortcode.php' );
require_once( 'library/widget.php' );
require_once( 'library/custom-post-type.php' );

//UPDATE CHECK
require 'library/theme-update-checker.php';
$example_update_checker = new ThemeUpdateChecker(
'albatros',
'//open-cage.com/theme-update/albatros/update-info.json'
);


/*********************
THEME SUPPORT
*********************/

// カスタマイザー（カラー設定）不要な場合は下の一行を消すか「 // 」でコメントアウトする
require_once( 'library/customizer.php' );

function opencage_theme_support() {

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'custom-background',
	    array(
	    'default-image' => get_template_directory_uri() .'/library/images/body_bg01.png',
	    'default-color' => 'f7f7f7',
	    'wp-head-callback' => '_custom_background_cb',
	    'admin-head-callback' => '',
	    'admin-preview-callback' => ''
	    )
	);

	add_theme_support('automatic-feed-links');

	add_theme_support( 'menus' );

	register_nav_menus(
		array(
			'main-nav' => __( 'グローバルナビ' ),
			'sub-nav' => __( 'サブナビゲーション（2個まで）' ),
			'header-contact' => __( 'ヘッダーの問い合わせボタン（通常 問い合わせフォームのページを設定）' ),
			'footer-links' => __( 'フッターナビ' )
		)
	);

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form'
	) );

}



function opencage_ahoy() {

// THEME CSS EDITOR INCLUDE
add_editor_style( get_bloginfo('template_url') . '/library/css/editor-style.css' );

  add_action( 'init', 'opencage_head_cleanup' );
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  add_filter( 'the_generator', 'opencage_rss_version' );
  add_filter( 'wp_head', 'opencage_remove_wp_widget_recent_comments_style', 1 );
  add_action( 'wp_head', 'opencage_remove_recent_comments_style', 1 );



  // launching this stuff after theme setup
  opencage_theme_support();

  add_action( 'widgets_init', 'theme_register_sidebars' );
  add_filter( 'the_content', 'opencage_filter_ptags_on_images' );
  add_filter( 'excerpt_more', 'opencage_excerpt_more' );
}
add_action( 'after_setup_theme', 'opencage_ahoy' );


// 埋め込みコンテンツサイズ
if ( ! isset( $content_width ) ) {
	$content_width = 654;
}

// 独自アイキャッチ画像
add_image_size( 'home-thum', 300, 200, true );
add_image_size( 'single-thum', 718, 9999 );
add_image_size( 'slide-thum', 720, 370, true );


//パンくずナビ
function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "breadcrumb inner wrap cf")){
    global $post;
    $str ='';
    if(!is_home()&&!is_front_page()&&!is_admin()){
        $tagAttribute = '';
        foreach($divOption as $attrName => $attrValue){
            $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
        }
        $str.= '<div'. $tagAttribute .'>';
        $str.= '<ul>';
        $str.= '<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. home_url() .'/" itemprop="url"><i class="fa fa-home"></i> ホーム</a></li>';
 
        if(is_category()) {
            $cat = get_queried_object();
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url">'. get_cat_name($ancestor) .'</a></li>';
                }
            }
            $str.='<li itemtype="//data-vocabulary.org/Breadcrumb">'. $cat -> name . '</li>';
        } elseif(is_single()){
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url">'. get_cat_name($ancestor). '</a></li>';
                }
            }
            $str.='<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url">'. $cat-> cat_name . '</a></li>';
            $str.= '<li itemtype="//data-vocabulary.org/Breadcrumb">'. $post -> post_title .'</li>';
        } elseif(is_page()){
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                foreach($ancestors as $ancestor){
                    $str.='<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url">'. get_the_title($ancestor) .'</a></li>';
                }
            }
            $str.= '<li itemtype="//data-vocabulary.org/Breadcrumb">'. $post -> post_title .'</li>';
        } elseif(is_date()){
			if( is_year() ){
				$str.= '<li>' . get_the_time('Y') . '年</li>';
			} else if( is_month() ){
				$str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
				$str.= '<li>' . get_the_time('n') . '月</li>';
			} else if( is_day() ){
				$str.= '<li><a href="' . get_year_link(get_the_time('Y')) .'">' . get_the_time('Y') . '年</a></li>';
				$str.= '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('n') . '月</a></li>';
				$str.= '<li>' . get_the_time('j') . '日</li>';
			}
			if(is_year() && is_month() && is_day() ){
				$str.= '<li>' . wp_title('', false) . '</li>';
			}
        } elseif(is_search()) {
            $str.='<li itemtype="//data-vocabulary.org/Breadcrumb">「'. get_search_query() .'」で検索した結果</li>';
        } elseif(is_author()){
            $str .='<li itemtype="//data-vocabulary.org/Breadcrumb">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</li>';
        } elseif(is_tag()){
            $str.='<li itemtype="//data-vocabulary.org/Breadcrumb">タグ : '. single_tag_title( '' , false ). '</li>';
        } elseif(is_attachment()){
            $str.= '<li itemtype="//data-vocabulary.org/Breadcrumb">'. $post -> post_title .'</li>';
        } elseif(is_404()){
            $str.='<li>ページがみつかりません。</li>';
        } else{
            $str.='<li itemtype="//data-vocabulary.org/Breadcrumb">'. wp_title('', true) .'</li>';
        }
        $str.='</ul>';
        $str.='</div>';
    }
    echo $str;
}

// is_mobile追加
function is_mobile(){
$useragents = array(
'iPhone', // iPhone
'iPod', // iPod touch
'Android.*Mobile', // 1.5+ Android *** Only mobile
'Windows.*Phone', // *** Windows Phone
'dream', // Pre 1.5 Android
'CUPCAKE', // 1.5+ Android
'blackberry9500', // Storm
'blackberry9530', // Storm
'blackberry9520', // Storm v2
'blackberry9550', // Storm v2
'blackberry9800', // Torch
'webOS', // Palm Pre Experimental
'incognito', // Other iPhone browser
'webmate' // Other iPhone browser
);
$pattern = '/'.implode('|', $useragents).'/i';
return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


// 固定ページでタグを使用可能にする
function add_tag_to_page() {
 register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_tag_to_page');


//カスタムメニューに「説明」を追加（ナビゲーションの英語テキストに使用）
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);
function description_in_nav_menu($item_output, $item){
	return preg_replace('/(<a.*?>[^<]*?)</', '$1' . "<span class=\"gf\">{$item->description}</span><", $item_output);
}


//ユーザーページでHTMLを保存可能にする
remove_filter('pre_user_description', 'wp_filter_kses');

//ユーザー項目の追加と削除
function update_profile_fields( $contactmethods ) {
    //項目の削除
    unset($contactmethods['aim']);
    unset($contactmethods['jabber']);
    unset($contactmethods['yim']);
    //項目の追加
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google+';
     
    return $contactmethods;
}
add_filter('user_contactmethods','update_profile_fields',10,1);

// ページネーション
function pagination($pages = '', $range = 2)
{
     global $wp_query, $paged;

	$big = 999999999;

	echo "<nav class=\"pagination cf\">\n";
 	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'current' => max( 1, get_query_var('paged') ),
		'prev_text'    => __('<'),
		'next_text'    => __('>'),
		'type'    => 'list',
		'total' => $wp_query->max_num_pages
	) );
	echo "</nav>\n";
}


//セルフピンバック禁止
function no_self_pingst( &$links ) {
    $home = home_url();
    foreach ( $links as $l => $link )
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_pingst' );

//iframeのレスポンシブ対応
function wrap_iframe_in_div($the_content) {
  if ( is_singular() ) {
    $the_content = preg_replace('/< *?iframe/i', '<div class="youtube-container"><iframe', $the_content);
    $the_content = preg_replace('/<\/ *?iframe *?>/i', '</iframe></div>', $the_content);
  }
  return $the_content;
}
add_filter('the_content','wrap_iframe_in_div');


?>