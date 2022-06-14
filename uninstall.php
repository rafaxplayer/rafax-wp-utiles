<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$settings_options = get_option( 'rwu_plugin_settings' );

if ( !isset( $settings_options['rwu_clean_on_uninstall'] ) || $settings_options['rwu_clean_on_uninstall'] != '1' ){
    return;
}

global $wpdb;

$plugin_options = $wpdb->get_results( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE 'rwu_%'" );

foreach( $plugin_options as $option ) {
    delete_option( $option->option_name );
}

remove_filter('widget-text', 'do_shortcode');
remove_filter( 'the_title', 'do_shortcode' );
remove_filter( 'single_post_title', 'do_shortcode' );
remove_filter( 'wp_title', 'do_shortcode' );
remove_filter('the_excerpt', 'do_shortcode');

