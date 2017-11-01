$(document).foundation();

jQuery(function ($) {

    "use strict";
    $(document).ready(function () { // Loaded when DOM is ready

        $(".hamburger").click(function () {
            $(this).toggleClass("is-active");
            $('header').toggleClass("is-active");
            $('#menu-mobile-menu li').toggleClass('show-menu');

            var path = window.location.pathname;
            $("#menu-mobile-menu li a[href*='" + path + "']").addClass("current-page");

        });

        $('.casino-wrapper').after().click(function () {
            console.log($('.casino-wrapper:after'));
            $(this).toggleClass('active-desc');
            $(this).find('.desc').slideToggle("slow");
        });

        $('.menu-mobile-header-container').click(function () {
            $('.hamburger').trigger('click');
        });

        var path = window.location.pathname;
        path = '//localhost:3000/casinochecking.com/poker'
        $(".footer-section a[href*='" + path + "']").parent('.footer-section').addClass("current-page");
        console.log(path)

        //Triggers get bonus fixed button
        var heightThreshold = $("article").offset().top +$("#casino-outer-wrapper").height();
        var heightThreshold_end  = $("article").offset().top +$("article").height()  ;

        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= heightThreshold && scroll <=  heightThreshold_end) {
                $("#fixed-button").slideDown('slow');
            } else {
                $("#fixed-button").slideUp('slow');
            }
        });
    });
});