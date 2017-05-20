$(document).ready(function (event) {
    /******************************************************************
     *  Menú pegajoso
     * *****************************************************************/
    $(document).ready(function(){
        var altura = $('.general-menu').offset().top;

        $(window).on('scroll', function(){
            if ( $(window).scrollTop() > altura ){
                $('.general-menu').addClass('menu-fixed');
                $('#arrow_left, #arrow_right').css('top', '12px').css('margin-bottom', '50px');
                $('#overlay').css('margin-top', '50px');
            } else {
                $('.general-menu').removeClass('menu-fixed');
                $('#arrow_left, #arrow_right').removeAttr('style');
                $('#overlay').removeAttr('style');
            }
        });

    });

    /****
     * Cambia el fondo del header cada 10 segundos.
     * */
    setInterval(backgroundChange, 10000);
    var contador = 1;
    function continuousNumber(min, max) {
        var result = min + contador;
        contador++;
        if (result > max) { contador = 1, result = 1; };
        return result;
    }
    function backgroundChange() {
        $('#overlay').animate({
            'opacity': 1
        }, 1500, function () {
            $('#header').css('background-image', 'url("http://' + window.location.host + '/images/frontend/cabanas' + continuousNumber(1, 11) + '.jpg")');
            $('#overlay').animate({
                'opacity': 0
            }, 1500);
        });
    }

    /*******
     *
     * Fondo de dibujos en login y register.
     *
     * */
    var path = window.location.pathname;
    function backgroundLoginRegister(dibujo, repeat, size, position) {
        $('#content').css('background-image', 'url("http://' + window.location.host + '/images/frontend/'+ dibujo +'.jpg")')
            .css('background-repeat', repeat)
            .css('background-size', size)
            .css('background-position', position);
    }

    if (/register/.test(path)) {
        backgroundLoginRegister('dibujo-coati', 'no-repeat', 'contain', '100% 50%');
        $('.panel-default').css('box-shadow', '3px 3px 17px 6px #333333');
        $('.panel-heading').css('background-color', '#fd7500');
    } else if (/login/.test(path)) {
        backgroundLoginRegister('dibujo-yaguarete', 'no-repeat', 'contain', '0% 50%');
        $('#content').css('background-color', '#f9f9f9');
        $('#arrow_left, #arrow_right').css('border-bottom-color', '#f9f9f9');
        $('.panel-default').css('box-shadow', '3px 3px 17px 6px #333333');
        $('.panel-heading').css('background-color', '#fd7500');
    }
});
