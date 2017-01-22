$(function() {
  $(window).on("scroll", function() {
    if($(window).scrollTop() > 10) {
      $(".navbar").addClass("menuEffect");
      $(".navbar-default .navbar-nav>li>a:hover").addClass("backgroundMenu");
    } else {
      $(".navbar").removeClass("menuEffect");
      $(".navbar-default .navbar-nav>li>a:hover").removeClass("backgroundMenu");
    }
  });
});
