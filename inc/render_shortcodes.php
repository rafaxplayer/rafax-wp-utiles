<?php
defined( 'ABSPATH' ) || exit; 

$shortcodes_options = get_option( 'rwu_shortcodes_settings' );
$functions_options = get_option( 'rwu_functions_settings' );




/* 
* SHORTCODES
*/
if(isset($shortcodes_options['rwu_lower_and_barras'])){
    if(!function_exists('rwu_lower_and_barras')){
    function rwu_lower_and_barras($atts) {

        $p = shortcode_atts( array (
              'text' => ''
              ), $atts );
              
        $texto = strtolower($p['text']);
        $texto = str_replace(" ","-",$texto);
        return $texto;
        }
        add_shortcode('rwu-lower-and-barras','rwu_lower_and_barras');
    }
}
  
if(isset($shortcodes_options['rwu_dates'])){
    if(!function_exists('rwu_year')){
        function rwu_year() {
            $year = date('Y');
            return $year;     
        }
        add_shortcode('rwu-year','rwu_year');
    }
    
    if(!function_exists('rwu_month')){
        function rwu_month() {
            $month = date("m");
            return "$month";
        }
        add_shortcode( 'rwu-month' , 'rwu_month' );
    }

    if(!function_exists('rwu_day')){
        function rwu_day() {
            $month = date("d");
            return "$month";
        }
        add_shortcode( 'rwu-day' , 'rwu_day' );
    }
<<<<<<< HEAD
	// Adding support to native WP elements
=======
}

