<?php /*
Plugin Name: Rafax wp utiles
Plugin URI: 
Description: Shorcodes y funciones que utilizo dia a dia
<<<<<<< HEAD
Version: 1.2
=======
Version: 1.1
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
Author: rafax
Author URI:
License:GPL
*/
defined( 'ABSPATH' ) || exit; 
<<<<<<< HEAD

    if (!defined('RAFAXWPUTILES_DIR'))
        define('RAFAXWPUTILES_DIR', __FILE__);
    
=======
    if (!defined('RAFAXWPUTILES_DIR'))
        define('RAFAXWPUTILES_DIR', __FILE__);

>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
    if (!defined('RAFAXWPUTILES_PLUGIN_NAME'))
        define('RAFAXWPUTILES_PLUGIN_NAME', 'rafax-wp-utiles');

    if ('shortcodes-utiles.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die (__('Please do not access this file directly. Thanks!', 'rafax-wp-utiles'));

    if (!defined('RAFAXWPUTILES_PLUGIN_DIR'))
        define('RAFAXWPUTILES_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . RAFAXWPUTILES_PLUGIN_NAME);

<<<<<<< HEAD
    if (!defined('RAFAXWPUTILES_DIR_THEMES'))
        define('RAFAXWPUTILES_DIR_THEMES', RAFAXWPUTILES_PLUGIN_DIR.'/themes');

=======
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342

    if (!defined('RAFAXWPUTILES_PLUGIN_URL'))
        define('RAFAXWPUTILES_PLUGIN_URL', WP_PLUGIN_URL . '/' . RAFAXWPUTILES_PLUGIN_NAME);
   
    require_once 'inc/helpers.php';
    require_once 'inc/scripts.php';
    require_once 'inc/render_shortcodes.php';
    require_once 'inc/settings.php';


    
    
    

 