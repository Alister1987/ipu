<?php
/**
 * The Template for HSE CONTACT - > CLAIMS
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
		'post_type' => array('vacant'),
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$shortDesc = get_field('short_description', 755);
?>

<article id="content_wrapper">
<?php

	/**********************************************************************************************************************************************************************
	 *
	***********************************************************************  Left content  ********************************************************************************
	 *
	**********************************************************************************************************************************************************************/

?>


<?php

$field_key = "field_5489881a78cf8";
$field_type = get_field_object($field_key);
$allowedResourceRoles = $field_type['choices'];


$field_key_second = "field_5489882778cf9";
$field_type = get_field_object($field_key_second);
$allowedResourceTypes = $field_type['choices'];


$field_key_third = "field_55156fde5f904";
$field_type = get_field_object($field_key_third);
$allowedResourceLocation = $field_type['choices'];

?>

		<aside class="sidebar sb_filters two_column">
			<?php if(!empty($shortDesc)){?>
				<div class="sb_txt"><?= $shortDesc; ?></div>
			<?php } ?>

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
		<span class="sbf_title">Filter by Role</span>
		<div class="sb_txt">
			<div class="select_wrapper_sidebar">
				<form name="cat" action="<?= get_permalink();?>" method="get">
					<div class="select_wrapper select_wrapper_green">
						<select class='filterCategory role' id='filters-demo' data-filter-group="filter-cat" name='cat'>
							<option value=''>All</option>
							<?php
							foreach ($allowedResourceRoles as $k => $v) {
								?>
								<option value="<?= $k ?>"><?= $v ?></option>
								<?php } ?>
							</select>
						</div>
					</form>
				</div>
			</div>


			<span class="sbf_title" style="display:none">Filter by Role</span>
			<div  class="sbf_filter sbf_filter_active" style="display:none">
				<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
			</div>
				<?php
				if ($field_type) {
					foreach ($allowedResourceRoles as $k => $v) {
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


			<span class="sbf_title">Filter by Type</span>
			<div class="sb_txt">
				<div class="select_wrapper_sidebar">
					<form name="cat" action="<?= get_permalink();?>" method="get">
						<div class="select_wrapper select_wrapper_green">
							<select class='filterCategory type' id='filters-demo' data-filter-group="filter-cat" name='cat'>
								<option value=''>All</option>
								<?php
								foreach ($allowedResourceTypes as $k => $v) {
									?>
									<option value="<?= $k ?>"><?= $v ?></option>
									<?php } ?>
								</select>
							</div>
						</form>
					</div>
				</div>

			<span class="sbf_title" style="display:none">Filter by Type</span>
			<div class="sbf_filter sbf_filter_active" style="display:none">
				<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
			</div>
			<?php
				if ($field_type) {
					foreach ($allowedResourceTypes as $k => $v) {
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
					var role = $('.filterCategory.role').val();
					var type = $('.filterCategory.type').val();
					var filterClass = '.gi_vacant';
					if (location) { filterClass += '.gi_' + location;}
					if (role) { filterClass += '.gi_'+role;}
					if (type) { filterClass += '.gi_'+type;}
					$container.isotope({ filter: filterClass });
				});
			});
		</script>


	</aside>



<?php

	/**********************************************************************************************************************************************************************
	 *
	***********************************************************************  Right content  ********************************************************************************
	 *
	**********************************************************************************************************************************************************************/

?>
<section class="content lp_content eight_column">
	<div class="grid_wrapper">
	<div id="container" class=" grid_post">
		<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
				//update ******
				///$shortDesc = $fields["short_description"];
				//$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');
				$select = $fields["job_type"];

				//print_r($categorylbl);


				$address = $fields["address"];
				$job_title = $fields["job_title"];
				$short_description = $fields["short_description"];
				$domain = $fields["domain"];

				$email = $fields["email"];
				$phone = $fields["phone"];

				$location = $fields['location'];

				$role = $fields["position"];
				$date = get_the_date('d M y');

				foreach($select as $selected){
					$category = $selected;
				}
				foreach($role as $selected){
					$position = $selected;
					//$categorylbl = $label;
				}

				?>

		<div class="item g_item gi_person gi_vacant <?php foreach($location as $location) { ?> gi_<?php echo $location; } ?> gi_<?= $category; ?> gi_<?= $position; ?>">

				<div class="gi_data">
					<div class="gi_data_category">vacant</div>
					<span class="gi_data_date"><?=$date;?></span>
				</div>
				<?php
				if (have_rows('contact')):
					while (have_rows('contact')) : the_row();
						$first_name = get_sub_field('first_name');
						$last_name = get_sub_field('last_name');
						//$short_description = get_sub_field('short_description');
						//update
						$address = get_sub_field('address');
						$company = get_sub_field('company');
						$contact_name = get_sub_field('contact_person_name');
						?>


						<div class="gi_info">
							<div class="gi_info_location"><?= $address; ?></div>
							<span class="gi_info_skills"><?= $company; ?></span>
							<span class="gi_info_contact"><?= $contact_name; ?></span>
						</div>
			<?php
			//event content
			?>


			<?php
		endwhile;
	endif;
	?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?>




				<div class="gi_content">

					<div class="gi_firstname"><?= $category; ?></div>
					<div class="gi_surname"><?= $position; ?></div>
					<div class="gi_job"><?=$short_description;?></div>
				</div>
				<a class="gi_btn gi_email" href="mailto:<?= $email; ?>"><?= $email; ?></a>
				<a class="gi_btn gi_phone" href="tel://<?= $phone; ?>"><?= $phone; ?></a>
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
