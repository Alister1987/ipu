/*
 * Copyright (c) 2014 Lightbox
 *
 * General IPU Scripts and triggers
 *
 * Version 1.2
 *
 */



/*  ----------------------------------------------------------------------------------- */
/*  --------------------------------- Menus dropdowns --------------------------------- */
/*  ----------------------------------------------------------------------------------- */


/*  ------------ User menu dropdown ------------ */


$('.user_menu').click(function(){
  $('.user_menu').toggleClass('user_menu_open');
});

$('.um_info').click(function(){
  $('.user_login').toggleClass('user_login_open');
});

$(document).mouseup(function (e){

    var container = $(".user_login");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('user_login_open');
    }
});


/*  ------------ Network menu dropdown ------------ */


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


/*  ------------ Sliding main menu  ------------ */


// If the user clicks on the menu button
$('.sliding_toggle').click(function(){
  $('.sliding_menu_wrapper').toggleClass('show_sliding_menu');
});

// If the user clicks on the close button once the menu has appeared
$('.sliding_close').click(function(){
  $('.sliding_menu_wrapper').removeClass('show_sliding_menu');
});

// If the user clicks outside of the menu
$(document).mouseup(function (t){
    var container = $(".sliding_menu_wrapper");
    if (!container.is(t.target) // if the target of the click isn't the container...
        && container.has(t.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('show_sliding_menu');
    }
});

// If the user land on a small screen
$(document).ready(function(){
  if ($(window).width() > 800) {
    $(window).scroll(function(){
         if ($(window).scrollTop() < 520){
             $('.sliding_menu_wrapper').removeClass('show_sliding_menu');
         }
    });
  }

});

// If the user resize his screen
$(window).resize(function(){
  if ($(window).width() > 800) {
    $(window).scroll(function(){
         if ($(window).scrollTop() < 520){
             $('.sliding_menu_wrapper').removeClass('show_sliding_menu');
         }
    });
  }
});



/*  ----------------------------------------------------------------------------------- */
/*  ------------------------------ Training tiles accordeon --------------------------- */
/*  ----------------------------------------------------------------------------------- */

//$(window).resize(function(e) {
//  if (e.target == window)
//    $(window).height() - 1;
//});

//$('.gi_training_toggle').click(function(){
//  $(this).toggleClass('gi_training_show');
//  $(window).trigger('resize');
//});


/*  ----------------------------------------------------------------------------------- */
/*  ----------------------------------- Sticky areas ---------------------------------- */
/*  ----------------------------------------------------------------------------------- */


/*  ------------ Sticky areas ------------ */


$.fn.scrollBottom = function() {
  return $(document).height() - this.scrollTop() - this.height();
};


/*  ------------ Sticky menu bar code ------------ */


$('#searchbar_toggle').click(function(){
  $('.searchbar').toggleClass('searchbar_open');
  $('#searchbar_toggle').toggleClass('searchbar_toggle_close');
});

$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollTop() > 520){
           $('#header_scroll').addClass('header_scroll_show');
       }
       if ($(window).scrollTop() < 520){
      $('#header_scroll').removeClass('header_scroll_show');
       }
       if ($(window).scrollBottom() < 100){
      $('#header_scroll').removeClass('header_scroll_show');
       }
  });

  //If Main image container is tiny
  if ($('body').hasClass('b_tiny_main_img')) {
    $(window).scroll(function(){
         if ($(window).scrollTop() > 420){
             $('#header_scroll').addClass('header_scroll_show');
         }
         if ($(window).scrollTop() < 420){
        $('#header_scroll').removeClass('header_scroll_show');
         }
    });
  }
});


/* -------------------- Sticky sidebar -------------------- */


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

       if ($(window).scrollBottom() < 1){
      $('.sb_wrapper_stickit').addClass('sb_wrapper_endsticky');
       }
   });
  //If Main image container is tiny
  if ($('body').hasClass('b_tiny_main_img')) {
    $(window).scroll(function(){
         if ($(window).scrollTop() > 379){
             $('.sb_wrapper_stickit').addClass('sb_wrapper_sticky');
             $('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
         }
         if ($(window).scrollTop() < 379){
        $('.sb_wrapper_stickit').removeClass('sb_wrapper_sticky');
        $('.sb_wrapper_stickit').removeClass('sb_wrapper_endsticky');
         }
    });
  }
});


