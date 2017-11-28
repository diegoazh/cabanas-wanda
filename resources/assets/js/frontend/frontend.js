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
                $('.container-logo').css('top', '8%');
            } else {
                $('.general-menu').removeClass('menu-fixed');
                $('#arrow_left, #arrow_right').removeAttr('style');
                $('#overlay').removeAttr('style');
                $('.container-logo').removeAttr('style');
            }
        });

    });

    /****
     * Cambia el fondo del header cada 10 segundos.
     * */
    //H@Ubuntu16
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
    function backgroundDrawing(dibujo, size, position, repeat = 'no-repeat') {
        $('#content').css('background-image', 'url("http://' + window.location.host + '/images/frontend/'+ dibujo +'.jpg")')
            .css('background-repeat', repeat)
            .css('background-size', size)
            .css('background-position', position);
    }

    if (/register/.test(path)) {
        backgroundDrawing('dibujo-carpincho', 'contain', '100% 50%');
        $('.panel-default').css('box-shadow', '3px 3px 17px 6px #333333');
        $('.panel-heading').css('background-color', '#fd7500');
    } else if (/login/.test(path)) {
        backgroundDrawing('dibujo-yaguarete', 'contain', '0% 50%');
        $('#content').css('background-color', '#f9f9f9');
        $('#arrow_left, #arrow_right').css('border-bottom-color', '#f9f9f9');
        $('.panel-default').css('box-shadow', '3px 3px 17px 6px #333333');
        $('.panel-heading').css('background-color', '#fd7500');
    } else if (/profile/.test(path)) {
        backgroundDrawing('dibujo-coati-2', 'contain', '100% 50%');
    } else if (/order/.test(path)) {
        backgroundDrawing('dibujo-aguara-guazu', '45%', '100% 100%');
    } else if (/liquidation/.test(path)) {
        backgroundDrawing('dibujo-tapir', '50%', '100% 50%')
    } else if (/rentals\/edit/.test(path)) {
        backgroundDrawing('dibujo-yaguarete-2', '50%', '100% 50%')
    } else if (/rentals/.test(path)) {
        backgroundDrawing('dibujo-mono', 'contain', '100% 50%');
    }

    function setFrontendModal(ttModal, bodyModal) {
        $('.modal-header').css('background-color', '#333333').css('color', '#ffffff');
        $('.modal-footer').css('background-color', '#333333');
        $('.modal-title').text(ttModal);
        $('.modal-body').html(bodyModal);
    }

    $('#mail, #phone, #cel').click(function (e) {
        let lnk = e.target;
        let body = '';
        let $btn = $(lnk);
        if(/mail/.test($btn.data('tt-modal'))) {
            body = `<h2 class="text-center">
                        <i class="fa fa-envelope-open" aria-hidden="true"></i> ${$btn.data('tt-modal')} a
                    </h2>
                    <h3 class="text-center">
                        <a class="btn btn-danger btn-lg" mailto="${$btn.data('body-modal')}@gmail.com">
                            <i class="fa fa-envelope-open-o" aria-hidden="true"></i> ${$btn.data('body-modal')}<i class="fa fa-at" aria-hidden="true"></i>gmail.com
                        </a>
                    </h3>`;
        } else if (/fijo/.test($btn.data('tt-modal'))) {
            body = `<h2 class="text-center">
                        <i class="fa fa-phone" aria-hidden="true"></i> ${$btn.data('tt-modal')}
                    </h2>
                    <h3 class="text-center">
                        <a href="#" class="btn btn-primary btn-lg">
                            <i class="fa fa-phone-square" aria-hidden="true"></i> ${$btn.data('body-modal')}
                        </a>
                    </h3>`;
        } else {
            body = `<h2 class="text-center">
                        <i class="fa fa-mobile" aria-hidden="true"></i> ${$btn.data('tt-modal')}
                    </h2>
                    <h3 class="text-center">
                        <a href="#" class="btn btn-success btn-lg">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i> ${$btn.data('body-modal')}
                        </a>
                    </h3>`;
        }
        setFrontendModal($btn.data('tt-modal'), body);
    });
});
