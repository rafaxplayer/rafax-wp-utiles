<?php
<<<<<<< HEAD
defined( 'ABSPATH' ) || exit;
=======
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
$array_ids = array();
$valid_urls='';

if(isset($_POST['rwu_urls'])){
    if(!empty($_POST['rwu_urls'])){
        $urls_list = $_POST['rwu_urls'];
        $lineas = explode("\n", $urls_list);
        $count = 0;
        foreach ($lineas as $linea) {
           if(preg_match("/^http/", $linea)){
                $parts = explode("/", $linea);
                $post = get_page_by_path($parts[count($parts) - 2],ARRAY_A,'post');
                if(get_post_status($post['ID'])){
                    $count++;
                    $valid_urls .= '['.$count.']'. $linea;
                    array_push($array_ids,$post['ID']);
                }
           }
        }
        $msg ='Se han encontrado '.count($array_ids).' entradas validas para eliminar';
        rwu_admin_messages($msg,'warning');
    }
}

if(isset($_POST['delete_ids'])){
    $ids = $_POST['delete_ids'];
    $idsArray = explode(",", $ids);
    $msg='';
    $c=0;
    if(is_array($idsArray) && !empty($idsArray)){
        foreach($idsArray as $id){
            wp_delete_post($id,true);
            $c++;
            $msg .= 'Deleted post id:' . $id . ', ';
        }
    }
    rwu_admin_messages($msg,'info');
}?>
<div class="wrap wrap-tool" id="rwu_mas_bulk">
        <h3>Eliminar entradas por urls</h3>
        <p>Introduce un listado de url ( una por linea ) para eliminar entradas o paginas de tu proyecto.</p>

        <form action="#" class="rwu_form" method="post">
            <textarea name="rwu_urls" id="rwu_urls" cols="80" rows="10"><?php echo $valid_urls; ?></textarea>
            <input class="button button-secondary <?php echo count($array_ids) > 0 ? 'hidden' : ''; ?>" type="submit"
                value="Verificar">
        </form>
        <form action="#" class="rwu_form" method="post">
            <input class="hidden" type="text" name="delete_ids" value="<?php echo implode(",", $array_ids); ?>">
            <input id="rwu_delete_posts" type="submit"
                class="button button-secondary <?php echo count($array_ids) > 0 ? '' : 'hidden'; ?>" value="Eliminar">
        </form>
    </div>