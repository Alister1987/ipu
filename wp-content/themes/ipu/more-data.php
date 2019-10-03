<?php
if(isset($_GET['paged'])) {
	require_once('../../../wp-load.php');
}

$page = $_GET['paged'] ? $_GET['paged'] : 1;
$display_count = 5;

// After that, calculate the offset
$offset = ( $page - 1 ) * $display_count;

global $fromHomepage;

$fromHomepage = isset( $_GET['fromHomePage']) ? $_GET['fromHomePage'] : $fromHomepage;

$meta = [];

// ZD-6259
//if($fromHomepage){
//	$meta = [[
//		'key' => 'category',
//		'value' => 'pressrelease',
//		'compare' => '!='
//	]];
//}

$args = array(
	'posts_per_page' => $display_count,
	'number' => $display_count,
	'page' => $page,
	'offset' => $offset,
	'post_type' => array('news'),
	'orderby' => 'date',
	'order' => 'DESC',
    'meta_query' => $meta
);

?>

<?php
$query = new WP_Query($args);


while ($query->have_posts()) :
	$query->the_post();

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
	<?php if (($type == "sop") || ($type == "article") || ($type == "faq") || ($type == "files") || ($type == "news")) {?>

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
<!--                    <span class="btn_tl">Read</span>-->
                </div>
            </div>
        </a>
    </div>

<?php }
	?>
<?php endwhile; ?>

<?php
wp_reset_query();
wp_reset_postdata();
?>
