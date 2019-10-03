<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 22/03/2018
 * Time: 15:40
 */

function redirect_edit_links() {

    if(isset($_GET['post_type']) && $_GET['post_type'] === 'invoice'){
        $link = 'edit.php?post_type=invoice&page=new-invoice';
        $ptype = 'invoice';
    }
    else if(isset($_GET['post_type']) && $_GET['post_type'] === 'product_register'){
        $link  = 'edit.php?post_type=product_register&page=new-product';
        $ptype = 'product_register';
    }

    if($link){ ?>

        <script>
            jQuery(function ($) {

                var link = '<?php echo $link; ?>';
                var ptype = '<?php echo $ptype; ?>';

                $('.page-title-action').attr('href', link);
                $('.row-actions .edit, .row-actions .inline').hide();
                $('#bulk-action-selector-top option.hide-if-no-js, #bulk-action-selector-bottom option.hide-if-no-js').hide();

                $('tr.type-'+ptype+' a.row-title').each(function(){
                    var urlParts = $(this).attr('href').split('/');
                    var post_url = urlParts[urlParts.length - 1].split('?')[1];
                    var pid = retrieveGetVar('post', post_url);
                    $(this).attr('href', link+'&post='+pid);
                });

            });
            function retrieveGetVar(variable, query)
            {
                var vars = query.split("&");
                for (var i=0;i<vars.length;i++) {
                    var pair = vars[i].split("=");
                    if(pair[0] == variable){return pair[1];}
                }
                return(false);
            }
        </script>

    <?php }
}

add_filter('admin_footer', 'redirect_edit_links');