<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 15/03/2018
 * Time: 15:18
 */




function sd_ipu_link_get_invoice_keys() {
    if(WP_ENV == 'development'){
        return [
            'invoice_number'    => 'field_5ab507012d2f2',
            'customer_name'     => 'field_5ab507192d2f3',
            'customer_email'    => 'field_5ab507322d2f4',
            'product'           => 'field_5ab507492d2f5',
            'price'             => 'field_5ab5075f2d2f6',
            'price_with_vat'    => 'field_5ab5078e2d2f7',
            'payment_status'    => 'field_5ab507af2d2f8',
            'payment_link'      => 'field_5ab507b82d2f9',
            'payment_link_hash' => 'field_5ab507ca2d2fa',
            'payment_id'        => 'field_5ab507d62d2fb',
            'note_to_member'    => 'field_5acf7ef5fe84b',
        ];
    }else{
        //staging/production keys
        return [
            'invoice_number'    => 'field_5ab507012d2f2',
            'customer_name'     => 'field_5ab507192d2f3',
            'customer_email'    => 'field_5ab507322d2f4',
            'product'           => 'field_5ab507492d2f5',
            'price'             => 'field_5ab5075f2d2f6',
            'price_with_vat'    => 'field_5ab5078e2d2f7',
            'payment_status'    => 'field_5ab507af2d2f8',
            'payment_link'      => 'field_5ab507b82d2f9',
            'payment_link_hash' => 'field_5ab507ca2d2fa',
            'payment_id'        => 'field_5ab507d62d2fb',
            'note_to_member'    => 'field_5acf7ef5fe84b',
        ];
    }
}


