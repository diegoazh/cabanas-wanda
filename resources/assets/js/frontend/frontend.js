$(document).ready(function (event) {
    /******************************************************************
     *  Menú pegajoso
     * *****************************************************************/
    /*var altura = $('.general-menu').offset().top;

    $(window).on('scroll', function(){
        if ( $(window).scrollTop() > altura ){
            // $('.general-menu').addClass('menu-fixed');
            // $('#arrow_left, #arrow_right').css('top', '8px');
            // $('#overlay').css('margin-top', '50px');
            // $('.container-logo').css('top', '8%');
        } else {
            // $('.general-menu').removeClass('menu-fixed');
            // $('#arrow_left, #arrow_right').removeAttr('style');
            // $('#overlay').removeAttr('style');
            // $('.container-logo').removeAttr('style');
        }
    });*/

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

    if (/register/.test(path) || /new_email_confirmation/.test(path)) {
        backgroundDrawing('dibujo-carpincho', 'contain', '100% 50%');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/login/.test(path)) {
        backgroundDrawing('dibujo-yaguarete', 'contain', '0% 50%');
        $('#content').css('background-color', '#f9f9f9');
        $('#arrow_left, #arrow_right').css('border-bottom-color', '#f9f9f9');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/reset/.test(path)) {
        backgroundDrawing('dibujo-jabali', 'contain', '85% 50%');
        $('.card').css('box-shadow', '3px 3px 17px 6px #333333');
    } else if (/profile/.test(path)) {
        backgroundDrawing('dibujo-coati-2', 'contain', '100% 50%');
    } else if (/order/.test(path)) {
        backgroundDrawing('dibujo-aguara-guazu', '45%', '100% 0%');
    } else if (/liquidation/.test(path)) {
        backgroundDrawing('dibujo-tapir', '50%', '100% 50%')
    } else if (/rentals\/edit/.test(path)) {
        backgroundDrawing('dibujo-yaguarete-2', '50%', '100% 50%')
    } else if (/rentals/.test(path)) {
        backgroundDrawing('dibujo-mono', 'contain', '100% 50%');
    } else if (/new_email_confirmation/.test(path)) {
        backgroundDrawing('dibujo-yacare', 'contain', '100% 50%');
    }

    function setFrontendModal(modalId, ttModal, bodyModal) {
        // (type === 'sm' || type === 'lg') ? $('.modal-dialog').addClass('modal-' + type) : null;
        $(`#${modalId} > .modal-title`).text(ttModal);
        $(`#${modalId} > .modal-body`).html(bodyModal);
    }

    $('#phone, #cel').click(function (e) {
        let lnk = e.target;
        let body = '';
        let $btn = $(lnk);

        if (/fijo/.test($btn.data('tt-modal'))) {
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
        setFrontendModal('msg_modals_frontend', $btn.data('tt-modal'), body);
    });
});
