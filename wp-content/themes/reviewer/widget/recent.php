<?php

class My_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
	function My_WP_Widget_Recent_Posts() {
    	WP_Widget::__construct(false, $name = __('Recent Posts (tcd ver.)', 'tcd-w'));
	}
	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="widget_my_recent_entries">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li class="clearfix">
				<div class="thumb">
					<div><a class="image" href="<?php the_permalink() ?>"><?php if ( has_post_thumbnail()) { the_post_thumbnail('widget_size'); } else { echo '<img src="'; bloginfo('template_url'); echo '/images/no_image3.jpg" alt="" title="" />'; }; ?></div></a>
				</div>
		<?php if ( $show_date ) : ?>
				<p class="date"><a href="<?php the_permalink(); ?>"><span class="post-date"><?php echo get_the_date('Y.m.d'); ?></span></a></p>
                <?php endif; ?>
				<p class="excerpt"><a href="<?php the_permalink(); ?>"><?php new_excerpt(50); ?></a></p>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

}
add_action('widgets_init', create_function('', 'return register_widget("My_WP_Widget_Recent_Posts");'));


?>