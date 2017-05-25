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

    function setFrontendModal(ttModal, bodyModal) {
        $('.modal-header').css('background-color', '#333333').css('color', '#ffffff');
        $('.modal-footer').css('background-color', '#333333');
        $('.modal-title').text(ttModal);
        $('.modal-body').html(bodyModal);
    }

    $('#mail, #phone, #cel').click(function (e) {
        let lnk = e.target;
        let body = '';
        $btn = $(lnk);
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

$(document).ready(function (event) {
    $(document).ready(function(){
        var altura = $('.general-menu').offset().top;

        $(window).on('scroll', function(){
            if ( $(window).scrollTop() > altura ){
                $('.general-menu').addClass('menu-fixed');
                $('#arrow_left, #arrow_right').css('top', '15px').css('margin-bottom', '50px');
                $('#overlay').css('margin-top', '50px');
                if (/cottages/.test(window.location.pathname))
                    $('.container-logo').css('top', '17.5%');
            } else {
                $('.general-menu').removeClass('menu-fixed');
                $('#arrow_left, #arrow_right').removeAttr('style');
                $('#overlay').removeAttr('style');
                $('.container-logo').removeAttr('style');
            }
        });

    });

    $('img.img-responsive.img-rounded').click(function (e) {
        e.preventDefault();
        var $padre = $(this).parent('div.col-md-12');
        var $hno = $padre.siblings('div.col-md-12');
        var $anchor = $hno.find('a.btn.btn-primary.btn-sm');
        var $url = $anchor.attr('href');
        window.location = $url;
    });
});

$(document).ready(function (event) {
    moment.locale('es');
    $('h2.title-sections').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $children = $this.children('i');
        var $slideElement = $this.siblings('.element-slide');
        $slideElement.slideToggle('slow');
        if($children.hasClass('fa-caret-down')) {
            $children.removeClass('fa-caret-down').addClass('fa-caret-right');
        } else {
            $children.removeClass('fa-caret-right').addClass('fa-caret-down');
        }
    });

    (function cottageCalendar() {
        if ($('#calendar').length) {
            var $calendar = $('#calendar');
            $calendar.clndr({
                daysOfTheWeek: moment.weekdays(),
            });
            var $table = $('.clndr-table');
        }
    }());

    $(document).ready(function(){
        var altura = $('.general-menu').offset().top;

        $(window).on('scroll', function(){
            if ( $(window).scrollTop() > altura ){
                $('.general-menu').addClass('menu-fixed');
                $('#arrow_left, #arrow_right').css('top', '15px').css('margin-bottom', '50px');
                $('#overlay').css('margin-top', '50px');
                if (/cottages/.test(window.location.pathname))
                    $('.container-logo').css('top', '17.5%');
            } else {
                $('.general-menu').removeClass('menu-fixed');
                $('#arrow_left, #arrow_right').removeAttr('style');
                $('#overlay').removeAttr('style');
                $('.container-logo').removeAttr('style');
            }
        });

    });
});

$(document).ready(function () {
    /********
    * Configuración del bootstrap-datepicker
    * */
    // Este trozo de código configura el día domingo como primer día de la semana en moment con locale = 'es'
    // lo cual hace que el datetimepicker muestre el día domingo en primer lugar.
    moment.updateLocale('es', {
        week: { dow: 0 },
    });
    $('#birth #dateOfBirth').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'es',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down"
        },
    });

    /*******
    * Configuracion de la sección de avatars y el input de subir imágenes
    * */
    $('#upload_image').prop('checked', false);
    $('.imageProfile').slideToggle('fast');
    $('#upload_image').on('click', function (e) {
        $('.imageProfile').slideToggle('slow');
        $('#avatar_profile').slideToggle('slow');
        $('.avatar-selected').removeClass('avatar-selected');
        $('input[name=image_avatar]').val('');
        $('input[name=image_profile]').val('');
    });

    $('.img-avatar').on('click', function (e) {
        if (!$(this).hasClass('avatar-selected')) {
            $('.avatar-selected').removeClass('avatar-selected');
            $(this).addClass('avatar-selected');
            $('input[name=image_avatar]').val($(this).data('avatar'));
        } else {
            $(this).removeClass('avatar-selected');
        }
    });
});

//# sourceMappingURL=frontend.js.map
