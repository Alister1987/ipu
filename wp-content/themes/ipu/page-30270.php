<?php
/**
 * The Template for > Recruitment List
 */

  get_header();

  // CONFIG:start
  $thisPageID = 25446;
  $position_type_key = 'field_5c1be88233c29';
  $county_key = 'field_5c1be91933c2a';
  $start_at_key = 'field_5c1be9f06cbd1';
  // CONFIG:end

  if (strpos(get_site_url(), 'staging.wpengine') !== false) {
    $thisPageID = 30561;
    $position_type_key = 'field_5c1d03c0ef3a3';
    $county_key = 'field_5c1d03eeef3a4';
    $start_at_key = 'field_5c1d0433ef3a6';
  }

  if (strpos(get_site_url(), 'ie') !== false) {
    $thisPageID = 30270;
    $position_type_key = 'field_5c41cef2351de';
    $county_key = 'field_5c41cf10351df';
    $start_at_key = 'field_5c41cf39351e1';
  }

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

	/* End: Recommended Isotope styles */

	#filters .sbf_filter input{
		display: none;
	}
	#filters .sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
  .sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
    visibility: hidden;
  }

  /* Aside */

  .sb_filters .sb_txt{
    font-size: 16px !important;
    font-weight: bold;
    padding: 16px 0 16px 0;
    color: #5d5b68;
  }

  .sbf_title2{
    position: relative;
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #3e3d4b;
    line-height: 26px;
    position: relative;
    margin-bottom: 7px;
  }

  .sbf_title2.border-top {
    border-top: 1px solid #dddddd;
    padding-top: 12px;
  }

  /* Aside */

  .ft-header {
    font-size: 18px;
    font-weight: bold;
    padding: 16px 0 16px 0;
    margin-left: 50px;
  }

  .ft-block{
    border-top: 1px solid #d7d7d7;
    padding: 16px 16px 16px 0;
    margin-left: 50px;
  }

  .ft-block .ft-block-header{
    font-size: 15px;
    font-weight: bold;
    padding: 0 0 6px 0;
    color: #3e3d4b;
  }

  .select_wrapper_sidebar label.checked:before{
    content: "✓";
    color: black;
    font-weight: bold;
  }

  .select_wrapper_sidebar label:before{
    content: "✓";
    font-size: 15px;
    color: #fff;
    text-align: center;
    line-height: 11px;
    height: 16px;
    width: 16px;
    background-color: white;
    border-radius: 18px;
    border: 2px solid black;
    display: inline-block;
    margin-right: 10px;
    position: relative;
    left: 0;
    padding-top: 2px;
    font-size: 16px;
    -moz-transition-duration: .2s;
    -o-transition-duration: .2s;
    -webkit-transition-duration: .2s;
    transition-duration: .2s;

  }

  .select_wrapper_sidebar label {
    display: block;
    color: #3e3d4b;
    font-size: 13px;
    line-height: 12px;
    margin-bottom: 2px;
    width: 100%;
    float: left;
    cursor: default;
    letter-spacing: 0;
  }

  .ft-block .ft-block-field select {
    padding: 10px 6px;
    border: 2px solid #5b5a68;
    width: 100%;
    color: #5f5e66;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;

    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    font-size: 14px;
    color: #5b5a68;
    line-height: 20px;
    padding: 9px 20px 8px 8px;
    text-indent: .01px;
    text-overflow: "";
    outline: 0;
    background-color: transparent;
    vertical-align: baseline;
    box-sizing: border-box;
    -webkit-tap-highlight-color: transparent;
  }

  .ft-block .ft-block-field select:focus {
    outline-offset: -2px;
  }

  .datepicker-here{
    width: 100%;
    border: none !important;
  }

  /* Job-Item */
  .box2-openings .jobs .item.job-item{
    text-align: center;
    width: -moz-calc(25% - 14px);
    width: -webkit-calc(25% - 14px);
    width: calc(25% - 14px);
    display: block;
    background-color: #fff;
    float: left;
    margin: 7px;
    position: relative;
    overflow: hidden;
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
    padding: 6px;
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

  @media (max-width: 970px) {
    .box2-openings .jobs .item.job-item {
      width: 45%;
    }
  }

  @media (max-width: 520px) {
    .box2-openings .jobs .item.job-item {
      width: 95%;
    }
  }

  @media (max-width: 520px) {
    .thecheckbox {
      height: 35px;
    }
    .thecheckbox input {
      display: none;
    }
  }

</style>


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

<?php

  $today = date('Ymd');
	$args = array(
    'posts_per_page' => -1,
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

  $shortDesc = get_field('short_description', $thisPageID);
  $options_position_types = get_field_object($position_type_key)['choices'];
  $options_counties = get_field_object($county_key)['choices'];
?>

<article id="content_wrapper">
  <!-- ASIDE -->
	<aside class="sidebar sb_filters two_column">

    <div class="sb_txt">
        SEARCH JOBS
    </div>

    <div class="sbf_filtergroup" data-filter-group="filter-cat">
        <span class="sbf_title2">Position Type</span>
        <div class="select_wrapper_sidebar">
          <!-- <div class="thecheckbox">
              <input type="checkbox" value="fulltime" id="_fulltime" name="_fulltime" checked>
              <label for="_fulltime">Full Time</label>
          </div> -->
          <?php foreach ($options_position_types as $k => $v) { ?>
            <div class="thecheckbox">
              <input type="checkbox" value="<?= $k ?>" id="_<?= $k ?>" name="_<?= $k ?>" checked>
              <label for="_<?= $k ?>" class='checked'><?= $v ?></label>
            </div>
          <?php } ?>
        </div>
    </div>
    <script>
      $(document).ready(function(){
        $('.thecheckbox input').on('change', function (e){
          var isChecked = $(this).is(':checked');
          var theLabel = $(this).next();
          if(isChecked) theLabel.addClass('checked');
          else theLabel.removeClass('checked');
        });
      });
    </script>

    <?php if(false): ?>
    <div class="sbf_filtergroup" data-filter-group="filter-cat">
        <span class="sbf_title2">Position Type</span>
        <div class="sbf_filter" style="display:none">
            <button data-filter="" class="sbf_filter_name all"><span class="bullet"></span> All</button>
        </div>
        <div class="select_wrapper_sidebar">
            <div class="select_wrapper select_wrapper_outline">
                <select class="cmbposition_typefilterby" data-filter-group="filter-cat" name="cat">
                    <option value="">All</option>
                    <?php foreach ($options_position_types as $k => $v) { ?>
                      <option value="<?= $k ?>"><?= $v ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <?php endif ?>

    <div class="sbf_filtergroup" id="filters-demo" data-filter-group="filter-cat">
        <span class="sbf_title2 border-top">County</span>
        <div class="sbf_filter" style="display:none">
            <button data-filter="" class="sbf_filter_name all"><span class="bullet"></span> All</button>
        </div>
        <div class="select_wrapper_sidebar">
            <div class="select_wrapper select_wrapper_outline">
                <select class="cmbsopfilterby" id="filters-demo" data-filter-group="filter-cat" name="cat">
                    <option value="">All</option>
                    <?php foreach ($options_counties as $k => $v) { ?>
                      <option value="<?= $k ?>"><?= $v ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>

    <div class="sbf_filtergroup" data-filter-group="filter-cat">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css" rel="stylesheet" type="text/css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
      <!-- Include English language -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>
      <span class="sbf_title2 border-top">Starts On or After</span>
      <div class="select_wrapper select_wrapper_outline">
        <input type='text' class='datepicker-here' data-language='en' placeholder="Select Date"
          data-date-format="dd/mm/yyyy"
          />
      </div>
    </div>

    <button id="search-positions" class="btn" style="background-color:#85ba34">
      SEARCH POSITIONS
    </button>

    <script>
      $(document).ready(function(){
        var $container = $('#container');
				$container.isotope({
					layoutMode: 'masonry',
					itemSelector: '.item',
					masonryHorizontal: {
						rowWidth: 246,
						rowHeight: 250,
						gutter: 10
					}
				});

        var regexDate  = /^[0-9]{2}[\/][0-9]{2}[\/][0-9]{4}$/g;
        $('#search-positions').click(function () {
          var type = $('.cmbposition_typefilterby').val();
          var county = $('.cmbsopfilterby').val();
          var date = $('.datepicker-here').val();
          var date_str = false;

          var types = [];

          $('.thecheckbox input').each(function(item) {
            if($(this).is(':checked')) types.push($(this).attr('value'))
          });

          if(date.length === 10) {
            date_arr = date.split('/');
            date_str = parseInt(date_arr[2] + "" + date_arr[1] + "" + date_arr[0]);
          }

          $container.isotope({ filter: function() {
            var job_date = $(this).attr('data-date');
            var by_date = true;
            var by_type = false;
            var by_county = true;

            if(date_str !== false) by_date = parseInt( job_date, 10 ) >= date_str;
            if(county) by_county = $(this).hasClass('gi_' + county);

            for(_f = 0; _f < types.length; _f++ ){
              var _fstr = types[_f];
              if($(this).hasClass('gi_' + _fstr)) by_type = true;
            }

            return by_date && by_type && by_county;
          }})

        });
      });
    </script>
	</aside>

  <!-- CONTENT -->
  <section class="content lp_content eight_column">
	  <div class="grid_wrapper box2-openings">
	    <div id="container" class="grid_post jobs">
        <?php
          $query = new WP_Query($args);
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
            $gi_classes[] = "gi_date_" . date("dmY", strtotime($fields['start_at']));
            $gi_classes = implode(" ", $gi_classes);
        ?>
        <!-- ITEM:start -->
        <div class="item job-item <?php echo $gi_classes ?>" data-date="<?php echo date("Ymd", strtotime($fields['start_at']))?>">
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
    </div>
  </section>
</article>

<?php
get_footer();
