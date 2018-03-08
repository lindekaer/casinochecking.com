$(document).foundation();

jQuery(function($) {
    "use strict";
    $(document).ready(function(){
        $('.load-casino').addClass("loading-posts");
        $.ajax({
            cache: false,
            url: "https://ssl.geoplugin.net/json.gp?k=4d3e05fdf923bc77",
            dataType: "json",
            success: function(data) {
                console.log(data)
                var country = data.geoplugin_countryCode;
                var currency = data.geoplugin_currencyCode;
                console.log(country)
                $('body').attr('data-user-country', country);
                $('body').attr('data-user-currency', currency);
            },
            complete: function(data) {
                console.log( "second success" );
                initializePage()
                initDom();
            },
            error: function(data) {
                var country = 'all';
                $('body').attr('data-user-country', country);
                initializePage();
                initDom();
            }
        });
    })
});

function initializePage() {
    add_casino_menu();
    if($('.post-type-archive').length){
        setCurrency();
    }
    if(!$('.post-type-archive').length){
        singleCasinoCurrency();
        singleCasinoAvailability();
    }
    add_casino_sidebar();
}

function singleCasinoCurrency(){
    //Sets default currency based on the country
    var usersCountry = $('body').attr('data-user-country');
    if(usersCountry == 'DK'){
        $('.numeric_currency').attr('data-currency', 'DKK');
    }

    else if(usersCountry == 'GB'){
        $('.numeric_currency').attr('data-currency', 'GBP');
    }

    else if(usersCountry == 'USA'){
        $('.numeric_currency').attr('data-currency', 'USD');
    }

    else if(usersCountry == 'NO'){
        $('.numeric_currency').attr('data-currency', 'NOK');
    }

    else {
        $('.numeric_currency').attr('data-currency', 'EUR');
    }

    var updateCurrencyLoad = $('.numeric_currency').data('currency');
    var data = {
        action: 'currency_update',
        updateCurrencyLoad: updateCurrencyLoad      
    }; 
    console.log('currencyUpdate' + JSON.stringify(data, null, 2));
    currencyUpdate(data);
}

function singleCasinoAvailability() {
    var usersCountry = $('body').attr('data-user-country');
    var pageID = $('.rectangle').attr('data-casino-id');

    var data = {
        action: 'available_casino',
        country: usersCountry,
        pageID: pageID      
    }

    console.log(data)

    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            var obj = JSON.parse(result)
            var count = obj.found_posts;
            var country = obj.country;

            if (country == 'all'){
                console.log(country)
            } 

            else if (count == 1){
                $('.user-country').text(country);
                $('.ribbon-wrapper').removeClass('hide-custom');
                $('.casino-available').removeClass('hide-custom');
            } 
            else {
                $('.user-country').text(country);
                $('.ribbon-wrapper').removeClass('hide-custom');
                $('.casino-not-available').removeClass('hide-custom');
            }
        }
    })
}
/************************
SET CURRENCY BASED ON THE VISITORS COUNTRY
************************/
function setCurrency() {
    //Sets default selected value in country-select
    var usersCountry = $('body').attr('data-user-country');

    var flag = false;
    $('#countrySelect option').each(function(){
        if(this.value == usersCountry){
            $('#countrySelect').val(usersCountry);
            flag = true;
        }
    });

    if (flag = false){
        $('#countrySelect').val('all');
    }

    var currencyOnLoad = $('body').attr('data-user-currency');
    $('#currencySelect').val($('body').attr('data-user-currency'));

    var data = {
        action: 'currency_update',
        updateCurrencyLoad: currencyOnLoad      
    }; 

    console.log('setCurrencyRate(): ' + JSON.stringify(data, null, 2));
    setCurrencyRate(data);
}

