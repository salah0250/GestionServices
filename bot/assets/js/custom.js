(function ($) {
	
	"use strict";
  // popup 
  $(document).on("click","#openBtn",function() {
    // alert("kokok");
    $('#my-popup').fadeIn();
    
    $('#close-popup').click(function() {
      $('#my-popup').fadeOut();
    });
    
    $(document).keydown(function(event) { 
      if (event.keyCode == 27) { 
        $('#my-popup').fadeOut();
      }
    });
  });

	// Header Type = Fixed
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var box = $('.header-text').height();
    var header = $('header').height();

    if (scroll >= box - header) {
      $("header").addClass("background-header");
    } else {
      $("header").removeClass("background-header");
    }
  });


  // Acc
    $(document).on("click", ".naccs .menu div", function() {
      var numberIndex = $(this).index();

      if (!$(this).is("active")) {
          $(".naccs .menu div").removeClass("active");
          $(".naccs ul li").removeClass("active");

          $(this).addClass("active");
          $(".naccs ul").find("li:eq(" + numberIndex + ")").addClass("active");

          var listItemHeight = $(".naccs ul")
            .find("li:eq(" + numberIndex + ")")
            .innerHeight();
          $(".naccs ul").height(listItemHeight + "px");
        }
    });


	$('.owl-listing').owlCarousel({
		items:1,
		loop:true,
		dots: true,
		nav: false,
		autoplay: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:1
			  },
			  1000:{
				  items:1
			  },
			  1600:{
				  items:1
			  }
		  }
	})
	
  $(document).ready(function(){
    $('.owl-carousel').owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      autoHeight: true,
      autoplay: true,
      items: 3,
      stage: 1,
      rtl: true,
      responsive: {
        0: {
          items: 1,
        },
        480: {
          items: 1,
        },
        800: {
          items: 3,
        }
      }
     });
  });

	// Menu Dropdown Toggle
  if($('.menu-trigger').length){
    $(".menu-trigger").on('click', function() { 
      $(this).toggleClass('active');
      $('.header-area .nav').slideToggle(200);
    });
  }


	// Page loading animation
	 $(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });
})(window.jQuery);


var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
};