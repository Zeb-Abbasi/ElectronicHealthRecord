$(function () {
    // Hide the gallery initially
    $('.gallery').hide();
  
    // Show the gallery after the JavaScript code has executed
    $(window).on('load', function () {
      $('.gallery').show();
  
      $(".gallery").children(":gt(100)").hide();
  
      $('.more-portfolio').click(function () {
        $('.portfolio').css('display', 'block');
      });
  
      $('.gallery').magnificPopup({
        delegate: '.popimg',
        type: 'image',
        gallery: {
          enabled: true
        }
      });
  
      $('.gallery').isotope({
        // options
        itemSelector: '.items'
      });
  
      var $gallery = $('.gallery').isotope({
        // options
      });
  
      // filter items on button click
      $('.filtering').on('click', 'span', function () {
  
        var filterValue = $(this).attr('data-filter');
  
        $gallery.isotope({
          filter: filterValue
        });
  
      });
  
      $('.filtering').on('click', 'span', function () {
  
        $(this).addClass('active').siblings().removeClass('active');
  
      });
    });
  });