/************************
REQUEST THE CURRENCY RATE
************************/
function setCurrencyRate(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {

            //Saves the currency-rate in a data-attribute, so it can be used for AJAX-call
            $('#currencySelect').attr('data-currency-rate', result);
        },
        complete: function(){
            //When the currencyrate has been loaded, 
            var currencyRate = $('#currencySelect').attr('data-currency-rate');
            console.log('currencyRate: ' + currencyRate);

            //Only loads casino on archive-casino-page
            if($('.post-type-archive-casino').length){
                loadCasinoParams(currencyRate);
            }
        },
        error: function(errorThrown){
           console.log(errorThrown);
       }
   });
}

/************************
DROPDOWN ON EACH CASINO
************************/
function showDescCasino() {
    $('.casino-wrapper').click(function () {
        $(this).find('.desc').slideToggle();
    });
//    $(".casino-sidebar").stick_in_parent();
}

function initDom() {
    $('.filter-deposit, .filter-bonus, .filter-score').click(function(){
        $(this).addClass('filter-active');
    });
    cookiebar();

    $('#menu-right .menu li a').on({
        mouseenter: function() {
            $(this).addClass('active');
        },
        mouseleave: function() {
            $(this).removeClass('active');
        }
    })
    var pathname = window.location.pathname;
    console.log(site_vars.home_url + pathname);
    console.log($(location).attr('href'));

    $(".hamburger").click(function () {
        $('.menu-mobile-header-container').toggleClass("is-active"); 
        $('body').toggleClass("hidden-overflow"); 
    });

    $('#mobile-footer').click(function(){
        $('.extra-info').slideToggle();
    });

    $('.menu-mobile-header-container').click(function(){
        $('#nav-toggle').trigger('click');
    });

    $('.filter-bonus, .filter-deposit, .filter-score').click(function(){
        $('.filter').removeClass('active-sort');
        $(this).addClass('active-sort');
    });

    $('#nav-toggle').click(function () {
        $(this).toggleClass('active');
    });

    if($('.single-casino').length){
        var usersCountry = $('body').attr('data-user-country');
        updateDeepLink(usersCountry);
    }

            // faq toggle
            $('.faq-element').click(function(){
                if($(this).find('.plus-faq').hasClass('active-icon')){
                 $(this).find('.plus-faq').removeClass('active-icon');
                 $(this).find('.minus-faq').addClass('active-icon');
                 console.log('plus-faq active')
             }

             else if ($(this).find('.minus-faq').hasClass('active-icon')){
                 $(this).find('.minus-faq').removeClass('active-icon')
                 $(this).find('.plus-faq').addClass('active-icon')
                 console.log('minsu-faq active')
             }

             $(this).find('.desc-wrapper .desc p').slideToggle();
         });


            showDescCasino();
            loadCurrency();
        }

/************************
WHEN USER CHANGE THE CURRENCY
************************/
function loadCurrency() {
    var previous;
    $('#currencySelect').on('focus', function() {
        previous = this.value; 
    }).change(function(){
        console.log('before ' + previous);
        var after = this.value;
        console.log('after' + after);
        $('.currency-type').attr('data-currency', after);

        //Update the currency, when the currency is being updated manually
        var data = {
            action: 'currency_update',
            previous: previous,
            after: after,        
        };
        var currencyRate = $('#currencySelect').attr('data-currency-rate');
        console.log('currencyUpdate: ' + JSON.stringify(data, null, 2));

        currencyUpdate(data);

        $('.load-casino').addClass("loading-posts");
    });
}

/************************
UPDATE VALUE ON THE CASINO POST
************************/
function currencyUpdate(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            $('.load-casino').removeClass("loading-posts");

            //Update currency on each post: $, € etc.
            if($('.post-type-archive-casino').length){
                var chosenCurrencyVal = $('#currencySelect').find(":selected").attr('data-currency');
                $('.currency-type').text(chosenCurrencyVal);                
            }

            if(!$('.post-type-archive-casino').length){
                var chosenCurrencyVal = $('.numeric_currency').attr('data-currency');
                $('.currency-type').text(chosenCurrencyVal);                
            }

            //Multiply each casino's currency with the exchange rate
            $('.numeric_currency').each(function(index) {
                var signup = $( this ).html();
                var calc =Math.round((((signup * result)* 100) / 100) / 10) * 10;
                console.log(calc)
                $(this).text(calc);
            });
        },
        error: function(errorThrown){
           console.log(errorThrown);
       }
   });
}

