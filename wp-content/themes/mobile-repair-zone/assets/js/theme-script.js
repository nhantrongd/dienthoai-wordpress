function mobile_repair_zone_openNav() {
  jQuery(".sidenav").addClass('show');
}
function mobile_repair_zone_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function mobile_repair_zone_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const mobile_repair_zone_nav = document.querySelector( '.sidenav' );

      if ( ! mobile_repair_zone_nav || ! mobile_repair_zone_nav.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...mobile_repair_zone_nav.querySelectorAll( 'input, a, button' )],
        mobile_repair_zone_lastEl = elements[ elements.length - 1 ],
        mobile_repair_zone_firstEl = elements[0],
        mobile_repair_zone_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && mobile_repair_zone_lastEl === mobile_repair_zone_activeEl ) {
        e.preventDefault();
        mobile_repair_zone_firstEl.focus();
      }

      if ( shiftKey && tabKey && mobile_repair_zone_firstEl === mobile_repair_zone_activeEl ) {
        e.preventDefault();
        mobile_repair_zone_lastEl.focus();
      }
    } );
  }
  mobile_repair_zone_keepFocusInMenu();
} )( window, document );

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
      margin: 0,
      nav: false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      loop: true,
      dots:false,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1024: {
          items: 1
      }
    }
  })
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});

jQuery(window).scroll(function() {
  var data_sticky = jQuery('.navigation_header').attr('data-sticky');

  if (data_sticky == "true") {
    if (jQuery(this).scrollTop() > 1){  
      jQuery('.navigation_header').addClass("stick_header");
    } else {
      jQuery('.navigation_header').removeClass("stick_header");
    }
  }
});

jQuery(document).ready(function(){
  jQuery('span.search-box a').click(function(){
    jQuery(".serach_outer").toggle();
  });
});

jQuery('.serach_inner input.search-field').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('.serach_inner [type="submit"]').focus();
  }
});

jQuery('.serach_inner [type="submit"]').on('keydown', function (e) {
  if (jQuery("this:focus") && (e.which === 9)) {
    e.preventDefault();
    jQuery(this).blur();
    jQuery('span.search-box a').focus();
  }
});

jQuery(document).ready(function() {
  var owl = jQuery('#team_post .owl-carousel');
    owl.owlCarousel({
      margin: 25,
      nav: false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      loop: true,
      dots:false,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1024: {
          items: 3
      }
    }
  })
})