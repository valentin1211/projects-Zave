$(document).ready(function() {



    $('.icon-menu').click(function(){
      $('.main_cont').css('position', 'fixed');
      $('.menu_cont').toggleClass("menu_cont_active");
      $('.menu_bar').toggleClass("menu_bar_active");
      $('.icon-menu').toggleClass("icon-active");
      $('.icon-cross').toggleClass("icon-active");
      $('.blurr').show();
      $('.blurr').toggleClass("menu_bar_active");
      $('.icon-logo').css('opacity', '0');
    });

    $('.icon-cross').click(function(){
      $('.main_cont').css('position', 'relative');
      $('.menu_cont').toggleClass("menu_cont_active");
      $('.menu_bar').toggleClass("menu_bar_active");
      $('.icon-cross').toggleClass("icon-active");
      $('.icon-menu').toggleClass("icon-active");
      $('.blurr').hide();
      $('.blurr').toggleClass("menu_bar_active");
      $('.icon-logo').css('opacity', '1');
    });





});
