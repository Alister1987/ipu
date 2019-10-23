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

		.bulletx{

			background: transparent;
			width: 15px;der
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
		$page_id = get_the_ID(); ?>

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
				$n = str_replace('-','_',strtolower($n));
				$n = str_replace(')','',strtolower($n));
				$n = str_replace('(','',strtolower($n));
				$n = str_replace("'", '', $n);
				$n = preg_replace('!\s+!', ' ', $n);
				$n = preg_replace('!_+!', '_', $n);
				$n = str_replace("’", '', $n);
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
				$n = str_replace('-','_',strtolower($n));
				$n = str_replace(')','',strtolower($n));
				$n = str_replace('(','',strtolower($n));
				$n = str_replace("'", '', $n);
				$n = preg_replace('!\s+!', ' ', $n);
				$n = preg_replace('!_+!', '_', $n);
				$n = str_replace("’", '', $n);
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
			//	$args = array(
			//	    'posts_per_page' => 9999,
			//	    'post_type' => $allowedResourceTypeKeys,
			//	    'paged' => $currentPage,
			//	    'meta_query' => array(
			//	        'relation' => 'OR',
			//	        array(
			//	            'relation' => 'AND',
			//	            array(
			//	                'key' => 'ipu_page',
			//	                'value' => get_the_ID(),
			//	                'compare' => '='
			//	            ),
			//	            array(
			//	                'key' => 'ipu_section',
			//	                'value' => wp_get_post_parent_id(),
			//	                'compare' => '='
			//	            )
			//	        ),
			//	        array(
			//	            'relation' => 'AND',
			//	            array(
			//	                'key' => 'ipu_page_add',
			//	                'value' => get_the_ID(),
			//	                'compare' => 'LIKE'
			//	            ),
			//	            array(
			//	                'key' => 'ipu_section_add',
			//	                'value' => wp_get_post_parent_id(),
			//	                'compare' => 'LIKE'
			//	            )
			//	        )
			//	    )
			//	);

			$args       = array(
				'posts_per_page' => 99999,
				'post_type'      => $allowedResourceTypeKeys,
				'paged'          => $currentPage,
				'meta_query'     =>

					array(
						'relation' => 'OR',
						array(
							'key'     => 'ipu_categories_add',
							'value'   => $foundTaxonomy->term_id,
							'compare' => 'LIKE'
						),
						array(
							'key'     => 'ipu_categories',
							'value'   => $foundTaxonomy->term_id,
							'compare' => '='
						)
					),

			);


			?>
			<script type="text/javascript" >
				jQuery(document).ready(function($) {
					var data = {
						'action': 'elaborate_args_for_sops',
						'args': '<?php echo json_encode($args)?>',
						'foundTaxonomy' :'<?php echo json_encode($foundTaxonomy)?>',
						'taxonomyFolderCategories' :'<?php echo json_encode($taxonomyFolderCategories)?>',
						'foundTaxonomyFolder' :'<?php echo json_encode($isFolderFound)?>',
					};

					jQuery.post(ajaxurl, data, function(response) {
						$('#loader').fadeOut('slow',function(){
							$('#container').isotope( 'insert', $(response) );
						})
					});
				});
			</script>
			<?php


			//	$queryItems = array();
			//
			//   if($foundTaxonomy) {
			//	   $morePages = true;
			//	   $filteredList = array();
			//
			//	   while($morePages) {
			//		   $query = new WP_Query($args);
			//		   $foundItems = $query->have_posts();
			//		   while ($query->have_posts()) :
			//			   $query->the_post();
			//
			//			   $queryItems[] = $post;
			//
			//			   $categorytxtList = ipu_get_custom_field('ipu_categories');
			//			   $giCategoryList = explode(',',$categorytxtList);
			//
			//			   // verifying that only selected category resources are displayed
			//			   if(array_search($foundTaxonomy->term_id, $giCategoryList) === false) {
			//				   continue;
			//			   }
			//
			//			   $categoryfolderstxtList = ipu_get_custom_field('ipu_folders');
			//			   $giCategoryFolderList = explode(',',$categoryfolderstxtList);
			//
			//			   foreach($taxonomyFolderCategories as $key => $value) {
			//				   // verifying that only selected category resources are displayed
			//				   if(array_search($value->term_id, $giCategoryFolderList) === false) {
			//					   $categoryfolderstxtList = ipu_get_custom_field('ipu_folders_add');
			//					   $giCategoryFolderList = explode(',',$categoryfolderstxtList);
			//
			//					   foreach($taxonomyFolderCategories as $key2 => $value2) {
			//						   // verifying that only selected category resources are displayed
			//						   if(array_search($value2->term_id, explode('-',$giCategoryFolderList)) === false) {
			//	   						continue;
			//	   					}
			//
			//						   $filteredList[$value2->term_id] = $value2;
			//					   }
			//
			//					   continue;
			//				   }
			//
			//				   $filteredList[$value->term_id] = $value;
			//			   }
			//		   endwhile;
			//
			//		   if(!$foundItems) {
			//			   $morePages = false;
			//		   }
			//		   $currentPage++;
			//		   $args['paged'] = $currentPage;
			//
			//		   wp_reset_query();
			//		   wp_reset_postdata();
			//
			//	   }
			//
			//
			//	   $taxonomyFolderCategories = array();
			//
			//	   foreach($filteredList as $key => $value) {
			//		   $taxonomyFolderCategories[] = $value;
			//	   }
			//
			//   }
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
										var cat = $(this).val();
										var cat = cat.replace(/ /g, "_").toLowerCase();
										var cat = cat.replace(/[~!@#$£%^&*_|+\-=?;:",.<>\{\}\[\]\\\/]/gi, '_');
										var cat = cat.replace(/["'()]/g,"");
										var cat = cat.replace(/&/g, "_");
										var cat = cat.replace(/_+/g, "_").toLowerCase();
										var cat = cat.replace(/’/g, "");
										var cat = cat.replace(/'/g, "");


										if(cat != ''){

											if(cat.slice(-1) == '_') {
												var cat = cat.slice(0, - 1);
												window.location="<?= get_permalink(); ?>/" + cat;

											} else {
												window.location="<?= get_permalink(); ?>/" + cat;
											}
										}

									});
								});
							</script>
						</div>
					</div>




					<?php if ($filterBy != '' && wp_get_post_parent_id(get_the_ID()) != '84') { ?>
						<?php if ($filterBy == 'type' && wp_get_post_parent_id(get_the_ID()) != '84') { ?>
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
								<span class="sbf_title">Filter by Category</span>
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

		// + 1 MILLISECONDS (250millis)

		/**********************************************************************************************************************************************************************
		 *
		 ***********************************************************************  Right content  *******************************************************************************
		 *
		 **********************************************************************************************************************************************************************/

		?>
		<div class="content lp_content eight_column lp_sop_landing">
			<?php
			$page_id = get_the_ID();
			?>
			<?php
			while (have_posts()) : the_post();
				$fields = get_fields();
				$title = $fields["title"];
				$main_content = get_field('main_content', $page_id);
				$sub_title_one = get_field('sub_title_one', $page_id);
				$box_content_one = get_field('box_content_one', $page_id);
				$sub_title_two = get_field('sub_title_two', $page_id);

				$title_one = get_field('title_one', $page_id);
				$title_two = get_field('title_two', $page_id);
				$title_three = get_field('title_three', $page_id);
				$content_three = get_field('content_three', $page_id);

				$content = get_the_content();
				?>


				<div class="lp_sop_landing">
					<?php if(!$isCatFound) { ?>
						<section class="box_wrapper box_img_green box_huge sop_category">
							<div class="box_inside">
								<h4><?php
									if($sub_title_one) {
										echo $sub_title_one ?>
									<?php } ?>
								</h4>
								<h3><?php
									if($title_one) {
										echo $title_one; ?>
									<?php } ?>
								</h3>
								<div class="box_content">
									<div class="box_content_left">
										<?php echo $box_content_one ?>
									</div>
									<div class="box_content_right">
										<div class="select_wrapper">

											<form name="cat" action="<?= get_permalink();?>" method="get">
												<div class="select_wrapper">
													<select class='sbf_filtergroup sopfilter' id='filters-demo' data-filter-group="filter-cat" name='cat'>
														<option value="" selected>Please Select</option>
														<?php
														$taxonomyCat = get_the_terms(get_the_ID(), 'ipu_resource_category');
														foreach ($taxonomyCat as $cat) {
															?>
															<option data-filter=".gi_<?= $cat->term_id; ?>" id="<?= $cat->term_id; ?>" value="<?= $cat->name; ?>"><?= $cat->name; ?></option>
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
														var cat = $(this).val();
														var cat = cat.replace(/ /g, "_").toLowerCase();
														var cat = cat.replace(/[~!@#$£%^&*_|+\-=?;:",.<>\{\}\[\]\\\/]/gi, '_');
														var cat = cat.replace(/["'()]/g,"");
														var cat = cat.replace(/&/g, "_");
														var cat = cat.replace(/’/g, "");
														var cat = cat.replace(/'/g, "");
														var cat = cat.replace(/_+/g, "_").toLowerCase();

														if(cat != ''){

															if(cat.slice(-1) == '_') {
																var cat = cat.slice(0, - 1);
																window.location="<?= get_permalink(); ?>/" + cat;

															} else {
																window.location="<?= get_permalink(); ?>/" + cat;
															}
														}
													});
												});
											</script>
										</div>
									</div>
								</div>
							</div>
						</section>
					<?php } ?>
				</div>

				<?php

			endwhile;
			wp_reset_query();
			wp_reset_postdata();

			?>
			<section>
				<?php

				if($isCatFound) { // show grig with results
				$catExpText = get_field('category_explanation_text', $page_id);

				$foundCatExpText = '';

				foreach($catExpText as $catExpT) {
					if($catExpT['selected_category'] == $foundTaxonomy->term_id) {
						$foundCatExpText = $catExpT;
						break;
					}
				}

				?>


				<?php if($foundCatExpText != '') { ?>
					<div class="box_wrapper box_w_green box_huge box_resources_template">
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
					<div style="clear: both"></div>

				<?php } ?>


				<div id="loader" class='uil-cube-css' style='-webkit-transform:scale(0.6)'><div></div><div></div><div></div><div></div></div>

				<div id="container" class=" grid_post">
					<!-- AJAX CONTENT PART -->
				</div>

		</div>
		</div>

		<?php }else{ // show single page with content ?>
		<section class="sop_preparing">
			<?php if($content_three) { ?>
				<div class="box_wrapper box_w_purple box_huge">
					<div class="box_inside">
						<h4><?php
							if($sub_title_one) {
								echo $sub_title_two ?>
							<?php } ?>
						</h4>
						<h3><?php
							if($title_one) {
								echo $title_two; ?>
							<?php } ?>
						</h3>
						<div class="box_content">
							<?= $main_content; ?>
						</div>
					</div>
				</div>

				<div class="rsb_wrapper">
					<div class="rsb_txt">
						<h3><?php echo $title_three ?></h3>
						<p><?php echo $content_three; ?></p>
					</div>
				</div>
			<?php } ?>
		</section>
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
