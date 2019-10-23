<aside class="sidebar two_column sb_mk_home content_same_height">
  <div class="sb_mkh_wrapper">


      <?php do_shortcode('[yop_poll id="1"]'); ?>


    <h3>Latest News</h3>
    <div class="timeline">
        <?php
        $post_type = get_post_type();
        $args = array(
            'posts_per_page' => -1,
            'post_type' => array('news'),
            'orderby' => 'date',
            'order' => 'DESC'
        );
        ?>
        <?php

        $posts = array();


        for($n = 0; $n <= $GLOBALS["WS_PLUGIN__"]["s2member"]["c"]["levels"]; $n++) {
            $posts[$n] = array_unique(preg_split("/[\r\n\t\s;,]+/", $GLOBALS["WS_PLUGIN__"]["s2member"]["o"]["level".$n."_posts"]));
        }

        $query = new WP_Query($args);
        $role = ($current_user->roles[0]);
        while ($query->have_posts()) :
            //$counter = 1;
            $query->the_post();


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
            $title = $fields["title"];
            $category = $fields["category"];
            $fieldz = get_field_object('category');
            $value = get_field('category');
            $categorylbl = $fieldz['choices'][$value];
            $shortDesc = $fields["short_description"];
            $viewLink = $fields["sop_link"];
            $post_type = get_post_type();
            $date = get_the_date("dmY");
            $id = get_the_ID();

            $color = '';


            if($category == 'newsletter'){
                $color = 'tl_n_turquoise';
            }elseif($category == 'gm'){
                $color = 'tl_n_blue';
            }elseif($category == 'notefromthesg'){
                $color = 'tl_n_purple';
            }elseif($category == 'pressrelease'){
                $color = 'tl_n_green';
            }


            $day = get_the_date('d');
            $month = get_the_date('M');
            ?>

          <a href="<?= get_permalink(); ?>" title='<?php the_title();?>'>
            <div class="tl_item tl_n_item <?= $color; ?> <?= $category; ?>" >
              <div class="tl_date">
                <span class="tl_day"><?= $day; ?></span>
                <span class="tl_month"><?= $month; ?></span>
              </div>
              <div class="tl_iconbar">
              </div>
              <div class="tl_txt">
                <!--                                    <span class="n_cat">--><?//= $categorylbl; ?><!--</span>-->
                <span class="n_title"><?php the_title(); ?></span>
                <span class="n_shortDesc">
									<p><?= $shortDesc; ?></p>
								</span>
                <!--								<span class="btn_tl">Read</span>-->
              </div>
            </div>
          </a>





        <?php
        endwhile;
        wp_reset_query();
        wp_reset_postdata();
        ?>








    </div>
  </div>
</aside>