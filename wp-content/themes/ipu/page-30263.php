<?php
/**
 * The Template for > Recruitment Landing Page
 *
 */

  $empty_header_text = true;
  get_header();

  // CONFIG:start
  $recruitment_list_url = home_url('/recruitment-list');
  $position_type_key = 'field_5c1be88233c29';
  $county_key = 'field_5c1be91933c2a';
  $start_at_key = 'field_5c1be9f06cbd1';
  // CONFIG:end

  if (strpos(get_site_url(), 'staging.wpengine') !== false) {
    $position_type_key = 'field_5c1d03c0ef3a3';
    $county_key = 'field_5c1d03eeef3a4';
    $start_at_key = 'field_5c1d0433ef3a6';
  }

  if (strpos(get_site_url(), 'ie') !== false) {
    $position_type_key = 'field_5c41cef2351de';
    $county_key = 'field_5c41cf10351df';
    $start_at_key = 'field_5c41cf39351e1';

    // $field_key_pharmacy = 'field_5c41cebe351dc';
    // $field_key_duration = 'field_5c41cee2351dd';
    // $field_key_position_time = 'field_5c41cef2351de';
    // $field_key_county = 'field_5c41cf10351df';
    // $field_key_location = 'field_5c41cf2f351e0';
    // $field_key_start_at = 'field_5c41cf39351e1';
    // $field_key_name = 'field_5c41cf6d351e3';
    // $field_key_email = 'field_5c41cf7d351e4';
    // $field_key_phone = 'field_5c41cf8b351e5';
    // $field_key_date_start = 'field_5c41cfa7351e7';
    // $field_key_date_end = 'field_5c41cfc4351e8';
  }


  $id = get_the_ID();
  $shortDesc = get_field('short_description', $id);
  $testimonial_icon_url = get_bloginfo('template_directory') . '/img/testimonial-icon.png';
  $fields = get_fields();

  $options_position_types = get_field_object($position_type_key)['choices'];
  $options_counties = get_field_object($county_key)['choices'];

  $today = date('Ymd');
	$current_openings_args = array(
    'posts_per_page' => 4,
    'post_status' => array('publish'),
		'post_type' => array('recruitment'),
		'orderby' => 'publish_start',
    'order' => 'DESC',
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'publish_start_at',
        'value' => $today,
        'compare' => '<=',
      ),
      array(
        'key' => 'publish_end_at',
        'value' => $today,
        'compare' => '>=',
      ),
    ),
	);
?>

