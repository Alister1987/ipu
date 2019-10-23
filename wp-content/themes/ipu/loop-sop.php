<div class="item g_item_equal g_item gi_<?php echo $post_type ?> <?php echo $giCatClasses ?> <?= $ipuCat; ?>" data-time="<?= $date; ?>" data-category="<?= $post_type; ?>">
    <a href="<?= get_page_link(get_the_ID()); ?>" title="<?= $categorylbl; ?>">
        <?php
            $fields = get_fields();
            $priority = $fields["priority"];
       ?>
    	<div class="gi_data">
    <!--        <span class="gi_data_date"><?= $date; ?></span>-->
        </div>
        <h4 class="gi_title">
            <div class="ellipsis_text"> 
                <span><?php the_title(); ?></span>
            </div>
        </h4>
        <div class="gi_content">
        <?php if( $post->purpose ) { ?>
            <span class="gi_content_txt">                             
                <div class="ellipsis_text"> 
                    <span>
                        <?= $post->purpose; ?>
                        <?php } ?>
                        <?php if( $post->scope ) { ?>
                            <?= $post->scope; ?>
                        <?php } ?>
                        <?php if( $post->responsibility ) { ?>
                            <?= $post->responsibility; ?>
                        <?php } ?>
                    </span>
                </div>
            </span>
        </div>
<!--     	<div class="gi_action_hover"><i>Read</i></div>
 -->	</a>
</div>