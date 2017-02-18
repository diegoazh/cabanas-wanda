$(document).ready(function () {
    $('#date_of_birth .date').datepicker({
        language: "es",
        format: 'dd/mm/yyyy'
    });

    $('#upload_image').prop('checked', false);
    $('.image_profile').slideToggle('fast');
    $('#upload_image').on('click', function (e) {
        $('.image_profile').slideToggle('slow');
        $('#avatar_profile').slideToggle('slow');
    });

    $('.img-avatar').on('click', function (e) {
        if (!$(this).hasClass('avatar-selected')) {
            $('.avatar-selected').removeClass('avatar-selected');
            $(this).addClass('avatar-selected');
        } else {
            $(this).removeClass('avatar-selected');
        }
    });
});
