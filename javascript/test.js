


var it = false;

$(document).ready(function() {


  var amount = $(window).height();
  var position = $(window).scrollTop();




/**  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    if(scroll > position) {
        console.log('scrollDown');
        $("#but").text('Scrolling Down Scripts');
    } else {
         console.log('scrollUp');
         $("#but").text('Scrolling Up Scripts');
    }
    position = scroll;
});**/


//      $("html").animate({"scrollTop": $(window).scrollTop() - amount}, time,


  $("#but").on('click',function() {


    $(".big").animate({top: "-1000px"}, 5, "linear");




  });




});
