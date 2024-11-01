$(".scroll-top").click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, "slow");
    return false;
});

function startCounter() {
    var countnumber = $('.fp-viewing-page4').find('.js-number');
    $(countnumber).each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
}



var fullPageOptions = {
    anchors: ['page1', 'page2', 'page3', 'page4', 'page5', 'page6', 'page7'],
    scrollBar: true,
    menu: '#nav_wrapper',
    slidesNavigation: true,
    controlArrows: false,
    scrollOverflow: false,
    scrollOverflowOptions: {
        click: true
    },
    onLeave: function (o, d, dir) {
        wow = new WOW(
        {
            boxClass:     'wow',     
            animateClass: 'animated', 
            offset:       0,          
            mobile:       true,      
            live:         true   
        }
        )
        wow.init();
    },
    afterLoad: function (anchorLink, index) {
        
    }
}

function initFullPage() {
    if (window.innerWidth > 1200) {
        jQuery('#fullpage').fullpage(fullPageOptions);
        jQuery('#fullpage').attr('data-fullpage-init', 'true');
        $('.js-menu').click(function () {
            $('body').css('overflow','hidden');
            $('.menu-main').addClass('active-m');
        });
    }
}


jQuery(document).ready(function() {
    initFullPage();
})
jQuery(window).resize(function() {
    if (window.innerWidth > 1200) {
        if(jQuery('#fullpage').attr('data-fullpage-init') != 'true'){
            jQuery('#fullpage').fullpage(fullPageOptions);
            jQuery('#fullpage').attr('data-fullpage-init', 'true');
        }
    }else{
        if(jQuery('#fullpage').attr('data-fullpage-init') == 'true'){
            fullpage_api.destroy('all');
            jQuery('#fullpage').attr('data-fullpage-init', 'false');
        }
    }
})


jQuery(document).on('click', '.modal button.close', function () {
    if (window.innerWidth > 1200) {
        fullpage_api.setAllowScrolling(true);
    }
    // Close zoom
    if (jQuery('.zoomContainer').length) {
        jQuery('.zoomContainer').remove();
    }

});

jQuery(document).on('click', '.move-section-down', function (e) {
    e.preventDefault();
    if (window.innerWidth > 1200) {
        fullpage_api.moveSectionDown();
    }
});



$('.js-menu').click(function () {
    $('body').css('overflow','hidden');
    $('.menu-main').addClass('active-m');
});
$('.js-close').click(function () {
    $('body').css('overflow','inherit');
    $('.menu-main').removeClass('active-m');
});
$('.js-search').click(function () {
    $('.search-form').addClass('active-m');
});
$('.js-close-s').click(function () {
    $('.search-form').removeClass('active-m');
});
$('.js-ut').click(function () {
    $('.pp-rec').addClass('active-re');
});
$('.close-h').click(function () {
    $('.pp-rec').removeClass('active-re');
});


$('.slick-banner').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
});

$('.slick-archive-tt').owlCarousel({
    loop:false,
    margin:0,
    nav:false,
    items:1,
    dots:true,
});

$('.slick-video').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: true,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
});

$('.slick-category').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: true,
    fade: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
});

$('.slick-archive-tt-tt').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    customPaging: function (slider, i) {
        var thumb = $(slider.$slides[i]).data();
        return '<a class="dot">' + (i + 1) + '</a>';
    },
});

$('.slick-pn').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
            },
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: true,
                dots: false,
            },
        },
    ],
});


$('.slick-media').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    responsive: [{
        breakpoint: 480,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
        },
    }, ],
});

$('.slick-category-custom').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    dots: false,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    responsive: [{
        breakpoint: 480,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
        },
    }, ],
});


$('.slick-team').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots: false,
    autoplay: false,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    responsive: [{
            breakpoint: 1500,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                autoplaySpeed: 3000,
                speed: 500,
            },
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                autoplaySpeed: 3000,
                speed: 500,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: true,
                infinite: true,
                autoplay: true,
                autoplaySpeed: 1500,
            },
        },
    ],
});

$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: false,
    arrows: true,
    focusOnSelect: true,
    infinite: true,
    responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 5,
            },
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 4,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            },
        },
    ],
});

$('.slick-project-lq').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    centerMode: true,
    focusOnSelect: true,
    infinite: true,
    responsive: [{
            breakpoint: 1199,
            settings: {
                slidesToShow: 3,
            },
        },
        {
            breakpoint: 991,
            settings: {
                slidesToShow: 2,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
            },
        },
    ],
});


$('.slick-sytem').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    speed: 500,
    infinite: true,
    responsive: [
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
            },
        },
    ],
});

$(document).ready(function() {
  var offset = 100;
  var scrollTime = 500;
  $('.navigation-mobile a[href^="#"]').click(function() {
    $('.navigation-mobile a[href^="#"]').removeClass('active');
    $(this).addClass('active');
    $("html, body").animate({
      scrollTop: $( $(this).attr("href") ).offset().top - offset 
  }, scrollTime);
    return false;
});
  var lastId,
  topMenu = $(".navigation-mobile"),
  topMenuHeight = topMenu.outerHeight() + 200,
  menuItems = topMenu.find("a"),
  scrollItems = menuItems.map(function() {
    var item = $(this).attr("href");
    if(item != '#') {return $(item)}
});
  $(window).scroll(function() {
    var fromTop = $(this).scrollTop() + topMenuHeight;
    var cur = scrollItems.map(function() {
        if ($(this).offset().top < fromTop)
            return this;
    });
    cur = cur[cur.length - 1];
    var id = cur && cur.length ? cur[0].id : "";

    if (lastId !== id) {
        lastId = id;
        menuItems
        .parent().removeClass("active")
        .end().filter(".navigation-mobile a[href='#" + id + "']").parent().addClass("active");
    }
});
});


$('.menu-item-has-children').append('<span class="dropdown-js"><i class="fa-solid fa-chevron-down"></i></span>');

$('.dropdown-js').click(function(){
    if($(this).hasClass('active')){
        $(this).removeClass('active');
        $(this).parents('ul li').find('.sub-menu').slideUp();
    }else{
        $('.sub-menu').slideUp();
        $(this).parents('ul li').find('.sub-menu').slideDown();
        $('.dropdown-js').removeClass('active');
        $(this).addClass('active');
    }
});
$('.pll-parent-menu-item').click(function(){
    $('.sub-menu').slideToggle();
});


new WOW().init();

$('.menu-main').hover(function(){
    },function(){
        $(this).removeClass('active-m');
        $('body').css('overflow','inherit')
});