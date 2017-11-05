"use strict";

$(document).foundation();

jQuery(function ($) {
    $(document).ready(() => {
        initDom()
        start()
    })
})

function initDom() {
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

    //Triggers get bonus fixed button
    if ($('article').length) {
        var heightThreshold = $("article").offset().top +$("#casino-outer-wrapper").height();
        var heightThreshold_end  = $("article").offset().top +$("article").height();

        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= heightThreshold && scroll <=  heightThreshold_end) {
                $("#fixed-button").slideDown('slow');
            } else {
                $("#fixed-button").slideUp('slow');
            }
        });
    }
}

function start() {
    const elements = {
        score: $('.our_score'),
        votes: $('.user_votes'),
        deposit: $('.minimum_deposit'),
        'signup-bonus': $('.signup_bonus'),
        filterDeposit: $('.filter-deposit'),
        filterBonus: $('.filter-bonus'),
        filterScore: $('.filter-score'),
    }

    const metrics = {
        score: {
            sliderSelector: '#slider-range-our-score',
            displaySelector: '#our_score',
            min: elements.score.data("min"),
            max: elements.score.data("max"),
        },
        votes: {
            sliderSelector: '#slider-range-user-votes',
            displaySelector: '#user_votes',
            min: elements.votes.data("min"),
            max: elements.votes.data("max"),
        },
        deposit: {
            sliderSelector: '#slider-range-min-deposit',
            displaySelector: '#minimum_deposit',
            min: 0,
            max: 400,
        },
        'signup-bonus': {
            sliderSelector: '#slider-range-signup-bonus',
            displaySelector: '#signup_bonus',
            min: 0,
            max: 400,
        }
    }

    // Instantiate sliders for each metric
    Object.keys(metrics).forEach(type => {
        const metric = metrics[type]
        $(metric.sliderSelector).slider({
            range: true,
            min: metric.min,
            max: metric.max,
            values: [ metric.min, metric.max ],
            slide: function( event, ui ) {
                $(metric.displaySelector).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
        }); 
        const displayString = `${$(metric.sliderSelector).slider( "values", 0 )} - ${$(metric.sliderSelector).slider( "values", 1 )}`
        $(metric.displaySelector).val(displayString);
    });

    $('.filter-deposit, .filter-bonus, .filter-score').click(function(){
        $(this).addClass('filter-active');
    });

    // Attach event handler for AJAX submit
    $('.search-ajax, .filter').click((e) => {
        e.preventDefault();

        // Data to submit in request
        const data = {
            action: 'filter_casino',        
        }

        $('.load-casino').addClass('loading-posts');   
        data.active = $('.filter-active').data('filter');
        $('.load-casino').addClass('loading-posts');

        Object.keys(metrics).forEach(type => {
            const metric = metrics[type]
            metric['currentMin'] = $(metric.sliderSelector).slider( "values", 0 )
            metric['currentMax'] = $(metric.sliderSelector).slider( "values", 1 )
            if (metric.min !== metric['currentMin'] || metric.max !== metric['currentMax']) {
                metric.filterType = elements[type].attr('data-filter-type');
            }
            console.log(metrics[type]['currentMin'])
        });


        Object.keys(metrics).forEach(type => {
            const metric = metrics[type]
            if (metric.filterType) {
                data[`filter_type_${type}`] = metric.filterType
            }
            data[`min_${type}`] = metric.currentMin
            data[`max_${type}`] = metric.currentMax
        })

        console.log('Sending data...')
        console.log(JSON.stringify(data, null, 2))

        // Send AJAX request
        ajax(data);
    });

    function ajax(data) {
        $.ajax({
            url: site_vars.ajax_url,
            type: 'post',
            data: data,
            success: function(result) {
                $('.filter').removeClass('filter-active');
                $('.load-casino').removeClass("loading-posts");
                $('.loaded-posts').html(result);
                console.log(result);
            },
            error: function(errorThrown){
               console.log(errorThrown);
           } 
       });
    }
}
