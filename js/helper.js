/* _helper.js */

jQuery(document).ready(function($) {
  // var jQuery = $;

  // ================================
  // Setup Objects and Selectors
  // ================================

  var INIT = INIT || {},

      // Global

      SIDECAR = SIDECAR || {},
      STICKY_NAV = STICKY_NAV || {},
      BACKGROUND_IMAGE = BACKGROUND_IMAGE || {},
      VIDEO_EMBED = VIDEO_EMBED || {},
      SMOOTH_SCROLL = SMOOTH_SCROLL || {},

      // Pages

      HOME = HOME || {},
      DEFAULT = DEFAULT || {},
      SITEMAP = SITEMAP || {},
      PAGE_404 = PAGE_404 || {};

  var isHome = $('body.home').length,
      isDefault = $('body.default').length,
      isSitemap = $('div.sitemap').length,
      is404 = $('body > form.http-404').length;


  // ================================
  // Initiation of all Functions
  // ================================

  INIT = {

    init: function() {

      // Initialize Global Objects
      SIDECAR.init();
      STICKY_NAV.init();
      BACKGROUND_IMAGE.init();
      VIDEO_EMBED.init();
      SMOOTH_SCROLL.init();

      // Initialize Page Template Objects
      if (isHome) { HOME.init(); }
      if (isDefault) { DEFAULT.init(); }
      if (isSitemap) { SITEMAP.init(); }
      if (is404) { PAGE_404.init(); }

    }

  };

  // ================================
  // Sidecar
  // ================================

  SIDECAR = {
    init: function() {
      this.toggle();
      this.menu();
    },

    toggle: function() {
      $('#sidecar-toggle').click(function() {
        $(this).toggleClass('active');
        $('header, .body-overlay, #sidecar, #siteWrapper').toggleClass('active');
        $('body').toggleClass('locked');
      });

      $('#close-sidecar').click(function(){
        $('header, #sidecar-toggle, .body-overlay, #sidecar, #siteWrapper').removeClass('active');
        $('body').removeClass('locked');
      });

      $('.body-overlay').click(function(){
        $('header, #sidecar-toggle, .body-overlay, #sidecar, #siteWrapper').removeClass('active');
        $('body').removeClass('locked');
      });
    },

    menu: function() {
      $('#sidecar #mainnav li').each(function() {
        if ($(this).children('ul').length >= 1) {
            $(this).addClass('hasChild');
            $(this).append('<a class="expand"></a>');
        }
      });

      $('#sidecar .expand').click(function() {
        $(this).parent().children('ul').toggleClass('active');
        $(this).toggleClass('active');
      });
    }
  };

  // ================================
  // Sticky Nav
  // ================================

  STICKY_NAV = {
    init: function() {
      // this.stick();
      // this.dropdowns();
    },

    // stick: function() {
    //   var lastScrollTop = 0;
    //   window.addEventListener("scroll", function(){
    //      var st = window.pageYOffset || document.documentElement.scrollTop;
    //      if (st > lastScrollTop && st > 100){
    //         // downscroll
    //         $('header').addClass('scroll');

    //      } else {
    //         // upscroll
    //         $('header').removeClass('scroll');
    //      }
    //      lastScrollTop = st <= 0 ? 0 : st; // For mobile or negative scrolling
    //   }, false);
    // },

    // dropdowns: function() {
    //   $('.flex-nav #mainnav li').each(function() {
    //     if ($(this).children('ul').size() >= 1) {
    //         $(this).addClass('hasChild');
    //     }
    //   });
    // }
  };

  // ================================
  // Background Image JS
  // ================================

  BACKGROUND_IMAGE = {
    init: function() {
      this.background();
    },

    background: function() {
      $(".bg-image-js").each(function() {
        var img = $(this).find("img")[0];
        if (img !== undefined && img.getAttribute("src") !== undefined) {
          $(this).css({
            "background-image": "url(" + img.getAttribute("src") + ")"
          });
          img.parentNode.removeChild(img);
        }
      });
    }
  };

  // ================================
  // Iframe Video Embeds
  // ================================

  VIDEO_EMBED = {
    init: function() {
      this.wrap();
    },

    wrap: function() {
      $('iframe[src*="youtube"], iframe[src*="vimeo"]').each(function(){
        $(this).wrap('<div class="embed-container"></div>');
      });
    }
  };

  // ================================
  // Smooth scrolling anchors
  // ================================

  SMOOTH_SCROLL = {
    init: function() {
      this.anchors();
    },

    anchors: function() {
      $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate({
              scrollTop: target.offset().top - 100
            }, 1000);
          }
        }
      });
    }
  };

  // ================================
  // Homepage
  // ================================

  HOME = {
    init: function() {

    },
  };

  // ================================
  // Default template
  // ================================

  DEFAULT = {
    init: function() {

    },
  };

  // ================================
  // Sitemap
  // ================================

  SITEMAP = {
    init: function() {

    },
  };

  // ================================
  // 404
  // ================================

  PAGE_404 = {
    init: function() {

    },
  };

  // Initialize
  INIT.init();

}); // end doc ready
