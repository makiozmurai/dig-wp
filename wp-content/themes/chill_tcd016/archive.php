<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_content">

 <?php if (is_category()) { ?>
 <h2 class="headline1"><?php printf(__('CATEGORY<span>%s</span>', 'tcd-w'), single_cat_title('', false)); ?></h2>

 <?php } elseif( is_tag() ) { ?>
 <h2 class="headline1"><?php printf(__('TAG<span>%s</span>', 'tcd-w'), single_tag_title('', false) ); ?></h2>

 <?php } elseif (is_day()) { ?>
 <h2 class="headline1"><?php printf(__('ARCHIVE<span>%s</span>', 'tcd-w'), get_the_time(__('F jS, Y', 'tcd-w'))); ?></h2>

 <?php } elseif (is_month()) { ?>
 <h2 class="headline1"><?php printf(__('ARCHIVE<span>%s</span>', 'tcd-w'), get_the_time(__('F, Y', 'tcd-w'))); ?></h2>

 <?php } elseif (is_year()) { ?>
 <h2 class="headline1"><?php printf(__('ARCHIVE<span>%s</span>', 'tcd-w'), get_the_time(__('Y', 'tcd-w'))); ?></h2>

 <?php } elseif (is_author()) { ?>
 <?php global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
 <h2 class="headline1"><?php printf(__('ARCHIVE<span>%s</span>', 'tcd-w'), $curauth->display_name ); ?></h2>

 <?php } else { ?>
 <h2 class="headline1"><?php _e('BLOG ARCHIVE', 'tcd-w'); ?></h2>
 <?php }; ?>

 <div id="post_list">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <div class="post_item clearfix<?php if (!has_post_thumbnail()) { echo ' no_thumbnail'; }; ?>">
  <?php if ( has_post_thumbnail()) { ?>
  <a class="image" href="<?php the_permalink() ?>"><?php the_post_thumbnail('size1'); ?></a>
  <?php }; ?>
  <div class="info clearfix">
   <div class="meta clearfix">
    <p class="post_date"><span class="date"><?php the_time('j'); ?></span><span class="month"><?php $month = get_the_date('M'); if (strtoupper(get_locale()) == 'JA') { echo encode_date($month); } else { echo $month; }; ?></span></p>
    <ul<?php if ($options['show_comment']) { echo ' class="no_comment"'; }; ?>>
     <li class="archive_date"><?php the_time('Y', 'tcd-w'); ?></li>
     <li class="post_category"><?php the_category(', '); ?></li>
     <?php if ($options['show_comment']) : ?><li class="post_comment"><?php comments_popup_link(__('Write comment', 'tcd-w'), __('1 comment', 'tcd-w'), __('% comments', 'tcd-w')); ?></li><?php endif; ?>
    </ul>
   </div>
   <h4 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
   <p class="desc"><?php if (has_excerpt()) { the_excerpt(); } else { new_excerpt(120); }; ?></p>
  </div>
 </div>
 <?php endwhile; else: ?>
 <div class="post_item">
  <h4><?php _e("There is no registered post.","tcd-w"); ?></h4>
 </div>
 <?php endif; ?>

 </div>

 <div id="load_post"><?php next_posts_link( __( 'read more', 'tcd-w' ) ); ?></div>

</div><!-- END #main_content -->

<?php if(is_mobile()) { include('sidebar_mobile.php'); } else { ?>
<?php include('sidebar.php'); ?>
<?php if($options['layout'] == 'three_column1'||$options['layout'] == 'three_column2') { include('sidebar2.php'); }; ?>
<?php }; ?>

<?php get_footer(); ?>