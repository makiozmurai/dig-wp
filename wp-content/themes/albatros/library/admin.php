<?php


/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);    // Right Now Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);        // Activity Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Comments Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);  // Incoming Links Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);         // Plugins Widget

	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);    // Quick Press Widget
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);     // Recent Drafts Widget
	 unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);           //WordPressニュース
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);         //

	// remove plugin dashboard boxes
	// unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);           // Yoast's SEO Plugin Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);        // Gravity Forms Plugin Widget
	// unset($wp_meta_boxes['dashboard']['normal']['core']['bbp-dashboard-right-now']);   // bbPress Plugin Widget

}


// RSS Dashboard Widget
function opencage_rss_dashboard_widget() {
	if ( function_exists( 'fetch_feed' ) ) {

		$feed = fetch_feed( '//open-cage.com/feed/' );
		if (is_wp_error($feed)) {
			$limit = 0;
			$items = 0;
		} else {
			$limit = $feed->get_item_quantity(5);
			$items = $feed->get_items(0, $limit);
		}
	}
	if ($limit == 0) echo '<div>最新情報はまだありません。</div>';   // fallback message
	else foreach ($items as $item) { ?>

	<h4 style="margin-bottom: 0;">
		<a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'opencagetheme' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
			<?php echo $item->get_title(); ?>
		</a>
	</h4>
	<p style="margin-top: 0.5em; font-size:0.95em; color:#999;">
		<?php echo mb_substr($item->get_description(), 0, 100, "UTF-8"); ?>
	</p>
	<?php }
}

// calling all custom dashboard widgets
function opencage_custom_dashboard_widgets() {
	wp_add_dashboard_widget( 'opencage_rss_dashboard_widget', __( 'テーマ最新情報', 'opencagetheme' ), 'opencage_rss_dashboard_widget' );
}


// removing the dashboard widgets
add_action( 'wp_dashboard_setup', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'opencage_custom_dashboard_widgets' );






/************* CUSTOMIZE ADMIN *******************/

// Custom Backend Footer
function opencage_custom_admin_footer() {
	_e( '<span id="footer-thankyou">create：<a href="//open-cage.com" target="_blank">opencage</a></span>', 'opencagetheme' );
}

// adding it to the admin area
add_filter( 'admin_footer_text', 'opencage_custom_admin_footer' );

?>
