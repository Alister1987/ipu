<?php
//update
$cfg = searchConfigurationInfo();
$title = $fields["title"];
$subtitle = $fields["subtitle"];
$course_duration = $fields["course_duration"];
$description = $fields["description"];
$non_member_price = $fields["non_member_price"];
$member_price = $fields["members_price"];
$enable_order_now = $fields['enable_order_now'];
$expert = $fields['course_expert'];
$start = $fields['course_start_date'];
$end = $fields['course_end_date'];
$location = $fields['course_location'];

if(!empty($start))
	$start = "From $start";

if(!empty($end))
	$end = " To $end";

$application_form  = wp_get_attachment_url(get_post_meta(get_the_ID(), 'application_form', true));
?>

<a href="<?php echo get_permalink(get_the_ID()); ?>">
	<div class="item g_item gi_training gi_training_toggle gi_<?php echo $post_type ?> <?php echo $giCatClasses ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">

		<?php if(!empty($start)) {?>
			<div class="gi_data">
				<div><?php echo $start.$end?> <span class="where"><?php echo $location ?></span></div>
			</div>
		<?php } ?>

		<div class="gi_content">
			<div class="gi_title"><?php echo the_title(); ?></div>
			<div class="gi_content_txt">
				<?= $expert; ?>

				<div class="specs" style="<?php empty($expert) ? "margin-top:-25px":""?>">
					<?php if(!empty($course_duration)){?>
						<p class="gir_price" href="#"><span><strong><?=$course_duration; ?></strong></span> Course Duration</p>
					<?php } ?>

					<?php if(!empty($member_price) && $member_price != 0){?>
						<p class="gir_price" href="#"><i>€<?=$member_price; ?></i> for IPU Members</p>
					<?php } ?>

					<?php if(!empty($non_member_price)  && $non_member_price != 0){?>
						<p class="gir_price" href="#"><i>€<?=$non_member_price; ?></i> for IPU Non Members</p>
					<?php } ?>
				</div>

			</div>
		</div>
		<div class="gi_btn"><i>Read More</i></div>
	</div>
</a>