/* -------------------- Sticky footer -------------------- */


$(document).ready(function(){
   $(window).scroll(function(){
       if ($(window).scrollBottom() > 100){
      $('#f_legal_wrapper').removeClass('f_legal_sticky');
       }
       if ($(window).scrollBottom() < 100){
      $('#f_legal_wrapper').addClass('f_legal_sticky');
       }
   });
});



/*  ----------------------------------------------------------------------------------- */
/*  --------------------------- maximize / minimize function -------------------------- */
/*  ----------------------------------------------------------------------------------- */


/*  ------------ Single pages maximize / minimize function ------------ */


$('#g_maximize').click(function(){
  $('.grid_post').toggleClass('grid_post_maximize');
  $('.si_txt').toggleClass('si_txt_minimize');
  $('#g_maximize').toggleClass('btn_action_min');

  $(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })
});

$('#si_maximize').click(function(){
  $('.grid_post').toggleClass('grid_post_minimize');
  $('.si_txt').toggleClass('si_txt_maximize');
  $('#si_maximize').toggleClass('btn_action_min');
  $('.se_section_img').toggleClass('se_section_img_expand');
  $(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })
});


/* ------------ News page maximize / minimize function ------------ */


$('#n_maximize').click(function(){
  $('.right-container').toggleClass('right-container_maximize');
  $('.ui-tabs-nav').toggleClass('ui-tabs-nav_minimize');
  $('#n_maximize').toggleClass('btn_action_min');

  $(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })
});



/*  ----------------------------------------------------------------------------------- */
/*  -------------------------------------- Other -------------------------------------- */
/*  ----------------------------------------------------------------------------------- */


/* ------------ To make two column the same height ------------ */


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

//for the aside and the content wrapper

$(window).load(function() {
  equalheight('.content_same_height');
});

$(window).resize(function(){
  equalheight('.content_same_height');
});

//for the news

$(window).load(function() {
  equalheight('.n_content_same_height');
});

$(window).resize(function(){
  equalheight('.n_content_same_height');
});


//for the campaign boxes

$(window).load(function() {
  equalheight('.box_h_equal');
});

$(window).resize(function(){
  equalheight('.box_h_equal');
});



/* ------------ Truncate some text ------------ */


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



/*  ----------------------------------------------------------------------------------- */
/*  ---------------------------- Timeline Show more Button ---------------------------- */
/*  ----------------------------------------------------------------------------------- */


