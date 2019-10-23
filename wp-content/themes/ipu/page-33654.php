<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
get_header();
?>

<article id="content_wrapper" class="">

		<aside class="sidebar two_column sb_mk_about">
			<div class="sb_wrapper sb_wrapper_stickit">
			</div>
		</aside>




		<div class="content eight_column">
			<section class="payment_wrapper form_application_wrapper content_same_heightx" style="height: 100% !important;">

					<?= do_shortcode('[contact-form-7 id="33653" html_id="payment_form" title="Student Membership apply form"]'); ?>

			</section>

			<section class="payment_right_sidebar content_same_heightx" style="height: 1800px;">

			</section>



		</div>
	</article>



<?php
get_footer();
