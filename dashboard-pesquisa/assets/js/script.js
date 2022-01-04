var one = two = three = four = five = 0;

five = grafico_five;
four = grafico_four;
three = grafico_three;
two = grafico_two;
one = grafico_one;

$(document).ready(function() {
  $('.bar span').hide();
  $('#bar-five').animate({
     width: five.toFixed(2)+'%'}, 1000);
  $('#bar-four').animate({
     width: four.toFixed(2)+'%'}, 1000);
  $('#bar-three').animate({
     width: three.toFixed(2)+'%'}, 1000);
  $('#bar-two').animate({
     width: two.toFixed(2)+'%'}, 1000);
  $('#bar-one').animate({
     width: one.toFixed(2)+'%'}, 1000);
  
  setTimeout(function() {
    $('.bar span').fadeIn('slow');
  }, 1000);
});
