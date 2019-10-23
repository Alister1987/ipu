<?php
/**
 * Created by PhpStorm.
 * User: alessandro
 * Date: 12/05/2016
 * Time: 3:14 PM
 */

add_action( 'wp_ajax_nopriv_elaborate_args_for_sops', 'elaborate_args_for_sops_callback' );
add_action( 'wp_ajax_elaborate_args_for_sops', 'elaborate_args_for_sops_callback' );


function elaborate_args_for_sops_callback(){
	global $wpdb; // this is how you get access to the database

	$args = $_POST['args'];
	$taxonomyFolderCategories = $_POST['taxonomyFolderCategories'];
	$foundTaxonomy = $_POST['foundTaxonomy'];
	$foundTaxonomyFolder = htmlentities($_POST['isFolderFound']);
	$current_user = wp_get_current_user();


	$args = stripslashes($args);
	$args = json_decode($args,true);

	$taxonomyFolderCategories = stripslashes($taxonomyFolderCategories);
	$taxonomyFolderCategories = json_decode($taxonomyFolderCategories,true);

	$foundTaxonomy = stripslashes($foundTaxonomy);
	$foundTaxonomy = json_decode($foundTaxonomy);


	if ( $foundTaxonomy ) {

		$filteredList = array();

		$query      = new WP_Query( $args ); // alsd  - run the query with the params above
		$queryItems = $query->posts;
		$queryItems = filterItemsByPriorities( $queryItems, $foundTaxonomy );


		foreach ( $queryItems as $queryItem ) {

			global $post;
			$post = $queryItem;


			$meta_values = get_post_meta( get_the_ID() ); // alsd - get the posts related metadata


			// alsd - i believe what happening in this portion of the loop, is that each posts custom fields are
			// fetched - so, ipu_categories, ipu_folders & ipu_folders_add, and placed into a $filteredList again for use later
			$categorytxtList = ipu_get_custom_field_value( $meta_values, 'ipu_categories' );
			$giCategoryList  = explode( ',', $categorytxtList );

			// verifying that only selected category resources are displayed
			if ( array_search( $foundTaxonomy->term_id, $giCategoryList ) === false ) {
				continue;
			}

			$categoryfolderstxtList = ipu_get_custom_field_value( $meta_values, 'ipu_folders' );
			$giCategoryFolderList   = explode( ',', $categoryfolderstxtList );

			foreach ( $taxonomyFolderCategories as $key => $value ) {
				// verifying that only selected category resources are displayed
				if ( array_search( $value->term_id, $giCategoryFolderList ) === false ) {
					$categoryfolderstxtList = ipu_get_custom_field_value( $meta_values, 'ipu_folders_add' );
					$giCategoryFolderList   = explode( ',', $categoryfolderstxtList );

					foreach ( $taxonomyFolderCategories as $key2 => $value2 ) {
						// verifying that only selected category resources are displayed
						if ( array_search( $value2->term_id, explode( '-', $giCategoryFolderList ) ) === false ) {
							continue;
						}

						$filteredList[ $value2->term_id ] = $value2;
					}

					continue;
				}

				$filteredList[ $value->term_id ] = $value;
			}
		}


		//AVLD uselesse never use this in the rest of the page
		//$currentPage ++;
		//$args['paged'] = $currentPage;

		wp_reset_query();
		wp_reset_postdata();


		// alsd - typically at this point the two arrays
		// $filteredList & $queryItems are now filled with there relevant data
		// note : filtered list appears empty on most of my passes with data!
		// also note, queryitems is 1177+ items in size - so look slike every post on the site, perhaps better filtering above might be helpful
		// e.g. putting the relevant sop posts into a subfolder
		$taxonomyFolderCategories = array();

		foreach ( $filteredList as $key => $value ) {
			$taxonomyFolderCategories[] = $value;
		}

	}
	?>


	<?php
	$posts = array();
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

		$fileID = get_post_meta(get_the_ID(),"files");

		$canSee = checkPermissions($fileID);


		if(!$canSee)
			continue;



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


		include( get_query_template( 'loop-' . $post_type ) ); }

	wp_die();
}


function checkPermissions($fileID){

	if(!$fileID || empty($fileID))
		return true;

	if(is_array($fileID) && isset($fileID[0]))
		$fileID = $fileID[0];

	$_wp_attachment_metadata = get_post_meta( $fileID, "_wp_attachment_metadata" );

	if ( is_array( $_wp_attachment_metadata ) ) {
		if ( is_array( $_wp_attachment_metadata[0] ) ) {
			$_wp_attachment_metadata = $_wp_attachment_metadata[0]["file"];
		} else {
			$_wp_attachment_metadata = $_wp_attachment_metadata[0];
		}

		//is protected
		if ( strpos( $_wp_attachment_metadata,"_mediavault"  ) !== false ) {
			$_mgjp_mv_permission = get_post_meta( $fileID, "_mgjp_mv_permission" );

			if ( is_array( $_mgjp_mv_permission ) && isset( $_mgjp_mv_permission[0] ) ) {
				return checkFilePermissions( $_mgjp_mv_permission[0] );
			} else {//check default   wp_options =  mgjp_mv_default_permission
				$option = get_option( "mgjp_mv_default_permission" );

				return checkFilePermissions( $option );

			}

		}

	}

	return true;
}

function checkFilePermissions($p){
	switch ($p){
		case "cp-ipu":
			return sd_restrict_cp_ipu();
			break;
		case "ce-cp-ipu":
			return sd_restrict_ce_cp_ipu();
			break;
		case "ipu":
			return sd_restrict_ipu();
			break;
	}
}


