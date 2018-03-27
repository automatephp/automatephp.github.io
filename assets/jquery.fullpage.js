$(document).ready(function() {
    if($(".home:not(.documentation)").length) {
        var section = $('.section1');
        var lastScrollTop = 0;

        $(".btnDiscover").on("click", function(e){
            e.preventDefault();
            $("html, body").animate({
                scrollTop: ($(".container_advantages").offset().top - $(window).height()),
                easing: 'linear'
            }, 500);
            section = section.next();
        });

        $(".btnFeatures").on("click", function(e){
            e.preventDefault();
            scrollable = false;
            $("html, body").animate({
                scrollTop: $(".container_advantages").offset().top,
                easing: 'linear'
            }, 500);
            section = section.next();
        });
    }
});
