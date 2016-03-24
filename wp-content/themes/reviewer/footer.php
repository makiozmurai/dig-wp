	</div>
	<!-- /contents -->
	
	<!-- footer -->
	<div id="footer">
		<div id="footer-inner" class="clearfix">
			<div id="footer-left">
				<?php the_dp_footer_logo(); ?>
				<div id="footer-menu">
<?php if (has_nav_menu('footer-menu')) { ?>
	<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'depth' => '1', 'theme_location' => 'footer-menu' , 'container' => '' ) ); ?>
<?php }; ?>
				</div>
			</div>
			<div id="footer-right">
			<?php if(!is_mobile()) { ?>
				<?php if(is_active_sidebar('footer_widget')){ ?>
					<?php dynamic_sidebar('footer_widget'); ?>
				<?php }; ?>
			<?php }else{ ?>
				<?php if(is_active_sidebar('mobile_widget_footer')){ ?>
					<?php dynamic_sidebar('mobile_widget_footer'); ?>
				<?php }; ?>
			<?php }; ?>
			</div>
		</div>
	</div>
	<div id="copyright"><?php _e('Copyright &copy;&nbsp; ', 'tcd-w'); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> All Rights Reserved.</div>
	<!-- /footer -->

</div>

<?php wp_footer(); ?>
</body>
</html>
