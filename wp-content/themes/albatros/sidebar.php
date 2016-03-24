				<div id="sidebar1" class="sidebar m-all t-1of3 d-2of7 last-col cf" role="complementary">
					
					<?php if( is_page()): ?> 
					<?php // そのページが属する親子全て表示
						$ancestor = array_pop(get_post_ancestors($post->ID));
						if($ancestor) {
							$parent = $ancestor;
						} else {
							$parent = $post->ID;
						}
					
						$children = wp_list_pages("title_li=&child_of=".$parent."&echo=0&sort_column=menu_order");
					
						if ($children) {
							echo '<div class="local-nav">'."\n";
							echo '<h3 class="title"><a href="'.get_permalink($parent).'">'. esc_html(get_the_title($parent))."</a></h3>\n";
							echo "<ul>\n".$children."</ul>\n";
							echo "</div>\n";
						}
					?>
					<?php endif; ?> 
					
					<?php if ( is_active_sidebar( 'addbanner-pc-side' ) && !wp_is_mobile() ) : ?>
						<div class="add">
							<?php dynamic_sidebar( 'addbanner-pc-side' ); ?>
						</div>
					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'addbanner-sp-side' ) && wp_is_mobile() ) : ?>
						<div class="add">
							<?php dynamic_sidebar( 'addbanner-sp-side' ); ?>
						</div>
					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'sidebar2' ) && is_mobile()) : ?>
					<div id="scrollfix" class="mobile">
						<?php dynamic_sidebar( 'sidebar2' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar1' ); ?>
					<?php endif; ?>

					<?php if ( is_active_sidebar( 'sidebar2' ) && !is_mobile() ) : ?>
					<script type="text/javascript">
(function(){
	 $(function(){
 
		 var fix = $('#scrollfix'),
		 side = $('#sidebar1'),
		 main = $('#main'),
		 sideTop = side.offset().top;
		 fixTop = fix.offset().top,
		 mainTop = main.offset().top,
		 w = $(window);
 
		 var adjust = function(){
			 fixTop = fix.css('position') === 'static' ? sideTop + fix.position().top : fixTop;
			 var fixHeight = fix.outerHeight(true),
			 mainHeight = main.outerHeight(),
			 winTop = w.scrollTop();
 
			 if(winTop + fixHeight > mainTop + mainHeight){
				fix.removeClass('fixed');
			}else if(winTop >= fixTop){
				fix.addClass('fixed');
			}else{
				fix.removeClass('fixed');
			 }
		 }
 
		 w.on('scroll', adjust);
	 });
})(jQuery);
					</script>
						
					<div id="scrollfix">
						<?php dynamic_sidebar( 'sidebar2' ); ?>
					</div>
					<?php endif; ?>

				</div>
