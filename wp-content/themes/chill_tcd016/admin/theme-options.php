<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array 
 */
global $dp_default_options;
$dp_default_options = array(
	'logotop' => 0,
	'logoleft' => 0,
	'pickedcolor' => 'E48898',
	'pickedcolor2' => 'C46780',
	'pickedcolor3' => 'F7DBDF',
	'content_font_size' => '14',
	'show_author' => 1,
	'show_comment' => 1,
	'show_trackback' => 1,
	'show_bookmark' => 1,
	'show_next_post' => 1,
	'show_related_post' => 1,
	'show_rss' => 1,
	'layout'  => 'right',
	'color_type'  => 'type1',
	'header_layout'  => 'no-fixed',
	'twitter_url' => '',
	'facebook_url' => '',
	'header_ad_code1' => '',
	'header_ad_url1' => '',
	'header_ad_image1' => false,
	'single_ad_code1' => '',
	'single_ad_url1' => '',
	'single_ad_image1' => false,
	'single_ad_code2' => '',
	'single_ad_url2' => '',
	'single_ad_image2' => false,
	'side_ad_top_code1' => '',
	'side_ad_top_url1' => '',
	'side_ad_top_image1' => false,
	'side_ad_top_code2' => '',
	'side_ad_top_url2' => '',
	'side_ad_top_image2' => false,
	'side_ad_top_code3' => '',
	'side_ad_top_url3' => '',
	'side_ad_top_image3' => false,
	'side_ad_bottom_code1' => '',
	'side_ad_bottom_url1' => '',
	'side_ad_bottom_image1' => false,
	'side_ad_bottom_code2' => '',
	'side_ad_bottom_url2' => '',
	'side_ad_bottom_image2' => false,
	'side_ad_bottom_code3' => '',
	'side_ad_bottom_url3' => '',
	'side_ad_bottom_image3' => false,
	'fix_ad' => '',
	'mobile_ad_code1' => '',
	'mobile_ad_url1' => '',
	'mobile_ad_image1' => false,
	'mobile_ad_code2' => '',
	'mobile_ad_url2' => '',
	'mobile_ad_image2' => false
);

/**
 * Design Plusのオプションを返す
 * @global array $dp_default_options
 * @return array 
 */
function get_desing_plus_option(){
	global $dp_default_options;
	return shortcode_atts($dp_default_options, get_option('dp_options', array()));
}



// カラーピッカーの準備 その他javascriptの読み込み
add_action('admin_print_scripts', 'my_admin_print_scripts');
function my_admin_print_scripts() {
  wp_enqueue_script('jscolor', get_template_directory_uri().'/admin/jscolor.js');
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/jquery.cookieTab.js');
}



// 画像アップロードの準備
function wp_gear_manager_admin_scripts() {
wp_enqueue_script('dp-image-manager', get_template_directory_uri().'/admin/image-manager.js', array('jquery', 'jquery-ui-draggable', 'imgareaselect'));
}
function wp_gear_manager_admin_styles() {
wp_enqueue_style('imgareaselect');
}
add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



// 登録
function theme_options_init(){
 register_setting( 'design_plus_options', 'dp_options', 'theme_options_validate' );
}


