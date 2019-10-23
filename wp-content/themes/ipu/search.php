<?php
/**
 * The template for displaying Search Results pages
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
    $enable_filter_by_category = get_field('enable_filter_by_category', get_the_ID());

    // checking if there is enough types associated with the page
    $allowedResourceTypes = array();
    $allowedResourceTypeKeys = array();
    $resourceTypeMap = new stdClass;

    $autocomplete_posttypes = $SearchAutocomplete->options['autocomplete_posttypes'];

    foreach($autocomplete_posttypes as $resource) {
        $obj = get_post_type_object($resource);

        $res = array(
            'title' => $obj->labels->singular_name,
            'key' => $resource
        );

        array_push($allowedResourceTypes, $res);
        array_push($allowedResourceTypeKeys, $res['key']);
        $resourceTypeMap->{$res['key']} = $res;
    }

    $_GET['term'] = $_GET['s'];

    wp_reset_query();
    wp_reset_postdata();

    ob_start();
    $SearchAutocomplete->acCallbackNew(false);
    $json = ob_get_contents();
    ob_end_clean();
    $searchResult = json_decode($json);

    // building query
    $resultIds = array(1);
    for($i = 0; $i < count($searchResult->results); $i++) {
        $p = $searchResult->results[$i];
        if(isset($p->id)) {
            array_push($resultIds, $p->id);
        }
    }

    $args = array(
        'posts_per_page' => -1,
        'post_type' => $allowedResourceTypeKeys,
        'orderby' => 'date',
        'order' => 'ASC',
        'post__in' => $resultIds
    );

    $query = new WP_Query($args);
?>


<?php
    // calculating different types of types that has been found
    $foundTypes = array();
    $usedTypes = new stdClass;
    $allCategoriesUsed = '';

    $posts = 0;

    // Start the Loop.
    while ( $query->have_posts() ) : $query->the_post();

    $posts++;
        $post_type = get_post_type();

        $cats = ipu_get_custom_field('ipu_categories');

        if($cats != '') {
            if($allCategoriesUsed != '') {
                $allCategoriesUsed .= ',';
            }

            $allCategoriesUsed .= $cats;
        }

        if(!isset($usedTypes->{$post_type})) {
            $resourceType = $resourceTypeMap->{$post_type};

            array_push($foundTypes, $resourceType);
            $usedTypes->{$post_type} = 'used';
        }

    endwhile;

    // getting all taxomonies
    $taxonomyCategories = get_terms(array('ipu_resource_category'), array(
        'orderby' => 'name'
    ));

    $allCategoriesUsedArr = explode(',', $allCategoriesUsed);

    $newTaxonArray = array();

    if(count($allCategoriesUsedArr) > 1 || (count($allCategoriesUsedArr) == 1 && $allCategoriesUsedArr[0] != '')) {
        // filtering taxonomies
        for($i = 0; $i < count($taxonomyCategories); $i++) {
            $taxn = $taxonomyCategories[$i];

            if(in_array($taxn->term_id, $allCategoriesUsedArr)) {
                array_push($newTaxonArray, $taxn);
            }
        }
    }

    $taxonomyCategories = $newTaxonArray;
?>
<article id="content_wrapper" class="cw_results">

        <?php
        //never show filter in the search
        if($enable_filter_by_category[0] == -1) {
            if($posts > 0) { ?>
            <aside class="sidebar sb_filters two_column">

                <div class="sbf_sortgroup">
                    <span class="sbf_title">Sort by</span>
                    <div class="btn_sort_wrapper">
                        <div class="btn_sort_group">
                            <?php include_once 'common/sortby.php'; ?>
                        </div>
                    </div>
                </div>

                <div class="sbf_filtergroup">
                    <span class="sbf_title">Filter by Type</span>
                    <div id="filters" class="" data-group="filter">
                        <div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
                        <?php foreach($foundTypes as $resource) { ?>
                            <div class="sbf_filter" id="filter-<?php echo $resource['key'] ?>"> <input type="checkbox" name="gi_<?php echo $resource['key'] ?>" value=".gi_<?php echo $resource['key'] ?>" id="gi_<?php echo $resource['key'] ?>"><label for="gi_<?php echo $resource['key'] ?>"><?php echo $resource['title'] ?></label></div>
                        <?php } ?>
                    </div>
                 </div>
                <div class="sbf_filtergroup">
                    <?php if(count($taxonomyCategories) > 0) { ?>
                    <span class="sbf_title"><?php echo get_option( 'dropdown_text_name' )?></span>
                    <div id="filters-second" class="" data-group="filter">
                        <div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
                        <?php foreach($taxonomyCategories as $taxon) { ?>
                            <div class="sbf_filter" id="cat_<?php echo $taxon->term_id ?>">
                                <input type="checkbox" name="gi_<?php echo $taxon->term_id ?>" value=".gi_<?php echo $taxon->term_id ?>" id="gi_<?php echo $taxon->term_id ?>"><label for="gi_<?php echo $taxon->term_id ?>"><?php echo $taxon->name ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <?php }
                } ?>
             </div>

        </aside>
        <?php } ?>
        <?php $query = new WP_Query($args); ?>

        <div class="content lp_content <?php echo $posts > 0 ? 'eight_column' : 'full-width' ?>">
                <?php if ( $query->have_posts() ) : ?>

                    <div class="grid_wrapper">
                        <div id="container" class=" grid_post">
                        <?php
                            // Start the Loop.
                            while ( $query->have_posts() ) : $query->the_post();
                                /*
                                 * Include the post format-specific template for the content. If you want to
                                 * use this in a child theme, then include a file called called content-___.php
                                 * (where ___ is the post format) and that will be used instead.
                                 */
                                //get_template_part( 'content', get_post_format() );

                                $fields = get_fields();
                                $title = $fields["title"];
                                $shortDesc = $fields["short_description"];
                                $attachment_id = get_field('upload_file');
                                $viewFile = wp_get_attachment_url($attachment_id);
                                $post_type = get_post_type();
                                $date = get_the_date();

                                $categorytxtList = ipu_get_custom_field('ipu_categories');

                                $giCategoryList = explode(',',$categorytxtList);
                                $giCatClasses = implode(' gi_', $giCategoryList);
                                $giCatClasses = 'gi_'.$giCatClasses;
                            ?>

                            <?php include(get_query_template('loop-'.$post_type));

                            ?>

                                <script type='text/javascript'>
                                    <?php if($post_type): ?>
                                        var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

                                        var s<?= $post_type; ?> = $('<span />',{
                                            class:'<?= $post_type; ?> sbf_filter_counter' ,
                                            html: n<?= $post_type; ?>
                                        });

                                        $('#filter-<?= $post_type; ?>').find('.sbf_filter_counter').remove();
                                        s<?= $post_type; ?>.appendTo('#filter-<?= $post_type; ?>');
                                    <?php endif; ?>
                                </script>


                                <script type='text/javascript'>
                                    <?php if($giCategoryList) {
                                        foreach($giCategoryList as $category) {
                                            ?>
                                                var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;

                                                var s<?= $category; ?> = $('<span />',{
                                                    class:'<?= $category; ?> sbf_filter_counter' ,
                                                    html: n<?= $category; ?>
                                                });

                                                $('#cat_<?= $category; ?>').find('.sbf_filter_counter').remove();
                                                s<?= $category; ?>.appendTo('#cat_<?= $category; ?>');
                                            <?php
                                        }
                                        ?>
                                    <?php } ?>
                                </script>
                            <?php

                            endwhile;
                        ?>
                        </div>
                    </div>
                    <?php
                    else :
                        // If no content, include the "No posts found" template.
                        include('search-no-results.php');
                    endif;
                ?>
        </div>
    </article>

<?php
get_sidebar( 'content' );
//get_sidebar();
get_footer();
