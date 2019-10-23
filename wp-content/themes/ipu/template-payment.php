<?php
/**
Template Name: IPU Payment
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header('payment'); ?>

<?php
$itemToPurchase = get_post(isset($_GET['item']) ? $_GET['item'] : '-1');

$is_invoice = (isset($_GET['l']) && $_GET['l']) ? $_GET['l'] : false;

$memberPrice = 0;
$nonMemberPrice = 0;

if($itemToPurchase) {
    $itemType = $itemToPurchase->post_type;

    if($itemType == 'course') {
        $memberPrice = $itemToPurchase->members_price;
        $nonMemberPrice = $itemToPurchase->non_member_price;
    } else {
        $memberPrice = $itemToPurchase->price_member;
        $nonMemberPrice = $itemToPurchase->price_non_member;
    }

    // calculating prices per member or not member
    $mTotal = 0;
    $nmTotal = 0;
    $mTotalLabel = '';
    $nmTotalLabel = '';
    $grandTotalLabel = 'Total';

    if($itemType == 'event') {
        if(isset($_GET['m_qty']) && $memberPrice != '') {
            $mTotal = $_GET['m_qty'] * $memberPrice;
            $mTotalLabel = $_GET['m_qty'].' Member Ticket';
        }

        if(isset($_GET['nm_qty']) && $nonMemberPrice != '') {
            $nmTotal = $_GET['nm_qty'] * $nonMemberPrice;
            $nmTotalLabel = $_GET['nm_qty'].' Non-Member Ticket';
        }
    } else {
        // checking if logged in
        if (is_user_logged_in() && $memberPrice != '') {

            $mTotal = $memberPrice;

        } else {
            $nmTotal = $nonMemberPrice;
        }

        $grandTotalLabel = 'Price';
    }

    $grandTotal = $mTotal + $nmTotal;
}elseif($is_invoice){
    global $wpdb;

    $q = $wpdb->prepare(
        "select post_id from wp_postmeta where meta_key = 'payment_link_hash' and meta_value = %s",
        sanitize_text_field($_GET['l'])
    );

    $invoice_pid   = $wpdb->get_var($q);
    $invoice_data  = get_post($invoice_pid);

    $invoice_title = $invoice_data->post_title;
    $invoice_price = $invoice_data->price_with_vat ? $invoice_data->price_with_vat : $invoice_data->price;
    $vatable       = $invoice_data->price_with_vat ? 'yes' : 'no';
    $product_name  = get_field('product_title', $invoice_data->product);

    $grandTotal    = $invoice_price;

}
?>

    <article id="main_img" class="mi_redux">
        <div class="sip_steps">
            <div class="sip_step_wrapper active_step">
                <div class="sip_step_inside step_1">
                    <span class="sip_step">1</span>
                    <?php if(!$is_invoice):?><p>Choose Tickets</p><?php else: ?><p>Invoice</p><?php endif ?>
                </div>
            </div>
            <div class="sip_step_wrapper active_step">
                <div class="sip_step_inside step_2">
                    <span class="sip_step">2</span>
                    <p>Payment</p>
                </div>
            </div>
            <div class="sip_step_wrapper">
                <div class="sip_step_inside step_3">
                    <span class="sip_step">3</span>
                    <p>Complete</p>
                </div>
            </div>
        </div>

    </article>

    <article id="content_wrapper" class=''>
        <aside class="sidebar sb_single_item sb_single_article sb_single_event sb_payment two_column ">
            <?php if($itemToPurchase) {

                if(isset($itemToPurchase->{'date'}) && $itemToPurchase->date != '') { ?>
                    <div class="se_date">
                    <span class="se_date_day"><?php echo date('d M Y', $itemToPurchase->date) ?><span>
                    <span class="se_date_hour"><?php echo date('H:i', $itemToPurchase->date) ?><span>
                    </div>
                <?php } ?>

                <div class="se_info">
                    <h3><?php echo $itemToPurchase->post_title ?></h3>
                    <?php if(isset($itemToPurchase->venue) && $itemToPurchase->venue != '') {
                        $venue = nl2br($itemToPurchase->venue);
                        ?>

                        <span class="se_info_address">
                        <?php echo $venue ?>
                    </span>

                    <?php } ?>
                </div>

                <?php if($itemToPurchase->supporting_text) { ?>
                    <div class="sb_txt"><?= $itemToPurchase->supporting_text ?></div>
                <?php } ?>

                <?php
                $downloadFile = wp_get_attachment_url($itemToPurchase->application_form);
                ?>

                <?php if ($downloadFile) { ?>
                    <a href="<?= $downloadFile ?>" target="_blank" class="btn btn_action_dowload_blue">Download</a>
                <?php } ?>

            <?php }elseif($is_invoice){ ?>

                <div class="se_info"><h3><?php echo $invoice_title ?></h3></div>

            <?php } ?>
        </aside>

        <div class="content eight_column">
            <section class="payment_wrapper content_same_height">
                <?php
                if($is_invoice){
                    echo do_shortcode('[invoicePaymentForm total="' . $grandTotal . '" product="' . $invoice_data->product . '" vatable="' . $vatable . '" invoice_title="' . $invoice_title . '" invoice="' . $invoice_data->ID . '"]');
                }else{
                    echo do_shortcode('[callCardInfoForm total="' . $grandTotal . '"]');
                }
                ?>
            </section>

            <?php if ($is_invoice) { ?>
                <section class="payment_right_sidebar content_same_height">
                    <div class="rsb_cart_summary">
                        <h3>Invoice summary</h3>
                        <div class="cs_total">
                            <span class="total_label">Price</span>
                            <span class="total_number"><?= number_format($grandTotal, 2) ?> €</span>
                        </div>
                    </div>
                    <div class="secure_payment  se_date">
                        <h3>Secure payment</h3>
                        <p>Security is our highest priority. We meet or exceed the most stringent industry standards: each
                            piece of our infrastructure and each stage of our operations are designed with security in
                            mind.</p>
                        <div class="sip_stripe"> <!-- Stripe logo -->
                            <a href="//www.authipay.com/" target="_blank">
                                <img src="<?php echo get_template_directory_uri() ?>/images/aib_logo.png" width="100%">
                            </a>
                        </div>
                    </div>
                    <div class="secure_payment">
                        <h3>Experiencing a problem</h3>
                        <p>Call the support at <a href="tel:+35314936401">+353 1 493 6401</a> or email us at <a
                                    href="mailto:info@ipu.ie">info@ipu.ie</a></p>
                    </div>
                </section>
            <?php }elseif ($itemToPurchase) { ?>
                <section class="payment_right_sidebar content_same_height">
                    <div class="rsb_cart_summary">
                        <h3>Cart summary</h3>
                        <div class="cs_tickets">
                            <?php if($grandTotalLabel != 'Price') { ?>
                                <?php if($mTotal != 0) { ?>
                                    <div class="cs_single_ticket">
                                        <span class="type"><?= $mTotalLabel ?></span>
                                        <span class="price"><?= number_format($mTotal, 2) ?>€</span>
                                    </div>
                                <?php } ?>
                                <?php if($nmTotal != 0) { ?>
                                    <div class="cs_single_ticket">
                                        <span class="type"><?= $nmTotalLabel ?></span>
                                        <span class="price"><?= number_format($nmTotal, 2) ?>€</span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <div class="cs_total">
                                <span class="total_label"><?= $grandTotalLabel ?></span>
                                <span class="total_number"><?= number_format($grandTotal, 2) ?> €</span>
                            </div>
                        </div>
                    </div>
                    <div class="secure_payment  se_date">
                        <h3>Secure payment</h3>
                        <p>Security is our highest priority. We meet or exceed the most stringent industry standards: each piece of our infrastructure and each stage of our operations are designed with security in mind.</p>
                        <div class="sip_stripe"> <!-- Stripe logo -->
                            <a href="//www.authipay.com/" target="_blank">
                                <img src="<?php echo get_template_directory_uri()?>/images/aib_logo.png" width="100%">
                            </a>
                        </div>
                    </div>
                    <div class="secure_payment">
                        <h3>Experiencing a problem</h3>
                        <p>Call the support at <a href="tel:+35314936401">+353 1 493 6401</a> or email us at <a href="mailto:info@ipu.ie">info@ipu.ie</a></p>
                    </div>
                    <!--
                                <div class="secure_payment difficulty_payment">
                                    <h3>Experiencing a difficulty?</h3>
                                    <p>Call the support at <a href="tel://0035314936401">+353 1 493 6401</a> or email us at <a href="mailto:info@ipu.ie">info@ipu.ie</a></p>
                                </div> -->

                </section>
            <?php } ?>



        </div>
    </article>

<?php get_footer(); ?>