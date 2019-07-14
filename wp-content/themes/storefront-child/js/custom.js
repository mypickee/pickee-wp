(function($) {
  $( window ).load( function() {
    $('.header-cart-toggle').click( function(e) {
      $('#header-cart').toggleClass('visible');
      $('body').toggleClass('cart-open');
      e.preventDefault();
    });
    $('.header-menu-toggle').click( function(e) {
      $('#header-menu').toggleClass('visible');
      $('body').toggleClass('cart-open');
      e.preventDefault();
    });

    $('#header-search-toggle').on('click', function(e){
      if ($(this).hasClass('expand')) {
        close_header_search_bar();
      } else {
        expand_header_search_bar();
      }
    });

    function close_header_search_bar()
    {
      $('#header-search-bar').removeClass('visible');
      $('#header-search-bar').find(':input.search-field')[0].blur();
      $('#header-search-toggle').removeClass('expand');
    }

    function expand_header_search_bar()
    {
      close_header_account_dropdown();
      $('#header-search-bar').addClass('visible');
      $('#header-search-bar').find(':input.search-field')[0].focus();
      $('#header-search-toggle').addClass('expand');
    }

    $('#header-account-toggle').on('click', function(e){
      if ($(this).hasClass('expand')) {
        close_header_account_dropdown();
      } else {
        expand_header_account_dropdown();
      }
    });

    function expand_header_account_dropdown()
    {
      close_header_search_bar();
      $('#header-account-dropdown').addClass('visible');
      $('#header-account-toggle').addClass('expand');
    }

    function close_header_account_dropdown()
    {
      $('#header-account-dropdown').removeClass('visible');
      $('#header-account-toggle').removeClass('expand');
    }

    $('.header-menu').on('click', 'li.menu-item-has-children > a', function(e) {
      e.preventDefault();
      $(this).siblings('ul.sub-menu').addClass('expand');
      $(this).closest('ul.menu').addClass('expand');
      toggle_handheled_menu_header();
    });

    $('#header-menu-back').click( function(e) {
      $('.header-menu ul').removeClass('expand');
      toggle_handheled_menu_header();
    });

    function toggle_handheled_menu_header()
    {
      $('#header-menu-back').toggleClass('visible');
      $('#handheld-search-toggle, .handheld-sign-in, #handheld-account-toggle').toggleClass('hidden');
      close_handheld_search_bar();
    }

    function close_handheld_search_bar()
    {
      $('#handheld-search-bar').removeClass('visible');
      $('#handheld-search-bar').find(':input.search-field')[0].blur();
      $('#handheld-search-toggle').removeClass('expand');
    }

    function expand_handheld_search_bar()
    {
      close_handheld_account_dropdown();
      $('#handheld-search-bar').addClass('visible');
      $('#handheld-search-bar').find(':input.search-field')[0].focus();
      $('#handheld-search-toggle').addClass('expand');
    }

    $('#header-menu').on('click', '.search-toggle', function(e){
      if ($(this).hasClass('expand')) {
        close_handheld_search_bar();
      } else {
        expand_handheld_search_bar();
      }
    });

    $('#header-menu').on('click', '.account-toggle', function(e){
      if ($(this).hasClass('expand')) {
        close_handheld_account_dropdown();
      } else {
        expand_handheld_account_dropdown();
      }
    });

    function expand_handheld_account_dropdown()
    {
      close_handheld_search_bar();
      $('#handheld-account-dropdown').addClass('visible');
      $('#handheld-account-toggle').addClass('expand');
    }

    function close_handheld_account_dropdown()
    {
      $('#handheld-account-dropdown').removeClass('visible');
      $('#handheld-account-toggle').removeClass('expand');
    }

    $('.carousel-images').slick({
      arrows: false,
      asNavFor: '.carousel-captions'
    });
    $('.carousel-captions').slick({
      prevArrow: '<a class="control-btn btn-prev"><span class="arrow arrow-left"></span></a>',
      nextArrow: '<a class="control-btn btn-next"><span class="arrow arrow-right"></span></a>',
      appendArrows: '.carousel-controls',
      asNavFor: '.carousel-images'
    });
    $('.review-form-toggle').click(function(e){
      $("#review_form_wrapper").toggleClass('hidden');
    });

    $('.products-carousel .products').slick({
      infinite: true,
      slidesToShow: 1,
      centerMode: true,
      centerPadding: '20%',
      prevArrow: '<button type="button" class="control-btn btn-prev"></button>',
      nextArrow: '<button type="button" class="control-btn btn-next"></button>',
    });

    $('select.orderby').select2({
      minimumResultsForSearch: -1,
    });

    /**
     * Click 'Edit' to show edit forms in /my-account page
     */
    $('.myaccount-edit-link, .myaccount-cancel-link').click(function(e){
      e.preventDefault();
      var type = $(this).data('type');
      $('#my-'+type+'-edit').toggleClass('d-none');
      $('#my-'+type+'-block').toggleClass('d-none');
      $('#my-'+type+'-form').toggleClass('d-none');
      $('.country_select, .state_select').selectWoo();
    });
  });
})(jQuery);
