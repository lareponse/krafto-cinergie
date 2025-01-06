$(document).ready(function () {

    $('#banner').slick({
        centerMode: false,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
        arrows: false,
        infinite: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1920,
                settings: {
                    centerMode: true,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerMode: false,
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    $('#concoursdm').slick({
        centerMode: false,
        autoplay: true,
        autoplaySpeed: 2000,
        dots: true,
        arrows: true,
        infinite: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    $('.single-post-slider.slide.dots').slick({
        dots: true,
        arrows: false,

        centerMode: false,
        centerPadding: '60px',
        autoplay: true,
        autoplaySpeed: 3500,
        infinite: false,
        speed: 1000,
        slidesToShow: 2,
        slidesToScroll: 2,
        responsive: [{
            breakpoint: 480,
            settings: {
                centerMode: false,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }, 
        {
            breakpoint: 992,
            settings: {
                centerMode: false,
                slidesToShow: 2,
                slidesToScroll: 2
            }
        }]
    });

    $('.single-post-slider.slide.arrow').slick({
        dots: false,
        arrows: true,

        centerMode: false,
        centerPadding: '60px',
        autoplay: true,
        autoplaySpeed: 3500,
        infinite: false,
        speed: 1000,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [{
            breakpoint: 576,
            settings: {
                centerMode: false,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });

    // LightBox "2" : https://lokeshdhakar.com/projects/lightbox2/#getting-started
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'disableScrolling': true
    })


}); // END - DOCUMENT READY