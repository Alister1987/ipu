<?php

function getIPUResourcesList() {
	$resources = getIPUAllowedResources();

	$result = array();

	for ( $i = 0; $i < count( $resources ); $i ++ ) {
		$r        = $resources[ $i ];
		$result[] = $r['key'];
	}

	return $result;
}

function getIPUAllowedResources() {
	$IPUAllowedResources = array(
		array( 'title' => 'Articles', 'key' => 'article' ),
		array( 'title' => 'Checklists', 'key' => 'checklist' ),
		array( 'title' => 'Courses', 'key' => 'course' ),
		array( 'title' => 'FAQs', 'key' => 'faq' ),
		array( 'title' => 'News', 'key' => 'news' ),
		array( 'title' => 'Files', 'key' => 'file' ),
		array( 'title' => 'Guidelines', 'key' => 'guideline' ),
		array( 'title' => 'SOPs', 'key' => 'sop' ),
		array( 'title' => 'Posters and promo', 'key' => 'postersandpromo' ),
		array( 'title' => 'Publications', 'key' => 'publication' ),
		array( 'title' => 'Persons', 'key' => 'person' ),
		array( 'title' => 'Circulars', 'key' => 'circular' ),
		array( 'title' => 'Letters', 'key' => 'letter' ),
		array( 'title' => 'Links', 'key' => 'link' ),
		array( 'title' => 'Reviews', 'key' => 'review' ),
		array( 'title' => 'Events', 'key' => 'event' ),
		array( 'title' => 'Supplier', 'key' => 'supplier' )
	);

	return $IPUAllowedResources;
}

// Category Taxonomies
function ipu_add_custom_taxonomies() {
	// Add new "Locations" taxonomy to Posts
	register_taxonomy( 'ipu_resource_category', 'page', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels'       => array(
			'name'              => _x( 'IPU Categories', 'IPU Categories' ),
			'singular_name'     => _x( 'IPU Category', 'IPU Category' ),
			'search_items'      => __( 'Search IPU Categories' ),
			'all_items'         => __( 'All IPU Categories' ),
			'parent_item'       => __( 'Parent IPU Category' ),
			'parent_item_colon' => __( 'Parent IPU Category:' ),
			'edit_item'         => __( 'Edit IPU Category' ),
			'update_item'       => __( 'Update IPU Category' ),
			'add_new_item'      => __( 'Add New IPU Category' ),
			'new_item_name'     => __( 'New IPU Category Name' ),
			'menu_name'         => __( 'IPU Categories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite'      => array(
			'slug'         => 'ipu_categories', // This controls the base slug that will display before each term
			'with_front'   => false, // Don't display the category base before "/ipu_categories/"
			'hierarchical' => true // This will allow URL's like "/ipu_categories/boston/cambridge/"
		),
	) );

	// Add new "Folders" taxonomy to Posts
	register_taxonomy( 'ipu_resource_folder_category', 'page', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels'       => array(
			'name'              => _x( 'IPU Folders', 'IPU Folders' ),
			'singular_name'     => _x( 'IPU Folder', 'IPU Folder' ),
			'search_items'      => __( 'Search IPU Folders' ),
			'all_items'         => __( 'All IPU Folders' ),
			'parent_item'       => __( 'Parent IPU Folder' ),
			'parent_item_colon' => __( 'Parent IPU Folder:' ),
			'edit_item'         => __( 'Edit IPU Folder' ),
			'update_item'       => __( 'Update IPU Folder' ),
			'add_new_item'      => __( 'Add New IPU Folder' ),
			'new_item_name'     => __( 'New IPU Folder Name' ),
			'menu_name'         => __( 'IPU Folders' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite'      => array(
			'slug'         => 'ipu_folders', // This controls the base slug that will display before each term
			'with_front'   => false, // Don't display the category base before "/ipu_categories/"
			'hierarchical' => true // This will allow URL's like "/ipu_categories/boston/cambridge/"
		),
	) );
}

add_action( 'init', 'ipu_add_custom_taxonomies', 0 );
// -----


function ipu_get_custom_field_value( $array, $value ) {
	if ( is_array( $array ) && in_array( $value, $array ) ) {
		return $array[ $value ];
	}

	return false;
}

function ipu_get_custom_field( $value ) {
	global $post;

	$custom_field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $custom_field ) ) {
		return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );
	}

	return false;
}

