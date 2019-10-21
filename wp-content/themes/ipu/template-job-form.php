<?php
/**
Template Name: Job Form
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */

/* Get user info. */
global $current_user, $wp_roles;
//get_currentuserinfo(); //deprecated since 3.1

/* Load the registration file. */
//require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
/* If profile was saved, update profile. */


$user_ID = get_current_user_id();
$current_user = get_userdata( $user_ID );
$role = ($current_user->roles[0]);

// CONFIG:start
$thisPageID = 25446;
$landingPage = 25430;
$listPage = 25446;
$position_type_key = 'field_5c1be88233c29';
$county_key = 'field_5c1be91933c2a';
$start_at_key = 'field_5c1be9f06cbd1';
$field_key_pharmacy = 'field_5c1d56cbf73ae';
$field_key_duration = 'field_5c1bea2d6cbd3';
$field_key_position_time = 'field_5c1be88233c29';
$field_key_county = 'field_5c1be91933c2a';
$field_key_location = 'field_5c1ce0a05f20a';
$field_key_start_at = 'field_5c1be9f06cbd1';
$field_key_name = 'field_5c1d56eef73b0';
$field_key_email = 'field_5c1d5703f73b1';
$field_key_phone = 'field_5c1d570bf73b2';
$field_key_date_start = 'field_5c1bea8a417b4';
$field_key_date_end = 'field_5c1bea1b6cbd2';
// CONFIG:end


if (strpos(get_site_url(), 'staging.wpengine') !== false) {
  $landingPage = 30535;
  $listPage = 30561;
  $thisPageID = 30561;
  $position_type_key = 'field_5c1d03c0ef3a3';
  $county_key = 'field_5c1d03eeef3a4';
  $start_at_key = 'field_5c1d0433ef3a6';

  $field_key_pharmacy = 'field_5c1e58efb5935';
  $field_key_duration = 'field_5c1d03b4ef3a2';
  $field_key_position_time = 'field_5c1d03c0ef3a3';
  $field_key_county = 'field_5c1d03eeef3a4';
  $field_key_location = 'field_5c1d0428ef3a5';
  $field_key_start_at = 'field_5c1d0433ef3a6';
  $field_key_name = 'field_5c1e5960b5937';
  $field_key_email = 'field_5c1e5978b5938';
  $field_key_phone = 'field_5c1e598cb5939';
  $field_key_date_start = 'field_5c1d044fef3a8';
  $field_key_date_end = 'field_5c1d0463ef3a9';
}

if (strpos(get_site_url(), 'ie') !== false) {
    $landingPage = 30263;
	  $listPage = 30270;
    $position_type_key = 'field_5c41cef2351de';
    $county_key = 'field_5c41cf10351df';
    $start_at_key = 'field_5c41cf39351e1';

    $field_key_pharmacy = 'field_5c41cebe351dc';
    $field_key_duration = 'field_5c41cee2351dd';
    $field_key_position_time = 'field_5c41cef2351de';
    $field_key_county = 'field_5c41cf10351df';
    $field_key_location = 'field_5c41cf2f351e0';
    $field_key_start_at = 'field_5c41cf39351e1';
    $field_key_name = 'field_5c41cf6d351e3';
    $field_key_email = 'field_5c41cf7d351e4';
    $field_key_phone = 'field_5c41cf8b351e5';
    $field_key_date_start = 'field_5c41cfa7351e7';
    $field_key_date_end = 'field_5c41cfc4351e8';
}

$shortDesc = get_field('short_description', $thisPageID);
$options_position_types = get_field_object($position_type_key)['choices'];
$options_counties = get_field_object($county_key)['choices'];
$errors = [];

$hasAccess = in_array($role, ['subscriber', 'administrator', 's2member_level1', 's2member_level2']);

