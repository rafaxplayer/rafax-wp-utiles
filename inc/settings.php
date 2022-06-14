<?php 
defined( 'ABSPATH' ) || exit; 
<<<<<<< HEAD


=======


>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
function rwu_options_page() { 
    global $rwu_message;
    global $array_ids;
    global $valid_urls;?>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h1>WordPress Útiles (by r@fax)</h1>
    <?php settings_errors();  
        $active_page = isset( $_GET[ 'pag' ] ) ? $_GET[ 'pag' ] : 'rwu_ShorcodesPage'; ?>
    <h2 class="nav-tab-wrapper">
        <a href="?page=shorcodes-utiles&pag=rwu_ShorcodesPage"
            class="nav-tab <?php echo $active_page == 'rwu_ShorcodesPage' ? 'active':''; ?>">Shortcodes</a>
        <a href="?page=shorcodes-utiles&pag=rwu_FunctionsPage"
            class="nav-tab <?php echo $active_page == 'rwu_FunctionsPage' ? 'active':''; ?>">Funciones</a>
        <a href="?page=shorcodes-utiles&pag=rwu_SettingsPage"
            class="nav-tab <?php echo $active_page == 'rwu_SettingsPage' ? 'active':''; ?>">Ajustes</a>
        <a href="?page=shorcodes-utiles&pag=rwu_ToolsPage"
            class="nav-tab <?php echo $active_page == 'rwu_ToolsPage' ? 'active':''; ?>">Herramientas</a>
        
    </h2>
    <?php if( $active_page == 'rwu_ToolsPage'){ 
        include_once 'templates/delete-post-bulk.php';
        include_once 'templates/related-posts-generator.php';
        include_once 'templates/child-theme-generator.php';
        ?>

    
    
    <?php } else { ?>
    <form action='options.php' method='post' id="rwu_options_form">
        <?php settings_fields( $active_page );
            do_settings_sections( $active_page );
            submit_button();?>
    </form>


    <?php } ?>
</div><!-- /.wrap -->
<?php } 

function rwu_custom_menu() {
    add_menu_page ( 'Rafax WP Útiles', 'Rafax WP Útiles', 'publish_posts', 'shorcodes-utiles', 'rwu_options_page', RAFAXWPUTILES_PLUGIN_URL . '/assets/images/icon.png' );
    add_action( 'admin_init', 'rwu_mysettings' );
}
add_action( 'admin_menu', 'rwu_custom_menu');

function rwu_mysettings(){

    register_setting( 'rwu_ShorcodesPage', 'rwu_shortcodes_settings' );
    register_setting( 'rwu_FunctionsPage', 'rwu_functions_settings' );
    register_setting( 'rwu_SettingsPage', 'rwu_plugin_settings' );

    /* Seccion de Shortcodes*/
    add_settings_section(
        'rwu_shortcodes_section', 
        __( '', 'rafax-wp-utiles' ), 
        'rwu_section_callback', 
        'rwu_ShorcodesPage'
    );

    add_settings_field( 
        'rwu_lower_and_barras', 
        __( 'Convertir a minuscula y barra media Ejemplo: Casas Baratas = casas-baratas', 'rafax-wp-utiles' ), 
        'rwu_lower_and_barras_render', 
        'rwu_ShorcodesPage', 
        'rwu_shortcodes_section' 
    );

    add_settings_field( 
        'rwu_dates', 
<<<<<<< HEAD
        __( 'Obtener la fecha actual mediante tres shorcodes: year ,month, day. Ejemplo: [rwu-day]-[rwu-month]-[rwu-year] = 03-06-2021', 'rafax-wp-utiles' ), 
=======
        __( 'Obtener la fecha actual mediante tres shorcodes: year ,month, day. Ejemplo: [rwu_day]-[rwu_month]-[rwu_year] = 03-06-2021', 'rafax-wp-utiles' ), 
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
        'rwu_dates_render', 
        'rwu_ShorcodesPage', 
        'rwu_shortcodes_section' 
    );

    add_settings_field( 
        'rwu_related_posts', 
        __( 'Posts relacionados con multiples opciones', 'rafax-wp-utiles' ), 
        'rwu_related_posts_render', 
        'rwu_ShorcodesPage', 
        'rwu_shortcodes_section' 
    );

    /* Seccion de funciones*/
    add_settings_section(
        'rwu_functions_section', 
        __( '', 'rafax-wp-utiles' ), 
        'rwu_section_callback', 
        'rwu_FunctionsPage'
    );

    add_settings_field( 
        'rwu_no_plugin_emails', 
        __( 'Desabilitar los emails por actualizaciones de plugins', 'rafax-wp-utiles' ), 
        'rwu_no_plugin_emails_render', 
        'rwu_FunctionsPage', 
        'rwu_functions_section' 
    );

    add_settings_field( 
        'rwu_no_links_comments_author', 
        __( 'Eliminar enlaces de author en los comentarios', 'rafax-wp-utiles' ), 
        'rwu_no_links_comments_author_render', 
        'rwu_FunctionsPage', 
        'rwu_functions_section' 
    );

    add_settings_field( 
        'rwu_delete_post_images', 
        __( 'Eliminar imagenes destacadas e incluidas en un posts al ser eliminado', 'rafax-wp-utiles' ), 
        'rwu_delete_post_images_render', 
        'rwu_FunctionsPage', 
        'rwu_functions_section' 
    );

    add_settings_field( 
        'rwu_button_delete_adminbar', 
        __( 'Añade un boton para eliminar entradas en la barra de administrador', 'rafax-wp-utiles' ), 
        'rwu_button_delete_adminbar_render', 
        'rwu_FunctionsPage', 
        'rwu_functions_section' 
<<<<<<< HEAD
    );

    /* Seccion de ajustes*/
    add_settings_section(
        'rwu_settings_section', 
        __( '', 'rafax-wp-utiles' ), 
        'rwu_section_callback', 
        'rwu_SettingsPage'
    );

=======
    );

    /* Seccion de ajustes*/
    add_settings_section(
        'rwu_settings_section', 
        __( '', 'rafax-wp-utiles' ), 
        'rwu_section_callback', 
        'rwu_SettingsPage'
    );