function ipu_add_custom_meta_box() {
	// section metabox
	add_meta_box( 'ipu-configuration-meta-box', __( 'IPU Configuration', 'textdomain' ), 'ipu_configuration_meta_box_output', 'page', 'side', 'high' );

	// section metabox
	add_meta_box( 'ipu-allowed-resources-meta-box', __( 'Allowed Resources', 'textdomain' ), 'ipu_allowed_resources_meta_box_output', 'page', 'side', 'high' );

	// category meta box
	$IPUAllowedResources = getIPUAllowedResources();

	foreach ( $IPUAllowedResources as $resource ) {
		add_meta_box( 'ipu-category-meta-box', __( 'Resource Category', 'textdomain' ), 'ipu_category_meta_box_output', $resource['key'], 'side', 'high' );
	}
}

add_action( 'add_meta_boxes', 'ipu_add_custom_meta_box' );

function ipu_allowed_resources_meta_box_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_ipu_allowed_resources_meta_box_output_nonce', 'ipu_allowed_resources_meta_box_output_nonce' ); ?>

	<?php $IPUAllowedResources = getIPUAllowedResources() ?>

	<?php foreach ( $IPUAllowedResources as $resource ) {
		$resourceValue = ipu_get_custom_field( 'ipu_allowed_resource_' . $resource['key'] );
		?>
		<p>
			<label for="ipu_allowed_resource_<?php echo $resource['key'] ?>"
			       style='display:inline-block; width: 120px;'><?php _e( $resource['title'], 'textdomain' ); ?>:</label>
			<input type='checkbox' name="ipu_allowed_resource_<?php echo $resource['key'] ?>"
			       id="ipu_allowed_resource_<?php echo $resource['key'] ?>" <?php echo $resourceValue == 'yes' ? 'checked' : '' ?> />
		</p>
		<?php
	} ?>
	<?php
}

function ipu_configuration_meta_box_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_ipu_configuration_meta_box_output_nonce', 'ipu_configuration_meta_box_output_nonce' ); ?>

	<p>
		<label for="ipu_is_section"><?php _e( 'Mark as Section', 'textdomain' ); ?>:</label>

		<?php
		$isIpuSection = ipu_get_custom_field( 'ipu_is_section' );
		?>

		<input type='checkbox' name="ipu_is_section"
		       id="ipu_is_section" <?php echo $isIpuSection == 'yes' ? 'checked' : '' ?> />
	</p>

	<p>
		<label for="ipu_filter_by"><?php _e( 'Filter by Type', 'textdomain' ); ?>:</label>

		<?php
		$filterBy = ipu_get_custom_field( 'ipu_filter_by' );
		?>

		<input type='radio' name="ipu_filter_by" value='type' <?php echo $filterBy == 'type' ? 'checked' : '' ?> />
	</p>

	<p>
		<label for="ipu_filter_by"><?php _e( 'Filter by Category', 'textdomain' ); ?>:</label>

		<input type='radio' name="ipu_filter_by"
		       value='category' <?php echo $filterBy == 'category' ? 'checked' : '' ?> />
	</p>

	<?php
}

