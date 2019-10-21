<?php
// ALSD - items to cache and retrieve
// psudo code
// if cache contains key [key from path!]
// potentially cache the blocks containing
//      $queryItems
//      $foundTaxonomy
//      $foundTaxonomyFolder &
//      used in the following call
//      $queryItems = filterItemsByPriorities($queryItems, $foundTaxonomy, $foundTaxonomyFolder);
//      maybe call the latter $queryItemsAmmended...
//
// alsd - removed redis
//require( $_SERVER['DOCUMENT_ROOT'] . '/predis/Autoloader.php' );
//
//Predis\Autoloader::register();
//
//try {
//    $client = new Predis\Client();
//    //echo "Successfully connected to Redis";
//}
//catch (Exception $e) {
//    //echo "Couldn't connected to Redis";
//    //echo $e->getMessage();
//}
//
//$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
//$key = $uri_parts[0];
ini_set('display_errors',0);
/**
 * Template Name: IPU SOP and Guidlines
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();

//error_reporting(E_ALL);
//ini_set('display_errors', '1');


?>
	<style>
		/* End: Recommended Isotope styles */

		.option-set li {
			color: black;
			float: left;
			display: inline;
			padding: 15px
		}

		.option-set li a {
			color: black;
			margin-right: 20px;
			font-size: 14px
		}

		#filters .sbf_filter input {
			display: none;
		}

		#filters .sbf_filter label {
			padding: 10px 161px 10px 0px;
		}

		.bulletx {

			background: transparent;
			width: 15px;
			height: 15px;
			float: left;
			left: 0px;
			position: absolute;

		}

		.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_name {
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
		$enable_filter_by_category = get_field( 'enable_filter_by_category', get_the_ID() );
		?>
		<?php //the_breadcrumb();

		//getting filtering type
		$meta = get_post_meta( get_the_ID(), 'ipu_filter_by' );

		$filterBy           = 'type';
		$taxonomyCategories = array();

		// lets make sure that there is enough categories to filter by
		$taxonomyCategories       = get_the_terms( get_the_ID(), 'ipu_resource_category' );
		$taxonomyFolderCategories = get_the_terms( get_the_ID(), 'ipu_resource_folder_category' );

		$ipuCat        = get_query_var( 'ipu_cat', '' );
		$ipuFolder     = get_query_var( 'ipu_folder', '' );
		$isCatFound    = $ipuCat != '';
		$isFolderFound = $ipuFolder != '';

		$foundTaxonomy       = '';
		$foundTaxonomyFolder = '';

		if ( $isCatFound ) {
			foreach ( $taxonomyCategories as $taxCat ) {
				$n = str_replace( ' ', '_', strtolower( $taxCat->name ) );
				$n = str_replace( '&amp;', '_', strtolower( $n ) );
				$n = str_replace( '&', '_', strtolower( $n ) );
				$n = str_replace( ')', '', strtolower( $n ) );
				$n = str_replace( '(', '', strtolower( $n ) );
				$n = str_replace( "'", '', $n );
				$n = preg_replace( '!\s+!', ' ', $n );
				$n = preg_replace( '!_+!', '_', $n );
				$n = str_replace( "’", '', $n );
				if ( $n == $ipuCat ) {
					$foundTaxonomy = $taxCat;
					break;
				}
			}
		}

		if ( $isFolderFound ) {
			foreach ( $taxonomyFolderCategories as $taxCat ) {
				$n = str_replace( ' ', '_', strtolower( $taxCat->name ) );
				$n = str_replace( '&amp;', '_', strtolower( $n ) );
				$n = str_replace( '&', '_', strtolower( $n ) );
				$n = str_replace( ')', '', strtolower( $n ) );
				$n = str_replace( '(', '', strtolower( $n ) );
				$n = str_replace( "'", '', $n );
				$n = preg_replace( '!\s+!', ' ', $n );
				$n = preg_replace( '!_+!', '_', $n );
				$n = str_replace( "’", '', $n );
				if ( $n == $ipuFolder ) {
					$foundTaxonomyFolder = $taxCat;
					break;
				}
			}
		}

		$isCatFound    = $foundTaxonomy != '';
		$isFolderFound = $foundTaxonomyFolder != '';

		?>

		<aside class="sidebar sb_filters two_column">
			<?php
			//zd-6258 - can't use the normal get_field this is the only way to get the short description
            if($foundTaxonomy && is_object($foundTaxonomy) && isset($foundTaxonomy->term_id ))
			    $shortDesc = get_option("ipu_resource_category_{$foundTaxonomy->term_id}_short_description");

			?>
			<?php if ( ! empty( $shortDesc )) { ?>
				<div class="sb_txt"><?= $shortDesc; ?></div>
			<?php } ?>
			<?php
			if ( ! $isCatFound ) {
				$sidebarFiles = get_field( 'sidebar_files', get_the_ID() );
				foreach ( $sidebarFiles as $f ) {
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
				$IPUAllowedResources     = getIPUAllowedResources();
				$allowedResourceTypes    = array();
				$allowedResourceTypeKeys = array();

				foreach ( $IPUAllowedResources as $resource ) {
					$resourceValue = ipu_get_custom_field( 'ipu_allowed_resource_' . $resource['key'] );
					if ( $resourceValue == 'yes' ) {
						array_push( $allowedResourceTypes, $resource );
						array_push( $allowedResourceTypeKeys, $resource['key'] );
					}
				}


				$currentPage = 1;
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
									'compare' => 'like'
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


			// checking if filter is available
			if ( $filterBy == 'type' && count( $allowedResourceTypes ) == 0 ) {
				$filterBy = '';
			}
			?>

			<?php
			// alsd - show the various filter on the LHS of the page

			if ( $enable_filter_by_category[0] == 1 ) {
				// alsd - by category dropdown
				if ( $isCatFound ) { ?>
					<div class="sb_txt">
						Select a category from the dropdown below:
						<div class="select_wrapper_sidebar">
							<form name="cat" action="<?= get_permalink(); ?>" method="get">
								<div class="select_wrapper select_wrapper_green">
									<select class='sopfilter' id='filters-demo' data-filter-group="filter-cat"
											name='cat'>
										<?php
										$taxonomyCat = get_the_terms( get_the_ID(), 'ipu_resource_category' );
										foreach ( $taxonomyCat as $cat ) {
											?>
											<option <?php echo $foundTaxonomy->term_id == $cat->term_id ? 'selected' : '' ?>
												data-filter=".gi_<?= $cat->term_id; ?>" id="<?= $cat->term_id; ?>"
												value="<?= $cat->name; ?>"><?= $cat->name; ?></option>
											<?php
											$catName = $cat->name;
											$catid   = $cat->term_id;
										}
										?>
									</select>
								</div>
							</form>

							<script>
								$(document).ready(function () {
									$('.sopfilter').change(function () {
										var cat = $(".sopfilter").first().val();
										var cat = cat.replace(/ /g, "_").toLowerCase();
										var cat = cat.replace(/[~!@#$£%^&*()_|+\-=?;:",.<>\{\}\[\]\\\/]/gi, '_');
										var cat = cat.replace(/["'()]/g, "_");
										var cat = cat.replace(/&/g, "_");
										var cat = cat.replace(/’/g, "");
										var cat = cat.replace(/'/g, "");
										var cat = cat.replace(/_+/g, "_").toLowerCase();


										if (cat != '') {
											window.location = "<?= home_url(); ?>/professional/sop-and-guidelines/" + cat;
										}
									});
								});
							</script>
						</div>
					</div>

					<!-- alsd - possible comment out from here -->
					<!-- alsd - as far as i can tell this loop is never filled -->
					<?php if ($taxonomyFolderCategories && count( $taxonomyFolderCategories ) > 0 ) {
						?>
<!--						<div class="sb_txt">-->
<!--							Select a folder from the dropdown below:-->
<!--							<div class="select_wrapper_sidebar">-->
<!--								<form name="folder" action="--><?//= get_permalink(); ?><!--" method="get">-->
<!--									<div class="select_wrapper select_wrapper_outline_green">-->
<!--										<select class='sopfolder' data-filter-group="filter-folder" name='folder'>-->
<!--											<option value=''>Select Folder</option>-->
<!--											--><?php
//											$taxonomyCat = $taxonomyFolderCategories;
//											foreach ( $taxonomyCat as $cat ) {
//												?>
<!--												<option --><?php //echo $foundTaxonomyFolder && $foundTaxonomyFolder->term_id == $cat->term_id ? 'selected' : '' ?>
<!--													data-filter=".gi_--><?//= $cat->term_id; ?><!--" id="--><?//= $cat->term_id; ?><!--"-->
<!--													value="--><?//= $cat->name; ?><!--">--><?//= $cat->name; ?><!--</option>-->
<!--												--><?php
//												$catName = $cat->name;
//												$catid   = $cat->term_id;
//											}
//											?>
<!--										</select>-->
<!--									</div>-->
<!--								</form>-->
<!--								<script>-->
<!--									$(document).ready(function () {-->
<!--										$('.sopfolder').change(function () {-->
<!--											var cat = $(".sopfilter").first().val();-->
<!--											var cat = cat.replace(/ /g, "_").toLowerCase();-->
<!--											var cat = cat.replace(/[~!@#$£%^&*()_|+\-=?;:",.<>\{\}\[\]\\\/]/gi, '_');-->
<!--											var cat = cat.replace(/["'()]/g, "_");-->
<!--											var cat = cat.replace(/&/g, "_");-->
<!--											var cat = cat.replace(/’/g, "");-->
<!--											var cat = cat.replace(/'/g, "");-->
<!--											var cat = cat.replace(/_+/g, "_").toLowerCase();-->
<!---->
<!---->
<!--											var folder = $(this).first().val();-->
<!--											var folder = folder.replace(/ /g, "_").toLowerCase();-->
<!--											var folder = folder.replace(/[~!@#$£%^&*()_|+\-=?;:",.<>\{\}\[\]\\\/]/gi, '_');-->
<!--											var folder = folder.replace(/["'()]/g, "_");-->
<!--											var folder = folder.replace(/&/g, "_");-->
<!--											var folder = folder.replace(/’/g, "");-->
<!--											var folder = folder.replace(/'/g, "");-->
<!--											var folder = folder.replace(/_+/g, "_").toLowerCase();-->
<!---->
<!--											if (folder != '') {-->
<!--												window.location = "--><?//= home_url(); ?>///professional/sop-and-guidelines/" + cat + "/" + folder;
//											} else {
//												window.location = "<?//= home_url(); ?>///professional/sop-and-guidelines/" + cat;
//											}
//										});
//									});
						<!--								</script>
//							</div>
//						</div>
						<?php
					} ?>
					<!-- alsd - down to here -->
					<?php if ( $filterBy != '' ) { ?>
						<?php if ( $filterBy == 'type' ) { ?>
							<div class='sbf_filtergroup' id='filters-demo-type' data-filter-group="filter-type">
								<span class="sbf_title">Filter by Type</span>

								<div class="select_wrapper_sidebar">
									<form name="cat" action="<?= get_permalink(); ?>" method="get">
										<div class="select_wrapper select_wrapper_outline">
											<select class='cmbsopfilterby' id='filters-demo'
													data-filter-group="filter-cat" name='cat'>
												<option value=''>All</option>
												<?php
												foreach ( $allowedResourceTypes as $resource ) {
													?>
													<option
														value="<?= $resource['key']; ?>"><?= $resource['title']; ?></option>
													<?php
													$catName = $cat->name;
													$catid   = $cat->term_id;
												}
												?>
											</select>
										</div>
									</form>

									<script>
										$(document).ready(function () {
											$('.cmbsopfilterby').change(function () {
												var cat = $(this).val();

												$(".sbf_filter button[data-filter='" + (cat == '' ? '' : '.gi_' + cat) + "']").click();
											});
										});
									</script>
								</div>

								<div class="sbf_filter sbf_filter_active" style="display: none">
									<button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All
									</button>
								</div>
								<?php foreach ( $allowedResourceTypes as $resource ) { ?>
									<div class="sbf_filter" style="display: none">
										<button data-filter=".gi_<?php echo $resource['key'] ?>"
												id="<?php echo $resource['key'] ?>" class='sbf_filter_name'>
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
								<div class="sbf_filter sbf_filter_active">
									<button data-filter="" class='sbf_filter_name all'><span class='bullet'></span> All
									</button>
								</div>
								<?php foreach ( $taxonomyCategories as $taxon ) { ?>
									<div class="sbf_filter">
										<button data-filter=".gi_<?php echo $taxon->term_id ?>"
												id="cat_<?php echo $taxon->term_id ?>" class='sbf_filter_name'>
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
			while ( have_posts() ) : the_post(); // alsd - for every post get each individual one
				$fields = get_fields(); //alsd - get the relevant fields

// alsd - put the fields data into relevant variables
				$title           = $fields["title"];
				$main_content    = get_field( 'main_content', 89 );
				$sub_title_one   = get_field( 'sub_title_one', 89 );
				$box_content_one = get_field( 'box_content_one', 89 );
				$sub_title_two   = get_field( 'sub_title_two', 89 );

				$title_one     = get_field( 'title_one', 89 );
				$title_two     = get_field( 'title_two', 89 );
				$title_three   = get_field( 'title_three', 89 );
				$content_three = get_field( 'content_three', 89 );

// alsd - get the posts content
				$content = get_the_content();

				?>


				<div class="lp_sop_landing">
					<?php if ( ! $isCatFound ) { ?>
						<section class="box_wrapper box_img_green box_huge sop_category">
							<div class="box_inside">
								<h4><?php
									if ( $sub_title_one ) {
										echo $sub_title_one ?>
									<?php } ?>
								</h4>
								<h3><?php
									if ( $title_one ) {
										echo $title_one; ?>
									<?php } ?>
								</h3>
								<div class="box_content">
									<div class="box_content_left">
										<?php echo $box_content_one ?>
									</div>
									<div class="box_content_right">
										<div class="select_wrapper">

											<form name="cat" action="<?= get_permalink(); ?>" method="get">
												<div class="select_wrapper">
													<select class='sbf_filtergroup sopfilter' id='filters-demo'
															data-filter-group="filter-cat" name='cat'>
														<option value="" selected>Please Select</option>
														<?php
														$taxonomyCat = get_the_terms( get_the_ID(), 'ipu_resource_category' );
														foreach ( $taxonomyCat as $cat ) {
															?>
															<option data-filter=".gi_<?= $cat->term_id; ?>"
																	id="<?= $cat->term_id; ?>"
																	value="<?= $cat->name; ?>"><?= $cat->name; ?></option>
															<?php
															$catName = $cat->name;
															$catid   = $cat->term_id;
														}
														?>
													</select>
												</div>
											</form>

											<script>
												$(document).ready(function () {
													$('.sopfilter').change(function () {
														var cat = $(this).val();
														var cat = cat.replace(/ /g, "_").toLowerCase();
														var cat = cat.replace(/[`~!@#$£%^&*_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '_');
														var cat = cat.replace(/["'()]/g, "");
														var cat = cat.replace(/&/g, "_");
														var cat = cat.replace(/_+/g, "_").toLowerCase();


														if (cat != '') {

															if (cat.slice(-1) == '_') {
																var cat = cat.slice(0, -1);
																window.location = "<?= home_url(); ?>/professional/sop-and-guidelines/" + cat;

															} else {
																window.location = "<?= home_url(); ?>/professional/sop-and-guidelines/" + cat;
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

				if ( $isCatFound ) { // show grig with results
					$catExpText = get_field( 'category_explanation_text', 89 );

					$foundCatExpText = '';

					foreach ( $catExpText as $catExpT ) {
						if ( $catExpT['selected_category'] == $foundTaxonomy->term_id ) {
							$foundCatExpText = $catExpT;
							break;
						}
					}

					?>


					<?php if ( $foundCatExpText != '' ) { ?>
						<div class="box_wrapper box_w_green box_huge box_two_column">
							<div class="box_inside">
								<h4><?php
									if ( $sub_title_one ) {
										echo get_the_title(); ?>
									<?php } ?>
								</h4>
								<h3><?php
									if ( $title_one ) {
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

					<div class="grid_wrapper">
						<div id="loader" class='uil-cube-css' style='-webkit-transform:scale(0.6)'><div></div><div></div><div></div><div></div></div>
						<div id="container" class=" grid_post">
							<!-- AJAX CONTENT PART -->
							</div>
						<!--<div id="container" class=" grid_post">
							<?php
						/*							$posts = array();
                                                    for ( $n = 0; $n <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"]; $n ++ ) {
                                                        $posts[ $n ] = array_unique( preg_split( "/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"][ "level" . $n . "_posts" ] ) );
                                                    }

                                                    $role = ( $current_user->roles[0] );


                                                    $startTime = round( microtime( true ) * 1000 );
                                                    for ( $ijk = 0; $ijk < count( $queryItems ); $ijk ++ ) {
                                                        $post = $queryItems[ $ijk ];

                                                        //$meta_values = get_post_meta( get_the_ID() );

                                                        // alsd - check the posts permissions against that of the current user and limit accordingly!
                                                        // alsd - if caching perhaps add this to the key!
                                                        //Assign level based on roles
                                                        if ( $role == 'administrator' ) {
                                                            $level = 6;
                                                        } elseif ( $role == 'editor' ) {
                                                            $level = 5;
                                                        } elseif ( $role == 'author' ) {
                                                            $level = 4;
                                                        } elseif ( $role == 's2member_level4' ) {
                                                            $level = 3;
                                                        } elseif ( $role == 's2member_level2' ) {
                                                            $level = 2;
                                                        } elseif ( $role == 's2member_level1' ) {
                                                            $level = 1;
                                                        } elseif ( $role == 'subscriber' ) {
                                                            $level = 0;
                                                        } elseif ( $role === null ) {
                                                            $level = 6;
                                                        }

                                                        $foundCapability      = false;
                                                        $allCapabilitiesEmpty = true;

                                                        //Loop through posts, compare with level
                                                        for ( $i = 0; $i <= count( $posts ) && $i <= $level; $i ++ ) {
                                                            $foundCapability |= in_array( get_the_ID(), $posts[ $i ] );
                                                            $allCapabilitiesEmpty &= ! in_array( get_the_ID(), $posts[ $i ] );
                                                        }

                                                        if ( ( ! $allCapabilitiesEmpty && ! $foundCapability && $role !== null ) || ( ! $allCapabilitiesEmpty && $role === null && $foundCapability ) ) {
                                                            continue;
                                                        }

                                                        $avatar = wp_get_attachment_image_src( get_field( 'image' ), 'medium' );

                                                        // alsd - added simialr code here to that above provided by victor, does not seem to work here!
                                                        // ALSD - ROLE BACK OUT AS NOT WORKING....
                                                        $categorytxtList = ipu_get_custom_field( 'ipu_categories' );
                                                        //ipu_get_custom_field_value( $meta_values, 'ipu_categories' );
                                                        //ipu_get_custom_field('ipu_categories');
                                                        $giCategoryList = explode( ',', $categorytxtList );

                                                        $categoryfolderstxtList = ipu_get_custom_field( 'ipu_folders' );
                                                        // ipu_get_custom_field_value( $meta_values, 'ipu_folders' );
                                                        //ipu_get_custom_field('ipu_folders');
                                                        $giCategoryFolderList = explode( ',', $categoryfolderstxtList );

                                                        $categorytxtListAdd = ipu_get_custom_field( 'ipu_categories_add' );
                                                        //ipu_get_custom_field_value( $meta_values, 'ipu_categories_add' );
                                                        //ipu_get_custom_field('ipu_categories_add');
                                                        $giCategoryListAdd = explode( ',', $categorytxtListAdd );

                                                        $categoryfolderstxtListAdd = ipu_get_custom_field( 'ipu_folders_add' );
                                                        //ipu_get_custom_field_value( $meta_values, 'ipu_folders_add' );
                                                        //ipu_get_custom_field('ipu_folders_add');
                                                        $giCategoryFolderListAdd = explode( ',', $categoryfolderstxtListAdd );

                                                        $additionalCategoryIndex = - 1;

                                                        // verifying that only selected category resources are displayed
                                                        if ( array_search( $foundTaxonomy->term_id, $giCategoryList ) === false ) {
                                                            // checking if found in extra list
                                                            $foundTax = false;
                                                            for ( $kk = 0; $kk < count( $giCategoryListAdd ); $kk ++ ) {
                                                                $categorytxtListAddSub = explode( "-", $giCategoryListAdd[ $kk ] );
                                                                if ( $foundTaxonomy && array_search( $foundTaxonomy->term_id, $categorytxtListAddSub ) !== false ) {
                                                                    $additionalCategoryIndex = $kk;
                                                                    $foundTax                = true;
                                                                }
                                                            }

                                                            if ( ! $foundTax ) {
                                                                continue;
                                                            }
                                                        }

                                                        // verifying that only selected category resources are displayed
                                                        if ( ! $foundTaxonomyFolder ) {
                                                            // calculate if folders assigned to same category in following lists:
                                                            // $categorytxtListAdd - $categoryfolderstxtListAdd
                                                            if ( $categoryfolderstxtList ) {
                                                                if ( $additionalCategoryIndex == - 1 ) {
                                                                    continue;
                                                                } else {
                                                                    $giCategoryFolderListAddSub = $giCategoryFolderListAdd[ $additionalCategoryIndex ];

                                                                    if ( $giCategoryFolderListAddSub ) {
                                                                        continue;
                                                                    }
                                                                }
                                                            } else {
                                                                $giCategoryFolderListAddSub = $giCategoryFolderListAdd[ $additionalCategoryIndex ];

                                                                if ( $giCategoryFolderListAddSub ) {
                                                                    continue;
                                                                }
                                                            }
                                                        } elseif ( ( count( $taxonomyFolderCategories ) > 0 && ! $foundTaxonomyFolder )
                                                                   || ( $foundTaxonomyFolder && array_search( $foundTaxonomy->term_id, $giCategoryList ) !== false && array_search( $foundTaxonomyFolder->term_id, $giCategoryFolderList ) === false )
                                                                   || ( $foundTaxonomyFolder && $additionalCategoryIndex != - 1 && array_search( $foundTaxonomyFolder->term_id, explode( '-', $giCategoryFolderListAdd[ $additionalCategoryIndex ] ) ) === false )
                                                        ) {
                                                            // checking if found in extra list
                                                            continue;
                                                        }

                                                        $fields        = get_fields();
                                                        $title         = $fields["title"];
                                                        $shortDesc     = $fields["short_description"];
                                                        $quotes        = $fields["quotes"];
                                                        $attachment_id = get_field( 'upload_file' );
                                                        $viewFile      = wp_get_attachment_url( $attachment_id );
                                                        $post_type     = get_post_type();
                                                        $date          = get_the_date();

                                                        $giCatClasses = implode( ' gi_', $giCategoryList );
                                                        $giCatClasses = 'gi_' . $giCatClasses;

                                                        $cat_id = 'gi_' . $categorytxtList;

                                                        if ( $v ) { */?><?php /*} */?>
								<?php /*include( get_query_template( 'loop-' . $post_type ) ); */?>
								<?php
						/*								////////////     Filters    //////////////
                                                        */?>
								<script type='text/javascript'>
									<?php
						/*									/*
                                                            if($giCategoryList) {
                                                                foreach($giCategoryList as $category) {
                                                                    ?>
                                                                        var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>');
                                                                        console.log(n<?= $category; ?>);
                                                                        var s<?= $category; ?> = $('<span />',{
                                                                            class:'<?= $category; ?> sbf_filter_counter' ,
                                                                            html: n<?= $category; ?>
                                                                        });
                                                                        s<?= $category; ?>.appendTo('#cat_<?= $category; ?>');
                                                                    <?php
                                                                }

                                                                }
                                                         */

						?>
								</script>

							<?php /*} */?>
						</div>-->
					</div>

				<?php } else { // show single page with content
					?>
					<section class="sop_preparing">
						<div class="box_wrapper box_w_purple box_huge">
							<div class="box_inside">
								<h4><?php
									if ( $sub_title_one ) {
										echo $sub_title_two ?>
									<?php } ?>
								</h4>
								<h3><?php
									if ( $title_one ) {
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

		$('.sbf_filter_counter').css('visibility', 'visible');
	</script>
	<script>

		$(function () {
			$('ul.tabs li:first').addClass('active');
			$('.block article').hide();
			$('.block article:first').show();
			$('ul.tabs li').on('click', function () {
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