if($_SERVER['REQUEST_METHOD'] === "POST" && $hasAccess) {

  $errors = [];
  $fields = $_POST['field'];

  // echo "<pre>";
  // print_r($fields);
  // echo "</pre>";

//   // Title
//   if (empty( $fields['title'] )) $errors[] = 'field_title';
//   if (empty( $fields['pharmacy'] )) $errors[] = 'field_pharmacy';
//   if (empty( $fields['duration'] )) $errors[] = 'field_duration';
//   if (empty( $fields['position_time'] )) $errors[] = 'field_position_time';
//   if (empty( $fields['county'] )) $errors[] = 'field_county';
//   if (empty( $fields['location'] )) $errors[] = 'field_location';
//   if (empty( $fields['start_at'] )) $errors[] = 'field_start_at';
//   if (empty( $fields['description'] )) $errors[] = 'field_description';
//   if (empty( $fields['name'] )) $errors[] = 'field_name';
//   if (empty( $fields['email'] )) $errors[] = 'field_email';
//   if (empty( $fields['phone'] )) $errors[] = 'field_phone';
//   if (empty( $fields['published_date_start'] )) $errors[] = 'field_published_date_start';
//   if (empty( $fields['published_date_end'] )) $errors[] = 'field_published_date_end';

  if (empty( $fields['title'] )) $errors[] = 'Title is required';
  if (empty( $fields['pharmacy'] )) $errors[] = 'Pharmacy is required';
  if (empty( $fields['duration'] )) $errors[] = 'Duration is required';
  if (empty( $fields['position_time'] )) $errors[] = 'PositionTime is required';
  if (empty( $fields['county'] )) $errors[] = 'County is required';
  if (empty( $fields['location'] )) $errors[] = 'Location is required';
  if (empty( $fields['start_at'] )) $errors[] = 'Start At is required';
  if (empty( $fields['description'] )) $errors[] = 'Description is required';
  if (empty( $fields['name'] )) $errors[] = 'Name is required';
  if (empty( $fields['email'] )) $errors[] = 'Email is required';
  if (empty( $fields['phone'] )) $errors[] = 'Phone is required';
  if (empty( $fields['published_date_start'] )) $errors[] = 'Date-Start is required';
  if (empty( $fields['published_date_end'] )) $errors[] = 'Date-End is required';


  if (!empty( $fields['start_at']) ) {
    $start_at = date("Ymd", strtotime(str_replace('/', '-', $fields['start_at'])));
  }

  if (!empty( $fields['published_date_start'] ) && !empty( $fields['published_date_end'] )) {
    $date_start = date("Ymd", strtotime(str_replace('/', '-', $fields['published_date_start'])));
    $date_end = date("Ymd", strtotime(str_replace('/', '-', $fields['published_date_end'])));

    if($date_end <= $date_start) {
      $errors[] = 'DateEnd should be after the DateStart';
    }
  }

  if(empty($errors)) {
    // sending..

    $my_post = array(
        'post_title'    => $fields['title'],
        'post_content'  => $fields['description'],
        'post_type' => 'recruitment',
        'post_status'   => 'publish',
        // 'post_author'   => 1,
    );

    // Insert the post into the database.
    $post_id = wp_insert_post( $my_post );


    update_field( $field_key_pharmacy, $fields['pharmacy'], $post_id);
    update_field( $field_key_duration, $fields['duration'], $post_id);
    update_field( $field_key_position_time, $fields['position_time'], $post_id);
    update_field( $field_key_county, $fields['county'], $post_id);
    update_field( $field_key_location, $fields['location'], $post_id);
    update_field( $field_key_start_at, $start_at, $post_id);
    update_field( $field_key_name, $fields['name'], $post_id);
    update_field( $field_key_email, $fields['email'], $post_id);
    update_field( $field_key_phone, $fields['phone'], $post_id);
    update_field( $field_key_date_start, $date_start, $post_id);
    update_field( $field_key_date_end, $date_end, $post_id);
  }

}

wp_enqueue_media();


get_header();
?>

<?php if($hasAccess === false): ?>

<article id="content_wrapper" class="page-<?=$id;?>">
  <aside class="sidebar two_column">
	</aside>

	<div class="content lp_content eight_column">
		<section class="content lp_content lp_event content_commitee">
			<div class="si_section_content">
				<section class="furst">
					<div class="box_wrapper box_huge box_two_column">
						<div class="box_inside">
              <div class="box_content">
                <h3>You do not have permission.</h3>
              </div>
            </div>
          </div>
        </section>
      </div>
    </section>
  </div>
</article>

<?php else: ?>


<style>
  .box_two_column .box_inside .box_content{
    margin-top: 0;
    border-top: none;
  }
  form .w_group_field{
    margin-bottom: 60px;
  }
  form .w_title {
    padding-left: 0;
  }

  form .field {
    margin-bottom: 14px;
  }

  form input,
  form select,
  form textarea {
    margin-top: 10px;
  }

  form .description_field{
    font-size: 12px;
    font-style: italic;
    display: block;
  }

  .errors ul {
    list-style: circle;
  }

  .errors li {
    font-size: 13px;
    margin-bottom: 6px;
  }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<!-- Include English language -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>


