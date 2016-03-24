jQuery(document).ready(function($){

  var nav = $('#header_top_wrap');
  var navTop = $('#contents').offset().top;
  var navHeight = nav.height();

  var showFlag = false;

  $(window).scroll(function () {

    var winScroll = $(this).scrollTop();

    if (winScroll > navTop) {
      if (showFlag == false) {
        showFlag = true;
        nav.addClass('fixed').css('top', -navHeight+'px').stop().animate({top:'0px'},1500,"easeOutExpo");
      };
    } else if(winScroll < navTop){
      if (showFlag) {
        showFlag = false;
        nav.stop().animate({'top' : -navHeight+'px'},400,"easeOutExpo", function(){
         nav.stop().animate({top:'0px'},400,"easeOutExpo").removeClass('fixed');
        });
      };
    }

  });

});