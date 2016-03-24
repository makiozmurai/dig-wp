<?php

function add_custom_meta_boxes5() {
 add_meta_box(
  'wp_ranking_post',//ID of meta box
  __('Rank', 'tcd-w'),//label
  'my_rank2',//callback function
  'ranking_post2',// post type
  'side'
 );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes5');

function my_rank2(){

    global $post;
    //wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    $ranking_post_rank2 = get_post_meta($post->ID,'ranking_post_rank2',true);

    echo '<input type="hidden" name="ranking_post_rank2_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

?>
<p><?php _e('Enter the number of rank for this ranking post.', 'tcd-w');  ?></p>
<label><input type="text" name="my_rank2" value="<?php echo esc_html(get_post_meta($post->ID, 'my_rank2', true)); ?>"  style="width:20%" /></label>
<?php
}

// Save data from meta box
add_action('save_post', 'save_ranking_post_rank2_meta_box');
function save_ranking_post_rank2_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['ranking_post_rank2_meta_box_nonce']) || !wp_verify_nonce($_POST['ranking_post_rank2_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  if (isset($_POST['my_rank2']) ) {
   update_post_meta($post_id, 'my_rank2', $_POST['my_rank2'] );
  } else {
   delete_post_meta( $post_id, 'my_rank2') ;
  };

}







?>