<article id="content_wrapper" class="page-<?=$id;?>">
	<aside class="sidebar two_column">
	</aside>

	<div class="content lp_content eight_column">
		<section class="content lp_content lp_event content_commitee">
			<div class="si_section_content">
				<section class="furst">
					<div class="box_wrapper box_huge box_two_column">
						<div class="box_inside">
							   <?php if ($errors && count($errors)) {
								     if ( isset( $errors) ) : ?>
							          <div class="errors" style="padding: 20px 0 20px 30px;">
                          <p style="font-size: 17px; font-weight: bold; margin-bottom: 12px;">Warning</p>
                          <ul>
                            <?php foreach ($errors as $error) { ?>
                              <li><?php echo $error ?></li>
                            <?php } ?>
                          </ul>
                        </div>
							    <?php endif;
							   } ?>
							<div class="box_content">

              <?php
                if($_SERVER['REQUEST_METHOD'] === "POST" && count($errors) === 0) {
                  $post_link = get_permalink($listPage);
                  echo "Thanks! Your job has been added.<br/><br/>";
                  echo "<a href='$post_link'>Click here</a> to view your job on the Job Postings List.<br/>";
                  echo "If you require amendments to be made to your job,<br/>";
                  echo "please email your changes to <a href='mailto:communciations@ipu.ie'>communciations@ipu.ie</a>.<br/>";
                  echo "We will be monitoring this site regularly.";
                }
                ?>

                <?php if($_SERVER['REQUEST_METHOD'] !== "POST" || count($errors)) : ?>
								<form id="job_form" action="<?php echo get_permalink(); ?>"
                  method="post" novalidate="novalidate">
                    <input type="hidden" name="from" value="job_form" />
										<input type="hidden" name="checkuser_id" value="<?php echo get_current_user_id(); ?>" />

									  <div class="w_group_field">

                      <div class="w_title">
                        <h2>Job Information</h2>
                      </div>

                      <!-- TITLE -->
									    <div class="field" id="field_title">
                        <?php _e('Title') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[title]" value="">
                        </span>
                      </div>

                      <!-- PHARMACY -->
									    <div class="field" id="field_pharmacy">
                        <?php _e('Pharmacy') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[pharmacy]"  value="">
                        </span>
                      </div>

                      <!-- DURATION -->
									    <div class="field" id="field_duration">
                        <?php _e('Duration') ?><br>
                        <span class="description_field">Example: 1 year; 5 months</span>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[duration]" value="">
                        </span>
                      </div>

                      <!-- POSITION TIME -->
									    <div class="field" id="field_position_time">
                        <?php _e('Position Time') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <select class="form-select" name="field[position_time]" >
                            <?php foreach ($options_position_types as $k => $v) { ?>
                              <option value="<?= $k ?>"><?= $v ?></option>
                            <?php } ?>
                          </select>
                        </span>
                      </div>

                      <!-- COUNTY -->
									    <div class="field" id="field_county">
                        <?php _e('County') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <select class="form-select"  name="field[county]" >
                            <?php foreach ($options_counties as $k => $v) { ?>
                              <option value="<?= $k ?>"><?= $v ?></option>
                            <?php } ?>
                          </select>
                        </span>
                      </div>

                      <!-- LOCATION -->
									    <div class="field" id="field_location">
                        <?php _e('Location') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[location]" value="">
                        </span>
                      </div>

                      <!-- START AT -->
									    <div class="field" id="field_start_at">
                        <?php _e('Start At') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input type='text' class="datepicker-here" data-language='en' placeholder="Select Date"
                            data-date-format="dd/mm/yyyy" name="field[start_at]"
                            />
                        </span>
                      </div>

                      <!-- Description -->
									    <div class="field" id="field_description">
                        <?php _e('Description') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <textarea style="width:100%" name="field[description]"  rows="8"></textarea>
                        </span>
                      </div>
                    </div>

                    <div class="w_group_field">
                      <div class="w_title">
                        <h2>Contact Information</h2>
                      </div>

                      <!-- Name -->
									    <div class="field" id="field_name">
                        <?php _e('Name') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[name]"  value="">
                        </span>
                      </div>

                      <!-- E-mail -->
									    <div class="field" id="field_email">
                        <?php _e('E-mail') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[email]"  value="">
                        </span>
                      </div>

                      <!-- Phone -->
									    <div class="field" id="field_phone">
                        <?php _e('Phone') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input size="40" type="text" name="field[phone]"  value="">
                        </span>
                      </div>
                    </div>

                    <div class="w_group_field">
                      <div class="w_title">
                        <h2>Publication Date Information</h2>
                      </div>

                      <!-- Date Start -->
									    <div class="field" id="field_published_date_start">
                        <?php _e('Date Start') ?><br>
                        <span class="wpcf7-form-control-wrap">
                          <input type='text' class="datepicker-here" data-language='en' placeholder="Select Date"
                            data-date-format="dd/mm/yyyy" name="field[published_date_start]"
                            />
                        </span>
                      </div>

                      <!-- Date End -->
									    <div class="field" id="field_published_date_end">
                        <?php _e('Date End') ?><br>
                        <span class="wpcf7-form-control-wrap">
                            <input type='text' class="datepicker-here" data-language='en' placeholder="Select Date"
                              data-date-format="dd/mm/yyyy" name="field[published_date_end]"
                              />

                        </span>
                      </div>
									</div>

                  <p class="submit">
                    <input type="submit" name="submit" id="submit" class="btn btn_action_register" value="Add Job">
                  </p>
								</form>
                <?php endif ?>
							</div>
						</div>
					</div>
				</section>
			</div>
		</section>
	</div>
</article>
<?php endif ?>

<?php
get_footer();


