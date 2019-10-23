<?php


$page = $_GET['paged'] ? $_GET['paged'] : 1;
$firstTime = $page == 1;
$display_count = 5;

// After that, calculate the offset
$offset = ( $page - 1 ) * $display_count;

global $fromHomepage;

$fromHomepage = isset( $_GET['fromHomePage']) ? $_GET['fromHomePage'] : $fromHomepage;

$meta = [];

// ZD-6259
//if($fromHomepage){
//  $meta = [[
//      'key' => 'category',
//      'value' => 'pressrelease',
//      'compare' => '!='
//  ]];
//}

if($firstTime){ ?>
    <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-vertical ui-helper-clearfix">
    <ul class="n_content_same_height ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all homepage">
	<?php
}


$args = array(
	'posts_per_page' => $display_count,
	'page' => $page,
	'offset' => $offset,
	'post_type' => array('news'),
	'orderby' => 'date',
	'order' => 'DESC',
	'meta_query' => $meta
);

sd_more_data_aux($args);

if($firstTime){

	?>
    </ul>


    <script type='text/javascript'>
        $(document).ready(function () {


            $(".news_content").on("click","a.news-holder",function () {
                if($( window ).width() <= 768){
                    $( "body").css("overflow","hidden")
                    $("#news-mobile-popup").fadeIn();
                    $(".member_footer").fadeOut();
                    $("#header_scroll").fadeOut();
                    $($(this).attr("href")).show();
                    $("#news-mobile-popup-content").html($($(this).attr("href")).html());
                }else{
                    // lets load appropriate resources
                    $(".section-tab").hide();
                    $(".section-"+$(this).attr("href").replace("#", "")).show();
                    $(window).resize();
                }
            });
        });
    </script>

    </div>

<?php  } ?>