<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<script>alert("This website does not support anything less than IE 9, please update");</script>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<script>alert("This website does not support anything less than IE 9, please update");</script>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->

<!--Version 1.0.0-->

<?
//turn off all php errors - temporarily.
error_reporting(-1);

//Test The Membership S2 Functions...

//This method checks which Role the user has. Depending on the role
//allow them to do/see different things on the page, or redirect them.
if(current_user_is('administrator')){//Admin
	$userType = "Administrator";
}elseif(current_user_is('s2member_level1')){//CE
	$userType = "Employee";
}elseif(current_user_is('s2member_level2')){//CP
	$userType = "Pharmacist";
}else{//Guest - non registered
	$userType = null;
}



global $empty_header_text;
$empty_header_class = (isset($empty_header_text) && $empty_header_text) ? "empty_header_text" : "";

?>
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta name="google-site-verification" content="aJH5ClHe3_ZTlyECdF_dgSLn8KlwpKOWa144HwSLsns" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />

    <title><?php wp_title('|', true, 'right'); ?> </title>
    <!-- alsd 051016-1400-->
    <!-- Open Sans Font -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,300italic' rel='stylesheet' type='text/css'>
    <link rel="profile" href="//gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
	<?php wp_head(); ?>
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/img/favicon/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/img/favicon/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#00a300" />
    <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/img/favicon/mstile-144x144.png" />
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css?v1.7">
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/store-locator-fix.css?v1.05">
    <script src="<?php bloginfo('template_directory'); ?>/js/modernizr.js"></script>
    <script>
        Modernizr.load({
            test: Modernizr.input.placeholder,
            nope: '<?php bloginfo('template_directory'); ?>/js/placeholder.js'
        });
    </script>
    <script src="<?php bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/pace.min.js"></script>
    <script src="<?php bloginfo('template_directory'); ?>/js/jQuery.succinct.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>


    <style>

        #main_img #main_menu_hero .mm_menu li .sub-menu.show-menu{
            opacity: 1;
            visibility: visible;
            z-index: -1;
        }

        #main_img #main_menu_hero .mm_menu li .sub-menu{
            z-index: -11;
        }

        .mk_main #mk_home_main_menu .mkm_menu li .sub-menu.show-menu{
            opacity: 1;
            visibility: visible;
            z-index: -1;
        }

        .mk_main #mk_home_main_menu .mkm_menu li .sub-menu{
            z-index: -11;
        }


        .grid_post .gi_training{

            height: 250px;

        }

        .grid_post .gi_training_show, .slider_event .gi_training_show{

            height: auto;

        }
        /* .item, .item > .inner {
		  float: left;
		  width: 320px;
		  height: 320px;
		  margin: 10px;
		  }

		 .item, .item > .inner.expanded {
			height: 500px;
		  }




		.item > .inner {
		  margin: 0;
		  background-color: #bbb;
		  text-align: center;
		  position: relative;
		}
		.item > .inner.expanded {
			background-color: #327ccb;
			color: #fff;
		  }

		 .item > .inner span {
			display: inline-block;
			position: absolute;
			width: 50px;
			height: 50px;
			left: 50%;
			top: 50%;
			margin-left: -25px;
			margin-top: -25px;
			line-height: 50px;
			font-size: 22px;
		  }*/



        /**** Isotope CSS3 transitions ****/

        /*.isotope,
		.isotope .isotope-item {
		  -webkit-transition-duration: 0.8s;
			 -moz-transition-duration: 0.8s;
				  transition-duration: 0.8s;

		}

		.isotope {
		  -webkit-transition-property: height, width;
			 -moz-transition-property: height, width;
				  transition-property: height, width;
		}

		.isotope .isotope-item {
		  -webkit-transition-property: -webkit-transform, opacity;
			 -moz-transition-property:    -moz-transform, opacity;
				  transition-property:         transform, opacity;
		}*/




    </style>


	<?php if (is_page(830)) { ?>
        <!--<script src="http://code.jquery.com/jquery-1.8.2.js"></script>-->
        <script src="//code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
        <style>
            .si_section_content #tabs .n_content_same_height{overflow-y: scroll;}
        </style>
	<?php } ?>
	<?php
	$thank_you_page = is_page(1037);
	?>
	<?php if (is_page(832)) { ?>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/colorbox.css" />
	<?php } ?>

	<?php if(is_page(5035)){?>
        <style>
            .moodle-wrap
            {
                width    : 500px;
                height   : 200px;
                overflow : hidden;
                position : relative;
            }

            #moodle
            {
                position : absolute;
                top: -460px;
                left: -500px;
                width    : 1280px;
                height   : 1200px;
            }
        </style>
	<?php }?>
