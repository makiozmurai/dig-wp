<?php $options = get_desing_plus_option(); ?>

 </div><!-- END #contents -->

 <!-- smartphone banner -->
 <?php if(is_mobile()) { ?>
 <?php if($options['mobile_ad_code2']||$options['mobile_ad_image2']) { ?>
 <div id="mobile_banner_bottom">
  <?php if ($options['mobile_ad_code2']) { ?>
   <?php echo $options['mobile_ad_code2']; ?>
  <?php } else { ?>
   <a href="<?php esc_attr_e( $options['mobile_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" alt="" title="" /></a>
  <?php }; ?>
 </div>
 <?php }; ?>
 <?php }; ?>

 <div id="footer_bottom_wrap">
  <div id="footer_bottom" class="clearfix">

   <p id="copyright"><?php _e('Copyright &copy;&nbsp; ', 'tcd-w'); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> All rights reserved.</p>

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

   <a id="return_top" href="#header"><?php _e('Return Top', 'tcd-w'); ?></a>
  </div>
 </div>

<?php if($options['show_bookmark']) { ?>
<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }; ?>

<?php wp_footer(); ?>
</body>
</html>