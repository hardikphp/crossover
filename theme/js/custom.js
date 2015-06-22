/* 
    Document   : Synero
    Created on : Aug 23, 2014, 07:07:07 PM
    Author     : Harry
    Description: Synero - one page HTML Template
    Version    : V1.0
    file: custome js(editable)
    */

/* ==============================================
 Page Preloader
 =============================================== */

$(window).load(function() {
	$(".loader").delay(300).fadeOut();
	$(".animationload").delay(600).fadeOut("slow");
});

/* ==============================================
 NiceScroll
 =============================================== */

jQuery("html").niceScroll({
    scrollspeed: 70,
    mousescrollstep: 25,
    cursorwidth: 7,
    cursorborder: 0,
    cursorcolor: '#3faad9',
    autohidemode: false,
    zindex: 9999999,
    horizrailenabled: false,
    cursorborderradius: 0
});

/* ==============================================
 Sticky header on scroll
 =============================================== */

$(window).load(function() {
    $(".sticky").sticky({topSpacing: 0});
});

/* ==============================================
 Parallax
 =============================================== */

$(window).stellar({
    horizontalScrolling: false,
    responsive: true,
     scrollProperty: 'scroll',
     parallaxElements: false,
     horizontalScrolling: false,
     horizontalOffset: 0,
     verticalOffset: 0
});

/* ==============================================
 Owl carousel for testimonials
 =============================================== */

$(document).ready(function() {
    $("#testi-carousel").owlCarousel({
        // Most important owl features
        items: 1,
        itemsCustom: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        singleItem: false,
        startDragging: true,
        autoPlay: true
    });
});

/* ==============================================
 Owl carousel for Upcoming Project
 =============================================== */

$(document).ready(function() {
    $("#project-carosel").owlCarousel({
        // Most important owl features
        slideSpeed : 300,
        items: 1,
        itemsCustom: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        singleItem: false,
        startDragging: true,
    });
});

/* ==============================================
 Owl carousel for Twitter-Tweet
 =============================================== */

$(document).ready(function() {
    $("#twitter").owlCarousel({
        // Most important owl features
        slideSpeed : 300,
        items: 1,
        itemsCustom: false,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        singleItem: false,
        startDragging: true,
        autoPlay: 8000
    });
});


/* ==============================================
 WOW plugin triggers animate.css on scroll
 =============================================== */

var wow = new WOW(
    {
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 10, // distance to the element when triggering the animation (default is 0)
        mobile: false        // trigger animations on mobile devices (true is default)
    }
);
wow.init();

/* ==============================================
 Portfolio-Mix
 =============================================== */
 jQuery('#grid').mixitup({
        targetSelector: '.mix',
});;


/* ==============================================
 Smooth Scroll To Anchor
 =============================================== */

//jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('.navbar a').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 50
        }, 1800, 'easeInOutExpo');
        event.preventDefault();
    });
});


/* ==============================================
Scroll to top
=============================================== */
     
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    }); 

    $('.back-to-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
/* ==============================================
11.Validate Contact Us Data
=============================================== */
function ValidateContactUs() {

    var title = $("#name").val();

    var err = "";
    if (title == "Name" || title == "" || title == null) {
        $("#name").addClass("validation");

        var err = "error";
    } else {
        $("#name").removeClass("validation");
    }
    var email = $("#email1").val();
    if (!(/(.+)@(.+){2,}\.(.+){2,}/.test(email))) {
        $("#email1").addClass("validation");

        var err = "error";
    } else {
        $("#email1").removeClass("validation");
    }
    var title = $("#message").val();
    if (title == "Message" || title == "" || title == null) {
        $("#message").addClass("validation");
        var err = "error";
    } else {
        $("#message").removeClass("validation");
    }
    return err;
}
/* ==============================================
12.Contact us submit button event
=============================================== */
$("#submit_btn").click(function(e) {
    if (ValidateContactUs() == "") {
        var resulttext = $.ajax({
            type: "POST",
            url: "contact",
            data: $("#form1").serialize(),
            async: false,
            success: function(status) {}
        }).responseText;

        $("#successmsg1").html(resulttext);
        $("#form1").delay(100).slideUp(1000, function() {

            $('#successmsg1').delay(500).slideDown(500);
        });
        $("#name").val('');
        $("#email1").val('');
        $("#message").val('');
    }
    e.preventDefault();
    return false;
});