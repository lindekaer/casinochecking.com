"use strict";

$(document).foundation();

jQuery(function ($) {
    $(document).ready(() => {
        initDom()
        start()
    })
})

//Works, also after Ajax-call
$( document ).ajaxStop(function() {
    showDescCasino();
})

function showDescCasino() {
    $('.casino-wrapper').click(function () {
        $(this).toggleClass('active-desc');
        $(this).find('.desc').slideToggle("slow");
    });
}

function initDom() {
    $('.filter-deposit, .filter-bonus, .filter-score').click(function(){
        $(this).addClass('filter-active');
    });    

    //Sets default selected value in country-select
    var usersCountry = $('body').attr('data-user-country');
    $('#countrySelect').val(usersCountry);

    $(".hamburger").click(function () {
        $('header').toggleClass("is-active");
       // $('#menu-mobile-menu li').toggleClass('show-menu');
       var path = window.location.pathname;
       $("#menu-mobile-header li a[href*='" + path + "']").addClass("current-page");
   });

    $('#mobile-footer').click(function(){
        $('.extra-info').slideToggle();
    });

    $('.menu-mobile-header-container').click(function(){
        $('.hamburger').trigger('click');
    })

    $('.filter-bonus, .filter-deposit, .filter-score').click(function(){
        $('.filter').removeClass('active-sort');
        $(this).addClass('active-sort');
    });

    showDescCasino();

    $('#nav-toggle').click(function () {
        $(this).toggleClass('active');
    });

    $(window).scroll(function(){
        if($(window).scrollTop() > 50) {
            $('header').addClass('scroll-active');
        }
        else {
            $('header').removeClass('scroll-active');
        }
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

function infiniteScroll () {
    if ($('.casinos').length) {
        var timer;
        if ( timer ) clearTimeout(timer);

        $(window).scroll(function() {
           if ( timer ) clearTimeout(timer);
           var shownPosts = 10;
           var docHeight = $(document).height();
           var windowHeight = $(window).height();
           var footerHeight = $('footer').height();
           var sectionPaddingBottom = $('.comparison-section').css('padding-bottom').replace('px', '');
           var headerHeight = $('header').height();
           var totalPosts = $('.loaded-posts').attr('data-count');

           //Check whether scrolled to bottom
           console.log(totalPosts)
           if (docHeight - windowHeight - footerHeight - sectionPaddingBottom <= $(window).scrollTop() + headerHeight) {
            //Sends ajax if there are more total posts than shownPosts
            if(totalPosts >= shownPosts) {
                $('.load-more').addClass('loading-posts');
                //Sets timeout on Ajax call to avoid Ajax request on each scrolled pixel 
                timer = setTimeout(function(){  
                    const data = {
                        action: 'filter_casino',        
                    }

                    Object.keys(metrics).forEach(type => {
                        const metric = metrics[type]
                        metric['currentMin'] = $(metric.sliderSelector).slider( "values", 0 )
                        metric['currentMax'] = $(metric.sliderSelector).slider( "values", 1 )
                        metric.filterType = elements[type].attr('data-filter-type');
                        console.log(metrics[type]['currentMin'])
                    });

                    Object.keys(metrics).forEach(type => {
                        const metric = metrics[type]
                        data[`filter_type_${type}`] = metric.filterType
                        data[`min_${type}`] = metric.currentMin
                        data[`max_${type}`] = metric.currentMax
                    });
                    data['posts_per_page'] = shownPosts;

                    morePosts(data);
                }, 200);
            }
        } 
        else {
            console.log('not the end')
        }
    });
    }
}

function morePosts(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            $('.loaded-posts').append(result);
            $('.load-more').removeClass('loading-posts'); 
            console.log(result);
        },
        error: function(errorThrown){
         console.log(errorThrown);
     }
 });
}

function start() {

    //Infinite scroll with ajax-calls
    infiniteScroll();

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
    function instantiateSlider() {
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
    }
    instantiateSlider()

    function resetFilter() {
        $('.reset-filter').click(function(e){
            e.preventDefault();
            const data = {
                action: 'filter_casino',        
            }
            Object.keys(metrics).forEach(type => {
                const metric = metrics[type]
                data[`min_${type}`] = metric.min
                data[`max_${type}`] = metric.max
            })
            ajax(data);
            instantiateSlider()
            $('.filter').removeClass('active-sort');
            $('.filter-bonus').addClass('active-sort');
        });
    }
    resetFilter();

    function ajaxParams() {
     // Data to submit in request
     const data = {
        action: 'filter_casino',        
    }

    data['country'] = $('body').attr('data-user-country');
    console.log(data['country'])

    $('.load-casino').addClass('loading-posts');   
    data.active = $('.filter-active').data('filter');
    $('.load-casino').addClass('loading-posts');

    Object.keys(metrics).forEach(type => {
        const metric = metrics[type]
        metric['currentMin'] = $(metric.sliderSelector).slider( "values", 0 )
        metric['currentMax'] = $(metric.sliderSelector).slider( "values", 1 )
        metric.filterType = elements[type].attr('data-filter-type');
        console.log(metrics[type]['currentMin'])
    });

    Object.keys(metrics).forEach(type => {
        const metric = metrics[type]
        data[`filter_type_${type}`] = metric.filterType
        data[`min_${type}`] = metric.currentMin
        data[`max_${type}`] = metric.currentMax
    })

    console.log('Sending data...')
    console.log(JSON.stringify(data, null, 2))

        // Send AJAX request
        ajax(data);
    }

    // Attach event handler for AJAX submit
    $('.search-ajax, .filter').click((e) => {
        e.preventDefault();
        ajaxParams();
    });

    //Loads ajax on load
    ajaxParams();

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