function ipu_link_invoice_form( $atts ) {
    $a = shortcode_atts( array(
        'errors' => '',
        'invoice_title' => '',
        'msg' => '',
        'post_id' => '',
        'invoice_number' => '',
        'customer_name' => '',
        'customer_email' => '',
        'product' => '',
        'price' => '',
        'price_with_vat' => '',
        'payment_link' => '',
        'payment_id' => '',
        'btn_resend' => '',
        'btn_delete' => '',
        'payment_status' => '',
        'note_to_member' => '',
        'from_content' => '1'
    ), $atts );

    $products   = getProducts();
    $vat_amount = esc_attr( get_option('sd_payment_link_vat') );

    $errors = $a['errors'];
    $invoice_title = $a['invoice_title'];
    $msg = $a['msg'];
    $post_id = $a['post_id'];
    $invoice_number = $a['invoice_number'];
    $customer_name = $a['customer_name'];
    $customer_email = $a['customer_email'];
    $product = $a['product'];
    $price = $a['price'];
    $price_with_vat = $a['price_with_vat'];
    $payment_link = $a['payment_link'];
    $payment_id = $a['payment_id'];
    $btn_resend = $a['btn_resend'];
    $btn_delete = $a['btn_delete'];
    $payment_status = $a['payment_status'];
    $from_content = $a['from_content'] == '1';
    $note_to_member = $a['note_to_member'];

    if($from_content) {
        if(isset($_POST['post_id'])) {

			if (filter_var($_POST['isChequeInvoice'] ? sanitize_text_field($_POST['isChequeInvoice']) : '', FILTER_VALIDATE_BOOLEAN))
			{
				$a = ipu_link_process_create_new_cheque_invoice_form_post();
			}			
			else{
				$a = ipu_link_process_create_new_form_post();
			}
            $errors = $a['errors'];
            $msg = $a['msg'];

            if($errors != '') {
                $customer_name = $a['customer_name'];
                $customer_email = $a['customer_email'];
                $product = $a['product'];
                $price = $a['price'];
                $price_with_vat = $a['price_with_vat'];
            }
        }
    }

    ob_start();

    ?>
    <div class="wrap">

        <?php if(isset($invoice_title) && $invoice_title != ''): ?>
            <h1>Invoice: <?php echo $invoice_title; ?></h1>
        <?php elseif(!$from_content): ?>
            <h1>Create Invoice</h1>
        <?php endif; ?>

        <?php

        if(count($errors) > 0){
            foreach($errors as $err): ?>
                <h4><?php echo $err; ?></h4>
            <?php endforeach;
        }

        if($msg){ ?>
            <h4 style="font-weight: bold; margin-bottom: 25px;"><?php echo $msg; ?></h4>

        <?php } ?>
        <div class="payment_wrapper">
            <form id="invoice_generator" class="ninja-forms-form" method="post" action="<?php echo !$from_content ? 'edit.php?post_type=invoice&page=new-invoice&post=<?php echo $post_id; ?>' : '' ?>">
                <div class="payment_fields_wrapper">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ? $post_id : ''?>" />
                    <input type="hidden" name="submitted" value="1" />
                    <?php if(!$from_content) {
                        ?>
                            <table class="form-table" style="width: 50%;">
                        <?php
                    } ?>

                     <?php if($invoice_number != ''): ?>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field-wrap text-wrap label-above" data-visible="1">
                        <<?php echo $from_content ? "label" : "td" ?> class="">Invoice Number</<?php echo $from_content ? "label" : "td" ?>>
                        <<?php echo $from_content ? "label" : "td" ?> class=""><?php echo $invoice_number; ?></<?php echo $from_content ? "label" : "td" ?>>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <?php endif; ?>

                    <<?php echo $from_content ? "div" : "tr" ?> class="field">
                        <<?php echo $from_content ? "label" : "td" ?>>Customer Name <i>*</i></<?php echo $from_content ? "label" : "td" ?>>
                        <?php if(!$from_content) {
                        ?>
                            <td>
                        <?php
                        } ?>
                            <input class="field" type="text" style="width: 100%" name="customer_name" required="" value="<?php echo $customer_name; ?>">
                        <?php if(!$from_content) { ?>
                            </td>
                            <?php
                        } ?>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field">
                        <<?php echo $from_content ? "label" : "td" ?>>Customer Email <i>*</i></<?php echo $from_content ? "label" : "td" ?>>
                        <?php if(!$from_content) {
                        ?>
                            <td>
                        <?php
                        } ?>
                            <input class="field" type="text" style="width: 100%" name="customer_email" required="" value="<?php echo $customer_email; ?>">
                        <?php if(!$from_content) { ?>
                        </td>
                        <?php
                        } ?>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field">
                        <<?php echo $from_content ? "label" : "td" ?>>Selected Product <i>*</i></<?php echo $from_content ? "label" : "td" ?>>
                        <<?php echo $from_content ? "div" : "td" ?> class="select_wrapper" style="width: 100%">
                            <select required type="text" name="product" style="width: 100%" >
                                <option <?php echo !$product ? 'selected' : ''; ?> disabled>Please select a product from the list</option>
                                <?php foreach($products as $p): ?>
                                    <option
                                            value="<?php echo $p['id']; ?>"
                                        <?php echo ($p['id'] == $product) ? 'selected="selected"' : ''; ?>
                                            vat_enabled="<?php echo $p['is_vat'] ? 1 : ''; ?>"><?php echo $p['title']; ?></option>
                                <?php endforeach;?>
                            </select>
                        </<?php echo $from_content ? "div" : "td" ?>>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> style="clear: both"></<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field" style="margin-top: 25px;">
                    <<?php echo $from_content ? "label" : "td" ?>>Note to Member</<?php echo $from_content ? "label" : "td" ?>>
                    <?php if(!$from_content) {
                        ?>
                        <td>
                            <?php
                            } ?>
                            <input class="field" type="text" style="width: 100%" name="note_to_member" value="<?php echo $note_to_member; ?>" />
                            <?php if(!$from_content) { ?>
                        </td>
                        <?php
                    } ?>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> style="clear: both"></<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field" style="margin-top: 25px;">
                        <<?php echo $from_content ? "label" : "td" ?>>Price <i>*</i></<?php echo $from_content ? "label" : "td" ?>>
                        <?php if(!$from_content) {
                        ?>
                        <td>
                            <?php
                            } ?>
                            <input class="field" type="text" style="width: 100%" name="price" required="" value="<?php echo $price; ?>">
                            <?php if(!$from_content) { ?>
                        </td>
                        <?php
                        } ?>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <<?php echo $from_content ? "div" : "tr" ?> class="field vat" style="display: none">
                        <<?php echo $from_content ? "label" : "td" ?>>Price with VAT <i>*</i></<?php echo $from_content ? "label" : "td" ?>>
                        <?php if(!$from_content) {
                        ?>
                        <td>
                            <?php
                            } ?>
                            <input class="field" type="text" style="width: 100%" name="price_with_vat" disabled required value="<?php echo $price_with_vat; ?>">
                            <?php if(!$from_content) { ?>
                        </td>
                        <?php
                        } ?>
                    </<?php echo $from_content ? "div" : "tr" ?>>
                    <?php if(!$from_content) {
                    ?>
                        </table>
                    <?php
                    } ?>

                    <table class="form-table">

                        <?php if($payment_status): ?>
                            <tr valign="top">
                                <th scope="row">Payment Status</th>
                                <td><?php echo $payment_status; ?></td>
                            </tr>
                        <?php endif; ?>

                        <?php if($payment_link): ?>
                            <tr valign="top">
                                <th scope="row">Payment Link</th>
                                <td><?php echo $payment_link; ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($payment_id): ?>
                            <tr valign="top">
                                <th scope="row">Payment ID</th>
                                <td><?php echo $payment_id; ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>

                    <?php if(!$from_content) {
                        submit_button('Save Changes', 'primary', 'submit', false, ['style'=>'margin:0 20px;']);
                        if($btn_resend && !isset($deleted)) submit_button('Resend Link', 'secondary', 'resend_link', false, ['style'=>'margin:0 20px;']);
                        if($btn_delete && !isset($deleted)) submit_button('Delete Invoice', 'delete', 'delete_invoice', false, ['style'=>'margin:0 20px;']);
                    } else {
                        ?>
                        <div class="form_submit">
                            <input class="button center" type="submit" value="Send Payment Link">
							<input class="button center" type="button" value="Send Cheque Invoice">
							<input class="field" type="hidden" style="width: 100%" name="isChequeInvoice" required="" value="false">
                        </div>
                        <?php
                    } ?>
					
					

                </div>
            </form>
        </div>

    </div>
    <script>
        jQuery(function ($) {
			$('input[name="isChequeInvoice"]').val('false');
			
            var vatAmnt = <?php echo $vat_amount; ?> / 100;
            var select = $('#invoice_generator select');
            select.on('change', function(){
                if($('option:selected', this).attr('vat_enabled')){
                    $('.vat').show();
                }else{
                    $('.vat').hide();
                }
            });
            if(select.val()){
                if($('option:selected', this).attr('vat_enabled')){
                    $('.vat').show();
                }else{
                    $('.vat').hide();
                }
            }
            $('input[name="price"]').on('focusout', function(){
                if($(this).val()){
                    var price = Number($(this).val());
                    var priceVat = price + price * vatAmnt;
                    $('.vat input').removeAttr('disabled').val(priceVat);
                }else{
                    $('.vat input').val(0);
                    $('.vat input').attr('disabled','disabled');
                }
            });
            $('.vat input').on('show', function(){
                if($('input[name="price"]').val()){
                    var price = Number($('input[name="price"]').val());
                    var priceVat = price + price * vatAmnt;
                    $('.vat input').removeAttr('disabled').val(priceVat);
                }
            });
            $('.vat input').on('focusout', function(){
                if($('input[name="price"]').val()){
                    var price = Number($('input[name="price"]').val());
                    var priceVat = price + price * vatAmnt;
                    $('.vat input').removeAttr('disabled').val(priceVat);
                }
            });
            if($('.vat input').val() && $('.vat input').attr('disabled')){
                $('.vat input').removeAttr('disabled');
            }
            $('#invoice_generator').on('submit', function(){
                if($('.vat').css('display') == 'none'){
                    $('.vat input').attr('disabled','disabled');
                }
            });
			
			$('.form_submit input[type="button"]').on('click', function(){
				$('input[name="isChequeInvoice"]').val('true');
				$('#invoice_generator').submit();
			});

        });
    </script>
    <?php

    return ob_get_clean();
}
add_shortcode('ipu_link_invoice_form', 'ipu_link_invoice_form');

