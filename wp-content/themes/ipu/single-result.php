<?php
/**
 * The template for displaying singe result
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

    <style>
        /* End: Recommended Isotope styles */

        .option-set li{color: black; float:left; display:inline; padding: 15px}
        .option-set li a{color: black;  margin-right: 20px; font-size: 14px}

        #filters .sbf_filter input,
        #filters-second .sbf_filter input{
            display: none;
        }
        #filters .sbf_filter label,
        #filters-second .sbf_filter input{
            padding: 10px 161px 10px 0px;
        }

    </style>

    <article id="content_wrapper" class="cw_results">

        <aside class="sidebar two_column sb_member_home "></aside>

        <div class="content lp_content <?php echo $posts > 0 ? 'eight_column' : 'full-width' ?>">

            <div class="grid_wrapper">

				<?php

				$fileId = get_post_meta(get_the_ID(), 'files', true);
				$downloadFile = get_attached_file($fileId);

				if( count($posts) == 1 && strtolower(pathinfo($downloadFile, PATHINFO_EXTENSION)) == "csv"){

				$csv = array_map('str_getcsv', file($downloadFile));
				array_walk($csv, function(&$a) use ($csv) {
					$a = array_combine($csv[0], $a);
				});

				$isHeader = true;
				?>


                <div id="table-wrapper">

                    <div id="table-container">
						<?php

						$headerFileds = [];

						echo '<table id="csv-table">';
						foreach ($csv as $row){
							echo '<tr>';

							foreach ($row as $field){

								if($isHeader)
									echo '<th>';
								else
									echo '<td>';

								echo $field;

								if($isHeader)
									echo '</th>';
								else
									echo '</td>';


								if($isHeader)
									$headerFileds[] = $field;
							}
							if(!$isHeader){
								echo '<td>';
								echo '<button data-sort-by="firstName" class="btn btn_view_more">View more</button>';
								echo '</td>';
							}else {
								echo '<th>';
								echo 'Action';
								echo '</th>';
							}

							echo '</tr>';

							$isHeader = false;

						}
						echo '</table></div></div>';

						echo '<div id="view-more-container" style="display: none;">';
						echo '<div id="view-more">';
						echo '<span class="header">'.get_the_title().'</span>';
						echo '<table>';
						foreach ($headerFileds as $field) {
							echo '<tr>';
							echo '<td>'.$field.'</td>';
							echo '<td></td>';
							echo '</tr>';

						}
						echo '</table>';

						echo '</div>';
						echo '</div>';
						?>


                        <script type="text/javascript">


                            $(function(){
                                var columns = <?php echo count($headerFileds)?> -1 ;

                                function checkTableWidth(index){
                                    var tableWidth = $("#csv-table").width();
                                    var containerTableWidth = $("#table-container").width();


                                    //break the recursive
                                    if(index < 1)
                                        return;

                                    if(containerTableWidth >= tableWidth ){
                                        return;

                                    }else{
                                        $('#csv-table tr').each(function() {
                                            $('th:eq(' + index + ')',this).hide();
                                            $('td:eq(' + index + ')',this).hide();

                                            $('th',this).last().show();
                                            $('td',this).last().show();
                                        });
                                        checkTableWidth(--index);
                                    }
                                }

                                $(window).on("load",function(){
                                    checkTableWidth(columns);


                                    $("#close-overlay").on("click",function(){
                                        $("#overlay").fadeOut();

                                        $("#content-overlay").find("#view-more").remove();
                                    });

                                    $(".btn_view_more").on("click",function(){
                                        $("#overlay").fadeIn();

                                        $(this).parents("tr").find("td:not(:last-child)").each(function(i) {
                                            $("#view-more").find("td:nth-child(2)").eq(i).html($(this).html())
                                        });

                                        $("#view-more-container").show();
                                        $("#content-overlay-container").height($("#view-more").outerHeight());
                                        $("#view-more-container").hide();


                                        $("#content-overlay").html($("#view-more").clone())

                                    });

                                });

                                $( window ).resize(function() {
                                    $('#csv-table tr').each(function() {
                                        $('th',this).show();
                                        $('td',this).show();
                                    });

                                    checkTableWidth(columns);

                                });
                            });
                        </script>
						<?php

						}else {
							echo '<div id="container" class=" grid_post">';

							//Display single result
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
							?>

							<?php include(get_query_template('loop-'.$post_type));?>

                            <script type='text/javascript'>
								<?php if($post_type): ?>
                                var n<?= $post_type; ?> = $('#container' + ' .gi_<?= $post_type; ?>').length;

                                var s<?= $post_type; ?> = $('<span />',{
                                    class:'<?= $post_type; ?> sbf_filter_counter' ,
                                    html: n<?= $post_type; ?>
                                });

                                $('#filter-<?= $post_type; ?>').find('.sbf_filter_counter').remove();
                                s<?= $post_type; ?>.appendTo('#filter-<?= $post_type; ?>');
								<?php endif; ?>
                            </script>


                            <script type='text/javascript'>
								<?php if($giCategoryList) {
								foreach($giCategoryList as $category) {
								?>
                                var n<?= $category; ?> = $('#container' + ' .gi_<?= $category; ?>').length;

                                var s<?= $category; ?> = $('<span />',{
                                    class:'<?= $category; ?> sbf_filter_counter' ,
                                    html: n<?= $category; ?>
                                });

                                $('#cat_<?= $category; ?>').find('.sbf_filter_counter').remove();
                                s<?= $category; ?>.appendTo('#cat_<?= $category; ?>');
								<?php
								}
								?>
								<?php } ?>
                            </script>
						<?php } ?>

                    </div>
                </div>
            </div>
    </article>










<?php
get_sidebar( 'content' );
//get_sidebar();
get_footer();