$(window).scroll(function(){
    if($(window).scrollTop() > 50) {
        $('header').addClass('scroll-active');
    }
    else {
        $('header').removeClass('scroll-active');
    }
});

/*function infiniteScroll () {
    if ($('.casinos').length) {
        var timer;
        if ( timer ) clearTimeout(timer);

        var elements = {
            score: $('.our_score'),
            votes: $('.user_votes'),
            deposit: $('.minimum_deposit'),
            'signup-bonus': $('.signup_bonus'),
            filterDeposit: $('.filter-deposit'),
            filterBonus: $('.filter-bonus'),
            filterScore: $('.filter-score'),
        };

        var metrics = {
            score: {
                sliderSelector: '#slider-range-our-score',
                displaySelector: '#our_score',
                min: elements.score.data("min"),
                max: elements.score.data("max"),
                currency: ''
            },
            votes: {
                sliderSelector: '#slider-range-user-votes',
                displaySelector: '#user_votes',
                min: elements.votes.data("min"),
                max: elements.votes.data("max"),
                currency: ''
            },
            deposit: {
                sliderSelector: '#slider-range-min-deposit',
                displaySelector: '#minimum_deposit',
                min: 0,
                max: 400,
                currency: $('#currencySelect').find(":selected").attr('data-currency')
            },
            'signup-bonus': {
                sliderSelector: '#slider-range-signup-bonus',
                displaySelector: '#signup_bonus',
                min: 0,
                max: 300,
                currency: '%'
            }
        };

        $(window).scroll(function() {
           if ( timer ) clearTimeout(timer);
           var docHeight = $(document).height();
           var windowHeight = $(window).height();
           var footerHeight = $('footer').height();
          // var sectionPaddingBottom = $('.comparison-section').css('padding-bottom').replace('px', '');
          var headerHeight = $('header').height();
          var totalPosts = 40;
         // var count = 10;
         var shownPosts = $('.comparison-section').data('count');

         console.log('totalPosts' + totalPosts)
         console.log('shownPosts' + shownPosts)

         if (docHeight - windowHeight - footerHeight  <= $(window).scrollTop() + headerHeight) {
            //Sends ajax if there are more total posts than shownPosts
            console.log(shownPosts >= totalPosts)
            if(totalPosts >= shownPosts ) {
                $('.load-more').addClass('loading-posts');
                //Sets timeout on Ajax call to avoid Ajax request on each scrolled pixel 
                timer = setTimeout(function(){  
                    const data = {
                        action: 'filter_casino',        
                    }

                    for (var type in metrics) {
                        if (metrics.hasOwnProperty(type)) {
                            if(typeof elements[type].attr('data-filter-type') !== "undefined"){
                                const metric = metrics[type];
                                metric['currentMin'] = $(metric.sliderSelector).slider( "values", 0 );
                                metric['currentMax'] = $(metric.sliderSelector).slider( "values", 1 );
                                metric.filterType = elements[type].attr('data-filter-type');
                                console.log(metrics[type]['currentMin']);
                            }
                        }
                    };

                    for (var type in metrics) {
                        if (metrics.hasOwnProperty(type)) {
                            if(typeof elements[type].attr('data-filter-type') !== "undefined"){
                                const metric = metrics[type];
                                data['filter_type_' + type] = metric.filterType;
                                data['min_' + type] = metric.currentMin;
                                data['max_' + type] = metric.currentMax;
                            }
                        }
                    };
                    $('.comparison-section').data('count',  shownPosts+= 10);

                    data.country = $('#countrySelect').val();

                    data['posts_per_page'] = $('.comparison-section').data('count');
                    console.log('morePosts: ' + JSON.stringify(data, null, 2))

                    console.log('loadCasino: ' + JSON.stringify(data, null, 2));


                    loadCasino(data);
                }, 200);
            }
        } 
        else {
            //console.log('not the end');
        }
    });
    }
}*/