function register_inv()
{
    add_submenu_page(
        'edit.php?post_type=invoice',
        'Invoice',
        'Add New Invoice',
        'manage_options',
        'new-invoice',
        'adminInv'
    );
}

function ipu_link_process_create_new_cheque_invoice_form_post() {

    $keys = sd_ipu_link_get_invoice_keys();
    $prodKeys = sd_ipu_link_get_product_keys();

    //new invoice case

    $customer_name   = $_POST['customer_name'] ? sanitize_text_field($_POST['customer_name']) : '';
    $customer_email  = $_POST['customer_email'] ? sanitize_text_field($_POST['customer_email']) : '';
    $product         = $_POST['product'] ? sanitize_text_field($_POST['product']) : '';
    $price           = $_POST['price'] ? sanitize_text_field($_POST['price']) : '';
    $price_with_vat  = (isset($_POST['price_with_vat']) && $_POST['price_with_vat']) ? sanitize_text_field($_POST['price_with_vat']) : null;
    $payment_status  = 'APPROVED';
    $errors = '';
    $msg = '';
    $btn_resend = '';
    $btn_delete = '';
    $invoice_number = '';
    $payment_link = '';
    $post_id = '';
    $invoice_title = '';
    $note_to_member = $_POST['note_to_member'] ? sanitize_text_field($_POST['note_to_member']) : '';
	
    if(
        !$customer_name  ||
        !$customer_email ||
        !$product        ||
        (!is_null($price_with_vat) && !$price_with_vat)
    ){
        $errors[] = "Please make sure mandatory fields are populated";
    }else{

        $invoice_title = $customer_name." - ".get_field($prodKeys['product_title'], $product);
        $post_id = wp_insert_post(
            [
                'post_type'   => 'invoice',
                'post_status' => 'publish',
                'post_title'  => $invoice_title,
            ],
            0
        );

        $payment_link   = generatePaymentLink($post_id, $product);
        $invoice_number = $post_id;
        update_field($keys['invoice_number'], $invoice_number, $post_id);
        update_field($keys['customer_name'], $customer_name, $post_id);
        update_field($keys['customer_email'], $customer_email, $post_id);
        update_field($keys['product'], $product, $post_id);
        update_field($keys['price'], $price, $post_id);
        update_field($keys['price_with_vat'], $price_with_vat, $post_id);
        update_field($keys['payment_link'], $payment_link, $post_id);
        update_field($keys['note_to_member'], $note_to_member, $post_id);

		$paymentLinkSent = sendChequeInvoice(
			[
				'stuff_email'    => get_field($prodKeys['ipu_staff_email'], $product),
				'link'           => $payment_link,
				'price_with_vat' => get_field($keys['price_with_vat'], $post_id),
				'price'          => get_field($keys['price'], $post_id),
				'cname'          => $customer_name,
				'cmail'          => $customer_email,
				'invoice_num'    => $invoice_number,
				'product'        => get_field($prodKeys['product_title'], $product),
				'note_to_member' => $note_to_member
			]
		);
		
		$msg = $paymentLinkSent ? 'New cheque invoice generated successfully' : 'Cheque Invoice is created, however email was not sent';
        
        $btn_resend     = true;
        $btn_delete     = true;
    }

    return array(
        'errors' => $errors,
        'invoice_title' => $invoice_title,
        'msg' => $msg,
        'post_id' => $post_id,
        'invoice_number' => $invoice_number,
        'customer_name' => $customer_name,
        'customer_email' => $customer_email,
        'product' => $product,
        'price' => $price,
        'price_with_vat' => $price_with_vat,
        'payment_link' => $payment_link,
        'btn_resend' => $btn_resend,
        'btn_delete' => $btn_delete,
        'payment_status' => $payment_status
    );
}

