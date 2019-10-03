<?php
/**
 * The Template for Directory - > Locum
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
<style>

	/* End: Recommended Isotope styles */

	.sbf_filter input{
		display: none;
	}
	.sbf_filter label{
		padding: 10px 101px 10px 0px;
	}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	visibility: hidden;
}

.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_name{
	border: none;
background: transparent;
}


</style>

<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array('locum'),
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$shortDesc = get_field('short_description', 753);
	$downloadFile = wp_get_attachment_url(get_post_meta(get_the_ID(), 'file', true));


	$allowedResourceJobs = array();
	$allowedResourceDays = array();
	$allowedResourceLocation = array();



	$field_key = "field_548980ac21115";
	$field_type = get_field_object($field_key);
	$allowedResourceJobs = $field_type['choices'];


	$field_key_second = "field_548980e421116";
	$field_type = get_field_object($field_key_second);
	$allowedResourceDays = $field_type['choices'];

	$field_key_third = "field_5489815921117";
	$field_type = get_field_object($field_key_third);
	$allowedResourceLocation = $field_type['choices'];


?>

<article id="content_wrapper">
	<?php

	/**********************************************************************************************************************************************************************
	 *
	***********************************************************************  Left content  ********************************************************************************
	 *
	**********************************************************************************************************************************************************************/

?>


