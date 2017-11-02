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
        var default_min_our_score = $('.our_score').data("min");
        var default_max_our_score = $('.our_score').data("max");
        var default_min_user_votes = $('.user_votes').data("min");
        var default_max_user_votes = $('.user_votes').data("max");
        $(function() {

            $( "#slider-range-our-score" ).slider({
                range: true,
                min: default_min_our_score,
                max: default_max_our_score,
                values: [ default_min_our_score, default_max_our_score ],
                slide: function( event, ui ) {
                    $( "#our_score" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#our_score" ).val($( "#slider-range-our-score" ).slider( "values", 0 ) +
                " - " + $( "#slider-range-our-score" ).slider( "values", 1 ) );
        });
        $(function() {
            $( "#slider-range-user-votes" ).slider({
                range: true,
                min: default_min_user_votes,
                max: default_max_user_votes,
                values: [ default_min_user_votes, default_max_user_votes ],
                slide: function( event, ui ) {
                    $( "#user_votes" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
                }
            });
            $( "#user_votes" ).val($( "#slider-range-user-votes" ).slider( "values", 0 ) +
                " - " + $( "#slider-range-user-votes" ).slider( "values", 1 ) );
        });

        $('.search-ajax').click(function(e){
            e.preventDefault();
            var min_range_our_score = $( "#slider-range-our-score" ).slider( "values", 0 );
            var max_range_our_score = $( "#slider-range-our-score" ).slider( "values", 1 );
            var min_range_user_votes = $( "#slider-range-user-votes" ).slider( "values", 0 );
            var max_range_user_votes = $( "#slider-range-user-votes" ).slider( "values", 1 );
            
            //Only fires if something has changed, adds our_score as filter_type
            if(default_min_our_score !== min_range_our_score || default_max_our_score !== max_range_our_score){
                var filter_type = $('.our_score').attr("data-filter-type");
                console.log('our score not equals.. something has changed');
            }

            //Only fires if something has changed, adds user_votes as filter_type
            if(default_min_user_votes !== min_range_user_votes || default_max_user_votes !== max_range_user_votes){
                var filter_type = $('.user_votes').attr("data-filter-type");
                console.log('user votes not equals.. something has changed');
            }

            if (typeof filter_type !== 'undefined') {
                $('.load-casino').addClass("loading-posts");
                $.ajax({
                    url: site_vars.ajax_url,
                    type: "post",
                    data: {
                        action: 'filter_casino',
                        filter_type: filter_type,
                        min_our_score: min_range_our_score,
                        max_our_score: max_range_our_score,
                        min_user_votes: min_range_user_votes,
                        max_user_votes: max_range_user_votes,
                    },
                    beforeSend: function() { 
                    },
                    success: function(result) {
                        $('.load-casino').removeClass("loading-posts");
                        $('.load-casino').replaceWith(result);
                        console.log(result);
                    },
                    error: function(errorThrown){
                       console.log(errorThrown);
                   } 
               });
            }
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