function ipu_link_process_create_new_form_post() {

    $keys = sd_ipu_link_get_invoice_keys();
    $prodKeys = sd_ipu_link_get_product_keys();

    //new invoice case

    $customer_name   = $_POST['customer_name'] ? sanitize_text_field($_POST['customer_name']) : '';
    $customer_email  = $_POST['customer_email'] ? sanitize_text_field($_POST['customer_email']) : '';
    $product         = $_POST['product'] ? sanitize_text_field($_POST['product']) : '';
    $price           = $_POST['price'] ? sanitize_text_field($_POST['price']) : '';
    $price_with_vat  = (isset($_POST['price_with_vat']) && $_POST['price_with_vat']) ? sanitize_text_field($_POST['price_with_vat']) : null;
    $payment_status  = 'pending';
    $errors = '';
    $msg = '';
    $btn_resend = '';
    $btn_delete = '';
    $invoice_number = '';
    $payment_link = '';
    $post_id = '';
    $invoice_title = '';
    $note_to_member = $_POST['note_to_member'] ? sanitize_text_field($_POST['note_to_member']) : '';

    if(
        !$customer_name  ||
        !$customer_email ||
        !$product        ||
        (!is_null($price_with_vat) && !$price_with_vat)
    ){
        $errors[] = "Please make sure mandatory fields are populated";
    }else{

        $invoice_title = $customer_name." - ".get_field($prodKeys['product_title'], $product);
        $post_id = wp_insert_post(
            [
                'post_type'   => 'invoice',
                'post_status' => 'publish',
                'post_title'  => $invoice_title,
            ],
            0
        );

        $payment_link   = generatePaymentLink($post_id, $product);
        $invoice_number = $post_id;
        update_field($keys['invoice_number'], $invoice_number, $post_id);
        update_field($keys['customer_name'], $customer_name, $post_id);
        update_field($keys['customer_email'], $customer_email, $post_id);
        update_field($keys['product'], $product, $post_id);
        update_field($keys['price'], $price, $post_id);
        update_field($keys['price_with_vat'], $price_with_vat, $post_id);
        update_field($keys['payment_link'], $payment_link, $post_id);
        update_field($keys['note_to_member'], $note_to_member, $post_id);

        $paymentLinkSent = sendPaymentLink(
            [
                'stuff_email'    => get_field($prodKeys['ipu_staff_email'], $product),
                'link'           => $payment_link,
                'price_with_vat' => get_field($keys['price_with_vat'], $post_id),
                'price'          => get_field($keys['price'], $post_id),
                'cname'          => $customer_name,
                'cmail'          => $customer_email,
                'invoice_num'    => $invoice_number,
                'product'        => get_field($prodKeys['product_title'], $product),
                'note_to_member' => $note_to_member
            ]
        );

        $paymentLinkSent ? update_field($keys['payment_status'], $payment_status, $post_id) : '';

        $msg = $paymentLinkSent ? 'New invoice generated successfully' : 'Invoice is created, however email was not sent';

        $btn_resend     = true;
        $btn_delete     = true;
    }

    return array(
        'errors' => $errors,
        'invoice_title' => $invoice_title,
        'msg' => $msg,
        'post_id' => $post_id,
        'invoice_number' => $invoice_number,
        'customer_name' => $customer_name,
        'customer_email' => $customer_email,
        'product' => $product,
        'price' => $price,
        'price_with_vat' => $price_with_vat,
        'payment_link' => $payment_link,
        'btn_resend' => $btn_resend,
        'btn_delete' => $btn_delete,
        'payment_status' => $payment_status
    );
}

