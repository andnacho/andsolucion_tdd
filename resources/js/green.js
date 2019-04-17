var yourElement = $('#yourElement');

$('#blue').click(function(){

    var down = $('#box').offset().top;

    $("html, body").animate({
        scrollTop: down}, 1000);

});
$('#red').click(function(){

    var down = $('#abajo').offset().top;

    $("html, body").animate({
        scrollTop: down}, 1000);

});
$('#gray').click(function(){

    var down = $('#contactanos').offset().top;

    $("html, body").animate({
        scrollTop: down}, 1000);

});
$('#orange').click(function(){

    var down = $('#informacion').offset().top;

    $("html, body").animate({
        scrollTop: down}, 1000);

});
$('#green').click(function(){

    var down = $('#sobre_nosotros').offset().top;

    $("html, body").animate({
        scrollTop: down}, 1000);

});

$.klAnimate({
    duration: 1,
    delay: 0.2
});
