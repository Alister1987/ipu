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
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->

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
?>
<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- Mobile viewport optimized: h5bp.com/viewport -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php wp_title('|', true, 'right'); ?></title>

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
		<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css">
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


		<?php if (is_page(830)) { ?>
			<!--<script src="http://code.jquery.com/jquery-1.8.2.js"></script>-->
			<script src="//code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
		<?php } ?>

		<?php
		$thank_you_page = is_page(1037);
		?>

 
	</head>

	<body <?php body_class(); ?>>
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

			<header id="header_scroll" class="">
				<div class="logo_wrapper">
					<a href="<?= home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header.svg" alt="IPU" class="logo_header"></a>
				</div>

				<?php
				//****************************************
				//*********  Mobile main menu ************
				//****************************************
				?>
				<nav class="hs_main_menu">
					<span>menu</span>
					<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'mm_menu')); ?>
				</nav>

				<nav class="hs_sub_menu">
					<?php if (is_user_logged_in()) { ?>

						<?php if ((is_page(139)) || (is_page(832)) || (is_page(836)) || (is_page(838)) || (is_page(830)) || (is_page(834))) { ?>
							<?php wp_nav_menu(array('menu' => 'communications', 'menu_class' => 'ms_menu')); ?>

						<?php } elseif ((is_page(141)) || (is_page(745)) || (is_page(747)) || (is_page(741)) || (is_page(739)) || (is_page(743)) || (is_page(1075))) { ?>
							<?php wp_nav_menu(array('menu' => 'business', 'menu_class' => 'ms_menu')); ?>
						<?php } elseif ((is_page(145)) || (is_page(730)) || (is_page(737)) || (is_page(735)) || (is_page(733)) || (is_page(818)) || (is_page(957))) { ?>
							<?php wp_nav_menu(array('menu' => 'hse-contacts', 'menu_class' => 'ms_menu')); ?>
						<?php } elseif ((is_page(147)) || (is_page(761)) || (is_page(759)) || (is_page(757))) { ?>
							<?php wp_nav_menu(array('menu' => 'Events', 'menu_class' => 'ms_menu')); ?>
						<?php } elseif ((is_page(149)) || (is_page(755)) || (is_page(753)) || (is_page(751)) || (is_page(749))) { ?>
							<?php wp_nav_menu(array('menu' => 'Directory', 'menu_class' => 'ms_menu')); ?>
						<?php } else { ?>
							<?php
							wp_nav_menu(array(
								'menu' => 'category-menu',
								'menu_class' => 'ms_menu'
							));
							?>

						<?php } ?>

					<?php } else { ?>
						<?php
						/*********************
						 * 
						 * NON MEMBERS SUB MENU
						 * 
						 * ***************** */
						?>	
						<?php if ((is_page(1202)) || (is_page(1579)) || (is_page(1604)) || (is_page(1606)) || (is_page(1608))) { ?>
							<?php wp_nav_menu(array('menu' => 'about-ipu-non-member', 'menu_class' => 'ms_menu')); ?>

						<?php } elseif ((is_page(1212)) || (is_page(1601)) || (is_page(1575))) { ?>
							<?php wp_nav_menu(array('menu' => 'contact-non-member', 'menu_class' => 'ms_menu')); ?>

							<?php
						} else {
							
						}
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
					<form class="search_form" action="#" method="get" role="search">
						<label>
							<span class="search_hourglass"></span>

							<input type="text" class="search_field" placeholder="I'm looking for..." id='s' value="<?php echo wp_specialchars($s, 1); ?>" name="s" title="I'm looking for...">
                            <span class="search_results">42 <b>results</b></span>
						</label>
						<input type="submit" class="search_submit" value="Search">
					</form>	
				</div>
			</header>
			<?php
			$current_user = wp_get_current_user();
			//profile image url
			$url = get_field('avatar', 'user_' . $current_user->ID);
			$profile_img = $url['url'];
			?>

			<?php
			/* -------------------------------------
			 * --------  desktop header -------------
			  ------------------------------------- */
			?>

			<?php if (is_user_logged_in()) { ?>
				<header>
					<div id="header">

						<div class="logo_wrapper">
							<a href="<?= get_permalink(82); ?>" title=""><img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header"></a>
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
											A<label for="username">Username</label>
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
                                        <span class="search_results">42 <b>results</b></span>
									</label>
									<input type="submit" class="search_submit" value="Search">
								</form>
							</div>
							<nav id="main_menu">
								<span class="mm_gap"></span>


								<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'mm_menu')); ?>
								<span class="mm_gap mm_gap_last"></span>		
							</nav>
						<?php } ?>
					</div>
				</header>

				<article id="main_img" style="<?php if (($feature != $featureDefault)) { ?><?php } ?>  center center no-repeat;">
					<div class="title_wrapper">

						<?php
						//****************************************
						//*********  show custom title and description for pages: 
						//     homepage(82), Communication(139), Professional(84), Retail(141), HSE Contract(145), Training and events(147), Directory(149) 
						//****************************************
						?>

						<?php if (is_page(82) || is_page(139) || is_page(84) || is_page(141) || is_page(145) || is_page(147) || is_page(149)) { ?>
							<div class="title">
								<h1><?= get_field('title'); ?></h1>
								<h2><?= get_field('short_desc') ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links')):
									if (have_rows('quick_links')):
										while (have_rows('quick_links')) : the_row();
											$title = get_sub_field('title');
											$seo_title = get_sub_field('seo_title');
											$link = get_sub_field('link');
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>

						<?php
						//****************************************
						//*********  show custom title and description from Professional page for subpages: 
						//     SOP and Guidelines(89), Posters and promotions(176), Product File(174), Inspection(172), Vaccination service(240), Legislation(256) 
						//****************************************
						?>

						<?php if (is_page(89) || is_page(176) || is_page(174) || is_page(172) || is_page(240) || is_page(256)) { ?>
							<div class="title">
								<h1><?= get_field('title', 84); ?></h1>
								<h2><?= get_field('short_desc', 84) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', 84)):
									if (have_rows('quick_links', 84)):
										while (have_rows('quick_links', 84)) : the_row();
											$title = get_sub_field('title', 84);
											$seo_title = get_sub_field('seo_title', 84);
											$link = get_sub_field('link', 84);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>


						<?php
						//
						//   show from Directory page
						//
					?>
						<?php if (is_page(751) || is_page(749) || is_page(753) || is_page(755)) { ?>
							<?php $page = '149'; ?>
							<div class="title">
								<h1><?= get_field('title', $page); ?></h1>
								<h2><?= get_field('short_desc', $page) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', $page)):
									if (have_rows('quick_links', $page)):
										while (have_rows('quick_links', $page)) : the_row();
											$title = get_sub_field('title', $page);
											$seo_title = get_sub_field('seo_title', $page);
											$link = get_sub_field('link', $page);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>

						<?php
						//
						//   show from Training and event
						//
					?>
						<?php if (is_page(757) || is_page(759) || is_page(761)) { ?>
							<?php $page = '147'; ?>
							<div class="title">
								<h1><?= get_field('title', $page); ?></h1>
								<h2><?= get_field('short_desc', $page) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', $page)):
									if (have_rows('quick_links', $page)):
										while (have_rows('quick_links', $page)) : the_row();
											$title = get_sub_field('title', $page);
											$seo_title = get_sub_field('seo_title', $page);
											$link = get_sub_field('link', $page);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>

						<?php
						//
						//   show from HSE Contact
						//
					?>
						<?php if (is_page(730) || is_page(733) || is_page(818) || is_page(735) || is_page(957) || is_page(737)) { ?>
							<?php $page = '145'; ?>
							<div class="title">
								<h1><?= get_field('title', $page); ?></h1>
								<h2><?= get_field('short_desc', $page) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', $page)):
									if (have_rows('quick_links', $page)):
										while (have_rows('quick_links', $page)) : the_row();
											$title = get_sub_field('title', $page);
											$seo_title = get_sub_field('seo_title', $page);
											$link = get_sub_field('link', $page);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>		

						<?php
						//
						//   show from BUSINESS
						//
					?>
						<?php if (is_page(1075) || is_page(741) || is_page(739) || is_page(743) || is_page(745) || is_page(747)) { ?>
							<?php $page = '141'; ?>
							<div class="title">
								<h1><?= get_field('title', $page); ?></h1>
								<h2><?= get_field('short_desc', $page) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', $page)):
									if (have_rows('quick_links', $page)):
										while (have_rows('quick_links', $page)) : the_row();
											$title = get_sub_field('title', $page);
											$seo_title = get_sub_field('seo_title', $page);
											$link = get_sub_field('link', $page);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>	

						<?php
						//
						//   show from Communication
						//
					?>
						<?php if (is_page(830) || is_page(832) || is_page(834) || is_page(836) || is_page(838)) { ?>
							<?php $page = '139'; ?>
							<div class="title">
								<h1><?= get_field('title', $page); ?></h1>
								<h2><?= get_field('short_desc', $page) ?></h2>
							</div>
							<div class="quick_link">
								<?php
								if (get_field('quick_links', $page)):
									if (have_rows('quick_links', $page)):
										while (have_rows('quick_links', $page)) : the_row();
											$title = get_sub_field('title', $page);
											$seo_title = get_sub_field('seo_title', $page);
											$link = get_sub_field('link', $page);
											?>
											<a class="btn btn_quick" href="<?= $link; ?>" title="<?= $title; ?>"><?= $title; ?></a>
											<?php
										endwhile;
									endif;
								endif;
								?>
							</div>
						<?php } ?>



					</div>
					<?php if (!$thank_you_page) { ?>

						<nav id="sub_menu">
							<span class="ms_gap"></span>

							<?php if (is_user_logged_in()) { ?>

								<?php if ((is_page(139)) || (is_page(832)) || (is_page(836)) || (is_page(838)) || (is_page(830)) || (is_page(834))) { ?>
									<?php wp_nav_menu(array('menu' => 'communications', 'menu_class' => 'ms_menu')); ?>

								<?php } elseif ((is_page(141)) || (is_page(745)) || (is_page(747)) || (is_page(741)) || (is_page(739)) || (is_page(743)) || (is_page(1075))) { ?>
									<?php wp_nav_menu(array('menu' => 'business', 'menu_class' => 'ms_menu')); ?>
								<?php } elseif ((is_page(145)) || (is_page(730)) || (is_page(737)) || (is_page(735)) || (is_page(733)) || (is_page(818)) || (is_page(957))) { ?>
									<?php wp_nav_menu(array('menu' => 'hse-contacts', 'menu_class' => 'ms_menu')); ?>
								<?php } elseif ((is_page(147)) || (is_page(761)) || (is_page(759)) || (is_page(757))) { ?>
									<?php wp_nav_menu(array('menu' => 'Events', 'menu_class' => 'ms_menu')); ?>
								<?php } elseif ((is_page(149)) || (is_page(755)) || (is_page(753)) || (is_page(751)) || (is_page(749))) { ?>
									<?php wp_nav_menu(array('menu' => 'Directory', 'menu_class' => 'ms_menu')); ?>
								<?php } else { ?>
									<?php
									wp_nav_menu(array(
										'menu' => 'category-menu',
										'menu_class' => 'ms_menu'
									));
									?>

								<?php } ?>

							<?php } else { ?>
								<?php
								/*								 * *******
								 * 
								 * NON MEMBERS SUB MENU
								 * 
								 * ********* */
								?>	
								<?php if ((is_page(1202)) || (is_page(1579)) || (is_page(1604)) || (is_page(1606)) || (is_page(1608))) {  
								 wp_nav_menu(array('menu' => 'about-ipu-non-member', 'menu_class' => 'ms_menu'));  

								  } elseif ((is_page(1212)) || (is_page(1601)) || (is_page(1575))) {  
									  wp_nav_menu(array('menu' => 'contact-non-member', 'menu_class' => 'ms_menu'));  

								 
								} else {
									
								}
							  } ?>


							<span class="ms_gap ms_gap_last"></span>		
						</nav>	
					<?php } ?>

				</article>

				<?php } else {
				/*				 * ****
				 * 
				 * UNREGISTERED USERS
				 * 
				 * *** */
				?>

				<header>
					<div id="mk_home_header"  <?php if (!is_page(1200)) { ?> class='mk_page_header'<?php } ?>>
						<div class="logo_wrapper">	
							<?php if (is_page(1200)) { ?>
							<a href="<?= site_url() ?>" title="<?php the_title(); ?>">
								<img src="<?php bloginfo('template_directory'); ?>/img/logo_maxi_header.svg" alt="IPU" class="logo_header">
							</a>
							<?php } else { ?>
								<a href="<?= site_url() ?>" title="<?php the_title(); ?>">
									<img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header">
								</a>
							<?php } ?>
						</div>

						<div class="searchbar">
							<form class="search_form" action="#" method="get" role="search">
								<label>
									<span class="search_hourglass"></span>
									<input type="search" class="search_field" placeholder="I'm looking for..." value="" name="s" title="I'm looking for...">
								</label>
								<input type="submit" class="search_submit" value="Search">
							</form>
						</div>

						<div class="user_login">
							<div class="um_info">
								<div class="um_txt">
									<span class="um_login">Member Login</span>

								</div>	
							</div>			
							<div class="um_form">
								<form method="post" action="<?= site_url() ?>/wp-login.php" id="loginform" name="loginform">
									B<p class="umf_username">
										<label for="user_login">
											B<input type="text" size="20" value="" class="input" id="user_login" name="log" placeholder="Your Username"></label>
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
										<input class="btn " type="submit" value="Log In" id="wp-submit" name="wp-submit">
										<input type="hidden" value="<?= site_url() ?>/wp-admin/" name="redirect_to">
										<input type="hidden" value="1" name="testcookie">
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
					<article id="main_img" class="mk_main mk_page_main_img">
					
				<?php }else{ ?> 
					
					<article id="main_img" class="mk_main">
					
				<?php } ?> 
				 
					
					<?php
					/********************************
					 * 
					 * NON MEMBERS - top left menu
					 * 
					 * ******************************/
					?>
 		
					<nav id="mk_home_main_menu" <?php if (!is_page(1200)) { ?> class='mk_page_main_menu'<?php } ?>>
						<div class="logo_wrapper">
							<a href="<?= site_url() ?>" title="<?php the_title(); ?>">
								<?php if (!is_page(1200)) { ?>
									<img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header">			
								<?php } else { ?>
									<img src="<?php bloginfo('template_directory'); ?>/img/logo_maxi_header.svg" alt="IPU" class="logo_header">
								<?php } ?>
							</a>
						</div>
						<ul class="mkm_menu">
							<?php wp_nav_menu(array('menu' => 'top-menu-non-members', 'menu_class' => 'mm_menu')); ?>
						</ul>			
					</nav>
					
					
							<?php if (is_page(1200)) { ?>
					
		
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

											$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'full');
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
							<?php } ?>
							
							
			
					<?php if (!is_page(1200)) { ?>
						<nav id="sub_menu">
							<span class="ms_gap"></span>
								<?php
								/*********************
								 * 
								 * NON MEMBERS SUB MENU
								 * 
								 * ****************** */
								?>	
								<?php
									if ((is_page(1202))  ||(is_page(1657))  || (is_page(1579)) || (is_page(1604)) || (is_page(1659)) || (is_page(1606))|| (is_page(1660)) || (is_page(1608)) || (is_page(1661))) {
										wp_nav_menu(array('menu' => 'about-ipu-non-member', 'menu_class' => 'ms_menu'));
									} elseif ((is_page(1212)) ||(is_page(1656)) || (is_page(1601)) || (is_page(1658)) || (is_page(1575))) {
										wp_nav_menu(array('menu' => 'contact-non-member', 'menu_class' => 'ms_menu'));
									}
								?>			
							<span class="ms_gap ms_gap_last"></span>		
						</nav>	
					<?php } ?>
				</article>
		

				<?php
				//***********************
				// OLD HEADER      
				//***********************
				?>
				<!--			
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
																	C<label for="username">Username</label>C
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
															<input type="submit" class="search_submit" value="Search">
														</form>
													</div>
													<nav id="main_menu">
														<span class="mm_gap"></span>
						
						
					<?php wp_nav_menu(array('menu' => 'top-menu-non-members', 'menu_class' => 'mm_menu')); ?>
														<span class="mm_gap mm_gap_last"></span>		
													</nav>
				<?php } ?>
				
									</div>
								</header>-->



				<?php
			}

			/*			 * ****
			 * 
			 * UNREGISTERED USERS END
			 * 
			 * ***** */
			?>

			<script>
			$('.network_menu').find('.menu-item').addClass('btn btn_darkgrey');
			</script>
			<?php
			$featureDefault = site_url() . '/wp-includes/images/media/default.png';
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id, 'full', true);
			$feature = $image_url[0];
			?>

<?php 

$id = get_the_ID();
?>
			<div id="main" class="site-main <?=$id;?>">