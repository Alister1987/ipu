<?php
/**
 * Created by PhpStorm.
 * User: wojciech
 * Date: 04/04/2017
 * Time: 17:44
 */
if (!function_exists('sd_your_location_prompt')){

    function sd_your_location_prompt(){
?>

        <?php if(!isset($_COOKIE['location_asked'])) : ?>

            <section id="location-prompt" class="f_legal_sticky">
                <div class="logo_wrapper">
                    <a href="<?= is_home(); ?>">
                        <img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header_white.svg" alt="IPU" class="logo_header" />
                    </a>
                </div>
                <div class="f_legal_links">
                    <ul>
                        <span class="location-text">Please enable your GPS for a more accurate position.</span>
                    </ul>
                </div>
                    <a data-scroll href="#header"><div class="f_btn_top"></div></a>
            </section>

            <!-- store locator location prompt cookie -->
            <script src="<?php bloginfo('template_directory'); ?>/js/js/js-cookie.js"></script>
            <script>
                $(window).load(function() {
                    $('#main.20869').css('z-index','initial');
                    $('.f_btn_top').on('click', function(){
                        $('#location-prompt').remove();
                        Cookies.set('location_asked', true);
                        console.log(Cookies.get('location_asked'));
                    });
                });
            </script>

        <?php endif;?>

<?php

    }

    add_shortcode( 'location_prompt', 'sd_your_location_prompt' );

}