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
$userType = '';
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
				<div class="logo_wrapper" style='width: 100%'>
					<a href="<?= home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo_mini_header.svg" alt="IPU" class="logo_header"></a>
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

            <header>
                <div id="header">

                    <div class="logo_wrapper">
                        <a href="<?= home_url(); ?>" title=""><img src="<?php bloginfo('template_directory'); ?>/img/logo_header.svg" alt="IPU" class="logo_header"></a>
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

                        <!---<div class="user_menu">
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

                        </div>--->
                    <?php } ?>
                </div>
            </header>

            <?php 

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


			<div id="main" class="site-main">