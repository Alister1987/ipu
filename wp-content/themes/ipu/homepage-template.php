<?php
$current_user = wp_get_current_user();
$url = get_field('avatar', 'user_'.$current_user->ID);
$profile_img = $url['url'];
$bio = get_field('description', 'user_'.$current_user->ID);
$firstname = $current_user->first_name;
$lastname = $current_user->last_name;

$email = $current_user->user_email;
//print_r($current_user);
//print_r($url);
//print_r($profile_img);
//print_r('<pre>');
//print_r($bio);
$startTime = round(microtime(true) * 1000);
$field_data = get_field('right_content');
$block_images_data = get_field('images');
//echo __FILE__.' '.__LINE__.'<pre>';print_r(get_fields()).'</pre>';die;
?>
    <style>
        .a-resources {width: 100%; margin-bottom: 20px;}
        .a-resources li {border: solid 1px #ccc; padding: 10px; width: 25%; display: inline; float: left; margin-right: 10px}

        .left{
            position: absolute;
            left: 0px;
            width: 240px;
            color: white;
            z-index: 1000;
        }

        .last-entry li{background-color: #222;
            border: solid 1px;
            margin-right: 20px;}
    </style>

    <article id="content_wrapper">
        <!--        <aside class="sidebar two_column sb_member_home ">-->

        <div class="content lp_content eight_column news_content homepage">
            <h3>Latest News</h3>

			<?php
			global $fromHomepage;
			$fromHomepage = true;
			include('more-data2.php');



			?>

            <div class="btn btn_grey btn_action_go" id='loadMoreActivity' data-page='1'>Load more</div>
            <!--<div class="showLess">Show less</div>-->


            <script type='text/javascript'>
                $(document).ready(function () {
                    var isLoading = false;

                    $("#loadMoreActivity").click(function () {
                        if(isLoading)
                            return;

                        isLoading = true;
                        var page = $(this).attr('data-page');
                        page = parseInt(page) + 1;
                        var self = this;

                        var data = {
                            "action" : "more_data",
                            "fromHomepage" : 1,
                            "paged" : page
                        };

                        $.post( "<?php echo admin_url('admin-ajax.php')?>", data, function(res){
                            $(self).attr('data-page', page);
                            $("#tabs ul").append(res);
                            isLoading = false;
                        });

                    });
                });
            </script>

        </div>

        <!--        </aside>-->

        <section class="content lp_content eight_column content_same_height" style="height: 295px;">
            <div class="box_wrapper box_w_blue box_huge box_two_column">
                <div class="box_inside">
					<?php
          /*
					$the_query = new WP_Query('page_id=82');
					while ($the_query->have_posts()) :
						$the_query->the_post();
						?>
                        <h3> <?php the_title(); ?></h3>
                        <div class="box_content">
							<?php the_content(); ?>
                        </div>
						<?php
					endwhile;
					wp_reset_postdata();
          */
//                  echo __FILE__.' '.__LINE__.'<pre>';print_r(get_fields()).'</pre>';die;
					?>
                    <?php
                    if (get_field('current_issues')):
                    ?>
                  <div class="white_block_header">
                    <div>What's new</div>
                    Current issues
                  </div>
                  <div class="white_block_wrapper black_btn">
                    <?php
                        while (have_rows('current_issues')) : the_row();
                            ?>
                          <div class="white_block">
                            <div class="title_1">
                              Current Issues
                            </div>
                            <div class="title_2">
                                <?php echo get_sub_field('title')?>
                            </div>
                            <div class="desc">
                                <?php echo get_sub_field('description')?>
                            </div>
                            <div class="box_action">
                              <a href="<?php echo get_sub_field('button_link')?>" class="btn btn_action_go"><?php echo get_sub_field('button_title')?></a>
                            </div>
                          </div>
                        <?php
                        endwhile;
                    ?>
                    </div>
                    <?php
                    endif;
                    ?>
                  <div class="prescribe_block">
                    <div class="desc_block">
                      <div class="percent_block">
                        <img src="<?php bloginfo('template_directory'); ?>/img/vector-smart-object.png">
                      </div>
                      <?php echo get_field('red_text')?>
                    </div>
                  </div>
                    <?php
                    if (get_field('ongoing_issues')):
                        ?>
                      <div class="white_block_header">
                        <div>What's new</div>
                        Ongoing Issues
                      </div>
                      <div class="white_block_wrapper black_btn">
                          <?php
                          while (have_rows('ongoing_issues')) : the_row();
                              ?>
                            <div class="white_block">
                              <div class="title_1">
                                Ongoing Issues
                              </div>
                              <div class="title_2">
                                  <?php echo get_sub_field('title')?>
                              </div>
                              <div class="desc">
                                  <?php echo get_sub_field('description')?>
                              </div>
                              <div class="box_action">
                                <a href="<?php echo get_sub_field('button_link')?>" class="btn btn_action_go"><?php echo get_sub_field('button_title')?></a>
                              </div>
                            </div>
                          <?php
                          endwhile;
                          ?>
                      </div>
                    <?php
                    endif;
                    ?>
                  <section class="mkh_about" id="who-we-are">
                    <div class="box_wrapper box_green">
                        <?php
                        if (isset($field_data[3])):
                            $block_data = $field_data[3];
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
                      <?php
                      if (isset($block_images_data[3])):
                      ?>
                      <div class="box-video blue_circle">
                          <?php
                          if ($block_images_data[3]['small_text_title']):
                              ?>
                        <div class="blue_ellipse">
                          <div class="title">
                            <?php echo $block_images_data[3]['small_text_title']?>
                          </div>
                          <div class="desc">
                              <?php echo $block_images_data[3]['small_text']?>
                          </div>
                        </div>
                          <?php
                          endif;
                          ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/<?php echo $block_images_data[3]['image']?>" alt="IPU" class="logo_header">
                      </div>
                        <?php
                        endif;
                        ?>
                    </div>
                  </section>
                  <section class="mkh_about box_purple" id="who-we-are">
                    <div class="box_wrapper box_w_green">
                      <?php
                      if (isset($block_images_data[4])):
                          ?>
                        <div class="box-video blue_circle">
                            <?php
                            if ($block_images_data[4]['small_text_title']):
                                ?>
                              <div class="blue_ellipse">
                                <div class="title">
                                    <?php echo $block_images_data[4]['small_text_title']?>
                                </div>
                                <div class="desc">
                                    <?php echo $block_images_data[4]['small_text']?>
                                </div>
                              </div>
                            <?php
                            endif;
                            ?>
                          <img src="<?php bloginfo('template_directory'); ?>/img/<?php echo $block_images_data[4]['image']?>" alt="IPU" class="logo_header">
                        </div>
                      <?php
                      endif;
                      ?>
                        </div>
                    <div class="box_wrapper box_purple">
                        <?php
                        if (isset($field_data[4])):
                            $block_data = $field_data[4];
                            $title = $block_data['title'];
                            $description = $block_data['description'];
                            $subtitle = $block_data['subtitle'];
                            $link_title = $block_data['link_title'];
                            $link_url = $block_data['link_url'];
                            ?>
                          <div class="box_inside">
                            <h4><?= $title; ?></h4>
                            <h3><?= $subtitle; ?></h3>
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
                </div>
            </div>

            <div class="grid_wrapper">
                <div id="container" class=" grid_post">
					<?php

					$argsEv = array(
						'posts_per_page' => 5,
						'post_type' => array('event'),
						'orderby' => 'date',
						'order' => 'DESC'
					);
					$queryEv = new WP_Query($argsEv);
					while ($queryEv->have_posts()) :
						$queryEv->the_post();
						$fields = get_fields();
						//update ******
						$shortDesc = $fields["short_description"];
						$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');

						$mDate = get_the_modified_date();
						$evDate = get_field('date');
						$year = date( 'Y', strtotime( $evDate ) );
						$month = date( 'M', strtotime( $evDate ) );
						$day = date( 'd', strtotime( $evDate ) );
						$time = date( 'H:i', strtotime( $evDate ) );

						$dates = false;
						$eventLists = get_field("events_and_courses_list");
						if(is_array($eventLists) && count($eventLists) > 1){
							$dates = array_column($eventLists,"date");
							$min_date = min(array_map("strtotime",$dates));
							$max_date = max(array_map("strtotime",$dates));
							$min_day = date( 'd',  $min_date  );
							$min_year = date( 'Y',  $min_date  );
							$min_month = date( 'M',  $min_date  );
							$max_day = date( 'd', $max_date  );
							$max_month = date( 'M',  $max_date );
							$max_year = date( 'Y',  $max_date );

						}

						$category = $fields["category"];

						$fieldz = get_field_object('category');
						$value = get_field('category');
						$categoryLbl = $category;
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
						?>
						<?php if (!empty($avatar)) {
						?>
                        <div class="item g_item gi_event gi_<?= $color; ?> gi_event_img gi_<?= $category; ?>">
                            <a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">

                                <div class="gi_event_img_wrapper">
									<?php if (!empty($evDate) || $dates ) { //------- if the event got a picture -------  ?>
										<?php if($dates) {?>
                                            <div class="gi_data_date">
<!--                                                <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
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
                                                <div class="gi_data_category"><?= $categoryLbl; ?></div>
                                            </div>

                                            <h4 class="gi_title">
												<?php the_title(); ?>
                                            </h4>
                                            <h4 class="gi_content_txt">
												<?= $shortDesc; ?>
                                            </h4>
                                            <p class="gi_data_time"><?= $time; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
					<?php } else { ?>
                        <div class="item g_item gi_event gi_<?= $color; ?> gi_<?= $category; ?>">
                            <a class="gi_btn_arrow" href="<?= get_permalink(); ?>" title="<?php the_title(); ?> - read">

                                <div class="gi_data_wrapper">
                                    <div class="gi_data_sidebar">
										<?php if (!empty($evDate) || $dates ) { //------- if the event got a picture -------  ?>
											<?php if($dates) {?>
<!--                                                <div class="gi_data_date">-->
<!--                                                    <span class="gi_data_day" style="font-size: 14px;line-height: 4px;">from</span>-->
<!--                                                </div>-->
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
                                            <div class="gi_data_category"><?= $categoryLbl; ?></div>
                                        </div>
                                        <h4 class="gi_title">
											<?php the_title(); ?>
                                        </h4>
                                        <h4 class="gi_content_txt">
											<?= $shortDesc; ?>
                                        </h4>
                                        <p class="gi_data_time"><?= $time; ?></p>

                                    </div>
                                </div>
                            </a>
                        </div>
					<?php } ?>
					<?php
					////////////     Filters    //////////////
					?>
                        <script>
							<?php if($category): ?>
                            var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;
                            var s<?= $category; ?> = $('<span />',{
                                class:'gi_<?= $category; ?> sbf_filter_counter' ,
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
            </div>
            <?php
            if (get_field('article_directory')): ?>
              <div class="articles_wrap">
                <div class="articles_header">
                  Article Directory
                </div>
                <?php
                while (have_rows('article_directory')) : the_row();
                    ?>
                  <div class="articles_block">
                    <div class="title_1">
                        <?php echo get_sub_field('title')?>
                    </div>
                    <div class="title_2">
                        <?php echo get_sub_field('sub_title')?>
                    </div>
                    <div class="title_3">
                      <span>Date:</span> <?php echo get_sub_field('date')?>
                    </div>
                    <div class="btn_block">
                      <a href="<?php echo get_sub_field('button_link')?>"><?php echo get_sub_field('button_title')?></a>
                    </div>
                  </div>
                <?php
                endwhile;
                ?>
              </div>
            <?php
            endif;
            ?>
          <div class="after_article">
            <?php $page_id = get_post(25909); ?>
            <a href="<?php echo get_page_link($page_id); ?>" class="btn btn_action_go">View More</a>
          </div>
          <div class="mobile_news">
            <div id="content_wrapper">
              <div class="news_content">
                <h3>Latest News</h3>
                  <?php include('more-data2.php');?>
              </div>
            </div>
          </div>
            <?php
            if (get_field('social_icons')):
                ?>
              <div class="socials_wrap">
                <div class="social_title">
                  Follow us
                </div>
                  <?php
                  while (have_rows('social_icons')) : the_row();
                      ?>
                    <div class="social">
                      <div class="social_image">
                        <img src="<?php bloginfo('template_directory'); ?>/img/<?php echo get_sub_field('image')?>">
                      </div>
                      <a href="<?php echo get_sub_field('link')?>" class="social_image_title">
                          <?php echo get_sub_field('title')?>
                      </a>
                    </div>
                  <?php
                  endwhile;
                  ?>
              </div>
            <?php
            endif;
            ?>
        </section>
    </article>
<?php
$endTime = round(microtime(true) * 1000);
//var_dump($endTime - $startTime);
