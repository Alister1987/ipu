<?php
/**
*Template Name: BUSINESS FORM
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
	
	.hidden_business_form {
		display:none !important;;
	}
</style>
<article id="content_wrapper" class="">
	<aside class="sidebar two_column sb_mk_about">
		<div class="sb_wrapper sb_wrapper_stickit">
			<div class="sb_txt">If there are any areas of concern arising when you complete the IPU Business Health Check and you would like to discuss further please contact the IPU Business Department on 01 406 1558</div>
		</div>
	</aside>
	<div class="content eight_column">
		<section class="payment_wrapper form_application_wrapper form_business_wrapper">
			<?= do_shortcode('[contact-form-7 id="4930" html_id="business_form" title="Business form"]'); ?>
		</section>
		<section class="payment_right_sidebar business_right_sidebar">
	<!-- 		<div class="secure_payment difficulty_payment">
				<h3>Experiencing a difficulty?</h3>
				<p>Call the support at <a href="tel://1-555-555-5555">0834 24 24 24</a> or email us at <a href="mailto:email@mail.ie">email@mail.ie</a></p>
			</div> -->
		</section>
	</div>
</article>
<script type="text/javascript">
    $('#business_form > p:eq(0)').hide();

    $('.business_form_prev').click(function(){
	var prev = $(this).attr('data-prev-form');	
	$('.active_business_form').addClass('hidden_business_form');
	$('.active_business_form').removeClass('active_business_form');
	$('[data-form-number="'+prev+'"]').addClass('active_business_form');
	$('[data-form-number="'+prev+'"]').removeClass('hidden_business_form');
	$('html, body').animate({
	    scrollTop: $('.active_business_form').offset().top - 50
	}, 50);
    });
    
    $('.business_form_next').click(function(){
	var next = $(this).attr('data-next-form');	
	$('.active_business_form').addClass('hidden_business_form');
	$('.active_business_form').removeClass('active_business_form');
	$('[data-form-number="'+next+'"]').addClass('active_business_form');
	$('[data-form-number="'+next+'"]').removeClass('hidden_business_form');
	$('html, body').animate({
	    scrollTop: $('.active_business_form').offset().top - 50
	}, 50);
    });
</script>
<?php get_footer(); ?>
