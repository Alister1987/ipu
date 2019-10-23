/*
 * Copyright (c) 2014 Lightbox
 *
 * General IPU Scripts and triggers
 *
 * Version 1
 *
 */


/*  -------------------- Single pages maximize / minimize function -------------------- */


$('#g_maximize').click(function(){
	$('.grid_post').toggleClass('grid_post_maximize');
	$('.si_txt').toggleClass('si_txt_minimize');
	$('#g_maximize').toggleClass('btn_action_min');

	$(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })

    // var str = document.getElementById("g_maximize").innerHTML; 
    // var res = str.replace("Maximize", "Minimize");
    // document.getElementById("g_maximize").innerHTML = res

});

$('#si_maximize').click(function(){
	$('.grid_post').toggleClass('grid_post_minimize');
	$('.si_txt').toggleClass('si_txt_maximize');
	$('#si_maximize').toggleClass('btn_action_min');

	$(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    });


});


/* Sticky sidebar */

$.fn.scrollBottom = function() { 
  return $(document).height() - this.scrollTop() - this.height(); 
};



 $('#g_maximize').click(function(){
   	equalheight('.content_same_height'); 
 });

/*  -------------------- User menu dropdown -------------------- */


$('.user_menu').bind(function(){
	$('.user_menu').toggleClass('user_menu_open');
});


/*  -------------------- Sticky areas -------------------- */


/*  Sticky menu bar code */

$('#searchbar_toggle').click(function(){
	$('.searchbar').toggleClass('searchbar_open');
	$('#searchbar_toggle').toggleClass('searchbar_toggle_close');
});

$('.hs_main_menu').click(function(){
	$('.hs_main_menu').toggleClass('hs_main_menu_open');
});


$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollTop() > 520){
           $('#header_scroll').addClass('header_scroll_show');
       }
       if ($(window).scrollTop() < 520){
 			$('#header_scroll').removeClass('header_scroll_show');
       }
//       if ($(window).scrollBottom() < 100){
// 			$('#header_scroll').removeClass('header_scroll_show');
//       }     

   });
});


$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollTop() > 479){
           $('.sb_wrapper_stickit').addClass('sb_wrapper_sticky');
           $('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
       }
       if ($(window).scrollTop() < 479){
 			$('.sb_wrapper_stickit').removeClass('sb_wrapper_sticky');
 			$('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
       }

//       if ($(window).scrollBottom() < 1){
// 			$('.sb_wrapper_stickit').addClass('sb_wrapper_endsticky');
//       }
   });
});

/* Sticky footer */

$(document).ready(function(){
   $(window).scroll(function(){
	   $.fn.scrollBottom = function() { 
  return $(document).height() - this.scrollTop() - this.height(); 
};

       if ($(window).scrollBottom() > 100){
 			$('#f_legal_wrapper').removeClass('f_legal_sticky');
       }
       if ($(window).scrollBottom() < 100){
 			$('#f_legal_wrapper').addClass('f_legal_sticky');
       }
   });
});


/* -------------------- To make two column the same height -------------------- */

/* Thanks to CSS Tricks for pointing out this bit of jQuery
http://css-tricks.com/equal-height-blocks-in-rows/
It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */

equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.content_same_height');
});

$(window).resize(function(){
  equalheight('.content_same_height'); 
});

// User menu dropdown

$('.user_menu').click(function(){
	$('.user_menu').toggleClass('user_menu_open');
});

// Stiky menu bar code

$('#searchbar_toggle').click(function(){
	$('.searchbar').toggleClass('searchbar_open');
	$('#searchbar_toggle').toggleClass('searchbar_toggle_close');
});

$('.hs_main_menu').click(function(){
	$('.hs_main_menu').toggleClass('hs_main_menu_open');
});


$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollTop() > 520){
           $('#header_scroll').addClass('header_scroll_show');
       }
       if ($(window).scrollTop() < 520){
 			$('#header_scroll').removeClass('header_scroll_show');
       }

   });
});

// Stiky sidebar 

$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollTop() > 479){
           $('.sb_wrapper_stickit').addClass('sb_wrapper_sticky');
           $('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
       }
       if ($(window).scrollTop() < 479){
 			$('.sb_wrapper_stickit').removeClass('sb_wrapper_sticky');
 			$('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
       }

//       if ($(window).scrollBottom() < 1){
// 			$('.sb_wrapper_stickit').addClass('sb_wrapper_endsticky');
//       }
   });
});


// To make two column the same height

