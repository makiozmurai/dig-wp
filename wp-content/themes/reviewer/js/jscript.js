jQuery(document).ready(function($){

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");
  $('.rollover').rollover();

  $("#global_menu li:last-child").addClass("last");
  $(".styled_post_list1 > li:last-child").addClass("last");
  $(".styled_post_list2 > li:last-child").addClass("last");
  $('.footer_widget:nth-child(4n)').addClass('right_widget');

  $("#comment_area ol > li:even").addClass("even_comment");
  $("#comment_area ol > li:odd").addClass("odd_comment");
  $(".even_comment > .children > li").addClass("even_comment_children");
  $(".odd_comment > .children > li").addClass("odd_comment_children");
  $(".even_comment_children > .children > li").addClass("odd_comment_children");
  $(".odd_comment_children > .children > li").addClass("even_comment_children");
  $(".even_comment_children > .children > li").addClass("odd_comment_children");
  $(".odd_comment_children > .children > li").addClass("even_comment_children");

  $("#trackback_switch").click(function(){
    $("#comment_switch").removeClass("comment_switch_active");
    $(this).addClass("comment_switch_active");
    $("#comment_area").animate({opacity: 'hide'}, 0);
    $("#trackback_area").animate({opacity: 'show'}, 1000);
    return false;
  });

  $("#comment_switch").click(function(){
    $("#trackback_switch").removeClass("comment_switch_active");
    $(this).addClass("comment_switch_active");
    $("#trackback_area").animate({opacity: 'hide'}, 0);
    $("#comment_area").animate({opacity: 'show'}, 1000);
    return false;
  });

$(".widget_nav_menu .menu li a").click(function(){
    $(this).next("ul").slideToggle(500, 'quart');
});

function mediaQueryClass(width) {

 if (width > 641) { //PC

   $("html").removeClass("mobile");
   $("html").addClass("pc");

//   var n_size=$("#global_menu > ul > li").size();
//   var aWidth = 1045/n_size;
//   $("#global_menu > ul > li").css("width",aWidth+"px");
//   $("#global_menu ul ul li").css("width",(aWidth+20)+"px");

   $(".menu_button").css("display","none");
   $("#global_menu").show();
   $("#global_menu ul ul").hide();
   $("#global_menu a:has(ul)").removeClass("active_menu").off("click");

   $("#global_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active_menu");
    }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active_menu");
    });

 } else { //ÉXÉ}Éz

   $("html").removeClass("pc");
   $("html").addClass("mobile");

   $("#global_menu ul li").css("width", "");
   $(".menu_button").css("display", "block");

   $('.menu_button').off('click');
   if(!$('html').hasClass('ie')) {
       $('#global_menu').hide();
   };
   if($(".menu_button").hasClass("active")) {
     $(".menu_button").removeClass("active")
   };

   $(".menu_button").on('click',function() {
     if($(this).hasClass("active")) {
       $(this).removeClass("active");
       $('#global_menu').hide();
       return false;
     } else {
       $(this).addClass("active");
       $('#global_menu').show();
       return false;
     };
   });

 };
};

mediaQueryClass(document.documentElement.clientWidth);

$(window).bind("resize orientationchange", function() {
  mediaQueryClass(document.documentElement.clientWidth);
})




});