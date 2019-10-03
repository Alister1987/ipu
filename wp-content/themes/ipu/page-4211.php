<?php
/**
Template Name: IPU Payment Thank you
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

	                             
	<article id="content_wrapper" class=''>
		                                                                                           
		<div class="content eight_column thanks_wrapper">
			<section class="payment_wrapper content_same_height">
				<div class="w_title">
					<div class="big_thanks"></div>
					<h2>THANK YOU, <?= $_SESSION['register_interest_name'] ?></h2>
					<h3 style='margin-top: 40px;'>You have registered your interest in <?= $_SESSION['register_interest_title'] ?></h3>
				</div>
				<div class="thx_content">
					<h4>You’ll receive a confirmation email shortly.</h4>
				</div>		
				<div class="thx_action">
					<a class="btn btn_action_back" href='<?= $_SESSION['register_interest_referrer'] ?>'>Back</a>
					<a class="btn btn_action_go" href='/'>Go to the homepage</a>
				</div>
			</section>
		</div>
	</article>

	<div class="thanks_dummy_wrapper">
		<span class="thanks_dummy"></span>
	</div>

            
<?php get_footer(); ?>