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
  $('.se_section_img').toggleClass('se_section_img_expand');
	$(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })


});


/*   news page */


$('#n_maximize').click(function(){
  $('.right-container').toggleClass('right-container_maximize');
  $('.ui-tabs-nav').toggleClass('ui-tabs-nav_minimize');
  $('#n_maximize').toggleClass('btn_action_min');

  $(this).text(function(i, v){
        return v === 'Maximize' ? 'Minimize' : 'Maximize'
    })

    // var str = document.getElementById("g_maximize").innerHTML; 
    // var res = str.replace("Maximize", "Minimize");
    // document.getElementById("g_maximize").innerHTML = res

});



// $('#g_maximize').click(function(){
//   	equalheight('.content_same_height'); 
// });

/*  -------------------- User menu dropdown -------------------- */


$('.user_menu').click(function(){
	$('.user_menu').toggleClass('user_menu_open');
});

$('.um_info').click(function(){
  $('.user_login').toggleClass('user_login_open');
});


// $(document).ready( function(){

//     $('.um_info').click(function(event){
//       event.stopPropagation();
//       $('.user_login').toggleClass('user_login_open');
//     });

//     $(document).click( function(){
//       $('.user_login').removeClass('user_login_open');
//     });
// });



// $(document).ready( function(){

//     $('#trigger').click( function(event){
//         event.stopPropagation();
//         $('#drop').toggle();
//     });

//     $(document).click( function(){
//         $('#drop').hide();
//     });
// });


$(document).mouseup(function (e){

    var container = $(".user_login");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('user_login_open');
    }
});



/*  -------------------- Sticky areas -------------------- */

$.fn.scrollBottom = function() { 
  return $(document).height() - this.scrollTop() - this.height(); 
};

/*  Sticky menu bar code */


$('#searchbar_toggle').click(function(){
  $('.searchbar').toggleClass('searchbar_open');
  $('#searchbar_toggle').toggleClass('searchbar_toggle_close');
});


// $('.hs_main_menu').click(function(){
// 	$('.hs_main_menu').toggleClass('hs_main_menu_open');
// });


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

/* Sticky sidebar */


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





/* Sticky footer */

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

$(window).load(function() {
  equalheight('.n_content_same_height');
});

$(window).resize(function(){
  equalheight('.n_content_same_height'); 
});


// $(document).ready(function() {
//     var height = Math.max($("#content_column_left").height(), $("#content_column_right").height());
//     $("#content_column_left").height(height);
//     $("#content_column_right").height(height);
// });



/* -------------------- Truncate some text -------------------- */


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




/*  -------------------- extended search bar test -------------------- */


$('.search_field').click(function(){
  $('body').toggleClass('extended_search_enabled');
});


/*  -------------------- Menu Item counter -------------------- */


  // $('.ms_menu').each(function() {
  //     var $children = $(this).children(),
  //         count = $children.size(),
  //         $item;

  //         $item = $(this)
  //             .addClass('nth-item-' + 1))

  // });




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


/*  -------------------- Sliding menu on small screens -------------------- */


$('.sliding_toggle').click(function(){
  $('.hs_main_menu').toggleClass('show_sliding_menu');
});

$('.sliding_close').click(function(){
  $('.hs_main_menu').removeClass('show_sliding_menu');
});

$(document).mouseup(function (t){

    var container = $(".hs_main_menu");

    if (!container.is(t.target) // if the target of the click isn't the container...
        && container.has(t.target).length === 0) // ... nor a descendant of the container
    {
        container.removeClass('show_sliding_menu');
    }
});







