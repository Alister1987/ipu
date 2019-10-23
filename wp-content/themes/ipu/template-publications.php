<?php
/**
Template Name: IPU Publications Page
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<style>
/* End: Recommended Isotope styles */

.option-set li{color: black; float:left; display:inline; padding: 15px}
.option-set li a{color: black;  margin-right: 20px; font-size: 14px}

#filters .sbf_filter input{
    display: none;
}
#filters .sbf_filter label{
    padding: 10px 161px 10px 0px;
}

.bulletx{

background: transparent;
width: 15px;
height: 15px;
float: left;
left: 0px;
position: absolute;

}

.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_name{
    border: none;
background: transparent;
}



</style>
<article id="content_wrapper">
<?php

    /**********************************************************************************************************************************************************************
     *
    ***********************************************************************  Left content  ********************************************************************************
     *
    **********************************************************************************************************************************************************************/
    $enable_filter_by_category = get_field('enable_filter_by_category', get_the_ID());

?>
    <?php //the_breadcrumb();

    //getting filtering type
    $meta = get_post_meta(get_the_ID(), 'ipu_filter_by');

    $filterBy = 'type';
    $taxonomyCategories = array();

    // lets make sure that there is enough categories to filter by
    $taxonomyCategories = get_the_terms(get_the_ID(), 'ipu_resource_category');
    $taxonomyFolderCategories = get_the_terms(get_the_ID(), 'ipu_resource_folder_category');

    $ipuCat = get_query_var( 'ipu_cat', '');
    $ipuFolder = get_query_var( 'ipu_folder', '');
    $isCatFound = $ipuCat != '';
    $isFolderFound = $ipuFolder != '';

    $foundTaxonomy = '';
    $foundTaxonomyFolder = '';

    if($isCatFound) {
        foreach($taxonomyCategories as $taxCat) {
             $n = str_replace(' ' , '_', strtolower($taxCat->name));
             $n = str_replace('&amp;','_',strtolower($n));
             $n = str_replace('&','_',strtolower($n));
             $n = str_replace(')','',strtolower($n));
             $n = str_replace('(','',strtolower($n));
             $n = str_replace("'", '', $n);
             $n = preg_replace('!\s+!', ' ', $n);
             $n = preg_replace('!_+!', '_', $n);
            if($n == $ipuCat) {
                $foundTaxonomy = $taxCat;
                break;
            }
        }
    }

    if($isFolderFound) {
        foreach($taxonomyFolderCategories as $taxCat) {
             $n = str_replace(' ' , '_', strtolower($taxCat->name));
             $n = str_replace('&amp;','_',strtolower($n));
             $n = str_replace('&','_',strtolower($n));
             $n = str_replace(')','',strtolower($n));
             $n = str_replace('(','',strtolower($n));
             $n = str_replace("'", '', $n);
             $n = preg_replace('!\s+!', ' ', $n);
             $n = preg_replace('!_+!', '_', $n);
            if($n == $ipuFolder) {
                $foundTaxonomyFolder = $taxCat;
                break;
            }
        }
    }

    $isCatFound = $foundTaxonomy != '';
    $isFolderFound = $foundTaxonomyFolder != '';

    ?>

