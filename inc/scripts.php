<?php
defined( 'ABSPATH' ) || exit;

function rafax_wp_utiles_admin_css() {
    add_editor_style( RAFAXWPUTILES_PLUGIN_URL . '/assets/css/admin.css');
    wp_enqueue_style( RAFAXWPUTILES_PLUGIN_NAME . '-admin-css', RAFAXWPUTILES_PLUGIN_URL . '/assets/css/admin.css');
    wp_enqueue_script( RAFAXWPUTILES_PLUGIN_NAME . '-admin-js', RAFAXWPUTILES_PLUGIN_URL . '/assets/js/admin.js');
    //wp_enqueue_script('sweetalert-js','//unpkg.com/sweetalert/dist/sweetalert.min.js');
}
add_action( 'admin_enqueue_scripts', 'rafax_wp_utiles_admin_css' );
