$(document).ready(function (event) {
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
        $('#content').css('background-image', 'url("http://' + window.location.host + '/public/images/frontend/'+ dibujo +'.jpg")')
            .css('background-repeat', repeat)
            .css('background-size', size)
            .css('background-position', position);
    }

    if (/register/.test(path)) {
        backgroundLoginRegister('dibujo-coati', 'no-repeat', 'contain', '100% 50%');
    } else if (/login/.test(path)) {
        backgroundLoginRegister('dibujo-yaguarete', 'no-repeat', 'contain', '0% 50%');
        $('#content').css('background-color', '#f6f6f6');
    }
});

$(document).ready(function (event) {
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
});

$(document).ready(function () {
    /********
    * Configuración del bootstrap-datepicker
    * */
    $('#date_of_birth .date').datepicker({
        language: "es",
        format: 'dd/mm/yyyy'
    });

    /*******
    * Configuracion de la sección de avatars y el input de subir imágenes
    * */
    $('#upload_image').prop('checked', false);
    $('.image_profile').slideToggle('fast');
    $('#upload_image').on('click', function (e) {
        $('.image_profile').slideToggle('slow');
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
