$(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 10) {
            $(".navbar").addClass("menuEffect");
            $("#logo-img").attr('src','../img/LogoBranco.png');
        } else {
            $(".navbar").removeClass("menuEffect");
            $("#logo-img").attr('src','../img/Logo.png');
        }
    });
    $('.glyphicon-chevron-down').addClass('animated bounce');
});
