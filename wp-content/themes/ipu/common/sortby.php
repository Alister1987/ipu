<!--<div id="sorts" class="btn_sort_group">
	<a href="#name" data-sort="name" class="btn btn_sort">Name</a>
	<a href="#symbol" data-sort="symbol" class="btn btn_sort">Category</a>
	<a href="#original-order" data-sort="original-order" class="btn btn_sort org btn_sort_selected">Date</a>
</div>-->

<div id="sorts-demo" class="btn_sort_group">
<?php
$id = get_the_ID();

$default_sort_field = get_field('default_sort_field', get_the_ID());
$default_sort_meta_field = 'ipu_categories';

if( !$default_sort_field || $default_sort_field == '') {
	$default_sort_field = 'date';
}

if( $default_sort_field == 'category' ) {
	$default_sort_field = 'meta_value';
}

$default_sort_direction = 'ASC';

if( $default_sort_field == 'date' ) {
  $default_sort_direction = 'DESC';
}

if($id == '751'){ ?>
	<button data-sort-by="firstName" class="btn btn_sort">Name</button>
	<button data-sort-by="role" class="btn btn_sort">Job</button>
	<button data-sort-by="original-order" class="btn btn_sort btn_sort_selected">Date</button>
<?php }elseif($id == '749'){  ?>
	<button data-sort-by="firstName" class="btn btn_sort">Name</button>
	<button data-sort-by="personCategory" class="btn btn_sort">Category</button>
	<button data-sort-by="original-order" class="btn btn_sort btn_sort_selected">Date</button>
 <?php }else{  ?>
	<button data-sort-by="name" class="btn btn_sort <?php if($default_sort_field == 'title'){ echo'btn_sort_selected'; } ?>">Name</button>
	<button data-sort-by="category" class="btn btn_sort <?php if($default_sort_field == 'meta_value'){ echo'btn_sort_selected'; } ?>">Category</button>
	<button data-sort-by="date" class="btn btn_sort <?php if($default_sort_field == 'date'){ echo'btn_sort_selected'; } ?>">Date</button>
<?php } ?>
</div>
