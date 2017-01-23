$(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 10) {
            $(".navbar").addClass("menuEffect");
            $("#logo-img").attr('src','../img/LogoBranco.png');
            $(".link a").addClass("color-letter");
        } else {
            $(".navbar").removeClass("menuEffect");
            $("#logo-img").attr('src','../img/Logo.png');
            $(".link a").removeClass("color-letter");
        }
    });
    $('.glyphicon-chevron-down').addClass('animated bounce');
});