/*function morePosts(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            $('.loaded-posts').html(result);
            $('.load-more').removeClass('loading-posts'); 
            console.log(result);
        },
        error: function(errorThrown){
         console.log(errorThrown);
     },
     complete: function(result){
        var updateCurrencyLoad = $('#currencySelect').val();
        var data = {
            action: 'currency_update',
            updateCurrencyLoad: updateCurrencyLoad      
        }; 
        currencyUpdate(data);
        updateDeepLink();
        showDescCasino();
    }
});
}*/

function loadCasinoParams(currencyRate) {
    var elements = {
        score: $('.our_score'),
        votes: $('.user_votes'),
        deposit: $('.minimum_deposit'),
        'signup-bonus': $('.signup_bonus'),
        filterDeposit: $('.filter-deposit'),
        filterBonus: $('.filter-bonus'),
        filterScore: $('.filter-score'),
    };

    var metrics = {
        score: {
            sliderSelector: '#slider-range-our-score',
            displaySelector: '#our_score',
            min: elements.score.data("min"),
            max: elements.score.data("max"),
            currency: ''
        },
        votes: {
            sliderSelector: '#slider-range-user-votes',
            displaySelector: '#user_votes',
            min: elements.votes.data("min"),
            max: elements.votes.data("max"),
            currency: ''
        },
        deposit: {
            sliderSelector: '#slider-range-min-deposit',
            displaySelector: '#minimum_deposit',
            min: 0 * currencyRate,
            max: 400 * currencyRate,
            currency: $('#currencySelect').find(":selected").attr('data-currency')
        },
        'signup-bonus': {
            sliderSelector: '#slider-range-signup-bonus',
            displaySelector: '#signup_bonus',
            min: 0,
            max: 300,
            currency: '%'
        }
    };

    // Instantiate sliders for each metric
    for (var type in metrics) {
        if (metrics.hasOwnProperty(type)) {
            var metric = metrics[type];
            $(metric.sliderSelector).slider({
                range: true,
                min: metric.min,
                max: metric.max,
                values: [ metric.min, metric.max ],
                slide: function( event, ui ) {
                    $(metric.displaySelector).val( ui.values[ 0 ] + metric.currency +  " - " + ui.values[ 1 ] + metric.currency );
                }
            }); 
            var displayString = $(metric.sliderSelector).slider( "values", 0 ) + metric.currency + " - " + $(metric.sliderSelector).slider( "values", 1 ) + metric.currency;
            $(metric.displaySelector).val(displayString);
        }
    }

    ajaxParams(); 
    function ajaxParams(){
         // Data to submit in request
         var data = {
            action: 'filter_casino',        
        };   

        data.country = $('#countrySelect').val();

        data.categories = [];
        $('#checkbox-input:checked').each(function(index) {
            data.categories.push(this.value);
        });

        $('.load-casino').addClass('loading-posts');   
        data.active = $('.filter-active').data('filter');

        for (var type in metrics) {
         if (metrics.hasOwnProperty(type)) {
            var metric = metrics[type];
            metric.currentMin = $(metric.sliderSelector).slider( "values", 0 );
            metric.currentMax = $(metric.sliderSelector).slider( "values", 1 );
            metric.filterType = elements[type].attr('data-filter-type');
        }
    }

    for (var type in metrics) {
        if (metrics.hasOwnProperty(type)) {
            var metric = metrics[type];
            if(typeof elements[type].attr('data-filter-type') !== "undefined"){
                data['filter_type_' + type] = metric.filterType;
                console.log('filterType: ' + metric.filterType)
                data['min_' + type] = metric.currentMin;
                data['max_' + type] = metric.currentMax;
            }
        }
    }

    console.log('loadCasino: ' + JSON.stringify(data, null, 2));
    loadCasino(data);
}

$('#countrySelect').on('change', function() {
    ajaxParams();
});

/*$("#countrySelect-mobile").on("change",function(){
    $("#countrySelect").val($(this).val());
    ajaxParams();
})*/

$('.search-ajax, .filter').click(function (e) {
        // Attach event handler for AJAX submit
        e.preventDefault();
        console.log('hey');
        ajaxParams();
    });

resetFilter();
function resetFilter() {
    $('.reset-filter').click(function(e){
        e.preventDefault();
        var data = {
            action: 'filter_casino',        
        };

        for (var type in metrics) {
            var metric = metrics[type];
            data['min_' + type] = metric.min;
            data['max_' + type] = metric.max;
        }
        var usersCountry = $('body').attr('data-user-country');

        var flag = false;
        $('#countrySelect option').each(function(){
            if(this.value == usersCountry){
                $('#countrySelect').val(usersCountry);
                data.country = usersCountry;
                flag = true;
            }
        });

        if(flag == false){
            $('#countrySelect').val('all');
            data.country = 'all';
        }

        console.log('ajax' + JSON.stringify(data, null, 2));
        ajaxParams(data);
        $('.filter').removeClass('active-sort');
        $('.filter-bonus').addClass('active-sort');
    });
}
}


