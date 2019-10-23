<?php
/**
Template Name: IPU Payment Thank you
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header('payment'); ?>

<?php
//$itemToPurchase = get_post(isset($_GET['item']) ? $_GET['item'] : '-1');
//
//$memberPrice = 0;
//$nonMemberPrice = 0;
//
//if($itemToPurchase) {
//    $itemType = $itemToPurchase->post_type;
//
//    if($itemType == 'course') {
//        $memberPrice = $itemToPurchase->members_price;
//        $nonMemberPrice = $itemToPurchase->non_member_price;
//    } else {
//        $memberPrice = $itemToPurchase->price_member;
//        $nonMemberPrice = $itemToPurchase->price_non_member;
//    }
//
//    // calculating prices per member or not member
//    $mTotal = 0;
//    $nmTotal = 0;
//    $mTotalLabel = '';
//    $nmTotalLabel = '';
//    $grandTotalLabel = 'Total';
//
//    if($itemType == 'event') {
//        if(isset($_GET['m_qty']) && $memberPrice != '') {
//            $mTotal = $_GET['m_qty'] * $memberPrice;
//            $mTotalLabel = $_GET['m_qty'].' Member Ticket';
//        }
//
//        if(isset($_GET['nm_qty']) && $nonMemberPrice != '') {
//            $nmTotal = $_GET['nm_qty'] * $nonMemberPrice;
//            $nmTotalLabel = $_GET['nm_qty'].' Non-Member Ticket';
//        }
//    } else {
//        // checking if logged in
//        if (is_user_logged_in() && $memberPrice != '') {
//
//            $mTotal = $memberPrice;
//
//        } else {
//            $nmTotal = $nonMemberPrice;
//        }
//
//        $grandTotalLabel = 'Price';
//    }
//
//    $grandTotal = $mTotal + $nmTotal;
//}

$error = "";
$thankYouText = "Thank you";
$transationText = "Transaction complete";
if(isset($_POST["fail_reason"])){

	$thankYouText = "Somenthing went wrong";
	$error = $_POST["fail_reason"];
	$transationText = "Transaction aborted";
}

?>

    <article id="main_img" class="mi_redux mi_thanks">


        <div class="sip_steps">
            <div class="sip_step_wrapper active_step">
                <div class="sip_step_inside step_1">
                    <span class="sip_step">1</span>
                    <p>Choose Tickets</p>
                </div>
            </div>
            <div class="sip_step_wrapper active_step">
                <div class="sip_step_inside step_2">
                    <span class="sip_step">2</span>
                    <p>Payment</p>
                </div>
            </div>
            <div class="sip_step_wrapper active_step">
                <div class="sip_step_inside step_3">
                    <span class="sip_step">3</span>
                    <p>Complete</p>
                </div>
            </div>
        </div>

    </article>

    <article id="content_wrapper" class=''>

        <div class="content eight_column thanks_wrapper">
            <section class="payment_wrapper content_same_height">
                <div class="w_title">
                    <div class="big_thanks <?php echo $error ? "nope":""?>"></div>
                    <h3><?php echo $transationText?></h3>
                    <h2><?=$thankYouText." ". $_GET['fname'] ?> <?= $_GET['lname']?></h2>
                </div>
				<?php if(!$error) {?>
                    <div class="thx_content">
                        <h4>You’ll receive a confirmation email shortly.</h4>
                    </div>
				<?php }else{?>
                    <div class="thx_content">
                        <h4>Error : <?php echo $error?>  </h4>
                    </div>
				<?php } ?>
                <div class="thx_action">
                    <a class="btn btn_action_back" href='/'>Return to event & training</a>
                    <a class="btn btn_action_go" href='/'>Go to the homepage</a>
                </div>
            </section>
        </div>
    </article>

    <div class="thanks_dummy_wrapper">
        <span class="thanks_dummy"></span>
    </div>


<?php get_footer(); ?>