function adminInv(){
    $errors = [];
    $msg    = '';

    $invoice_title = '';
    $post_id = '';
    $invoice_number = '';
    $customer_name  = '';
    $customer_email = '';
    $product        = '';
    $price          = '';
    $price_with_vat = '';
    $payment_status = '';
    $payment_link   = '';
    $payment_id = '';
    $btn_resend = '';
    $btn_delete = '';
    $note_to_member = '';

    $keys = sd_ipu_link_get_invoice_keys();
    $prodKeys = sd_ipu_link_get_product_keys();


    if(isset($_POST['post_id']) && $_POST['post_id']){
        //update existing invoice case

        if(isset($_POST['delete_invoice'])){
            $deleted = wp_delete_post((int)$_POST['post_id']);
        }

        $customer_name   = $_POST['customer_name'] ? sanitize_text_field($_POST['customer_name']) : '';
        $customer_email  = $_POST['customer_email'] ? sanitize_text_field($_POST['customer_email']) : '';
        $product         = $_POST['product'] ? sanitize_text_field($_POST['product']) : '';
        $price           = $_POST['price'] ? sanitize_text_field($_POST['price']) : '';
        $price_with_vat  = (isset($_POST['price_with_vat']) && $_POST['price_with_vat']) ? sanitize_text_field($_POST['price_with_vat']) : null;

        if(
            !$customer_name  ||
            !$customer_email ||
            !$product        ||
            (!is_null($price_with_vat) && !$price_with_vat)
        ){
            $errors[] = "Please make sure mandatory fields are populated";
        }else{

            $post_id = (int)$_POST['post_id'];

            if(isset($_POST['resend_link'])){
                $paymentLinkReSent = sendPaymentLink(
                    [
                        'stuff_email'    => get_field($prodKeys['ipu_staff_email'], $product),
                        'link'           => $payment_link = get_field($keys['payment_link'], $post_id),
                        'price_with_vat' => get_field($keys['price_with_vat'], $post_id),
                        'price'          => get_field($keys['price'], $post_id),
                        'cname'          => $customer_name,
                        'cmail'          => $customer_email,
                        'invoice_num'    => $invoice_number = $post_id,
                        'product'        => get_field($prodKeys['product_title'], $product),
                    ]
                );

                $payment_status = get_field($keys['payment_status'], $post_id);
                $payment_id     = get_field($keys['payment_id'], $post_id);

                $msg = $paymentLinkReSent ? 'Invoice payment link resent successfully' : 'Something went wrong while attempting to resend payment link';

                $btn_resend     = true;
                $btn_delete     = true;

            }else{
                $invoice_title = $customer_name." - ".get_field($prodKeys['product_title'], $product);

                $post_updated = wp_update_post(
                    [
                        'ID'          => $post_id,
                        'post_type'   => 'invoice',
                        'post_status' => 'publish',
                        'post_title'  => $invoice_title,
                    ],
                    0
                );

                if($post_updated){
                    update_field($keys['customer_name'], $customer_name, $post_id);
                    update_field($keys['customer_email'], $customer_email, $post_id);
                    update_field($keys['product'], $product, $post_id);
                    update_field($keys['price'], $price, $post_id);
                    update_field($keys['price_with_vat'], $price_with_vat, $post_id);

                    $invoice_number = $post_id;
                    $payment_status = get_field($keys['payment_status'], $post_id);
                    $payment_link   = get_field($keys['payment_link'], $post_id);
                    $payment_id     = get_field($keys['payment_id'], $post_id);

                    $msg = 'Invoice updated successfully';

                    $btn_resend     = true;
                    $btn_delete     = true;

                }elseif($deleted){
                    $post_id        = '';
                    $invoice_number = '';
                    $customer_name  = '';
                    $customer_email = '';
                    $product        = '';
                    $price          = '';
                    $price_with_vat = '';
                    $payment_status = '';
                    $payment_link   = '';
                    $payment_id     = '';
                    $msg = 'Invoice successfully deleted. Create new invoice';
                }
            }

        }

    }elseif(isset($_POST['post_id'])){

		if (filter_var($_POST['isChequeInvoice'] ? sanitize_text_field($_POST['isChequeInvoice']) : '', FILTER_VALIDATE_BOOLEAN))
		{
			$a = ipu_link_process_create_new_cheque_invoice_form_post();
		}			
		else{
			$a = ipu_link_process_create_new_form_post();
		}
		
        $errors = $a['errors'];
        $invoice_title = $a['invoice_title'];
        $msg = $a['msg'];
        $post_id = $a['post_id'];
        $invoice_number = $a['invoice_number'];
        $customer_name = $a['customer_name'];
        $customer_email = $a['customer_email'];
        $product = $a['product'];
        $price = $a['price'];
        $price_with_vat = $a['price_with_vat'];
        $payment_link = $a['payment_link'];
        $payment_id = $a['payment_id'];
        $btn_resend = $a['btn_resend'];
        $btn_delete = $a['btn_delete'];
        $payment_status = $a['payment_status'];
        $note_to_member = $a['note_to_member'];

    }elseif(isset($_GET['post']) && $_GET['post'] && get_post((int)$_GET['post'])->post_status == 'publish'){
        $post_id        = (int)$_GET['post'];

        $invoice_title  = get_post((int)$_GET['post'])->post_title;
        $invoice_number = get_field($keys['invoice_number'], $post_id);
        $customer_name  = get_field($keys['customer_name'], $post_id);
        $customer_email = get_field($keys['customer_email'], $post_id);
        $product        = get_field($keys['product'], $post_id);
        $price          = get_field($keys['price'], $post_id);
        $price_with_vat = get_field($keys['price_with_vat'], $post_id);
        $payment_status = get_field($keys['payment_status'], $post_id);
        $payment_link   = get_field($keys['payment_link'], $post_id);
        $payment_id     = get_field($keys['payment_id'], $post_id);
        $note_to_member = get_field($keys['note_to_member'], $post_id);
        $msg            = 'Update invoice';

        $btn_resend     = true;
        $btn_delete     = true;

    }else{
        $msg = 'Create new invoice';
    }

    echo ipu_link_invoice_form(array(
        'errors' => $errors,
        'invoice_title' => $invoice_title,
        'msg' => $msg,
        'post_id' => $post_id,
        'invoice_number' => $invoice_number,
        'customer_name' => $customer_name,
        'customer_email' => $customer_email,
        'product' => $product,
        'price' => $price,
        'price_with_vat' => $price_with_vat,
        'payment_link' => $payment_link,
        'payment_id' => $payment_id,
        'btn_resend' => $btn_resend,
        'btn_delete' => $btn_delete,
        'payment_status' => $payment_status,
        'note_to_member' => $note_to_member,
        'from_content' => '0'
    ));

}