$(document).ready(function() {
    var height = Math.max($("#content_column_left").height(), $("#content_column_right").height());
    $("#content_column_left").height(height);
    $("#content_column_right").height(height);
});


//show more button
$(document).ready(function () {
    size_a = $(".timeline a").size();
    x=5;
	
    $('.timeline a:lt('+x+')').show();
	
    $('.loadMore').click(function () {
        x= (x+4 <= size_a) ? x+4 : size_a;
        $('.timeline a:lt('+x+')').slideDown();
    });
	
	//load more elements product file page
	var size_file = $(".grid_post .g_item.gi_file_hide").size();
	y = 4;

	$('.grid_post .g_item.gi_file_hide:lt(' + y + ')').show();

	$('.btn_loadMore').click(function() {

		console.log('just loaded another 4 elements');
		y = (y + 4 <= size_file) ? y + 4 : size_file;
		$('.grid_post .g_item.gi_file_hide:lt(' + y + ')').slideDown();
	});
	
	$(window).scroll(function(){
       if ($(window).scrollTop() > 480){
           $('#header_scroll').addClass('header_scroll_show');
       }
       if ($(window).scrollTop() < 480){
 			$('#header_scroll').removeClass('header_scroll_show');
       }

   });


// User menu dropdown
$('.user_menu').click(function(){
	$('.user_menu').toggleClass('user_menu_open');
});

// Stiky menu bar code

$('#searchbar_toggle').click(function(){
	$('.searchbar').toggleClass('searchbar_open');
	$('#searchbar_toggle').toggleClass('searchbar_toggle_close');
});

$('.hs_main_menu').click(function(){
	$('.hs_main_menu').toggleClass('hs_main_menu_open');
});

 
$(function(){

//if($("#filters").length){}

	var $container = $('#container');
	var $checkboxes = $('#filters input');
  
//isotope container
  $container.isotope({
    itemSelector: '.item',
	sortBy: 'original-order',
//		masonry: {
//			columnWidth: 0,
//			gutter: 10
//        },
        masonryHorizontal: {
            rowHeight: 551
        },
        cellsByRow: {
            columnWidth: 150,
            rowHeight: 140
        },
        cellsByColumn: {
            columnWidth: 150,
            rowHeight: 140
        },
      getSortData : {
          symbol : function( $elem ) {
            return $elem.find('.gi_data_category').text();
          },
          number : function( $elem ) {
            return parseInt( $elem.find('.number').text(), 10 );
          },
          score : function( $elem ) {
            return parseInt( $elem.find('.score').text(), 10 );
          },
          name : function ( $elem ) {
            return $elem.find('.gi_data .gi_title').text();
          }
    }

  });
  //$container.addClass('heightFix');
 // $container.isotope( 'reLayout' );
  // get Isotope instance
  var isotope = $container.data('isotope');
  // add even classes to every other visible item, in current order
  function addEvenClasses() {
    isotope.$filteredAtoms.each( function( i, elem ) {
      $(elem)[ ( i % 2 ? 'addClass' : 'removeClass' ) ]('even')
    });
  }
  
  
//regular filters
$checkboxes.change(function(){
    var filters = [];
    // get checked checkboxes values
    $checkboxes.filter(':checked').each(function(){
      filters.push( this.value );
    });
	
	$(this).parents("div.sbf_filter").toggleClass("sbf_filter_active");
	$('#filters .all').parents("#filters div.sbf_filter").removeClass("sbf_filter_active");
	
    filters = filters.join(', ');
    $container.isotope({ 
		filter: filters,
		layoutMode: 'masonry',
		masonry: {
            //columnWidth: 55
        },
        masonryHorizontal: {
            rowHeight: 55
        },
        cellsByRow: {
            columnWidth: 200,
            rowHeight: 140
        },
        cellsByColumn: {
            columnWidth: 200,
            rowHeight: 140
        }
	});
    addEvenClasses();
});

//if ($("#filters-second").length){}
	var $checkboxess = $('#filters-second input');


//second lvl of filters
$checkboxess.change(function(){
    var filters = [];
    // get checked checkboxes values
    $checkboxess.filter(':checked').each(function(){
      filters.push( this.value );
    });
	
	$(this).parents("div.sbf_filter").toggleClass("sbf_filter_active");
	$('#filters-second .all').parents("#filters-second div.sbf_filter").removeClass("sbf_filter_active");
	
    filters = filters.join(', ');
    $container.isotope({ 
		filter: filters,
		layoutMode: 'masonry',
		masonry: {
            columnWidth: 55
        },
        masonryHorizontal: {
            rowHeight: 55
        },
        cellsByRow: {
            columnWidth: 200,
            rowHeight: 140
        },
        cellsByColumn: {
            columnWidth: 200,
            rowHeight: 140
        }
	});
    addEvenClasses();
});


  // sorting
  $('#sorts a').click(function(){
    // get href attribute, minus the #
      console.log('attribute clicked');
      
    var $this = $(this),
        sortName = $this.data('sort');
		//isotope container
    $container.isotope({ 
      sortBy : sortName,
	  layoutMode: 'masonry',
		masonry: {
            columnWidth: 55
        },
        masonryHorizontal: {
            rowHeight: 55
        },
        cellsByRow: {
            columnWidth: 200,
            rowHeight: 140
        },
        cellsByColumn: {
            columnWidth: 200,
            rowHeight: 140
        }
    });
    
    // switches selected class on buttons
    // don't proceed if already selected
    if ( !$this.hasClass('btn_sort_selected') ) {
      $this.parents('#sorts').find('.btn_sort_selected').removeClass('btn_sort_selected');
      $this.addClass('btn_sort_selected');
    }
    return false;
  });
    

});

 
$('#filters .sbf_filter .all').parents("#filters div.sbf_filter").addClass("sbf_filter_active");

$('#filters .sbf_filter .all').click(function(){
	$('#filters .sbf_filter').removeClass('sbf_filter_active');
	$(this).parents("#filters div.sbf_filter").addClass("sbf_filter_active");
});

    
    $('#filters-second .sbf_filter .all').parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");

    $('#filters-second .sbf_filter .all').click(function(){
        $('#filters-second .sbf_filter').removeClass('sbf_filter_active');
        $(this).parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");
    });

	$('#container').find('.g_item').css('position','static');
	$('.btn_sort.org').click(function(){
		 console.log('org...');
	   var $container = $('#container');
   $container.isotope({ sortBy: 'original-order' });
	});

	var pCont = $('#si_descr_faq p');
  	var answerFaq = $('<b />',{
		html: 'A '
	});
	answerFaq.prependTo(pCont);
	
});