<aside class="sidebar sb_filters two_column">

	<div class='sbf_filtergroup' id='filters-demo' data-filter-group="filter-cat">
			<span class="sbf_title">Filter by Location</span>
			<div class="sb_txt">
				<div class="select_wrapper_sidebar">
					<form name="cat" action="<?= get_permalink();?>" method="get">
						<div class="select_wrapper select_wrapper_green">
							<select class='filterCategory location' id='filters-demo' data-filter-group="filter-cat" name='cat'>
								<option value=''>All</option>
								<?php
								foreach ($allowedResourceLocation as $k => $v) {
									?>
									<option value="<?= $k ?>"><?= $v ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>

			<span class="sbf_title" style="display:none">Filter by Location</span>
			<div class="sbf_filter sbf_filter_active" style="display:none">
				<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
			</div>
			<?php
				if ($field_type) {
					foreach ($allowedResourceLocation as $k => $v) {
						?>
				<div  class="sbf_filter" style="display:none">
					<button  data-filter=".gi_<?= $k; ?>" id="<?= $k; ?>" class='sbf_filter_name'>
						<span class='bullet'></span>
							<?= $v; ?>
						<span class='sbf_filter_counter'></span>
					</button>
				</div>
			<?php
					}
				}
			?>
			</div>

			<div class='sbf_filtergroup run-normal-filtering-script' id='filters-demo-type' data-filter-group="filter-type">
			<span class="sbf_title">Filter by Jobs</span>
			<div class="sb_txt">
				<div class="select_wrapper_sidebar">
					<form name="cat" action="<?= get_permalink();?>" method="get">
						<div class="select_wrapper select_wrapper_green">
							<select class='filterCategory job' id='filters-demo' data-filter-group="filter-cat" name='cat'>
								<option value=''>All</option>
								<?php
								foreach ($allowedResourceJobs as $k => $v) {
									echo $v;
									?>
									<option value="<?= $k ?>"><?= $v ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>


				<span class="sbf_title" style="display:none">Filter by Jobs</span>
				<div  class="sbf_filter sbf_filter_active" style="display:none">
					<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
				</div>
					<?php
					if ($field_type) {
						foreach ($allowedResourceJobs as $k => $v) {
							?>
					<div class="sbf_filter" style="display:none">
						<button data-filter=".gi_<?= $k; ?>" id="<?= $k; ?>" class='sbf_filter_name'>
							<span class='bullet'></span>
								<?= $v; ?>
							<span class='sbf_filter_counter'></span>
						</button>
					</div>
					<?php
						}
					}
				?>




			<span class="sbf_title">Filter by Days</span>
			<div class="sb_txt">
				<div class="select_wrapper_sidebar">
					<form name="cat" action="<?= get_permalink();?>" method="get">
						<div class="select_wrapper select_wrapper_green">
							<select class='filterCategory days' id='filters-demo' data-filter-group="filter-cat" name='cat'>
								<option value=''>All</option>
								<?php
								foreach ($allowedResourceDays as $k => $v) {
									?>
									<option value="<?= $k ?>"><?= $v ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>


				<span class="sbf_title" style="display:none">Filter by Days</span>
				<div  class="sbf_filter sbf_filter_active" style="display:none">
					<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
				</div>

					<?php
					if ($field_type) {
						foreach ($allowedResourceDays as $k => $v) {
							?>
					<div class="sbf_filter" style="display:none">
						<button data-filter=".gi_<?= $k; ?>" id="<?= $k; ?>" class='sbf_filter_name'>
							<span class='bullet'></span>
								<?= $v; ?>
							<span class='sbf_filter_counter'></span>
						</button>
					</div>
					<?php
						}
					}
				?>
			</div>


			<script>
				$(document).ready(function(){

					var $container = $('#container');
					$container.isotope({
						layoutMode: 'masonry',
						itemSelector: '.item',
						masonryHorizontal: {
							rowWidth: 250,
							rowHeight: 250,
							gutter: 10
						}
					});

					$('.filterCategory').change(function () {
						var location = $('.filterCategory.location').val();
						var job = $('.filterCategory.job').val();
						var days = $('.filterCategory.days').val();
						var filterClass = '.gi_locum';
						if (location) { filterClass += '.gi_' + location;}
						if (job) { filterClass += '.gi_'+job;}
						if (days) { filterClass += '.gi_'+days;}
						$container.isotope({ filter: filterClass });
					});
				});
		</script>


			<div class="sb_wrapper sb_wrapper_stickit">
				<a href="<?= $downloadFile; ?>" target="_blank" class="btn btn_action_dowload_green">Register now!</a>
			</div>


	</aside>

<?php

	/**********************************************************************************************************************************************************************
	 *
	***********************************************************************  Right content  ********************************************************************************
	 *
	**********************************************************************************************************************************************************************/

?>
	<section class="content lp_content eight_column lp_event">

		<section class="wrapper">
			<ul class="tabs">
				<?php
				if (have_rows('about')):
					$i = 1;
					?>
					<?php
					while (have_rows('about')) : the_row();
						$first_name = get_sub_field('name');
						?>
						<li>
							<a href="#tab<?= $i++; ?>"> <?= $first_name; ?> <?= $last_name; ?> </a>
						</li>
						<?php endwhile;
					?>

					<?php
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>
			</ul>
			<div class="clr"></div>
			<section class="block">
				<?php
				if (have_rows('about')):
					$z = 1;
					?>
					<?php
					while (have_rows('about')) : the_row();
						$content = get_sub_field('content');
						?>
						<article id="tab<?= $z++; ?>">
							<div class='left-content'>
								<?= $content; ?>
							</div>
							<div class="right-content">
								<?php
								if (have_rows('personal_details')):
									while (have_rows('personal_details')) : the_row();
										$first_name = get_sub_field('first_name');
										$last_name = get_sub_field('last_name');
										$function = get_sub_field('function');
										$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'medium');
										?>
										<img src='<?= $picture[0]; ?>' />
										<p><?= $first_name; ?></p>
										<p><?= $last_name; ?></p>
										<p><?= $function; ?></p>
										<?php
									endwhile;
								endif;
								wp_reset_query();
								wp_reset_postdata();
								?>
							</div>
						</article>
						<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>
			</section>
		</section>

	</section>
		<?php
			/******
			 * slider content end
			 ******/
		?>

<section class="content lp_content eight_column">
	<div class="grid_wrapper">
	<div id="container" class=" grid_post">
		<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();


				$category = $fields["job_type"];
				$select = $fields["days"];
				$address = $fields["address"];
				$lastElement = end($address);
				$domain = $fields["domain"];
				$date = get_the_date('d M y');
				$days = get_field('days');

				?>


		<div class="item g_item gi_person gi_locum <?php foreach($address as $place) { ?> gi_<?php echo $place; } ?> gi_<?= $category; ?> <?php foreach($days as $day) { ?> gi_<?php echo $day; } ?>">

					<div class="gi_data">
						<div class="gi_data_category">locum</div>
						<span class="gi_data_date"><?=$date;?></span>
					</div>
					<div class="gi_info">
						<div class="gi_info_location"><?php
							foreach($address as $subA) {
									if($subA != $lastElement) {
										echo ucfirst($subA) . ", ";
									} else {
										echo ucfirst($subA);
									}
							}  ?>
						</div>
						<span class="gi_info_skills"><?=$category;?></span>
					</div>
					<div class="gi_week">
					<?php foreach($days as $day) { ?>
						<div class="giw_day giw_day_ok= <?php echo $day; ?>"><?php echo $day[0]; ?></div>
					<?php } ?>
					</div>


							<?php
				if (have_rows('personal_details')):
					while (have_rows('personal_details')) : the_row();
						$first_name = get_sub_field('first_name');
						$last_name = get_sub_field('last_name');
						$short_description = get_sub_field('short_description');
						$email = get_sub_field('email');
						$phone = get_sub_field('phone');
						?>


					<div class="gi_content">
						<div class="gi_firstname"><?= $first_name; ?></div>
						<div class="gi_surname"><?= $last_name; ?></div>
						<div class="gi_job"><?= $short_description; ?></div>
					</div>
					<a class="gi_btn gi_email" href="mailto:<?=$email;?>"><?=$email;?></a>
					<a class="gi_btn gi_phone" href="tel://<?= $phone; ?>"><?= $phone; ?></a>


						<?php
						//event content
						?>
						<?php
					endwhile;
				endif;
				?>



				</div>

			<?php

			endwhile;
			?>
		<?php
			wp_reset_query();
			wp_reset_postdata();
		?>
	</div>
</div>
</section>
</article>

<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();

	$('.sbf_filter_counter').css('visibility','visible');


	//tabs

	$(function(){
  $('ul.tabs li:first').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });
})
</script>



<?php
get_footer();
