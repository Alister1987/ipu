<?php
    if(isset($_GET['paged'])) {
        require_once('../../../wp-load.php');
    }

    $page = $_GET['paged'] ? $_GET['paged'] : 1;
    $display_count = 5;

    // After that, calculate the offset
    $offset = ( $page - 1 ) * $display_count;

    $args = array(
        'posts_per_page' => $display_count,
        'number' => $display_count,
        'page' => $page,
        'offset' => $offset,
        'post_type' => 'news',
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
    $title_content = $fields["title"];
    $content = $fields["short_description"];
    $files = $fields["files"];

    $type = get_post_type();
    $id = $myPost->post_date;
    $attachment_id = get_field('files');

    $file_url = wp_get_attachment_url( $attachment_id );
    $file_title = get_the_title( $attachment_id );
    $filetype = wp_check_filetype($file_title);
    $newfilename = wp_unique_filename( $file_url );

    ?>
        <div class="tl_item_wrapper" style='display: block;'>
            <a href="<?= get_permalink(); ?>" title="<?= $title_content; ?>">
                <div class="tl_item tl_item_<?= $type; ?> tl_item_new">
                    <div class="tl_date">
                        <span class="tl_day"><?= get_the_date("d",$id); ?></span>
                        <span class="tl_month"><?= get_the_date("M",$id); ?></span>
                    </div>
                    <div class="tl_iconbar">
                        <span class="icon"></span>
                    </div>
                    <div class="tl_txt">
                        <h4><?php the_title();?></h4>
                        <p><?= $content; ?>
                        </p>
<!--                        <span class="btn_tl">Read</span>-->
                    </div>
                </div>
            </a>
        </div>
    <?php endwhile; ?>

    <?php
    wp_reset_query();
    wp_reset_postdata();
    ?>
