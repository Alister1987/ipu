<?php
/**
Template Name: IPU Resources Two
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
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
    $page_id = get_the_ID();

?>

<?php if($page_id == '757') { ?>
    <aside class="sidebar sb_filters two_column">
    	<?php
    	//getting filtering type
    	$meta = get_post_meta(get_the_ID(), 'ipu_filter_by');

    	$filterBy = 'type';
    	$taxonomyCategories = array();

    	if (count($meta) > 0 && $meta[0] == 'category') {
    		// lets make sure that there is enough categories to filter by
    		$taxonomyCategories = get_the_terms(get_the_ID(), 'ipu_resource_category');

    		if (count($taxonomyCategories) > 0) {
    			// switch filter to category
    			$filterBy = 'category';
    		}
    	}

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

    	// checking if filter is available
    	if ($filterBy == 'type' && count($allowedResourceTypes) == 0) {
    		$filterBy = '';
    	}
    	?>

        <div class='sbf_filtergroup' id='filters-demo' data-filter-group="filter-cat">
			<span class="sbf_title">Filter by Category</span>
			<div  class="sbf_filter sbf_filter_active" style="display:none">
				<button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All</button>
			</div>


			<div class="select_wrapper_sidebar">
				<form name="cat" action="<?= get_permalink();?>" method="get">
					<div class="select_wrapper select_wrapper_outline">
						<select class='cmbsopfilterby' id='filters-demo' data-filter-group="filter-cat" name='cat'>
							<option value=''>All</option>
							<?php
							foreach ($taxonomyCategories as $taxon) {
								?>
								<option value="<?= $taxon->name; ?>"><?= $taxon->name; ?></option>
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

			<?php foreach ($taxonomyCategories as $taxon) { ?>
				<div  class="sbf_filter" style="display:none">
					<button style="display:none" data-filter=".gi_<?php echo $taxon->name ?>" id="cat_<?php echo $taxon->term_id ?>" class='sbf_filter_name'>
						<span class='bullet'></span>
							<?php echo $taxon->name ?>
						<span class='sbf_filter_counter'></span>
					</button>
				</div>
			<?php } ?>
		</div>

		<div class="sbf_sortgroup">
			<span class="sbf_title">Sort by</span>
			<div class="btn_sort_wrapper">
				<div class="btn_sort_group">
					<?php include_once 'common/sortby.php'; ?>
				</div>
			</div>
		</div>

    <?php } else { ?>

        <aside class="sidebar sb_filters two_column">
            <?php
               $shortDesc = get_field('short_description', get_the_ID());
            ?>
            <?php if (!empty($shortDesc)) { ?>
                <div class="sb_txt"><?= $shortDesc; ?></div>
            <?php } ?>


            <?php
            $readMore = get_field('read_more', get_the_ID());
            ?>
            <?php if (!empty($readMore)) { ?>
                <div class="sb_txt"><?= $readMore; ?></div>
            <?php } ?>

            <?php
            //getting filtering type
            $meta = get_post_meta(get_the_ID(), 'ipu_filter_by');

            $filterBy = 'type';
            $taxonomyCategories = array();

            if (count($meta) > 0 && $meta[0] == 'category') {
                // lets make sure that there is enough categories to filter by
                $taxonomyCategories = get_the_terms(get_the_ID(), 'ipu_resource_category');

                if (count($taxonomyCategories) > 0) {
                    // switch filter to category
                    $filterBy = 'category';
                }
            }

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

            // checking if filter is available
            if ($filterBy == 'type' && count($allowedResourceTypes) == 0) {
                $filterBy = '';
            }
            ?>

            <?php if($enable_filter_by_category[0] == 1) {
                      if ($filterBy != '') { ?>
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

                            <div  class="sbf_filter sbf_filter_active" style="display: none">
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
                            <span class="sbf_title">Filter by Category</span>
                            <div  class="sbf_filter sbf_filter_active" style="display:none">
                                <button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All</button>
                            </div>


                            <div class="select_wrapper_sidebar">
                                <form name="cat" action="<?= get_permalink();?>" method="get">
                                    <div class="select_wrapper select_wrapper_outline">
                                        <select class='cmbsopfilterby' id='filters-demo' data-filter-group="filter-cat" name='cat'>
                                            <option value=''>All</option>
                                            <?php
                                            foreach ($taxonomyCategories as $taxon) {
                                                ?>
                                                <option value="<?= $taxon->term_id; ?>"><?= $taxon->name; ?></option>
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

                            <?php foreach ($taxonomyCategories as $taxon) { ?>
                                <div  class="sbf_filter" style="display:none">
                                    <button style="display:none" data-filter=".gi_<?php echo $taxon->term_id ?>" id="cat_<?php echo $taxon->term_id ?>" class='sbf_filter_name'>
                                        <span class='bullet'></span>
                                            <?php echo $taxon->name ?>
                                        <span class='sbf_filter_counter'></span>
                                    </button>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>

                    <div class="sbf_sortgroup">
                        <span class="sbf_title">Sort by</span>
                        <div class="btn_sort_wrapper">
                            <div class="btn_sort_group">
                                <?php include_once 'common/sortby.php'; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
        <?php } ?>
</aside>


<?php

/**********************************************************************************************************************************************************************
 *
***********************************************************************  Right content  *******************************************************************************
 *
**********************************************************************************************************************************************************************/

