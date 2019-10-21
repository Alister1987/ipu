<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 15/03/2018
 * Time: 01:53
 */

function sd_ipu_link_get_product_keys() {
    if(WP_ENV == 'development'){
        return [
            'product_id'          => 'field_5ab5083354a4a',
            'product_title'       => 'field_5ab5084a54a4b',
            'product_description' => 'field_5ab5085b54a4c',
            'ipu_staff_email'     => 'field_5ab5086b54a4d',
            'vat'                 => 'field_5ab5087854a4e',
        ];
    }else{
        //staging/production keys
        return [
            'product_id'          => 'field_5ab5083354a4a',
            'product_title'       => 'field_5ab5084a54a4b',
            'product_description' => 'field_5ab5085b54a4c',
            'ipu_staff_email'     => 'field_5ab5086b54a4d',
            'vat'                 => 'field_5ab5087854a4e',
        ];
    }
}

function register_proj()
{
    add_submenu_page(
        'edit.php?post_type=product_register',
        'Register Product',
        'Add New Product',
        'manage_options',
        'new-product',
        'adminProj'
    );
}

function adminProj(){

    $errors = [];
    $msg    = '';

    $post_id              = '';
    $product_id           = '';
    $product_title        = '';
    $product_description  = '';
    $ipu_staff_email      = '';
    $vat                  = '';

    if(WP_ENV == 'development'){
        $keys = [
            'product_id'          => 'field_5ab5083354a4a',
            'product_title'       => 'field_5ab5084a54a4b',
            'product_description' => 'field_5ab5085b54a4c',
            'ipu_staff_email'     => 'field_5ab5086b54a4d',
            'vat'                 => 'field_5ab5087854a4e',
        ];
    }else{
        //staging/production keys
        $keys = [
            'product_id'          => 'field_5ab5083354a4a',
            'product_title'       => 'field_5ab5084a54a4b',
            'product_description' => 'field_5ab5085b54a4c',
            'ipu_staff_email'     => 'field_5ab5086b54a4d',
            'vat'                 => 'field_5ab5087854a4e',
        ];
    }


    if(isset($_POST['post_id']) && $_POST['post_id']){

        if(isset($_POST['delete_product'])){
            $deleted = wp_delete_post((int)$_POST['post_id']);
        }

        $post_id             = (int)$_POST['post_id'];
        $product_id          = get_field($keys['product_id'], $post_id);
        $product_title       = sanitize_text_field($_POST['product_title']);
        $product_description = esc_textarea($_POST['product_description']);
        $ipu_staff_email     = sanitize_email($_POST['ipu_staff_email']);
        $vat                 = isset($_POST['vat']) ? true : false;

        if(!$product_title || !$ipu_staff_email){
            $errors[] = "Please make sure mandatory fields are populated";
        }else{

            $post_updated = wp_update_post(
                [
                    'ID'          => $post_id,
                    'post_type'   => 'product_register',
                    'post_status' => 'publish',
                    'post_title'  => $product_title,
                ],
                0
            );

            if($post_updated){
                update_field($keys['product_title'], $product_title, $post_id);
                update_field($keys['product_description'], $product_description, $post_id);
                update_field($keys['ipu_staff_email'], $ipu_staff_email, $post_id);
                update_field($keys['vat'], $vat, $post_id);

                $msg = 'Product updated successfully';

                $btn_delete     = true;

            }elseif($deleted){
                $post_id             = '';
                $product_id          = '';
                $product_title       = '';
                $product_description = '';
                $ipu_staff_email     = '';
                $vat                 = '';
                $msg = 'Product successfully deleted. Create new product';
            }
        }

    }elseif(isset($_POST['post_id'])){

        $product_title       = $_POST['product_title'] ? sanitize_text_field($_POST['product_title']) : '';
        $product_description = esc_textarea($_POST['product_description']);
        $ipu_staff_email     = $_POST['ipu_staff_email'] ? sanitize_email($_POST['ipu_staff_email']) : '';
        $vat                 = isset($_POST['vat']) ? true : false;

        if(!$product_title || !$ipu_staff_email){
            $errors[] = "Please make sure mandatory fields are populated";
        }else{
            $post_id = wp_insert_post(
                [
                    'post_type'   => 'product_register',
                    'post_status' => 'publish',
                    'post_title'  => $product_title,
                ],
                0
            );

            $product_id = $post_id;
            update_field($keys['product_id'], $product_id, $post_id);
            update_field($keys['product_title'], $product_title, $post_id);
            update_field($keys['product_description'], $product_description, $post_id);
            update_field($keys['ipu_staff_email'], $ipu_staff_email, $post_id);
            update_field($keys['vat'], $vat, $post_id);

            $msg = 'New product saved successfully';

            $btn_delete     = true;

        }

    }elseif(isset($_GET['post']) && $_GET['post']){
        $post_id             = (int)$_GET['post'];
        $product_id          = get_field($keys['product_id'], $post_id);
        $product_title       = get_field($keys['product_title'], $post_id);
        $product_description = get_field($keys['product_description'], $post_id);
        $ipu_staff_email     = get_field($keys['ipu_staff_email'], $post_id);
        $vat                 = get_field($keys['vat'], $post_id);
        $msg                 = 'Update product';
        $btn_delete     = true;
    }else{
        $msg = 'Create new product';
    }

    ?>
    <div class="wrap">

        <?php if(isset($product_title)): ?>
            <h1>Product Register: <?php echo $product_title; ?></h1>
        <?php else: ?>
            <h1>Product Register</h1>
        <?php endif; ?>

        <?php

        if(count($errors) > 1){
            foreach($errors as $err): ?>
                <h4><?php echo $err; ?></h4>
            <?php endforeach;
        }

        if($msg){ ?>
            <h4><?php echo $msg; ?></h4>

        <?php } ?>

        <form method="post" action="edit.php?post_type=product_register&page=new-product&post=<?php echo $post_id; ?>">
            <input type="hidden" name="post_id" value="<?php echo $post_id ? $post_id : ''?>" />
            <input type="hidden" name="submitted" value="1" />
            <table class="form-table">
                <?php if($product_id): ?>
                    <tr valign="top">
                        <th scope="row">Product ID</th>
                        <td><?php echo $product_id; ?></td>
                    </tr>
                <?php endif; ?>
                <tr valign="top">
                    <th scope="row">Product Title *</th>
                    <td><input required type="text" name="product_title" style="width: 50%" value="<?php echo $product_title; ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Product Description</th>
                    <td><textarea rows="10" name="product_description" style="width: 50%"><?php echo $product_description; ?></textarea></td>
                </tr>

                <tr valign="top">
                    <th scope="row">IPU Staff Email *</th>
                    <td><input required type="email" name="ipu_staff_email" style="width: 50%" value="<?php echo $ipu_staff_email; ?>" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Charge VAT</th>
                    <td><input type="checkbox" name="vat" value="1" <?php echo ($vat ? "checked": ""); ?> /></td>
                </tr>
            </table>

            <?php submit_button('Save Changes', 'primary', 'submit', false, ['style'=>'margin:0 20px;']); ?>

            <?php if($btn_delete && !isset($deleted)) submit_button('Delete Product', 'delete', 'delete_product', false, ['style'=>'margin:0 20px;']); ?>

        </form>

    </div>

    <?php

}
