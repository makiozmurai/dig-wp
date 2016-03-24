<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="main_content">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <h2 id="page_headline"><?php the_title(); ?></h2>
 <div class="post clearfix">
  <?php the_content(__('Read more', 'tcd-w')); ?>
  <?php wp_link_pages(); ?>
 </div><!-- END .post -->

 <?php endwhile; endif; ?>

</div><!-- END #main_content -->

<?php if(is_mobile()) { include('sidebar_mobile.php'); } else { ?>
<?php include('sidebar.php'); ?>
<?php if($options['layout'] == 'three_column1'||$options['layout'] == 'three_column2') { include('sidebar2.php'); }; ?>
<?php }; ?>

<?php get_footer(); ?>