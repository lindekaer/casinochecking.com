$(document).foundation();

jQuery(function($) {
    "use strict";
    $(document).ready(function(){
        setCurrency();
        initDom();
    });
});

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

    //Sets default currency based on the country
    if(usersCountry == 'DK'){
        $('#currencySelect').val('DKK');
        console.log($('#currencySelect').val('DKK'));
    }

    else if(usersCountry == 'GB'){
        $('#currencySelect').val('GBP');
    }

    else if(usersCountry == 'USA'){
        $('#currencySelect').val('USD');
    }

    else {
        $('#currencySelect').val('EUR');
    }

    var currencyOnLoad = $('#currencySelect').val();

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
        $(this).find('.desc').slideToggle("slow");
    });
}

function initDom() {
    $('.filter-deposit, .filter-bonus, .filter-score').click(function(){
        $(this).addClass('filter-active');
    });

    $(".hamburger").click(function () {
        $('header').toggleClass("is-active"); 
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
            var chosenCurrencyVal = $('#currencySelect').find(":selected").attr('data-currency');
            $('.currency-type').text(chosenCurrencyVal);

            //Multiply each casino's currency with the exchange rate
            $('.numeric_currency').each(function(index) {
                var signup = $( this ).html();

                var calc =Math.round((((signup * result)* 100) / 100) / 10) * 10
                console.log(calc);
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

function infiniteScroll () {
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
}

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
            if (metrics.hasOwnProperty(type)) {
                var metric = metrics[type];
                data['min_' + type] = metric.min;
                data['max_' + type] = metric.max;
            }
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
            updateDeepLink();
            showDescCasino();
                //Infinite scroll with ajax-calls
               // infiniteScroll();
            },
            error: function(errorThrown){
               console.log(errorThrown);
           } 
       });
}

function updateDeepLink() {
    var usersCountry = $('#countrySelect').val();
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