<script>
  !function (f, b, e, v, n, t, s) {
    if (f.fbq) return; n = f.fbq = function () {
      n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
    n.queue = []; t = b.createElement(e); t.async = !0;
    t.src = v; s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
  }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

  fbq('init', '374717969977156');
  fbq('track', 'PageView');
</script>

<noscript>
  <img height="1" width="1" src="https://www.facebook.com/tr?id=374717969977156&ev=PageView&noscript=1" />
</noscript>

<style>
  .collapse__body {
    overflow: hidden;
    transition: height .15s;
  }

	/* Common */
  .color-white { color: white; }
  .color-violet { color: #b398c3; }
  .color-green { color: #85bd34; }
	.bg-color-white { background-color: white; }
	.bg-color-light-gray { background-color: #e1e1e1; }
	.bg-color-gray { background-color: gray; }
	.bg-color-violet { background-color: #b398c3; }
	.bg-color-red { background-color: #e74342; }
	.bg-color-green { background-color: #85bd34; }
	.bg-color-light-green { background-color: #8fc6af; }
	.bg-color-light-yellow { background-color: #fcb84d; }
	.bg-color-dark-blue { background-color: #5c5a67; }
  .three-columns > div { width: 33%; float: left; }

  .clearfix:before, .clearfix:after {content: " "; display: table; }
  .clearfix:after { clear: both; }

  /* Header */
  .hero_wrapper.empty_header_text .title_wrapper,
  .hero_wrapper.empty_header_text .breadcrumbs_wrapper
  .hero_wrapper.empty_header_text .hero_breadcrumbs{
    display: none !important;
  }

	/* Sidebar */
	.sb_single_item .sb_txt { border-bottom: none; }

  #content_wrapper .box_wrapper {
    overflow: inherit !important;
  }

	/* Content Navegation */
	.content .box_nav ul {
		display: block;
		list-style: none;
		width: 100%;
	}
	.content .box_nav ul li {
		float: left;
		width: 33.3%;
	}
	.content .box_nav ul li a {
		display: block;
		width: 100%;
		padding: 18px 0;
		text-align: center;
		font-size: 14px;
		color: white;
	}
	.content .box_nav ul li a:hover {
		font-weight: bold;
  }

  .box_inside_overwrite{
    background-color: transparent;
    display: block;
    overflow: hidden;
    position: relative;
    top: 0px;
    left: 0px;
    z-index: 99;
    height: 100% !important;
  }

  /* Box2 */
  .box2 { display:block; padding: 40px 50px; }
  .box2 h3 {
    font-size: 22px;
  }
  .box2 h4 {
    float: none;
    padding: 0;
    font-size: 14px;
    margin-bottom: 5px;
    color: gray;
  }
  .box2.--big p { font-size: 20px; line-height: 26px; }
  .box2.--big2 p { font-size: 24px; line-height: 26px; font-weight: 400; }
  .box2 p {
    font-size: 14px;
    line-height: 20px;
  }

  /* box2-icons & azicon-item */
  .box2-icons { margin-bottom: 30px}
  .azicon-item { margin-top: 20px; }
  .azicon-item .icon { text-align: center; padding: 14px 0; }
  .azicon-item .icon img { height: 60px;}
  .azicon-item h3 { text-align: center; font-size: 16px; }
  .azicon-item p { text-align: center; font-size: 13px; padding: 0 5px;}

  /* box2-divide */
  .box2-divide > div { width: 50%; padding: 50px; height: 362px;}
  .box2-divide div.box2-faqs { height: auto; border-top: 1px solid #e2e2e2;}
  .box2-divide .color-white h3 { color: white }
  .box2-divide .color-white h4 { color: white }
  .box2-divide .left { float: left }
  .box2-divide .right { float: right }
  .box2-divide .bg-image-cover { background-size: cover; background-position: center; }
  .box2-divide h3 {
    line-height: 20px;
    margin-bottom: 14px;
  }
  .box2-divide h4 {
    color: gray;
    font-size: 13px;
    margin-bottom: 8px;
  }
  .box2-divide p {
    font-size: 14px;
    line-height: 20px;
  }

  /* FAQs */

  .box2-faqs h3 {
    margin-bottom: 15px;
  }

  .box2-faqs .faq-item {
    padding-bottom: 10px;
    border-bottom: 1px solid #e1e1e1;
  }

  .box2-faqs .faq-item:first-child {
    border-top: 1px solid #e1e1e1;
  }

  .box2-faqs .faq-item:last-child {
    /* border-bottom: none; */
  }

  .box2-faqs .faq-item .faq-title{
    background-position: right center;
    background-repeat: no-repeat;
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_select.svg);
    cursor: pointer;
    font-size: 19px;
    text-transform: uppercase;
    font-weight: bold;
    padding: 12px 30px 0 0;
  }

  .box2-faqs .faq-item .faq-content p{
    margin-bottom: 6px;
  }

  .box2-faqs .faq-item .faq-title.open{
    cursor: auto;
    padding-bottom: 12px;
  }

  .box2-faqs .faq-item .faq-title.open ~ div {
  }

  /* Testimonials */
  .box2-testimonials {
    border-top: 1px solid #e1e1e1;
  }

  .box2-testimonials #tt-slider > div {
    position: absolute;
    z-index: 2;
    left: 100%;
    top: 0px;
  }

  .box2-testimonials .tt-item{
    padding: 20px 0 0 30px;
  }

  .box2-testimonials .tt-item .tt-item-quote img{ height: 100% }
  .box2-testimonials .tt-item .tt-item-quote {
    height: 60px;
    position: absolute;
    top: 0px;
    left: 0;
  }

  .box2-testimonials .tt-item .tt-item-profile{
    float: left;
    width: 115px;
    height: 115px;
    margin-right: 20px;
    border-radius: 115px;
    background-color: #dfdfdf;
    background-size: cover;
    background-position: center center;
  }
  .box2-testimonials .tt-item .tt-item-profile img{
    height: 100%;
  }

  .box2-testimonials .tt-item .tt-item-content {
    padding: 15px 0 0 15px;
  }

  .box2-testimonials .tt-item p{
    font-size: 22px;
    font-style: italic;
    line-height: 25px;
    color: gray;
  }

  .box2-testimonials .tt-item .author{
    color: gray;
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 16px;
  }

  .box2-testimonials #tt-slider {width:100%; height:160px;}

  .box2-testimonials .slider-bullets { text-align: center; }
  .box2-testimonials .slider-bullets li {
    cursor: pointer;
    display: inline-block;
    width: 14px;
    height: 14px;
    border-radius: 14px;
    background-color: #ccc;
    margin-right: 3px;
  }

  .box2-testimonials .slider-bullets li.current {
    background-color: #85bd34;
  }

  /* Current Openings */
  .box2-openings {
    padding-top: 50px;
    padding-bottom: 50px;
    text-align: center;
  }

  .box2-openings .jobs {
    margin-top: 20px;
  }

  .box2-openings .jobs-button {
    cursor: pointer;
    display: inline-block;
    margin-top: 25px;
    border-radius: 4px;
    border: 2px solid #5c5a67;
    color: #5c5a67;
    font-size: 14px;
    padding: 8px 20px;
    text-align: center;
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_rightarrow_grey.svg);
    background-repeat: no-repeat;
    background-position: center right 7px;
    padding-right: 30px;
  }

  .box2-openings .jobs .job-item{
    display: block;
    float: left;
    width: 23.5%;
    background-color: white;
    margin-left: 2%;
  }

  .box2-openings .jobs .job-item:first-child{
    margin-left: 0;
  }

  .box2-openings .jobs .job-item .ji-header{
    display: table;
    height: 86px;
    vertical-align: middle;
    border-bottom: 1px solid #85bd34;
    text-transform: uppercase;
    font-size: 18px;
    font-weight: bold;
    line-height: 20px;
    width: 100%;
  }

  .box2-openings .jobs .job-item .ji-header > div{
    display: table-cell;
    margin: 0;
    vertical-align: middle;
  }

  .box2-openings .jobs .job-item .ji-type{
    display: block;
    font-size: 13px;
    padding: 12px 0;
    border-bottom: 1px solid #e1e1e1;
    text-transform: uppercase;
    color: gray;
  }


  .box2-openings .jobs .job-item .ji-content{
    padding: 17px 0 12px;
  }

  .box2-openings .jobs .job-item .ji-content li{
    display: block;
    font-size: 13px;
    margin-bottom: 4px;
  }

  .box2-openings .jobs .job-item .ji-content li span{
    font-weight: bold;
  }

  .box2-openings .jobs .job-item .ji-button{
    padding: 4px;
  }

  .box2-openings .jobs .job-item .ji-button a{
    display: block;
    border-radius: 3px;
    width: 100%;
    font-size: 14px;
    padding: 10px 0;
    background-color: #85bd34;
    color: white;
    text-transform: uppercase;
  }

  /* Stay Up To Date */
  .box2-stay-up-to-date {
    text-align: center;
    padding-top: 50px;
    padding-bottom: 50px;
  }
  .box2-stay-up-to-date h3 {}
  .box2-stay-up-to-date p {margin: 30px 0 24px;}
  .box2-stay-up-to-date form .field { float: left; padding-right: 5px}
  .box2-stay-up-to-date form .field input { width: 100%; border: none; padding: 12px 4px 12px 10px;}
  .box2-stay-up-to-date form .field button { width: 100%; border: none; padding: 12px 0;}
  .box2-stay-up-to-date form .field.--firstname { width: 20%; }
  .box2-stay-up-to-date form .field.--email { width: 50%; }
  .box2-stay-up-to-date form .field.--button {  width: 30%; padding-right: 0;}

  .box_nav li {
    height: 64px;
  }

  .box_nav li.bg-color-violet a,
  .box_nav li.bg-color-red a {
    padding-top: 25px !important;
  }



  @media (max-width: 970px) {
    .box2-openings .jobs .job-item{
      width: 46%;
      margin-right: 2%;
      margin-left: 0;
      margin-bottom: 16px;
    }
    .box2-openings .jobs .job-item:first-child{
      margin-left: 0;
    }
    .box2-testimonials .tt-item .author {
      margin-top: 6px;
    }

    .right.box2-faqs{
      padding: 0 18px 18px;
      border-top: 0;
    }
  }

  @media (max-width: 520px) {
    .box2 .three-columns > div {
      width: 100%;
    }
    .box2-divide .left,
    .box2-divide .right{
      width: 100%;
      margin-right: 0;
      float: none;
      height: inherit;
    }
    .box2-divide .bg-image-cover{
      height: 200px !important;
    }
    .right.box2-faqs{
      padding: 0 18px 18px;
      border-top: 0;
    }
    .box2-testimonials .tt-item .tt-item-profile{
      display: none;
    }
    .box2-testimonials .tt-item .tt-item-content p{
      font-size: 14px;
    }
    .box2-testimonials .tt-item .author {
      margin-bottom: 6px;
    }
    .box2-testimonials .slider-bullets{
      margin-top: 20px;
    }
    .box2-openings .jobs .job-item{
      width: 100%;
      margin-left: 0;
      margin-bottom: 16px;
    }
    .box2-openings .jobs .job-item:first-child{
      margin-left: 0;
    }
  }

</style>

<article id="content_wrapper" class="<?=$id;?>">
  <aside class="sidebar sb_single_item two_column">
    <?php if(!empty($shortDesc)){?>
      <div class="sb_txt"><?= $shortDesc; ?></div>
    <?php } ?>
  </aside>

	<div class="content lp_content eight_column blank_page">

      <div class="box_nav">
				<ul>
					<li class="bg-color-violet"><a href="#FAQS">FAQS</a></li>
					<li class="bg-color-red"><a href="#testimonials">TESTIMONIALS</a></li>
					<li class="bg-color-light-green"><a href="#openings">CURRENT<br/>OPENINGS</a></li>
				</ul>
			</div>

      <script>
        var navItems = document.querySelectorAll('.box_nav li a')
        for (var nI=0; nI<navItems.length; nI++) {
          navItems[nI].addEventListener('click', function(e) {
            e.preventDefault();
            var href = this.getAttribute("href");
            var elmnt = document.getElementById(href.substr(1, href.length));
            elmnt.scrollIntoViewIfNeeded()
          })
        }
      </script>

			<div class="box_wrapper box_huge">
        <div class="box_inside_overwrite">

          <div class="box2 --big bg-color-white">
            <h4 class="color-gray">COMMUNITY PHARMACY IRELAND</h4>
            <h3 class="color-green">MAKING A DIFFERENCE IN THE COMMUNITY</h3>
          </div>

          <div class="box2 --big2 bg-color-violet color-white">
            <p>Community Pharmacists are at the heart of every city, town and village. They are valued healthcare providers who build customer relationships and help communities thrive.</p>
          </div>

          <div class="box2 bg-color-white">
            <p>Ireland is the ideal place to work as a Community Pharmacist with over 1,800 community pharmacies to choose from and 85 million visits each year, pharmacists are the first port of call within our healthcare system.</p>
          </div>

          <div class="box2 box2-icons bg-color-white">
            <h3 class="color-violet">Why Community Pharmacy in Ireland?</h3>
            <div class="three-columns clearfix">
              <div class="azicon-item">
                <div class="icon"><img src="<?php bloginfo('template_directory'); ?>/img/schedule-2x.png"></div>
                <h3>FLEXIBLE SCHEDULE</h3>
                <p>Community pharmacies are open mornings, evenings, weekdays and weekends, (because unlike other countries, we don’t have any 24-hour pharmacies), allowing you to choose working hours that suit your lifestyle.</p>
              </div>
              <div class="azicon-item">
                <div class="icon"><img src="<?php bloginfo('template_directory'); ?>/img/location-2x.png"></div>
                <h3>CHOOSE YOUR LOCATION</h3>
                <p>From idyllic villages to stunning coastlines to bustling cities, Ireland has it all. Pharmacies are located in almost every village, town and city in ireland, which means the choice is yours.</p>
              </div>
              <div class="azicon-item">
                <div class="icon"><img src="<?php bloginfo('template_directory'); ?>/img/salary-2x.png"></div>
                <h3>COMPETITIVE SALARY</h3>
                <p>In comparison to many other EU States, pharmacists in Ireland are well paid, with competitive salaries and benefits packages.</p>
              </div>
            </div>
          </div>

          <!-- BOX WITH IMAGE 1 -->
          <div class="box2-divide clearfix">
            <div class="left bg-color-violet color-white">
              <h4>WHAT IS COMMUNITY PHARMACY?</h4>
              <h3>ONE-TO-ONE ADVICE</h3>
              <p>Community pharmacists play a vital role within their communities and the primary healthcare system, offering one-to-one advice and health services, such as seasonal flu vaccinations, blood pressure measurement, cholesterol testing and smoking cessation support.</p>
            </div>
            <div class="right bg-image-cover bg-color-light-gray" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/community.jpg)"></div>
          </div>

          <!-- BOX WITH IMAGE 2 -->
          <div class="box2-divide clearfix">
            <div class="right bg-color-white">
              <h4>WORKING ON THE EMERALD ISLE</h4>
              <h3 class="color-violet">WHY WORK IN IRELAND?</h3>
              <p>Ireland is rated as the 14th happiest country in the world, ahead of the UK, USA, France and Germany. Famous for its warm welcome, friendly people, beautiful scenery and great atmosphere, Ireland is an energetic, thriving country that's just a short journey away from the UK and Europe.</p>
            </div>
            <div class="left bg-image-cover bg-color-light-gray" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/why-ireland.jpg)"></div>
          </div>

          <!-- BOX WITH IMAGE 3 -->
          <div class="box2-divide clearfix">
            <div class="left bg-color-green color-white">
              <h4>MAKING A DIFFERENCE EVERY DAY</h4>
              <h3>community pharmacists</h3>
              <p>Over 90% of people trust their pharmacist and favour their advice. As the most accessible part of the healthcare system, Community Pharmacists provide vital support and encourage healthy lifestyles within their communities.</p>
            </div>
            <div class="right bg-image-cover bg-color-light-gray" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/community-2.jpg)"></div>
          </div>

          <!-- BOX WITH IMAGE 4 -->
          <div class="box2-divide clearfix">
            <div class="right">
              <h4>WORK-LIFE BALANCE</h4>
              <h3 class="color-violet">pharmacists</h3>
              <p>Becoming a Pharmacist in Ireland offers flexibility, work-life balance and competitive remuneration. In some locations, longer pharmacy opening hours provide an opportunity to manage working hours around your lifestyle needs.</p>
            </div>
            <div class="left bg-image-cover bg-color-light-gray" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/work-life-balance.jpg)"></div>
          </div>

          <!-- BOX FAQ -->
          <div id="FAQS" class="box2-divide clearfix">
            <div class="left">
              <h3 class="color-violet">FREQUENTLY ASKED QUESTIONS.</h3>
            </div>
            <div class="right box2-faqs">
              <?php foreach($fields['faqs'] as $faq): ?>
                <!-- faq-item:start -->
                <div class="faq-item">
                  <div class="faq-title collapse__header"><?php echo $faq['title'] ?></div>
                  <div class="faq-content collapse__body">
                    <?php echo $faq['body'] ?>
                  </div>
                </div>
                <!-- faq-item:end -->
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Scripts -->
          <script src="<?php bloginfo('template_directory'); ?>/js/collapsejs.min.js"></script>
          <script type="text/javascript">
            new collapsejs
          </script>

          <!-- BOX TESTIMONIALS -->
          <div id="testimonials" class="box2 box2-testimonials">
              <!-- tt:slider:start -->
              <div id="tt-slider">
                <?php foreach($fields['testimonials'] as $testimonial): ?>
                <!-- tt-item:start -->
                <?php $tt_image = (isset($testimonial['image']) && $testimonial['image'] != '') ? $testimonial['image'] : $testimonial_icon_url; ?>
                <div>
                  <div class="tt-item">
                    <div class="tt-item-quote"><img src="<?php bloginfo('template_directory'); ?>/img/quote-2x.png" /></div>
                    <div class="tt-item-profile" style="background-image: url(<?php echo $tt_image ?>);"></div>
                    <div class="tt-item-content">
                      <p><?php echo $testimonial['message'] ?></p>
                      <div class="author"><?php echo $testimonial['author'] ?></div>
                    </div>
                  </div>
                </div>
                <!-- tt-item:start -->
                <?php endforeach; ?>
              </div>
              <!-- tt:slider:end -->

              <div class="slider-bullets">
                <?php foreach($fields['testimonials'] as $key => $testimonial): ?>
                  <li class="<?php echo intval($key) === 0 ? 'current' : '' ?>" data-index="<?php echo $key ?>"></li>
                <?php endforeach; ?>
              </div>
          </div>

          <script src="<?php bloginfo('template_directory'); ?>/js/simpleslider.js"></script>
          <script type="text/javascript" charset="utf-8">
            $(window).load(function() {
              var slider = simpleslider.getSlider({
                container: document.getElementById('tt-slider'),
                paused: true,
                prop: 'opacity',
                unit: '',
                init: 0,
                show: 1,
                end: 0
              });

              function bulletSelected(index) {
                var bullets = document.querySelectorAll('.slider-bullets li');
                var b_index = 0;
                for(var bullet of bullets) {
                  if(b_index === Number(index)) {
                    bullet.classList.add('current');
                  } else {
                    bullet.classList.remove('current');
                  }
                  b_index++;
                }
              }

              function bulletEvents() {
                var bullets = document.querySelectorAll('.slider-bullets li');
                var b_index = 0;
                for(var bullet of bullets) {
                  b_index++;
                  bullet.addEventListener("click", function (e) {
                    e.target.classList.toggle('active');
                    bulletSelected(e.target.attributes['data-index'].value)
                    slider.change(e.target.attributes['data-index'].value);
                  })
                }
              }

              bulletEvents();
            });
          </script>

          <!-- BOX CURRENT OPENINGS -->
          <div id="openings" class="box2 box2-openings bg-color-light-gray">
              <h3>CURRENT OPENINGS</h3>
              <!-- jobs:start -->
              <div class="jobs clearfix">
                <?php
                  $query = new WP_Query($current_openings_args);
                  while ($query->have_posts()) :
                    $query->the_post();
                    $fields = get_fields();

                    $recru = [
                      "title" => get_the_title(),
                      "pharmacy" => $fields['pharmacy'],
                      "contact_name" => $fields['contact_name'],
                      "contact_email" => $fields['contact_email'],
                      "contact_phone" => $fields['contact_phone'],
                      "position_type" => $options_position_types[$fields['position_type']],
                      "location" => $fields['location'],
                      "county" => $options_counties[$fields['county']],
                      "duration" => $fields['duration'],
                      "start_at" => date("d/m/Y", strtotime($fields['start_at'])),
                    ];

                    $gi_classes = ["gi_recruitment"];
                    $gi_classes[] = "gi_" . $fields['position_type'];
                    $gi_classes[] = "gi_" . $fields['county'];
                    $gi_classes = implode(" ", $gi_classes);
                ?>
                <!-- ITEM:start -->
                <div class="item job-item <?php echo $gi_classes ?>">
                  <div class="ji-header"><div><?php echo $recru['title'] ?></div></div>
                  <div class="ji-type"><?php echo $recru['position_type'] ?></div>
                  <div class="ji-content">
                    <li><span>Start date: </span><?php echo $recru['start_at'] ?></li>
                    <li><span>Location: </span><?php echo $recru['location'] . ', ' . $recru['county'] ?></li>
                    <li><span>Duration: </span><?php echo $recru['duration'] ?></li>
                  </div>
                  <div class="ji-button">
                    <a href="<?php echo get_permalink(get_the_ID()); ?>">
                      More Info
                    </a>
                  </div>
                </div>
                <!-- ITEM:end -->
                <?php endwhile; wp_reset_query(); wp_reset_postdata(); ?>
              </div>
              <!-- jobs:end -->

              <a class="btn jobs-button" href="<?php echo $recruitment_list_url ?>">View All Positions</a>
          </div>

      </div> <!-- .box_wrapper:end !-->
  </div>
</article>



<?php
get_footer();