>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
    add_settings_field( 
        'rwu_clean_on_uninstall', 
        __( 'Elimina todos los ajustes del plugin al desinstalar', 'rafax-wp-utiles' ), 
        'rwu_clean_on_uninstall_render', 
        'rwu_SettingsPage', 
        'rwu_settings_section' 
    );
    
}


function rwu_section_callback( $args ) { 

    switch ($args['id']) {
        case 'rwu_functions_section':
            echo __( 'Habilita las funciones que quieres incluir en tu proyecto', 'rafax-wp-utiles' );
            break;
        case 'rwu_tools_section':
            echo __( 'Herramientas para utilizar en nuestros proyectos', 'rafax-wp-utiles' );
            break;
        case 'rwu_shortcodes_section':
            echo __( 'Habilita las funciones que quieres incluir en tu proyecto', 'rafax-wp-utiles' );
            break;
        case 'rwu_settings_section':
            echo __( 'Ajustes del plugin', 'rafax-wp-utiles' );
            break;
        
        default:
            # code...
            break;
    }
}

/* 
* Renderizando los inputs
*/
// ShortCodes
function rwu_lower_and_barras_render() { 

    $options = get_option( 'rwu_shortcodes_settings' );
        ?>
         <label for="rwu_shortcodes_settings[rwu_lower_and_barras]">Activar</label>
<input type='checkbox' name='rwu_shortcodes_settings[rwu_lower_and_barras]' id='rwu_lower_and_barras' value='1'
    <?php checked( isset($options['rwu_lower_and_barras']) ); ?>>
<input style="margin-left:10px;width:100%;max-width:500px" type="text" class="hidden" id="code_lower_and_barras"
    value="[rwu-lower-and-barras]TEXTO[/rwu-lower-and-barras]">
<?php

}

function rwu_dates_render() { 
    $options = get_option( 'rwu_shortcodes_settings' );
    ?>
    <label for="rwu_shortcodes_settings[rwu_dates]">Activar</label>
<input type='checkbox' name='rwu_shortcodes_settings[rwu_dates]' id="rwu_dates" value='1'
    <?php checked( isset($options['rwu_dates']) ); ?>>
<input style="margin-left:10px;width:100%;max-width:500px" type="text" class="hidden" id="code_dates"
    value="[rwu_year] [rwu_month] [rwu_day]">
<?php

}

function rwu_related_posts_render() { 
    $options = get_option( 'rwu_shortcodes_settings' );
    
    ?>
    <label for="rwu_shortcodes_settings[rwu_related_posts]">Activar</label>
<input type='checkbox' name='rwu_shortcodes_settings[rwu_related_posts]' id="rwu_related_posts" value='1'
    <?php checked( isset($options['rwu_related_posts']) ); ?>>
 <a id="code_related_posts"href="?page=shorcodes-utiles&pag=rwu_ToolsPage" target="_blank">Generador de Posts Relacionados</a>
    
<?php

}

