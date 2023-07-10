<?php

/**
 * Admin bar
 */
add_action( 'admin_bar_menu', function ( $menu ) {
	$menu->remove_node( 'comments' ); // Comments
	$menu->remove_node( 'customize' ); // Customize
//	$menu->remove_node( 'dashboard' ); // Dashboard
//	$menu->remove_node( 'edit' ); // Edit
	$menu->remove_node( 'menus' ); // Menus
//	$menu->remove_node( 'new-content' ); // New Content
	$menu->remove_node( 'search' ); // Search
//	 $menu->remove_node('site-name'); // Site Name
	$menu->remove_node( 'themes' ); // Themes
	$menu->remove_node( 'updates' ); // Updates
	$menu->remove_node( 'view-site' ); // Visit Site
//	$menu->remove_node( 'view' ); // View
//	$menu->remove_node( 'widgets' ); // Widgets
	$menu->remove_node( 'wp-logo' ); // WordPress Logo
}, 999 );

/**
 * Dashboard widgets
 */
add_action( 'wp_dashboard_setup', function () {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); // Activity
//	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); // At a Glance
//	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_site_health'] ); // Site Health Status
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] ); // WordPress Events and News
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] ); // Quick Draft
} );


/**
 * Feeds / XML-RPC
 */
function clean_wp_disable_feeds() {
	wp_redirect( site_url() );
}

add_action( 'do_feed', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_atom', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_atom_comments', 'hHeadache_disable_feeds', 1 );
add_action( 'do_feed_rdf', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rss', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rss2', 'clean_wp_disable_feeds', 1 );
add_action( 'do_feed_rss2_comments', 'clean_wp_disable_feeds', 1 );
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Head / styles
 */
add_filter( 'login_display_language_dropdown', '__return_false' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_site_icon', 99 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

/**
 * File editor
 */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/**
 * Gutenberg
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_deregister_style( 'global-styles' );
	wp_deregister_style( 'wp-block-library' );
} );


add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false' );
remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );

/**
 * User roles
 */
add_action( 'init', function () {
	// remove_role( 'author' );
	// remove_role( 'contributor' );
	// remove_role( 'subscriber' );
} );
