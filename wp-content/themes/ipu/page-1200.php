<?php
/**
 * The Template for Home – non members
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>



<?php if (is_user_logged_in()) {
	include('homepage-template.php');
}else {
	?>


    <article id="content_wrapper">

		<?php
		/************
		 *
		 * Left Column
		 *
		 * ***********/
		include('page-parts/sidebar.php');
		?>




		<?php
		/************
		 *
		 * Content
		 *
		 * ***********/
    $field_data = get_field('right_content');
		?>
        <div class="content lp_content eight_column mk_home_content content_same_height">

            <section class="mkh_about video" id="who-we-are">
                <div class="box_wrapper box_purple">
                    <?php
                    if (isset($field_data[0])):
                        $block_data = $field_data[0];
                        $title = $block_data['title'];
                        $description = $block_data['description'];
                        $subtitle = $block_data['subtitle'];
                        $link_title = $block_data['link_title'];
                        $link_url = $block_data['link_url'];
                        ?>
                      <div class="box_inside">
                        <h4><?= $subtitle; ?></h4>
                        <h3><?= $title; ?></h3>
                        <div class="box_content"><?= $description; ?></div>
                        <div class="box_action">
                          <a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_title; ?></a>
                        </div>
                      </div>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="box_wrapper box_w_green">
                  <div class="box-video">
                    <img src="<?php bloginfo('template_directory'); ?>/img/video.png" alt="IPU" class="logo_header">
                  </div>
                </div>
            </section>
          <div class="prescribe_block">
            <div class="desc_block">
              <div class="percent_block">
                <?php echo get_field('percent_value');?>%
              </div>
              <?php echo get_field('percent_text');?>
            </div>
          </div>
          <div class="white_block_header">
            <div>Think Pharmacy</div>
            Common Ailments the pharmacy can help with
          </div>
          <div class="white_block_wrapper">
              <?php
              if (get_field('pharmacy_ailments')):
                  while (have_rows('pharmacy_ailments')) : the_row();
//              echo __FILE__.' '.__LINE__.'<pre>';print_r(get_sub_field('image')).'</pre>';die;
                      ?>
                    <div class="white_block">
                      <div class="img_wrap">
                        <img src="<?php bloginfo('template_directory'); ?>/img/<?php echo get_sub_field('image')?>" alt="IPU" class="logo_header">
                      </div>
                      <div class="title_1">
                        <?php echo get_sub_field('title_1')?>
                      </div>
                      <div class="title_2">
                        <?php echo get_sub_field('title_2')?>
                      </div>
                      <div class="desc">
                        <?php echo get_sub_field('description')?>
                      </div>
                    </div>
                  <?php
                  endwhile;
              endif;
              ?>
          </div>
            <section class="mkh_about" id="who-we-are">
              <div class="box_wrapper box_w_green">
                <div class="box-video blue_circle">
                  <div class="blue_ellipse">
                    <div class="title">
                      REMEMBER
                    </div>
                    <div class="desc">
                      Your pharmacist is a
                      healthcare professional.
                      You can ask them for
                      advice about any
                      questions or
                      concerns
                    </div>
                  </div>
                  <img src="<?php bloginfo('template_directory'); ?>/img/shutterstock-1218727069.png" alt="IPU" class="logo_header">
                </div>
              </div>
              <div class="box_wrapper box_green">
                  <?php
                  if (isset($field_data[1])):
                      $block_data = $field_data[1];
                      $title = $block_data['title'];
                      $description = $block_data['description'];
                      $subtitle = $block_data['subtitle'];
                      $link_title = $block_data['link_title'];
                      $link_url = $block_data['link_url'];
                      ?>
                    <div class="box_inside">
                      <h4><?= $subtitle; ?></h4>
                      <h3><?= $title; ?></h3>
                      <div class="box_content"><?= $description; ?></div>
                      <div class="box_action">
                        <a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_title; ?></a>
                      </div>
                    </div>
                  <?php
                  endif;
                  ?>
              </div>
            </section>
            <section class="mkh_about" id="who-we-are">

              <div class="box_wrapper box_purple asdasasdasd">
                  <?php
                  /*
                  $second = 'right_content';

                  if (get_field($second)):
                      while (have_rows($second)) : the_row();
                          //$title = get_sub_field('title');
                          $title = get_sub_field('title');
                          $description = get_sub_field('description');
                          $subtitle = get_sub_field('subtitle');
                          $link_title = get_sub_field('link_title');
                          $link_url = get_sub_field('link_url');
                          ?>
                        <div class="box_inside">
                          <h4><?= $subtitle; ?></h4>
                          <h3><?= $title; ?></h3>
                          <div class="box_content"><?= $description; ?></div>
                          <div class="box_action">
                            <a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_title; ?></a>
                          </div>
                        </div>
                      <?php
                      endwhile;
                  endif;
                  wp_reset_query();
                  wp_reset_postdata();
                  */
                  ?>
                  <?php