if(isset($shortcodes_options['rwu_related_posts'])){

   

    function rwu_rel_posts($atts) { 
            /**
             * Argumentos:
             * * limit: Limite de entradas a mostrar, por defecto 10
             * * categories: categorias a mostrar separadas su slug por comas(category1,category2,...), por defecto ninguna
             * * order: Orden, por defecto rand, podemos mirar la docu del loop de WordPress para ver las que hay
             * * show_thumb: mostrar o no las imagenes destacadas, por defecto si
             * * show_items_on_thumb: Mostrar solo las entradas que tienen imagen destacada, por defecto no
             * * title: Titulo en el el listado de entradas (h3), por defecto 'Artículos Relacionados'
             * * section_title_tag: Etiqueta html para titulo de la seccion
             * * post_title_tag: Etiqueta html para titulo d ela entrada
             */
        
        
            extract(shortcode_atts( array (
                'limit'                 => '6',
                'categories'            => '',
                'order'                 =>'ASC',
                'show_thumb'            =>'si',
                'show_items_on_thumb'   =>'no',
                'section_title_tag'     =>'h3',
                'post_title_tag'        =>'h4',
                'title'                 =>'Entradas Relacionadas'
                ), $atts ));
                
                
        // more information: https://developer.wordpress.org/reference/classes/wp_query/
            global $post;
            $query_args = array(
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'posts_per_page' => $limit, 
                'post__not_in'   => array($post->ID),
                
                 );
           
            
            ob_start();
                      

            if($order == 'RANDOM') {
                $query_args = array_merge( $query_args,[
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'order'               => 'DESC',
                    'orderby'             => 'rand',
                ]);
            }
            else {
                $query_args =array_merge( $query_args,[
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'order'               => $order,
                ]);
            }
            if ( $categories && !empty( $categories ) ) {
                $query_args['category_name'] = $categories;
            }
            

            $the_query = new WP_Query( $query_args );
            
            if ( $the_query->have_posts() ) { ?>

<div class="rwu-related-posts"><?php
            printf("<%s class='related-section-title'>%s</%s>",$section_title_tag,$title,$section_title_tag);?>

    <div class="related-posts-wrap"><?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    if (($show_items_on_thumb =='si' && has_post_thumbnail( $post->ID )) || $show_items_on_thumb==='no' ){
                        echo '<div class="related-post %s">';
                        if( $show_thumb === 'si'){
                            printf('<a class="related-post-thumbnail" href="%s">%s</a>', get_permalink(), get_the_post_thumbnail($post->ID, 'medium'));
                        }
                    
                    printf('<%s><a class="related-post-title" href="%s">%s</a></$s></div>',$post_title_tag, get_permalink(), get_the_title(), $post_title_tag);
                    }
                }
                echo '</div></div>';
                wp_reset_postdata();
            } else {
            
            echo 'No se han encontrado posts';
            }
            
            return ob_get_clean();
    } 
        
        
        add_shortcode('rwu-related-posts','rwu_rel_posts');

        // Adding support to native WP elements
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
        add_filter('widget-text', 'do_shortcode');
        add_filter( 'the_title', 'do_shortcode' );
        add_filter( 'single_post_title', 'do_shortcode' );
        add_filter( 'wp_title', 'do_shortcode' );
        add_filter('the_excerpt', 'do_shortcode');

        // Rank Math Support
        /* add_filter( 'rank_math/frontend/title', function( $title ) {
            return do_shortcode( $title );
        });
        add_filter( 'rank_math/frontend/description', function( $description ) {
            return do_shortcode( $description );
        });
        // add_filter( 'rank_math/paper/auto_generated_description/apply_shortcode', '__return_true' );
        add_filter( 'rank_math/product_description/apply_shortcode', '__return_true' );
        add_filter( 'rank_math/frontend/breadcrumb/html', 'do_shortcode' );

        add_filter( 'rank_math/opengraph/facebook/og_title', function( $fbog ) {
            return do_shortcode( $fbog );
        });
        add_filter( 'rank_math/opengraph/facebook/og_description', function( $fbogdesc ) {
            return do_shortcode( $fbogdesc );
        });
        add_filter( 'rank_math/opengraph/twitter/title', function( $twtitle ) {
            return do_shortcode( $twtitle );
        });
        add_filter( 'rank_math/opengraph/twitter/description', function( $twdesc ) {
            return do_shortcode( $twdesc );
        }); */

        // Yoast SEO Support
        //add_filter( 'wpseo_title', 'do_shortcode' );
        //add_filter( 'wpseo_metadesc', 'do_shortcode' );
        //add_filter( 'wpseo_opengraph_title', 'do_shortcode' );
        //add_filter( 'wpseo_opengraph_desc', 'do_shortcode' );
        // add_filter( 'wpseo_json_ld_output', 'do_shortcode' );

        // SEOPress Support

        //add_filter( 'seopress_titles_title', 'do_shortcode'); // SEOPress Support
        //add_filter( 'seopress_titles_desc', 'do_shortcode'); // SEOPress Support

        // Miscellaneous
<<<<<<< HEAD
        add_filter( 'crp_title', 'do_shortcode'); // CRP Support
        add_filter( 'rank_math/snippet/breadcrumb', 'do_shortcode' );
}

