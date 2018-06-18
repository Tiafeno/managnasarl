/*----------------------
   Template Name: Haven Real Estate html5 template
    Description: This is html5 template
    Author: Devitems
    Version: 1.0
---------------------------*/
(function ($) {
  "use strict";


  /*-------------------------------------------
      jQuery MeanMenu
   --------------------------------------------- */
  jQuery('nav#dropdown').meanmenu();

  /*-------------------------------------------
     wow js active
  --------------------------------------------- */
  new WOW().init();

  /*-------------------------------------------
     toltip js active
  --------------------------------------------- */
  $('[data-toggle="tooltip"]').tooltip();

  /*----------------------------
     stickey menu
  ----------------------------*/
  $(window).on('scroll', function () {
    var scroll = $(window).scrollTop();
    if (scroll < 265) {
      $(".sticky-header").removeClass("sticky");
    } else {
      $(".sticky-header").addClass("sticky");
    }
  });

  $('.close-home').on('click', function () {
    $('.find-home-box').addClass('fadeOut');

  });

  $(document).ready(function () {


    /*------------------------------------
      Search Bar
    --------------------------------------*/

    $('.search-icon a').on('click', function () {
      $('.header').toggleClass('search-box-show');
      return false;
    });

    $('.search-close-btn a').on('click', function () {
      $('.header').toggleClass('search-box-show');
      return false;
    });
    /*----------------------
        magnificPopup active
    --------------*/
    $('.play-button a').magnificPopup({
      disableOn: 0,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: true,

      fixedContentPos: false
    });
    /*----------------------
        collpase active
    --------------*/
    $(".accordion-active").collapse({
      accordion: true,
      open: function () {
        this.slideDown(550);
      },
      close: function () {
        this.slideUp(550);
      }
    });


    /*--------------------
        You tube video active
    -------------------------*/
    $(".youtube-bg").YTPlayer({
      videoURL: "https://youtu.be/vb5KLYAtPIs",
      containment: '.youtube-bg',
      mute: true,
      loop: true,
      showControls: true

    });

    /*--------------------------
     Parallax active
  ----------------------*/
    $('.parallax').parallax("50%", 0.5);

    /*--------------------------
      Counter Up
    ---------------------------- */
    $('.counter').counterUp({
      delay: 70,
      time: 5000
    });

    /*-------------------------------------------
     scrollUp jquery active
   --------------------------------------------- */
    $.scrollUp({
      scrollText: '<i class="icofont icofont-simple-up"></i>',
      easingType: 'linear',
      scrollSpeed: 900,
      animation: 'fade'
    });

    /*-----------------------------
    Loader activation here.
    -------------------------------*/
    $("#fakeLoader").fakeLoader({
      timeToHide: 1500,
      zIndex: 999999,
      spinner: "spinner1",   //Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
      bgColor: "#fff"
    });
  });

})(jQuery);