</head>

<body <?php body_class(); ?>>
<?php
$customPostType = $post->post_type;
$parent_page = $post->ipu_page;
$parent_section = $post->ipu_section;

if(!$parent_page) {
	$parent_page = $post->ID;
}
?>
<div id="page" class="hfeed site">
	<?php if (get_header_image()) : ?>
        <div id="site-header">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="">
            </a>
        </div>
	<?php endif; ?>
	<?php
	/* -------------------------------------
     * --------  mobile header -------------
      ------------------------------------- */
	?>

	<?php if (!is_user_logged_in()) { ?>
    <header id="header_scroll" class="reg">
		<?php }else{ ?>
        <header id="header_scroll" class="">
			<?php } ?>
            <div class="logo_wrapper">
                <a href="<?= home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header.svg" alt="IPU" class="logo_header"></a>
            </div>

			<?php
			//****************************************
			//********  Sliding menu toggle **********
			//****************************************
			?>

            <nav class="hs_main_menu">
                <span class="sliding_toggle">menu</span>
            </nav>

			<?php
			//****************************************
			//*********  Mobile main menu ************
			//****************************************
			?>

            <nav class="hs_sub_menu">
				<?php if (is_user_logged_in()) { ?>

					<?php $communicationArr = array(139, 832, 836, 838, 830, 834); ?>
					<?php $businessArr = array(141, 745, 747, 741, 739, 743, 1075, 4759); ?>
					<?php $hseArr = array(145, 730, 737, 735, 733, 818, 957); ?>
					<?php $eventsArr = array(147, 761, 759, 757); ?>
					<?php $directoryArr = array(149, 755, 753, 751, 749); ?>
					<?php $professionalArr = array(84, 89, 172, 174, 240, 256, 176); ?>

					<?php
					// lets add additional ad campaign pages to the communication array
					$query = new WP_Query(array(
						'post_type'  => 'page',  /* overrides default 'post' */
						'meta_key'   => '_wp_page_template',
						'meta_value' => 'template-ad-campaign.php'
					));
					?>
					<?php

					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
							$communicationArr[] = get_the_ID();
						endwhile;
					endif;

					wp_reset_postdata();
					?>
                    <div class="breadcrumbs_wrapper">
						<?php //checking if single page resource
						if(is_search()) { ?>
                            <a href="#header" data-scroll="">Search Results</a>
						<?php }
						else if($parent_page == '89') { ?>
                            <a href="/professional">Professional</a>
							<?php if($parent_page != get_the_ID()) { ?>
                                <a href="/professional/sop-and-guidelines">SOPs and Guidelines</a>
							<?php } ?>
							<?php
							$categorytxtList = ipu_get_custom_field('ipu_categories');
							$giCategoryList = explode(',',$categorytxtList);

							if(count($giCategoryList) > 0) {
								$firstCat = $giCategoryList[0];

								$taxonomyCategories = get_the_terms(89, 'ipu_resource_category');
								foreach($taxonomyCategories as $taxCat) {
									$n = str_replace(' ' , '_', strtolower($taxCat->name));
									if($taxCat->term_id == $firstCat) {
										?>
                                        <a href="/professional/sop-and-guidelines/<?php echo $n ?>"><?php echo $taxCat->name ?></a>
										<?php
										break;
									}
								}
							}
							?>

							<?php
							// lets make sure that there is enough categories to filter by
							$taxonomyCategories = get_the_terms(89, 'ipu_resource_category');

							$ipuCat = get_query_var( 'ipu_cat', '');
							$isCatFound = $ipuCat != '';

							$foundTaxonomy = '';

							if($isCatFound) {
								foreach($taxonomyCategories as $taxCat) {
									$n = str_replace(' ' , '_', strtolower($taxCat->name));
									if($n == $ipuCat) {
										$foundTaxonomy = $taxCat;
										break;
									}
								}

								if($foundTaxonomy != '') {
									?>
                                    <a href="/professional/sop-and-guidelines">SOPs and Guidelines</a>
                                    <a href="#header" data-scroll=""><?php echo $foundTaxonomy->name; ?></a>
									<?php
								}
							}

							if($foundTaxonomy == '') {
								?>
                                <a href="#header" data-scroll=""><?php echo get_the_title(); ?></a>
							<?php } ?>
						<?php } else { ?>
							<?php if($parent_section != '') { ?>
                                <a href="<?php echo get_page_link($parent_section); ?>"><?php echo get_the_title($parent_section); ?></a>
                                <a href="<?php echo get_page_link($parent_page); ?>"><?php echo get_the_title($parent_page); ?></a>
							<?php } else {
								$parentPostId = wp_get_post_parent_id(get_the_ID());
								if($parentPostId) { ?>
                                    <a href="<?php echo get_page_link($parentPostId); ?>" data-scroll=""><?php echo get_the_title($parentPostId); ?></a>
								<?php }
							} ?>
                            <a href="#header" data-scroll=""><?php echo get_the_title(); ?></a>
						<?php } ?>
                    </div>

				<?php } else { ?>
					<?php
					/*********************
					 *
					 * NON MEMBERS SUB MENU
					 *
					 * ***************** */
					?>
				<?php } ?>
            </nav>
            <div id="searchbar_toggle"></div>
			<?php
			//****************************************
			//*********  Mobile search bar ************
			//****************************************
			?>
            <div class="searchbar">
                <form class="search_form" action="<?php echo home_url(); ?>" method="get" role="search">
                    <label>
                        <span class="search_hourglass"></span>

                        <input type="text" class="search_field" placeholder="I'm looking for..." id='s' value="<?php echo wp_specialchars($s, 1); ?>" name="s" title="I'm looking for...">
                        <span class="search_results"></span>
                    </label>

                </form>
            </div>
        </header>
		<?php
		$current_user = wp_get_current_user();
		//profile image url


		// Retrieve The Post's Author ID
		$user_id = $current_user->ID;
		// Set the image size. Accepts all registered images sizes and array(int, int)
		$size = 'thumbnail';

		// Get the image URL using the author ID and image size params
		$imgURL = get_cupp_meta($user_id, $size);


		$profile_img = $imgURL;

		?>



		<?php
		//****************************************
		//********  Sliding menu toggle **********
		//****************************************
		?>

        <nav class="sliding_menu_wrapper">
            <ul class="sliding_menu">
                <span class="sliding_close"></span>
                <div class="menu-main-menu-non-member-mobile-container">

					<?php if (is_user_logged_in()) { ?>
						<?php wp_nav_menu(array('menu' => 'main-menu-mobile', 'menu_class' => 'mm_menu')); ?>
					<?php }else{ ?>
						<?php wp_nav_menu(array('menu' => '29', 'menu_class' => 'mm_menu')); ?>
					<?php } ?>

                </div>
            </ul>
        </nav>



		<?php
		/* -------------------------------------
         * --------  desktop header -------------
          ------------------------------------- */
		?>

		<?php if (is_user_logged_in()) { ?>
            <header>
                <div id="header">

                    <div class="logo_wrapper">
                        <a href="<?= get_permalink(82); ?>" title="">
                            <img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header logo_header_desktop">
                            <img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header.svg" alt="IPU" class="logo_header logo_header_mobile">
                        </a>
                    </div>

					<?php
					//****************************************
					//*********  Sliding menu toggle *********
					//****************************************
					?>

                    <nav class="hs_main_menu mkm_menu">
                        <span class="sliding_toggle">menu</span>
                    </nav>

					<?php
					//****************************************
					//***********  Network menu **************
					//****************************************
					?>
                    <div class="network_menu">
                        <ul>
							<?php wp_nav_menu(array('menu' => 'header-menu', 'menu_class' => 'network_menu_main')); ?>
                            <li class="btn btn_network">More Services
                                <div id="network_popup">
                                    <ul>
										<?php wp_nav_menu(array('menu' => 'header-menu', 'menu_class' => 'network_menu_popup')); ?>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <a href="<?= get_permalink(1656);?>" class="btn btn_darkgrey btn_contact">Contact Us</a>
                    </div>

					<?php
					//*************************************
					//***********  login box **************
					//*************************************


					?>
					<?php if (is_user_logged_in()) { ?>
					<?php
          $defaultPicture = wp_get_attachment_image_src($linkdef, 'full', true);
          $role = ($current_user->roles[0]);
          $hasAccess = in_array($role, ['subscriber', 'administrator', 's2member_level1', 's2member_level2']);
					?>
          <?php if($hasAccess): ?>
            <style> #header .user_menu_open{ height: 193px; } </style>
          <?php endif ?>
                    <div class="user_menu">
                        <div class="um_info">
							<?php if(!empty($profile_img) && ($defaultPicture[0] != $profile_img)){ ?>
                            <div class="um_avatar" style="background-image:url('<?= $profile_img; ?>')" >
								<?php }else{?>
                                <div class="um_avatar" data-attribute="<?=$defaultPicture[0];?>">
									<?php } ?>
                                </div>
                                <div class="um_txt">
                                    <span class="um_name"><?= $current_user->display_name; ?></span>
                                    <!-- <span class="um_usertype"><?= $userType; ?></span> -->
                                </div>
                            </div>
                            <div class="um_nav">
                                <ul class="um_menu         ">
                                    <li class="un_menu_setting"><a href="<?= home_url(); ?>/my-account/">My account</a></li>
                                    <?php if($hasAccess): ?>
                                      <li class="un_menu_setting"><a href="<?= home_url(); ?>/add-job/">Add Job</a></li>
                                    <?php endif ?>
                                    <!-- <li class="un_menu_faq"><a href="<?=  get_permalink(6087);?>" title="FAQ">FAQ</a></li> -->
                                </ul>
                                <a href="<?= wp_logout_url(home_url()); ?>" class="btn btn_logout">Logout</a>
                            </div>
                        </div>

						<?php } else { ?>

                            <div class="user_menu">
                                <div class="um_info">
                                    <div class="">
                                        <form action="<?= site_url() . "/wp-login.php"; ?>" method="post">
                                            <label for="username">Username</label>
                                            <input type="text" name="log" id="user_login" value=""/>
                                            <label for="password">Password</label>
                                            <input type="password" name="pwd" id="user_pass" value=""/>
                                            <input type="submit" value="login"/>
                                        </form>
                                    </div>
                                    <div class="um_txt">

                                    </div>
                                </div>

                            </div>
						<?php } ?>
                    </div>
            </header>


			<?php
			//************************************************
			//***********  Beginning of the hero  ************
			//************************************************
			?>

			<?php

			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', false);
			$thumb_url = $thumb_url_array[0];
			$partentPost = $post->post_parent;

			if ($partentPost) {
				$image_id_parent = get_post_thumbnail_id($partentPost);
				$image_url = wp_get_attachment_image_src($image_id_parent, 'main-img', true);
			} else {
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id, 'main-img', true);
			}

			$featureDefault = site_url() . '/wp-includes/images/media/default.png';
			$feature = $image_url[0];

			if($thumb_url === NULL) {
				$thumb_url = $feature;
			}
			?>

            <article id="main_img" <?php if(is_search()) { ?> class="mi_results" <?php } ?>>

                <div class="hero_wrapper <?php echo $empty_header_class ?>">

					<?php
					//*************************************
					//***********  search bar *************
					//*************************************
					?>
					<?php if (!$thank_you_page) { ?>
                        <div class="searchbar">
                            <form class="search_form" action="<?php echo home_url(); ?>" method="get" role="search">
                                <label>
                                    <span class="search_hourglass"></span>
                                    <input type="search" class="search_field" placeholder="Search" value="" name="s" title="I'm looking for...">
                                    <span class="search_results">42 <b>results</b></span>
                                </label>

                            </form>
                        </div>
					<?php } ?>


                    <nav id="main_menu_hero">
						<?php wp_nav_menu(array('menu' => 'main-menu-mobile', 'menu_class' => 'mm_menu')); ?>
                    </nav>



                    <div class="title_wrapper">
                      <div class="title_content">
                        <div class="top_text">
                          <?php echo get_field('title')?>
                        </div>
                        <div class="bottom_text">
                          <?php echo get_field('sub_title')?>
                        </div>
                      </div>
                      <div class="color_block">
                          <?php
                          if (get_field('color_blocks')):
                              while (have_rows('color_blocks')) : the_row();
                                  ?>
                                <div class="color_block_title" style="background-color: <?php echo get_sub_field('color')?>">
                                  <a href="<?php echo get_sub_field('link')?>"><?php echo get_sub_field('title')?></a>
                                </div>
                              <?php
                              endwhile;
                          endif;
                          ?>
                      </div>
                    </div>
					<?php if (!$thank_you_page) { ?>


					<?php } ?>

                </div>
            </article>
		<?php } else {
		/*************************************************************************************************************
		 *
		 *  ***************************************    UNREGISTERED USERS      ***************************************
		 *
		 ************************************************************************************************************/

		?>
        <header>
            <div id="mk_home_header">
                <div class="logo_wrapper">

                    <a href="<?= site_url() ?>" title="<?php the_title(); ?>">
                        <img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header.svg" alt="IPU" class="logo_header">
                    </a>

                </div>

				<?php
				//****************************************
				//*********  Sliding menu toggle *********
				//****************************************
				?>

                <nav class="hs_main_menu mkm_menu">
                    <span class="sliding_toggle">menu</span>
                </nav>


                <div class="searchbar">
                    <form class="search_form" action="<?php echo home_url(); ?>" method="get" role="search">
                        <label>
                            <span class="search_hourglass"></span>
                            <input type="search" class="search_field" placeholder="Search" value="" name="s" title="Search">
                        </label>

                    </form>
                </div>
                <div class="user_login">
                    <div class="um_info">
                        <div class="um_txt">
                            <span class="um_login"><i>Member </i>Login</span>

                        </div>
                    </div>
                    <div class="um_form">
                        <form method="post" action="<?php print(get_site_url()); ?>/wp-login.php?wpe-login=iputest" id="loginform" name="loginform">
                            <input type="hidden" name="<?php print(TEST_COOKIE); ?>" value="WP Cookie check"/>
                            <input type="hidden" value="<? print(get_home_url()) ?>" name="redirect_to"/>

                            <p class="umf_username">
                                <label for="user_login">
                                    <input type="text" size="20" value="" class="input" id="user_login" name="log" placeholder="Your Username"></label>
                            </p>
                            <p class="umf_password">
                                <label for="user_pass">
                                    <input type="password" size="20" value="" class="input" id="user_pass" name="pwd" placeholder="Your password"></label>
                            </p>
                            <p class="forgetmenot">
                                <input type="checkbox" value="forever" id="rememberme" name="rememberme">
                                <label for="rememberme">Remember Me</label>
                            </p>
                            <p class="submit">
                                <input class="btn " type="submit" value="Log In!" id="wp-submit" name="wp-submit">
                            </p>
                        </form>
                        <p class="lost">
                            <a title="Password Lost and Found" href="<?= site_url() ?>/wp-login.php?action=lostpassword">Lost your password?</a>
                        </p>
                    </div>
                </div>
            </div>
        </header>
		<?php if (!is_page(1200)) { ?>
		<?php if(is_page(574)){ ?>
        <article id="main_img" class="mi_blocked">
			<?php }?>
            <!--					<article id="main_img" class="mk_main mk_page_main_img test-img">-->

			<?php

			$featureDefault = site_url() . '/wp-includes/images/media/default.png';
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'main-img', true);
			$feature = $image_url[0];
			?>
            <article id="main_img" class="mk_main mk_page_main_img classttt" <?php if (($feature != $featureDefault)) { ?><?php } ?>>
                <div class="hero_wrapper <?php echo $empty_header_class ?>">

					<?php }else{?>
                    <article id="main_img" class="mk_main">
                        <div class="hero_wrapper <?php echo $empty_header_class ?>">
							<?php } ?>

							<?php
							/**************************************************************************************************************
							 *
							 * NON MEMBERS - top left menu
							 *
							 *************************************************************************************************************/

							?>
                            <nav id="mk_home_main_menu" <?php if (!is_page(1200)) { ?> class='mk_page_main_menu'<?php } ?>>
                                <div class="logo_wrapper">
                                    <a href="<?= site_url() ?>" title="<?php the_title(); ?>">

                                        <img src="<?php bloginfo('template_directory'); ?>/img/logo_maxi_header.svg" alt="IPU" class="logo_header">

                                    </a>
                                </div>
                                <ul class="mkm_menu">
									<?php wp_nav_menu(array('menu' => 'top-menu-non-members', 'menu_class' => 'mm_menu')); ?>
                                </ul>
                            </nav>
                          <div class="top-image-header">
                            <img src="<?php bloginfo('template_directory'); ?>/img/ipu-web-youngwoman.png" alt="IPU" class="logo_header">
                          </div>
							<?php
              /*
              if (is_page(1200)) { ?>
                                <div class="slider_mk_home" style="overflow: hidden; width: 1474px; height: 600px;"> <!-- start home slider -->
                                    <a class="unslider-arrow next">next</a>
                                    <ul style="width: 200%; position: relative; left: 0%; height: 600px;">
										<?php
										$slider = 'slider';
										//	$download = 'button';

										if (get_field($slider)):
											while (have_rows($slider)) : the_row();
												//$title = get_sub_field('title');
												$legend = get_sub_field('legend');
												$quote = get_sub_field('quote');
												$title_link = get_sub_field('title_link');
												$link = get_sub_field('link');

												$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'main-img', true);
												?>

												<?php if (!empty($picture)) { ?>
                                                    <li class="slide_mk_home" style="width: 50%; background-image: url('<?= $picture[0]; ?>')">
												<?php } else { ?>
                                                    <li class="slide_mk_home" style="width: 50%;">
												<?php } ?>


                                                <div class="slider_content">
                                                    <div class="slider_txt">
                                                        <h1><?= $legend; ?></h1>
                                                        <p><?= $quote; ?></p>
                                                    </div>
                                                    <div class="slider_action">
                                                        <a class="btn" href="<?= $link; ?>" title="<?= $title_link; ?>"><?= $title_link; ?></a>
                                                    </div>
                                                </div>
                                                </li>
												<?php
											endwhile;
										endif;
										wp_reset_query();
										wp_reset_postdata();
										?>
                                    </ul>
                                </div>
							<?php }
              */
              ?>
							<?php if (!is_page(1200)) { ?>
                                <div class="inner_mk_hero_wrapper">
									<?php
									$search = get_search_query();
									if(is_search()) { ?>
                                        <h1> <?php $search; ?> </h1>
                                        <h2>Your search results:  </h2>
									<?php } ?>
                                    <div class="hero_breadcrumbs">
                                        <div class="breadcrumbs_wrapper">
											<?php include('breadcrumbs.php'); ?>
                                        </div>
                                    </div>
                                </div>
								<?php if(is_page(574)){ ?>
                                    <div class="w_title">
                                        <div class="big_thanks"></div>
                                        <h3>Page blocked</h3>
                                        <h2>This content is for contract members of the IPU</h2>
                                    </div>
								<?php } ?>

                                <!-- target the search page -->
								<?php if(is_page(1206)){ ?>
<!--
                                    <div class="rsb_looking_pharmacy">
                                        <h3>Looking for a <i>pharmacy?</i></h3>
                                        <a href="//www.hse.ie/eng/services/maps/" target="_blank" class="btn btn_action_link_grey">Find one now!</a>
                                    </div>
-->
								<?php } ?>






							<?php } ?>
                    </article>
					<?php
					//***********************
					// OLD HEADER
					//***********************
                  /*
					?>
								<header>
									<div id="header">

										<div class="logo_wrapper">
											<a href="<?= home_url(); ?>" title=""><img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header"></a>
										</div>

				<?php
					//****************************************
					//***********  Network menu **************
					//****************************************
					?>
										<div class="network_menu">
											<ul><?php wp_nav_menu(array('menu' => 'header-menu', 'menu_class' => 'ms_menu')); ?></ul>
										</div>

				<?php
					//*************************************
					//***********  login box **************
					//*************************************
					?>
				<?php if (is_user_logged_in()) { ?>
													<div class="user_menu">
														<div class="um_info">
															<div class="um_avatar" style="background-image:url(<?= $profile_img ?>)">

															</div>
															<div class="um_txt">
																<span class="um_name"><?= $current_user->display_name; ?></span>
																<span class="um_usertype"><?= $userType; ?></span>
															</div>
														</div>
														<div class="um_nav">
															<ul class="um_menu">
																<li class="un_menu_setting"><a href="<?= home_url(); ?>/wp-admin/profile.php">My account</a></li>
																<li class="un_menu_faq"><a href="#">FAQ</a></li>
															</ul>
															<a href="<?= wp_logout_url(home_url()); ?>" class="btn btn_logout">Logout</a>
														</div>
													</div>
				<?php } else { ?>

													<div class="user_menu">
														<div class="um_info">
															<div class="">
																<form action="<?= site_url() . "/wp-login.php"; ?>" method="post">
																	<label for="username">Username</label>
																	<input type="text" name="log" id="user_login" value=""/>
																	<label for="password">Password</label>
																	<input type="password" name="pwd" id="user_pass" value=""/>
																	<input type="submit" value="login"/>
																</form>
															</div>
															<div class="um_txt">

															</div>
														</div>

													</div>
				<?php } ?>
				<?php
					//*************************************
					//***********  search bar *************
					//*************************************
					?>


				<?php if (!$thank_you_page) { ?>
													<div class="searchbar">
														<form class="search_form" action="#" method="get" role="search">
															<label>
																<span class="search_hourglass"></span>
																<input type="search" class="search_field" placeholder="I'm looking for..." value="" name="s" title="I'm looking for...">
															</label>

														</form>
													</div>
													<nav id="main_menu">
														<span class="mm_gap"></span>


					<?php wp_nav_menu(array('menu' => 'top-menu-non-members', 'menu_class' => 'mm_menu')); ?>
														<span class="mm_gap mm_gap_last"></span>
													</nav>
				<?php } ?>
									</div>
								</header>
					<?php
          */
					}
					/*			 * ****
                     *
                     * UNREGISTERED USERS END
                     *
                     * ***** */
					?>
                    <script>
                        $('.network_menu').find('.menu-item').addClass('btn btn_header');
                    </script>
					<?php
					$featureDefault = site_url() . '/wp-includes/images/media/default.png';
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id, 'full', true);
					$feature = $image_url[0];
					?>
					<?php
					$id = get_the_ID();


					//$secure = ( 'https' === parse_url( site_url(), PHP_URL_SCHEME ) && 'https' === parse_url( home_url(), PHP_URL_SCHEME ) );
					//$secure_cookie = false;
					//$user = wp_signon( '', $secure_cookie );

					setcookie( TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure );
					if ( SITECOOKIEPATH != COOKIEPATH )
						setcookie( TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure );


					if ( empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) ) {
						if ( headers_sent() ) {
							$user = new WP_Error( 'test_cookie', sprintf( __( '<strong>ERROR</strong>: Cookies are blocked due to unexpected output. For help, please see <a href="%1$s">this documentation</a> or try the <a href="%2$s">support forums</a>.' ),
								__( 'https://codex.wordpress.org/Cookies' ), __( 'https://wordpress.org/support/' ) ) );
						} elseif ( isset( $_POST['testcookie'] ) && empty( $_COOKIE[ TEST_COOKIE ] ) ) {
							// If cookies are disabled we can't log in even with a valid user+pass
							$user = new WP_Error( 'test_cookie', sprintf( __( '<strong>ERROR</strong>: Cookies are blocked or not supported by your browser. You must <a href="%s">enable cookies</a> to use WordPress.' ),
								__( 'https://codex.wordpress.org/Cookies' ) ) );
						}
					}
					?>
                    <script>
                        $(function() {
                            document.cookie = "test_cookie=WP Cookie check";
                            document.cookie = "PHPSESSID=<?php echo session_id() ?>; path=/";

                            var $quickLinksMobile = $(".btn_quick").parents(".quick_link").clone();

                            $quickLinksMobile.addClass("quick_link_mobile");
                            $quickLinksMobile.prepend("<div class='quick_dropdown btn btn_quick'>Quick Links</div>");

                            $quickLinksMobile.appendTo(".title_wrapper");

                            $(".title_wrapper").on("click",".quick_link_mobile",function(){

                                if($(this).hasClass("open"))
                                    $(this).removeClass("open")
                                else
                                    $(this).addClass("open")
                            })

                        });


                    </script>
                    <div id="overlay">
                        <div id="content-overlay-container">
                            <span id="close-overlay"></span>
                            <div id="content-overlay"></div>
                        </div>
                    </div>

                    <div id="main" class="site-main <?=$id;?>">
