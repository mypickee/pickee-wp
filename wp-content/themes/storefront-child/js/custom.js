(function() {
  jQuery( window ).load( function() {
    jQuery('.topbar-cart-toggle').click( function(e) {
      jQuery('#topbar-cart').toggleClass('visible');
      jQuery('body').toggleClass('cart-open');
      e.preventDefault();
    });
    jQuery('.topbar-menu-toggle').click( function(e) {
      jQuery('#topbar-menu').toggleClass('visible');
      jQuery('.storefront-handheld-footer-bar').toggleClass('visible');
      jQuery('body').toggleClass('cart-open');
      e.preventDefault();
    });
    jQuery('.topbar-menu').on('click', 'li.menu-item-has-children > a', function(e) {
      console.log('here');
      e.preventDefault();
      jQuery(this).siblings('ul.sub-menu').addClass('expand');
      jQuery('.topbar-menu-back').addClass('visible');
      jQuery(this).closest('ul').addClass('expand');
    });
    jQuery('.topbar-menu .topbar-menu-back').click( function(e) {
      jQuery('.topbar-menu ul').removeClass('expand');
      jQuery(this).removeClass('visible');
      jQuery(this).closest('ul').addClass('covered');
    });

    jQuery(".search-clear-btn").click(function(){
      jQuery(this).closest('.site-search').find(".search-field").val('');
      jQuery(this).addClass('hidden');
    });
  });
})();