function ipu_category_meta_box_output_html( $parentId, $number, $ipuSection, $ipuPage, $ipuCategories, $ipuFolders, $ipuPriority, $ipuExclude, $post = null ) { ?>
	<div id='<?php echo $parentId ?>' class='additional-ipu-location' style='position:relative'>
		<?php
		if ( $number ) {
			?>

			<button type='button' class='button button-primary button-small'
			        style='position: absolute; right: 0px;top:0px;'>X
			</button>

			<?php
		}
		?>
		<p style='margin-top: 10px; display: inline-block'>
			<label for="ipu_section"><?php _e( 'Section', 'textdomain' ); ?>:</label>

			<?php $args  = array(
				'sort_order'     => 'ASC',
				'sort_column'    => 'post_title',
				'hierarchical'   => 1,
				'exclude'        => '',
				'include'        => '',
				'meta_key'       => 'ipu_is_section',
				'meta_value'     => 'yes',
				'authors'        => '',
				'child_of'       => 0,
				'parent'         => - 1,
				'exclude_tree'   => '',
				'number'         => '',
				'offset'         => 0,
				'posts_per_page' => - 1,
				'post_type'      => 'page',
				'post_status'    => 'publish'
			);
			$ipuSections = get_pages( $args );

			$allPages = array();

			for ( $i = 1; $i <= 100; ++ $i ) {
				$allTaxonomyPriorities[] = $i;
			}

			$allTaxonomies      = new stdClass;
			$allTaxonomyFolders = new stdClass;
			?>

			<select name="ipu_section<?php echo $number ? '_' . $number : '' ?>" id="ipu_section" style='width: 100%;'>
				<option value=''><?php _e( 'Select Section...', 'textdomain' ); ?></option>
				<?php for ( $i = 0; $i < count( $ipuSections ); $i ++ ) { ?>
					<option
						value='<?php echo $ipuSections[ $i ]->ID; ?>' <?php echo $ipuSections[ $i ]->ID == $ipuSection ? 'selected' : '' ?>><?php echo $ipuSections[ $i ]->post_title ?></option>

					<?php
					$ipuAllowedResourcesKey = 'ipu_allowed_resource_' . get_post_type( $post );
					?>

					<?php $args = array(
						'sort_order'     => 'ASC',
						'sort_column'    => 'post_title',
						'hierarchical'   => 1,
						'exclude'        => '',
						'include'        => '',
						'meta_key'       => $ipuAllowedResourcesKey,
						'meta_value'     => 'yes',
						'authors'        => '',
						'child_of'       => 0,
						'parent'         => $ipuSections[ $i ]->ID,
						'exclude_tree'   => '',
						'number'         => '',
						'offset'         => 0,
						'post_type'      => 'page',
						'posts_per_page' => - 1,
						'post_status'    => 'publish'
					);

					$ipuPages = get_pages( $args );
					foreach ( $ipuPages as $page ) {
						array_push( $allPages, $page );

						$terms                      = get_the_terms( $page->ID, 'ipu_resource_category' );
						$allTaxonomies->{$page->ID} = $terms;

						$terms                           = get_the_terms( $page->ID, 'ipu_resource_folder_category' );
						$allTaxonomyFolders->{$page->ID} = $terms;
					}
					?>

					<?php
				} ?>
			</select>
		</p>

		<p>
			<label for="ipu_page"><?php _e( 'Page', 'textdomain' ); ?>:</label>
			<select name="ipu_page<?php echo $number ? '_' . $number : '' ?>" id="ipu_page" style='width: 100%;'>
				<option value=''><?php _e( 'Select Page...', 'textdomain' ); ?></option>
				<?php foreach ( $allPages as $page ) { ?>
					<?php if ( $page->post_parent == $ipuSection ) { ?>
						<option data-parent="<?php echo $page->post_parent ?>"
						        value='<?php echo $page->ID; ?>' <?php echo $page->ID == $ipuPage ? 'selected' : '' ?>><?php echo $page->post_title ?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="ipu_categories"><?php _e( 'Categories', 'textdomain' ); ?>:</label>
			<select name="ipu_categories<?php echo $number ? '_' . $number : '' ?>[]" id="ipu_categories" multiple
			        style='width: 100%;'>
				<?php if ( isset( $allTaxonomies->{$ipuPage} ) ) {
					$taxons = $allTaxonomies->{$ipuPage};

					$selectedCategories = explode( ',', $ipuCategories );
					if ( count( $taxons ) > 0 ) {
						foreach ( $taxons as $taxon ) {
							$isSelected = in_array( $taxon->term_id . '', $selectedCategories );

							$selectedStr = $isSelected ? 'selected=selected' : '';

							echo '<option value="' . $taxon->term_id . '" ' . $selectedStr . '">' . $taxon->name . '</option>';
						}
					} else {
						echo '<option value="">no categories...</option>';
					}

				} else { ?>
					<option value="">no categories...</option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="ipu_folders"><?php _e( 'Folders', 'textdomain' ); ?>:</label>
			<select name="ipu_folders<?php echo $number ? '_' . $number : '' ?>[]" id="ipu_folders" multiple
			        style='width: 100%;'>
				<?php if ( isset( $allTaxonomyFolders->{$ipuPage} ) ) {
					$taxons = $allTaxonomyFolders->{$ipuPage};

					$selectedCategories = explode( ',', $ipuFolders );
					if ( count( $taxons ) > 0 ) {
						foreach ( $taxons as $taxon ) {
							$isSelected = in_array( $taxon->term_id . '', $selectedCategories );

							$selectedStr = $isSelected ? 'selected=selected' : '';

							echo '<option value="' . $taxon->term_id . '" ' . $selectedStr . '">' . $taxon->name . '</option>';
						}
					} else {
						echo '<option value="">no folders...</option>';
					}

				} else { ?>
					<option value="">no folders...</option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="ipu_priority"><?php _e( 'Priority', 'textdomain' ); ?>:</label>
			<select name="ipu_priority<?php echo $number ? '_' . $number : '' ?>" id="ipu_priority"
			        style='width: 100%;'>
				<option value='date'><?php _e( 'Use Items Creation Date', 'textdomain' ); ?></option>
				<?php foreach ( $allTaxonomyPriorities as $priority ) { ?>
					<option value='<?php echo $priority; ?>'><?php echo $priority ?></option>
				<?php } ?>
			</select>
		</p>
	</div>

	<?php
	$result                            = new stdClass;
	$result->{'allPages'}              = $allPages;
	$result->{'allTaxonomies'}         = $allTaxonomies;
	$result->{'allTaxonomyFolders'}    = $allTaxonomyFolders;
	$result->{'allTaxonomyPriorities'} = $allTaxonomyPriorities;

	return $result;
}

// Output the Metabox
function ipu_category_meta_box_output( $post ) {
	// create a nonce field
	wp_nonce_field( 'my_ipu_category_meta_box_output_nonce', 'ipu_category_meta_box_output_nonce' ); ?>

	<?php
	$ipuSection    = ipu_get_custom_field( 'ipu_section' );
	$ipuPage       = ipu_get_custom_field( 'ipu_page' );
	$ipuCategories = ipu_get_custom_field( 'ipu_categories' );
	$ipuFolders    = ipu_get_custom_field( 'ipu_folders' );
	$ipuPriority   = ipu_get_custom_field( 'ipu_priority' );
	$ipuExclude    = ipu_get_custom_field( 'ipu_exclude' );

	$ipuSectionAdd    = ipu_get_custom_field( 'ipu_section_add' );
	$ipuPageAdd       = ipu_get_custom_field( 'ipu_page_add' );
	$ipuCategoriesAdd = ipu_get_custom_field( 'ipu_categories_add' );
	$ipuFoldersAdd    = ipu_get_custom_field( 'ipu_folders_add' );
	$ipuPriorityAdd   = ipu_get_custom_field( 'ipu_priority_add' );

	$result = ipu_category_meta_box_output_html( 'additional-ipu-location', '', $ipuSection, $ipuPage, $ipuCategories, $ipuFolders, $ipuPriority, $post );

	$allTaxonomyFolders    = $result->{'allTaxonomyFolders'};
	$allPages              = $result->{'allPages'};
	$allTaxonomies         = $result->{'allTaxonomies'};
	$allTaxonomyPriorities = $result->{'allTaxonomyPriorities'};


	// lets define additional sections
	$ipuSectionAddArr   = explode( ",", $ipuSectionAdd );
	$ipuPageAddArr      = explode( ",", $ipuPageAdd );
	$ipuCategoriesAddAr = explode( ",", $ipuCategoriesAdd );
	$ipuFoldersArr      = explode( ",", $ipuFoldersAdd );
	$ipuPriorityArr     = explode( ",", $ipuPriorityAdd );

	if ( $ipuSectionAdd ) {
		for ( $num = 0; $num < count( $ipuSectionAddArr ); $num ++ ) {
			$_ipuSection    = $ipuSectionAddArr[ $num ];
			$_ipuPage       = $ipuPageAddArr[ $num ];
			$_ipuCategories = $ipuCategoriesAddAr[ $num ];
			$_ipuCategories = str_replace( "-", ",", $_ipuCategories );
			$_ipuFolders    = $ipuFoldersArr[ $num ];
			$_ipuFolders    = str_replace( "-", ",", $_ipuFolders );
			$_ipuPriority   = $ipuPriorityArr[ $num ];

			ipu_category_meta_box_output_html( 'additional-' . $num, ( $num + 2 ), $_ipuSection, $_ipuPage, $_ipuCategories, $_ipuFolders, $_ipuPriority, $post );
		}
	}
	?>

	<input type="button" value="Additional Location" id="add-additional-ipu-section"
	       class="button button-secondary button-large"></input>
	</br>
	<p>
		<label for="ipu_exclude"><?php _e( 'Exclude', 'textdomain' ); ?>:</label></br>
		<select name="ipu_exclude" id="ipu_exclude" style='width: 100%;'>
			<option value='dont_exclude'><?php _e( 'Do Not Exclude From Search', 'textdomain' ); ?></option>
			<option value='do_exclude'><?php _e( 'Exclude From Search', 'textdomain' ); ?></option>
		</select>
	</p>

	<script type="text/javascript">
		var ipu_category_pages = <?php echo json_encode( $allPages ); ?>;
		var allTaxonomies = <?php echo json_encode( $allTaxonomies ); ?>;
		var allTaxonomyFolders = <?php echo json_encode( $allTaxonomyFolders ); ?>;
		var allTaxonomyPriorities = <?php echo json_encode( $ipuPriorityArr ); ?>;
		var ipuPage = '<?php echo $ipuPage; ?>';
		var ipuPriority = '<?php echo $ipuPriority; ?>';
		var ipuExclude = '<?php echo $ipuExclude; ?>';


		console.log(ipu_category_pages);
		console.log(allTaxonomies);
		console.log(allTaxonomyFolders);
		console.log(allTaxonomyPriorities);
		console.log(ipuPage);
		console.log(ipuPriority);
		console.log(ipuExclude);


		function assignIpuSectionEvents(parentId) {
			if (jQuery(parentId + " > button").length > 0) {
				jQuery(parentId + " > button").click(function () {
					jQuery(this).parent().remove();
				});
			}

			jQuery(parentId + " #ipu_section").change(function () {
				jQuery(parentId + " #ipu_page option:not([value=''])").remove();

				for (var i = 0; i < ipu_category_pages.length; i++) {
					if (ipu_category_pages[i].post_parent == jQuery(this).val()) {
						jQuery(parentId + " #ipu_page").append('<option data-parent="' + ipu_category_pages[i].post_parent + '" value="' + ipu_category_pages[i].ID + '">' + ipu_category_pages[i].post_title + '</option>');
					}
				}

				jQuery(parentId + " #ipu_page").val('');
				jQuery(parentId + " #ipu_page").change();

			});

			jQuery(parentId + " #ipu_page").change(function () {
				jQuery(parentId + " #ipu_categories option").remove();
				jQuery(parentId + " #ipu_folders option").remove();

				// getting taxonomies of the page
				var pageId = jQuery(this).val();

				// Categories
				if (Array.isArray(allTaxonomies[pageId])) {
					if (allTaxonomies[pageId] && allTaxonomies[pageId].length > 0) {
						var taxons = allTaxonomies[pageId];

						for (var i = 0; i < taxons.length; i++) {
							jQuery(parentId + " #ipu_categories").append('<option value="' + taxons[i].term_id + '">' + taxons[i].name + '</option>');
						}
					} else {
						jQuery(parentId + " #ipu_categories").append('<option value="">no categories...</option>');
					}
				} else {
					if (allTaxonomies[pageId] && Object.keys(allTaxonomies[pageId]).length > 0) {
						var taxons = allTaxonomies[pageId];

						for (var key in taxons) {
							jQuery(parentId + " #ipu_categories").append('<option value="' + taxons[key].term_id + '">' + taxons[key].name + '</option>');
						}
					} else {
						jQuery(parentId + " #ipu_categories").append('<option value="">no categories...</option>');
					}
				}

				// FOLDERS
				if (Array.isArray(allTaxonomyFolders[pageId])) {
					if (allTaxonomyFolders[pageId] && allTaxonomyFolders[pageId].length > 0) {
						var taxons = allTaxonomyFolders[pageId];

						for (var i = 0; i < taxons.length; i++) {
							jQuery(parentId + " #ipu_folders").append('<option value="' + taxons[i].term_id + '">' + taxons[i].name + '</option>');
						}
					} else {
						jQuery(parentId + " #ipu_folders").append('<option value="">no folders...</option>');
					}
				} else {
					if (allTaxonomyFolders[pageId] && Object.keys(allTaxonomyFolders[pageId]).length > 0) {
						var taxons = allTaxonomyFolders[pageId];

						for (var key in taxons) {
							jQuery(parentId + " #ipu_folders").append('<option value="' + taxons[key].term_id + '">' + taxons[key].name + '</option>');
						}
					} else {
						jQuery(parentId + " #ipu_folders").append('<option value="">no folders...</option>');
					}
				}
			});
		}

		jQuery(document).ready(function () {
			jQuery("#add-additional-ipu-section").click(function (e) {
				e.stopPropagation();
				e.preventDefault();

				var rId = ("additional" + Math.random()).replace(".", "");

				var additionalLocation = jQuery("#additional-ipu-location").clone();
				jQuery(additionalLocation).attr("id", rId);
				jQuery("#add-additional-ipu-section").before(jQuery(additionalLocation));
				assignIpuSectionEvents("#" + rId);

				// count total number of sections
				var totalSections = jQuery(".additional-ipu-location").length;

				jQuery("#" + rId).find("select[name='ipu_section']").first().val("").change();

				jQuery("#" + rId).find("select[name='ipu_section']").first().attr("name", "ipu_section_" + totalSections);
				jQuery("#" + rId).find("select[name='ipu_page']").first().attr("name", "ipu_page_" + totalSections);
				jQuery("#" + rId).find("select[name='ipu_categories[]']").first().attr("name", "ipu_categories_" + totalSections + "[]");
				jQuery("#" + rId).find("select[name='ipu_priority']").first().attr("name", "ipu_priority_" + totalSections);
			});

			assignIpuSectionEvents("#additional-ipu-location");

			for (var i = 1; i < jQuery(".additional-ipu-location").length; i++) {
				assignIpuSectionEvents("#additional-" + (i - 1));
			}

			if (!ipuPage) {
				jQuery("#additional-ipu-location #ipu_section").change();
			}

			if (ipuPriority) {
				jQuery('#ipu_priority').val(ipuPriority);
			}

			if (ipuExclude) {
				jQuery('#ipu_exclude').val(ipuExclude);
			}

			var count_k = 0
			for (var k = 2; k <= 10; k++) {
				jQuery("select[name='ipu_priority_" + k + "']").val(allTaxonomyPriorities[count_k]);
				count_k++;
			}
		});
	</script>

	<?php
}

// Save the Metabox values
function ipu_meta_box_save( $post_id ) {
	// Stop the script when doing autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Stop the script if the user does not have edit permissions
	if ( ! current_user_can( 'edit_post' ) ) {
		return;
	}

	// checking if allowed resources is enabled
	if ( isset( $_POST['ipu_allowed_resources_meta_box_output_nonce'] ) && wp_verify_nonce( $_POST['ipu_allowed_resources_meta_box_output_nonce'], 'my_ipu_allowed_resources_meta_box_output_nonce' ) ) {
		$IPUAllowedResources = getIPUAllowedResources();

		foreach ( $IPUAllowedResources as $resource ) {
			if ( isset( $_POST[ 'ipu_allowed_resource_' . $resource['key'] ] ) ) {
				update_post_meta( $post_id, 'ipu_allowed_resource_' . $resource['key'], 'yes' );
			} else {
				update_post_meta( $post_id, 'ipu_allowed_resource_' . $resource['key'], 'no' );
			}
		}
	}

	// checking nonce field for the Is
	if ( isset( $_POST['ipu_configuration_meta_box_output_nonce'] ) && wp_verify_nonce( $_POST['ipu_configuration_meta_box_output_nonce'], 'my_ipu_configuration_meta_box_output_nonce' ) ) {
		if ( isset( $_POST['ipu_is_section'] ) ) {
			update_post_meta( $post_id, 'ipu_is_section', 'yes' );
		} else {
			update_post_meta( $post_id, 'ipu_is_section', 'no' );
		}

		if ( isset( $_POST['ipu_filter_by'] ) ) {
			update_post_meta( $post_id, 'ipu_filter_by', $_POST['ipu_filter_by'] );
		}


	}

	// Verify the nonce. If insn't there, stop the script
	if ( isset( $_POST['ipu_category_meta_box_output_nonce'] ) && wp_verify_nonce( $_POST['ipu_category_meta_box_output_nonce'], 'my_ipu_category_meta_box_output_nonce' ) ) {
		// Save the textfield
		if ( isset( $_POST['ipu_exclude'] ) ) {
			update_post_meta( $post_id, 'ipu_exclude', esc_attr( $_POST['ipu_exclude'] ) );
		}
		if ( isset( $_POST['ipu_section'] ) ) {
			update_post_meta( $post_id, 'ipu_section', esc_attr( $_POST['ipu_section'] ) );
		}
		if ( isset( $_POST['ipu_page'] ) ) {
			update_post_meta( $post_id, 'ipu_page', esc_attr( $_POST['ipu_page'] ) );
		}
		if ( isset( $_POST['ipu_priority'] ) ) {
			update_post_meta( $post_id, 'ipu_priority', esc_attr( $_POST['ipu_priority'] ) );
		}
		if ( isset( $_POST['ipu_categories'] ) ) {
			$catStr = '';
			foreach ( $_POST['ipu_categories'] as $cat ) {
				if ( $catStr != '' ) {
					$catStr .= ',';
				}
				$cat = str_replace( ' selected', '', $cat );
				$catStr .= $cat;
			}
			update_post_meta( $post_id, 'ipu_categories', $catStr );
		} else {
			update_post_meta( $post_id, 'ipu_categories', '' );
		}
		if ( isset( $_POST['ipu_folders'] ) ) {
			$catStr = '';
			foreach ( $_POST['ipu_folders'] as $cat ) {
				if ( $catStr != '' ) {
					$catStr .= ',';
				}
				$cat = str_replace( ' selected', '', $cat );
				$catStr .= $cat;
			}
			update_post_meta( $post_id, 'ipu_folders', $catStr );
		} else {
			update_post_meta( $post_id, 'ipu_folders', '' );
		}

		$additionalSectionNum = 2;

		$additionalSections   = "";
		$additionalPages      = "";
		$additionalPriority   = "";
		$additionalCategories = "";
		$additionalFolders    = "";
		// checking if sub sections are defined
		while ( isset( $_POST[ 'ipu_section_' . $additionalSectionNum ] ) ) {
			if ( $additionalSectionNum != 2 ) {
				$additionalSections .= ",";
				$additionalPages .= ",";
				$additionalCategories .= ",";
				$additionalFolders .= ",";
				$additionalPriority .= ",";
			}

			if ( isset( $_POST[ 'ipu_section_' . $additionalSectionNum ] ) ) {
				$additionalSections .= esc_attr( $_POST[ 'ipu_section_' . $additionalSectionNum ] );
			}
			if ( isset( $_POST[ 'ipu_page_' . $additionalSectionNum ] ) ) {
				$additionalPages .= esc_attr( $_POST[ 'ipu_page_' . $additionalSectionNum ] );
			}
			if ( isset( $_POST[ 'ipu_priority_' . $additionalSectionNum ] ) ) {
				$additionalPriority .= esc_attr( $_POST[ 'ipu_priority_' . $additionalSectionNum ] );
			}
			if ( isset( $_POST[ 'ipu_categories_' . $additionalSectionNum ] ) ) {
				$catStr = '';
				foreach ( $_POST[ 'ipu_categories_' . $additionalSectionNum ] as $cat ) {
					if ( $catStr != '' ) {
						$catStr .= '-';
					}
					$cat = str_replace( ' selected', '', $cat );
					$catStr .= $cat;
				}
				$additionalCategories .= $catStr;
			}
			if ( isset( $_POST[ 'ipu_folders_' . $additionalSectionNum ] ) ) {
				$catStr = '';
				foreach ( $_POST[ 'ipu_folders_' . $additionalSectionNum ] as $cat ) {
					if ( $catStr != '' ) {
						$catStr .= '-';
					}
					$cat = str_replace( ' selected', '', $cat );
					$catStr .= $cat;
				}
				$additionalFolders .= $catStr;
			}

			$additionalSectionNum ++;
		}

		update_post_meta( $post_id, 'ipu_section_add', $additionalSections );
		update_post_meta( $post_id, 'ipu_page_add', $additionalPages );
		update_post_meta( $post_id, 'ipu_priority_add', $additionalPriority );
		update_post_meta( $post_id, 'ipu_categories_add', $additionalCategories );
		update_post_meta( $post_id, 'ipu_folders_add', $additionalFolders );
	}

	if ( false ) {

		$priorityResources = array(
			'guideline',
			'sop',
			'article',
			'faq',
			'file',
			'posterandpromo',
			'circular',
			'letter'
		);

		$args = array(
			'posts_per_page' => - 1,
			'post_type'      => $priorityResources
		);

		$query = new WP_Query( $args );

		while ( $query->have_posts() ) {
			$query->the_post();
			update_field( 'field_54f74692e9d35', '3', get_the_ID() );
		}

		wp_reset_query();
	}

}

add_action( 'save_post', 'ipu_meta_box_save' );


?>