//show more button
$(document).ready(function () {
    size_a = $(".tl_item_wrapper").size();
    x=5;

    $('.tl_item_wrapper:lt('+x+')').show();

    $('.loadMore').click(function () {
        x= (x+4 <= size_a) ? x+4 : size_a;
        $('.tl_item_wrapper:lt('+x+')').slideDown();
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

/*  ----------------------------------------------------------------------------------- */
/*  ----------------------------- News Show more Button ------------------------------- */
/*  ----------------------------------------------------------------------------------- */
//show more button
    var size_news_items = $(".news_item_wrapper").size();
    var news_items_count = 5;

    $('.news_item_wrapper:lt(' + news_items_count + ')').addClass('news_item_show');

    $('.load_more_news_items').click(function() {
        news_items_count = (news_items_count + 4 <= size_news_items) ? news_items_count + 4 : size_news_items;
	$('.news_item_wrapper:lt(' + news_items_count + ')').addClass('news_item_show');
        $('.news_item_wrapper:lt(' + news_items_count + ')').slideDown();
    });

/*  ----------------------------------------------------------------------------------- */
/*  ------------------------------------- Filters ------------------------------------- */
/*  ----------------------------------------------------------------------------------- */


//$(function(){
//
////if($("#filters").length){}
//  var $container = $('#container');
//  var $checkboxes = $('#filters input');
//
// // cache jQuery window
//  var $window = $(window);
//
//  // start up isotope with default settings
//  $container.imagesLoaded( function(){
//    reLayout();
//    $window.smartresize( reLayout );
//  });
//
//    function reLayout() {
//  $container.isotope({
//  resizable: false,
//    itemSelector: '.item',
//  sortBy: 'original-order',
//  layoutMode: 'masonry',
//    masonry: { columnWidth: $container.width() / 12 },
////        masonryHorizontal: {
////            rowHeight: 251
////        },
//        cellsByRow: {
//            columnWidth: 150,
//            rowHeight: 140
//        },
//        cellsByColumn: {
//            columnWidth: 150,
//            rowHeight: 140
//        },
//      getSortData : {
//          symbol : function( $elem ) {
//            return $elem.find('.gi_data_category').text();
//          },
//          number : function( $elem ) {
//            return parseInt( $elem.find('.number').text(), 10 );
//          },
//          score : function( $elem ) {
//            return parseInt( $elem.find('.score').text(), 10 );
//          },
//          name : function ( $elem ) {
//            return $elem.find('.gi_data .gi_title').text();
//          }
//    }
//
//  });
//  }
//
//
// // update columnWidth on window resize
//$(window).smartresize(function(){
//  $container.isotope({
//    // update columnWidth to a percentage of container width
//    masonry: { columnWidth: $container.width() / 12 }
//  });
//});
//
//  // get Isotope instance
//  var isotope = $container.data('isotope');
//  // add even classes to every other visible item, in current order
//  function addEvenClasses() {
//    isotope.$filteredAtoms.each( function( i, elem ) {
//      $(elem)[ ( i % 2 ? 'addClass' : 'removeClass' ) ]('even')
//    });
//  }
//
////regular filters
//$checkboxes.change(function(){
//    var filters = [];
//    // get checked checkboxes values
//    $checkboxes.filter(':checked').each(function(){
//      filters.push( this.value );
//    });
//
//  $(this).parents("div.sbf_filter").toggleClass("sbf_filter_active");
//  $('#filters .all').parents("#filters div.sbf_filter").removeClass("sbf_filter_active");
//
//    filters = filters.join(', ');
//    $container.isotope({
//    filter: filters,
//    layoutMode: 'masonry',
//        masonryHorizontal: {
//            rowHeight: 55
//        },
//        cellsByRow: {
//            columnWidth: 200,
//            rowHeight: 140
//        },
//        cellsByColumn: {
//            columnWidth: 200,
//            rowHeight: 140
//        }
//  });
//    addEvenClasses();
//});
//
//  var $checkboxess = $('#filters-second input');
//
//
////second lvl of filters
//$checkboxess.change(function(){
//    var filters = [];
//    // get checked checkboxes values
//    $checkboxess.filter(':checked').each(function(){
//      filters.push( this.value );
//    });
//
//  $(this).parents("div.sbf_filter").toggleClass("sbf_filter_active");
//  $('#filters-second .all').parents("#filters-second div.sbf_filter").removeClass("sbf_filter_active");
//
//    filters = filters.join(', ');
//    $container.isotope({
//    filter: filters,
//    layoutMode: 'masonry',
//    masonry: {
//            columnWidth: 55
//        },
//        masonryHorizontal: {
//            rowHeight: 55
//        },
//        cellsByRow: {
//            columnWidth: 200,
//            rowHeight: 140
//        },
//        cellsByColumn: {
//            columnWidth: 200,
//            rowHeight: 140
//        }
//  });
//    addEvenClasses();
//});
//
//
//  // sorting
//  $('#sorts a').click(function(){
//    // get href attribute, minus the #
//      console.log('attribute clicked');
//
//    var $this = $(this),
//        sortName = $this.data('sort');
//    //isotope container
//    $container.isotope({
//      sortBy : sortName,
//    layoutMode: 'masonry',
//    masonry: {
//            columnWidth: 55
//        },
//        masonryHorizontal: {
//            rowHeight: 55
//        },
//        cellsByRow: {
//            columnWidth: 200,
//            rowHeight: 140
//        },
//        cellsByColumn: {
//            columnWidth: 200,
//            rowHeight: 140
//        }
//    });
//
//    // switches selected class on buttons
//    // don't proceed if already selected
//    if ( !$this.hasClass('btn_sort_selected') ) {
//      $this.parents('#sorts').find('.btn_sort_selected').removeClass('btn_sort_selected');
//      $this.addClass('btn_sort_selected');
//    }
//    return false;
//  });
//
//
//});


//$('#filters .sbf_filter .all').parents("#filters div.sbf_filter").addClass("sbf_filter_active");
//
//$('#filters .sbf_filter .all').click(function(){
//  $('#filters .sbf_filter').removeClass('sbf_filter_active');
//  $(this).parents("#filters div.sbf_filter").addClass("sbf_filter_active");
//});
//
//
//    $('#filters-second .sbf_filter .all').parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");
//
//    $('#filters-second .sbf_filter .all').click(function(){
//        $('#filters-second .sbf_filter').removeClass('sbf_filter_active');
//        $(this).parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");
//    });
//
//  $('#container').find('.g_item').css('position','static');
//  $('.btn_sort.org').click(function(){
//     console.log('org...');
//     var $container = $('#container');
//   $container.isotope({ sortBy: 'original-order' });
//  });

  var tCont = $('#si_descr_faq .sia_txt_section').each(function(){
    var pCont = $(this).find('p').first();
    var answerFaq = $('<b />',{
      html: 'A '
    });
    answerFaq.prependTo(pCont);
  });




});



/*  ----------------------------------------------------------------------------------- */
/*  ----------------------------------- Custom forms ---------------------------------- */
/*  ----------------------------------------------------------------------------------- */


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

    //business form toggle buttons
    $('#business_form > .form_section .business_field_questionnaire ').each(function(index){
      $('.wpcf7-list-item').addClass('btn bg_btn');
       var thisId = $(this).attr('id', 'id-' + index);
       var pathForThisId = $(thisId).find('.bq_answer .bq_btn_sort_wrapper .btn');
        $(pathForThisId).click(function(e) {



        var $checkbox = $(this).find(':checkbox');
        $(pathForThisId).removeClass("bq_btn_yes_selected", $checkbox.attr('checked'));

        $(".bq_answer .bq_btn_sort_wrapper .btn span input :checkbox").not($checkbox).removeAttr("checked");
        if (e.target.type == "checkbox") {

          // stop the bubbling to prevent firing the row's click event
          e.stopPropagation();
          $(this).filter(':has(:checkbox)').addClass('bq_btn_yes_selected', $checkbox.attr('checked'));
        } else {

          $checkbox.attr('checked', !$checkbox.attr('checked'));
          $(this).filter(':has(:checkbox)').addClass('bq_btn_yes_selected', $checkbox.attr('checked'));
        }
      });
    });

    $('.bq_question .btn.btn_info').click(function(){
      //console.log('info drop down open');
       $(this).parent('.bq_inner_wrapper').children('.bq_info').slideToggle('slow');
    });


});

