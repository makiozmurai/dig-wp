<?php
/*
Template Name:No side
*/
?>
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

<?php get_footer(); ?>