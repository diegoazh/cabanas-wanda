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
        locale: 'es',
        format: 'DD/MM/YYYY',
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
        if (!$('#upload_image').prop('checked')) window.profileFunc();
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
