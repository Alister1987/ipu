 <?php foreach ($priority as $article) { ?>

	<?php
        $post = $article;
        setup_postdata($post);

        $post_title = $article->post_type;
		$author = $article->author;	
		$responsibility = $article->responsibility;
		$quotes = $article->quotes;
		$counter = count( $post_type );
		$rows = $article->content;
		$link = get_page_link($article->ID);
		$link_letter = $article->picture;
		$picture = wp_get_attachment_image_src($link_letter, 'full', true);
		$defaultPicture = wp_get_attachment_image_src($link, 'full', true);
        $fields = get_fields();
        $title = $fields["title"];
        $shortDesc = $fields["short_description"];
        $attachment_id = get_field('upload_file');
        $viewFile = wp_get_attachment_url($attachment_id);
        $post_type = get_post_type();
        $date = get_the_date();

        $categorytxtList = ipu_get_custom_field('ipu_categories');

        $giCategoryList = explode(',',$categorytxtList);
        $giCatClasses = implode(' gi_', $giCategoryList);
        $giCatClasses = 'gi_'.$giCatClasses;

        include(get_query_template('loop-'.$post_type));
	?>
<?php } ?>
