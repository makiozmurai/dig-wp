<?php

function add_custom_meta_boxes7() {
 add_meta_box(
  'custom_css',//ID of meta box
  __('Free input area for user definition CSS (apply to this page only)', 'tcd-w'),//label
  'custom_css',//callback function
  'post',// post type
  'advanced'
 );
}
add_action('add_meta_boxes', 'add_custom_meta_boxes7');

function custom_css(){

    global $post;
    //wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    $custom_css = get_post_meta($post->ID,'custom_css',true);

    echo '<input type="hidden" name="custom_css_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

?>
<p><?php _e('Code example:<br /><strong>.example { font-size:12px; }</strong>', 'tcd-w');  ?></p>
<textarea rows="5" name="custom_css" style="width:100%;"><?php echo get_post_meta($post->ID, 'custom_css', true); ?></textarea>
<?php
}

// Save data from meta box
add_action('save_post', 'save_custom_css_meta_box');
function save_custom_css_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['custom_css_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_css_meta_box_nonce'], basename(__FILE__))) {
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
  if (isset($_POST['custom_css']) ) {
   update_post_meta($post_id, 'custom_css', $_POST['custom_css'] );
  } else {
   delete_post_meta( $post_id, 'custom_css') ;
  };

}







?>