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
