<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_content">

 <h2 id="page_headline"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></h2>

 <div class="post clearfix">

  <p class="back"><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e("RETURN HOME","tcd-w"); ?></a></p>

 </div><!-- END .post -->

</div><!-- END #main_content -->

<?php if(is_mobile()) { include('sidebar_mobile.php'); } else { ?>
<?php include('sidebar.php'); ?>
<?php if($options['layout'] == 'three_column1'||$options['layout'] == 'three_column2') { include('sidebar2.php'); }; ?>
<?php }; ?>

<?php get_footer(); ?>