function getProducts(){
    global $wpdb;
    $prodKeys = sd_ipu_link_get_product_keys();
//echo "<pre>";
    $products = $wpdb->get_results("SELECT id FROM wp_posts where post_type='product_register' and post_status='publish'", ARRAY_A);
    foreach($products as &$p){
        $p['is_vat'] = get_field($prodKeys['vat'], $p['id']);
        $p['title']  = get_field($prodKeys['product_title'], $p['id']);
    }

//    print_r(array_values($products));
    return $products;
}

function sendPaymentLink(array $data){
    //email payment link to client and staff who generated it
    $emailString = '<html><head></head><body>';
    $emailString .= 'Dear [CustomerName]';
    $emailString .= '<br/>';
    $emailString .= 'The IPU has generated an invoice regarding [ProductName]. '.
        'The invoice number is [InvoiceNumber] and the price is &euro;[Price]; '.
        'you can pay by card using the IPU Payment Link, <a href="[InvoiceLink]">click here</a>.';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    if(isset($data['note_to_member']) && $data['note_to_member']) {
        $emailString .= 'Note: [NoteToMember]';
        $emailString .= '<br/>';
        $emailString .= '<br/>';
    }
    $emailString .= 'Please retain this email for VAT purposes';
    $emailString .= '<br/>';
    $emailString .= 'Invoice Number: [InvoiceNumber]';
    $emailString .= '<br/>';
    $emailString .= 'Product Name: [ProductName]';
    $emailString .= '<br/>';
    $emailString .= 'Total Cost: &euro;[Price]';
    if($data['price_with_vat']) {
        $emailString .= '<br/>';
        $emailString .= 'VAT: &euro;[VAT]';
    }
	$emailString .= '<br/>';
	$emailString .= '<span style="color: red;">IPU VAT Reg No: IE 0064710R</span>';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'If you have any queries, you can email info@ipu.ie or phone 01 493 6401.';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'Regards';
    $emailString .= '<br/>';
    $emailString .= '[UserName]';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'Butterfield House, Butterfield Avenue, Rathfarnham, Dublin 14, D14 E126, Ireland';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= '[IPU Logo]';
    $emailString .= '<br/>';
    $emailString .= 'T +353 (0)1 493 6401 | F +353 (0)1 493 6407';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'info@ipu.ie | <a href="http://www.ipu.ie">www.ipu.ie</a> (<a href="http://www.ipu.ie/">http://www.ipu.ie/</a>)';
    $emailString .= '</body></html>';

    // calculate VAT
    if($data['price_with_vat']) {
        $data['only_vat_price'] = $data['price_with_vat'] - $data['price'];
    }


    $fieldsMapping = array(
        "ProductName" => "product",
        "CustomerName" => "cname",
        "InvoiceNumber" => "invoice_num",
        "Price" => $data['price_with_vat'] ? "price_with_vat" : "price",
        "InvoiceLink" => "link",
        "VAT" => "only_vat_price",
        "PriceExcludeVAT" => "price",
        "NoteToMember" => "note_to_member"
    );

    foreach($fieldsMapping as $key => $prop) {
        if(isset($data[$prop]) && ($data[$prop] || $data[$prop] == '0')) {
            $emailString = str_replace("[".$key."]", $data[$prop], $emailString);
        }
    }

    $current_user = wp_get_current_user();
    $current_username = $current_user->user_login;

    $emailString = str_replace("[UserName]", $current_username, $emailString);
    $emailString = str_replace("[IPU Logo]", '<img src="http://ipu.ie/wp-content/uploads/2014/11/logo_maxi_header.jpg" />', $emailString);

    //$emailString .= 'Product: ' . $data['product'];
    //$emailString .= $data['cname'];
    //$emailString .= $data['cmail'];
    //$emailString .= 'Invoice Number: '.$data['invoice_num'];
    //$emailString .= 'Generated by: '.$data['stuff_email'];
    //$emailString .= 'Price: '.$data['price'];
    //$emailString .= $data['price_with_vat'] ? 'Price with VAT: '.$data['price_with_vat'] : '';
    //$emailString .= $data['link'];

    $headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n"; // change to what the client wants to recieve emails as
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $mail_sent =  wp_mail( [$data['cmail'], $data['stuff_email']],
        'IPU Payment Link - Invoice Number '.$data['invoice_num'],
        $emailString,
        $headers
    );

    return $mail_sent;
}