//                  echo __FILE__.' '.__LINE__.'<pre>';print_r(get_fields()).'</pre>';die;
                  if (isset($field_data[2])):
                          $block_data = $field_data[2];
                          $title = $block_data['title'];
                          $description = $block_data['description'];
                          $subtitle = $block_data['subtitle'];
                          $link_title = $block_data['link_title'];
                          $link_url = $block_data['link_url'];
                          ?>
                        <div class="box_inside">
                          <h4><?= $subtitle; ?></h4>
                          <h3><?= $title; ?></h3>
                          <div class="box_content"><?= $description; ?></div>
                          <div class="box_action">
                            <a href="<?= $link_url; ?>" class="btn btn_action_go"><?= $link_title; ?></a>
                          </div>
                        </div>
                  <?php
                  endif;
                  ?>
              </div>
              <div class="box_wrapper box_w_green">
                <div class="box-video">
                  <img src="<?php bloginfo('template_directory'); ?>/img/shutterstock-1091736332.png" alt="IPU" class="logo_header">
                </div>
              </div>
            </section>

          <div class="sidebar_block">
            <?php include('page-parts/sidebar.php');?>
          </div>

            <section class="grid_wrapper mkh_event" id="upcoming-events">
                <div class="w_title">
                    <h3>Event &amp; training</h3>
                    <h2>Upcoming</h2>
                </div>
                <div id="container" class=" grid_post">
					<?php
					$args_ev = array(
						'posts_per_page' => 4,
						'post_type' => 'event',
						'orderby' => 'date',
						'order' => 'DESC'
					);
					?>
					<?php

					$posts = array();


					for($n = 0; $n <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"]; $n++) {
						$posts[$n] = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level".$n."_posts"]));
					}

					$query_ev = new WP_Query($args_ev);
					while ($query_ev->have_posts()) :
					$query_ev->the_post();


					//Assign level based on roles
					if($role == 'administrator') {
						$level = 6;
					} elseif($role == 'editor') {
						$level = 5;
					} elseif($role == 'author') {
						$level = 4;
					} elseif($role == 's2member_level4') {
						$level = 3;
					} elseif($role == 's2member_level2') {
						$level = 2;
					} elseif($role == 's2member_level1') {
						$level = 1;
					} elseif($role == 'subscriber') {
						$level = 0;
					} elseif($role === null) {
						$level = 6;
					}

					$foundCapability = false;
					$allCapabilitiesEmpty = true;

					//Loop through posts, compare with level
					for($i = 0; $i <= count($posts) && $i <= $level; $i++) {
						if(!isset($posts[$i]) || !$posts[$i]) {
							continue;
						}
						$foundCapability |= in_array(get_the_ID(), $posts[$i]);
						$allCapabilitiesEmpty &= !in_array(get_the_ID(), $posts[$i]);
					}

					if((!$allCapabilitiesEmpty && !$foundCapability && $role !== null) || (!$allCapabilitiesEmpty && $role === null && $foundCapability)) {
						continue;
					}


					$fields = get_fields();
					//update ******
					$shortDesc = $fields["short_description"];
					$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');

					$evDate = get_field('date');
					$year = date('Y', strtotime($evDate));
					$month = date('M', strtotime($evDate));
					$day = date('d', strtotime($evDate));
					$time = date('H:i', strtotime($evDate));

					$category = $fields["category"];

					$fieldz = get_field_object('category');
					$value = get_field('category');
					$categoryLbl = $fieldz['choices'][$value];
					if ($category == "cat1") {
						$color = "green";
					}
					if ($category == "cat2") {
						$color = "blue";
					}
					if ($category == "cat3") {
						$color = "turquoise";
					}
					if ($category == "cat4") {
						$color = "purple";
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
<!--                                                    <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
                                                </div>
                                                <div class="gi_data_date">
                                                    <span class="gi_data_day"><?= $min_day; ?></span>
                                                    <span class="gi_data_month"><?= $min_month; ?></span>
                                                </div>
                                                <div class="gi_data_date">
                                                    <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">to</span>
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
<!--                                                        <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
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
<!--                                                    <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
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
				<?php
				////////////     Filters    //////////////
				?>
                <script>
					<?php if ($category): ?>
                    var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
                    var s<?= $category; ?> = $('<span />', {
                        class: 'gi_<?= $category; ?> sbf_filter_counter',
                        html: n<?= $category; ?>
                    });
                    s<?= $category; ?>.appendTo('#<?= $category; ?>');
					<?php endif; ?>
                </script>
				<?php
				endwhile;
				?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?>
        </div>
        </section>
        </div>
      <div class="socials_wrap">
        <div class="social_title">
          Follow us
        </div>
        <div class="social">
          <div class="social_image">
            <img src="<?php bloginfo('template_directory'); ?>/img/social_tw.svg">
          </div>
          <a href="#" class="social_image_title">
            Twitter
          </a>
        </div>
        <div class="social">
          <div class="social_image">
            <img src="<?php bloginfo('template_directory'); ?>/img/social_fb.svg">
          </div>
          <a href="#" class="social_image_title">
            Facebook
          </a>
        </div>
        <div class="social">
          <div class="social_image">
            <img src="<?php bloginfo('template_directory'); ?>/img/social_in.svg">
          </div>
          <a href="#" class="social_image_title">
            Linkedin
          </a>
        </div>
        <div class="social">
          <div class="social_image">
            <img src="<?php bloginfo('template_directory'); ?>/img/social_yt.svg">
          </div>
          <a href="#" class="social_image_title">
            Youtube
          </a>
        </div>
      </div>
    </article>



<?php }?>





<?php
get_footer();

