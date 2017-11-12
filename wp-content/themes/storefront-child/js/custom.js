(function($) {
  $( window ).load( function() {
    $('.topbar-cart-toggle').click( function(e) {
      $('#topbar-cart').toggleClass('visible');
      $('body').toggleClass('cart-open');
      e.preventDefault();
    });
    $('.topbar-menu-toggle').click( function(e) {
      $('#topbar-menu').toggleClass('visible');
      $('.storefront-handheld-footer-bar').toggleClass('visible');
      $('body').toggleClass('cart-open');
      e.preventDefault();
    });
    $('.topbar-menu').on('click', 'li.menu-item-has-children > a', function(e) {
      console.log('here');
      e.preventDefault();
      $(this).siblings('ul.sub-menu').addClass('expand');
      $('.topbar-menu-back').addClass('visible');
      $(this).closest('ul').addClass('expand');
    });
    $('.topbar-menu .topbar-menu-back').click( function(e) {
      $('.topbar-menu ul').removeClass('expand');
      $(this).removeClass('visible');
      $(this).closest('ul').addClass('covered');
    });

    $(".search-clear-btn").click(function(){
      $(this).closest('.site-search').find(".search-field").val('');
      $(this).addClass('hidden');
    });

    $('.carousel-images').slick({
      arrows: false,
      asNavFor: '.carousel-captions'
    });
    $('.carousel-captions').slick({
      prevArrow: '<button type="button" class="control-btn btn-prev">&larr;</button>',
      nextArrow: '<button type="button" class="control-btn btn-next">&rarr;</button>',
      appendArrows: '.carousel-controls',
      asNavFor: '.carousel-images'
    });
    $('.review-form-toggle').click(function(e){
      $("#review_form_wrapper").toggleClass('hidden');
    });
  });
})(jQuery);
