<?php 
<<<<<<< HEAD
defined( 'ABSPATH' ) || exit;
=======
>>>>>>> 0d4868b8a2b3ce0cc0743b6e76739d2b63e5f342
$options = get_option( 'rwu_shortcodes_settings' );
if(isset($options['rwu_related_posts'])){?>
<div class="wrap wrap-tool" id="rwu_rel_shortcode">
    <h3>Generador de shortcode - Related posts</h3>
    <p>Introduce datos para generar el shortcode para enentrads relacionadas</p>
    <div class="options">
        <span class="label"><?=__('Numero de entradas','rafax-wp-utiles')?></span>
        <input type="number" name="rel_number" id="rel_number" min="1" value="3">
    </div>
    <div class="options">
        <span class="label"><?=__('Mostrar imagenes','rafax-wp-utiles')?></span>
        <select name="rel_show_thumb" id="rel_show_thumb">
            <option value="si" selected><?=__('Si','rafax-wp-utiles')?></option>
            <option value="no"><?=__('No','rafax-wp-utiles')?></option>
        </select>
    </div>
    <div class="options">
        <span class="label"><?=__('¿Mostrar entrads sin imagen?','rafax-wp-utiles')?></span>
        <select name="rel_no_thumb" id="rel_no_thumb">
            <option value="si"><?=__('Si','rafax-wp-utiles')?></option>
            <option value="no" selected><?=__('No','rafax-wp-utiles')?></option>
        </select>
    </div>

    <div class="options">
        <div class="list_options"> <span class="label"><?=__('Order','apolotheme')?></span>
            <select name="rel_order" id="rel_order">
                <option value="ASC" selected><?=__('Older first','apolotheme')?></option>
                <option value="DESC"><?=__('Most recent first','apolotheme')?></option>
                <option value="RANDOM"><?=__('Random','apolotheme')?></option>
            </select>
        </div>
    </div>
    <div class="options">
        <span class="label"><?=__('Lista de categorias separadas por coma','rafax-wp-utiles')?></span>
        <input type="text" name="rel_cats" id="rel_cats" style="margin-left:10px;width:100%;max-width:60%" value="">
    </div>

    <div class="options">
        <div class="list_options"> <span class="label"><?=__('Tag para el titulo de seccion','rafax-wp-utiles')?></span>
            <select name="rel_title_section_tag" id="rel_title_section_tag">
                <option value="p"><?=__('Parrafo','rafax-wp-utiles')?></option>
                <option value="h1">Titulo (h1)</option>
                <option value="h2">Titulo (h2)</option>
                <option value="h3" selected>Titulo (h3)</option>
                <option value="h4">Titulo (h4)</option>
            </select>
        </div>
    </div>
    <div class="options">
        <div class="list_options"> <span
                class="label"><?=__('Tag para el tiutulo de la entrada','rafax-wp-utiles')?></span>
            <select name="rel_title_post_tag" id="rel_title_post_tag">
                <option value="p"><?=__('Parrafo','rafax-wp-utiles')?></option>
                <option value="h1">Titulo (h1)</option>
                <option value="h2">Titulo (h2)</option>
                <option value="h3">Titulo (h3)</option>
                <option value="h4" selected>Titulo (h4)</option>
            </select>
        </div>
    </div>
    <div class="options">
    <span class="label"><?=__('ShortCode','rafax-wp-utiles')?></span>
        <input id="rel_shortcode" name="rel_shortcode" type="text" style="margin-left:10px;width:100%;max-width:80%" value="[rwu-related-posts]">
        <input id="rel_shortcode_copy" type="button" value="Copy">
    </div>
</div>

<?php echo '<script>


</script>';}