//Functions
function rwu_no_plugin_emails_render() { 

    $options = get_option( 'rwu_functions_settings' );
    ?>

<input type='checkbox' name='rwu_functions_settings[rwu_no_plugin_emails]' id='rwu_no_plugin_emails' value='1'
    <?php checked( isset($options['rwu_no_plugin_emails'])); ?>>
<textarea name="" id="code_no_plugin_emails" class="hidden" >
    // Disable plugins auto-update email notifications .
    add_filter( 'auto_plugin_update_send_email', '__return_false' );
    // Disable themes auto-update email notifications.
    add_filter( 'auto_theme_update_send_email', '__return_false' );
</textarea>
<?php

}

function rwu_no_links_comments_author_render() { 

    $options = get_option( 'rwu_functions_settings' );
    ?>
<input type='checkbox' name='rwu_functions_settings[rwu_no_links_comments_author]' id='rwu_no_links_comments_author'
    value='1' <?php checked( isset($options['rwu_no_links_comments_author'])); ?>>
<textarea name="" id="code_no_links_comments_author" class="hidden">
    if(!function_exists('rwu_remove_comment_author_link')){

    function rwu_remove_comment_author_link( $return, $author, $comment_ID ) {
        return $author;
    }
    add_filter( 'get_comment_author_link', 'rwu_remove_comment_author_link', 10, 3 );
    }

    if(!function_exists('rwu_remove_comment_author_url')){
    function rwu_remove_comment_author_url() {
        return false;
    }
    add_filter('get_comment_author_url', 'rwu_remove_comment_author_url');}</textarea>
<?php

}

function rwu_button_delete_adminbar_render() { 

    $options = get_option( 'rwu_functions_settings' );
    ?>
    <input type='checkbox' name='rwu_functions_settings[rwu_button_delete_adminbar]' id='rwu_button_delete_adminbar'
        value='1' <?php checked( isset($options['rwu_button_delete_adminbar'])); ?>>
    <textarea name="" id="code_button_delete_adminbar" class="hidden">function rwu_add_admin_bar_trash_menu() {
            global $wp_admin_bar;
            if ( !is_super_admin() || !is_admin_bar_showing() )
                return;
            $current_object = get_queried_object();
            if ( empty($current_object) )
                return;
            if ( !empty( $current_object->post_type ) &&
            ( $post_type_object = get_post_type_object( $current_object->post_type ) ) &&
            current_user_can( $post_type_object->cap->edit_post, $current_object->ID )
            ) {
            $wp_admin_bar->add_menu(
                array( 'id' => 'delete',
                    'title' => __('Move to Trash'),
                    'href' => get_delete_post_link($current_object->term_id)
                )
            );
            }
        }
        add_action( 'admin_bar_menu', 'rwu_add_admin_bar_trash_menu', 35 );</textarea>
    <?php

}

function rwu_delete_post_images_render() { 

    $options = get_option( 'rwu_functions_settings' );
    ?>
    <input type='checkbox' name='rwu_functions_settings[rwu_delete_post_images]' id='rwu_delete_post_images' value='1'
        <?php checked( isset($options['rwu_delete_post_images'])); ?>>
    <textarea name="" id="code_delete_post_images" class="hidden">
<<<<<<< HEAD
        add_action( 'before_delete_post', function( $id ) {
  		$attachments = get_attached_media( '', $id );
  			foreach ($attachments as $attachment) {
    			wp_delete_attachment( $attachment->ID, 'true' );
  			}
		});
=======
        //eliminar imagenes al borrar entrada
        add_action('after_delete_post','borrar_imagen_destacada_galeria',10,1);
        function borrar_imagen_destacada_galeria($post_id) {
            $id_imagen_destacada = get_post_meta($post_id,'_thumbnail_id',true);
            $id_galeria          = get_post_meta($post_id,'_product_image_gallery',true);
            
            if(!empty($id_imagen_destacada)) {
                wp_delete_post($id_imagen_destacada);
            }
            
            if(!empty($id_galeria)) {
                $array_img_galeria = split(',',$id_galeria);
            
                foreach($array_img_galeria as $id_una_imagen) {
                    wp_delete_post($id_una_imagen);
                }
            }
        }
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
        </textarea>
    <?php

}

//Settings
function rwu_clean_on_uninstall_render() { 
    $options = get_option( 'rwu_plugin_settings' );
   
    ?>
<input type='checkbox' name='rwu_plugin_settings[rwu_clean_on_uninstall]' id="rwu_clean_on_uninstall" value='1' <?php checked( isset($options['rwu_clean_on_uninstall']) ); ?>>

<?php

}