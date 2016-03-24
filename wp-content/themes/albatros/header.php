<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

<?php if ( get_theme_mod( 'opencage_appleicon' ) ) : ?>
		<link rel="apple-touch-icon" href="<?php echo get_theme_mod( 'opencage_appleicon' ); ?>">
<?php else : ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
<?php endif; ?>
<?php if ( get_theme_mod( 'opencage_favicon' ) ) : ?>
		<link rel="icon" href="<?php echo get_theme_mod( 'opencage_favicon' ); ?>">
<?php else : ?>
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.png">
<?php endif; ?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!--[if IE]>
<?php if ( get_theme_mod( 'opencage_favicon_ie' ) ) : ?>
		<link rel="shortcut icon" href="<?php echo get_theme_mod( 'opencage_favicon_ie' ); ?>">
<?php else : ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon.ico">
<?php endif; ?>
		<![endif]-->

		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="//css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
		<![endif]-->

<?php get_template_part( 'head' ); ?>

		<?php wp_head(); ?>


	</head>

	<body <?php body_class(); ?> itemscope itemtype="//schema.org/WebPage">

		<div id="container"<?php if ( get_option( 'side_options_right' ) ) : ?> class="sidebarleft"<?php endif; ?>>

		<?php if(!is_singular( 'post_lp' ) ): ?>
			
			<header class="header" role="banner" itemscope itemtype="//schema.org/WPHeader">

				<div id="inner-header" class="wrap cf">


					<?php if( is_mobile() ): ?>
					<p class="mobile_site_description"><?php bloginfo('description'); ?></p>
					<?php endif; ?>

<div id="logo">
					<?php if ( is_home() || is_front_page() ) : ?>
						<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
							<h1 class="h1 img" itemscope itemtype="//schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo esc_attr(get_theme_mod( 'opencage_logo' )); ?>" alt="<?php bloginfo('name'); ?>"></a></h1>
						<?php else : ?>
							<h1 class="h1 text" itemscope itemtype="//schema.org/Organization"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
						<?php endif; ?>
					<?php else: ?>
						<?php if ( get_theme_mod( 'opencage_logo' ) ) : ?>
							<p class="h1 img" itemscope itemtype="//schema.org/Organization"><a href="<?php echo home_url(); ?>"><img src="<?php echo esc_attr(get_theme_mod( 'opencage_logo' )); ?>" alt="<?php bloginfo('name'); ?>"></a></p>
						<?php else : ?>
							<p class="h1 text" itemscope itemtype="//schema.org/Organization"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
						<?php endif; ?>
					<?php endif; ?>
</div>					
					
					<div class="subnav cf">
					<?php if( !is_mobile() ): ?>
					<p class="site_description"><?php bloginfo('description'); ?></p>
					<?php endif; ?>
					
					<?php wp_nav_menu(array(
						'container' => 'div',
						'container_class' => 'contactbutton',
						'menu' => __( 'ヘッダーの問い合わせボタン（通常 問い合わせフォームのページを設定）' ),
						'menu_class' => '',
						'theme_location' => 'header-contact',
						'before' => '',
						'after' => '',
						'link_before' => '<i class="fa fa-envelope-o"></i>',
						'link_after' => '',
						'depth' => 0,
						'fallback_cb' => ''
						)); ?>
					
					<?php wp_nav_menu(array(
						'container' => false,
						'container_class' => 'submenu cf',
						'menu' => __( 'サブナビ' ),
						'menu_class' => 'linklist',
						'theme_location' => 'sub-nav',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'fallback_cb' => ''
						)); ?>
<?php if ( !get_option( 'header_options_search' ) ) : ?>					
					<?php get_search_form(); ?>
<?php endif; ?>
					</div>

					<nav id="g_nav" role="navigation" itemscope itemtype="//schema.org/SiteNavigationElement">
						<?php wp_nav_menu(array(
    					         'container' => false,
    					         'container_class' => 'menu cf',
    					         'menu' => __( 'グローバルナビ' ),
    					         'menu_class' => 'nav top-nav cf',
    					         'theme_location' => 'main-nav',
    					         'before' => '',
        			               'after' => '',
        			               'link_before' => '',
        			               'link_after' => '',
        			               'depth' => 0,
    					         'fallback_cb' => ''
						)); ?>

					</nav>

				</div>

			</header>


<?php breadcrumb(); ?>

<?php endif; ?>
