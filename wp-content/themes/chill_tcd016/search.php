<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_content">

 <?php
      global $query_string;
      query_posts($query_string . "&post_type=post");
 ?>
 <h2 class="headline1"><?php printf(__('Search results for - [ %s ]', 'tcd-w'), get_search_query()); ?></h2>

 <div id="post_list">

 <?php  if (have_posts()): while ( have_posts() ) : the_post(); ?>
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