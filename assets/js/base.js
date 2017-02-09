// on page load

var toggler = require("./libs/toggler");

$(window).on('load', function () {
    toggler.default();


    // popin image gallery (template single.php)
    $(".owl-carousel").owlCarousel({
        items: 1,
        nav: true,
        navText:['<span class="arrow icon-prev"></span>', '<span class="arrow icon-next"></span>']
    });

});