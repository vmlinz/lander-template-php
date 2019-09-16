
$(document).ready(function() {
  if (innerWidth > 765) { 
    $("#card1").click(function() {
        $("#back1").toggleClass("show");
        $("#front1").toggleClass("hide");
    });
    $("#card2").click(function() {
        $("#back2").toggleClass("show");
        $("#front2").toggleClass("hide");
    });
    $("#card3").click(function() {
        $("#back3").toggleClass("show");
        $("#front3").toggleClass("hide");
    });
  }
});
$(window).on('load', function () {
    if (innerWidth < 765) { 
    $nav = $("#card1");
    $h = $nav.offset().top - 100;
    $h2 = $nav.offset().top + $('#card1').height() - 300;
    $obj = $("#back1");
    $obj2 = $("#front1");
    $(window).scroll(function () {
        if ($(window).scrollTop() > $h && $(window).scrollTop() < $h2) {
            $obj.addClass("show"); 
            $obj2.addClass("hide");
        } else if ($(window).scrollTop() > $h2){
          $obj.removeClass("show");
          $obj2.removeClass("hide");
      } 
  });
    $nav2 = $("#card2");
    $hc = $nav2.offset().top - 100;
    $hc2 = $nav2.offset().top + $('#card2').height() - 300;
    $objc = $("#back2");
    $objc2 = $("#front2");
    $(window).scroll(function () {
        if ($(window).scrollTop() > $hc && $(window).scrollTop() < $hc2) {
            $objc.addClass("show"); 
            $objc2.addClass("hide");
        } else if ($(window).scrollTop() > $hc2){
          $objc.removeClass("show");
          $objc2.removeClass("hide");
      } 
  });
    $nav3 = $("#card3");
    $hv = $nav3.offset().top - 100;
    $hv2 = $nav3.offset().top + $('#card3').height() - 300;
    $objv = $("#back3");
    $objv2 = $("#front3");
    $(window).scroll(function () {
        if ($(window).scrollTop() > $hv && $(window).scrollTop() < $hv2) {
            $objv.addClass("show"); 
            $objv2.addClass("hide");
        } else if ($(window).scrollTop() > $hv2){
          $objv.removeClass("show");
          $objv2.removeClass("hide");
      } 
  });
  }
});