<aside class="sidebar sb_filters two_column">
    <?php
    $shortDesc = get_field('short_description', get_the_ID());
    ?>
    <?php if (!empty($shortDesc) && !$isCatFound) { ?>
        <div class="sb_txt"><?= $shortDesc; ?></div>
    <?php } ?>
    <?php
    if(!$isCatFound) {
        $sidebarFiles = get_field('sidebar_files', get_the_ID());
        foreach($sidebarFiles as $f) {
            ?>
            <h3><?php echo $f['title'] ?></h3>
            <div class="sb_txt"><?php echo $f['content'] ?>
                <a href="<?php echo $f['file'] ?>" target="_blank" class="btn btn_action_dowload_purple">Download</a>
            </div>
            <?php
        }
    }
    ?>
    <?php
    // checking if there is enough types associated with the page
    $IPUAllowedResources = getIPUAllowedResources();
    $allowedResourceTypes = array();
    $allowedResourceTypeKeys = array();

    foreach ($IPUAllowedResources as $resource) {
        $resourceValue = ipu_get_custom_field('ipu_allowed_resource_' . $resource['key']);
        if ($resourceValue == 'yes') {
            array_push($allowedResourceTypes, $resource);
            array_push($allowedResourceTypeKeys, $resource['key']);
        }
    }



     $currentPage = 1;
     $args = array(
         'posts_per_page' => 50,
         'post_type' => $allowedResourceTypeKeys,
         'paged' => $currentPage,
         'orderby' => 'meta_value meta_value_num',
         'meta_key' => 'priority',
         'order' => 'ASC',
         'meta_query' => array(
             'relation' => 'OR',
             array(
                 'relation' => 'AND',
                 array(
                     'key' => 'ipu_page',
                     'value' => get_the_ID(),
                     'compare' => '='
                 ),
                 array(
                     'key' => 'ipu_section',
                     'value' => wp_get_post_parent_id(get_the_ID()),
                     'compare' => '='
                 )
             ),
             array(
                 'relation' => 'AND',
                 array(
                     'key' => 'ipu_page_add',
                     'value' => get_the_ID(),
                     'compare' => 'LIKE'
                 ),
                 array(
                     'key' => 'ipu_section_add',
                     'value' => wp_get_post_parent_id(get_the_ID()),
                     'compare' => 'LIKE'
                 )
             )
         )
     );

     $queryItems = array();

    if($foundTaxonomy) {
        $morePages = true;
        $filteredList = array();

        while($morePages) {
            $query = new WP_Query($args);
            $foundItems = $query->have_posts();
            while ($query->have_posts()) :
                $query->the_post();

                $queryItems[] = $post;

                $categorytxtList = ipu_get_custom_field('ipu_categories');
                $giCategoryList = explode(',',$categorytxtList);

                // verifying that only selected category resources are displayed
                if(array_search($foundTaxonomy->term_id, $giCategoryList) === false) {
                    continue;
                }

                $categoryfolderstxtList = ipu_get_custom_field('ipu_folders');
                $giCategoryFolderList = explode(',',$categoryfolderstxtList);

                foreach($taxonomyFolderCategories as $key => $value) {
                    // verifying that only selected category resources are displayed
                    if(array_search($value->term_id, $giCategoryFolderList) === false) {
                        $categoryfolderstxtList = ipu_get_custom_field('ipu_folders_add');
                        $giCategoryFolderList = explode(',',$categoryfolderstxtList);

                        foreach($taxonomyFolderCategories as $key2 => $value2) {
                            // verifying that only selected category resources are displayed
                            if(array_search($value2->term_id, $giCategoryFolderList) === false) {
                                continue;
                            }

                            $filteredList[$value2->term_id] = $value2;
                        }

                        continue;
                    }

                    $filteredList[$value->term_id] = $value;
                }
            endwhile;

            if(!$foundItems) {
                $morePages = false;
            }
            $currentPage++;
            $args['paged'] = $currentPage;

            wp_reset_query();
            wp_reset_postdata();

        }

        $taxonomyFolderCategories = array();

        foreach($filteredList as $key => $value) {
            $taxonomyFolderCategories[] = $value;
        }

    }
    // checking if filter is available
    if ($filterBy == 'type' && count($allowedResourceTypes) == 0) {
        $filterBy = '';
    }
    ?>

    <?php
        if($enable_filter_by_category[0] == 1) {
        if($isCatFound) { ?>
            <div class="sb_txt">
                Select a category from the dropdown below:
                <div class="select_wrapper_sidebar">
                    <form name="cat" action="<?= get_permalink();?>" method="get">
                        <div class="select_wrapper select_wrapper_green">
                            <select class='sopfilter' id='filters-demo' data-filter-group="filter-cat" name='cat'>
                                <?php
                                    $taxonomyCat = get_the_terms(get_the_ID(), 'ipu_resource_category');
                                    foreach ($taxonomyCat as $cat) {
                                ?>
                                    <option <?php echo $foundTaxonomy->term_id == $cat->term_id ? 'selected' : '' ?> data-filter=".gi_<?= $cat->term_id; ?>" id="<?= $cat->term_id; ?>" value="<?= $cat->name; ?>"><?= $cat->name; ?></option>
                                <?php
                                        $catName = $cat->name;
                                        $catid = $cat->term_id;
                                    }
                                ?>
                            </select>
                        </div>
                    </form>

                    <script>
                        $(document).ready(function(){
                            $('.sopfilter').change(function () {
                                var cat = $(".sopfilter").first().val();
                                var cat = cat.replace(/ /g, "_").toLowerCase();
                                var cat = cat.replace(/[`~!@#$£%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '_');
                                var cat = cat.replace(/["'()]/g,"_");
                                var cat = cat.replace(/&/g, "_");
                                var cat = cat.replace(/_+/g, "_").toLowerCase();


                                if(cat != ''){
                                     window.location="<?= home_url(); ?>/communications/publications/" + cat;
                                }
                            });
                        });
                    </script>
                </div>
            </div>

            <?php if(count($taxonomyFolderCategories) > 0) {
            ?>
                <div class="sb_txt">
                    Select a folder from the dropdown below:
                    <div class="select_wrapper_sidebar">
                        <form name="folder" action="<?= get_permalink();?>" method="get">
                            <div class="select_wrapper select_wrapper_outline_green">
                                <select class='sopfolder' data-filter-group="filter-folder" name='folder'>
                                    <option value=''>Select Folder</option>
                                    <?php
                                        $taxonomyCat = $taxonomyFolderCategories;
                                        foreach ($taxonomyCat as $cat) {
                                    ?>
                                        <option <?php echo $foundTaxonomyFolder && $foundTaxonomyFolder->term_id == $cat->term_id ? 'selected' : '' ?> data-filter=".gi_<?= $cat->term_id; ?>" id="<?= $cat->term_id; ?>" value="<?= $cat->name; ?>"><?= $cat->name; ?></option>
                                    <?php
                                            $catName = $cat->name;
                                            $catid = $cat->term_id;
                                        }
                                    ?>
                                </select>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function(){
                                $('.sopfolder').change(function () {
                                    var cat = $(".sopfilter").first().val();
                                    var cat = cat.replace(/ /g, "_").toLowerCase();
                                    var cat = cat.replace(/[`~!@#$£%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '_');
                                    var cat = cat.replace(/["'()]/g,"_");
                                    var cat = cat.replace(/&/g, "_");
                                    var cat = cat.replace(/_+/g, "_").toLowerCase();



                                    var folder = $(this).first().val();
                                    var folder = folder.replace(/ /g, "_").toLowerCase();
                                    var folder = folder.replace(/[`~!@#$£%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '_');
                                    var folder = folder.replace(/["'()]/g,"_");
                                    var folder = folder.replace(/&/g, "_");
                                    var folder = folder.replace(/_+/g, "_").toLowerCase();

                                    if(folder != ''){
                                         window.location="<?= home_url(); ?>/communications/publications/" + cat + "/" + folder;
                                    } else {
                                        window.location="<?= home_url(); ?>/communications/publications/" + cat;
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            <?php
            } ?>

            <?php if ($filterBy != '') { ?>
                <?php if ($filterBy == 'type') { ?>
                    <div class='sbf_filtergroup' id='filters-demo-type' data-filter-group="filter-type">
                        <span class="sbf_title">Filter by Type</span>

                        <div class="select_wrapper_sidebar">
                            <form name="cat" action="<?= get_permalink();?>" method="get">
                                <div class="select_wrapper select_wrapper_outline">
                                    <select class='cmbsopfilterby' id='filters-demo' data-filter-group="filter-cat" name='cat'>
                                        <option value=''>All</option>
                                        <?php
                                            foreach ($allowedResourceTypes as $resource) {
                                        ?>
                                            <option value="<?= $resource['key']; ?>"><?= $resource['title']; ?></option>
                                        <?php
                                                $catName = $cat->name;
                                                $catid = $cat->term_id;
                                            }
                                        ?>
                                    </select>
                                </div>
                            </form>

                            <script>
                                $(document).ready(function(){
                                    $('.cmbsopfilterby').change(function () {
                                        var cat = $(this).val();

                                        $(".sbf_filter button[data-filter='"+(cat == '' ? '' : '.gi_' + cat)+"']").click();
                                    });
                                });
                            </script>
                        </div>

                        <div  class="sbf_filter sbf_filter_active" style="display: none" >
                            <button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All</button>
                        </div>
                        <?php foreach ($allowedResourceTypes as $resource) { ?>
                            <div  class="sbf_filter" style="display: none" >
                                <button data-filter=".gi_<?php echo $resource['key'] ?>" id="<?php echo $resource['key'] ?>" class='sbf_filter_name'>
                                    <span class='bullet'></span>
                                        <?php echo $resource['title'] ?>
                                    <span class='sbf_filter_counter'></span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>


                    <div class='sbf_filtergroup' id='filters-demo' data-filter-group="filter-cat">
                        <span class="sbf_title"><?php echo get_option( 'dropdown_text_name' )?></span>
                        <div  class="sbf_filter sbf_filter_active" >
                            <button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All</button>
                        </div>
                        <?php foreach ($taxonomyCategories as $taxon) { ?>
                            <div  class="sbf_filter" >
                                <button data-filter=".gi_<?php echo $taxon->term_id ?>" id="cat_<?php echo $taxon->term_id ?>" class='sbf_filter_name'>
                                    <span class='bullet'></span>
                                        <?php echo $taxon->name ?>
                                    <span class='sbf_filter_counter'></span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php }
        } ?>
</aside>
<?php

/**********************************************************************************************************************************************************************
 *
***********************************************************************  Right content  *******************************************************************************
 *
**********************************************************************************************************************************************************************/

?>
<div class="content lp_content eight_column lp_sop_landing">
<?php
    $page_id = get_the_ID(); ?>
<?php
while (have_posts()) : the_post();

    $select_title = get_field('select_title');
    $select_text = get_field('select_text');

?>

<?php //ipu review & anual reports ?>



    <section class="furst_publication">
        <div class="box_wrapper box_w_turquoise box_review">
            <div class="box_inside">
                <div class="ipu_review_logo"></div>
                    <div class="box_content">
                        <?php echo the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section ="furst_publication">
        <div class="lp_sop_landing">
                <?php if(!$isCatFound) { ?>
                    <section class="box_wrapper box_img_green box_huge_right sop_category">
                        <div class="box_inside">
                            <h3><?php echo $select_title; ?></h3>
                            <div class="box_content">
                                <div class="box_content_left">
                                    <?php echo $select_text; ?>
                                </div>
                                <div class="box_content_right">
                                    <div class="select_wrapper">

                                        <?php $pageArgs = array(
                                            'depth'                 => 0,
                                            'child_of'              => 11248,
                                            'selected'              => 0,
                                            'echo'                  => 1,
                                            'name'                  => 'page_id',
                                            'id'                    => null, // string
                                            'show_option_none'      => null, // string
                                            'show_option_no_change' => null, // string
                                            'option_none_value'     => null, // string
                                        ); ?>

                                        <?php wp_dropdown_pages($pageArgs); ?>
                                        
                                        <script type='text/javascript'>
                                        	var dropdown = document.getElementById("page_id");
                                        	function onPageChange() {
                                        		if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                                        			location.href = "<?php echo home_url(); ?>/?page_id="+dropdown.options[dropdown.selectedIndex].value;
                                        		}
                                        	}
                                        	dropdown.onchange = onPageChange;
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php } ?>
            </div>
    </section>

<?php

endwhile;
    wp_reset_query();
    wp_reset_postdata();

?>
        <section>
<?php

if($isCatFound) { // show grig with results
    $catExpText = get_field('category_explanation_text', 89);

    $foundCatExpText = '';

    foreach($catExpText as $catExpT) {
        if($catExpT['selected_category'] == $foundTaxonomy->term_id) {
            $foundCatExpText = $catExpT;
            break;
        }
    }

    ?>


    <?php if($foundCatExpText != '') { ?>
    <div class="box_wrapper box_w_green box_huge box_two_column">
        <div class="box_inside">
            <h4><?php
            if($sub_title_one) {
                echo get_the_title(); ?>
            <?php } ?>
	    </h4>
            <h3><?php
                if($title_one) {
                    echo $foundTaxonomy->name; ?>
                <?php } ?>
	    </h3>
            <div class="box_content">
                <?php echo $foundCatExpText['content'] ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="grid_wrapper">
            <div id="container" class=" grid_post">
                <?php
                $posts = array();
                for($n = 0; $n <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"]; $n++) {
                    $posts[$n] = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level".$n."_posts"]));
                }
                //$query = new WP_Query($args);
                  //$query->rewind_posts();
                    $role = ($current_user->roles[0]);

                $startTime = round(microtime(true) * 1000);
                for ($ijk = 0; $ijk < count($queryItems); $ijk++) {
                    $post = $queryItems[$ijk];

                    //Assign level based on roles
                    if($role == 'administrator') {
                        $level = 6;
                    } elseif($role == 'editor') {
                        $level = 5;
                    } elseif($role == 'author') {
                        $level = 4;
                    } elseif($role == 's2member_level4') {
                        $level = 3;
                    } elseif($role == 's2member_level2') {
                        $level = 2;
                    } elseif($role == 's2member_level1') {
                        $level = 1;
                    } elseif($role == 'subscriber') {
                        $level = 0;
                    } elseif($role === null) {
                        $level = 6;
                    }

                    $foundCapability = false;
                    $allCapabilitiesEmpty = true;

                     //Loop through posts, compare with level
                     for($i = 0; $i <= count($posts) && $i <= $level; $i++) {
                        $foundCapability |= in_array(get_the_ID(), $posts[$i]);
                        $allCapabilitiesEmpty &= !in_array(get_the_ID(), $posts[$i]);
                    }

                    if((!$allCapabilitiesEmpty && !$foundCapability && $role !== null) || (!$allCapabilitiesEmpty && $role === null && $foundCapability)) {
                        continue;
                    }

                    $avatar = wp_get_attachment_image_src(get_field('image'), 'medium');

                    $categorytxtList = ipu_get_custom_field('ipu_categories');
                    $giCategoryList = explode(',',$categorytxtList);

                    $categoryfolderstxtList = ipu_get_custom_field('ipu_folders');
                    $giCategoryFolderList = explode(',',$categoryfolderstxtList);

                    $categorytxtListAdd = ipu_get_custom_field('ipu_categories_add');
                    $giCategoryListAdd = explode(',',$categorytxtListAdd);

                    $categoryfolderstxtListAdd = ipu_get_custom_field('ipu_folders_add');
                    $giCategoryFolderListAdd = explode(',',$categoryfolderstxtListAdd);


                    // verifying that only selected category resources are displayed
                    if(array_search($foundTaxonomy->term_id, $giCategoryList) === false) {
                         // checking if found in extra list
                         $foundTax = false;
                         for($kk = 0; $kk < count($giCategoryListAdd); $kk++) {
                             $categorytxtListAddSub = explode("-", $giCategoryListAdd[$kk]);
                             if($foundTaxonomy && array_search($foundTaxonomy->term_id, $categorytxtListAddSub) !== false) {
                                 $foundTax = true;
                             }
                         }

                         if(!$foundTax) {
                           continue;
                         }
                     }

                   // verifying that only selected category resources are displayed
                   if(!$foundTaxonomyFolder) {
                       if($categoryfolderstxtList) {
                           continue;
                       }
                   }
                   elseif((count($taxonomyFolderCategories) > 0 && !$foundTaxonomyFolder) || ($foundTaxonomyFolder && array_search($foundTaxonomyFolder->term_id, $giCategoryFolderList) === false)) {
                       // checking if found in extra list
                       $foundTax = false;
                       for($kk = 0; $kk < count($giCategoryFolderListAdd); $kk++) {
                           $giCategoryFolderListAddSub = explode("-", $giCategoryFolderListAdd[$kk]);
                           if($foundTaxonomyFolder && array_search($foundTaxonomyFolder->term_id, $giCategoryFolderListAddSub) !== false) {
                               $foundTax = true;
                           }
                       }

                       if(!$foundTax) {
                          continue;
                       }
                   }

                    $fields = get_fields();
                    $title = $fields["title"];
                    $shortDesc = $fields["short_description"];
                    $quotes = $fields["quotes"];
                    $attachment_id = get_field('upload_file');
                    $viewFile = wp_get_attachment_url($attachment_id);
                    $post_type = get_post_type();
                    $date = get_the_date();

                    $giCatClasses = implode(' gi_', $giCategoryList);
                    $giCatClasses = 'gi_'.$giCatClasses;

                    $cat_id = 'gi_'.$categorytxtList;

                    if($v){ ?><?php } ?>
                        <?php include(get_query_template('loop-'.$post_type)); ?>

                            <?php
                                ////////////     Filters    //////////////
                            ?>

                <?php } ?>
            </div>
        </div>

<?php }else{ // show single page with content ?>
<?php } ?>

        </section>
    </div>
</article>

<script>
    //filters counter
    //move-
    $('.sbf_filter_counter').addClass('remove');
    $('.remove:last-child').addClass('last');
    $('.last:last-child').removeClass('remove');
    $('.remove').remove();

    $('.sbf_filter_counter').css('visibility','visible');
</script>
<script>

    $(function(){
  $('ul.tabs li:first').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
    $('ul.tabs li').on('click',function(){
        $('ul.tabs li').removeClass('active');
        $(this).addClass('active');
        $('.block article').hide();
        var activeTab = $(this).find('a').attr('href');
        $(activeTab).show();
        return false;
    });
})
</script>
<?php

get_footer();