?>
<div class="content content_grid lp_content eight_column content_same_height">
	<?php
		$page_id = get_the_ID();

		if($page_id == '8002') { ?>
			<iframe src="//www.halligan.info/ipuHomeCoverwebQuote.aspx" scrolling="no" width="505" frameborder="0" height="1135"></iframe>
		<?php } elseif ($page_id == '749') { ?>

	<?php // DIRECTORY - COMMITTEES PAGE ?>
		<!-- biography-->
		<section class="content lp_content lp_event content_commitee">
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
	<?php  }elseif($page_id == '745'){ ?>
	<?php //ipu review & anual reports ?>

			<section class="furst_publication">
				<div class="box_wrapper box_w_turquoise box_review">
					<div class="box_inside">
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

	<?php }else{ ?>
	<?php
	while (have_posts()) : the_post();
	$fields = get_fields();
	$title = $fields["title"];
	$content = get_the_content();
	if($content != '') {
	?>

	<div class="box_wrapper box_w_green box_huge box_two_column">
		<div class="box_inside">
			<h3><?php the_title(); ?></h3>
			<div class="box_content">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

<?php
}
endwhile; ?>

<?php
	wp_reset_query();
	wp_reset_postdata();
}
?>
            <?php
            $currentPage = 1;

			if($page_id != '751') {
				$args = array(
          'posts_per_page' => 9999,
          'post_type' => $allowedResourceTypeKeys,
          'orderby' => $default_sort_field,
          'order' => $default_sort_direction,
          'meta_key' => $default_sort_meta_field
				);
			}else  {
				$args = array(
					'posts_per_page' => 999,
					'post_type' => array('person'),
					'paged' => $currentPage,
					'orderby' => 'meta_value_num',
			        'meta_key' => 'sort_order',
					'order' => 'ASC'
				);
            }


			$query =new  WP_Query($args);

            $queryItems = $query->posts;



            ?>
		<section>
			<div class="grid_wrapper">
			<div id="container" class=" grid_post">
				<?php

				$posts = array();
				for($n = 0; $n <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"]; $n++) {
				    $posts[$n] = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level".$n."_posts"]));
				}

				$current_page_id = get_the_ID();
				$current_parent_id = wp_get_post_parent_id($current_page_id);
				$role = ($current_user->roles[0]);


				// $query = new WP_Query($args);

				//$startTime = round(microtime(true) * 1000);

				for ($ijk = 0; $ijk < count($queryItems); $ijk++) {
				    $post = $queryItems[$ijk];

					if(get_field('ipu_page') != $current_page_id || get_field('ipu_section') != $current_parent_id) {
						$ipu_page_add_explode = explode(',',get_field('ipu_page_add'));
						$ipu_section_add_explode = explode(',',get_field('ipu_section_add'));

						if(!in_array($current_page_id, $ipu_page_add_explode) || !in_array($current_parent_id, $ipu_section_add_explode)) {
							continue;
						}
					}


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

					$fileID = get_post_meta(get_the_ID(),"files");
					$canSee = checkPermissions($fileID);

					if(!$canSee)
						continue;


					if((!$allCapabilitiesEmpty && !$foundCapability && $role !== null) || (!$allCapabilitiesEmpty && $role === null && $foundCapability)) {
						continue;
					}

					$fields = get_fields();
					$title = $fields["title"];
					$shortDesc = $fields["short_description"];
					$quotes = $fields["quotes"];
					$attachment_id = get_field('upload_file');
					$viewFile = wp_get_attachment_url($attachment_id);
					$post_type = get_post_type();
					$date = get_the_date();

					$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');

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
						</script>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
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
