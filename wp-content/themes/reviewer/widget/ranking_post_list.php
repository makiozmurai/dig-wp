<?php

 // Start class widget //
 class ranking_widget extends WP_Widget {

 // Constructor //
 function ranking_widget() {
  $widget_ops = array( 'classname' => 'ranking_widget', 'description' => __('Displays ranking post list.', 'tcd-w') ); // Widget Settings
  $control_ops = array( 'id_base' => 'ranking_widget' ); // Widget Control Settings
  parent::__construct( 'ranking_widget', __('Ranking post list (tcd ver)', 'tcd-w'), $widget_ops, $control_ops ); // Create the widget
 }

 // Extract Args //
 function widget($args, $instance) {
  extract( $args );
   $title = apply_filters('widget_title', $instance['title']);
   $post_num = $instance['post_num'];
   $post_type = $instance['post_type'];
   $show_link = $instance['show_link'];

   // Before widget //
   echo $before_widget;

   // Title of widget //
   if ( $title ) { echo $before_title . $title . $after_title; }

   // Widget output //
   if($post_type == 'ranking_post') {
     $my_meta_key = "my_rank";
     $args = array('post_type' => 'ranking_post', 'orderby' => 'meta_value_num', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'posts_per_page' => $post_num, 'post_status' => 'publish');
   } elseif($post_type == 'ranking_post2') {
     $my_meta_key = "my_rank2";
     $args = array('post_type' => 'ranking_post2', 'orderby' => 'meta_value_num', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'posts_per_page' => $post_num, 'post_status' => 'publish');
   }elseif($post_type == 'ranking_post3') {
     $my_meta_key = "my_rank3";
     $args = array('post_type' => 'ranking_post3', 'orderby' => 'meta_value_num', 'meta_key' => $my_meta_key, 'order' => 'ASC', 'posts_per_page' => $post_num, 'post_status' => 'publish');
   };

   $options = get_desing_plus_option();
   $pickup_post=new WP_Query($args);
?>
<ol class="ranking_widget">
<?php
   if ($pickup_post->have_posts()) {
    while ($pickup_post->have_posts()) : $pickup_post->the_post();
      $my_rank = get_post_meta(get_the_ID(), $my_meta_key, true);
      $myItemName = get_post_meta(get_the_ID(), 'myitemName', false);
?>
 <li class="clearfix">
   <div class="ranking_widget_thumb">
     <a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { the_post_thumbnail('widget_size'); } else { echo '<img src="'; bloginfo('template_url'); echo '/images/no_image3.jpg" alt="" title="" />'; }; ?></a>
   </div>
   <div class="ranking_widget_rank <?php echo 'ranking_widget_rank'.$my_rank; ?>"><p><?php echo $my_rank;?></p></div>
   <div class="ranking_widget_text">
     <a class="title" href="<?php the_permalink() ?>"><?php if(isset($myItemName[0])){ echo $myItemName[0]; }else{ the_title();}; ?></a>
    </div>
 </li>
<?php endwhile; wp_reset_query(); } else { ?>
 <li class="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></li>
<?php }; ?>
</ol>
<?php if($show_link == '1'): ?>
<p class="ranking_widget_btn"><a href="<?php echo get_post_type_archive_link($post_type); ?>"><?php _e('Ranking List', 'tcd-w');  ?></a>
<?php endif; ?>
<?php

   // After widget //
   echo $after_widget;

} // end function widget


 // Update Settings //
 function update($new_instance, $old_instance) {
  $instance['title'] = strip_tags($new_instance['title']);
  $instance['post_num'] = $new_instance['post_num'];
  $instance['post_type'] = $new_instance['post_type'];
  $instance['show_link'] = $new_instance['show_link'];

  return $instance;
 }

 // Widget Control Panel //
 function form($instance) {
  $defaults = array( 'title' => __('Ranking post', 'tcd-w'), 'post_num' => '3', 'post_type' => 'ranking_post', 'show_link' => '1');
  $instance = wp_parse_args( (array) $instance, $defaults );
?>
<p>
 <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'tcd-w'); ?></label>
 <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>'" type="text" value="<?php echo $instance['title']; ?>" />
</p>
<p>
 <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Ranking type:', 'tcd-w'); ?></label>
 <select id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" class="widefat" style="width:100%;">
  <option value="ranking_post" <?php selected('ranking_post', $instance['post_type']); ?>><?php _e('Ranking post', 'tcd-w'); ?></option>
  <option value="ranking_post2" <?php selected('ranking_post2', $instance['post_type']); ?>><?php _e('Ranking post2', 'tcd-w'); ?></option>
  <option value="ranking_post3" <?php selected('ranking_post3', $instance['post_type']); ?>><?php _e('Ranking post3', 'tcd-w'); ?></option>
 </select>
</p>
<p>
 <label for="<?php echo $this->get_field_id('post_num'); ?>"><?php _e('Number of post:', 'tcd-w'); ?></label>
 <select id="<?php echo $this->get_field_id('post_num'); ?>" name="<?php echo $this->get_field_name('post_num'); ?>" class="widefat" style="width:100%;">
  <option value="1" <?php selected('1', $instance['post_num']); ?>>1</option>
  <option value="2" <?php selected('2', $instance['post_num']); ?>>2</option>
  <option value="3" <?php selected('3', $instance['post_num']); ?>>3</option>
  <option value="4" <?php selected('4', $instance['post_num']); ?>>4</option>
  <option value="5" <?php selected('5', $instance['post_num']); ?>>5</option>
  <option value="6" <?php selected('6', $instance['post_num']); ?>>6</option>
  <option value="7" <?php selected('7', $instance['post_num']); ?>>7</option>
  <option value="8" <?php selected('8', $instance['post_num']); ?>>8</option>
  <option value="9" <?php selected('9', $instance['post_num']); ?>>9</option>
  <option value="10" <?php selected('10', $instance['post_num']); ?>>10</option>
 </select>
</p>
<p>
 <input id="<?php echo $this->get_field_id('show_link'); ?>" name="<?php echo $this->get_field_name('show_link'); ?>" type="checkbox" value="1" <?php checked( '1', $instance['show_link'] ); ?> />
 <label for="<?php echo $this->get_field_id('show_link'); ?>"><?php _e('Display Link button to ranking list', 'tcd-w'); ?></label>
</p>
<?php
 } // end function form
}

// End class widget
add_action('widgets_init', create_function('', 'return register_widget("ranking_widget");'));
?>