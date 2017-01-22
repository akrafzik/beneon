$(function() {
    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 10) {
            $(".navbar").addClass("menuEffect");
            $("#logo-img").attr("src", "img/LogoBranco.jpg");
        } else {
            $(".navbar").removeClass("menuEffect");
            $("#logo-img").attr("src", "img/Logo.png");
        }
    });
});
