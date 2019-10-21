<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
</div><!-- #main -->
<?php
if (is_user_logged_in()) { ?>
<footer class="member_footer">
	<?php } else { ?>
    <footer class="mk_footer">
		<?php } ?>

		<?php
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'adcampaign',
			'orderby' => 'rand',
		);
		?>
		<?php
		
		attach_s2member_query_filters();
		query_posts($args);
		if (have_posts()):
			while (have_posts()):
			the_post();
			# Protected content will be excluded automatically.
			# (based on the current User's Role/Capabilities)
			$fields = get_fields();
			//update
			$defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);
			$logo_url = $fields["logo"];
			$logo = wp_get_attachment_image_src($logo_url, 'medium', true);

			$logo_subtitle = $fields["subtitle_of_the_logo"];

			$bgimage_url = $fields["bg_image"];
			$bgimage = wp_get_attachment_image_src($bgimage_url, 'high', true);
			$title = $fields["title"];
			$subtitle = $fields["subtitle"];
			/*
			?>
            <section id="f_cta_picture" style="background-image: url('<?=$bgimage[0];?>');">
                <div class="f_overlay">
                    <div class="f_ad_wrapper">
                        <div class="f_ad_member">
                            <div class="logo_wrapper">
								<?php if($defaultPicture[0] != $logo[0]){ ?>
                                    <img src="<?=$logo[0]?>" alt="IPU" class="logo_header">
								<?php }else{?>
                                    <img src="<?php bloginfo('template_directory'); ?>/img/logo_big_white.svg" alt="IPU" class="logo_header">
								<?php } ?>
                            </div>
                            <span><?=$logo_subtitle;?></span>
                        </div>
                        <div class="f_ad_content">
                            <span class="f_ad_title"><?=$title;?></span>
                            <span class="f_ad_txt"><?=$subtitle;?></span>
							<?php
							if (have_rows('cta_button')):
								while (have_rows('cta_button')) : the_row();
									$label = get_sub_field('label');
									$link = get_sub_field('link');
									?>
                                    <a href="<?=$link;?>" class="btn" title='<?=$label;?>'><?=$label;?></a>
									<?php
								endwhile;
							endif;
							?>
                        </div>
                    </div>
                </div>
            </section>
		<?php
      */
		   endwhile; 
        endif; // if have_posts()
        wp_reset_query();
		wp_reset_postdata();
		/*
		?>
        <section id="f_contact">
            <div class="f_contact_wrapper">
                <div class="f_contact_title">
                    Contact us
                </div>
                <div class="f_contact_adress">
                    <p>Butterfield House<br>
                        Butterfield Avenue<br>
                        Rathfarnham<br>
                        Dublin 14<br>
                        Ireland</p>
                </div>
                <div class="f_contact_contact">
                    <p>Telephone: +353 1 493 6401<br>
                        Fax: +353 1 493 6407<br>
                        Email: info@ipu.ie</p>
                </div>
            </div>
            <div class="f_contact_social_wrapper">
                <div class="f_contact_title">
                    Follow us
                </div>
                <div class="f_contact_social">
                    <ul>
                        <li class="f_social_tw"><a href="https://twitter.com/IrishPharmacy" target="_blank">Twitter</a></li>
                        <li class="f_social_fb"><a href="https://www.facebook.com/pages/Irish-Pharmacy-Union/190125277735753?ref=hl" target="_blank">Facebook</a></li>
                        <li class="f_social_in"><a href="https://www.linkedin.com/company/irish-pharmacy-union" target="_blank">Linkedin</a></li>
                        <li class="f_social_yt"><a href="https://www.youtube.com/channel/UCEAXkjagTN9LksMPywijN1w" target="_blank">Youtube</a></li>
                    </ul>
                </div>
            </div>
        </section>
		<?php
    */
		/***************
		// registered user footer
		 ***************/
		if (is_user_logged_in()) { ?>
            <section id="f_sitemap">
                <div class="f_sitemap_quicklinks">
                    <span>Quick links</span>
                    <ul>
						<?php
						if (get_field('quick_links')):
							while (have_rows('quick_links')) : the_row();
								$title = get_sub_field('title');
								$seo_title = get_sub_field('seo_title');
								$link = get_sub_field('link');
								?>
                                <li><a href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a></li>
								<?php
							endwhile;

							wp_reset_query();
							wp_reset_postdata();

						endif;
						?>
                    </ul>
                </div>
                <div class="<?php if(is_user_logged_in()) { ?> hide_it <?php } else { ?> f_sitemap_full <?php } ?>">
					<?php wp_nav_menu(array('menu' => 'main-menu-mobile', 'exclude' => '1200, 82')); ?>
                </div>
            </section>

            <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/coockie.js"></script>

		<?php


        if(get_option("popup_show") == "on" && !isset($_COOKIE["popup-id-". get_option("popup_id")])){ ?>

            <section id="popup-container">
                <div class="popup">
                    <div class="img-container">
                        <img src="<?php echo wp_get_attachment_url( get_option( 'popup_image' ) ) ?>"/>
                    </div>
                    <div class="text-container">
                        <p class="title"><?php echo get_option("popup_title")?></p>
                        <p class="description"><?php echo get_option("popup_text")?></p>
                        <div class="button-container">
                            <span class="link-container">
                                <a class="link" href="<?php echo get_option("popup_btn_link")?>" target="_blank">
									<?php echo get_option("popup_btn_text")?>
                                </a>
                            </span>
                            <a id="never" href="#">
                                Never show this message again
                            </a>
                        </div>
                    </div>
                    <div class="close"></div>
                </div>

            </section>

            <script>


                $(".close").click(function(){
                    $("#popup-container").fadeOut();
                    $("html").css("overflow","auto");

                });

                $("#never,.link").click(function(){
                    Cookies.set('popup-id-<?php echo get_option("popup_id")?>', '1',{ expires: 365 });
                    $("#popup-container").fadeOut();
                    $("html").css("overflow","auto");
                });


                setTimeout(function () {
                    $("#popup-container").fadeIn();
                    $(".popup").css("margin-top", ($("#popup-container").height() - $(".popup").outerHeight()) / 2 );
                    $("html").css("overflow","hidden");

                },1000);



            </script>

		<?php }?>

		<?php } else {
		/***************
		//non registered user footer
		 ***************/
		?>
            <section id="f_sitemap">
                <div class="f_sitemap_quicklinks">
                    <span>Quick links</span>
                    <ul>
						<?php
						if (get_field('quick_links')):
							while (have_rows('quick_links')) : the_row();
								$title = get_sub_field('title');
								$seo_title = get_sub_field('seo_title');
								$link = get_sub_field('link');
								?>
                                <li><a href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a></li>
								<?php
							endwhile;

							wp_reset_query();
							wp_reset_postdata();

						endif;
						?>
                    </ul>
                </div>
                <div class="f_sitemap_full">
					<?php wp_nav_menu(array('menu' => '29')); ?>
                </div>
            </section>


		<?php } ?>
        <section id="f_legal_wrapper">
            <div class="logo_wrapper">
                <a href="<?= is_home(); ?>">
                    <img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header_white.svg" alt="IPU" class="logo_header" />
                </a>
            </div>
            <div class="f_legal_copyright">
                <i>© Copyright <?php echo date("Y"); ?> IPU</i>
            </div>
            <div class="f_legal_links">
                <ul>
                    <li><a href="<?= get_permalink(4017);?>" title='Privacy Policy'>Privacy Policy</a></li>
                    <li><a href="<?= get_permalink(4015);?>" title='Terms & Conditions'>Terms & Conditions</a></li>
                    <li><a href="//www.lightbox.ie" title='Development & Design by Lightbox Digital'>Development & Design by Lightbox Digital</a></li>
                </ul>
            </div>
			<?php
			if (is_user_logged_in()) { ?>
                <a data-scroll href="#header"><div class="f_btn_top"></div></a>
			<?php } else { ?>
                <a data-scroll href="#mk_home_header"><div class="f_btn_top"></div></a>
			<?php } ?>
        </section>
    </footer>

    <!-- scroll smoothly to an anchor -->
    <script src='<?php bloginfo('template_directory'); ?>/js/smooth-scroll.js'></script>
    <script>
        smoothScroll.init();
    </script>
    </div><!-- #page -->
    <!-- scripts concatenated and minified via build script -->

    <!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/selectivizr.js"></script>
    <noscript><link rel="stylesheet" href="[fallback css]" /></noscript>
    <![endif]-->

    <!-- Prompt IE 6 users to install Chrome Frame -->
    <!--[if lt IE 7 ]>
    <script defer src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script defer>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
    <![endif]-->
	<?php if(is_page(89)){?> <?php } ?>
    <!--<script src='http://vnjs.net/www/project/freewall/example/js/jquery-1.10.2.min.js'></script>-->
    <!--<script src='<?php bloginfo('template_directory'); ?>/js/jquery.isotope.js'></script>-->

    <script src='<?php bloginfo('template_directory'); ?>/js/isotope.pkgd.js'></script>
    <!--<script src='<?php bloginfo('template_directory'); ?>/js/layout-modes.js'></script>-->

    <script src="<?php bloginfo('template_directory'); ?>/js/unslider.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>


	<?php if (is_page(832)){ ?>
        <script>
            $('.slider_event').each(function(){
                var $slider = $(this).unslider(
                    {
                        speed: 1000,               //  The speed to animate each slide (in milliseconds)
                        delay: 5000,              //  The delay between slide animations (in milliseconds)
                        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                        dots: false,               //  Display dot navigation
                        fluid: false              //  Support responsive design. May break non-responsive designs
                    }
                );
                $(this).find('.unslider-arrow').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('next')) {
                        $slider.data('unslider')['next']();
                    } else {
                        $slider.data('unslider')['prev']();
                    };
                });
            });

        </script>
	<?php } ?>

	<?php if (is_page(745)){ ?>
        <script>
            $('.slider_event').each(function(){
                var $slider = $(this).unslider(
                    {
                        speed: 1000,               //  The speed to animate each slide (in milliseconds)
                        delay: 5000,              //  The delay between slide animations (in milliseconds)
                        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                        dots: false,               //  Display dot navigation
                        fluid: false              //  Support responsive design. May break non-responsive designs
                    }
                );
                $(this).find('.unslider-arrow').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('next')) {
                        $slider.data('unslider')['next']();
                    } else {
                        $slider.data('unslider')['prev']();
                    };
                });
            });

        </script>
	<?php } ?>


	<?php if (is_page(1200)){ ?>
        <script>
            $('.slider_mk_home').each(function(){
                var $slider = $(this).unslider(
                    {
                        speed: 1000,               //  The speed to animate each slide (in milliseconds)
                        delay: 5000,              //  The delay between slide animations (in milliseconds)
                        keys: true,               //  Enable keyboard (left, right) arrow shortcuts
                        dots: false,               //  Display dot navigation
                        fluid: false              //  Support responsive design. May break non-responsive designs
                    }
                );
                $(this).find('.unslider-arrow').click(function(event){
                    event.preventDefault();
                    if ($(this).hasClass('next')) {
                        $slider.data('unslider')['next']();
                    } else {
                        $slider.data('unslider')['prev']();
                    };
                });
            });
        </script>
	<?php } ?>
    <script>
        $('body.page-id-1200').removeClass('grid');
        //		var checkCount = $('.sbf_filter').find('span');
        //
        //		if(checkCount.hasClass('sbf_filter_counter')){
        //			console.log('value');d
        //
        //		}else{
        //			console.log('missing value');
        //			$(this).addClass('novalue');
        //		}

        //remove empty "p"
        $('.si_descr .sia_txt_section p:empty').remove();
        $('.si_descr .sia_txt_section p').filter(function(){ return $.trim(this.innerHTML)==="&nbsp;" }).remove();
    </script>

	<?php if (is_page(832)) { ?>
        <script src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox.js"></script>
        <script>
            $(document).ready(function(){
                $(".btn_play").colorbox({iframe:true, innerWidth:640, innerHeight:390, transition:"fade"});
            });

            $(window).load(function() {
                equalheight('.g_item_equal');
            });

            $(window).resize(function(){
                equalheight('.g_item_equal');
            });


        </script>
	<?php } ?>

    <!--Google tracking-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-5121888-1', 'auto');
        ga('send', 'pageview');

    </script>

	<?php wp_footer(); ?>
</body>
    </html>