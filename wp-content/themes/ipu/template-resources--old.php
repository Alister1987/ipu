<?php
/**
Template Name: IPU Resources
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<?php
  //$order = "&order=ASC";
//  if ($_POST['select'] == 'title') { $order = "title";  }
//  if ($_POST['select'] == 'date') { $order = "post_date";  }
//  if ($_POST['select'] == 'popular') { $order = "rand";  }
?>
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

</style>
<article id="content_wrapper">
        <aside class="sidebar sb_filters two_column">
        <?php
        $shortDesc = get_field('short_description', get_the_ID());
        ?>
        <?php if(!empty($shortDesc)){?>
            <p class="sb_txt"><?= $shortDesc; ?></p>
        <?php } ?>
            
            <?php
                //getting filtering type
                $meta = get_post_meta( get_the_ID(), 'ipu_filter_by' );
                
                $filterBy = 'type';
                $taxonomyCategories = array();
                
                if(count($meta) > 0 && $meta[0] == 'category') {
                    // lets make sure that there is enough categories to filter by
                    $taxonomyCategories = get_the_terms(get_the_ID(), 'ipu_resource_category');
                    
                    if(count($taxonomyCategories) > 0) {
                        // switch filter to category
                        $filterBy = 'category';
                    }
                }

                // checking if there is enough types associated with the page
                $IPUAllowedResources = getIPUAllowedResources();
                $allowedResourceTypes = array();
                $allowedResourceTypeKeys = array();

                foreach($IPUAllowedResources as $resource) {
                    $resourceValue = ipu_get_custom_field( 'ipu_allowed_resource_'.$resource['key'] );
                    if($resourceValue == 'yes') {
                        array_push($allowedResourceTypes, $resource);
                        array_push($allowedResourceTypeKeys, $resource['key']);
                    }
                }

                // checking if filter is available
                if($filterBy == 'type' && count($allowedResourceTypes) == 0) {
                    $filterBy = '';
                }
            ?>
            
            <?php if($filterBy != '') { ?>
                <?php if($filterBy == 'type') { ?>
                    <h3>Filter BY TYPE</h3>
            
                    <div id="filters" class="sbf_filtergroup" data-group="filter">
                        <div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
                        <?php foreach($allowedResourceTypes as $resource) { ?>
                            <div class="sbf_filter" id="<?php echo $resource['key'] ?>"> <input type="checkbox" name="gi_<?php echo $resource['key'] ?>" value=".gi_<?php echo $resource['key'] ?>" id="gi_<?php echo $resource['key'] ?>"><label for="gi_<?php echo $resource['key'] ?>"><?php echo $resource['title'] ?></label></div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <h3><?php echo get_option( 'dropdown_text_name' )?></h3>
                    <div id="filters" class="sbf_filtergroup" data-group="filter">
                        <div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
                        <?php foreach($taxonomyCategories as $taxon) { ?>
                            <div class="sbf_filter" id="cat_<?php echo $taxon->term_id ?>">
                                <input type="checkbox" name="gi_<?php echo $taxon->term_id ?>" value=".gi_<?php echo $taxon->term_id ?>" id="gi_<?php echo $taxon->term_id ?>"><label for="gi_<?php echo $taxon->term_id ?>"><?php echo $taxon->name ?></label>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </aside>
	
	
	<?php 
		$page_id = get_the_ID();
		if ($page_id == '749'){ 
	?>
		<!-- biography-->
		<section class="content lp_content eight_column lp_event content_commitee">
			<section class="tab_wrapper">
				<ul class="tabs">
					<?php
					if (have_rows('about',749)):
						$i = 1;
						?>
						<?php
						while (have_rows('about',749)) : the_row();
							$first_name = get_sub_field('name');
							?>
							<li>
								<a href="#tab<?= $i++; ?>"> <?= $first_name; ?> <?= $last_name; ?> </a>
							</li>
						<?php endwhile;
						?>

						<?php
					endif;
					wp_reset_query();
					wp_reset_postdata();
					?>
				</ul>
				<div class="clr"></div>
				<section class="block">
					<?php
					if (have_rows('about')):
						$z = 1;
						?>
						<?php
						while (have_rows('about')) : the_row();
							$content = get_sub_field('content');
							?>
							<article id="tab<?= $z++; ?>">
								<div class='left-content'>
									<?= $content; ?>
								</div>
								<div class="right-content">
									<?php
									if (have_rows('personal_details')):
										while (have_rows('personal_details')) : the_row();
											$first_name = get_sub_field('first_name');
											$last_name = get_sub_field('last_name');
											$function = get_sub_field('function');
											$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'medium');
											?>
											<span class="cc_avatar_wrapper">
												<div class="cc_avatar" style="background-image:url('<?= $picture[0]; ?>')"></div>
											</span>
											<span class="cc_first_name"><?= $first_name; ?></span>
											<span class="cc_last_name"><?= $last_name; ?></span>
											<span class="cc_function"><?= $function; ?></span>
											<?php
										endwhile;
									endif;
									wp_reset_query();
									wp_reset_postdata();
									?>
								</div>
							</article>
							<?php
						endwhile;
					endif;
					wp_reset_query();
					wp_reset_postdata();
					?>
				</section>
			</section>

		</section>
		<!--biography-->
 
	<?php }elseif($page_id == '834'){ ?>
	<?php //ipu review & anual reports ?>
		<section class="content lp_content eight_column content_same_height">
			<section class="furst_publication">
				<div class="box_wrapper box_w_turquoise box_review">
					<div class="box_inside">
						<div class="ipu_review_logo"></div>
			 <?php
					if (have_rows('left_content')):
						while (have_rows('left_content')) : the_row();
							$logo = wp_get_attachment_image_src(get_sub_field('logo'), 'medium');
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							$content = get_sub_field('content');
							?>
						<h4><?=$subtitle; ?></h4>
						<div class="box_content">
							  <?=$content; ?>
						</div>		
						<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>	
					</div>
				</div>
				<div class="box_wrapper box_g_purple">
					<div class="box_inside">
						<?php
					if (have_rows('right_content')):
						while (have_rows('right_content')) : the_row();
							$title = get_sub_field('title');
							$subtitle = get_sub_field('subtitle');
							$content = get_sub_field('content');
						?>
						<h4><?=$subtitle; ?></h4>
						<h3><?=$title; ?></h3>
						<div class="box_content">
							<?=$content;?>
						</div>
						<div class="box_action">
							<?php
							if (have_rows('reports')):
								while (have_rows('reports')) : the_row();
									$title = get_sub_field('name');
									$file = wp_get_attachment_url(get_sub_field('file'), 'medium');
									 
								?>
							<a href="<?=$file;?>" class="btn btn_action_dowload_purple" title="<?=$title;?>"><?=$title;?></a>	
								<?php endwhile; ?>
							<?php endif; ?>
							<?php
							wp_reset_query();
							wp_reset_postdata();
							?>
						 
						</div>	
									
						<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
					</div>
				</div>	
			</section>
		</section>
	<?php }else{ ?>
<?php
while (have_posts()) : the_post();
$fields = get_fields();
$title = $fields["title"];
$content = get_the_content();
if($content != '') {
?>
	
	
<section class="content lp_content eight_column content_same_height">
    <div class="box_wrapper box_w_blue box_huge box_two_column">
        <div class="box_inside">

            <h3><?php the_title(); ?></h3>

            <div class="box_content">
                <?php the_content(); ?>
            </div>

        </div>
    </div>
</section>
	
	
<?php
}
endwhile; ?>
    
<?php
wp_reset_query();
wp_reset_postdata();
		}
?>
            
            <?php
            $args = array(
                    'posts_per_page' => -1,
                    'post_type' => $allowedResourceTypeKeys,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'ipu_page',
                            'value' => get_the_ID(),
                            'compare' => '='
                        ),
                        array(
                            'key' => 'ipu_section',
                            'value' => wp_get_post_parent_id(),
                            'compare' => '='
                        )
                    )
                );
            ?>
    <section class="content lp_content eight_column">
        <div class="sort">
            <div class="btn_sort_wrapper">
                <span>Sort by</span>
                <?php include_once 'common/sortby.php'; ?>
            </div>
        </div>
        <div class="grid_wrapper">
        <div id="container" class=" grid_post">
            <?php

            $query = new WP_Query($args);
            
            while ($query->have_posts()) :
                $query->the_post();
                $fields = get_fields();
                $title = $fields["title"];
                $shortDesc = $fields["short_description"];
				$quotes = $fields["quotes"];
                $attachment_id = get_field('upload_file');
                $viewFile = wp_get_attachment_url($attachment_id);
                $post_type = get_post_type();
                $date = get_the_date();
                
                $categorytxtList = ipu_get_custom_field('ipu_categories');

                $giCategoryList = explode(',',$categorytxtList);
                $giCatClasses = implode(' gi_', $giCategoryList);
                $giCatClasses = 'gi_'.$giCatClasses;
            ?>
            
            <?php include(get_query_template('loop-'.$post_type)) ?>
            
            <?php
                ////////////     Filters    //////////////
                if($filterBy == 'type') { ?>
                <script type='text/javascript'>
                    <?php if($post_type): ?>
                        var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

                        var s<?= $post_type; ?> = $('<span />',{
                            class:'<?= $post_type; ?> sbf_filter_counter' , 
                            html: n<?= $post_type; ?>
                        });

                        s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
                    <?php endif; ?>
                </script>
                <?php } else { ?>
                    <script type='text/javascript'>
                        <?php if($giCategoryList) {
                            foreach($giCategoryList as $category) {
                                ?>
                                    var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
                                    
                                    var s<?= $category; ?> = $('<span />',{
                                        class:'<?= $category; ?> sbf_filter_counter' , 
                                        html: n<?= $category; ?>
                                    });

                                    s<?= $category; ?>.appendTo('#cat_<?= $category; ?>');
                                <?php
                            }
                            ?>
                        <?php } ?>
                    </script>
                <?php } ?>
            <?php endwhile; ?>
            
        </div>
    </div>
    </section>
    
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
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });
})
</script>
<?php

get_footer();