function loadCasino(data) {
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            $('.filter').removeClass('filter-active');
            $('.load-casino').removeClass("loading-posts");
            $('.load-more').removeClass('loading-posts'); 
            $('.loaded-posts').html(result);

            //Update currency-value on each casino-post
            var chosenCurrencyVal = $('#currencySelect').find(":selected").attr('data-currency');
            var chosenCurrency = $('#currencySelect').find(":selected").val();
            $('.currency-type').text(chosenCurrencyVal);
            $('.currency-type').attr('data-currency', chosenCurrency);
        },
        complete: function() {
            //Update casino-currency value
            var updateCurrencyLoad = $('#currencySelect').val();
            var data = {
                action: 'currency_update',
                updateCurrencyLoad: updateCurrencyLoad      
            }; 
            console.log('currencyUpdate' + JSON.stringify(data, null, 2));
            currencyUpdate(data);
            var usersCountry = $('#countrySelect').val();
            updateDeepLink(usersCountry);
            showDescCasino();
            //$(".casino-sidebar").stick_in_parent();
                //Infinite scroll with ajax-calls
               // infiniteScroll();
           },
           error: function(errorThrown){
               console.log(errorThrown);
           } 
       });
}

function add_casino_menu() {
    var site_url = site_vars.site_url;
    var site_url_casino = site_vars.site_url + 'casino/';

    console.log(site_url);
    var country = $('body').attr('data-user-country');
    $('.site-navigation li a').each(function(){
        if($(this).attr('href') == site_url || $(this).attr('href') == site_url_casino){
            $(this).addClass('has-submenu');
        }
    });

    var data = {
        action: 'add_casino_menu',
        country: country,
        type: 'menu'
    } 
    ajax_add_casino_menu(data);
}

function ajax_add_casino_menu(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            //console.log(result)
            $('.casino-submenu').append(result);

            $('.has-submenu').click(function(e){
                e.preventDefault();
                $('body').toggleClass('open-submenu');
            });

            $('.menu-overlay').click(function(){
             $('body').toggleClass('open-submenu'); 
         });
        },
        error: function(errorThrown){
         console.log(errorThrown);
     } 
 });
}

function add_casino_sidebar() {
    if($('.favorites').length){

        var type = 'sidebar';
        var country = $('body').attr('data-user-country');

        var data = {
            action: 'add_casino_menu',
            country: country,
            type: type
        } 
        ajax_add_casino_sidebar(data);
    }
}

