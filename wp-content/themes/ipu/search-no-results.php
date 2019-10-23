<?php
/**
 * The template for displaying No Search Results page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<style>
/* End: Recommended Isotope styles */

.option-set li{color: black; float:left; display:inline; padding: 15px}
.option-set li a{color: black;  margin-right: 20px; font-size: 14px}

#filters .sbf_filter input,
#filters-second .sbf_filter input{
    display: none;
}
#filters .sbf_filter label,
#filters-second .sbf_filter input{
    padding: 10px 161px 10px 0px;
}

</style>

<?php
    $search = get_search_query();
    $count = 0;

    $args = array(
        'posts_per_page' => -1,
        'post_type' => 'news',
        'orderby' => 'date',
        'order' => 'ASC',
    );

    $query = new WP_Query($args);

?>

<article id="content_wrapper" class="cw_results">

        <div class="content lp_content full-width">
            <?php if ($query->have_posts()) {  ?>

            <div class="grid_wrapper">
            <h3>Sorry, no results were found for
                <b>
                    <?php echo $search ?>
                </b>
            </h3>
            <?php
            }
            ?>
                </div>
            </div>
        </div>
    </article>

<?php
get_sidebar( 'content' );
get_footer();
?>
