<?php

$category = $fields["category"];
$selectedColor = get_field('color');

$evDate = get_field('date');
$year = date( 'Y', strtotime( $evDate ) );
$month = date( 'M', strtotime( $evDate ) );
$day = date( 'd', strtotime( $evDate ) );
$time = date( 'H:i', strtotime( $evDate ) );
$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');
$shortDesc = $fields["short_description"];


if ($selectedColor == "#85ba34") {
	$color = "green";
}
if ($selectedColor == "#00a8e6") {
	$color = "blue";
}
if ($selectedColor == "#5fc2ae") {
	$color = "turquoise";
}
if ($selectedColor == "#9A75AF") {
	$color = "purple";
}
if ($selectedColor == "#78a733") {
	$color = "darkgreen";
}
if ($selectedColor == "#EF436D") {
	$color = "red";
}

$eventLists = get_field("events_and_courses_list");
$dates = false;
if(is_array($eventLists) && count($eventLists) > 1){
	$dates = array_column($eventLists,"date");
	$min_date = min(array_map("strtotime",$dates));
	$max_date = max(array_map("strtotime",$dates));
	$min_day = date( 'd',  $min_date  );
	$min_month = date( 'M',  $min_date  );
	$max_day = date( 'd', $max_date  );
	$max_month = date( 'M',  $max_date );

}
?>
<?php if (!empty($avatar)) {
	?>
    <div class="item g_item gi_event gi_<?= $color; ?> gi_event_img gi_<?= $category; ?>">
        <a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">

            <div class="gi_event_img_wrapper">
				<?php if (!empty($evDate) || $dates ) { //------- if the event got a picture -------  ?>
                    <div class="gi_data_sidebar_img">
	                    <?php if($dates) {?>
                            <div class="gi_data_date">
<!--                                <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $min_day; ?></span>
                                <span class="gi_data_month"><?= $min_month; ?></span>
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"  style="font-size: 14px;line-height: 4px;">to</span>
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $max_day; ?></span>
                                <span class="gi_data_month"><?= $max_month; ?></span>
                            </div>
	                    <?php }else{ ?>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $day; ?></span>
                                <span class="gi_data_month"><?= $month; ?></span>
                            </div>
	                    <?php } ?>
                    </div>
				<?php } // ------- end -------  ?>
                <div class="gi_cover_picture" style="background-image: url('<?= $avatar[0]; ?>')"></div>
                <div class="gi_data_wrapper">
                    <div class="gi_data_sidebar">
						<?php if (!empty($evDate) || $dates ) { //------- if the event got a picture -------  ?>
							<?php if($dates) {?>
                                <div class="gi_data_date">
<!--                                    <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
                                </div>
                                <div class="gi_data_date">
                                    <span class="gi_data_day"><?= $min_day; ?></span>
                                    <span class="gi_data_month"><?= $min_month; ?></span>
                                </div>
                                <div class="gi_data_date">
                                    <span class="gi_data_day"  style="font-size: 14px;line-height: 4px;">to</span>
                                </div>
                                <div class="gi_data_date">
                                    <span class="gi_data_day"><?= $max_day; ?></span>
                                    <span class="gi_data_month"><?= $max_month; ?></span>
                                </div>
							<?php }else{ ?>
                                <div class="gi_data_date">
                                    <span class="gi_data_day"><?= $day; ?></span>
                                    <span class="gi_data_month"><?= $month; ?></span>
                                </div>
							<?php } ?>
						<?php } // ------- end -------  ?>
                    </div>
                    <div class="gi_data">
                        <div class="gi_data_category_wrapper">
                            <div class="gi_data_category"><?= $category; ?></div>
                        </div>

                        <h4 class="gi_title">
							<?php the_title(); ?>
                        </h4>
                        <h4 class="gi_content_txt">
							<?= $shortDesc; ?>
                        </h4>
                        <p class="gi_data_time"><?= $time; ?></p>
                        <!--                    <a class="gi_btn_arrow" href="--><?//= get_permalink(); ?><!--" title="--><?php //the_title(); ?><!-- - read">Read</a>-->
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php } else { ?>
    <div class="item g_item gi_event gi_<?= $color; ?> gi_<?= $category; ?>">
        <a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">
            <div class="gi_data_wrapper">
				<?php if (!empty($evDate) || $dates ) { //------- if the event got a picture -------  ?>
                    <div class="gi_data_sidebar">
						<?php if($dates) {?>
                            <div class="gi_data_date">
<!--                                <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $min_day; ?></span>
                                <span class="gi_data_month"><?= $min_month; ?></span>
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"  style="font-size: 14px;line-height: 4px;">to</span>
                            </div>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $max_day; ?></span>
                                <span class="gi_data_month"><?= $max_month; ?></span>
                            </div>
						<?php }else{ ?>
                            <div class="gi_data_date">
                                <span class="gi_data_day"><?= $day; ?></span>
                                <span class="gi_data_month"><?= $month; ?></span>
                            </div>
						<?php } ?>
                    </div>
				<?php } // ------- end -------  ?>
                <div class="gi_data">
                    <div class="gi_data_category_wrapper">
                        <div class="gi_data_category"><?= $category; ?></div>
                    </div>
                    <h4 class="gi_title">
						<?php the_title() ;?>
                    </h4>
                    <h4 class="gi_content_txt">
						<?= $shortDesc; ?>
                    </h4>
					<?php if(!$dates) {?>
                        <p class="gi_data_time"><?= $time; ?></p>
					<?php } ?>
                </div>
            </div>
        </a>
    </div>
<?php } ?>