$( function() {

  var $container = $('#container');
  $container.isotope({
    layoutMode: 'masonry',
    itemSelector: '.item',
	masonryHorizontal: {
	  rowWidth: 250,
	  rowHeight: 250,
	  gutter: 10
	},
 getSortData: {
    name: '.gi_title',
    role: '.gi_job',
    personCategory: '.gi_person_category',
	firstName : '.gi_firstname',
    //number: '.number parseInt',
    category: '[data-category]',
//    weight: function( itemElem ) {
//      var weight = $( itemElem ).find('.weight').text();
//      return parseFloat( weight.replace( /[\(\)]/g, '') );
//    }
  }

  });

  var filterFns = {
  // show if number is greater than 50
  numberGreaterThan50: function() {
    var number = $(this).find('.number').text();
    return parseInt( number, 10 ) > 50;
  },
  // show if name ends with -ium
  ium: function() {
    var name = $(this).find('.name').text();
    return name.match( /ium$/ );
  }
};


var filtersGroup = $('.sb_filters .sbf_filtergroup');
var id ='';
if (filtersGroup.attr('id') === 'filters-demo-type') {
	//console.log('filter by type');
	var id = '#filters-demo-type';
    // attribute exists
} else {
    // attribute does not exist
	//console.log('filter by category');
	var id = '#filters-demo';
}

//var filters = $(id);

// filter items on button click
$('#filters-demo-type').on( 'click', 'button', function() {
	var filterValue = $(this).attr('data-filter');
	// use filter function if value matches
	filterValue = filterFns[ filterValue ] || filterValue;
	$container.isotope({ filter: filterValue });


	$('#filters-demo-type').find('.sbf_filter').removeClass("sbf_filter_active");
	$('#filters-demo-type .all').parents(id + " div.sbf_filter").removeClass("sbf_filter_active");
	$(this).parents("div.sbf_filter").addClass("sbf_filter_active");
	//var id = '';
});


//second lvl
$('#filters-demo').on( 'click', 'button', function() {
	var filterValue = $(this).attr('data-filter');
	// use filter function if value matches
	filterValue = filterFns[ filterValue ] || filterValue;
	$container.isotope({ filter: filterValue });


	$('#filters-demo').find('.sbf_filter').removeClass("sbf_filter_active");
	$('#filters-demo .all').parents(id + " div.sbf_filter").removeClass("sbf_filter_active");
	$(this).parents("div.sbf_filter").addClass("sbf_filter_active");
	//var id = '';
});

$('#sorts-demo').on( 'click', 'button', function() {
  var sortByValue = $(this).attr('data-sort-by');
  $container.isotope({ sortBy: sortByValue });
   var $this = $(this);
  //    // switches selected class on buttons
//    // don't proceed if already selected
    if ( !$this.hasClass('btn_sort_selected') ) {
      $this.parents('#sorts-demo').find('.btn_sort_selected').removeClass('btn_sort_selected');
      $this.addClass('btn_sort_selected');
    }


});


$(id).parents(id + "div.sbf_filter").addClass("sbf_filter_active");

$(id + ' .sbf_filter .all').click(function(){
  $(id + '.sbf_filter').removeClass('sbf_filter_active');
  $(this).parents(id +  "div.sbf_filter").addClass("sbf_filter_active");
});


//
//    $('#filters-second .sbf_filter .all').parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");
//
//    $('#filters-second .sbf_filter .all').click(function(){
//        $('#filters-second .sbf_filter').removeClass('sbf_filter_active');
//        $(this).parents("#filters-second div.sbf_filter").addClass("sbf_filter_active");
//    });

	// $('.gi_training').click(function() {

	//   var $inner = $(this).find('>.inner');

	//   if ($inner.hasClass('gi_training_show')) {
	// 	TweenLite.to($(this).find('>.inner'), 0.5, { className: '-=gi_training_show' });
	//   } else {
	// 	TweenLite.to($(this).find('>.inner'), 0.5, { className: '+=gi_training_show' });
	//   }

	//   $(this).toggleClass('gi_training_show');

	//   $container.isotope('layout');
	// });

	$('.grid_post .gi_training').css('max-height','100%');
});



$(document).ready(function () {

  $(".moodle-iframe").load(function () {

    var ifr = document.getElementsByClassName("moodle-iframe");

    var anchors = ifr.contentDocument.getElementsByTagName("input");

    for (var i in anchors) {

      anchors[i].setAttribute("target", "_blank");

    }

  });

});



/*  ----------------------------------------------------------------------------------- */
/*  --------------------------------- Menu z-index bug fix ---------------------------- */
/*  ----------------------------------------------------------------------------------- */


/* ------------ To make two column the same height ------------ */

// $(".mm_menu li").mouseenter(function(){
//   $(this).find('.sub-menu').addClass('show-menu');
// });

// $(".mm_menu li").mouseleave(function(){
//   $(this).find('.sub-menu').removeClass('show-menu');
// });
