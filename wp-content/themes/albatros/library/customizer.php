<?php

function opencage_customize_register($wp_customize) {
	
    $wp_customize->add_section( 'colors', array(
    'title' => __( '> サイトカラー設定', 'opencage' ),
    'priority' => 30,
    ) );

	$wp_customize->add_setting( 'opencage_color_maintext', array( 'default' => '#545B63', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_maintext', array(
    'label' => __( 'メインテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_maintext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_mainlink', array( 'default' => '#4B99B5', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_mainlink', array(
    'label' => __( 'リンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_mainlink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_mainlink_hover', array( 'default' => '#74B7CF', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_mainlink_hover', array(
    'label' => __( 'リンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_mainlink_hover',
    ) ) );
	  
	$wp_customize->add_setting( 'opencage_color_headerbg', array( 'default' => '#4B99B5', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerbg', array(
    'label' => __( 'ヘッダー背景（メインカラー）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headertext', array( 'default' => '#fff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headertext', array(
    'label' => __( 'ヘッダーテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headertext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerbtn', array( 'default' => '#235D72', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerbtn', array(
    'label' => __( 'ヘッダーボタン', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerbtn',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerbtn_hover', array( 'default' => '#3F7E94', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerbtn_hover', array(
    'label' => __( 'ヘッダーボタン（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerbtn_hover',
    ) ) );


	$wp_customize->add_setting( 'opencage_color_headerlink', array( 'default' => '#fff', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerlink', array(
    'label' => __( 'ヘッダーリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerlink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_headerlink_hover', array( 'default' => '#FFFF00', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_headerlink_hover', array(
    'label' => __( 'ヘッダーリンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_headerlink_hover',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_formbg', array( 'default' => '#eaedf2', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_formbg', array(
    'label' => __( '入力フォーム背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_formbg',
    ) ) );
    
    $wp_customize->add_setting( 'opencage_color_hukidashi', array( 'default' => '#5C6B80', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_hukidashi', array(
    'label' => __( '記事ページの吹き出し（H2）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_hukidashi',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_sidelink', array( 'default' => '#666', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_sidelink', array(
    'label' => __( 'サイドバーリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_sidelink',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_sidelink_hover', array( 'default' => '#999', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_sidelink_hover', array(
    'label' => __( 'サイドバーリンク（マウスオン時）', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_sidelink_hover',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footerbg', array( 'default' => '#323944', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footerbg', array(
    'label' => __( 'フッター背景', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footerbg',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footertext', array( 'default' => '#86909E', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footertext', array(
    'label' => __( 'フッターテキスト', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footertext',
    ) ) );

	$wp_customize->add_setting( 'opencage_color_footerlink', array( 'default' => '#B0B4BA', ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'opencage_color_footerlink', array(
    'label' => __( 'フッターリンク', 'opencage' ),
    'section' => 'colors',
    'settings' => 'opencage_color_footerlink',
    ) ) );

	  
         }
    add_action('customize_register', 'opencage_customize_register');
    
    function opencage_customize_css()
    {
    //初期カラー
    $maintext = get_theme_mod( 'opencage_color_maintext', '#5c6b80');
    $mainlink = get_theme_mod( 'opencage_color_mainlink', '#4B99B5');
    $mainlinkhover = get_theme_mod( 'opencage_color_mainlink_hover', '#74B7CF');
    $mainformbg = get_theme_mod( 'opencage_color_formbg', '#eaedf2');
    $mainhukidashi = get_theme_mod( 'opencage_color_hukidashi', '#5C6B80');
    $headerbg = get_theme_mod( 'opencage_color_headerbg', '#4B99B5');
    $headertext = get_theme_mod( 'opencage_color_headertext', '#fff');
    $headerbtn = get_theme_mod( 'opencage_color_headerbtn', '#235D72');
    $headerbtnhover = get_theme_mod( 'opencage_color_headerbtn_hover', '#3F7E94');
    $headerlink = get_theme_mod( 'opencage_color_headerlink', '#fff');
    $headerlinkhover = get_theme_mod( 'opencage_color_headerlink_hover', '#FFFF00');
    $sidelink = get_theme_mod( 'opencage_color_sidelink', '#666');
    $sidelinkhover = get_theme_mod( 'opencage_color_sidelink_hover', '#999');
    $footerbg = get_theme_mod( 'opencage_color_footerbg', '#323944');
    $footertext = get_theme_mod( 'opencage_color_footertext', '#86909E');
    $footerlink = get_theme_mod( 'opencage_color_footerlink', '#B0B4BA');
    ?>
<style type="text/css">
body{color: <?php echo $maintext; ?>;}
a{color: <?php echo $mainlink; ?>;}
a:hover{color: <?php echo $mainlinkhover; ?>;}
.hentry footer .post-categories li a,.hentry footer .tags a{  background: <?php echo $mainlink; ?>;  border:1px solid <?php echo $mainlink; ?>;}
.hentry footer .tags a{color:<?php echo $mainlink; ?>; background: none;}
.hentry footer .post-categories li a:hover,.hentry footer .tags a:hover{ background:<?php echo $mainlinkhover; ?>;  border-color:<?php echo $mainlinkhover; ?>;}
input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"],select,textarea,.field { background-color: <?php echo $mainformbg; ?>;}
/*ヘッダー*/
.header{background: <?php echo $headerbg; ?>;}
.header .subnav .site_description,.header .mobile_site_description{color:  <?php echo $headertext; ?>;}
.nav li a {color: <?php echo $headerlink; ?>;}
.nav li a:hover{color:<?php echo $headerlinkhover; ?>;}
.subnav .contactbutton a{background: <?php echo $headerbtn; ?>;}
.subnav .contactbutton a:hover{background:<?php echo $headerbtnhover; ?>;}
@media only screen and (min-width: 768px) {
	.nav ul {background: <?php echo $footerbg; ?>;}
	.nav li ul.sub-menu li a{color: <?php echo $footerlink; ?>;}
}
/*メインエリア*/
.byline .cat-name{background: <?php echo $headerbg; ?>; color:  <?php echo $headertext; ?>;}
.widgettitle {background: <?php echo $headerbg; ?>; color:  <?php echo $headertext; ?>;}
.widget li a:after{color: <?php echo $headerbg; ?>!important;}

/* 投稿ページ吹き出し見出し */
.single .entry-content h2{background: <?php echo $mainhukidashi; ?>;}
.single .entry-content h2:after{border-top-color:<?php echo $mainhukidashi; ?>;}
/* リスト要素 */
.entry-content ul li:before{ background: <?php echo $mainhukidashi; ?>;}
.entry-content ol li:before{ background: <?php echo $mainhukidashi; ?>;}
/* カテゴリーラベル */
.single .authorbox .author-newpost li .cat-name,.related-box li .cat-name{ background: <?php echo $headerbg; ?>;}
/* CTA */
.cta-inner{ background: <?php echo $footerbg; ?>;}
/* ローカルナビ */
.local-nav .title a{ background: <?php echo $mainlink; ?>;}
.local-nav .current_page_item a{color:<?php echo $mainlink; ?>;}
/* ランキングバッジ */
ul.wpp-list li a:before{background: <?php echo $headerbg; ?>;}
/* アーカイブのボタン */
.readmore a{border:1px solid <?php echo $mainlink; ?>;color:<?php echo $mainlink; ?>;}
.readmore a:hover{background:<?php echo $mainlink; ?>;color:#fff;}
/* ボタンの色 */
.btn-wrap a{background: <?php echo $mainlink; ?>;border: 1px solid <?php echo $mainlink; ?>;}
.btn-wrap a:hover{background: <?php echo $mainlinkhover; ?>;}
.btn-wrap.simple a{border:1px solid <?php echo $mainlink; ?>;color:<?php echo $mainlink; ?>;}
.btn-wrap.simple a:hover{background:<?php echo $mainlink; ?>;}
/* コメント */
.blue-btn, .comment-reply-link, #submit { background-color: <?php echo $mainlink; ?>; }
.blue-btn:hover, .comment-reply-link:hover, #submit:hover, .blue-btn:focus, .comment-reply-link:focus, #submit:focus {background-color: <?php echo $mainlinkhover; ?>; }
/* サイドバー */
.widget a{text-decoration:none; color:<?php echo $sidelink; ?>;}
.widget a:hover{color:<?php echo $sidelinkhover; ?>;}
/*フッター*/
#footer-top{background-color: <?php echo $footerbg; ?>; color: <?php echo $footertext; ?>;}
.footer a,#footer-top a{color: <?php echo $footerlink; ?>;}
#footer-top .widgettitle{color: <?php echo $footertext; ?>;}
.footer {background-color: <?php echo $footerbg; ?>;color: <?php echo $footertext; ?>;}
.footer-links li:before{ color: <?php echo $headerbg; ?>;}
/* ページネーション */
.pagination a, .pagination span,.page-links a , .page-links ul > li > span{color: <?php echo $mainlink; ?>;}
.pagination a:hover, .pagination a:focus,.page-links a:hover, .page-links a:focus{background-color: <?php echo $mainlink; ?>;}
.pagination .current:hover, .pagination .current:focus{color: <?php echo $mainlinkhover; ?>;}
</style>
<?php
    }
    add_action( 'wp_head', 'opencage_customize_css');

//カスタムロゴ
function opencage_logo_theme_customizer( $wp_customize ) {
    // Logo upload
    $wp_customize->add_section( 'opencage_logo_section' , array(
	    'title'       => __( '> サイトロゴ', 'opencage_logo' ),
	    'priority'    => 30,
	    'description' => 'ロゴ画像を利用する場合はこちらからアップロードしてください。推奨：346×88px',
	) );
	$wp_customize->add_setting( 'opencage_logo' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_logo', array(
		'label'        => __( 'ロゴ画像をアップロード', 'opencage_logo' ),
		'section'    => 'opencage_logo_section',
		'settings'   => 'opencage_logo',
	) ) );
}
add_action('customize_register', 'opencage_logo_theme_customizer');


//icon
function opencage_favicon_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'opencage_favicon_section' , array(
	    'title'       => __( '> サイトアイコン', 'opencage_favicon' ),
	    'priority'    => 30,
	    'description' => 'favicon、Appleタッチアイコンをアップロードできます。',
	) );
	$wp_customize->add_setting( 'opencage_favicon' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_favicon', array(
		'label'        => __( 'ファビコン（.png）をアップロード 推奨：32×32px', 'opencage_favicon' ),
		'section'    => 'opencage_favicon_section',
		'settings'   => 'opencage_favicon',
	) ) );
	$wp_customize->add_setting( 'opencage_favicon_ie' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_favicon_ie', array(
		'label'        => __( 'IE用ファビコン（.ico）をアップロード 推奨：16×16px', 'opencage_favicon_ie' ),
		'section'    => 'opencage_favicon_section',
		'settings'   => 'opencage_favicon_ie',
	) ) );
	$wp_customize->add_setting( 'opencage_appleicon' );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'opencage_appleicon', array(
		'label'        => __( 'アップルタッチアイコンをアップロード 推奨：144 x 144px', 'opencage_appleicon' ),
		'section'    => 'opencage_favicon_section',
		'settings'   => 'opencage_appleicon',
	) ) );
}
add_action('customize_register', 'opencage_favicon_theme_customizer');


add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
    $wp_customize->add_section( 'option_section', array(
        'title'          =>'> その他オプション',
        'priority'       => 30,
    ));
    $wp_customize->add_setting('sns_options_text', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'sns_options_text', array(
	    'settings' => 'sns_options_text',
	    'label' =>'記事下のシェアタイトルを変更',
		'description' => '<span style="font-size:10px;">記事ページのSNSボタンのタイトルを変更できます。デフォルト「シェア！」</span>',
	    'section' => 'option_section',
	));
    $wp_customize->add_setting('sns_options_hide', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'sns_options_hide', array(
	    'settings' => 'sns_options_hide',
	    'label' =>'SNSボタンを表示しない',
	    'section' => 'option_section',
	    'type' => 'checkbox',
	));
    $wp_customize->add_setting('side_options_right', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'side_options_right', array(
	    'settings' => 'side_options_right',
	    'label' =>'メインカラムを右側に変更する',
	    'section' => 'option_section',
	    'type' => 'checkbox',
	));

    $wp_customize->add_setting('opencage_toppage_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-simple',
	));
	$wp_customize->add_control( 'opencage_toppage_archivelayout', array(
	    'settings' => 'opencage_toppage_archivelayout',
	    'label' =>'トップページ記事レイアウト',
	    'section' => 'option_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-big' => 'ビッグ',
        ),
	));
    $wp_customize->add_setting('opencage_archivelayout', array(
	   'type'  => 'option',
	   'default' => 'toplayout-big',
	));
	$wp_customize->add_control( 'opencage_archivelayout', array(
	    'settings' => 'opencage_archivelayout',
	    'label' =>'その他一覧ページ記事レイアウト',
	    'section' => 'option_section',
	    'type' => 'radio',
	    'choices' => array(
            'toplayout-simple' => 'シンプル',
            'toplayout-big' => 'ビッグ',
        ),
	));

    $wp_customize->add_setting('header_options_search', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'header_options_search', array(
	    'settings' => 'header_options_search',
	    'label' =>'ヘッダーの検索ボックスを表示しない',
	    'section' => 'option_section',
	    'type' => 'checkbox',
	));	

    $wp_customize->add_setting('post_options_eyecatch', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'post_options_eyecatch', array(
	    'settings' => 'post_options_eyecatch',
	    'label' =>'記事・固定ページでアイキャッチを表示しない',
		'description' => '<span style="font-size:10px;">アイキャッチ画像を自動的に出力しないようにできます。</span>',
	    'section' => 'option_section',
	    'type' => 'checkbox',
	));	

    $wp_customize->add_setting('other_options_ga', array(
	   'type'  => 'option',
	));
	$wp_customize->add_control( 'other_options_ga', array(
	    'settings' => 'other_options_ga',
	    'label' =>'GoogleAnalyticsタグ',
		'description' => '<span style="font-size:10px;">Google Analyticsの認証IDを入力してください。（UA-xxxxxxxx-xx）</span>',
	    'section' => 'option_section',
	));
}


// カスタムヘッダー
$custom_header_defaults = array(
		'default-image'          => get_bloginfo('template_url').'/library/images/custom_header.png',
		'width'                  => 2400,
		'height'                 => 500,
		'header-text' => false,
);
add_theme_support( 'custom-header', $custom_header_defaults );