function ajax_add_casino_sidebar(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            //console.log(result)
            $('.favorites-teaser').html(result);

            if(!$('.post-type-archive-casino').length){
                $('.currency-type').html($('body').attr('data-user-currency'));
            }

            sidebar_currency();

        },
        error: function(errorThrown){
         console.log(errorThrown);
     } 
 });
}

function sidebar_currency(){
    var after = $('body').attr('data-user-currency');

    var data = {
        action: 'currency_update',
        previous: 'EUR',
        after: after,        
    };

    ajax_sidebar_currency(data);
}

function ajax_sidebar_currency(data){
    $.ajax({
        url: site_vars.ajax_url,
        type: 'post',
        data: data,
        success: function(result) {
            //Multiply each casino's currency with the exchange rate
            $('.numeric-sidebar-currency').each(function(index) {
                var signup = $( this ).html();
                var calc =Math.round((((signup * result)* 100) / 100) / 10) * 10;
                console.log(calc)
                $(this).text(calc);
            });
        },
        error: function(errorThrown){
           console.log(errorThrown);
       }
   });
}


function updateDeepLink(usersCountry) {

    console.log('usersCountry: ' + usersCountry);

    $('.deep-link-button').each(function(index) {
        if(usersCountry == 'US') {
            var deepLinkUSA = $(this).attr('data-deeplink-us');
            $(this).attr('href', deepLinkUSA);
        }
        else if(usersCountry == 'GB'){
            var deepLinkGB = $(this).attr('data-deeplink-gb');
            $(this).attr('href', deepLinkGB);
        }
        else if(usersCountry == 'DK'){
            var deepLinkDK = $(this).attr('data-deeplink-dk');
            $(this).attr('href', deepLinkDK);
        }
        else if(usersCountry == 'SE'){
            var deepLinkSE = $(this).attr('data-deeplink-se');
            $(this).attr('href', deepLinkSE);
        }
        else if(usersCountry == 'DE'){
            var deepLinkDE = $(this).attr('data-deeplink-de');
            $(this).attr('href', deepLinkDE);
        }
        else if(usersCountry == 'PL'){
            var deepLinkPL = $(this).attr('data-deeplink-pl');
            $(this).attr('href', deepLinkPL);
        }
        else if(usersCountry == 'FI'){
            var deepLinkFI = $(this).attr('data-deeplink-fi');
            $(this).attr('href', deepLinkFI);
        }
        else if(usersCountry == 'NO'){
            var deepLinkNO = $(this).attr('data-deeplink-no');
            $(this).attr('href', deepLinkNO);
        }

        else if(usersCountry == 'IT'){
            var deepLinkIT = $(this).attr('data-deeplink-it');
            $(this).attr('href', deepLinkIT);
        }

        else if(usersCountry == 'NL'){
            var deepLinkNL = $(this).attr('data-deeplink-nl');
            $(this).attr('href', deepLinkNL);
        }

        else if(usersCountry == 'CZ'){
            var deepLinkCZ = $(this).attr('data-deeplink-cz');
            $(this).attr('href', deepLinkCZ);
        }

        else if(usersCountry == 'PT'){
            var deepLinkPT = $(this).attr('data-deeplink-pt');
            $(this).attr('href', deepLinkPT);
        }

        else {
            var deepLinkGeneral = $(this).attr('data-deeplink-general');
            $(this).attr('href', deepLinkGeneral);
        }
    });
}

