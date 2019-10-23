<?php
/**
 * The Template for HSE CONTACT - > CLAIMS
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>
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

#container{
	height: 100%!important;
}
 
</style>

<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array('person'),
		'orderby' => 'date',
        'meta_key' => 'is_staff',
        'meta_value' => 1,
		'order' => 'ASC'
	);
	$shortDesc = get_field('short_description', 751);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column">
		<h3>MEET THE STAFF</h3>
		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		 
 
	</aside>
		<?php
			/******
			 * slider content end
			 ******/
		?>	
				
<section class="content lp_content eight_column">
	<div class="grid_wrapper">
	<div id="container" class=" grid_post">
		<?php
			$query = new WP_Query($args);
			while ($query->have_posts()) :
				$query->the_post();
				$fields = get_fields();
				$category = $fields["category"];
				
				$fieldz = get_field_object('category');
				$value = get_field('category');
				$categoryLbl = $fieldz['choices'][$value];
 
				//update ********************
				$picture = wp_get_attachment_image_src(get_field('image'), 'medium');
				$email = $fields["email_address"];
				?>
		 
		
						</li>
						
						
				<div class="g_item gi_person gi_<?= $color; ?> gi_<?= $category; ?>">

					<div class="gi_data">
					 
					</div>
					<div class="gi_content">
						<div class="gi_avatar" <?php if($picture[0]){ ?>style="background: url('<?= $picture[0]; ?>');" <?php } ?>></div>
						<?php
				if (have_rows('personal_details')):
					while (have_rows('personal_details')) : the_row();
						$first_name = get_sub_field('first_name');
						$last_name = get_sub_field('last_name');
						$function = get_sub_field('function');
						?>
	 
						<div class="gi_firstname"><?= $first_name; ?></div>
						<div class="gi_surname"><?= $last_name; ?></div>				
						<div class="gi_job"><?= $function; ?></div>
						<?php
						//event content
						?>
					 
						<?php
					endwhile;
				endif;
				?> 
						
					
					</div>		
			
			
					<a class="gi_btn gi_email" href="mailto:<?=$email;?>"><?=$email;?></a>
				</div>				
						
						
						
						
						
						
						
						
						
					
					<?php
						////////////     Filters    //////////////
					?>	
 
			<?php 
	
			endwhile; 
			?>
		<?php
			wp_reset_query();
			wp_reset_postdata();
		?>
	</div>
</div>
</section>
</article>

<script>
	//filters counter
	//move-
	$('.sbf_filter_counter').addClass('remove');
	$('.remove:last-child').addClass('last');
	$('.last:last-child').removeClass('remove');
	$('.remove').remove();
	
	$('.sbf_filter_counter').css('visibility','visible');
</script>



<?php
get_footer();