$(window).load(function() {
  equalheight('.content_same_height');
});

$(window).resize(function(){
  equalheight('.content_same_height'); 
});


/*  -------------------- extended search bar test -------------------- */


$('.search_field').click(function(){
  $('body').toggleClass('extended_search_enabled');
});



$(function(){
    $('.tr_50').succinct({
        size: 50
    });
});

$(function(){
    $('.tr_75').succinct({
        size: 75
    });
});

$(function(){
    $('.tr_100').succinct({
        size: 100
    });
});

$(function(){
    $('.tr_150').succinct({
        size: 150
    });
});

$(function(){
    $('.tr_250').succinct({
        size: 250
    });
});



$(window).load(function() {
  equalheight('.n_content_same_height');
});

$(window).resize(function(){
  equalheight('.n_content_same_height'); 
});


/*   news page */


$('.btn_action_maxmin').click(function(){
  $('.right-container').toggleClass('right-container_maximize');
  $('.ui-tabs-nav').toggleClass('ui-tabs-nav_minimize');
  $('.btn_action_maxmin').toggleClass('btn_action_min');

  $(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })

    // var str = document.getElementById("g_maximize").innerHTML; 
    // var res = str.replace("Maximize", "Minimize");
    // document.getElementById("g_maximize").innerHTML = res

});

/*  -------------------- User menu dropdown -------------------- */


$('.user_menu').click(function(){
	$('.user_menu').toggleClass('user_menu_open');
});

$('.um_info').click(function(){
  $('.user_login').toggleClass('user_login_open');
});

/*  -------------------- show the network menu -------------------- */


$(document).mouseup(function (n){

    var container = $("#network_popup"); 
    
    $('.btn_network').click(function(){
      $('#network_popup').toggleClass('show_network_popup');
    });
    
    if (!container.is(n.target) // if the target of the click isn't the container...
        && container.has(n.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('show_network_popup');
    }
});


$(document).ready(function () {
    $(".guest_register").click(function (e) {
        $(".register-interest--guest").addClass("register-interest--form-show");
        
        e.stopPropagation();
        e.preventDefault();
    });
    $(".register-interest--guest .btn_action_close").click(function () {
        $(".register-interest--guest").removeClass("register-interest--form-show");
        
        e.stopPropagation();
        e.preventDefault();
    });
});