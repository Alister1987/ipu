<?php
/**
 * The Template for Lobbying -> Communication
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

.sidebar{min-height: 400px;}


.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_name{
	border: none;
background: transparent;
}

</style>

<?php
	$shortDesc = get_field('short_description', 836);
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
$enable_filter_by_category = get_field('enable_filter_by_category', get_the_ID());

$allowedResourceRoles = array();
$allowedResourceTypes = array();


$field_key = "field_548acda9d2968";
$field_type = get_field_object($field_key);
$allowedResourceRoles = $field_type['choices'];


$field_key_second = "field_548ad2933d708";
$field_type = get_field_object($field_key_second);
$allowedResourceTypes = $field_type['choices'];
?>

<aside class="sidebar sb_filters two_column">


	<div class="sb_txt"><?= $shortDesc; ?> </div>
	<?php if($enable_filter_by_category[0] == 1) { ?>
		<div class='sbf_filtergroup' id='filters-demo' data-filter-group="filter-cat">
					<span class="sbf_title"><?php echo get_option( 'dropdown_text_name' )?></span>
					<div class="sb_txt">
						<div class="select_wrapper_sidebar">
							<form name="cat" action="<?= get_permalink();?>" method="get">
								<div class="select_wrapper select_wrapper_green">
									<select class='cmbsopfilterby' id='filters-demo' data-filter-group="filter-cat" name='cat'>
										<option value=''>All</option>
										<?php
										foreach ($allowedResourceRoles as $k => $v) {
											?>
											<option value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
										</select>
									</div>
								</form>

								<script>
									$(document).ready(function(){
										$('.cmbsopfilterby').change(function () {
											var cat = $(this).val();

											$(".sbf_filter button[data-filter='"+(cat == '' ? '' : '.gi_' + cat)+"']").click();
										});
									});
								</script>
							</div>
						</div>

					<span class="sbf_title" style="display:none">Filter by Category</span>
					<div class="sbf_filter sbf_filter_active" style="display:none">
						<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
					</div>
					<?php
						if ($field_type) {
							foreach ($allowedResourceRoles as $k => $v) {
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


					<div class='sbf_filtergroup' id='filters-demo-type' data-filter-group="filter-type">
					<span class="sbf_title">Filter by Region</span>
					<div class="sb_txt">
						<div class="select_wrapper_sidebar">
							<form name="cat" action="<?= get_permalink();?>" method="get">
								<div class="select_wrapper select_wrapper_green">
									<select class='cmbsopfilterby' id='filters-demo' data-filter-group="filter-cat" name='cat'>
										<option value=''>All</option>
										<?php
										foreach ($allowedResourceTypes as $k => $v) {
											?>
											<option value="<?= $k ?>"><?= $v ?></option>
											<?php } ?>
										</select>
									</div>
								</form>

								<script>
									$(document).ready(function(){
										$('.cmbsopfilterby').change(function () {
											var cat = $(this).val();

											$(".sbf_filter button[data-filter='"+(cat == '' ? '' : '.gi_' + cat)+"']").click();
										});
									});
								</script>
							</div>
						</div>


						<span class="sbf_title" style="display:none">Filter by Region</span>
						<div  class="sbf_filter sbf_filter_active" style="display:none">
							<button data-filter="" class='sbf_filter_name all' style="display:none">All</button>
						</div>
							<?php
							if ($field_type) {
								foreach ($allowedResourceTypes as $k => $v) {
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
				<?php } ?>
	</aside>


		<?php
			/******
			 * slider content end
			 ******/
		?>
				<?php
					$title = get_field('title', 836);
					$subtitle = get_field('subtitle', 836);
					$content = get_field('content', 836);
					$file = wp_get_attachment_url(get_post_meta(get_the_ID(), 'download', true));
					?>

<div class="content lp_content eight_column">

	<section class="furst">
		<div class="box_wrapper box_w_blue box_huge box_two_column">
			<div class="box_inside">
				<h4><?= $subtitle; ?></h4>
				<h3><?= $title; ?></h3>

				<div class="box_content">
					   	<?= $content; ?>
				</div>
			</div>

		</div>
	</section>
	<div class="grid_wrapper">
		<div id="container" class=" grid_post">
			<?php
				/*******************************
				 * main content
				 ******************************/
			?>
			<?php
		$args = array(
		'posts_per_page' => -1,
		'post_type' => 'lobbying',
		'orderby' => 'date',
		'order' => 'ASC'
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
				$function = $fields["function"];
				$location = $fields["location"];
				//$select = $fields["category"];
				$select = $fields["region"];

				$author = $fields["author"];
				$offer = $fields["offer"];
				$shortDesc = $fields["short_description"];
				$bg_picture = wp_get_attachment_image_src(get_field('picture'), 'medium');
				$logo = wp_get_attachment_image_src(get_field('logo'), 'medium');
				$region = $select;

				?>

				<div class="item g_item gi_person td gi_<?= $category; ?> gi_<?php if(is_array($region)) {
							 	echo $region[0];
							 	} else {
							 		echo $region;
							 		}  ?> ">
					<div class="gi_data">
						<div class="gi_data_category"><?php echo get_field('category') == 'senator' ? 'Senator' : 'TD' ?></div>
						<?php
                            $regions = array(
                                "midwestern" => "Mid Western Region",
                                "eastern" => " Eastern Region",
                                "northwestern" => " North Western Region",
                                "northestern" => " North Eastern Region",
                                "southeastern" => " South Eastern Region",
                                "western" => " Western Region",
                                "southern" => " Southern Region",
                                "midlands" => " Midlands Region"
                            );
                        ?>

						<?php if(get_field('category') == 'td') { ?>
                        	<div class="gi_data_location"><?php echo $regions[get_field('region')] ?></div>
						<?php } else { ?>
							<div class="gi_data_location"></div>
						<?php } ?>
					</div>
					<div class="gi_content">
						<div class="gi_firstname lobby"><?= $first_name; ?></div>
						<div class="gi_job"><?= $function; ?></div>
						<p class="gi_content_txt">
                            <?php $contact = get_field('contact'); $contact = $contact[0]; ?>
							<?php echo $contact['address']; ?>
						</p>
					</div>
						<?php
					if (have_rows('contact')):
						while (have_rows('contact')) : the_row();
							$email = get_sub_field('email');
							$phone = get_sub_field('phone');
							?>
						<a class="gi_btn gi_email" href="mailto:<?= $email; ?>"><?= $email; ?></a>
							<a class="gi_btn gi_phone" href="tel://<?= $phone; ?>"><?= $phone; ?></a>
								<?php endwhile; ?>
					<?php endif; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>

				</div>









			<script>
				var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
				var s<?= $category; ?> = $('<span />',{
					class:'gi_<?= $category; ?> sbf_filter_counter' ,
					html: n<?= $category; ?>
				});
				s<?= $category; ?>.appendTo('#<?= $category; ?>');
			</script>
			<script>
				var n<?= $region; ?> = $('#container' + ' .gi_<?= $region; ?>').length;
				var s<?= $region; ?> = $('<span />',{
					class:'gi_<?= $region; ?> sbf_filter_counter' ,
					html: n<?= $region; ?>
				});
				s<?= $region; ?>.appendTo('#<?= $region; ?>');
			</script>

				<?php

				endwhile;
				?>
			<?php
				wp_reset_query();
				wp_reset_postdata();
			?>
		</div>
</div>
	</div>
</article>
<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();

	$('.sbf_filter_counter').css('visibility','visible');
</script>
<?php
get_footer();
