<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--[if lt IE 9]><html xmlns="http://www.w3.org/1999/xhtml" class="ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
<title><?php seo_title(); ?></title>
<meta name="description" content="<?php seo_description(); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php $options = get_desing_plus_option(); ?>

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/comment-style.css<?php version_num(); ?>" type="text/css" />

<link rel="stylesheet" media="screen and (min-width:641px)" href="<?php bloginfo('template_url'); ?>/style_pc.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" media="screen and (max-width:640px)" href="<?php bloginfo('template_url'); ?>/style_sp.css<?php version_num(); ?>" type="text/css" />

<?php if (strtoupper(get_locale()) == 'JA') ://to fix the font-size for japanese font ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/japanese.css<?php version_num(); ?>" type="text/css" />
<?php endif; ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rollover.js<?php version_num(); ?>"></script>
<?php if ($options['fix_ad']) { ?><script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fix_ad.js<?php version_num(); ?>"></script><?php }; ?>
<!--[if lt IE 9]>
<link id="stylesheet" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style_pc.css<?php version_num(); ?>" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ie.js<?php version_num(); ?>"></script>
<![endif]-->

<?php if(is_home() || is_archive() || is_search()) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.infinitescroll.min.js<?php version_num(); ?>"></script>
<script type="text/javascript">
  jQuery(document).ready(function($){
    $('#post_list').infinitescroll({
      navSelector  : '#load_post',
      nextSelector : '#load_post a',
      itemSelector : '.post_item',
      animate      : true,
      extraScrollPx: 300,
      errorCallback: function() { 
          $('#infscr-loading').animate({opacity: 0.8},1000).fadeOut('normal');
      },
      loading: {
          msgText : '<?php _e('Loading post...', 'tcd-w');  ?>',
          finishedMsg : '<?php _e('No more post', 'tcd-w');  ?>',
          img : '<?php bloginfo('template_url'); ?>/img/common/loader.gif'
        }
      },function(arrayOfNewElems){
          $(arrayOfNewElems).hide();
          $(arrayOfNewElems).fadeIn('slow');
          $('#load_post a').show();
          $('a').not('#load_post a, .no_effect, a[href*=#]').click(function(){
            var pass = $(this).attr("href");
            $('#contents').animate({opacity:'0'},700,function(){
            location.href = pass;
            setTimeout(function(){
              $('#contents').css({opacity:'1'})
            },700);
          });
          return false;
        });
      }
    );
    $(window).unbind('.infscr');
    $('#load_post a').click(function(){
     $('#load_post a').hide();
     $('#post_list').infinitescroll('retrieve');
     $('#load_post').show();
     return false;
    });
  });
</script>
<?php }; ?>

<?php if ($options['header_layout']=='fixed') { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/header.js<?php version_num(); ?>"></script>
<?php }; ?>

<?php if ($options['color_type']=='type2') { ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style_black.css<?php version_num(); ?>" type="text/css" />
<?php }; ?>

