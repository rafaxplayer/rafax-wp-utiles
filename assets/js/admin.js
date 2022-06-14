

function procesarSut() {
    jQuery('#rwu_options_form input[type="checkbox"]').each(function () {
        var id = "#" + jQuery(this).attr('id');
        id = id.replace('rwu', 'code');
        jQuery(id).toggleClass('hidden', !jQuery(this).prop('checked'));

    });
}

jQuery(document).ready(function () {
    procesarSut();
    processrelatedPosts();
    jQuery('#rwu_options_form').on('change', 'input[type="checkbox"]', function () {
        procesarSut();
    });

    jQuery('.nav-tab').on('click', function () {
        jQuery(this).addClass('active');
    });

    jQuery('#rwu_rel_shortcode').on('change', "select[name^='rel_']", function () {
        processrelatedPosts();
    });
    jQuery('#rel_cats').on('change keyup paste', function () {
        
        processrelatedPosts();
    });
    jQuery('#rel_number').on('change', function () {
        
        processrelatedPosts();
    });
    jQuery('#rel_shortcode_copy').on('click',function(){
        console.log(jQuery(this).attr('id'));
        copyToClipboard('#rel_shortcode');
    });

});

//prueva related
function processrelatedPosts() {

    var numer_posts = jQuery('#rel_number').val(),
        show_thumb = jQuery('#rel_show_thumb').val(),
        rel_no_thumb = jQuery('#rel_no_thumb').val(),
        order = jQuery('#rel_order').val(),
        cats = jQuery('#rel_cats').val(),
        section_title_tag = jQuery('#rel_title_section_tag').val(),
        post_title_tag = jQuery('#rel_title_post_tag').val(), sh = "";

        sh = numer_posts != '3' ? sh.concat(' limit="' + numer_posts + '"') : sh,
        sh = show_thumb == 'no' ? sh.concat(' show_thumb="' + show_thumb + '"') : sh,
        sh = rel_no_thumb == 'si' ? sh.concat(' show_items_on_thumb="' + rel_no_thumb + '"') : sh,
        sh = order != 'ASC' ? sh.concat(' order="' + order + '"', ' ') : sh,
        sh = section_title_tag != 'h3' ? sh.concat(' section_title_tag="' + section_title_tag + '"') : sh,
        sh = post_title_tag != 'h4' ? sh.concat(' section_title_tag="' + post_title_tag + '"') : sh,
        sh = cats ? sh = sh.concat(' categories="' + cats + '"') : sh;

    console.log(sh);
    jQuery('#rel_shortcode').val("[rwu-related-posts " + sh + "][/rwu-related-posts]");

}

function copyToClipboard(element) {
    jQuery(element).select();
    document.execCommand("copy");
  }

