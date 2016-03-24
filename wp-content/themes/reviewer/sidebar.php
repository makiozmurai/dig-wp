<?php $options = get_desing_plus_option(); ?>

		<div id="sideColumn"<?php if(!is_mobile()){ echo 'class="pt40"'; }; ?>>
 <?php
      if(is_home()) {

        if(!is_mobile()) {
          if(is_active_sidebar('index_side_widget')) { dynamic_sidebar('index_side_widget'); }; 
        };

      } elseif(is_single() and ('post' == get_post_type()||get_post_type()=="ranking_post"||get_post_type()=="ranking_post2"||get_post_type()=="ranking_post3"||get_post_type()=="news")) {

        if(!is_mobile()) {
          if(is_active_sidebar('single_side_widget')) { dynamic_sidebar('single_side_widget'); }; 
        };

      } else {

        if(!is_mobile()) {
          if(is_active_sidebar('archive_side_widget')) { dynamic_sidebar('archive_side_widget'); }; 
        };

      };
 ?>
			<!-- side banner2 -->
<?php if($options['side_ad_code2']||$options['side_ad_image2']) { ?>
			<div id="side-banner2">
	<?php if ($options['side_ad_code2']) { ?>
			<?php echo $options['side_ad_code2']; ?>
	<?php } else { ?>
			<a href="<?php esc_attr_e( $options['side_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['side_ad_image2'] ); ?>" alt="" title="" /></a>
	<?php }; ?>
			</div>
<?php }; ?>
			<!-- /side banner2 -->
		</div>