<style type="text/css">
body { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }
<?php if ($options['color_type']=='type3') { ?>
a:hover, .headline1, #page_headline, .post_item .title a, #post_title, .side_headline, #comment_headline, #comment_header ul li.comment_switch_active a, #comment_header ul li#comment_closed p, #comment_header ul li a:hover
  { color:#<?php echo $options['pickedcolor']; ?>; }

.post_item .title a:hover, #related_post .post_date2, .widget_post_list .post_date2, .post_item ul li a:hover, #single_title_area .meta ul li a:hover
 { color:#<?php echo $options['pickedcolor2']; ?>; }

.post_date .month, #load_post a:hover, #wp-calendar td a:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, .widget_search #search-btn input:hover, .widget_search #searchsubmit:hover, #site_description, #global_menu li a:hover, #global_menu li.active_menu, #global_menu ul ul a:hover, #submit_comment:hover, #post_pagination a:hover
  { background-color:#<?php echo $options['pickedcolor']; ?>; }

.post_date .date, #header_top_wrap, #global_menu ul ul a, #footer_bottom_wrap, .mobile #header_top, .mobile #previous_next_post a:hover
 { background-color:#<?php echo $options['pickedcolor2']; ?>; }

#guest_info input:focus, #comment_textarea textarea:focus, #submit_comment:hover
 { border:1px solid #<?php echo $options['pickedcolor']; ?>; }

#header_top a.menu_button:hover { border:1px solid #<?php echo $options['pickedcolor']; ?>; background:#<?php echo $options['pickedcolor']; ?>; }
#header_top a.active { border:1px solid #<?php echo $options['pickedcolor']; ?>; background:#<?php echo $options['pickedcolor']; ?>; }

.mobile #global_menu ul ul a, .mobile #global_menu ul ul ul a, .mobile #global_menu ul ul ul ul a { background-color:#eee; }
.mobile #global_menu ul ul a:hover, .mobile #global_menu ul ul ul a:hover, .mobile #global_menu ul ul ul ul a:hover { background-color:#<?php echo $options['pickedcolor']; ?>; }

#header_bottom_wrap {
  background: -webkit-gradient(linear, left top, left bottom, color-stop(1.00, #<?php echo $options['pickedcolor3']; ?>), color-stop(0.00, #ffffff));
  background: -webkit-linear-gradient(#<?php echo $options['pickedcolor3']; ?>, #ffffff);
  background: -moz-linear-gradient(#<?php echo $options['pickedcolor3']; ?>, #ffffff);
  background: -o-linear-gradient(#<?php echo $options['pickedcolor3']; ?>, #ffffff);
  background: -ms-linear-gradient(#<?php echo $options['pickedcolor3']; ?>, #ffffff);
  background: linear-gradient(#<?php echo $options['pickedcolor3']; ?>, #ffffff);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#<?php echo $options['pickedcolor3']; ?>', endColorstr='#ffffff', GradientType=0);
}

#footer_bottom_wrap:before { 
  background: -webkit-gradient(linear, left top, left bottom, color-stop(1.00, #ffffff), color-stop(0.00, #<?php echo $options['pickedcolor3']; ?>));
  background: -webkit-linear-gradient(#ffffff, #<?php echo $options['pickedcolor3']; ?>);
  background: -moz-linear-gradient(#ffffff, #<?php echo $options['pickedcolor3']; ?>);
  background: -o-linear-gradient(#ffffff, #<?php echo $options['pickedcolor3']; ?>);
  background: -ms-linear-gradient(#ffffff, #<?php echo $options['pickedcolor3']; ?>);
  background: linear-gradient(#ffffff, #<?php echo $options['pickedcolor3']; ?>);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#<?php echo $options['pickedcolor3']; ?>', GradientType=0);
}
<?php }; ?>
</style>

</head>
<body<?php custom_body_class(); ?>>

 <div id="site_description">
  <h1><?php bloginfo('description'); ?></h1>
 </div>

 <div id="header_top_wrap">
  <div id="header_top" class="clearfix">

   <h2 id="header_logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h2>

   <!-- global menu -->
   <a href="#" class="menu_button"><?php _e('menu', 'tcd-w'); ?></a>
   <div id="global_menu" class="clearfix">
    <?php if (has_nav_menu('global-menu')) { wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); } else { ?>
    <ul>
     <?php wp_list_pages('title_li='); ?>
    </ul>
    <?php }; ?>
   </div>

   <!-- social button -->
   <?php if ($options['show_rss'] or $options['twitter_url'] or $options['facebook_url']) { ?>
   <ul class="social_link clearfix">
    <?php if ($options['show_rss']) : ?>
    <li class="icon_rss"><a class="target_blank no_effect" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url'); ?>/img/header/icon_rss.png" alt="rss" title="rss" /></a></li>
    <?php endif; ?>
    <?php if ($options['twitter_url']) : ?>
    <li class="icon_twitter"><a class="target_blank no_effect" href="<?php echo esc_url($options['twitter_url']); ?>"><img src="<?php bloginfo('template_url'); ?>/img/header/icon_twitter.png" alt="twitter" title="twitter" /></a></li>
    <?php endif; ?>
    <?php if ($options['facebook_url']) : ?>
    <li class="icon_facebook"><a class="target_blank no_effect" href="<?php echo esc_url($options['facebook_url']); ?>"><img src="<?php bloginfo('template_url'); ?>/img/header/icon_facebook.png" alt="facebook" title="facebook" /></a></li>
    <?php endif; ?>
   </ul>
   <?php }; ?>

  </div><!-- END #header_top -->
 </div><!-- END #header_top_wrap -->

 <div id="header_bottom_wrap">
  <div id="header_bottom" class="clearfix">

   <!-- logo -->
   <?php the_dp_logo(); ?>

   <!-- banner -->
   <?php if(is_mobile()) { ?>
   <?php if($options['mobile_ad_code1']||$options['mobile_ad_image1']) { ?>
   <div id="mobile_banner_top">
    <?php if ($options['mobile_ad_code1']) { ?>
     <?php echo $options['mobile_ad_code1']; ?>
    <?php } else { ?>
     <a href="<?php esc_attr_e( $options['mobile_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div>
   <?php }; ?>
   <?php } else { ?>
   <?php if($options['header_ad_code1']||$options['header_ad_image1']) { ?>
   <div id="header_banner">
    <?php if ($options['header_ad_code1']) { ?>
     <?php echo $options['header_ad_code1']; ?>
    <?php } else { ?>
     <a href="<?php esc_attr_e( $options['header_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['header_ad_image1'] ); ?>" alt="" title="" /></a>
    <?php }; ?>
   </div>
   <?php }; ?>
   <?php }; ?>

  </div><!-- END #header_bottom -->
 </div><!-- END #header_bottom_wrap -->

 <div id="contents" class="clearfix">

  <?php if(!is_page()&&is_home()) { if (get_header_image() !='') { ?>
  <div id="main_image">
   <img src="<?php header_image(); ?>" alt="" title="" />
  </div>
  <?php }; }; ?>
