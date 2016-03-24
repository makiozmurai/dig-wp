<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
     $options = get_desing_plus_option();
     if($options['use_ogp']) {
?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title><?php seo_title(); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<?php if($options['use_ogp']) { ogp(); }; ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>">
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css<?php version_num(); ?>" type="text/css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/comment-style.css<?php version_num(); ?>" type="text/css">

<link rel="stylesheet" media="screen and (min-width:1165px)" href="<?php bloginfo('template_url'); ?>/style_pc.css<?php version_num(); ?>" type="text/css">
<link rel="stylesheet" media="screen and (max-width:1164px) and (min-width:641px)" href="<?php bloginfo('template_url'); ?>/style_tb.css<?php version_num(); ?>" type="text/css">
<link rel="stylesheet" media="screen and (max-width:640px)" href="<?php bloginfo('template_url'); ?>/style_sp.css<?php version_num(); ?>" type="text/css">

<?php if (strtoupper(get_locale()) == 'JA') ://to fix the font-size for japanese font ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/japanese.css<?php version_num(); ?>" type="text/css">
<?php endif; ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/styles/ihover.css<?php version_num(); ?>" type="text/css">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/footer_btns.css<?php version_num(); ?>" type="text/css">

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rollover.js<?php version_num(); ?>"></script>

<?php if(is_home()||is_front_page()){ ?>
<!-- slider -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/nivo-slider.css" type="text/css">
<script src="<?php bloginfo('template_url'); ?>/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#slider').nivoSlider({
		effect: 'fade',
		slices: 15,
		boxCols: 15,
		boxRows: 5,
		animSpeed: 500,
		pauseTime: 4000,
		directionNav: false,
		controlNav: false,
		controlNavThumbs: false
	});
});
</script>
<!-- /slider -->
<?php }; ?>

<style type="text/css">
body { font-size:<?php echo $options['content_font_size']; ?>px; }
a {color: #<?php echo $options['pickedcolor1']; ?>;}
a:hover {color: #<?php echo $options['pickedcolor2']; ?>;}
#global_menu ul ul li a{background:#<?php echo $options['pickedcolor1']; ?>;}
#global_menu ul ul li a:hover{background:#<?php echo $options['pickedcolor2']; ?>;}
.rank-best3-link a:hover, #ranking-index-link a:hover, .top-news-btn:hover, #more-recent-posts a:hover, .ranking_widget_btn a:hover{
	background-color: #<?php echo $options['pickedcolor2']; ?>;
}
#footer a:hover{
	color: #<?php echo $options['pickedcolor2']; ?>;
}
.page_navi a:hover{
	background: #<?php echo $options['pickedcolor2']; ?>;
}
#previous_next_post a:hover{
	background: #<?php echo $options['pickedcolor2']; ?>;
}
<?php if ($options['use_break_word']){ ?>
p { word-wrap:break-word; }
<?php }; ?>
<?php echo $options['css_code']; ?>
<?php if(is_home()||is_front_page()){ ?>
#maincopy span{
	background-image: url(<?php echo $options['maincopy_icon']; ?>);
	padding-left: 35px;
	display: inline-block;
	color: #<?php echo $options['pickedcolor1']; ?>;
}
<?php }; ?>
<?php if(get_post_meta($post->ID, "custom_css", true)){
	echo get_post_meta($post->ID, "custom_css", true);
}; ?>
</style>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<!-- header -->
	<div id="header">

		<!-- logo -->
		<div id="logo-area">
			<?php the_dp_logo(); ?>
		</div>
		<!-- /logo -->

		<!-- <a href="#" class="menu_button"><?php _e('menu', 'tcd-w'); ?></a> -->

		<!-- social link -->
		<?php if ($options['show_rss'] or $options['twitter_url'] or $options['facebook_url']) { ?>
		<div id="header_sociallink">
			<ul class="social_link">
				<?php if ($options['facebook_url']) : ?>
					<li class="facebook"><a class="target_blank" href="<?php echo $options['facebook_url']; ?>">facebook</a></li>
				<?php endif; ?>
				<?php if ($options['twitter_url']) : ?>
					<li class="twitter"><a class="target_blank" href="<?php echo $options['twitter_url']; ?>">twitter</a></li>
				<?php endif; ?>
				<?php if ($options['show_rss']) : ?>
					<li class="rss"><a class="target_blank" href="<?php bloginfo('rss2_url'); ?>">rss</a></li>
				<?php endif; ?>
			</ul>
		</div>
		<?php }; ?>
		<!-- social link -->

		<!-- global menu -->
		<?php if(!is_mobile()): ?>
		<div id="global_menu" class="clearfix">
			<?php if (has_nav_menu('global-menu')) { ?>
				<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'depth' => '2', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
			<?php }; ?>
		</div>
		<?php else: ?>
		<div class="mobi_global">
		    <label for="check" class="btn"><span class="fa fa-bars"></span><span class="menu-caption">Menu</span></label>
		    <input type="checkbox" class="check" id="check" />
					<?php if (has_nav_menu('mobile-menu')) { ?>
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'depth' => '1', 'theme_location' => 'mobile-menu' , 'container' => '' ) ); ?>
					<?php }; ?>
		    <label for="check" class="cbtn"></label>
		</div> 

		<div class="mobi_sidebar">
		    <label for="check2" class="btn"><span class="fa fa-outdent"></span><span class="menu-caption">Sidebar</span></label>
		    <input type="checkbox" class="check" id="check2" />
		    	<div id="sideColumn2">
				<?php
					if(is_home()) {
						if(is_active_sidebar('mobile_widget_index')) { dynamic_sidebar('mobile_widget_index'); };
					} elseif(is_single() and ('post' == get_post_type()||get_post_type()=="ranking_post"||get_post_type()=="ranking_post2"||get_post_type()=="ranking_post3"||get_post_type()=="news")) {
						if(is_active_sidebar('mobile_widget_single')) { dynamic_sidebar('mobile_widget_single'); };
					} else {
						if(is_active_sidebar('mobile_widget_archive')) { dynamic_sidebar('mobile_widget_archive'); };
					};
				?>
				</div>
		    <label for="check2" class="cbtn"></label>
		</div> 
		<?php endif; ?>
		<!-- /global menu -->
	</div>
	<!-- /header -->

<?php if(is_mobile() and !is_front_page()) { ?>
<!-- smartphone banner -->
<?php if($options['mobile_ad_code1']||$options['mobile_ad_image1']) { ?>
	<div id="mobile_banner_top">
		<?php if ($options['mobile_ad_code1']) { ?>
			<?php echo $options['mobile_ad_code1']; ?>
		<?php } else { ?>
			<a href="<?php esc_attr_e( $options['mobile_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" alt="" title=""></a>
		<?php }; ?>
	</div>
<?php }; ?>
<!-- /smartphone banner -->
<?php }; ?>

	<!-- contents -->
	<div id="contents" class="clearfix">