// ロード
function theme_options_add_page() {
 add_theme_page( __( 'Theme Options', 'tcd-w' ), __( 'Theme Options', 'tcd-w' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


/**
 * レイアウトの初期設定
 * @var array 
 */
global $layout_options;
$layout_options = array(
 'left' => array(
  'value' => 'left',
  'label' => __( 'Left', 'tcd-w' ),
  'img' => 'left_side'
 ),
 'right' => array(
  'value' => 'right',
  'label' => __( 'Right', 'tcd-w' ),
  'img' => 'right_side'
 ),
 'three_column1' => array(
  'value' => 'three_column1',
  'label' => __( 'Three column1', 'tcd-w' ),
  'img' => 'three_column1'
 ),
 'three_column2' => array(
  'value' => 'three_column2',
  'label' => __( 'Three column2', 'tcd-w' ),
  'img' => 'three_column2'
 )
);



/**
 * 色の初期設定
 * @var array 
 */
global $color_type_options;
$color_type_options = array(
 'type1' => array(
  'value' => 'type1',
  'label' => __( 'Pink', 'tcd-w' )
 ),
 'type2' => array(
  'value' => 'type2',
  'label' => __( 'Black', 'tcd-w' )
 ),
 'type3' => array(
  'value' => 'type3',
  'label' => __( 'Custom color', 'tcd-w' )
 )
);



/**
 * ヘッダーレイアウトの初期設定
 * @var array 
 */
global $header_layout_options;
$header_layout_options = array(
 'no-fixed' => array(
  'value' => 'no-fixed',
  'label' => __( 'Normal', 'tcd-w' )
 ),
 'fixed' => array(
  'value' => 'fixed',
  'label' => __( 'Fixed', 'tcd-w' )
 )
);



// テーマオプション画面の作成
function theme_options_do_page() {
 global $layout_options, $header_layout_options, $color_type_options, $dp_upload_error;
 $options = get_desing_plus_option(); 

 if ( ! isset( $_REQUEST['settings-updated'] ) )
  $_REQUEST['settings-updated'] = false;


?>

<div class="wrap">
 <?php screen_icon(); echo "<h2>" . __( 'Theme Options', 'tcd-w' ) . "</h2>"; ?>

 <?php // 更新時のメッセージ
       if ( false !== $_REQUEST['settings-updated'] ) :
 ?>
 <div class="updated fade"><p><strong><?php _e('Updated', 'tcd-w');  ?></strong></p></div>
 <?php endif; ?>

 <?php /* ファイルアップロード時のメッセージ */ if(!empty($dp_upload_error['message'])): ?>
  <?php if($dp_upload_error['error']): ?>
   <div id="error" class="error"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php else: ?>
   <div id="message" class="updated fade"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php endif; ?>
 <?php endif; ?>
 
 <script type="text/javascript">
  jQuery(document).ready(function($){
   $('#my_theme_option').cookieTab({
    tabMenuElm: '#theme_tab',
    tabPanelElm: '#tab-panel'
   });
  });
 </script>

 <div id="my_theme_option">

 <div id="theme_tab_wrap">
  <ul id="theme_tab" class="cf">
   <li><a href="#tab-content1"><?php _e('Basic Setup', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content2"><?php _e('Logo', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content3"><?php _e('Adsence widget1', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content4"><?php _e('Adsence widget2', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content5"><?php _e('Other Adsense', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content6"><?php _e('Smartphone Adsense', 'tcd-w');  ?></a></li>
  </ul>
 </div>

<form method="post" action="options.php" enctype="multipart/form-data">
 <?php settings_fields( 'design_plus_options' ); ?>

 <div id="tab-panel">

  <!-- #tab-content1 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content1">

   <?php // 色の設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Color setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input" id="color_type">
     <p><?php _e('Select color type', 'tcd-w');  ?></p>
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Color type', 'tcd-w');  ?></span></legend>
     <ul class="cf">
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $color_type_options as $option ) {
          $color_type_setting = $options['color_type'];
           if ( '' != $color_type_setting ) {
            if ( $options['color_type'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <li>
       <label>
       <input id="input_<?php esc_attr_e( $option['value'] ); ?>" type="radio" name="dp_options[color_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <?php echo $option['label']; ?>
       </label>
      </li>
     <?php
          }
     ?>
     </ul>
     </fieldset>
    </div>
   </div>

 <script type="text/javascript">
  jQuery(document).ready(function($){

   if($("#input_type3:checked").val()) {
    $('#color_pattern').show();
   } else {
    $('#color_pattern').hide();
   };

   $("#input_type3").click(function () {
    $('#color_pattern').show();
   });

   $("#color_type input").not('#input_type3').click(function () {
    $('#color_pattern').hide();
   });

  });
 </script>

   <?php // サイトカラー ?>
   <div id="color_pattern" style="display:none;">
    <div class="theme_option_field cf">
     <h3 class="theme_option_headline"><?php _e('Custom color setting', 'tcd-w');  ?></h3>
     <p><?php _e('Set primary color.', 'tcd-w');  ?></p>
     <div class="theme_option_input">
      <input type="text" class="color" name="dp_options[pickedcolor]" value="<?php esc_attr_e( $options['pickedcolor'] ); ?>" />
      <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'tcd-w' ); ?>" />
     </div>
     <p><?php _e('Set secondary color.', 'tcd-w');  ?></p>
     <div class="theme_option_input">
      <input type="text" class="color" name="dp_options[pickedcolor2]" value="<?php esc_attr_e( $options['pickedcolor2'] ); ?>" />
      <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'tcd-w' ); ?>" />
     </div>
     <p><?php _e('Color to use for gradation.', 'tcd-w');  ?></p>
     <div class="theme_option_input">
      <input type="text" class="color" name="dp_options[pickedcolor3]" value="<?php esc_attr_e( $options['pickedcolor3'] ); ?>" />
      <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'tcd-w' ); ?>" />
     </div>
    </div>
   </div>

   <?php // フォントサイズ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font size', 'tcd-w');  ?></h3>
    <p><?php _e('Font size of single page and wp-page.', 'tcd-w');  ?></p>
    <div class="theme_option_input">
     <input id="dp_options[content_font_size]" class="font_size" type="text" name="dp_options[content_font_size]" value="<?php esc_attr_e( $options['content_font_size'] ); ?>" /><span>px</span>
    </div>
   </div>

   <?php // 投稿者名・タグ・コメント ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display Setup', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li><label><input id="dp_options[show_author]" name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?> /> <?php _e('Display author', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_comment]" name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /> <?php _e('Display comment', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_trackback]" name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?> /> <?php _e('Display trackbacks', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_bookmark]" name="dp_options[show_bookmark]" type="checkbox" value="1" <?php checked( '1', $options['show_bookmark'] ); ?> /> <?php _e('Display social bookmark', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_related_post]" name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['show_related_post'] ); ?> /> <?php _e('Display related post at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_next_post]" name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /> <?php _e('Display next previous post link', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_rss]" name="dp_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?> /> <?php _e('Display RSS button at header', 'tcd-w');  ?></label></li>
     </ul>
    </div>
   </div>

   <?php // サイドコンテンツの表示位置 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Layout', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Layout', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $layout_options as $option ) {
          $layout_setting = $options['layout'];
           if ( '' != $layout_setting ) {
            if ( $options['layout'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[layout]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php bloginfo('template_url'); ?>/admin/<?php echo $option['img']; ?>.gif" alt="" title="" />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>

   <?php // ヘッダーのレイアウト ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header style', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option2">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Header style', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $header_layout_options as $option ) {
          $header_layout_setting = $options['header_layout'];
           if ( '' != $header_layout_setting ) {
            if ( $options['header_layout'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[header_layout]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>

   <?php // facebook twitter ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('twitter and facebook setup', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('When it is blank, twitter and facebook icon will not displayed on a site.', 'tcd-w');  ?></p>
     <ul>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your twitter URL', 'tcd-w');  ?></label>
       <input id="dp_options[twitter_url]" class="regular-text" type="text" name="dp_options[twitter_url]" value="<?php echo esc_url( $options['twitter_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your facebook URL', 'tcd-w');  ?></label>
       <input id="dp_options[facebook_url]" class="regular-text" type="text" name="dp_options[facebook_url]" value="<?php echo esc_url( $options['facebook_url'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content1 -->




  <!-- #tab-content2 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content2">

   <?php // ステップ１ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 1 : Upload image to use for logo.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Upload image to use for logo from your computer.<br />You can resize your logo image in step 2 and adjust position in step 3.', 'tcd-w');  ?></p>
     <div class="button_area">
      <label for="dp_image"><?php _e('Select image to use for logo from your computer.', 'tcd-w');  ?></label>
      <input type="file" name="dp_image" id="dp_image" value="" />
      <input type="submit" class="button" value="<?php _e('Upload', 'tcd-w');  ?>" />
     </div>
     <?php if(dp_logo_exists()): $info = dp_logo_info(); ?>
     <div class="uploaded_logo">
      <h4><?php _e('Uploaded image.', 'tcd-w');  ?></h4>
      <div class="uploaded_logo_image" id="original_logo_size">
       <?php dp_logo_img_tag(false, '', '', 9999); ?>
      </div>
      <p><?php printf(__('Original image size : width %1$dpx, height %2$dpx', 'tcd-w'), $info['width'], $info['height']); ?></p>
     </div>
     <?php else: ?>
     <div class="uploaded_logo">
      <h4><?php _e('The image has not been uploaded yet.<br />A normal text will be used for a site logo.', 'tcd-w');  ?></h4>
     </div>
     <?php endif; ?>
    </div>
   </div>

   <?php // ステップ２ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 2 : Resize uploaded image.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('You can resize uploaded image.<br />If you don\'t need to resize, go to step 3.', 'tcd-w');  ?></p>
     <div class="uploaded_logo">
      <h4><?php _e('Please drag the range to cut off.', 'tcd-w');  ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_resize_base(9999); ?>
      </div>
      <div class="resize_amount">
       <label><?php _e('Ratio', 'tcd-w');  ?>: <input type="text" name="dp_resize_ratio" id="dp_resize_ratio" value="100" />%</label>
       <label><?php _e('Width', 'tcd-w');  ?>: <input type="text" name="dp_resized_width" id="dp_resized_width" />px</label>
       <label><?php _e('Height', 'tcd-w');  ?>: <input type="text" name="dp_resized_height" id="dp_resized_height" />px</label>
      </div>
      <div id="resize_button_area">
       <input type="submit" class="button-primary" value="<?php _e('Resize', 'tcd-w'); ?>" />
      </div>
     </div>
     <?php if($info = dp_logo_info(true)): ?>
     <div class="uploaded_logo">
      <h4><?php printf(__('Resized image : width %1$dpx, height %2$dpx', 'tcd-w'), $info['width'], $info['height']); ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_img_tag(true, '', '', 9999); ?>
      </div>
     </div>
     <?php endif; ?>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // ステップ３ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 3 : Adjust position of logo.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('Drag the logo image and adjust the position.', 'tcd-w');  ?></p>
     <div id="tcd-w-logo-adjuster" class="ratio-<?php echo '760-760'; ?>">
      <?php if(dp_logo_resize_tag(760, 760, $options['logotop'], $options['logoleft'])): ?>
      <?php else: ?>
      <span><?php _e('Logo size is too big. Please resize your logo image.', 'tcd-w');  ?></span>
      <?php endif; ?>
     </div>
     <div class="hide">
      <label><?php _e('Top', 'tcd-w');  ?>: <input type="text" name="dp_options[logotop]" id="dp-options-logotop" value="<?php esc_attr_e( $options['logotop'] ); ?>" />px </label>
      <label><?php _e('Left', 'tcd-w');  ?>: <input type="text" name="dp_options[logoleft]" id="dp-options-logoleft" value="<?php esc_attr_e( $options['logoleft'] ); ?>" />px </label>
      <input type="button" class="button" id="dp-adjust-realvalue" value="adjust" />
     </div>
     <p><input type="submit" class="button" value="<?php _e('Save the position', 'tcd-w');  ?>" /></p>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // 画像の削除 ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Delete logo image.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you delete the logo image, normal text will be used for a site logo.', 'tcd-w');  ?></p>
     <p><a class="button" href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_image_'.  get_current_user_id()); ?>" onclick="if(!confirm('<?php _e('Are you sure to delete logo image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w');  ?></a></p>
    </div>
   </div>
   <?php endif; ?>

  </div><!-- END #tab-content2 -->




  <!-- #tab-content3 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content3">

  <p class="tab_desc"><?php _e('Adsense will be displayed at random in front page.<br />Don\'t forget to set the Adsense banner Widget1 from widget page.', 'tcd-w');  ?></p>
  <p class="tab_desc"><?php _e('Please read about Adsense terms of use before you use this checkbox option.', 'tcd-w');  ?></p>
  <p class="tab_desc"><label><input id="dp_options[fix_ad]" name="dp_options[fix_ad]" type="checkbox" value="1" <?php checked( '1', $options['fix_ad'] ); ?> /> <?php _e('Fix position of adsense', 'tcd-w');  ?></label></p>

  <?php // ウィジェット広告1 -------------------------------------------------------------------------------------------- ?>
  <?php for($i = 1; $i <= 3; $i++): ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Adsense banner setup', 'tcd-w');  ?><?php echo $i; ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">
     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[side_ad_top_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[side_ad_top_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['side_ad_top_code'.$i] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[side_ad_top_image<?php echo $i; ?>]" value="<?php esc_attr_e( $options['side_ad_top_image'.$i] ); ?>" /></div>
        <input type="file" name="side_ad_top_image_file_<?php echo $i?>" id="side_ad_top_image_file_<?php echo $i?>" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['side_ad_top_image'.$i]) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['side_ad_top_image'.$i] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['side_ad_top_image'.$i])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_side_ad_top_image'.$i) ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>
     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[side_ad_top_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[side_ad_top_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['side_ad_top_url'.$i] ); ?>" />
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php endfor; ?>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content3 -->



  <!-- #tab-content4 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content4">

  <p class="tab_desc"><?php _e('Adsense will be displayed at random in front page.<br />Don\'t forget to set the Adsense banner Widget2 from widget page.', 'tcd-w');  ?></p>

  <?php // ウィジェット広告２ -------------------------------------------------------------------------------------------- ?>
  <?php for($i = 1; $i <= 3; $i++): ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Adsense banner setup', 'tcd-w');  ?><?php echo $i; ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">
     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[side_ad_bottom_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[side_ad_bottom_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['side_ad_bottom_code'.$i] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[side_ad_bottom_image<?php echo $i; ?>]" value="<?php esc_attr_e( $options['side_ad_bottom_image'.$i] ); ?>" /></div>
        <input type="file" name="side_ad_bottom_image_file_<?php echo $i?>" id="side_ad_bottom_image_file_<?php echo $i?>" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['side_ad_bottom_image'.$i]) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['side_ad_bottom_image'.$i] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['side_ad_bottom_image'.$i])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_side_ad_bottom_image'.$i) ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>
     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[side_ad_bottom_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[side_ad_bottom_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['side_ad_bottom_url'.$i] ); ?>" />
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php endfor; ?>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content4 -->




  <!-- #tab-content5 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content5">


  <?php // ヘッダー広告の登録 -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Header banner setup.', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[header_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[header_ad_code1]"><?php echo esc_textarea( $options['header_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Size width:728px height:90px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[header_ad_image1]" value="<?php esc_attr_e( $options['header_ad_image1'] ); ?>" /></div>
        <input type="file" name="header_ad_image_file1" id="header_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['header_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['header_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['header_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_header_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[header_ad_url1]" class="regular-text" type="text" name="dp_options[header_ad_url1]" value="<?php esc_attr_e( $options['header_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <?php // 詳細ページの広告１ -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Single post page banner setup1.(Show on top of the post.)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[single_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $options['single_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[single_ad_image1]" value="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" /></div>
        <input type="file" name="single_ad_image_file1" id="single_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['single_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['single_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_single_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[single_ad_url1]" class="regular-text" type="text" name="dp_options[single_ad_url1]" value="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <?php // 詳細ページの広告2 -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Single post page banner setup2.(Show on bottom of the post.)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[single_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $options['single_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[single_ad_image2]" value="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" /></div>
        <input type="file" name="single_ad_image_file2" id="single_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['single_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['single_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_single_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[single_ad_url2]" class="regular-text" type="text" name="dp_options[single_ad_url2]" value="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content5 -->




  <!-- #tab-content6 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content6">

  <p class="tab_desc"><?php _e('This Adsense is displayed only on the user who accessed the site with the smartphone.', 'tcd-w');  ?></p>

  <?php // モバイル広告の登録（ページ上部） -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Smartphone banner setup1. (Display on the top of a page)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[mobile_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[mobile_ad_code1]"><?php echo esc_textarea( $options['mobile_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[mobile_ad_image1]" value="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" /></div>
        <input type="file" name="mobile_ad_image_file1" id="mobile_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['mobile_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['mobile_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_mobile_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[mobile_ad_url1]" class="regular-text" type="text" name="dp_options[mobile_ad_url1]" value="<?php esc_attr_e( $options['mobile_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <?php // モバイル広告の登録（ページ下部） -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Smartphone banner setup2. (Display on the bottom of a page)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[mobile_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[mobile_ad_code2]"><?php echo esc_textarea( $options['mobile_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[mobile_ad_image2]" value="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" /></div>
        <input type="file" name="mobile_ad_image_file2" id="mobile_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['mobile_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['mobile_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_mobile_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[mobile_ad_url2]" class="regular-text" type="text" name="dp_options[mobile_ad_url2]" value="<?php esc_attr_e( $options['mobile_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content6 -->




  </div><!-- END #tab-panel -->

 </form>

</div>

</div>

<?php

 }


/**
 * チェック
 */
function theme_options_validate( $input ) {
 global $layout_options, $header_layout_options, $color_type_options;

 // 色の設定
 if ( ! isset( $input['color_type'] ) )
  $input['color_type'] = null;
 if ( ! array_key_exists( $input['color_type'], $color_type_options ) )
  $input['color_type'] = null;

 // 色の設定2
 $input['pickedcolor'] = wp_filter_nohtml_kses( $input['pickedcolor'] );
 $input['pickedcolor2'] = wp_filter_nohtml_kses( $input['pickedcolor2'] );
 $input['pickedcolor3'] = wp_filter_nohtml_kses( $input['pickedcolor3'] );

 // フォントサイズ
 $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );

 // 投稿者・タグ・コメント
 if ( ! isset( $input['show_author'] ) )
  $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_comment'] ) )
  $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_trackback'] ) )
  $input['show_trackback'] = null;
  $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_next_post'] ) )
  $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_rss'] ) )
  $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_related_post'] ) )
  $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_bookmark'] ) )
  $input['show_bookmark'] = null;
  $input['show_bookmark'] = ( $input['show_bookmark'] == 1 ? 1 : 0 );

 // レイアウトの設定
 if ( ! isset( $input['layout'] ) )
  $input['layout'] = null;
 if ( ! array_key_exists( $input['layout'], $layout_options ) )
  $input['layout'] = null;

 // ヘッダーレイアウトの設定
 if ( ! isset( $input['header_layout'] ) )
  $input['header_layout'] = null;
 if ( ! array_key_exists( $input['header_layout'], $header_layout_options ) )
  $input['header_layout'] = null;

 // twitter,facebook URL
 $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );

 // ヘッダーの広告バナー
 $input['header_ad_code1'] = $input['header_ad_code1'];
 $input['header_ad_image1'] = wp_filter_nohtml_kses( $input['header_ad_image1'] );
 $input['header_ad_url1'] = wp_filter_nohtml_kses( $input['header_ad_url1'] );

 // 詳細記事上部の広告バナー
 $input['single_ad_code1'] = $input['single_ad_code1'];
 $input['single_ad_image1'] = wp_filter_nohtml_kses( $input['single_ad_image1'] );
 $input['single_ad_url1'] = wp_filter_nohtml_kses( $input['single_ad_url1'] );

 // 詳細記事下部の広告バナー
 $input['single_ad_code2'] = $input['single_ad_code2'];
 $input['single_ad_image2'] = wp_filter_nohtml_kses( $input['single_ad_image2'] );
 $input['single_ad_url2'] = wp_filter_nohtml_kses( $input['single_ad_url2'] );

 // モバイル用の広告バナー（上部）
 $input['mobile_ad_code1'] = $input['mobile_ad_code1'];
 $input['mobile_ad_image1'] = wp_filter_nohtml_kses( $input['mobile_ad_image1'] );
 $input['mobile_ad_url1'] = wp_filter_nohtml_kses( $input['mobile_ad_url1'] );

 // モバイル用の広告バナー（下部）
 $input['mobile_ad_code2'] = $input['mobile_ad_code2'];
 $input['mobile_ad_image2'] = wp_filter_nohtml_kses( $input['mobile_ad_image2'] );
 $input['mobile_ad_url2'] = wp_filter_nohtml_kses( $input['mobile_ad_url2'] );

 //ロゴの位置
 if(isset($input['logotop'])){
	 $input['logotop'] = intval($input['logotop']);
 }
 if(isset($input['logoleft'])){
	 $input['logoleft'] = intval($input['logoleft']);
 }

 // 広告ウィジェット１
 $input['side_ad_top_code1'] = $input['side_ad_top_code1'];
 $input['side_ad_top_image1'] = wp_filter_nohtml_kses( $input['side_ad_top_image1'] );
 $input['side_ad_top_url1'] = wp_filter_nohtml_kses( $input['side_ad_top_url1'] );

 $input['side_ad_top_code2'] = $input['side_ad_top_code2'];
 $input['side_ad_top_image2'] = wp_filter_nohtml_kses( $input['side_ad_top_image2'] );
 $input['side_ad_top_url2'] = wp_filter_nohtml_kses( $input['side_ad_top_url2'] );

 $input['side_ad_top_code3'] = $input['side_ad_top_code3'];
 $input['side_ad_top_image3'] = wp_filter_nohtml_kses( $input['side_ad_top_image3'] );
 $input['side_ad_top_url3'] = wp_filter_nohtml_kses( $input['side_ad_top_url3'] );

 if ( ! isset( $input['fix_ad'] ) )
  $input['fix_ad'] = null;
  $input['fix_ad'] = ( $input['fix_ad'] == 1 ? 1 : 0 );

 // 広告ウィジェット２
 $input['side_ad_bottom_code1'] = $input['side_ad_bottom_code1'];
 $input['side_ad_bottom_image1'] = wp_filter_nohtml_kses( $input['side_ad_bottom_image1'] );
 $input['side_ad_bottom_url1'] = wp_filter_nohtml_kses( $input['side_ad_bottom_url1'] );

 $input['side_ad_bottom_code2'] = $input['side_ad_bottom_code2'];
 $input['side_ad_bottom_image2'] = wp_filter_nohtml_kses( $input['side_ad_bottom_image2'] );
 $input['side_ad_bottom_url2'] = wp_filter_nohtml_kses( $input['side_ad_bottom_url2'] );

 $input['side_ad_bottom_code3'] = $input['side_ad_bottom_code3'];
 $input['side_ad_bottom_image3'] = wp_filter_nohtml_kses( $input['side_ad_bottom_image3'] );
 $input['side_ad_bottom_url3'] = wp_filter_nohtml_kses( $input['side_ad_bottom_url3'] );

 //ファイルアップロード
 if(isset($_FILES['dp_image'])){
	$message = _dp_upload_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //画像リサイズ
 if(isset($_REQUEST['dp_logo_resize_left'], $_REQUEST['dp_logo_resize_top']) && is_numeric($_REQUEST['dp_logo_resize_left']) && is_numeric($_REQUEST['dp_logo_resize_top'])){
	$message = _dp_resize_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }


 //ヘッダーの広告バナー
	 if(isset($_FILES['header_ad_image_file1'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['header_ad_image_file1']['error'] === 0){
			 $name = sanitize_file_name($_FILES['header_ad_image_file1']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['header_ad_image_file1']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['header_ad_image1'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['header_ad_image_file1']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['header_ad_image_file1']['error']), 'error');
			 //continue;
		 }
	 }

 //詳細記事ページ上部の広告バナー
	 if(isset($_FILES['single_ad_image_file1'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['single_ad_image_file1']['error'] === 0){
			 $name = sanitize_file_name($_FILES['single_ad_image_file1']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['single_ad_image_file1']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['single_ad_image1'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['single_ad_image_file1']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['single_ad_image_file1']['error']), 'error');
			 //continue;
		 }
	 }


 //詳細記事ページ下部の広告バナー
	 if(isset($_FILES['single_ad_image_file2'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['single_ad_image_file2']['error'] === 0){
			 $name = sanitize_file_name($_FILES['single_ad_image_file2']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['single_ad_image_file2']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['single_ad_image2'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['single_ad_image_file2']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['single_ad_image_file2']['error']), 'error');
			 //continue;
		 }
	 }


 //広告ウィジェット１
 for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['side_ad_top_image_file_'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['side_ad_top_image_file_'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['side_ad_top_image_file_'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['side_ad_top_image_file_'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['side_ad_top_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					break;
				}
			 }
		 }elseif($_FILES['side_ad_top_image_file_'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['side_ad_top_image_file_'.$i]['error']), 'error');
			 continue;
		 }
	 }
 }	 



 //広告ウィジェット２
 for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['side_ad_bottom_image_file_'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['side_ad_bottom_image_file_'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['side_ad_bottom_image_file_'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['side_ad_bottom_image_file_'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['side_ad_bottom_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					break;
				}
			 }
		 }elseif($_FILES['side_ad_bottom_image_file_'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['side_ad_bottom_image_file_'.$i]['error']), 'error');
			 continue;
		 }
	 }
 }	 



 //モバイル用広告（上部）
	 if(isset($_FILES['mobile_ad_image_file1'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['mobile_ad_image_file1']['error'] === 0){
			 $name = sanitize_file_name($_FILES['mobile_ad_image_file1']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['mobile_ad_image_file1']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['mobile_ad_image1'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
				}
			 }
		 }elseif($_FILES['mobile_ad_image_file1']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['mobile_ad_image_file1']['error']), 'error');
		 }
	 }




 //モバイル用広告（下部）
	 if(isset($_FILES['mobile_ad_image_file2'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['mobile_ad_image_file2']['error'] === 0){
			 $name = sanitize_file_name($_FILES['mobile_ad_image_file2']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['mobile_ad_image_file2']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['mobile_ad_image2'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
				}
			 }
		 }elseif($_FILES['mobile_ad_image_file2']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['mobile_ad_image_file2']['error']), 'error');
		 }
	 }




 return $input;
}

?>