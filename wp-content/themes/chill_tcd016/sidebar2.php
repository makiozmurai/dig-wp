<div id="side_col2" class="side_col">

 <?php
      if(is_home() and is_active_sidebar('index_side_widget2')){ dynamic_sidebar('index_side_widget2'); }
      elseif(is_archive() and is_active_sidebar('archive_side_widget2') or is_search() and is_active_sidebar('archive_side_widget2')) { dynamic_sidebar('archive_side_widget2'); }
      elseif(is_single() and is_active_sidebar('single_side_widget2') or is_page() and is_active_sidebar('single_side_widget2')) { dynamic_sidebar('single_side_widget2'); }
      else {
 ?>

 <div class="side_widget clearfix">
  <h3 class="side_headline"><?php _e("Recent post","tcd-w"); ?></h3>
  <ul>
   <?php $myposts = get_posts('numberposts=5'); foreach($myposts as $post) : ?>
   <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
   <?php endforeach; ?>
  </ul>
 </div>

 <div class="side_widget clearfix">
  <h3 class="side_headline"><?php _e("Category","tcd-w"); ?></h3>
  <ul>
   <?php wp_list_categories('orderby=name&title_li='); ?>
  </ul>
 </div>

 <div class="side_widget clearfix">
  <h3 class="side_headline"><?php _e("Calendar","tcd-w"); ?></h3>
  <?php get_calendar(true); ?>
 </div>

 <?php }; ?>

</div>