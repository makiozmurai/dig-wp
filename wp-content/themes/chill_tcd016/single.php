<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_content">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div id="single_title_area" class="clearfix">
  <p class="post_date"><span class="date"><?php the_time('j'); ?></span><span class="month"><?php $month = get_the_date('M'); if (strtoupper(get_locale()) == 'JA') { echo encode_date($month); } else { echo $month; }; ?></span></p>
  <div class="meta">
   <h2 id="post_title"><?php the_title(); ?></h2>
   <ul class="clearfix">
    <li class="archive_date"><?php the_time('Y', 'tcd-w'); ?></li>
    <li class="post_category"><?php the_category(', '); ?></li>
    <?php the_tags('<li class="post_tag">',', ','</li>'); ?>
    <?php if ($options['show_comment']) : ?><li class="post_comment"><?php comments_popup_link(__('Write comment', 'tcd-w'), __('1 comment', 'tcd-w'), __('% comments', 'tcd-w')); ?></li><?php endif; ?>
    <?php if ($options['show_author']) : ?><li class="post_author"><?php the_author_posts_link(); ?></li><?php endif; ?>
   </ul>
  </div>
 </div>

 <div class="post clearfix">

  <?php if(!is_mobile()) { ?>
  <?php if($options['single_ad_code1']||$options['single_ad_image1']) { ?>
  <div id="single_banner1">
   <?php if ($options['single_ad_code1']) { ?>
    <?php echo $options['single_ad_code1']; ?>
   <?php } else { ?>
    <a href="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" alt="" title="" /></a>
   <?php }; ?>
  </div>
  <?php }; ?>
  <?php }; ?>

  <?php if ( has_post_thumbnail() and $page=='1') { ?><div class="post_image"><?php the_post_thumbnail('large'); ?></div><?php }; ?>

  <?php the_content(__('Read more', 'tcd-w')); ?>
  <?php custom_wp_link_pages(); ?>

  <?php if($options['show_bookmark']) { include('bookmark.php'); };?>

  <?php if(!is_mobile()) { ?>
  <?php if($options['single_ad_code2']||$options['single_ad_image2']) { ?>
  <div id="single_banner2">
   <?php if ($options['single_ad_code2']) { ?>
    <?php echo $options['single_ad_code2']; ?>
   <?php } else { ?>
    <a href="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" alt="" title="" /></a>
   <?php }; ?>
  </div>
  <?php };?>
  <?php };?>

 </div><!-- END .post -->

 <?php endwhile; endif; ?>

 <?php if ($options['show_next_post']) : ?>
 <div id="previous_next_post" class="clearfix">
  <p id="previous_post"><?php previous_post_link('%link') ?></p>
  <p id="next_post"><?php next_post_link('%link') ?></p>
 </div>
 <?php endif; ?>

 <?php // related post
      if ($options['show_related_post']) :
      $odd_or_even = 'odd';
      $categories = get_the_category($post->ID);
      if ($categories) {
      $category_ids = array();
       foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        $args=array(
                    'category__in' => $category_ids,
                    'post__not_in' => array($post->ID),
                    'showposts'=>4,
                    'orderby' => 'rand'
                  );
       $my_query = new wp_query($args);
       $i = 1;
       if($my_query->have_posts()) {
 ?>
 <h3 class="headline1"><?php _e("Related post","tcd-w"); ?></h3>
 <div id="related_post">
  <ul class="clearfix">
    <?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
   <li class="clearfix <?php echo $odd_or_even; ?>">
    <?php if ( has_post_thumbnail()) { ?>
    <a class="image" href="<?php the_permalink() ?>"><?php the_post_thumbnail('size2'); ?></a>
    <?php } else { ?>
    <p class="post_date"><span class="date"><?php the_time('j'); ?></span><span class="month"><?php $month = get_the_date('M'); if (strtoupper(get_locale()) == 'JA') { echo encode_date($month); } else { echo $month; }; ?></span></p>
    <?php }; ?>
    <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
    <?php if ( has_post_thumbnail()) { ?><p class="post_date2"><?php the_time('Y.m.d'); ?></p><?php }; ?>
   </li>
   <?php $odd_or_even = ('odd'==$odd_or_even) ? 'even' : 'odd'; }; ?>
  </ul>
 </div>
 <?php }; }; wp_reset_query(); ?>
 <?php endif; ?>

 <?php if ($options['show_comment']) : if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); }; endif; ?>

</div><!-- END #main_content -->

<?php if(is_mobile()) { include('sidebar_mobile.php'); } else { ?>
<?php include('sidebar.php'); ?>
<?php if($options['layout'] == 'three_column1'||$options['layout'] == 'three_column2') { include('sidebar2.php'); }; ?>
<?php }; ?>

<?php get_footer(); ?>