function cookiebar (){
/*!
 * JavaScript Cookie v2.2.0
 * https://github.com/js-cookie/js-cookie
 *
 * Copyright 2006, 2015 Klaus Hartl & Fagner Brack
 * Released under the MIT license
 */
 (function (factory) {
    var registeredInModuleLoader = false;
    if (typeof define === 'function' && define.amd) {
        define(factory);
        registeredInModuleLoader = true;
    }
    if (typeof exports === 'object') {
        module.exports = factory();
        registeredInModuleLoader = true;
    }
    if (!registeredInModuleLoader) {
        var OldCookies = window.Cookies;
        var api = window.Cookies = factory();
        api.noConflict = function () {
            window.Cookies = OldCookies;
            return api;
        };
    }
}(function () {
    function extend () {
        var i = 0;
        var result = {};
        for (; i < arguments.length; i++) {
            var attributes = arguments[ i ];
            for (var key in attributes) {
                result[key] = attributes[key];
            }
        }
        return result;
    }

    function init (converter) {
        function api (key, value, attributes) {
            var result;
            if (typeof document === 'undefined') {
                return;
            }

            // Write

            if (arguments.length > 1) {
                attributes = extend({
                    path: '/'
                }, api.defaults, attributes);

                if (typeof attributes.expires === 'number') {
                    var expires = new Date();
                    expires.setMilliseconds(expires.getMilliseconds() + attributes.expires * 864e+5);
                    attributes.expires = expires;
                }

                // We're using "expires" because "max-age" is not supported by IE
                attributes.expires = attributes.expires ? attributes.expires.toUTCString() : '';

                try {
                    result = JSON.stringify(value);
                    if (/^[\{\[]/.test(result)) {
                        value = result;
                    }
                } catch (e) {}

                if (!converter.write) {
                    value = encodeURIComponent(String(value))
                    .replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent);
                } else {
                    value = converter.write(value, key);
                }

                key = encodeURIComponent(String(key));
                key = key.replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent);
                key = key.replace(/[\(\)]/g, escape);

                var stringifiedAttributes = '';

                for (var attributeName in attributes) {
                    if (!attributes[attributeName]) {
                        continue;
                    }
                    stringifiedAttributes += '; ' + attributeName;
                    if (attributes[attributeName] === true) {
                        continue;
                    }
                    stringifiedAttributes += '=' + attributes[attributeName];
                }
                return (document.cookie = key + '=' + value + stringifiedAttributes);
            }

            // Read

            if (!key) {
                result = {};
            }

            // To prevent the for loop in the first place assign an empty array
            // in case there are no cookies at all. Also prevents odd result when
            // calling "get()"
            var cookies = document.cookie ? document.cookie.split('; ') : [];
            var rdecode = /(%[0-9A-Z]{2})+/g;
            var i = 0;

            for (; i < cookies.length; i++) {
                var parts = cookies[i].split('=');
                var cookie = parts.slice(1).join('=');

                if (!this.json && cookie.charAt(0) === '"') {
                    cookie = cookie.slice(1, -1);
                }

                try {
                    var name = parts[0].replace(rdecode, decodeURIComponent);
                    cookie = converter.read ?
                    converter.read(cookie, name) : converter(cookie, name) ||
                    cookie.replace(rdecode, decodeURIComponent);

                    if (this.json) {
                        try {
                            cookie = JSON.parse(cookie);
                        } catch (e) {}
                    }

                    if (key === name) {
                        result = cookie;
                        break;
                    }

                    if (!key) {
                        result[name] = cookie;
                    }
                } catch (e) {}
            }

            return result;
        }

        api.set = api;
        api.get = function (key) {
            return api.call(api, key);
        };
        api.getJSON = function () {
            return api.apply({
                json: true
            }, [].slice.call(arguments));
        };
        api.defaults = {};

        api.remove = function (key, attributes) {
            api(key, '', extend(attributes, {
                expires: -1
            }));
        };

        api.withConverter = init;

        return api;
    }

    return init(function () {});
}));

if (!Cookies.get('casinochecking_cookie')){
    $('#cookiebar').addClass('cookie-accepted');
    $('#accept-cookies').click(function(e){
        e.preventDefault();
        Cookies.set('casinochecking_cookie', true, { expires: 30, path: '/' });
        $("#cookiebar").remove();
    })
} else {
    $('#cookiebar').removeClass('cookie-accepted');
}

}
