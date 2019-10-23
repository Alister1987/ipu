<?php
/**
 * The Template for DIRECTORY -> COMMITEES 
 *
 * @package WordPress
 * @subpackage IPU
 * @since Twenty Fourteen 1.0
 */
get_header();
?>


<?php
	$args = array(
		'posts_per_page' => -1,
		'post_type' => array('person'),
		'orderby' => 'date',
		'order' => 'ASC'
	);
	$shortDesc = get_field('short_description', 749);
?>

<article id="content_wrapper">
	<aside class="sidebar sb_filters two_column sb_commitee">

		<?php if(!empty($shortDesc)){?>
			<div class="sb_txt"><?= $shortDesc; ?></div>
		<?php } ?>
		<h3><?php echo get_option( 'dropdown_text_name' )?></h3>
<!--		<div id="filters" class="sbf_filtergroup" data-group="filter">
			<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>
			<div class="sbf_filter" id="executive"> <input type="checkbox" name="gi_executive" value=".gi_executive" id="gi_executive"><label for="gi_executive">Executive</label></div> 
			<div class="sbf_filter" id="pcc"> <input type="checkbox" name="gi_pcc" value=".gi_pcc" id="gi_pcc"><label for="gi_pcc">PCC</label></div> 
			<div class="sbf_filter" id="cpc"> <input type="checkbox" name="gi_cpc" value=".gi_cpc" id="gi_cpc"><label for="gi_cpc">CPC</label></div> 
			<div class="sbf_filter" id="epc"> <input type="checkbox" name="gi_epc" value=".gi_epc" id="gi_epc"><label for="gi_epc">EPC</label></div> 
			<div class="sbf_filter" id="regional"> <input type="checkbox" name="gi_regional" value=".gi_regional" id="gi_regional"><label for="gi_regional">Regional</label></div> 
		</div>-->
		
		
		<div id="filters" class="sbf_filtergroup" data-group="filter">
			<div class="sbf_filter sbf_filter_active"><input type="checkbox" value=".item" id="item" class="all"><label for="item">All</label></div>			
			<?php
				$field_key = "field_54773f7d2e51e";
				$field_cat = get_field_object($field_key);
				if ($field_cat) {
					foreach ($field_cat['choices'] as $k => $v) {
						?>
						<div class="sbf_filter" id="<?= $k; ?>"> <input type="checkbox" name="gi_<?= $k; ?>" value=".gi_<?= $k; ?>" id="gi_<?= $k; ?>"><label for="gi_<?= $k; ?>"><?= $v; ?></label></div> 
						<?php
					}
				}
			?>					
		</div>
		
		
	</aside>

<!-- biography-->
	<section class="content lp_content eight_column lp_event content_commitee">
		<section class="tab_wrapper">
			<ul class="tabs">
				<?php
				if (have_rows('about')):
					$i = 1;
					?>
					<?php
					while (have_rows('about')) : the_row();
						$first_name = get_sub_field('name');
						?>
						<li>
							<a href="#tab<?= $i++; ?>"> <?= $first_name; ?> <?= $last_name; ?> </a>
						</li>
					<?php endwhile;
					?>

					<?php
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>
			</ul>
			<div class="clr"></div>
			<section class="block">
				<?php
				if (have_rows('about')):
					$z = 1;
					?>
					<?php
					while (have_rows('about')) : the_row();
						$content = get_sub_field('content');
						?>
						<article id="tab<?= $z++; ?>">
							<div class='left-content'>
								<?= $content; ?>
							</div>
							<div class="right-content">
								<?php
								if (have_rows('personal_details')):
									while (have_rows('personal_details')) : the_row();
										$first_name = get_sub_field('first_name');
										$last_name = get_sub_field('last_name');
										$function = get_sub_field('function');
										$picture = wp_get_attachment_image_src(get_sub_field('picture'), 'medium');
										?>
										<span class="cc_avatar_wrapper">
											<div class="cc_avatar" style="background-image:url(<?= $picture[0]; ?>)"></div>
										</span>
										<span class="cc_first_name"><?= $first_name; ?></span>
										<span class="cc_last_name"><?= $last_name; ?></span>
										<span class="cc_function"><?= $function; ?></span>
										<?php
									endwhile;
								endif;
								wp_reset_query();
								wp_reset_postdata();
								?>
							</div>
						</article>
						<?php
					endwhile;
				endif;
				wp_reset_query();
				wp_reset_postdata();
				?>
			</section>
		</section>

	</section>
 <!--biography-->
	
	
	
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
				//update ******
				$shortDesc = $fields["short_description"];
				$avatar = wp_get_attachment_image_src(get_field('image'), 'medium');
				
				$evDate = get_field('date');
				$year = date( 'Y', strtotime( $evDate ) );
				$month = date( 'M', strtotime( $evDate ) );
				$day = date( 'd', strtotime( $evDate ) );
				$time = date( 'H:i', strtotime( $evDate ) );

				$select = $fields["category"];
				
				$fieldz = get_field_object('category');
				$value = get_field('category');
				$categoryLbl = $fieldz['choices'][$value];

				var_dump($categoryLbl);exit;
	 
				
				//update ********************
				$picture = wp_get_attachment_image_src(get_field('image'), 'medium');
				$email = $fields["email_address"];
				$phone = $fields["contact_number"];
				//$category = $category[0];
				
				foreach($select as $selected){
					$category = $selected;
				}	
				
				?>
		
		<div class="item g_item gi_person gi_<?= $color; ?> gi_<?= $category; ?>">

					<div class="gi_data">
						<div class="gi_data_category"><?= $category; ?></div>
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
						<a class="gi_btn gi_email" href="mailto:<?=$email;?>"><?=$email;?></a>
						<a class="gi_btn gi_phone" href='tel://<?= $phone; ?>' title='<?= $phone; ?>'><?= $phone; ?></a>		
						<?php
					endwhile;
				endif;
				?> 
						
					
					</div>		
	 
				</div>
		
		
		
						
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
	
	
	//tabs
	
	$(function(){
  $('ul.tabs li:first').addClass('active');
  $('.block article').hide();
  $('.block article:first').show();
  $('ul.tabs li').on('click',function(){
    $('ul.tabs li').removeClass('active');
    $(this).addClass('active')
    $('.block article').hide();
    var activeTab = $(this).find('a').attr('href');
    $(activeTab).show();
    return false;
  });
})
</script>



<?php
get_footer();