if(isset($shortcodes_options['rwu_related_posts'])){

   

    function rwu_rel_posts($atts) { 
            /**
             * Argumentos:
             * * limit: Limite de entradas a mostrar, por defecto 10
             * * categories: categorias a mostrar separadas su slug por comas(category1,category2,...), por defecto ninguna
             * * order: Orden, por defecto rand, podemos mirar la docu del loop de WordPress para ver las que hay
             * * show_thumb: mostrar o no las imagenes destacadas, por defecto si
             * * show_items_on_thumb: Mostrar solo las entradas que tienen imagen destacada, por defecto no
             * * title: Titulo en el el listado de entradas (h3), por defecto 'Artículos Relacionados'
             * * section_title_tag: Etiqueta html para titulo de la seccion
             * * post_title_tag: Etiqueta html para titulo d ela entrada
             */
        
        
            extract(shortcode_atts( array (
                'limit'                 => '6',
                'categories'            => '',
                'order'                 =>'ASC',
                'show_thumb'            =>'si',
                'show_items_on_thumb'   =>'no',
                'section_title_tag'     =>'h3',
                'post_title_tag'        =>'h4',
                'title'                 =>'Entradas Relacionadas'
                ), $atts ));
                
                
        // more information: https://developer.wordpress.org/reference/classes/wp_query/
            global $post;
            $query_args = array(
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'posts_per_page' => $limit, 
                'post__not_in'   => array($post->ID),
                
                 );
           
            
            ob_start();
                      

            if($order == 'RANDOM') {
                $query_args = array_merge( $query_args,[
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'order'               => 'DESC',
                    'orderby'             => 'rand',
                ]);
            }
            else {
                $query_args =array_merge( $query_args,[
                    'ignore_sticky_posts' => true,
                    'no_found_rows'       => true,
                    'order'               => $order,
                ]);
            }
            if ( $categories && !empty( $categories ) ) {
                $query_args['category_name'] = $categories;
            }
            

            $the_query = new WP_Query( $query_args );
            var_dump( $query_args);
            if ( $the_query->have_posts() ) { ?>

<div class="rwu-related-posts"><?php
            printf("<%s class='related-section-title'>%s</%s>",$section_title_tag,$title,$section_title_tag);?>

    <div class="related-posts-wrap"><?php
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    if (($show_items_on_thumb =='si' && has_post_thumbnail( $post->ID )) || $show_items_on_thumb==='no' ){
                        echo '<div class="related-post %s">';
                        if( $show_thumb === 'si'){
                            printf('<a class="related-post-thumbnail" href="%s">%s</a>', get_permalink(), get_the_post_thumbnail($post->ID, 'medium'));
                        }
                    
                    printf('<%s><a class="related-post-title" href="%s">%s</a></$s></div>',$post_title_tag, get_permalink(), get_the_title(), $post_title_tag);
                    }
                }
                echo '</div></div>';
                wp_reset_postdata();
            } else {
            
            echo 'No se han encontrado posts';
            }
            
            return ob_get_clean();
    } 
        
        
        add_shortcode('rwu-related-posts','rwu_rel_posts');

        
=======
        //add_filter( 'crp_title', 'do_shortcode'); // CRP Support
        // add_filter( 'rank_math/snippet/breadcrumb', 'do_shortcode' );
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
        //Adding styles
        function rwu_add_related_css(){
            wp_enqueue_style( 'rwu_related_css', RAFAXWPUTILES_PLUGIN_URL.'/assets/css/rwu_related_posts_style.css');
        }
        add_action('wp_enqueue_scripts', "rwu_add_related_css"); 
  
    } 
/* 
* FUNCIONES 
*/
if(isset($functions_options['rwu_no_plugin_emails'])){
    
    // Disable plugins auto-update email notifications .
    add_filter( 'auto_plugin_update_send_email', '__return_false' );
    // Disable themes auto-update email notifications.
    add_filter( 'auto_theme_update_send_email', '__return_false' );
}

if(isset($functions_options['rwu_no_links_comments_author'])){

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
        add_filter('get_comment_author_url', 'rwu_remove_comment_author_url');
    }
}

if(isset($functions_options['rwu_no_plugin_emails'])){
    
    // Disable plugins auto-update email notifications .
    add_filter( 'auto_plugin_update_send_email', '__return_false' );
    // Disable themes auto-update email notifications.
    add_filter( 'auto_theme_update_send_email', '__return_false' );
}

if(isset($functions_options['rwu_button_delete_adminbar'])){
   
    
    function rwu_add_admin_bar_trash_menu() {
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
      add_action( 'admin_bar_menu', 'rwu_add_admin_bar_trash_menu', 35 );
}

if(isset($functions_options['rwu_delete_post_images'])){

   add_action( 'before_delete_post', function( $id ) {
  		$attachments = get_attached_media( '', $id );
  		foreach ($attachments as $attachment) {
    		wp_delete_attachment( $attachment->ID, 'true' );
  			}
	});
}




?>