add_action( 'wp_ajax_nopriv_elaborate_members', 'elaborate_members_callback' );
add_action( 'wp_ajax_elaborate_members', 'elaborate_members_callback' );

function elaborate_members_callback(){
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array('article', 'file', 'review'),
		'orderby' => 'date',
		'order' => 'DESC'
	);

	$query = new WP_Query($args);

	while ($query->have_posts()) :
		$query->the_post();
		$fields = get_fields();
		$category = $fields["category"];
		$fieldz = get_field_object('category');
		$value = get_field('category');
		$categorylbl = $fieldz['choices'][$value];

		//update
		$first_name = $fields["first_name"];
		$last_name = $fields["last_name"];
		$function = $fields["function"];
		$location = $fields["location"];
		//$select = $fields["category"];
		$select = $fields["region"];

		$author = $fields["author"];
		$offer = $fields["offer"];
		//$shortDesc = $fields["short_description"];
		$bg_picture = wp_get_attachment_image_src(get_field('picture'), 'medium');
		$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');

		//update
		$date = get_field('date');
		$year = date( 'Y', strtotime( $date ) );
		$month = date( 'M', strtotime( $date ) );
		$day = date( 'd', strtotime( $date ) );
		$title = $fields["title"];
		$subtitle = $fields["subtitle"];
		$shortdescription = $fields["short_description"];



		$file = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));


		foreach($select as $selected){
			$region = $selected;
			//$categorylbl = $label;
		}



		$display = $fields["display_on_review"];
		$title = $fields["title"];
		$categorytxt = $fields["category"];
		$fieldz = get_field_object('category');
		$value = get_field('category');
		$categorylbl = $fieldz['choices'][$value];
		$shortDesc = $fields["short_description"];
		$attachment_id = get_field('upload_file');

		$viewFile = wp_get_attachment_url($attachment_id);
		$post_type = get_post_type();

		$id = get_the_ID();
		$attachment_picture = get_field('picture');
		$picture = wp_get_attachment_image_src($attachment_picture, 'medium', true);
		$defaultPicture = wp_get_attachment_image_src($id, 'medium', true);

		$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));
		?>



		<?php if ($post_type == 'review') {  ?>
		<?php include(get_query_template('loop-'.$post_type)) ?>
	<?php } ?>


		<?php if($display == 'yes') { ?>

		<?php if ($post_type == 'article') {  ?>
			<?php include(get_query_template('loop-'.$post_type)) ?>
		<?php } ?>
		<?php if ($post_type == 'file') { ?>
			<?php include(get_query_template('loop-'.$post_type)) ?>
		<?php } ?>

	<?php } ?>
		<?php
		////////////     Filters    //////////////
		?>
        <script>
			<?php if($post_type): ?>
            var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

            var s<?= $post_type; ?> = $('<span />',{
                class:'<?= $post_type; ?> sbf_filter_counter' ,
                html: n<?= $post_type; ?>
            });

            s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
			<?php endif; ?>
        </script>

		<?php

	endwhile;
	?>
	<?php
	wp_reset_query();
	wp_reset_postdata();

}


add_action( 'wp_ajax_nopriv_more_data', 'sd_more_data' );
add_action( 'wp_ajax_more_data', 'sd_more_data' );

function sd_more_data_aux($args){

	$query = new WP_Query($args);

	while ($query->have_posts()) :
		//$counter = 1;
		$query->the_post();
		$fields = get_fields();
		$title = $fields["title"];
		$category = $fields["category"];
		$fieldz = get_field_object('category');
		$value = get_field('category');
		$categorylbl = $fieldz['choices'][$value];
		$shortDesc = $fields["short_description"];
		$viewLink = $fields["sop_link"];
		$post_type = get_post_type();
		$dateDay = get_the_modified_date('d');
		$dateMonth = get_the_modified_date('M');
		$author_id = get_the_author_meta('ID');
		$date = get_the_modified_date("dmY");
		$id = get_the_ID();

		$color = '';
		if($category == 'newsletter'){
			$color = 'n_turquoise';
		}elseif($category == 'gm'){
			$color = 'n_blue';
		}elseif($category == 'notefromthesg'){
			$color = 'n_purple';
		}elseif($category == 'pressrelease'){
			$color = 'n_green';
		}
		?>
        <li class="news_item_wrapper red <?=$color;?> news_item_show">
            <!-- n_turquoise, n_blue, n_green, n_purple, depending of the category of the news -->
            <a class='news-holder' href="<?php echo get_the_permalink() ?>">
                <div class="n_data">
                    <span class="n_data_day"><?php echo $dateDay ?></span>
                    <span class="n_data_month"><?php echo $dateMonth ?></span>
                </div>
                <div class="n_content">
                    <div class="n_cat_wrapper">
<!--                        <span class="n_cat">--><?//=$categorylbl;?><!--</span>-->
                    </div>
                    <span class="n_title"><?php the_title();?></span>
                    <span class="n_shortDesc"><?=$shortDesc;?></span>
                </div>
            </a>
        </li>
		<?php
	endwhile;

	wp_reset_query();
	wp_reset_postdata();
}

function sd_more_data(){

	$page = $_POST['paged'] ? $_POST['paged'] : 1;
	$display_count = 5;
	$fromHomepage = $_POST['fromHomepage'] ? $_POST['fromHomepage'] : false;

	$offset = ( $page - 1 ) * $display_count ;

	$meta = [];
	// ZD-6259
	//if($fromHomepage){
	//	$meta = [[
	//		'key' => 'category',
	//		'value' => 'pressrelease',
	//		'compare' => '!='
	//	]];
	//}
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

	wp_die();
}

