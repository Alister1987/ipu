<?php
/**
 * The Template for SOP AND guideline
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header(); ?>
<style>

/* End: Recommended Isotope styles */

#filters .sbf_filter input{
	display: none;
}
#filters .sbf_filter label{
	padding: 10px 101px 10px 0px;
}
.sb_filters .sbf_filtergroup .sbf_filter .sbf_filter_counter{
	visibility: hidden;
}
</style>
<article id="content_wrapper">
		<aside class="sidebar sb_filters two_column">
		<?php
			//$customOrder = $_POST['phpvar'];
			//	print_r($_POST);
					$args = array(
						'posts_per_page' => -1,
						'post_type' => array('sop', 'article', 'faq', 'file', 'guideline'),
						'orderby' => 'date',
						'order' => 'ASC'
					);
			?>
			<div class="sb_txt"> <?=  get_field('short_description', 89);?></div>
			<h3>Filter BY TYPE</h3>
				<div id="filters" class="sbf_filtergroup" data-group="type">
					<!--<div class="sbf_filter"><input type="checkbox" value=".item" id="item" class="all" ><label for="item">All</label></div>-->
					<div class="sbf_filter" id="claimingprocedure"><input type="checkbox" name="gi_claimingprocedure" value=".gi_claimingprocedure" id="gi_claimingprocedure"><label for="gi_claimingprocedure">Claiming Procedure</label></div>
					<div class="sbf_filter" id="feesinformation"><input type="checkbox" name="gi_feesinformation" value=".gi_feesinformation" id="gi_feesinformation"><label for="gi_feesinformation">Fees Information</label></div>
					<div class="sbf_filter" id="hsecontracts"><input type="checkbox" name="gi_hsecontracts" value=".gi_hsecontracts" id="gi_hsecontracts"><label for="gi_hsecontracts">HSE Contracts</label></div>
				</div>
		</aside>	
		<section class="content lp_content eight_column">
	 
 
<!--<div class="sort">
	<div class="btn_sort_wrapper">
		<span>Sort by</span>
		<div class="btn_sort_group">
			<div class="btn btn_sort">Name</div>
			<div class="btn btn_sort">Name</div>
			<div class="btn btn_sort btn_sort_selected">Date</div>
		</div>
	</div>
</div>-->
				
		<section>
			<div class="lp_description">		
				<?php
				while (have_posts()) : the_post();
					$fields = get_fields();
					$title = $fields["title"];
					$content = $fields["content"];
					?>
					<h3><?php the_title(); ?></h3>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php
				wp_reset_query();
				wp_reset_postdata();
				?>		
			</div>
<!--			<div class="lp_who">
				<div class="lpw_item">
					<div class="lpw_avatar_wrapper">
						<div class="lpw_avatar">
						</div>
					</div>
					<div class="lpw_txt">
						<span class="lpw_name">Jillian O'Connel</span>
						<span class="lpw_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et ullamcorper nunc.
						</span>
						<a href="#" class="btn btn_grey btn_action_go">Contact information</li></a>
					</div>	
				</div>
			</div>-->
		</section>
				

		 <div class="grid_wrapper">
				<div id="container" class="grid_post" >
					<?php
			//	$count = 1;
					 
					$query = new WP_Query($args);
					while ($query->have_posts()) :
						//$counter = 1;
						$query->the_post();

						$title = $fields["title"];
						$fields = get_fields();
						$categorytxt = $fields["category"];
						$fieldz = get_field_object('category');
						$value = get_field('category');
						$categorylbl = $fieldz['choices'][$value];
						$shortDesc = $fields["short_description"];
						$viewLink = $fields["sop_link"];
						$post_type = get_post_type();
						$date = get_the_date("dmY");
//						 print_r($categorytxt[0]);
//						 print_r('</br>');
//						 print_r($post_type);
						?>		
					
					
					<?php //toDO ?>
					<?php if (($categorytxt[0] == 'legislation') || ($categorytxt[1] == 'legislation') || ($categorytxt[2] == 'legislation')) { ?>
						<?php include 'common/_filesbycategory.php'; ?>
					<?php } ?>
				 
					<?php  endwhile; ?>
					<?php
					wp_reset_query();
					wp_reset_postdata();
					?>
					
					<script>
						var container = '#container';
						<?php
						////////////////////////////////////////////////////////////////////////////////////////////////////////
						///////////////////////////////            Filters            //////////////////////////////////////////
						////////////////////////////////////////////////////////////////////////////////////////////////////////
							$query = new WP_Query($args1);
							while ($query->have_posts()) :
							$query->the_post();
							$post_type = get_post_type();
						?>	

						<?php if($post_type): ?>
							var n<?= $post_type; ?> = $(container + ' .gi_<?= $post_type; ?>').length;

							var s<?= $post_type; ?> = $('<span />',{
								class:'<?= $post_type; ?> sbf_filter_counter' , 
								html: n<?= $post_type; ?>
							});

							s<?= $post_type; ?>.appendTo('#<?= $post_type; ?>');
						<?php endif; ?>
						<?php endwhile; ?>

						<?php
							wp_reset_query();
							wp_reset_postdata();
						?>	

					</script>
				</div>
		</div>
	</section>
	</article>

<!--<p><button id="shuffle">Shuffle</button></p>-->
<script>
	


</script>
<?php

get_footer();




