<?php

if ( post_password_required() ) {
  return;
}

?>


  <?php if ( have_comments() ) : ?>

    <h3 id="comments-title" class="h2"><?php comments_number( __( 'コメントはまだありません。', 'albatrostheme' ), __( '<span>1</span> 個のコメント', 'albatrostheme' ), __( '<span>%</span> 件のコメント', 'albatrostheme' ) );?></h3>

    <section class="commentlist">
      <?php
        wp_list_comments( array(
          'reply_text'        => __('返信する', 'albatrostheme'),
          'reverse_children' => 'true'
        ) );
      ?>
    </section>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    	<nav class="navigation comment-navigation" role="navigation">
      	<div class="comment-nav-prev"><?php previous_comments_link( __( '&larr; 前のコメント', 'albatrostheme' ) ); ?></div>
      	<div class="comment-nav-next"><?php next_comments_link( __( '次のコメント &rarr;', 'albatrostheme' ) ); ?></div>
    	</nav>
    <?php endif; ?>

    <?php if ( ! comments_open() ) : ?>
    	
    <?php endif; ?>

  <?php endif; ?>

  <?php comment_form(); ?>

