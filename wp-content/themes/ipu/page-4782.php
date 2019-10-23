<?php
/**
Template Name: IPU Payment Thank you
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>

<style>
	.bq_answer .bq_btn_sort_wrapper input[type="checkbox"]{
		display: none!important;
	}
</style>         
<article id="content_wrapper" class="">

		<aside class="sidebar two_column sb_mk_about">
			<div class="sb_wrapper sb_wrapper_stickit">
				<div class="sb_txt">This section provides advice and support on the professional issues in your pharmacy. Where necessary, guidelines are in ‘word’ format to facilitate customisation for your pharm</div>
			</div>
		</aside>
			
		<div class="content eight_column">
			<section class="payment_wrapper form_application_wrapper form_business_wrapper content_same_height">

 
				<?= do_shortcode('[contact-form-7 id="4784" title="Business form" html_id="business_form"]'); ?>
 
					
 			</section>	

			<section class="payment_right_sidebar business_right_sidebar content_same_height" style="height: 1162px;">
				
			<!-- 	<div class="secure_payment difficulty_payment">
					<h3>Experiencing a difficulty?</h3>
					<p>Call the support at <a href="tel://1-555-555-5555">0834 24 24 24</a> or email us at <a href="mailto:email@mail.ie">email@mail.ie</a></p>
				</div> -->

			</section>
		

		</div>
	</article>

            
<?php get_footer(); ?>