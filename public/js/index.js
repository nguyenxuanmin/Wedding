$(document).ready(function() {
    const header = $('#header');
    window.onscroll = function () {
        if (window.pageYOffset > 130) {
            header.addClass('header-fixed');
            $('#scrollToTop').fadeIn();
        } else {
            header.removeClass('header-fixed');
            $('#scrollToTop').fadeOut();
        }
    };

    $('#scrollToTop').click(function() {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
        return false;
    });

    $('.item-show-search').click(function() {
        $("#header").addClass("show-search");
    });
    $('.btn-close-search').click(function() {
        $("#header").removeClass("show-search");
    });

    $('.item-show-menu').click(function() {
        $("#header").addClass("show-menu");
    });
    $('.item-hide-menu').click(function() {
        $("#header").removeClass("show-menu");
    });
    $('.menu-mobile ul li a').click(function() {
        $("#header").removeClass("show-menu");
    });

    if ($('#uniteGallery').length) {
        $("#uniteGallery").unitegallery({
            tiles_max_columns: 5,
            tiles_col_width: 300,
        });
    }

    $('.my-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow:
            '<div class="slick-arrow slick-next"><i class="fa-solid fa-right-long"></i></div>',
        prevArrow:
            '<div class="slick-arrow slick-prev"><i class="fa-solid fa-left-long"></i></div>',
        autoplay: true,
        arrows: true,
        fade: true,
        autoplaySpeed: 5000
    });
});