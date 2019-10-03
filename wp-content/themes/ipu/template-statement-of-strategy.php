<?php
/**
 * Template Name: Statement of Strategy
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<?php
$post_type = get_post_type();

$fields = get_fields();

$shortDesc = get_field('short_description', 830);
$id = get_the_ID();
?>


<article id="content_wrapper" class="page-<?= $id; ?>">
    <?php
    /**
     * Left column
     * */
    ?>
    <aside class="sidebar sb_news">
        <?php
        while (have_posts()) : the_post();
            $fields = get_fields();
            $shortDesc = $fields["short_description"];
            ?>
            <div class="sb_wrapper sb_wrapper_stickit">
                <div class="sb_title">
                    <h2><?= get_the_title(); ?></h2>
                </div>
                <div class="sb_txt"><?= $shortDesc; ?></div>
                <div class="sb_btn">
                    <a href="<?= $fields['statement_of_strategy_file']?>" target="_blank" class="btn btn_green download_btn">Download</a>
                </div>
            </div>
            <div id="welcomeDiv" style="display:none;" class="answer_list"> WELCOME</div>
        <?php endwhile; ?>


    </aside>

    <div class="content lp_content  eight_column">
        <section>
            <div class="si_section_content">

                <div class="row strategy_menu_container">
                    <?php wp_nav_menu(array('menu' => 'Statement of Strategy', 'menu_class' => 'strategy_menu')); ?>
                    <div class="strategy_menu_subtitle">
                        <h1>Strategic Objectives</h1>
                    </div>
                </div>
                <!--presidents block-->
                <div class="row presidents_statement_container">
                    <h1><?= $fields["presidents_statement_title"] ?></h1>
                    <div class="statement">
                        <div class="snippet"><?= $fields["presidents_statement_snippet"] ?></div>
                        <div class="full_text"><?= $fields["presidents_statement_text"] ?></div>
                    </div>
                    <div class="cta">
                           <span class="btn btn_action_go read_more ">
                                <i class="more"> Read more</i>
                                <i class="less" id=""> Read less</i>
                            </span>
                    </div>
                    <div class="main_image_holder"
                         style="background-image:url('<?= $fields["presidents_statement_image"] ?>');">
                        <img class="hidden" src="<?= $fields["presidents_statement_image"] ?>" alt="">
                    </div>
                </div>

                <!--blocks repeater-->
                <?php
                $i = 0;
                foreach ($fields['blocks_repeater'] as $block) {
                    $i++;
                    if (strpos($block['block_style'], '_half')) {
                        // has half

                        if ($i % 2 == 0) { ?>
                            <div class="block_container right_side_block <?= $block['block_style']; ?>"
                                 id="<?= strtolower($block['block_title']) ?>">
                                <div class="text-body">
                                    <div class="title">
                                        <h1> <?= $block['block_title'] ?></h1>
                                    </div>
                                    <div class="statement">
                                        <div class="snippet">
                                            <?= $block['block_snippet'] ?>
                                        </div>
                                        <div class="full_text">
                                            <?= $block['block_text'] ?>
                                        </div>
                                    </div>
                                    <div class="cta">
                                             <span class="btn btn_action_go read_more ">
                                           <i class="more"> Read more</i>
                                             <i class="less"> Read less</i>
                                        </span>
                                        <div class="back_to_top">
                                            <span class="up_icon"></span>
                                            <span class="back_text">Back to top</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="main_image_holder <?= $block['icon_or_image'] ?>" style="background-image:url('<?= $block['block_image'] ?>');">
                                    <img src="<?= $block['block_image'] ?>" alt="">
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="block_container left_side_block <?= $block['block_style']; ?>"
                                 id="<?= strtolower($block['block_title']) ?>">
                                <div class="main_image_holder <?= $block['icon_or_image'] ?>"
                                     style="background-image:url('<?= $block['block_image'] ?>');">
                                    <img class="hidden" src="<?= $block['block_image'] ?>" alt="">
                                </div>
                                <div class="text-body">
                                    <div class="title">
                                        <h1> <?= $block['block_title'] ?></h1>
                                    </div>
                                    <div class="statement">
                                        <div class="snippet">
                                            <?= $block['block_snippet'] ?>
                                        </div>
                                        <div class=" full_text">
                                            <?= $block['block_text'] ?>
                                        </div>
                                    </div>
                                    <div class="cta">
                                            <span class="btn btn_action_go read_more ">
                                           <i class="more"> Read more</i>
                                             <i class="less"> Read less</i>
                                        </span>
                                        <div class="back_to_top">
                                            <span class="up_icon"></span>
                                            <span class="back_text">Back to top</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="block_container <?= $block['block_style']; ?>"
                             id="<?= strtolower($block['block_title']) ?>">
                            <div class="text-body">
                                <div class="title">
                                    <h1> <?= $block['block_title'] ?></h1>
                                </div>
                                <div class="statement">
                                    <div class="snippet">
                                        <?= $block['block_snippet'] ?>
                                    </div>
                                    <div class=" full_text">
                                        <?= $block['block_text'] ?>
                                    </div>
                                </div>
                                <div class="cta">
                                        <span class="btn btn_action_go read_more ">
                                           <i class="more"> Read more</i>
                                             <i class="less"> Read less</i>
                                        </span>
                                </div>
                            </div>
                            <?php if(!empty($block['block_image'])) { ?>
                            <div class="main_image_holder <?= $block['icon_or_image'] ?>" style="background-image:url('<?= $block['block_image'] ?>');">
                                <img class="hidden" src="<?= $block['block_image'] ?>" alt="">
                            </div>
                            <?php } ?>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </section>


    </div>
</article>


<?php
//get_sidebar();
get_footer();
?>

<script type="text/javascript">
    (function ($) {
        $('.title_wrapper .title h1').text('<?php echo get_the_title();  ?>');
        $('.title h1').show();

        $(document).on('click', '.cta .read_more', function () {
            $(this).toggleClass('open');
            $(this).parent().parent().parent().find('.main_image_holder').toggleClass('opened');
            $(this).parent().parent().find('.statement .full_text').slideToggle("medium", function(){
                if ($(this).is(':hidden')) {
                    $('html, body').animate({
                        scrollTop: $( $(this).parent() ).offset().top - 200
                    }, 500);
                    return false;
                } else {

                }
            });

        });

        $(document).on('click', '.cta .back_to_top', function () {
            $('html, body').animate({
                scrollTop: $( '#menu-statement-of-strategy' ).offset().top - 52
            }, 500);
            return false;
        });


        $('.strategy_menu a[href*=#]').click(function(){
            $('html, body').animate({
                scrollTop: $( $.attr(this, 'href') ).offset().top - 200
            }, 500);
            return false;
        });
    })(jQuery)

</script>
