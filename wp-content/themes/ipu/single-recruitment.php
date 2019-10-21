
<?php

  $empty_header_text = true;
  get_header();

  // http://www.sharelinkgenerator.com/
  // CONFIG:start
  $recruitment_list_url = home_url('/recruitment-list');
  $page_url = home_url( $wp->request );
  $facebook_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $page_url;
  $twitter_msg = "JOB: {$recru['title']}" . ' - ' . $page_url;
  $twitter_url = 'https://twitter.com/home?status=' . $twitter_msg;
  $linkedin_title = 'Job';
  $linkedin_summary = "Job {$recru['title']}";
  $linkedin_source = 'IPU';
  $linkedin_url = "https://www.linkedin.com/shareArticle?mini=true&url=https://developer.linkedin.com/docs/share-on-linkedin#&title={$linkedin_title}&summary={$linkedin_summary}&source={$linkedin_source}";
  // CONFIG:end

  function getPrevNext(){
    $today = date('Ymd');
    $args = array(
      'numberposts' => -1,
      'post_status' => array('publish'),
      'post_type' => 'recruitment',
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

    $IDS = array();
    foreach (get_posts($args) as $post) {
      $IDS[] += $post->ID;
    }

    $current = array_search(get_the_ID(), $IDS);
    $prevID = $IDS[$current-1];
    $nextID = $IDS[$current+1];

    $prevID = empty($prevID) ? $IDS[count($IDS) -1] : $prevID;
    $nextID = empty($nextID) ? $IDS[0] : $nextID;

    return [get_permalink($prevID), get_permalink($nextID)];
  }

  $prevnext = getPrevNext();
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

  /* Header */
  .hero_wrapper.empty_header_text .title_wrapper,
  .hero_wrapper.empty_header_text .breadcrumbs_wrapper
  .hero_wrapper.empty_header_text .hero_breadcrumbs{
    display: none !important;
  }

  /* Common */
  .color-white { color: white; }
  .color-violet { color: #9b75b0; }
	.bg-color-white { background-color: white; }
	.bg-color-light-gray { background-color: #e1e1e1; }
	.bg-color-gray { background-color: gray; }
	.bg-color-violet { background-color: #9b75b0; }
	.bg-color-red { background-color: #e74342; }
	.bg-color-green { background-color: #85bd34; }
	.bg-color-light-green { background-color: #8fc6af; }
	.bg-color-light-yellow { background-color: #fcb84d; }
	.bg-color-dark-blue { background-color: #5c5a67; }
  .three-columns > div { width: 33%; float: left; }

  .clearfix:before, .clearfix:after {content: " "; display: table; }
  .clearfix:after { clear: both; }

  /* Content Commons */
  .content_single_recruiment h2 {
    font-size: 20px;
    font-weight: bold;
    text-transform: uppercase;
  }

  .content_single_recruiment h4 {
    font-size: 15px;
    font-weight: bold;
  }

  /* No Visible */
  .no-visible{
    padding: 50px;
    font-size: 19px;
  }

  /* Content Left & Right */
  .content_single_recruiment {
    position: relative;
    background-color: white;
    min-height: 465px;
  }

  .content_single_recruiment .content-left{
    width: 70%;
    height: 100%;
    background-color: white;
    padding-
  }
  .content_single_recruiment .content-right{
    position: absolute;
    top: 0;
    right: 0;
    width: 30%;
    height: 100%;
    background-color: #85bd34;
  }
  .content_single_recruiment .content-left .ct-wrapper,
  .content_single_recruiment .content-right .ct-wrapper{
    padding: 45px 50px;
  }

  .content_single_recruiment .content-left .ct-wrapper {
    padding-bottom: 120px;
  }

  /* Content Left */
  .content_single_recruiment .content-left h2{
    margin-right: 226px;
    line-height: 25px;
    margin-bottom: 16px;
  }
  .content_single_recruiment .content-left h4{
    margin-bottom: 20px;
  }
  .content_single_recruiment .content-left .recr-header{
    position: relative;
    margin-bottom: 30px;
  }

  .content_single_recruiment .content-left .recr-header .recr-header-nav{
    position: absolute;
    top: -6px;
    right: 0;
  }

  .content_single_recruiment .content-left .recr-header .recr-header-nav .divider{
    float: left;
    margin: 12px 4px 0 4px;
    font-size: 13px;
    color: #ccc;
  }
  .content_single_recruiment .content-left .recr-header .recr-header-nav a{
    cursor: pointer;
    float: left;
    border: none;
    margin: 0;
    font-size: 13px;
  }

  .content_single_recruiment .content-left .recr-header .recr-header-nav a:first-child{
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_leftarrow_grey_2.svg);
    background-repeat: no-repeat;
    background-position: center left 12px;
    padding-left: 36px;
  }

  .content_single_recruiment .content-left .recr-header .recr-header-nav a:last-child{
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_rightarrow_grey_2.svg);
    background-repeat: no-repeat;
    background-position: center right 12px;
    padding-right: 36px;
  }

  .content_single_recruiment .content-left .recr-header-bar li{
    display: inline-block;
    text-transform: uppercase;
    color: #a3a3a3;
    border-right: 1px solid #a3a3a3;
    padding-right: 10px;
    margin-right: 9px;
    font-size: 14px;
  }
  .content_single_recruiment .content-left .recr-header-bar li:last-child{
    border-right: none;
  }
  .content_single_recruiment .content-left .recr-body{
    font-size: 13px;
    line-height: 16px;
  }
  .content_single_recruiment .content-left .recr-body p{
    margin-bottom: 10px;
  }
  .content_single_recruiment .content-left .recr-footer a {
    position: absolute;
    bottom: 50px;
  }
  .content_single_recruiment .content-left .recr-footer a {
    text-align: center;
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_leftarrow_grey_2.svg);
    background-repeat: no-repeat;
    background-position: center left 12px;
    padding-left: 36px;
  }


  /* Content Right */

  .content_single_recruiment .content-right h4{
    color: white;
    padding-bottom: 16px;
    margin-bottom: 16px;
    border-bottom: 1px solid #ffffff4f;
  }

  .content_single_recruiment .content-right .recr-contact-header li {
    display: block;
    font-size: 14px;
    color: white;
    height: 16px;
    padding-left: 30px;
    margin-bottom: 16px;
    background-repeat: no-repeat;
    background-position: top left;
  }

  .content_single_recruiment .content-right .recr-contact-header li.icon-profile {
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_contact_grey.svg);
  }

  .content_single_recruiment .content-right .recr-contact-header li.icon-email {
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_email_grey.svg);
  }

  .content_single_recruiment .content-right .recr-contact-header li.icon-phone {
    background-image: url(<?php bloginfo('template_directory'); ?>/img/icon_action_phone_grey.svg);
  }

  .content_single_recruiment .content-right .recr-contact-share {
    margin-top: 120px;
  }

  .content_single_recruiment .content-right .recr-socials .btn {
    display: block;
    box-sizing: border-box;
    float: left;
    font-size: 12px;
    width: 45%;
    text-align: left;
    padding-left: 36px;
    margin: 0 6px 6px 0;
    border: 1px solid #ffffff4f;
    color: white;
    background-repeat: no-repeat;
    background-position: center left 10px;
  }

  @media (max-width: 1280px) {
    .content_single_recruiment .content-right .recr-contact-share {
      margin-top: 82px !important;
    }

    .content_single_recruiment .content-right .recr-socials .btn {
      float: inherit !important;
      width: 100%;
    }
  }

  .content_single_recruiment .content-right .recr-socials .btn.facebook {
    background-image: url(<?php bloginfo('template_directory'); ?>/img/social_fb_white.svg);
  }
  .content_single_recruiment .content-right .recr-socials .btn.twitter {
    background-position: 10px 12px;
    background-image: url(<?php bloginfo('template_directory'); ?>/img/social_tw_white.svg);
  }
  .content_single_recruiment .content-right .recr-socials .btn.linkedin {
    background-image: url(<?php bloginfo('template_directory'); ?>/img/social_in_white.svg);
  }
  .content_single_recruiment .content-right .recr-socials .btn.instagram {
    background-size: 12px 12px;
    background-image: url(<?php bloginfo('template_directory'); ?>/img/social_inst_white.svg);
  }

  @media (max-width: 1010px) {
    #content_wrapper .sidebar {
      display: none !important
    }

    #content_wrapper .content {
      width: 100% !important;
    }

    .content_single_recruiment .content-left .recr-header h2{
      padding-top: 39px;
      margin-right: 0;
    }
    .content_single_recruiment .content-left .recr-header .recr-header-nav{
      left: -14px;
    }
  }

  @media (max-width: 520px) {
    .content_single_recruiment .content-left {
      width: 100%;
      height: inherit;
    }
    .content_single_recruiment .content-left .ct-wrapper {
      padding: 20px;
    }
    .content_single_recruiment .content-left .recr-header h2{
      padding-top: 39px;
      margin-right: 0;
    }
    .content_single_recruiment .content-left .recr-header .recr-header-nav{
      left: -14px;
    }
    .content_single_recruiment .content-left .ct-wrapper .recr-footer{
      margin-top: 16px;
      height: 46px;
    }
    .content_single_recruiment .content-left .recr-footer a {
      position: relative;
      top: 0;
    }
    .content_single_recruiment .content-right{
      position: relative;
      width: 100%;
      height: inherit;
    }
    .content_single_recruiment .content-left .ct-wrapper, .content_single_recruiment .content-right .ct-wrapper {
      padding: 40px 27px;
    }
    ..content_single_recruiment .content-right .recr-contact-share{
      margin-top: 52px !important;
    }
  }

</style>

<article id="content_wrapper">
  <aside class="sidebar sb_single_item sb_single_article two_column sb_supplier">
  </aside>

  <div class="content eight_column content_single_recruiment clearfix">

    <?php
      while (have_posts()) : the_post();
        $fields = get_fields();

        $options_counties = get_field_object('county')['choices'];
        $options_position_types = get_field_object('position_type')['choices'];

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

        $today = date('Ymd');
        $canShow = intval($fields['publish_start_at']) <= $today &&
          intval($fields['publish_end_at']) >= $today;
    ?>

    <?php if(!$canShow): ?>
    <div class="no-visible">
      This post has expired.<br/><br/><br/>
      <a href="<?php echo $recruitment_list_url ?>" class="btn">Back to Job Listings</a>
    </div>
    <?php else: ?>

    <div class="content-left">
      <div class="ct-wrapper">
        <div class="recr-header">
          <h2><?php echo $recru['title'] ?></h2>
          <h4><?php echo $recru['pharmacy'] ?></h4>
          <div class="recr-header-bar">
            <li><?php echo $recru['position_type'] ?></li>
            <li><?php echo $recru['location'] ?>, <?php echo $recru['county'] ?></li>
            <li><?php echo $recru['duration'] ?></li>
            <li>Starts: <?php echo $recru['start_at'] ?></li>
          </div>
          <div class="recr-header-nav">
            <a href="<?php echo $prevnext[0] ?>" class="btn">Previous Job</a>
            <div class="divider">|</div>
            <a href="<?php echo $prevnext[1] ?>" class="btn">Next Job</a>
          </div>
        </div>

        <div class="recr-body">
          <div><?php the_content(); ?></div>
        </div>

        <div class="recr-footer">
          <a href="<?php echo $recruitment_list_url ?>" class="btn">Back to Job Listings</a>
        </div>
      </div>
    </div>

    <div class="content-right">
      <div class="ct-wrapper">
        <div class="recr-contact-header">
          <h4>Contact</h4>
          <li class="icon-profile"><?php echo $recru['contact_name'] ?></li>
          <li class="icon-email"><?php echo $recru['contact_email'] ?></li>
          <li class="icon-phone"><?php echo $recru['contact_phone'] ?></li>
        </div>
        <div class="recr-contact-share">
          <h4>Share</h4>
          <div class="recr-socials clearfix">
            <a href="<?php echo $facebook_url ?>" class="btn facebook">Facebook</a>
            <a href="<?php echo $twitter_url ?>" class="btn twitter">Twitter</a>
            <a href="<?php echo $linkedin_url ?>" class="btn linkedin">LinkedIn</a>
            <!-- <a href="#" class="btn instagram">Instagram</a> -->
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <?php
      endwhile;
      wp_reset_query();
      wp_reset_postdata();
    ?>
    </div>
  </div>
</article>


<?php
  get_sidebar( 'content' );
  get_footer();
?>
