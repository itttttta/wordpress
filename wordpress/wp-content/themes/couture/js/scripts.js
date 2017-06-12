//Masonry

jQuery(document).ready(function($){

var $container = $('.masonry').imagesLoaded( function() {

$container.imagesLoaded(function(){
$container.masonry({
  // options
  columnWidth: 1,
  itemSelector: '.masonry-col',
  percentPosition: true,

});});});

});

var Couture = Couture || {}; // global storage for the Couture site;
Couture.theme = Couture.theme || {};
//offcanvas sidebar
Couture.theme.offCanvas = function() {

    // variables for elements
    var nav = jQuery('#cssmenu'),
        navToggle = jQuery('.sidebar-toggle-btn'),
        pageWrap = jQuery('body'),
        mask = jQuery('.sidebar-off-canvas-mask'),
        offcanvas = jQuery('.sidebar-off-canvas');

    offcanvas.on("off-canvas:open", function(event) {
        nav.addClass('nav--open');
        pageWrap.addClass('nav--open');
        mask.addClass('active');
        navToggle.addClass('active');
    });

    offcanvas.on("off-canvas:close", function(event) {
        nav.removeClass('nav--open');
        pageWrap.removeClass('nav--open');
        mask.removeClass('active');
        navToggle.removeClass('active');
    });

    // a function to toggle the nav
    navToggle.on('click', function() {
        offcanvas.trigger("off-canvas:open");
        jQuery('search-bar').trigger("search-bar:close");
    });

    jQuery(document).on('click', '.sidebar-off-canvas-mask', function() {
        offcanvas.trigger("off-canvas:close");
    });
};

jQuery(function($) {
    Couture.theme.offCanvas();
});


Couture.posts = Couture.posts || {};
//post Comments
Couture.posts.ViewCounter = function($element) {

    if ( typeof couture_post_views === "undefined" ) {
        return false;
    }

    if ( jQuery('body').hasClass('single-post') ) {

        setTimeout(function() {
            jQuery.ajax({
                type: "GET",
                url: window.couture_post_views.ajaxurl,
                data: "postviews_id=" + window.couture_post_views.post_id + "&action=couture_count_post_views",
                cache: false
            });
        }, 1500);

    }

};

jQuery(function($) {
    Couture.posts.ViewCounter();
});