function sendChequeInvoice(array $data){
    //email payment link to client and staff who generated it
    $emailString = '<html><head></head><body>';
    $emailString .= 'Dear [CustomerName]';
    $emailString .= '<br/>';
    $emailString .= 'The IPU has received your payment for [ProductName]';
	$emailString .= '<br/>';
	$emailString .= 'Note: [NoteToMember]';
	$emailString .= '<br/>';
	$emailString .= 'Please retain this email for VAT purposes';
	$emailString .= '<br/>';
	$emailString .= 'Invoice Number: [InvoiceNumber]';
	$emailString .= '<br/>';
	$emailString .= 'Product Name: [ProductName]';
	$emailString .= '<br/>';
	$emailString .= 'Total Cost: &euro;[Price]';
    if($data['price_with_vat']) {
        $emailString .= '<br/>';
        $emailString .= 'VAT: &euro;[VAT]';
    }
	$emailString .= '<br/>';
	$emailString .= '<span style="color: red;">IPU VAT Reg No: IE 0064710R</span>';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'If you have any queries, you can email info@ipu.ie or phone 01 493 6401.';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'Regards';
    $emailString .= '<br/>';
    $emailString .= '[UserName]';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'Butterfield House, Butterfield Avenue, Rathfarnham, Dublin 14, D14 E126, Ireland';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= '[IPU Logo]';
    $emailString .= '<br/>';
    $emailString .= 'T +353 (0)1 493 6401 | F +353 (0)1 493 6407';
    $emailString .= '<br/>';
    $emailString .= '<br/>';
    $emailString .= 'info@ipu.ie | <a href="http://www.ipu.ie">www.ipu.ie</a> (<a href="http://www.ipu.ie/">http://www.ipu.ie/</a>)';
    $emailString .= '</body></html>';

	// calculate VAT
    if($data['price_with_vat']) {
        $data['only_vat_price'] = $data['price_with_vat'] - $data['price'];
    }


    $fieldsMapping = array(
        "ProductName" => "product",
        "CustomerName" => "cname",
        "InvoiceNumber" => "invoice_num",
        "Price" => $data['price_with_vat'] ? "price_with_vat" : "price",
        //"InvoiceLink" => "link",
        "VAT" => "only_vat_price",
        "PriceExcludeVAT" => "price",
        "NoteToMember" => "note_to_member"
    );

    foreach($fieldsMapping as $key => $prop) {
        if(isset($data[$prop]) && ($data[$prop] || $data[$prop] == '0')) {
            $emailString = str_replace("[".$key."]", $data[$prop], $emailString);
        }
    }
	
    $current_user = wp_get_current_user();
    $current_username = $current_user->user_login;

    $emailString = str_replace("[UserName]", $current_username, $emailString);
    $emailString = str_replace("[IPU Logo]", '<img src="http://ipu.ie/wp-content/uploads/2014/11/logo_maxi_header.jpg" />', $emailString);
	
    $headers = 'From: IPU Services Limited <no-reply@ipu.ie>' . "\r\n"; // change to what the client wants to receive emails as
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $mail_sent =  wp_mail( [$data['cmail'], $data['stuff_email']],
        'IPU Payment Link - Cheque Invoice Number '.$data['invoice_num'],
        $emailString,
        $headers
    );

    return $mail_sent;
}

function generatePaymentLink($post_id, $product){
    $keys = sd_ipu_link_get_invoice_keys();
    //encode serialized arrays of invoice post id and product post id
    //on payment page decode and check invoice status if not already paid
    $hash = sha1(serialize(['invoice'=>$post_id,'product'=>$product]));
    $link = home_url()."/checkout/?l=".$hash;
    //update payment link hash in the invoice straight away
    update_field($keys['payment_link_hash'], $hash, $post_id);
    return $link;
}