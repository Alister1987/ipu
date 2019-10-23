<?php
/**
 * The Breadcrumbs for our theme
 *
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE ]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->

<?php
    $parent_check = wp_get_post_parent_id(get_the_ID());
    $ad_campaign_check = is_page_template( 'template-ad-campaign.php' );
?>

<div class="breadcrumbs_wrapper">
<?php //checking if single page resource
    if(is_search()) { ?>
        <a href="#header" data-scroll="">Search Results</a>
    <?php }
    else if($parent_check == '141' || $parent_check == '84' || $parent_check == '145' || $parent_check == '147' || $parent_check == '149' || $parent_check == '139' && !($ad_campaign_check) || $parent_check == '174') { ?>

        <?php if($parent_check == 84) { ?>
                <a href="<?php echo get_page_link($parentPostId); ?>" data-scroll="">Professional</a>
        <?php } elseif($parent_check == 139) { ?>
            <a href="<?php echo get_page_link($parentPostId); ?>" data-scroll="">Communications</a>
        <?php } else { ?>
            <a href="<?php echo get_page_link($parentPostId); ?>" data-scroll=""><?php echo get_the_title($parentPostId); ?></a>
        <?php } ?>

        <?php if($parent_page != get_the_ID()) { ?>
        <a href="<?php echo get_page_link($parent_section); ?>"><?php echo get_the_title($parent_section); ?></a>
        <?php } ?>
        <?php
            $categorytxtList = ipu_get_custom_field('ipu_categories');
            $giCategoryList = explode(',',$categorytxtList);

            $categoryfolderstxtList = ipu_get_custom_field('ipu_folders');
            $giCategoryFolderList = explode(',',$categoryfolderstxtList);


            if(count($giCategoryList) > 0) {
                $firstCat = $giCategoryList[0];

                $taxonomyCategories = get_the_terms($parent_page, 'ipu_resource_category');
                foreach($taxonomyCategories as $taxCat) {
                    $n = str_replace(' ' , '_', strtolower($taxCat->name));
                    if($taxCat->term_id == $firstCat) {
                        ?>
                        <a href="<?php get_permalink(); ?><?php echo $n ?>"><?php echo $taxCat->name ?></a>
                        <?php
                        break;
                    }
                }
            }


            if(count($giCategoryFolderList) > 0) {
                $firstCatFolder = $giCategoryFolderList[0];

                $taxonomyCategoriesFolders = get_the_terms($parent_page, 'ipu_resource_folder_category');
                foreach($taxonomyCategoriesFolders as $taxCatFolder) {
                    $n = str_replace(' ' , '_', strtolower($taxCatFolder->name));
                    if($taxCatFolder->term_id == $firstCatFolder) {
                        ?>
                        <a href="<?php get_permalink(); ?><?php echo $n ?>"><?php echo $taxCatFolder->name ?></a>
                        <?php
                        break;
                    }
                }
            }
        ?>

        <?php
        // lets make sure that there is enough categories to filter by
        $taxonomyCategories = get_the_terms($parent_page, 'ipu_resource_category');
        $taxonomyCategoriesFolders = get_the_terms($parent_page, 'ipu_resource_folder_category');


        $ipuCat = get_query_var( 'ipu_cat', '');
        $ipuFolder = get_query_var( 'ipu_folder', '');
        $isCatFound = $ipuCat != '';
        $isFolderFound = $ipuFolder != '';


        $foundTaxonomy = '';
        $foundTaxonomyFolder = '';

        if($isCatFound) {
            foreach($taxonomyCategories as $taxCat) {
                $n = str_replace(' ' , '_', strtolower($taxCat->name));
                $n = str_replace("'", '', $n);
                $n = str_replace("’", '', $n);
                if($n == $ipuCat) {
                    $foundTaxonomy = $taxCat;
                    break;
                }
            }

            if($isFolderFound) {
                foreach($taxonomyCategoriesFolders as $taxCatFolder) {
                    $n = str_replace(' ' , '_', strtolower($taxCatFolder->name));
                    $n = str_replace("'", '', $n);
                    $n = str_replace("’", '', $n);
                    if($n == $ipuFolder) {
                        $foundTaxonomyFolder = $taxCatFolder;
                        break;
                    }
                }
            }

            if($foundTaxonomy != '') {
                ?>
                <a href="<?php echo get_page_link($parent_section); ?>"><?php echo get_the_title($parent_section); ?></a>
                <a href="#header" data-scroll=""><?php echo ucfirst($foundTaxonomy->name); ?></a>
                <?php
            }


            if($foundTaxonomyFolder != '') {
                ?>
                <a href="#header" data-scroll=""><?php echo ucfirst($foundTaxonomyFolder->name); ?></a>
                <?php
            }
        }

        if($foundTaxonomy == '') {
        ?>
        <a href="#header" data-scroll=""><?php echo get_the_title(); ?></a>
        <?php } ?>
    <?php } else { ?>
        <?php if($parent_section != '') {
	    $taxonomyCategories = get_the_terms($parent_page, 'ipu_resource_category');
	    $taxonomyCategoryId = ipu_get_custom_field('ipu_categories');
	    $taxonomyCategory = $taxonomyCategories[$taxonomyCategoryId];
	    $taxonomyCategoryLink = null;
	    if ($taxonomyCategory != null) {
		          $taxonomyCategoryLink = str_replace('-', '_', $taxonomyCategory->slug);
	    }
	    ?>
            <a href="<?php echo get_page_link($parent_section); ?>"><?php echo get_the_title($parent_section); ?></a>
            <a href="<?php echo get_page_link($parent_page); ?>"><?php echo get_the_title($parent_page); ?></a>
	    <?php
		if ($taxonomyCategoryLink != null) {
	    ?>
		<a href="<?php echo get_page_link($parent_page).$taxonomyCategoryLink; ?>"><?php echo $taxonomyCategory->name; ?></a>
	    <?php
		}
	    ?>

        <?php } elseif($ad_campaign_check) { ?>
            <a href="/communications/" data-scroll="">Communications</a>
            <a href="/campaigns/" data-scroll="">Campaigns</a>
        <?php } else {
            $parentPostId = wp_get_post_parent_id(get_the_ID());
            if($parentPostId) { ?>
                <a href="<?php echo get_page_link($parentPostId); ?>" data-scroll=""><?php echo get_the_title($parentPostId); ?></a>
            <?php }
        } ?>
        <a href="#header" data-scroll=""><?php echo get_the_title(); ?></a>
    <?php } ?>
</div>
